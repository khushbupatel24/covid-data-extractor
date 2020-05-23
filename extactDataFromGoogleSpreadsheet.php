<?php

$spreadsheet_url="https://docs.google.com/spreadsheets/d/e/2PACX-1vStD_EMR9El7agVp-Oi6d1c5EMAOYgoYOsSc2xhwzht1ae4Fku7F6zSmF4PB9J_aHA1DAb2PpAelomO/pub?gid=2057441901&single=true&output=csv";

if(!ini_set('default_socket_timeout', 15)) echo "<!-- unable to change socket timeout -->";

if (($handle = fopen($spreadsheet_url, "r")) !== FALSE) {
    $data = fgetcsv($handle);
    $fp = fopen("ICU Beds Occupied.csv","w");
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        fputcsv($fp, $data);
    }
    fclose($fp);
    fclose($handle);
}
else
    die("Problem reading csv");

print_r("done");