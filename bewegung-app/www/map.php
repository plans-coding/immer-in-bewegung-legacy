<?php

$pageTitle = "Map";
$contentMargin = "0";
$widthRestriction = false;
$noFoot = true;
include '_head.php';
include '_data.php';

?>

<?php

$kml = "kml.php?type=all_overall_route";
$map_type = "";

if (isset($_GET["country"])) {
        $kml="kml.php?type=accommodation_country&country=".$_GET["country"];
}

if ( isset($_GET["map"]) ){
        if ( $_GET["map"] == "all_accommodation" ) {
                $map_type = $_GET["map"];
                $kml="kml.php?type=all_accommodation";
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


$dropdown.='<option value="?">Overall route for all trips</option>';
$dropdown.='<optgroup disabled="disabled" style="margin-top: 1em;"></optgroup>';

if (isset($_GET["map"])) { if ($_GET["map"]=="all_accommodation" ) { $selected="selected"; } }

$dropdown.='<option value="?map=all_accommodation" '.$selected.'>All accommodations from all countries (VERY SLOW)</option>';
$dropdown.='<optgroup disabled="disabled" style="margin-top: 1em;"></optgroup>';

foreach ($period as $value) {
	$country_get = isset($_GET["country"]) ? $_GET["country"] : '';
	if ($value == $country_get ) { $selected="selected"; } else { $selected=""; }
	if ($value!="-" && $value!="" && strpos($value,"?")===false && strpos($value,"(")===false) {
		$dropdown.='<option value="?country='.$value.'" '.$selected.'>'.$value.' – Accommodations</option>'."\n";
	}
}
$dropdown.='</select>';

?>

<div class="imagesBar">
    <div style="flex:1;text-align:center;max-width:100%;">
        <?php echo $dropdown; ?>
    </div>
</div>

        <!--<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />-->
	<link rel="stylesheet" href="dep/leaflet/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <script src="dep/leaflet/L.KML.js"></script>
        <script src="dep/leaflet/oms.min.js"></script>
        <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
        <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />


        <div style="width: 100%;flex-grow:1;" id="map"></div>

<?php
if ($map_type == "all_accommodation" || isset($_GET["country"])) {
?>
        <script type="text/javascript">

        // Make basemap
        const map = new L.Map('map'); //, { center: new L.LatLng(59.337280, 18.097698), zoom: 11 }
        const osm = new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
	
	//L.Icon.Default.prototype.options.iconUrl = 'plans_house.php?color=4798d0';

        map.addLayer(osm);
	map.attributionControl.addAttribution('<a href="<?php echo $kml; ?>" target="_blank">KML</a>');

	var oms = new OverlappingMarkerSpiderfier(map,{keepSpiderfied:true,circleSpiralSwitchover:0,legWeight:2,spiralLengthStart:36,spiralFootSeparation:40,spiralLengthFactor:4});
        oms.legColors.usual='#999';
        oms.legColors.highlighted='#77071d';

        var iconNights = L.Icon.Default.extend({options: {iconUrl: 'plans_house.php?color=4798d0',iconRetinaUrl: 'spider/extra_living1.png',iconSize: [36, 36],iconAnchor: [18, 18],}});
        var iconImage = L.Icon.Default.extend({options: {iconUrl: 'plans_image.php?color=77071d',iconRetinaUrl: 'plans_image.php?color=77071d',iconSize: [36, 36],iconAnchor: [18, 18],}});
        var iconVideo = L.Icon.Default.extend({options: {iconUrl: 'plans_image.php?color=1f5a2b',iconRetinaUrl: 'plans_image.php?color=1f5a2b',iconSize: [36, 36],iconAnchor: [18, 18],}});

        // Load kml file
        fetch('<?php echo $kml; ?>')
        .then(res => res.text())
        .then(kmltext => {
                // Create new kml overlay
                const parser = new DOMParser();
                const kml = parser.parseFromString(kmltext, 'text/xml');
                const track = new L.KML(kml);

                window.trackLayers=track._layers;

                //map.addLayer(track);
                // Adjust map to show the kml
                const bounds = track.getBounds();
                map.fitBounds(bounds, {padding: [50,50]});

                i=0;
                for (var key in track._layers) {
                var obj = track._layers[key];

                var datum = obj._latlng;
                var loc = new L.LatLng(datum.lat, datum.lng);
                //bounds.extend(loc);
                
                var marker = new L.Marker(loc,{icon:new iconNights()});

                if (obj.options.id=="icon3") {
                var marker = new L.Marker(loc,{icon:new iconImage()});
                } else if (obj.options.id=="icon_video") {
                var marker = new L.Marker(loc,{icon:new iconVideo()});
                } else if (obj.options.id=="icon_house2") {
                var marker = new L.Marker(loc,{icon:new iconNights()});
                }

                i++;

                //marker.icon = obj.options.icon.options.iconUrl;
                marker.desc = obj._popup._content;
                console.log(marker.desc);
                map.addLayer(marker);
                oms.addMarker(marker);

                //Spider TILLÄGG
                var popup = new L.Popup();
                oms.addListener('click', function(marker) {
                popup.setContent(marker.desc);
                popup.setLatLng(marker.getLatLng());
                map.openPopup(popup);
                });
                }

                });

        map.addControl(new L.Control.Fullscreen());

        </script>

<?php
} else {
?>

<script type="text/javascript">

const map = new L.Map('map'); //{maxZoom:10,zoomControl: false,scrollWheelZoom: false,dragging: false}
const osm = new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
map.addLayer(osm);

// ### ÖVERSIKTSKARTAN
const addTrackAndBoundsFromKml = kmltext => {

// Create new kml overlay
 const parser = new DOMParser();
 kml = parser.parseFromString(kmltext,"text/xml");

 const track = new L.KML(kml);
 map.addLayer(track);

 // Adjust map to show the kml
 map.fitBounds( track.getBounds() );

};

// load KML file
fetch('<?php echo $kml; ?>')
  .then( res => res.text() )
  .then( addTrackAndBoundsFromKml);

map.addControl(new L.Control.Fullscreen());


</script>


<?php
}
?>

<?php include '_foot.php'; ?>