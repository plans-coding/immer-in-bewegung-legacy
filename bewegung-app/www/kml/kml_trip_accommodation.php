<?php

$living_no = 1;
$locations = []; // Initialize an array to store coordinates for the LineString
$kml = "";

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

        // Add the location for LineString
        $locations[] = [
            'coordinates' => [trim($coordinate[1]), trim($coordinate[0])]
        ];

        // Add KML Placemark for the point
        $kml .= '  <Placemark>' . PHP_EOL;
        $kml .= '    <name>'.($translation["map-pin"]["accommodation-night"] ?? 'Accommodation, night').' ' . $living_no . ': ' . explode(",", $tripDetail["Accommodation"])[0] . '</name>' . PHP_EOL;
        $kml .= '    <description><![CDATA[<b>'.($translation["map-pin"]["accommodation"] ?? 'Accommodation').':</b> ' . $tripDetail["Accommodation"] . '<br /><b>'.($translation["map-pin"]["date"] ?? 'Date').':</b> ' . $tripDetail["Date"] . ' <b>'.($translation["map-pin"]["coordinates"] ?? 'Coordinates').':</b> ' . $original . ']]></description>' . PHP_EOL;
        $kml .= '    <Point>' . PHP_EOL;
        $kml .= '      <coordinates>' . trim($coordinate[1]) . ',' . trim($coordinate[0]) . ',0</coordinates>' . PHP_EOL;
        $kml .= '    </Point>' . PHP_EOL;
        $kml .= '  </Placemark>' . PHP_EOL;
    }

    $living_no++;
}

// Add LineString feature using the coordinates from all locations
if (!empty($locations)) {
    $kml .= '  <Placemark>' . PHP_EOL;
    $kml .= '    <name>Travel Path</name>' . PHP_EOL;
    $kml .= '    <LineString>' . PHP_EOL;
    $kml .= '      <styleUrl>#lineStyle</styleUrl>' . PHP_EOL;
    $kml .= '      <coordinates>' . PHP_EOL;

    foreach ($locations as $location) {
        $kml .= '        ' . $location['coordinates'][0] . ',' . $location['coordinates'][1] . ',0 ' . PHP_EOL;
    }

    $kml .= '      </coordinates>' . PHP_EOL;
    $kml .= '    </LineString>' . PHP_EOL;
    $kml .= '  </Placemark>' . PHP_EOL;
}

// KML Styles (optional, but added for better visualization)
$kml .= '  <Style id="lineStyle">' . PHP_EOL;
$kml .= '    <LineStyle>' . PHP_EOL;
$kml .= '      <color>ff4789d0</color>' . PHP_EOL; // Note: KML uses AABBGGRR format
$kml .= '      <width>5</width>' . PHP_EOL;
$kml .= '    </LineStyle>' . PHP_EOL;
$kml .= '  </Style>' . PHP_EOL;

echo $kml;

?>
