<?php

$file = __DIR__ . '/irbis.jpg';

$content_type = mime_content_type($file);
$hash = hash_file('sha1', $file);
$file_name = pathinfo($file, PATHINFO_BASENAME);

$url = $_SERVER['HTTP_HOST'] . '/receive.php';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "image={$file}&image_tmp_name={$file_name}&hash={$hash}");

$response = curl_exec($ch);

if(curl_errno($ch)){
    $error_msg = curl_error($ch);
    return $error_msg;
}
curl_close($ch);

echo $response;
