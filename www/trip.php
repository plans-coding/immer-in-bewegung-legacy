<?php

$pageTitle = "Trip Events";
$contentMargin = "auto";
include '_head.php';
include '_data.php';
$underline="";
$title="";

$trip_id=$_GET["id"];

// Theme color - can be changed if same color is preferred
$color = $trip_settings[$tripBlocks[urldecode($_GET["id"])]["TripType"]]["Color"];
$color_header = "#000";

?>


<style>
.trip_table_details {
  table-layout: fixed;
  width: 100% ;
}
</style>

<!-- Andra resor navigering -->
<?php

// All trips
$selectedIndexAllTrips = array_search( urldecode($_GET["id"]), array_column($tripBlocks, "TripID"));

$prevIndexAllTripsIndex = ( $selectedIndexAllTrips-1+sizeof(array_column($tripBlocks, "TripID")) ) % sizeof(array_column($tripBlocks, "TripID"));
$prevTripIDAllTrips = array_column($tripBlocks, "TripID")[$prevIndexAllTripsIndex];

$nextIndexAllTripsIndex = ( $selectedIndexAllTrips+1 ) % sizeof(array_column($tripBlocks, "TripID"));
$nextTripIDAllTrips = array_column($tripBlocks, "TripID")[$nextIndexAllTripsIndex];

// Current trip type
$triptype = $tripBlocks[urldecode($_GET["id"])]["TripType"];
$filteredArray = array_filter($tripBlocks, function ($item) use ($triptype) {
    return $item['TripType'] == $triptype;
});

$selectedIndexCurrentTripType = array_search( urldecode($_GET["id"]), array_column($filteredArray, "TripID"));

$prevIndexCurrentTripTypeIndex = ( $selectedIndexCurrentTripType-1+sizeof(array_column($filteredArray, "TripID")) ) % sizeof(array_column($filteredArray, "TripID"));
$prevTripIDCurrentTripType = array_column($filteredArray, "TripID")[$prevIndexCurrentTripTypeIndex];

$nextIndexCurrentTripTypeIndex = ( $selectedIndexCurrentTripType+1 ) % sizeof(array_column($filteredArray, "TripID"));
$nextTripIDCurrentTripType = array_column($filteredArray, "TripID")[$nextIndexCurrentTripTypeIndex];

?>
<table id="trip_nav" style="width:100%;margin-bottom:10pt;background-color:#e1e1e1;font-family: 'Francois+One', sans-serif;">
<style>
.bar-all-trip-type { color:#ffffff;display:flex;justify-content:space-between;align-items:center; }
.bar-all-trip-type > div { flex:1; }
.bar-trip-button > a { cursor:pointer; }
</style>
<tr><td colspan="2" style="background-color:grey;color:#ffffff;text-align:center;">

	<div class="bar-all-trip-type">
		<div class="bar-trip-button" style="text-align:left;">
		<a href="?id=<?php echo $prevTripIDAllTrips; ?>" style="color:#fff;"
			onmouseover="document.getElementById('prevTripIDAllTrips').style.visibility='visible';"
			onmouseout="document.getElementById('prevTripIDAllTrips').style.visibility='hidden';">
			<img src="img/arrow2.svg" style="height:18pt;margin-top:-2.5pt;margin-right:5pt;vertical-align:middle;">
			<span id="prevTripIDAllTrips" style="visibility:hidden;"><?php echo $prevTripIDAllTrips; ?></span>
		</a>
	</div>
		<div>
			<select id="selectTripTypeAll" onchange="window.location.href = 'trip.php?id='+this.value" style="background-color:grey;color:#fff;font-size:12pt;padding:2pt;display:inline-block;width:100pt;border-color:#fff;">
				<option value="<?php echo urldecode($_GET["id"]); ?>" selected style="text-align:center;">All trips</option>
				<?php
				foreach ($tripBlocks as $tripBlock) {
					if ( urldecode($_GET["id"]) == $tripBlock["TripID"] ) { $selected=' style="background-color:#000;"'; } else { $selected=""; }
					echo '<option'.$selected.' value="'.$tripBlock["TripID"].'">'.substr($tripBlock["DepartureDate"],0,4)." ".$tripBlock["TripID"]." ".$tripBlock["OverallDestination"]."</option>";
				}
				?>
			</select>
		</div>
		<div class="bar-trip-button" style="text-align:right;">
			<a href="?id=<?php echo $nextTripIDAllTrips; ?>" style="color:#fff;"
				onmouseover="document.getElementById('nextTripIDAllTrips').style.visibility='visible';"
				onmouseout="document.getElementById('nextTripIDAllTrips').style.visibility='hidden';">
				<span id="nextTripIDAllTrips" style="visibility:hidden;"><?php echo $nextTripIDAllTrips; ?></span>
				<img src="img/arrow2.svg" style="height:18pt;margin-top:-2.5pt;margin-right:5pt;vertical-align:middle;transform:rotate(180deg);">
			</a>
		</div>
	</div>

</td></tr>
	<!-- Mellanrum -->
<tr><td colspan="2" style="background-color:<?php echo $trip_settings[$tripBlocks[urldecode($_GET["id"])]["TripType"]]["Color"]; ?>;color:#ffffff;text-align:center;">
	<div class="bar-all-trip-type">
		<div class="bar-trip-button" style="text-align:left;">
			<a href="?id=<?php echo $prevTripIDCurrentTripType; ?>" style="color:#fff;"
				onmouseover="document.getElementById('prevTripIDCurrentTripType').style.visibility='visible';"
				onmouseout="document.getElementById('prevTripIDCurrentTripType').style.visibility='hidden';">
				<img src="img/arrow2.svg" style="height:18pt;margin-top:-2.5pt;margin-right:5pt;vertical-align:middle;">
				<span style="visibility:hidden;" id="prevTripIDCurrentTripType"><?php echo $prevTripIDCurrentTripType; ?></span>
			</a>
		</div>
		<div>
			<select id="selectTripTypeCurrent" onchange="window.location.href = 'trip.php?id='+this.value" style="background-color:<?php echo $trip_settings[$tripBlocks[urldecode($_GET["id"])]["TripType"]]["Color"]; ?>;color:#fff;font-size:12pt;padding:2pt;display:inline-block;width:100pt;border-color:#fff;">
			<option value="<?php echo urldecode($_GET["id"]); ?>" selected style="text-align:center;"><?php echo $trip_settings[$tripBlocks[urldecode($_GET["id"])]["TripType"]]["Description"]; ?></option>
			<?php
				// Om du vill ha helt samma prefix, tex bara F-SE: substr($tripBlock["TripID"], 0, strrpos($tripBlock["TripID"], '-')) == substr(urldecode($_GET["id"]), 0, strrpos(urldecode($_GET["id"]), '-'))
				foreach ($tripBlocks as $tripBlock) {
					if ( $tripBlocks[urldecode($_GET["id"])]["TripType"] == $tripBlocks[$tripBlock["TripID"]]["TripType"] ) {
						if ( urldecode($_GET["id"]) == $tripBlock["TripID"] ) { $selected=' style="background-color:#000;"'; } else { $selected=""; }
						echo '<option'.$selected.' value="'.$tripBlock["TripID"].'">'.substr($tripBlock["DepartureDate"],0,4)." ".$tripBlock["TripID"]." ".$tripBlock["OverallDestination"]."</option>";
					}
				}
				?>
			</select>
		</div>
		<div class="bar-trip-button" style="text-align:right;">
			<a href="?id=<?php echo $nextTripIDCurrentTripType; ?>" style="color:#fff;"
				onmouseover="document.getElementById('nextTripIDCurrentTripType').style.visibility='visible';"
				onmouseout="document.getElementById('nextTripIDCurrentTripType').style.visibility='hidden';">
			<span style="visibility:hidden;" id="nextTripIDCurrentTripType"><?php echo $nextTripIDCurrentTripType; ?></span> <img src="img/arrow2.svg" style="height:18pt;margin-top:-2.5pt;margin-right:5pt;vertical-align:middle;transform:rotate(180deg);">
			</a>	
		</div>
	</div>

</td></tr>
</table>
<!-- Andra resor navigering slut -->

<h1 class="normal"><?php echo urldecode($_GET["id"]); ?> to <?php echo $tripBlocks[urldecode($_GET["id"])]["OverallDestination"]; ?></h1>

<table class="trip_table_details" style="width:100%;">

<tr><td colspan="2" style="background-color:<?php echo $color_header; ?>;color:#ffffff;text-align:center;">Summary</td></tr>
<tr><td colspan="2">

<div style="padding:10pt;" id="info">

<!-- DYNAMSIK KARTA -->
<!-- width och max-width kan tydligen användas samtidigt -->
<div id="map" style="float:right;width:500pt;max-width:100%;height:469pt;margin-left:10pt;margin-bottom:10pt;">

<div style="width:100%;height:100%;" id="overview_map"></div>
<div style="width:100%;height:100%;visibility:hidden;" id="info_map"></div>

</div>

<!-- DYNAMISK KARTA -->

<!-- BIBLIOTEK -->

	<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <link href="https://unpkg.com/leaflet-fullscreen@1.0.2/dist/leaflet.fullscreen.css" rel="stylesheet" />

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-polylinedecorator/dist/leaflet.polylineDecorator.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster-src.js"></script>
    <script src="https://unpkg.com/leaflet-fullscreen@1.0.2/dist/Leaflet.fullscreen.js"></script>

	<style>
		.leaflet-control-attribution a { color:#000 !important; }
                
        /*input[type="checkbox"] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            width: 10pt;
            height: 10pt;
            border: 2px solid #555;
            background: white;
        }

        input[type="checkbox"]:checked {
            background: green;
        }

        .leaflet-control-layers-overlays label {
            display: flex;
            align-items: center;
        }*/

	</style>

<!-- BIBLIOTEK SLUT -->

<script>
    // Initialize the map
    var map = L.map('map').setView([59.32, 18.06], 5);

    // Add a tile layer (OpenStreetMap in this example)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '<a href="kml.php?type=overview&amp;id=<?php echo $_GET["id"]; ?>">Overview KML</a>, <a href="kml.php?type=accommodation&amp;id=<?php echo $_GET["id"]; ?>">Accommodation KML</a>, <a href="kml.php?type=assets&amp;id=<?php echo $_GET["id"]; ?>">Assets KML</a>',
        maxZoom: 19
    }).addTo(map);

    // Add fullscreen control
    map.addControl(new L.Control.Fullscreen());

    // Define different icons
    var icons = {
        //'Overview': L.icon({ iconUrl: 'img/plans_marker.php?color=000000&letter=A', iconSize: [32, 32] }),
        'Accommodation': L.icon({ iconUrl: 'img/plans_house.php?color=4798d0', iconSize: [32, 32] }),
        'Assets': L.icon({ iconUrl: 'img/plans_asset.php?color=77071d', iconSize: [32, 32] }),
    };

    // Initialize MarkerClusterGroup
    var markerClusters = L.markerClusterGroup();

    // Helper function to transform coordinates if needed
    function transformCoordinates(coords) {
        return coords.map(coord => [coord[1], coord[0]]); // Swap [lat, lon] to [lon, lat]
    }

    // Function to handle adding GeoJSON data to a layer
    function createGeoJSONLayer(geojsonData, color, layerGroup, icon) {
        return L.geoJSON(geojsonData, {
            style: function (feature) {
                if (feature.geometry.type === 'LineString') {
                    return { color: color }; // Set line color
                }
            },
            pointToLayer: function (feature, latlng) {
                if (feature.geometry.type === 'Point') {

                    if (layerGroup == layerGroups['Overview']){
                        var letter = feature.properties.letter || 'X'; // Fallback
                        icon = L.icon({
                            iconUrl: `img/plans_marker.php?color=<?php echo str_replace("#","",$color); ?>&letter=${letter}`,
                            iconSize: [32, 32]
                        });
                    }

                    // Create a marker with the specified icon
                    return L.marker(latlng, { icon: icon });
                    // Add the marker to the MarkerClusterGroup
                    markerClusters.addLayer(marker);
                }
            },
            onEachFeature: function (feature, layer) {
                if (feature.geometry.type === 'Point') {
                    // Add a popup to each marker with properties
                    var popupContent = '';
                    if (feature.properties) {
                        // Generate popup content from properties
                        /*for (var key in feature.properties) {
                            if (feature.properties.hasOwnProperty(key)) {
                                popupContent += `<strong>${key}:</strong> ${feature.properties[key]}<br>`;
                            }
                        }*/
                        if (feature.properties.hasOwnProperty('name')) {
                            popupContent += `<strong>${feature.properties['name']}</strong><br />`;
                        }
                        if (feature.properties.hasOwnProperty('description')) {
                            popupContent += `${feature.properties['description']}`;
                        }
						if (feature.properties.hasOwnProperty('photoId')) {
							var thumbnail = `<?php echo $settings["immich-settings"]["immich-server-address"]; ?>api/assets/${feature.properties['photoId']}/thumbnail`;
                            var photoUrl = `<?php echo $settings["immich-settings"]["immich-server-address"]; ?>photos/${feature.properties['photoId']}`;
                            popupContent += `<a target="_blank" href="${photoUrl}"><img style="width:100pt;" src="${thumbnail}" /></a>`;
                        }
                    }
                    layer.bindPopup(popupContent);
                }
                // Add each layer to the layer group
                layerGroup.addLayer(layer);
            }
        });
    }

    // Function to add polyline decorators
    function addPolylineDecorators(layerGroup) {
        layerGroup.eachLayer(function(layer) {
            if (layer instanceof L.Polyline) {
                // Add an arrow decorator to the polyline
                var decorator = L.polylineDecorator(layer, {
                    patterns: [
                        { 
                            offset: 0,
                            repeat: 20,
                            symbol: L.Symbol.arrowHead({
                                pixelSize: 10,
                                pathOptions: { color: layer.options.color, weight: 2 }
                            })
                        }
                    ]
                });
                // Add the decorator to the layerGroup, not directly to the map
                layerGroup.addLayer(decorator);
            }
        });
    }

    // Function to calculate combined bounds of all layer groups
    function getCombinedBounds(layerGroups) {
        var combinedBounds = L.latLngBounds([]);
        for (var key in layerGroups) {
            if (layerGroups.hasOwnProperty(key)) {
                var bounds = layerGroups[key].getBounds();
                combinedBounds.extend(bounds);
            }
        }
        return combinedBounds;
    }


    // Fetch and create layers for multiple GeoJSON files
    var layerGroups = {
        'Overview': L.featureGroup(),
        'Accommodation': L.featureGroup(),
        'Assets': L.featureGroup()
    };

    Promise.allSettled([
        fetch('geojson.php?type=overview&id=<?php echo $_GET["id"]; ?>').then(response => response.json()),
        fetch('geojson.php?type=accommodation&id=<?php echo $_GET["id"]; ?>').then(response => response.json()),
        
    <?php if ( isset($settings["inactivate-day-photos-button"]) && $settings["plugin"]["immich-physical-asset-map"]["activated"] === true ) { ?>
        fetch('geojson.php?type=plugin-immich-physical-asset-map&id=<?php echo $_GET["id"]; ?>').then(response => response.json())
        
    <?php } else { ?>
        
        fetch('geojson.php?type=assets&id=<?php echo $_GET["id"]; ?>').then(response => response.json())
        
    <?php } ?>

    ])
    .then(results => {
        if (results[0].status === 'fulfilled') {
            createGeoJSONLayer(results[0].value, '<?php echo $color; ?>', layerGroups['Overview'], icons['Overview']);
            addPolylineDecorators(layerGroups['Overview']);
        } else {
            console.error('Failed to fetch Overview GeoJSON:', results[0].reason);
        }

        if (results[1].status === 'fulfilled') {
            createGeoJSONLayer(results[1].value, '#4798d0', layerGroups['Accommodation'], icons['Accommodation']);
            addPolylineDecorators(layerGroups['Accommodation']);
        } else {
            console.error('Failed to fetch Accommodation GeoJSON:', results[1].reason);
        }

        if (results[2].status === 'fulfilled') {
            createGeoJSONLayer(results[2].value, '#77071d', layerGroups['Assets'], icons['Assets']);
            addPolylineDecorators(layerGroups['Assets']);
        } else {
            console.error('Failed to fetch Assets GeoJSON:', results[2].reason);
        }

        // Add layer controls
        L.control.layers(null, layerGroups, {collapsed: false}).addTo(map);

        map.addLayer(layerGroups['Overview']);

        // Fit map to the bounds of the first layer as default
        //map.fitBounds(layerGroups['Layer 1'].getBounds());

        // Fit map to combined bounds of all layers
        var combinedBounds = getCombinedBounds(layerGroups);
        map.fitBounds(combinedBounds);

    })
    .catch(error => console.error('Error fetching GeoJSON data:', error));
</script>

<script>
/* ÄNDRAR TOPPFÄLTSFÄRGEN PÅ ANDROID TILL SAMMA SOM RESETYPEN */
document.querySelector('meta[name="theme-color"]').setAttribute('content', '<?php echo $color; ?>');
</script>


<!-- DYNAMISK KARTA SLUT -->


<div id="desc" style="padding-bottom:10pt;"><?php echo $tripBlocks[urldecode($_GET["id"])]["TripDescription"]; ?></div>

<?php //if (strpos($_GET["id"],"-SE-")) { $position=""; } else { $position=" Sweden"; } ?>
<div><b>Departure Date<?php //echo $position; ?>:</b> <span id="total_days"><?php echo $tripBlocks[urldecode($_GET["id"])]["DepartureDate"]; ?></span></div>
<div><b>Return Date<?php //echo $position; ?>:</b> <span id="total_days"><?php echo $tripBlocks[urldecode($_GET["id"])]["ReturnDate"]; ?></span></div>
<div><b>Number of Days:</b> <span id="total_days"><?php echo $tripBlocks[urldecode($_GET["id"])]["NumberOfDays"]; ?></span></div>
<div><b>ID:</b> <span id="span_id"><?php echo $_GET["id"]; ?></span></div>
<div><b>Number of Countries:</b> <span id="total_countries"><?php

				// ### Räkna antalet länder
				// Ta bort innehåll i hakparenteser och hakparenteserna själva
				$total_countries = preg_replace("/\[[^)]+\]/","",$tripBlocks[urldecode($_GET["id"])]["CountryTripMovements"]);

				// Ta bort vanliga parenteser
				$total_countries = str_replace('(','',$total_countries);
				$total_countries = str_replace(')','',$total_countries);

				// Ta bort dubbla mellanslag
				$total_countries = str_replace('  ',' ',$total_countries);

				// Dela upp element
				$total_array = explode(',',$total_countries);

				// Ta bort dubbletter
				$total_array = array_unique($total_array);

				// Ta bort element som börjar med DK, SE eller NOD eller STO
				foreach ($total_array as $key => $value) {
					if (strpos($value,'SE') !== false) {
						unset($total_array[$key]);
					}
					if (strpos($value,'DK') !== false) {
						unset($total_array[$key]);
					}
					if (strpos($value,'NOD') !== false) {
						unset($total_array[$key]);
					}
					if (strpos($value,'STO') !== false) {
						unset($total_array[$key]);
					}
					if (strpos($value,'Sverige') !== false) {
						unset($total_array[$key]);
					}

				}

				//Räkna antalet element
				echo $amount_countries = count($total_array);


?></span></div>

<div style="padding-top:10pt;"><b>Country Trip Movements:</b><br><span id="countries"><?php


// RÖRELSER

$parts = explode(",",$tripBlocks[urldecode($_GET["id"])]["CountryTripMovements"]);
$parts = array_map('trim', $parts);
$i=0;
foreach ($parts as $part) {
	if ( substr($part,0,1) == "{" ) {
		preg_match_all('/\{(.*?)\}/', $part, $matches);
		$node = explode(" ",$matches[1][0])[0];
		$comment = explode(" ",$matches[1][0])[1] ?? null;;
		echo '<div style="display:inline-flex;max-width:190pt;margin-top:1pt;margin-bottom:1pt;padding:2pt 2pt 0pt 2pt;border-radius:2pt;background-color:#808080;color:#fff;margin-right:2pt;"><div style="'.$underline.'padding:1pt;" title="'.$title.'">'.$node.'</div>';
		if ($comment) { echo '<div style="display:inline-block;height:13pt;margin-left:4pt;padding-left:2pt;padding-right:2pt;border-radius:2pt;color:#000;background-color:#f3f3f3;font-size:10pt;padding-top:3pt;">'.$comment.'</div>'; }
		echo '</div>';
	} elseif ( substr($part,0,2) == "**" ) {
		echo '<div style="display:inline-flex;max-width:190pt;margin-top:1pt;margin-bottom:1pt;padding:2pt 2pt 0pt 2pt;border-radius:2pt;"><span style="border-bottom: 1pt dashed;" title="Very short visit of without significant importance">'.substr($part,2).'</span></div>';
	} elseif ( substr($part,0,1) == "*" ) {
		echo '<div style="display:inline-flex;max-width:190pt;margin-top:1pt;margin-bottom:1pt;padding:2pt 2pt 0pt 2pt;border-radius:2pt;"><span style="border-bottom: 1pt solid;" title="Shorter visit of significant importance">'.substr($part,1).'</span></div>';
	} elseif ( substr($part,0,1) == "+" ) {
		echo '<div style="display:inline-flex;max-width:190pt;margin-top:1pt;margin-bottom:1pt;padding:2pt 2pt 0pt 2pt;border-radius:2pt;"><span style="border-bottom: 1pt solid #1d655e;" title="Restore, counts only if * and ** count">'.substr($part,1).'</span></div>';
	} else {
		echo $part;
	}
	$i++;

	if ( (sizeof($parts)) != $i ) {
		echo '<img src="img/plans_arrow.php?color=000000" style="height:10pt;margin-top:-2.5pt;margin-left:3pt;margin-right:3pt;vertical-align:middle;transform: rotate(180deg);">';
	}
	
}
// RÖRELSER SLUT

?></span></div>


<div style="padding-top:10pt;"><b>Overall Route:</b><br><span id="route"><?php

	preg_match_all('/\{(.*?)\}/', $tripBlocks[urldecode($_GET["id"])]["OverallMapPins"], $places);
	$nb="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$i=0;

	foreach ($places[1] as $place) {
		//$marker_color
		echo '<div style="margin-top:5pt;height:20pt;display:inline-block;white-space:nowrap;"><img src="img/plans_marker.php?color=808080'.''.'&letter='.$nb[$i].'" style="height:18pt;vertical-align:middle;margin-top:-2.5pt;" /> '.explode(",",str_replace("@","",$place))[0].'</div> ';
		$i++;
	}

?>
</span>
</div>


<?php
if ( isset($settings["plugin"]["immich-summary-album"]["activated"]) && $settings["plugin"]["immich-summary-album"]["activated"] === true ) {
	include $settings["plugin"]["immich-summary-album"]["initiating-file"];
}
?>

</div>

<br style="clear:both;" />

</div>

</td></tr>

<tr><td colspan="2" style="background-color:<?php echo $color_header; ?>;color:#ffffff;text-align:center;">Day per day</td></tr>
<tr><td colspan="2" style="">
<?php

$night_no=1;
echo '<table>';

foreach ($tripDetails[$_GET["id"]] as $tripDetail) {
	// explode(" ",$tripDetail["HelpText"])[2] <- for weekday from spreadsheet
	echo '<tr><td style="vertical-align:top;padding-right:20pt;width:100pt;"><b><a name="'.$tripDetail["Date"].'"></a>'.$tripDetail["Date"].'</b><br />'.date('l',strtotime($tripDetail["Date"])).'</td><td style="vertical-align:top;">'.str_replace("&lt;BR&gt;","<br />",$tripDetail["Events"]).'<br /><a href="images.php?trip='.$_GET["id"].'&date='.str_replace("-","",$tripDetail["Date"]).'" style="color:'.$color.';text-decoration:none;">';
	if (isset($settings["inactivate-day-photos-button"])) {
		if ( !in_array($_GET["id"], explode(", ",$settings["inactivate-day-photos-button"]) ) ) { echo '<div class="iib-action-button">Show photos</div>'; }
	} else {
		echo '<div class="iib-action-button">Show photos</div>';
	}
	if ( isset($settings["plugin"]["additional-trip-objects"]["activated"]) && $settings["plugin"]["additional-trip-objects"]["activated"] === true ) {
		include $settings["plugin"]["additional-trip-objects"]["initiating-file"];
	}
	echo '</td></tr>';

	echo '<tr><td style="border-bottom:1pt solid #000000;padding-right:20pt;width:100pt;"></td><td style="border-bottom:1pt solid #000000;"><img style="height:0.9em;" src="img/house.svg" /> <div id="nightNumber" style="position:absolute;display:inline-block;background-color:#000;border-radius:20pt;height:15pt;width:15pt;color:#fff;font-size:8pt;text-align:center;line-height:15pt;margin-top:1pt;">'.$night_no.'</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

	if ($tripDetail["AccommodationCoordinates"]!="-") { echo '<a target="_blank" href="https://www.google.com/maps/?q='.$tripDetail["AccommodationCoordinates"].'" style="color:'.$color.';text-decoration:none;">'; }
	echo $tripDetail["Accommodation"].' &nbsp;&nbsp;<img style="height:0.9em;" src="img/coordinate.svg" /> '.$tripDetail["AccommodationCountry"].', '.$tripDetail["AccommodationCoordinates"];
	if ($tripDetail["AccommodationCoordinates"]!="-") { echo '</a>'; }

	echo ' &nbsp;&nbsp; </td></tr>';
	$night_no+=1;
		
}
echo '</table>';
?>

</td></tr>
</table>


<?php include '_foot.php'; ?>
