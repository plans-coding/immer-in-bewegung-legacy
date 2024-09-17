<?php

//header('Content-Type: application/vnd.google-earth.kml+xml');
//header("Content-Disposition: attachment; filename=karta.kml");

include '_data.php';

echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
echo '<kml xmlns="http://www.opengis.net/kml/2.2">'."\n";
echo '<Document>'."\n"; // Add the missing <Document> tag

switch ($_GET["type"]) {
	
	case 'overview':
	require("kml/kml_trip_overview.php");
	if ($_GET["id"]=="") { echo 'Ingen resa angiven.'; }
	break;
	
	case 'accommodation':
	require("kml/kml_trip_accommodation.php");
	if ($_GET["id"]=="") { echo 'Ingen resa angiven.'; }
	break;
	
	case 'assets':
	require("kml/kml_trip_assets.php");
	if ($_GET["id"]=="") { echo 'Ingen resa angiven.'; }
	break;
	
	case 'physical_video':
	require("kml/kml_trip_physical_video.php");
	if ($_GET["id"]=="") { echo 'Ingen resa angiven.'; }
	break;
	
	case 'accommodation_country':
	require("kml/kml_map_accommodation_country.php");
	break;

	case 'all_accommodation':
	require("kml/kml_map_all_accommodation.php");
	break;

	case 'all_overall_route':
	require("kml/kml_map_all_overall_route.php");
	break;
	
	default:
	// Optional: Handle unexpected values
	echo 'Invalid type specified.';
	break;

}

echo '</Document>'."\n";
echo '</kml>'."\n";

?>