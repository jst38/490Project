<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_All);

$ch = curl_init();

$url = "https://regres.in/api/users?page=2";

//set the options

//connect to api through url
curl_setopt($ch, CURLOPT_URL, $url); 
//return set to true so the that the response will return instead of outputing it
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


$resp = curl_exec($ch);

if($e = curl_error($ch)){
    echo "cURL Error #:" . $e;
}
else{
    //when json decoded is true - all obj returned in form of array
    $decoded = json_decode($resp, true);
    print_r($decoded);
}
curl_close($ch);

?>