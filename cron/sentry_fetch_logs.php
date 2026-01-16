<?php

    require_once 'sentry_auth.php';

    function fetchSentryLogsPage($personnelNo, $startDate, $endDate, $start = 0, $max = 1000) 
    {
        $token = getSentryToken();
        if (!$token) return false;

        
        $payload = json_encode([
            "PersonnelNo" => $personnelNo,
            "StartDate" => $startDate,
            "EndDate" => $endDate, 
            "start" => (int)$start,
            "max" => (int)($max)
        ]);
        
        $url = SENTRY_BASE_URL . '/GetTimeLogsBulkData';
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true, 
            CURLOPT_POST => true, 
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json', 
                'Accept: application.json'
            ], 
            CURLOPT_POSTFIELDS => $payload, 
            CURLOPT_TIMEOUT => 30
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlErr = curl_error($ch);
        curl_close($ch);

        // NETWORK OR TRANSPORT FAILURE
        if ($response === false) {
            file_put_contents(__DIR__ . '/sentry_cron.log',
                date('Y-m-d H:i:s') . " CURL ERROR: $curlErr\n",
                FILE_APPEND
            );
            return false;   
        }

        // NON-200 MEANS THE BODY IS LIKELY AN ERROR OBJECT, NOT LOGS
        if ($httpCode !== 200) {
            file_put_contents(__DIR__ . '/sentry_cron.log',
                date('Y-m-d H:i:s') . " HTTP $httpCode: personnelNo=$personnelNo start=$start max=$max body=" . substr($response, 0, 500) . "\n",
                FILE_APPEND
            );
            return false;
        }

        // DECODE AND VALIDATE
        $decoded = json_decode($response, true);

        // IF JSON DECODING FAILED, RESPONSE MIGHT BE PLAIN text/HTML
        if (!is_array($decoded)) {
            file_put_contents(__DIR__ . '/sentry_cron.log',
                date('Y-m-d H:i:s') . " INVALID JSON personnelNo=$personnelNo start=$start body=" . substr($response, 0, 500) . "\n",
                FILE_APPEND
            );
            return false;
        }

        // Some APIs return {"data":[...]} or similar; handle both cases safely
        if (array_key_exists('data', $decoded) && is_array($decoded['data'])) {
            return $decoded['data'];
        }

        return $decoded;
    }


    function fetchSentryLogsAll($personnelNo, $startDate, $endDate, $pageSize = 1000, $maxPages = 200) 
    {
        $all = [];
        $start = 0;

        for ($page = 0; $page < $maxPages; $page++) {
            $chunk = fetchSentryLogsPage($personnelNo, $startDate, $endDate, $start, $pageSize);
            
            if (!is_array($chunk)) {
                return false;
            }

            $count = count($chunk);
            if ($count === 0) {
                break;
            }

            foreach ($chunk as $row) {
                $all[] = $row;
            }

            if ($count < $pageSize) {
                break;
            }

            $start += $pageSize;
        }
        
        return $all;
    }

?>