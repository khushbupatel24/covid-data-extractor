<?php

if (!ini_set('default_socket_timeout', 15)) echo "<!-- unable to change socket timeout -->";

// extract "ICU Beds Occupied" tab data from spreadsheet
$spreadsheet_url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vStD_EMR9El7agVp-Oi6d1c5EMAOYgoYOsSc2xhwzht1ae4Fku7F6zSmF4PB9J_aHA1DAb2PpAelomO/pub?gid=2057441901&single=true&output=csv";

if (($handle = fopen($spreadsheet_url, "r")) !== FALSE) {
    $data = fgetcsv($handle);
    if (empty($data)) {
        die("\nProblem reading ICU Beds Occupied csv");
    }
    $fp = fopen(dirname(__FILE__) . "/data/ICUBedsOccupied.csv", "w");
    fputcsv($fp, $data);
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        fputcsv($fp, $data);
    }
    fclose($fp);
    fclose($handle);
} else
    die("\nProblem reading ICU Beds Occupied csv");

print_r("\ndone ICU Beds Occupied csv");

// extract "CDC - Gaiting Criteria" tab data from spreadsheet
$spreadsheet_url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vStD_EMR9El7agVp-Oi6d1c5EMAOYgoYOsSc2xhwzht1ae4Fku7F6zSmF4PB9J_aHA1DAb2PpAelomO/pub?gid=852575640&single=true&output=csv";

if (($handle = fopen($spreadsheet_url, "r")) !== FALSE) {
    $data = fgetcsv($handle);
    if (empty($data)) {
        die("\nProblem reading CDC - Gaiting Criteria csv");
    }
    $fp = fopen(dirname(__FILE__) . "/data/CDC-GaitingCriteria.csv", "w");
    fputcsv($fp, $data);
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        fputcsv($fp, $data);
    }
    fclose($fp);
    fclose($handle);
} else
    die("\nProblem reading CDC - Gaiting Criteria csv");

print_r("\ndone CDC - Gaiting Criteria");

// extract "Population" tab data from spreadsheet
//$spreadsheet_url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vStD_EMR9El7agVp-Oi6d1c5EMAOYgoYOsSc2xhwzht1ae4Fku7F6zSmF4PB9J_aHA1DAb2PpAelomO/pub?gid=712897421&single=true&output=csv";
//
//$fp = fopen(dirname(__FILE__)."/data/Population.csv", "w");
//
//if (($handle = fopen($spreadsheet_url, "r")) !== FALSE) {
//    $data = fgetcsv($handle);
//    fputcsv($fp, $data);
//    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
//        fputcsv($fp, $data);
//    }
//    fclose($fp);
//    fclose($handle);
//} else
//    die("\nProblem reading Population csv");
//
//print_r("\ndone");

// extract "Data for website" tab data from spreadsheet
$spreadsheet_url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vStD_EMR9El7agVp-Oi6d1c5EMAOYgoYOsSc2xhwzht1ae4Fku7F6zSmF4PB9J_aHA1DAb2PpAelomO/pub?gid=237779988&single=true&output=csv";


if (($handle = fopen($spreadsheet_url, "r")) !== FALSE) {
    $data = fgetcsv($handle);
    if (empty($data)) {
        die("\nProblem reading Data for website csv");
    }
    $fp = fopen(dirname(__FILE__) . "/data/DataForWebsite.csv", "w");
    fputcsv($fp, $data);
    while (($data = fgetcsv($handle, 100000, ",")) !== FALSE) {
        fputcsv($fp, $data);
    }
    fclose($fp);
    fclose($handle);
} else
    die("\nProblem reading Data for website csv");

print_r("\ndone Data for website");

// extract "Interventions & Measures - Data" tab data from spreadsheet
$spreadsheet_url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vStD_EMR9El7agVp-Oi6d1c5EMAOYgoYOsSc2xhwzht1ae4Fku7F6zSmF4PB9J_aHA1DAb2PpAelomO/pub?gid=1459999830&single=true&output=csv";


if (($handle = fopen($spreadsheet_url, "r")) !== FALSE) {
    $data = fgetcsv($handle);
    if (empty($data)) {
        die("\nProblem reading Interventions & Measures - Data csv");
    }
    $fp = fopen(dirname(__FILE__) . "/data/InterventionsAndMeasures-Data.csv", "w");
    fputcsv($fp, $data);
    while (($data = fgetcsv($handle, 100000, ",")) !== FALSE) {
        if (!in_array($data[0], ["Intervention", "Measure", "Source", "Last Updated", "Include?"])) {
            fputcsv($fp, $data);
        }
    }
    fclose($fp);
    fclose($handle);
} else
    die("\nProblem reading Interventions & Measures - Data csv");

print_r("\ndone Interventions & Measures");

