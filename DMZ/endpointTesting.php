<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://edamam-recipe-search.p.rapidapi.com/search?q=chicken",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: edamam-recipe-search.p.rapidapi.com",
		"X-RapidAPI-Key: 3fcf69dfc9msh88b56acf595078fp18c549jsn68cd7b9bd3d0"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}
