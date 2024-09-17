<?php

$living_no = 1;
$locations = []; // Initialize an array to store coordinates for the LineString
$geojson = [
    'type' => 'FeatureCollection',
    'features' => []
];

// Iterate over trip details and process the coordinates
foreach ($tripDetails as $tripNumber) {
    foreach ($tripNumber as $tripDetail) {
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

            // Add the location for LineString
            $locations[] = [floatval(trim($coordinate[1])), floatval(trim($coordinate[0]))];
        }

        $living_no++;
    }
}

// Add LineString feature using the coordinates from all locations
if (!empty($locations)) {
    $geojson['features'][] = [
        'type' => 'Feature',
        'geometry' => [
            'type' => 'LineString',
            'coordinates' => $locations
        ],
        'properties' => [
            'name' => 'Travel Path'
        ]
    ];
}

// Set headers and output GeoJSON
header('Content-Type: application/json');
echo json_encode($geojson, JSON_PRETTY_PRINT);


?>
