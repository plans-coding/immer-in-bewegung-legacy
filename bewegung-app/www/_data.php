<?php

// Install YAML for PHP:
// sudo apt-get install php-yaml

// Check if file exist (to override standard data folder)
if (file_exists("path-data")) {
    $dataPath = file_get_contents("path-data");
} else {
    $dataPath = "data/";
}

if (file_exists("path-settings")) {
    $settingsPath = file_get_contents("path-settings");
} else {
    $settingsPath = "data/iib-settings.yml";
}

// ### SETTINGS FILE
$settings = yaml_parse_file($settingsPath);

// ### SETTINGS FILE PATH REFERENCES

$overview_file_path = $dataPath.$settings["trip-data"]["spreadsheet-name"]." - ".$settings["trip-data"]["overview-name"].".tsv";
$events_file_path = $dataPath.$settings["trip-data"]["spreadsheet-name"]." - ".$settings["trip-data"]["events-name"].".tsv";
$map_file_path = $dataPath.$settings["trip-data"]["spreadsheet-name"]." - ".$settings["trip-data"]["map-name"].".tsv";

// #### CONFIG ERROR CHECK
$keys = ["spreadsheet-id", "overview-gid", "events-gid", "map-gid"];

foreach ($keys as $key) {
    if ($settings["trip-data"][$key] == "") {
        echo '<div style="margin-top:20pt;background-color: #ffcccc;padding:10pt;"><b>' . htmlspecialchars($key) . '</b> not defined in iib-settings.yml</div>';
        exit();
    }
}

$stopExecution = false;

if (!file_exists($overview_file_path)) {
    echo '<div style="margin-top:20pt;background-color: #ffcccc;padding:10pt;">The following file is missing:<br /><b>'.$overview_file_path.'</b>';
    echo '&nbsp;&nbsp;<a style="color:red;" href="https://docs.google.com/spreadsheets/d/'.$settings["trip-data"]["spreadsheet-id"].'/export?format=tsv&gid='.$settings["trip-data"]["overview-gid"].'">This file? (Right-click and save to data folder)</a></div>';
    $stopExecution = true;
}

if (!file_exists($events_file_path)) {
    echo '<div style="margin-top:20pt;background-color: #ffcccc;padding:10pt;">The following file is missing:<br /><b>'.$events_file_path.'</b>';
    echo '&nbsp;&nbsp;<a style="color:red;" href="https://docs.google.com/spreadsheets/d/'.$settings["trip-data"]["spreadsheet-id"].'/export?format=tsv&gid='.$settings["trip-data"]["events-gid"].'">This file? (Right-click and save to data folder)</a></div>';
    $stopExecution = true;
}
if (!file_exists($map_file_path)) {
    echo '<div style="margin-top:20pt;background-color: #ffcccc;padding:10pt;">The following file is missing:<br /><b>'.$map_file_path.'</b>';
    echo '&nbsp;&nbsp;<a style="color:red;" href="https://docs.google.com/spreadsheets/d/'.$settings["trip-data"]["spreadsheet-id"].'/export?format=tsv&gid='.$settings["trip-data"]["map-gid"].'">This file? (Right-click and save to data folder)</a></div>';
    $stopExecution = true;
}

if ( $stopExecution == true ) { exit; }

//print_r($settings);

// ### INIT FROM SETTINGS
foreach ($settings["trip-categories"] as $no ) {
    $trip_categories[] = $no["category-abbreviation"];
    $trip_settings[$no["category-abbreviation"]]["Description"] = $no["category"];
    $trip_settings[$no["category-abbreviation"]]["Color"] = "#".$no["category-color"];
}

foreach ($settings["countries"] as $no ) {
    $continent = $no["continent"];
    //print_r($no);
    foreach ($no["continent-countries"] as $continent_country ) {
        $countries_array_original[$continent][] = $continent_country;
    }
}

//print_r($trip_categories);
//print_r($trip_settings);
//print_r($countries_array_original);

// #### DEBUG
if ( $settings["debug"] == 1 ) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// ### OVERVIEW
$allTripBlocksPre = array_map('str_getcsv', file($overview_file_path), array_fill(0, count(file($overview_file_path)), "\t"));


$tripBlocksHead = array_shift($allTripBlocksPre);

$tripBlocksHeadTranslation = array_flip($settings["column-mapping-overview"]);

// Översättning
$tripBlocksHead = array_map(function($header) use ($tripBlocksHeadTranslation) {
    return $tripBlocksHeadTranslation[$header] ?? $header;
}, $tripBlocksHead);

//print_r($tripBlocksHead);

$allTripBlocks = [];

// Restructure
foreach ($allTripBlocksPre as $key => $value) {
    // Check if first column is valid trip type
    if ( in_array($value[0],array_column($settings["trip-categories"],"category-abbreviation")) ) {
        // Pad $value with nulls if it's shorter than $tripBlocksHead
        while (count($value) < count($tripBlocksHead)) {
            $value[] = null;
        }
        $allTripBlocks[$key] = array_combine($tripBlocksHead, $value);
    }
}

//print_r($allTripBlocks);

// Restructure and filter
$tripBlocks = [];
$tripNumber2ID = [];
$tripID2Number = [];
$tripGroups = [];

foreach ($allTripBlocks as $key ) {
    /*
    if ( in_array($key["TripID"],$filter) ) {
        $tripBlocks[$key["TripID"]] = $key;
    }
    */
    // Check if first column is valid trip type
    if ( in_array($key["TripType"],array_column($settings["trip-categories"],"category-abbreviation")) ) {
        $tripBlocks[$key["TripID"]] = $key;
        $tripNumber2ID[$key["TripNumber"]] = $key["TripID"];
        $tripID2Number[$key["TripID"]] = $key["TripNumber"];
        $travelGroups[] = $key["TravelGroup"];
    }
}

$travelGroups = array_unique($travelGroups);

function compareBySecondColumn($a, $b) {
    return $a["DepartureDate"] <=> $b["DepartureDate"];
}

uasort($tripBlocks, 'compareBySecondColumn');
//print_r($tripBlocks);

// ### EVENTS

$allTripDetailsPre = array_map('str_getcsv', file($events_file_path), array_fill(0, count(file($events_file_path)), "\t"));
$tripDetailsHead = array_shift($allTripDetailsPre);

$tripDetailsHeadTranslation = array_flip($settings["column-mapping-events"]);

// Översättning
$tripDetailsHead = array_map(function($header) use ($tripDetailsHeadTranslation) {
    return $tripDetailsHeadTranslation[$header] ?? $header;
}, $tripDetailsHead);


//print_r($tripDetailsHead);
$allTripDetails = [];
// Omstrukturering
foreach ($allTripDetailsPre as $key => $value) {
    if ( in_array($value[0],array_column($settings["trip-categories"],"category-abbreviation")) ) {
        // Pad $value with nulls if it's shorter than $tripBlocksHead
        while (count($value) < count($tripDetailsHead)) {
            $value[] = null;
        }
        $allTripDetails[$key] = array_combine($tripDetailsHead, $value);
    }
}

array_multisort(array_column($allTripDetails, "Date"), SORT_ASC, $allTripDetails);
//print_r($allTripDetails);

// Omstrukturering och filtrering
$tripDetails = [];
foreach ($allTripDetails as $key ) {
    /*
    if ( in_array($tripNumber2ID[$key["TripNumber"]],$filter) ) {
        $tripDetails[$tripNumber2ID[$key["TripNumber"]]][$key["Date"]] = $key;
    }
    */
        $tripDetails[$tripNumber2ID[$key["TripNumber"]]][$key["Date"]] = $key;

}
//print_r($tripDetails);


// ### MAP

$allTripMapsPre = array_map('str_getcsv', file($map_file_path), array_fill(0, count(file($map_file_path)), "\t"));
$tripMapsHead = array_shift($allTripMapsPre);

$tripMapsHeadTranslation = array_flip($settings["column-mapping-map"]);

// Översättning
$tripMapsHead = array_map(function($header) use ($tripMapsHeadTranslation) {
    return $tripMapsHeadTranslation[$header] ?? $header;
}, $tripMapsHead);

//print_r($tripMapsHead);
//print_r($allTripMaps);

// Restructure
$allTripMaps = [];

foreach ($allTripMapsPre as $key => $value) {

    //if ( $value[0] != "-" )
    if ( in_array($value[0],array_column($settings["trip-categories"],"category-abbreviation")) ) {

        // Pad $value with nulls if it's shorter than $tripMapsHead
        while (count($value) < count($tripMapsHead)) {
            $value[] = null;
        }
        $allTripMaps[$key] = array_combine($tripMapsHead, $value);
    }
}

if ( ($settings["sheet-sort-order"]["map"]["reversed"] ?? false) === true ) {
    $allTripMaps = array_reverse($allTripMaps);
}

//print_r($allTripMaps);

// ### LANGUGAGE FILE

if ( file_exists("lang/".$settings["app-language"].".yml") ) {
    $translation = yaml_parse_file("lang/".$settings["app-language"].".yml");
    $appLanguage = $settings["app-language"];
} else {
    $appLanguage = "en";
}

?>
