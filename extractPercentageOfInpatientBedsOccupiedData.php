<?php

$url = "https://app.powerbigov.us/view?r=eyJrIjoiYjk2MjA4NTgtYTU4ZS00MjkyLTg3ODctYjQwZDlhZGRkNDgxIiwidCI6IjljZTcwODY5LTYwZGItNDRmZC1hYmU4LWQyNzY3MDc3ZmM4ZiJ9";

print_r(file_get_contents($url));
exit();
$dom = new DOMDocument;
$dom->loadHTMLFile($url);

$finder = new DomXPath($dom);

$classname = "rowHeaders";
$nodes = $finder->query("//*[contains(@class, '$classname')]");

foreach ($nodes as $key => $ele) {
    print_r("1");
    foreach ($ele->getElementsByTagName('div') as $divTag) {
        print_r(1);
        break;
    }
}
exit();

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