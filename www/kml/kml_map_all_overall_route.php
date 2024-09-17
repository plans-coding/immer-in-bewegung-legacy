<?php
/*
foreach ($maps_full as $map) {
    if ( in_array($tripNumber2ID[$map[0].$map[1]],$filter) == true ) {
    if ( $map[0]=="U" || $map[0]=="D" || $map[0]=="I" ) {
    //print_r($map);
        if ($map[1]==$current) {
    
            $c=explode(",",$map[5]);
            $coordinate.=str_replace(" ","",$c[1]).','.$c[0].',0 ';
    
        } else {
        ?>
    
          <Placemark>
            <LineString>
              <coordinates><?php echo $coordinate; ?></coordinates>
              <tessellate>1</tessellate>
            </LineString>
          </Placemark>
    
        <?php	
            $coordinate="";
            $c=explode(",",$map[5]);
            $coordinate.=str_replace(" ","",$c[1]).','.$c[0].',0 ';
            
            $current=$map[1];		
    
        }
    
    }
    }
    
    }

*/

$living_no = 1;
$locations = []; // Initialize an array to store coordinates for the LineString
$kml = "";
//print_r($tripDetails);
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
            $locations[] = [
                'coordinates' => [trim($coordinate[1]), trim($coordinate[0])]
            ];
        }

        $living_no++;
    }
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
$kml .= '      <color>ff5e651d</color>' . PHP_EOL; // Note: KML uses AABBGGRR format
$kml .= '      <width>2</width>' . PHP_EOL;
$kml .= '    </LineStyle>' . PHP_EOL;
$kml .= '  </Style>' . PHP_EOL;


echo $kml;

?>
