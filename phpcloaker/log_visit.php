<?php
function log_visit() {
    $data = array(
        "serverIdent" => "PHP",  // This is static
        "timestamp" => time(),
        "ip" => $_SERVER['REMOTE_ADDR'],
        "userAgent" => $_SERVER['HTTP_USER_AGENT'],
        "requestedDomain" => $_SERVER['HTTP_HOST'],
        "requestedURL" => $_SERVER['REQUEST_URI'],
        "referrer" => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '',
        "httpStatusResponse" => http_response_code(),
        "additionalData" => "Test data 2"  // This is static
    );

    $json_data = json_encode($data);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8083');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($json_data),
        'Auth: RALFOSPAM'
    ));

    $response = curl_exec($ch);
    curl_close($ch);
}
?>

