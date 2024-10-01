<?php

$living_no = 1;
$geojson = [
    'type' => 'FeatureCollection',
    'features' => []
];

// Iterate over trip details and process the coordinates based on the country filter
foreach ($tripDetails as $tripNumber) {
    foreach ($tripNumber as $tripDetail) {
        if ($tripDetail["AccommodationCountry"] == $_GET["country"]) {
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

                // Add a GeoJSON Point feature for the accommodation
                $geojson['features'][] = [
                    'type' => 'Feature',
                    'geometry' => [
                        'type' => 'Point',
                        'coordinates' => [floatval(trim($coordinate[1])), floatval(trim($coordinate[0]))]
                    ],
                    'properties' => [
                        'name' => ($translation["map-pin"]["accommodation-night"] ?? 'Accommodation, night').' ' . $living_no . ': ' . explode(",", $tripDetail["Accommodation"])[0],
                        'description' => "<b>".($translation["map-pin"]["accommodation"] ?? 'Accommodation').":</b> " . $tripDetail["Accommodation"] . 
                                         "<br /><b>".($translation["map-pin"]["date"] ?? 'Date').":</b> " . $tripDetail["Date"] . 
                                         " <b>".($translation["map-pin"]["trip"] ?? 'Trip').":</b> <a href=\"trip.php?id=" . 
                                         $tripNumber2ID[$tripDetail["TripNumber"]] . 
                                         "#" . $tripDetail["Date"] . "\">" . 
                                         $tripNumber2ID[$tripDetail["TripNumber"]] . 
                                         "</a> <b>".($translation["map-pin"]["coordinates"] ?? 'Coordinates').":</b> " . $original
                    ]
                ];
            }

            $living_no++;
        }
    }
}

// Set headers and output GeoJSON
header('Content-Type: application/json');
echo json_encode($geojson, JSON_PRETTY_PRINT);

?>