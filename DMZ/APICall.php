<?php
function APIcall($ingredients){
    $ch = require "initcurl.php";

    $query = $ingredients;

    curl_setopt($ch, CURLOPT_URL, "https://api.edamam.com/api/recipes/v2?type=public&q=$query&app_id=ba090757&app_key=daa20634d8472a5e8d63e245bfe22c58");

    $response = curl_exec($ch);

    //$status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE); 

    curl_close($ch);

    //$data = json_decode($response);
    $data = json_decode($response, true); //returns as associative array

    return $data;
}

//APIcall("chicken");

//q=apple%20and%20chicken%2C%20rice
//search for: apple and chicken, rice. 