<?php

$url = "https://www.bls.gov/web/laus/lauhsthl.htm";

$dom = new DOMDocument;
$dom->loadHTMLFile($url);

$finder = new DomXPath($dom);

//$date = '';
//foreach ($dom->getElementsByTagName('time') as $ele) {
//    $date = $ele->nodeValue;
//    $date = str_ireplace('Updated ', '', $date);
//    $date = date_create_from_format("F d, Y", $date);
//    $date = date_format($date, "d-m-Y");
//    break;
//}

$classname = "stubhead";
$nodes = $finder->query("//*[contains(@class, '$classname')]");
$headers = [];

foreach ($nodes as $node) {
    $headers[] = $node->nodeValue;
}

// table having classname "regular"
$classname = "regular";
$nodes = $finder->query("//*[contains(@class, '$classname')]");

$unemploymentData = [];
foreach ($nodes as $key => $ele) {
    // fetch table headers
    foreach ($ele->getElementsByTagName('thead') as $tableBody) {
        foreach ($tableBody->getElementsByTagName('tr') as $tr) {
            foreach ($tr->getElementsByTagName('th') as $th) {
                if ($th->nodeValue == "Historical High" || $th->nodeValue == "Historical Low") {
                    $unemploymentData['header'][] = $th->nodeValue . " Date";
                    $unemploymentData['header'][] = $th->nodeValue . " Rate";
                } else {
                    $unemploymentData['header'][] = $th->nodeValue;
                }
            }
            break;
        }
        break;
    }

    // fetch table data
    foreach ($ele->getElementsByTagName('tbody') as $tableBody) {
        foreach ($tableBody->getElementsByTagName('tr') as $tr) {
            foreach ($tr->getElementsByTagName('th') as $th) {
                $state = $th->nodeValue;
                $unemploymentData[$state][] = $state;
            }
            foreach ($tr->getElementsByTagName('td') as $td) {
                $unemploymentData[$state][] = $td->nodeValue;
            }
        }
        break;
    }
}

$fp = fopen(dirname(__FILE__) . "/data/unemployment.csv", "w");
foreach ($unemploymentData as $key => $value) {
    fputcsv($fp, $value);
}

fclose($fp);
exit();