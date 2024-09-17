<?php

$living_no = 1;
$locations = []; // Initialize an array to store coordinates for the LineString
$kml = "";

$polyline="";

foreach ($allTripMaps as $map) {
    if ($map["TripType"] != "-" && $map["TripType"] != "X" ) {
        if ( $tripNumber2ID[$map["TripNumber"]] == $_GET["id"] ) {
            echo '<Placemark>'."\n";
            echo '  <name>'.$map["Place"].'</name>'."\n";
            echo '  <Point>'."\n";
            $c=explode(",",$map["Coordinates"]);
            $coordinate=str_replace(" ","",$c[1]).','.$c[0].',0 ';
            $polyline.=$coordinate;
            echo '    <coordinates>'.$coordinate.'</coordinates>'."\n";
            echo '  </Point>'."\n";
            echo '</Placemark>'."\n";
        }
    }
}

?>

      <Placemark>
        <LineString>
          <coordinates><?php echo $polyline; ?></coordinates>
          <tessellate>1</tessellate>
        </LineString>
      </Placemark>