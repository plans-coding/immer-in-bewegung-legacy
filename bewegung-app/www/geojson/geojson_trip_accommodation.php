<?php

$living_no = 1;
$features = []; // Initialize an array to store GeoJSON features

foreach ($tripDetails[urldecode($_GET["id"])] as $tripDetail) {

    // Check and clean coordinates
    if (!in_array($tripDetail["AccommodationCoordinates"], ["-", "", "?"])) {
        $original = $tripDetail["AccommodationCoordinates"];

        // Clean coordinates string
        $tripDetail["AccommodationCoordinates"] = str_replace(
            ["(generisk)", "(ort)", "(relaterad)", "(ungefär)", "(osäker)", "?"],
            "",
            $tripDetail["AccommodationCoordinates"]
        );

        // Clean accommodation name
        $tripDetail["Accommodation"] = str_replace("&", "and", $tripDetail["Accommodation"]);

        // Split coordinates
        $coordinate = explode(",", $tripDetail["AccommodationCoordinates"]);

        // Add the location as a GeoJSON Point feature
        $features[] = [
            'type' => 'Feature',
            'geometry' => [
                'type' => 'Point',
                'coordinates' => [trim($coordinate[1]), trim($coordinate[0])]
            ],
            'properties' => [
                'name' => ($translation["map-pin"]["accommodation-night"] ?? 'Accommodation, night') ." " . $living_no . ': ' . explode(",", $tripDetail["Accommodation"])[0],
                'description' => '<b>'.($translation["map-pin"]["accommodation"] ?? 'Accommodation').':</b> ' . $tripDetail["Accommodation"] . '<br /><b>'.($translation["map-pin"]["date"] ?? 'Date').':</b> ' . $tripDetail["Date"] . ' <b>'.($translation["map-pin"]["coordinates"] ?? 'Coordinates').':</b> ' . $original
            ]
        ];

        $living_no++;
    }
}

// Add LineString feature using the coordinates from all locations
if (!empty($features)) {
    $lineCoordinates = [];
    foreach ($features as $feature) {
        if ($feature['geometry']['type'] === 'Point') {
            $lineCoordinates[] = $feature['geometry']['coordinates'];
        }
    }

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

