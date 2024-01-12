<?php

$file = __DIR__ . '/irbis.jpg';

$url = "https://httpbin.org/anything";

$content_type = mime_content_type($file);
$headers = array(
    "Content-Type: $content_type",
);

$stream = fopen($file, 'r');

if(file_exists($file)){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PUT, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_INFILE, $stream);
    $response = curl_exec($ch);

    fclose($stream);

    if(curl_errno($ch)){
        $error_msg = curl_error($ch);
        return $error_msg;
    }
    curl_close($ch);

    if(file_exists("/httpbin.json")){
        fclose(fopen("httpbin.json", 'w'));
    }

    echo "<pre>";
    print_r($response);
    echo "</pre>";
}
