<?php
    include '_data.php';
    $pageTitle = $translation["map"]["title"] ?? "Map";
    $contentMargin = "0";
    $widthRestriction = false;
    $noFoot = true;
    include '_head.php';

    $color = "grey";
?>

<?php

$geojson = "geojson.php?type=all_overall_route";
$map_type = "";
$icon = "Accommodation";

if (isset($_GET["country"])) {
        $geojson="geojson.php?type=accommodation_country&country=".$_GET["country"];
        $icon = "Accommodation";
}

if ( isset($_GET["map"]) ){
        if ( $_GET["map"] == "all_accommodation" ) {
                $map_type = $_GET["map"];
                $geojson="geojson.php?type=all_accommodation";
                $icon = "Accommodation";
        }
}


// Find unique countries
$tripNumbers = [];
foreach ($tripDetails as $outerKey => $innerArray) {
    foreach ($innerArray as $dateKey => $detailsArray) {
        if (isset($detailsArray['AccommodationCountry'])) {
            $tripNumbers[] = $detailsArray['AccommodationCountry'];
        }
    }
}
$period = array_unique($tripNumbers);
sort($period);


$dropdown = '<select name="country_dd" id="country_dd" style="max-width:100%;font-size:16pt;padding:5pt;border:3pt solid grey;display:inline-block;" onchange="document.location=this.value">';


$selected = "";


$dropdown.='<option value="?" id="lang-map-overall-route">'.($translation["map"]["overall-route"] ?? "Overall route for all trips").'</option>';
$dropdown.='<optgroup disabled="disabled" style="margin-top: 1em;"></optgroup>';

if (isset($_GET["map"])) { if ($_GET["map"]=="all_accommodation" ) { $selected="selected"; } }

$dropdown.='<option value="?map=all_accommodation" '.$selected.' id="lang-map-all-accommodations">'.($translation["map"]["all-accommodations"] ?? "All accommodations from all countries (VERY SLOW)").'</option>';
$dropdown.='<optgroup disabled="disabled" style="margin-top: 1em;"></optgroup>';

foreach ($period as $value) {
	$country_get = isset($_GET["country"]) ? $_GET["country"] : '';
	if ($value == $country_get ) { $selected="selected"; } else { $selected=""; }
	if ($value!="-" && $value!="" && strpos($value,"?")===false && strpos($value,"(")===false) {
		$dropdown.='<option value="?country='.$value.'" '.$selected.'>'.$value.' – '.($translation["map"]["accommodations"] ?? "Accommodations").'</option>'."\n";
	}
}
$dropdown.='</select>';

?>

<div class="imagesBar">
    <div style="flex:1;text-align:center;max-width:100%;">
        <?php echo $dropdown; ?>
    </div>
</div>

        <div style="width: 100%;flex-grow:1;" id="map"></div>


<!-- BIBLIOTEK -->

        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!--<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />-->
    <link href="https://unpkg.com/leaflet-fullscreen@1.0.2/dist/leaflet.fullscreen.css" rel="stylesheet" />

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!--<script src="https://unpkg.com/leaflet-polylinedecorator/dist/leaflet.polylineDecorator.js"></script>-->
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster-src.js"></script>
    <script src="https://unpkg.com/leaflet-fullscreen@1.0.2/dist/Leaflet.fullscreen.js"></script>

	<style>
		.leaflet-control-attribution a { color:#000 !important; }
	</style>

<!-- BIBLIOTEK SLUT -->

<script>
    // Initialize the map
    var map = L.map('map').setView([59.32, 18.06], 5);

    // Add a tile layer (OpenStreetMap in this example)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '<a href="<?php echo str_replace("geojson","kml",$geojson); ?>">KML</a>',
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
    //var markerClusters = L.markerClusterGroup();

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
                    return L.marker(latlng, { icon: icons['<?php echo $icon; ?>'] });
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
			        var thumbnail = `<?php echo $settings["immich-settings"][0]["immich-server-address"]; ?>api/assets/${feature.properties['photoId']}/thumbnail`;
                            var photoUrl = `<?php echo $settings["immich-settings"][0]["immich-server-address"]; ?>photos/${feature.properties['photoId']}`;
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
    /*
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
    }*/

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
        fetch('<?php echo $geojson; ?>').then(response => response.json()),
        //fetch('geojson.php?type=accommodation&id=').then(response => response.json()),
        //fetch('geojson.php?type=assets&id=').then(response => response.json())
    ])
    .then(results => {
        if (results[0].status === 'fulfilled') {
            createGeoJSONLayer(results[0].value, '<?php echo $color; ?>', layerGroups['Overview'], icons['Overview']);
            //addPolylineDecorators(layerGroups['Overview']);
        } else {
            console.error('Failed to fetch Overview GeoJSON:', results[0].reason);
        }
/*
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
        }*/

        // Add layer controls
        //L.control.layers(null, layerGroups, {collapsed: false}).addTo(map);

        map.addLayer(layerGroups['Overview']);

        // Fit map to the bounds of the first layer as default
        //map.fitBounds(layerGroups['Layer 1'].getBounds());

        // Fit map to combined bounds of all layers
        var combinedBounds = getCombinedBounds(layerGroups);
        map.fitBounds(combinedBounds);

    })
    .catch(error => console.error('Error fetching GeoJSON data:', error));
</script>

<?php include '_foot.php'; ?>