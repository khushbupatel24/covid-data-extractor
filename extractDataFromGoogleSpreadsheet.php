<?php

if(!ini_set('default_socket_timeout', 15)) echo "<!-- unable to change socket timeout -->";

// extract "ICU Beds Occupied" tab data from spreadsheet
$spreadsheet_url="https://docs.google.com/spreadsheets/d/e/2PACX-1vStD_EMR9El7agVp-Oi6d1c5EMAOYgoYOsSc2xhwzht1ae4Fku7F6zSmF4PB9J_aHA1DAb2PpAelomO/pub?gid=2057441901&single=true&output=csv";
$fp = fopen("ICU Beds Occupied.csv","w");

if (($handle = fopen($spreadsheet_url, "r")) !== FALSE) {
    $data = fgetcsv($handle);
    fputcsv($fp, $data);
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        fputcsv($fp, $data);
    }
    fclose($fp);
    fclose($handle);
}
else
    die("Problem reading ICU Beds Occupied csv");

// extract "CDC - Gaiting Criteria" tab data from spreadsheet
$spreadsheet_url="https://docs.google.com/spreadsheets/d/e/2PACX-1vStD_EMR9El7agVp-Oi6d1c5EMAOYgoYOsSc2xhwzht1ae4Fku7F6zSmF4PB9J_aHA1DAb2PpAelomO/pub?gid=852575640&single=true&output=csv";

$fp = fopen("CDC - Gaiting Criteria.csv","w");

if (($handle = fopen($spreadsheet_url, "r")) !== FALSE) {
    $data = fgetcsv($handle);
    fputcsv($fp, $data);
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        fputcsv($fp, $data);
    }
    fclose($fp);
    fclose($handle);
}
else
    die("Problem reading CDC - Gaiting Criteria csv");

print_r("done");

// extract "Population" tab data from spreadsheet
$spreadsheet_url="https://docs.google.com/spreadsheets/d/e/2PACX-1vStD_EMR9El7agVp-Oi6d1c5EMAOYgoYOsSc2xhwzht1ae4Fku7F6zSmF4PB9J_aHA1DAb2PpAelomO/pub?gid=712897421&single=true&output=csv";

$fp = fopen("Population.csv","w");

if (($handle = fopen($spreadsheet_url, "r")) !== FALSE) {
    $data = fgetcsv($handle);
    fputcsv($fp, $data);
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        fputcsv($fp, $data);
    }
    fclose($fp);
    fclose($handle);
}
else
    die("Problem reading Population csv");

print_r("done");

// extract "Data for website" tab data from spreadsheet
$spreadsheet_url="https://docs.google.com/spreadsheets/d/e/2PACX-1vStD_EMR9El7agVp-Oi6d1c5EMAOYgoYOsSc2xhwzht1ae4Fku7F6zSmF4PB9J_aHA1DAb2PpAelomO/pub?gid=237779988&single=true&output=csv";

$fp = fopen("Data for website.csv","w");

if (($handle = fopen($spreadsheet_url, "r")) !== FALSE) {
    $data = fgetcsv($handle);
    fputcsv($fp, $data);
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        fputcsv($fp, $data);
    }
    fclose($fp);
    fclose($handle);
}
else
    die("Problem reading Data for website csv");

print_r("done");

// extract "Interventions & Measures - Data" tab data from spreadsheet
$spreadsheet_url="https://docs.google.com/spreadsheets/d/e/2PACX-1vStD_EMR9El7agVp-Oi6d1c5EMAOYgoYOsSc2xhwzht1ae4Fku7F6zSmF4PB9J_aHA1DAb2PpAelomO/pub?gid=1459999830&single=true&output=csv";

$fp = fopen("Interventions & Measures - Data.csv","w");

if (($handle = fopen($spreadsheet_url, "r")) !== FALSE) {
    $data = fgetcsv($handle);
    fputcsv($fp, $data);
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        fputcsv($fp, $data);
    }
    fclose($fp);
    fclose($handle);
}
else
    die("Problem reading Interventions & Measures - Data csv");

print_r("done");

