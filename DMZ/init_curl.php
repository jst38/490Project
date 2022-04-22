<?php

$headers = [
    "app_id:ba090757",
    "app_key:daa20634d8472a5e8d63e245bfe22c58"
];

$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_RETURNTRANSFER => true 
]);

return $ch;