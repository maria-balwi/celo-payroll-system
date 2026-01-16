<?php

    require_once __DIR__ . '/../config/config.php';

    function getSentryToken() 
    {
        $url = SENTRY_BASE_URL . '/GetToken';

        $query = http_build_query([
            'username' => SENTRY_API_USERNAME,
            'password' => SENTRY_API_PASSWORD
        ]);

        $ch = curl_init($url . '?' . $query);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response ? trim($response) : false;
    }

?>