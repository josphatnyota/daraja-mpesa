<?php
//YOU MPESA API KEYS
$consumerKey = "MOKNTb2DxPY4Toqr0TruOgpedoWK2rg1"; //Fill with your app Consumer Key
$consumerSecret = "ZpMcJFoyfTcZmlsK"; //Fill with your app Consumer Secret

//ACCESS TOKEN URL
$access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

$headers = ['Content-Type:application/json; charset=utf8'];
$curl = curl_init($access_token_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_HEADER, FALSE);
curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
$result = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//echo $result;
//error handlers
if ($status !== 200) {
    echo "Error: Failed to generate access token\n";
    echo "HTTP Status: $status\n";
    echo "Response: $result\n";
    exit();
}

$result = json_decode($result);

if ($result === null || !property_exists($result, 'access_token')) {
    echo "Error: Invalid JSON response\n";
    echo "Response: $result\n";
    exit();
}

// ASSIGN ACCESS TOKEN TO A VARIABLE
echo $access_token = $result->access_token;
curl_close($curl);

// Do something with $access_token
?>
