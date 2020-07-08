<?php

$url = "https://oui.doleta.gov/unemploy/csv/ar539.csv";

if (($handle = fopen($url, "r")) !== false) {
    $firstRow = true;
    $aData = array();
    while (($data = fgetcsv($handle)) !== false) {
        if ($firstRow) {
            $headers = array_values($data);
            $headers = [$headers[0], $headers[3], $headers[4]];
            $firstRow = false;
        } else {
            $record = array_values($data);
            $date = date_create_from_format("m/d/Y", $data[3]);
            if($date > date_create_from_format("m/d/Y", '01/01/2020')) {
                $aData[] = array_combine($headers, [$record[0], $record[3], $record[4]]);
            }
        }
    }
    fclose($handle);
}

print_r(json_encode($aData));