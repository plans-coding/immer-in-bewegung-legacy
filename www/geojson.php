<?php

include '_data.php';

switch ($_GET["type"]) {
	
	case 'overview':
	require("geojson/geojson_trip_overview.php");
	if ($_GET["id"]=="") { echo 'Ingen resa angiven.'; }
	break;
	
	case 'accommodation':
	require("geojson/geojson_trip_accommodation.php");
	if ($_GET["id"]=="") { echo 'Ingen resa angiven.'; }
	break;
	
	case 'assets':
	require("geojson/geojson_trip_assets.php");
	if ($_GET["id"]=="") { echo 'Ingen resa angiven.'; }
	break;
	
	case 'physical_video':
	require("geojson/geojson_trip_physical_video.php");
	if ($_GET["id"]=="") { echo 'Ingen resa angiven.'; }
	break;
	
	case 'accommodation_country':
	require("geojson/geojson_map_accommodation_country.php");
	break;

	case 'all_accommodation':
	require("geojson/geojson_map_all_accommodation.php");
	break;

	case 'all_overall_route':
	require("geojson/geojson_map_all_overall_route.php");
	break;
	
	// Not used yet
	case 'plugin-immich-physical-asset-map':
	require($settings["plugin"]["immich-physical-asset-map"]["initiating-file"]);
	break;

	default:
	// Optional: Handle unexpected values
	echo 'Invalid type specified.';
	break;

}

?>