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
$response = file_get_contents($immichApiServer."map/markers?fileCreatedAfter=".$fileCreatedAfter."&fileCreatedBefore=".$fileCreatedBefore, false, $context);

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

foreach ($data as $photo) {
	echo '<Placemark>'."\n";
	echo '  <name><![CDATA[<img style="width:150pt;" src="http://127.0.0.1:2283/api/assets/'.$photo["id"].'/thumbnail?size=preview" />]]></name>'."\n";
	echo '  <description></description>'."\n";
	echo '  <Point>'."\n";
	$polyline_assets .= $photo["lon"].','.$photo["lat"].',0'."\n";
	echo '    <coordinates>'.$photo["lon"].','.$photo["lat"].',0</coordinates>'."\n";
	echo '  </Point>'."\n";
	echo '<styleUrl>#immich_asset_map</styleUrl>';
	echo '</Placemark>'."\n";
}


?>
<?php if ( $polyline_assets != "" ) { ?>
      <Placemark>
        <LineString>
          <coordinates><?php echo trim($polyline_assets); ?></coordinates>
          <tessellate>1</tessellate>
        </LineString>
	<styleUrl>#line_image</styleUrl>
      </Placemark>
<?php } ?>