<?php

function curlPost($data)
{
    $url = 'https://api.bls.gov/publicAPI/v1/timeseries/data/';
    $post_field_string = json_encode($data);

    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Content-Length: ' . strlen($post_field_string);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_field_string);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);

    curl_close($ch);

    $jsonResponse = json_decode($response, true);

    return $jsonResponse;
}

$url = "https://download.bls.gov/pub/time.series/bd/bd.state";

$states = file_get_contents($url);
// print_r($states);
// print_r(json_encode(explode(PHP_EOL, $states)));
$states = explode(PHP_EOL, $states);
$stateCodes = [];
foreach ($states as $state) {
    if (!empty($state)) {
        $stateCode = explode('	', $state);
        $stateCodes[$stateCode[0]] = $stateCode[1];
    }
}
// print_r(count($stateCodes));

$jsonData = [];

$data = [
    "seriesid" => [
        "LASST010000000000003",
        "LASST020000000000003",
        "LASST040000000000003",
        "LASST050000000000003",
        "LASST060000000000003",
        "LASST080000000000003",
        "LASST090000000000003",
        "LASST100000000000003",
        "LASST110000000000003",
        "LASST120000000000003",
        "LASST130000000000003",
        "LASST150000000000003",
        "LASST160000000000003",
        "LASST170000000000003",
        "LASST180000000000003",
        "LASST190000000000003",
        "LASST200000000000003",
        "LASST210000000000003",
        "LASST220000000000003",
        "LASST230000000000003",
        "LASST240000000000003",
        "LASST250000000000003",
        "LASST260000000000003",
        "LASST270000000000003",
        "LASST280000000000003"
    ],
    "startyear" => "2020",
    "endyear" => "2020"
];

$response = curlPost($data);
// print_r(json_encode($response));
$series = $response['Results']['series'];

foreach ($series as $value) {
    foreach ($value['data'] as $rateData) {
        $jsonData[$value['seriesID']][$rateData['periodName']] = $rateData['value'];
    }
}

$data = [
    "seriesid" => [
        "LASST290000000000003",
        "LASST300000000000003",
        "LASST310000000000003",
        "LASST320000000000003",
        "LASST330000000000003",
        "LASST340000000000003",
        "LASST350000000000003",
        "LASST360000000000003",
        "LASST370000000000003",
        "LASST380000000000003",
        "LASST390000000000003",
        "LASST400000000000003",
        "LASST410000000000003",
        "LASST420000000000003",
        "LASST440000000000003",
        "LASST450000000000003",
        "LASST460000000000003",
        "LASST470000000000003",
        "LASST480000000000003",
        "LASST490000000000003",
        "LASST500000000000003",
        "LASST510000000000003",
        "LASST530000000000003",
        "LASST540000000000003",
        "LASST550000000000003"
    ],
    "startyear" => "2020",
    "endyear" => "2020"
];

$response = curlPost($data);
$series = $response['Results']['series'];

foreach ($series as $value) {
    foreach ($value['data'] as $rateData) {
        $jsonData[$value['seriesID']][$rateData['periodName']] = $rateData['value'];
    }
}

$data = [
    "seriesid" => [
        "LASST560000000000003",
        "LASST720000000000003",
        "LASST800000000000003"
    ],
    "startyear" => "2020",
    "endyear" => "2020"
];

$response = curlPost($data);
$series = $response['Results']['series'];

foreach ($series as $value) {
    foreach ($value['data'] as $rateData) {
        $jsonData[$value['seriesID']][$rateData['periodName']] = $rateData['value'];
    }
}

$result = [];
foreach ($jsonData as $key => $value) {
    $stateCode = substr($key, 5, 2);
    $result[rtrim($stateCodes[$stateCode])] = $value;
}

$isFirst = true;
$fp = fopen(dirname(__FILE__) . "/data/unemploymentRates.csv", "w");
foreach ($result as $state => $value) {
    $header = null;
    if ($isFirst) {
        $header[] = 'state';
    }
    $data = null;
    $data[] = $state;
    foreach ($value as $month => $rate) {
        if ($isFirst) {
            $header[] = $month;
        }
        $data[] = $rate;
    }
    if ($header != null) {
        fputcsv($fp, $header);
    }
    fputcsv($fp, $data);
    $isFirst = false;
}
fclose($fp);
exit();