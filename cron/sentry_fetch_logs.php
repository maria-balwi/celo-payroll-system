<?php

    require_once 'sentry_auth.php';

    function fetchSentryLogs($personnelNo, $startDate, $endDate) 
    {
        $token = getSentryToken();
        if (!$token) return false;

        $url = SENTRY_BASE_URL . '/GetTimeLogsBulkData';

        $payload = json_encode([
            "PersonnelNo" => $personnelNo,
            "StartDate" => $startDate,
            "EndDate" => $endDate, 
            "start" => 0,
            "max" => 1000
        ]);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true, 
            CURLOPT_POST => true, 
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ], 
            CURLOPT_POSTFIELDS => $payload
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

?>