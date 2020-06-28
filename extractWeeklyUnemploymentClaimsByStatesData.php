<?php

$url = "https://www.statista.com/statistics/1107209/unemployment-insurance-initial-claims-weekly-state-us/";

$dom = new DOMDocument;
$dom->loadHTMLFile($url);

$finder = new DomXPath($dom);

// table having classname "statisticChart statisticChart--typeTable"
$classname = "statisticChart statisticChart--typeTable";
$nodes = $finder->query("//*[contains(@class, '$classname')]");

$unemploymentClaimsData = [];
foreach ($nodes as $key => $ele) {
    foreach ($ele->getElementsByTagName('table') as $table) {
        // fetch table headers
        foreach ($table->getElementsByTagName('thead') as $tableBody) {
            foreach ($tableBody->getElementsByTagName('tr') as $tr) {
                foreach ($tr->getElementsByTagName('th') as $th) {
                    $unemploymentClaimsData['header'][] = $th->nodeValue;
                }
                break;
            }
            break;
        }

        // fetch table data
        foreach ($table->getElementsByTagName('tbody') as $tableBody) {
            foreach ($tableBody->getElementsByTagName('tr') as $tr) {
                foreach ($tr->getElementsByTagName('td') as $key => $td) {
                    if($key == 0) {
                        $state = $td->nodeValue;
                    }
                    $unemploymentClaimsData[$state][] = $td->nodeValue;
                }
            }
            break;
        }
    }
}

$fp = fopen(dirname(__FILE__) . "/data/unemploymentClaims.csv", "w");
foreach ($unemploymentClaimsData as $key => $value) {
    fputcsv($fp, $value);
}

fclose($fp);
exit();