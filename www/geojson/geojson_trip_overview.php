<?php

$living_no = 1;
$locations = []; // Initialize an array to store coordinates for the LineString
$features = [];

$letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$i = 0;

// Loop through all trip maps
foreach ($allTripMaps as $map) {
    if ($map["TripType"] != "-" && $map["TripType"] != "X" ) {
        if ($tripNumber2ID[$map["TripNumber"]] == $_GET["id"]) {
            // Extract coordinates
            $c = explode(",", $map["Coordinates"]);
            $longitude = str_replace(" ", "", $c[1]);
            $latitude = $c[0];
            $coordinate = [$longitude, $latitude];
            
            // Add Point feature
            $features[] = [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => $coordinate
                ],
                'properties' => [
                    'name' => $map["Place"],
                    'letter' => $letters[$i],
                ]
            ];

            // Add coordinates for LineString
            $locations[] = $coordinate;
            $i += 1;
        }
    }
}

// Add LineString feature
$features[] = [
    'type' => 'Feature',
    'geometry' => [
        'type' => 'LineString',
        'coordinates' => $locations
    ],
    'properties' => []
];

// Create GeoJSON object
$geojson = [
    'type' => 'FeatureCollection',
    'features' => $features
];

// Output GeoJSON
header('Content-Type: application/json');
echo json_encode($geojson, JSON_PRETTY_PRINT);


?>
