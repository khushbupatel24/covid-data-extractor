<?php

$url = "https://oui.doleta.gov/unemploy/csv/ar539.csv";

$date = date("d-m-Y");
$fp = fopen(dirname(__FILE__) . "/data/unemploymentClaims-${date}.csv", "w");

if (($handle = fopen($url, "r")) !== false) {
    $firstRow = true;
    $aData = array();
    while (($data = fgetcsv($handle)) !== false) {
        if ($firstRow) {
            $headers = array_values($data);
            fputcsv($fp, ['state', 'date', 'claims']);
            $firstRow = false;
        } else {
            $record = array_values($data);
            $date = date_create_from_format("m/d/Y", $data[3]);
            if ($date > date_create_from_format("m/d/Y", '01/01/2020')) {
                fputcsv($fp, [$record[0], $record[3], $record[4]]);
            }
        }
    }
    fclose($handle);
}

fclose($fp);
exit();