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

$classname = "g-state g-cat-reopening";
$nodes = $finder->query("//*[contains(@class, '$classname')]");

$fp = fopen("data/nyt-${date}.csv", "w");
fputcsv($fp, ['status', 'state']);

$reopeningStates = [];
foreach ($nodes as $key => $ele) {
    foreach ($ele->getElementsByTagName('div') as $divTag) {
        fputcsv($fp, ['reopening', trim($divTag->nodeValue)]);
        break;
    }
}

$classname = "g-state g-cat-regional";
$nodes = $finder->query("//*[contains(@class, '$classname')]");

foreach ($nodes as $key => $ele) {
    foreach ($ele->getElementsByTagName('div') as $divTag) {
        fputcsv($fp, ['regional', trim($divTag->nodeValue)]);
        break;
    }
}

$classname = "g-state g-cat-soon";
$nodes = $finder->query("//*[contains(@class, '$classname')]");

foreach ($nodes as $key => $ele) {
    foreach ($ele->getElementsByTagName('div') as $divTag) {
        fputcsv($fp, ['opening-soon', trim($divTag->nodeValue)]);
        break;
    }
}

$classname = "g-state g-cat-shutdown-restricted";
$nodes = $finder->query("//*[contains(@class, '$classname')]");

$restrictedStates = [];
foreach ($nodes as $key => $ele) {
    foreach ($ele->getElementsByTagName('div') as $divTag) {
        fputcsv($fp, ['restricted', trim($divTag->nodeValue)]);
        break;
    }
}

fclose($fp);
exit();