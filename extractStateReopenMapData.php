<?php

$url = "https://www.nytimes.com/interactive/2020/us/states-reopen-map-coronavirus.html";

$dom = new DOMDocument;
$dom->loadHTMLFile($url);
$finder = new DomXPath($dom);

$date = '';
foreach ($dom->getElementsByTagName('time') as $ele) {
    $date = $ele->nodeValue;
    $date = str_ireplace('Updated ', '', $date);
    $date = date_create_from_format("F d, Y", $date);
    $date = date_format($date, "d-m-Y");
    break;
}

$classname = "g-key-entries";
$nodes = $finder->query("//*[contains(@class, '$classname')]");

$status = [];
foreach ($nodes as $key => $ele) {
    foreach ($ele->getElementsByTagName('span') as $spanTag) {
        if (!empty($spanTag->nodeValue)) {
            $status[] = strtolower(trim($spanTag->nodeValue));
        }
    }
}
$status = array_unique($status);

$fp = fopen(dirname(__FILE__) . "/data/nyt-${date}.csv", "w");
fputcsv($fp, ['status', 'state']);

foreach ($status as $statusValue)
{
    $classname = "g-state g-cat-${statusValue}";
    $nodes = $finder->query("//*[contains(@class, '$classname')]");

    foreach ($nodes as $key => $ele) {
        foreach ($ele->getElementsByTagName('div') as $divTag) {
            fputcsv($fp, [$statusValue, trim($divTag->nodeValue)]);
            break;
        }
    }
}

fclose($fp);
exit();