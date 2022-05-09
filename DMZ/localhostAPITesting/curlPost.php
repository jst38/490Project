<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_All);

$ch = curl_init();

$url = "/api/users";

$data_array = array(
    'name' => 'John Doe',
    'job' => 'web developer'
);

$data = http_build_query($data_array);

curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$resp = curl_exec($ch);

if($e = curl_error($ch)){
    echo "cURL Error #:" . $e;
}
else{
    //when json decoded is true - all obj returned in form of array
    $decoded = json_decode($resp, true);
    foreach($decoded as $key => $val){
        echo $key . ": " . $val . PHP_EOL;
    }
}
curl_close($ch);

?>