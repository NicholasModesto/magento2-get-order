<?php

$order = int;
$file = "magento-order-$order.json";

$user = "";
$pass = "";

$baseURL = "https://";

fclose(STDOUT);
$STDOUT = fopen($file, 'wb');

$userData = array("username" => $user, "password" => $pass);
$ch = curl_init($baseURL . "/index.php/rest/V1/integration/admin/token");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($userData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Length: " . strlen(json_encode($userData))));

$token = curl_exec($ch);

//echo "Token: " . $token;

$ch1 = curl_init($baseURL . "/index.php/rest/V1/orders/$order");
curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch1, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . json_decode($token)));

$result = curl_exec($ch1);

//$result = json_decode($result, 1);

print_r($result);
?>