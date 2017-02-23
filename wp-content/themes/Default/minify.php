<?php
header("Content-Type: application/javascript");
$url = $_GET['url'];
$request = file_get_contents($url);
$response = preg_replace('/\s+/', '', $request);
echo $response;
?>