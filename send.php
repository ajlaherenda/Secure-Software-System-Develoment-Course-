<?php

/*curl -X "POST" "https://rest.nexmo.com/sms/json" \
  -d "from=$VONAGE_BRAND_NAME" \
  -d "text=A text message sent using the Vonage SMS API" \
  -d "to=$TO_NUMBER" \
  -d "api_key=$VONAGE_API_KEY" \
  -d "api_secret=$VONAGE_API_SECRET"
  */
// Autoloader
include "vendor/autoload.php";

function sendMessage($code) {
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$api_key = $_ENV['VONAGE_API_KEY'];
$api_secret = $_ENV['VONAGE_API_SECRET'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://rest.nexmo.com/sms/json");
curl_setopt($ch, CURLOPT_POST, 1);

// creating an array containing the post request fields
// expected is to accquire values for the VONAGE_API_KEY & VONAGE_API_SECRET

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('from' => 'Ajla', 'text' => 'Your confirmation code is:' . $code,'to' => 387603296141, 'api_key' => $api_key, 'api_secret' => $api_secret)));
           
// Receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

curl_close($ch);
print($server_output);
}
sendMessage("1308");

?>