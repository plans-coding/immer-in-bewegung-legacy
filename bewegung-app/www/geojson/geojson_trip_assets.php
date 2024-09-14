<?php

$immichApiKey = $settings["immich-settings"]["immich-server-api-key"];
$immichApiServer = $settings["immich-settings"]["immich-server-api-address"];

function isValidTime($string) {
    $pattern = '/^(?:[01]\d|2[0-3]):[0-5]\d$/';
    return preg_match($pattern, $string) === 1;
}

$photoStarttime = isValidTime($tripBlocks[$_GET["id"]]["PhotoStarttime"]) ? $tripBlocks[$_GET["id"]]["PhotoStarttime"] : '00:00';
$photoEndtime = isValidTime($tripBlocks[$_GET["id"]]["PhotoEndtime"]) ? $tripBlocks[$_GET["id"]]["PhotoEndtime"] : '23:59';

$fileCreatedAfter = $tripBlocks[$_GET["id"]]["DepartureDate"]."T".$photoStarttime.":00.000Z";
$fileCreatedBefore = $tripBlocks[$_GET["id"]]["ReturnDate"]."T".$photoEndtime.":59.999Z";

$context = stream_context_create([
    'http' => [
        'header' => "x-api-key: $immichApiKey\r\n"
    ]
]);

// Make the request and get the response
$response = @file_get_contents($immichApiServer."map/markers?fileCreatedAfter=".$fileCreatedAfter."&fileCreatedBefore=".$fileCreatedBefore, false, $context);

if ( !isset($response) || $response == "" ) { die; }

$data = json_decode($response, true);

//print_r($data);

$markersPhoto = [];

/*
foreach ($data as $photo) {
	$markersPhoto[$photo["id"]] = ["lat" => $photo["lat"], "lon" => $photo["lon"]];
}

print_r($markersPhoto);
*/

$polyline_assets = "";


$features = [];
$lineCoordinates = [];

// Process each photo and create GeoJSON Point features
foreach ($data as $photo) {
    $features[] = [
        'type' => 'Feature',
        'geometry' => [
            'type' => 'Point',
            'coordinates' => [(float)$photo["lon"], (float)$photo["lat"]]
        ],
        'properties' => [
            'photoId' => $photo["id"]
        ]
    ];

    // Collect coordinates for the LineString
    $lineCoordinates[] = [(float)$photo["lon"], (float)$photo["lat"]];
}

// Add LineString feature if coordinates are available
if (!empty($lineCoordinates)) {
    $features[] = [
        'type' => 'Feature',
        'geometry' => [
            'type' => 'LineString',
            'coordinates' => $lineCoordinates
        ],
        'properties' => [
            'name' => 'Travel Path'
        ]
    ];
}

// Create GeoJSON structure
$geojson = [
    'type' => 'FeatureCollection',
    'features' => $features
];

// Output GeoJSON
header('Content-Type: application/json');
echo json_encode($geojson, JSON_PRETTY_PRINT);

?>