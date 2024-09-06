<?php

$pageTitle = "Trip Events";
$contentMargin = "auto";
include '_head.php';
include '_data.php';
$underline="";
$title="";

$trip_id=$_GET["id"];

// Theme color - can be changed if same color is preferred
$color = $trip_settings[$tripBlocks[$_GET["id"]]["TripType"]]["Color"];
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
<!--<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />-->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<link rel="stylesheet" href="dep/leaflet/leaflet.css" />
<!--<script src="img/leaflet.js"></script>-->

<script src="dep/leaflet/L.KML.js"></script>

<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />

<script src="dep/leaflet/oms.min.js"></script>
<script src="dep/leaflet/leaflet.polylineDecorator.js"></script>


<!-- BIBLIOTEK SLUT -->
 <script type="text/javascript">

//minZoom:5,maxZoom:9
// Make basemap
const map = new L.Map('overview_map',{minZoom:2,maxZoom:7}); //{maxZoom:10,zoomControl: false,scrollWheelZoom: false,dragging: false}
const osm = new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
map.addLayer(osm);

var layerOverview = L.layerGroup().addTo(map);
var layerMedia = L.layerGroup().addTo(map);
var layerNights = L.layerGroup().addTo(map);
map.removeLayer(layerMedia);
map.removeLayer(layerNights);
var fullscreen=new L.Control.Fullscreen();
map.options.minZoom = 2;
map.options.maxZoom = 7;

var attrOverview = '<a href="kml.php?type=overview&id=<?php echo $_GET["id"]; ?>">Overview KML</a>';
var attrMediaNights = '<a href="kml.php?type=accommodation&id=<?php echo $_GET["id"]; ?>">Accommodations KML</a><!--, <a href="kml.php?type=immich&id=<?php echo $_GET["id"]; ?>&part=image">Media KML</a>-->';

map.attributionControl.addAttribution(attrOverview);


// ### ÖVERSIKTSKARTAN

function overviewMap() {


<?php

$marker_color=substr($trip_settings[$tripBlocks[urldecode($_GET["id"])]["TripType"]]["Color"],1,6);

?>

		//Ikoner
		letters="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		for (var i = 0; i < letters.length; ++i) {
			eval("var overall"+letters[i]+" = L.Icon.Default.extend({options: {iconUrl: 'plans_marker.php?color=<?php echo $marker_color; ?>&letter="+letters[i]+"',iconRetinaUrl: 'plans_marker.php?color=<?php echo $marker_color; ?>&letter="+letters[i]+"',iconSize: [36, 36],iconAnchor: [18, 18],}});");
		}

var oms = new OverlappingMarkerSpiderfier(map,{keepSpiderfied:true,circleSpiralSwitchover:0,legWeight:2,spiralLengthStart:36,spiralFootSeparation:40,spiralLengthFactor:4});
oms.legColors.usual='#999';
oms.legColors.highlighted='#77071d';

const addTrackAndBoundsFromKmlBound = kmltext => {

// Create new kml overlay
 const parser = new DOMParser();
 kml = parser.parseFromString(kmltext,"text/xml");

 const track = new L.KML(kml);

window.trackLayers1=track._layers;

//Lägger till polyline som ligger sist
var polyline = L.polyline(window.trackLayers1[Object.keys(window.trackLayers1)[Object.keys(window.trackLayers1).length-1]]._latlngs,{color: '#<?php echo $marker_color; ?>'}).addTo(layerOverview);

var decorator = L.polylineDecorator(polyline, {
    patterns: [
        // defines a pattern of 10px-wide dashes, repeated every 20px on the line
        { offset: '5%', repeat: '100', symbol: L.Symbol.arrowHead({pixelSize: 10, polygon: false, pathOptions: {stroke: true,color:'#<?php echo $marker_color; ?>'}})}
    ]
}).addTo(layerOverview);

i=0;

for (var key in track._layers) {
// Ta inte med polyline
	
	if (key != Object.keys(track._layers)[Object.keys(track._layers).length - 1]) {
	var obj = track._layers[key];

        var datum = obj._latlng;
        var loc = new L.LatLng(datum.lat, datum.lng);
	//bounds.extend(loc);

	letters="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	eval("var marker = new L.Marker(loc, {icon: new overall"+letters[i]+"()});");
	i++;

	marker.icon = obj.options.id;

        marker.desc = obj._popup._content;

        //map.addLayer(marker);
        layerOverview.addLayer(marker);
	oms.addMarker(marker);

	//Spider TILLÄGG

	var popup = new L.Popup();
	oms.addListener('click', function(marker) {
	  popup.setContent(marker.desc);
	  popup.setLatLng(marker.getLatLng());
	  map.openPopup(popup);
	});

	}

}


// Adjust map to show the kml
 map.fitBounds( track.getBounds() );

};



// load KML file 
//kml_trip.php?id=F-14
fetch('kml.php?type=overview&id=<?php echo $_GET["id"]; ?>')
  .then( res => res.text() )
  .then( addTrackAndBoundsFromKmlBound);

//map.addControl(new L.Control.Fullscreen());


}

// ### MEDIA-KARTAN

function mediaMap() {

	//Ikoner
	var livingCol  = L.Icon.Default.extend({options: {iconUrl: 'plans_house.php?color=4798d0',iconRetinaUrl: 'spider/extra_living1.png',iconSize: [36, 36],iconAnchor: [18, 18],}});
	var imageCol  = L.Icon.Default.extend({options: {iconUrl: 'plans_image.php?color=77071d',iconRetinaUrl: 'plans_image.php?color=77071d',iconSize: [36, 36],iconAnchor: [18, 18],}});
	var videoCol  = L.Icon.Default.extend({options: {iconUrl: 'plans_image.php?color=1f5a2b',iconRetinaUrl: 'plans_image.php?color=1f5a2b',iconSize: [36, 36],iconAnchor: [18, 18],}});

	var livingExp  = L.Icon.Default.extend({options: {iconUrl: 'plans_house.php?color=4798d0',iconSize: [30, 30],iconAnchor: [15, 15],}});
	var imageExp  = L.Icon.Default.extend({options: {iconUrl: 'plans_image.php?color=77071d',iconSize: [30, 30],iconAnchor: [15, 15],}});
	var videoExp  = L.Icon.Default.extend({options: {iconUrl: 'plans_image.php?color=1f5a2b',iconSize: [30, 30],iconAnchor: [15, 15],}});

	var oms = new OverlappingMarkerSpiderfier(map,{keepSpiderfied:true,circleSpiralSwitchover:0,legWeight:2,spiralLengthStart:36,spiralFootSeparation:40,spiralLengthFactor:4});
	oms.legColors.usual='#999';
	oms.legColors.highlighted='#77071d';

	const addTrackAndBoundsFromKmlBound = kmltext => {

	// Create new kml overlay
	const parser = new DOMParser();
	kml = parser.parseFromString(kmltext,"text/xml");

	const track = new L.KML(kml);
	//map.addLayer(track);
	//Spider TILLÄGG
	//oms.addMarker(track);

	window.boundOverview=track.getBounds();
	window.trackLayers1=track._layers;

	//Lägger till polyline som ligger sist
	var polyline = L.polyline(window.trackLayers1[Object.keys(window.trackLayers1)[Object.keys(window.trackLayers1).length-1]]._latlngs,{color: '#4798d0'}).addTo(layerNights);

	var decorator = L.polylineDecorator(polyline, {
		patterns: [
			// defines a pattern of 10px-wide dashes, repeated every 20px on the line
			{ offset: '5%', repeat: '100', symbol: L.Symbol.arrowHead({pixelSize: 10, polygon: false, pathOptions: {stroke: true,color:'#4798d0'}})}
		]
	}).addTo(layerNights);

	for (var key in track._layers) {
	// Ta inte med polyline
		if (key != Object.keys(track._layers)[Object.keys(track._layers).length - 1]) {
		var obj = track._layers[key];

			var datum = obj._latlng;
			var loc = new L.LatLng(datum.lat, datum.lng);
		//bounds.extend(loc);

		if (obj.options.id=="icon_video") {
			var marker = new L.Marker(loc, {icon: new videoCol()});
		} else if (obj.options.id=="icon3") {
		var marker = new L.Marker(loc, {icon: new imageCol()});
		} else {
		var marker = new L.Marker(loc, {icon: new livingCol()}); //new livingCol()
		}

		marker.icon = obj.options.id;

			marker.desc = obj._popup._content;

			//map.addLayer(marker);
		layerNights.addLayer(marker);
			oms.addMarker(marker);

		//Spider TILLÄGG

		var popup = new L.Popup();
		oms.addListener('click', function(marker) {
		popup.setContent(marker.desc);
		popup.setLatLng(marker.getLatLng());
		map.openPopup(popup);
		});

		}

	}


	// Adjust map to show the kml
 map.fitBounds( track.getBounds() );

};


const addTrackAndBoundsFromKml = kmltext => {

// Create new kml overlay
 const parser = new DOMParser();
 kml = parser.parseFromString(kmltext,"text/xml");

 const track = new L.KML(kml);
 //map.addLayer(track);
//Spider TILLÄGG
oms.addMarker(track); 
window.trackLayers=track._layers;

//Lägger till polyline som ligger sist
if ( typeof window.trackLayers[Object.keys(window.trackLayers)[Object.keys(window.trackLayers).length-1]]._latlngs !== "undefined" ) {
var polyline2 = L.polyline(window.trackLayers[Object.keys(window.trackLayers)[Object.keys(window.trackLayers).length-1]]._latlngs,{color: 'rgba(119, 7, 29, 0.55)'}).addTo(layerMedia);

var decorator2 = L.polylineDecorator(polyline2, {
    patterns: [
        // defines a pattern of 10px-wide dashes, repeated every 20px on the line
        { offset: '5%', repeat: '100', symbol: L.Symbol.arrowHead({pixelSize: 10, polygon: false, pathOptions: {stroke: true,color:'rgba(119, 7, 29, 0.55)'}})}
    ]
}).addTo(layerMedia);
}

for (var key in track._layers) {
// Ta inte med polyline
	if (key != Object.keys(track._layers)[Object.keys(track._layers).length - 1]) {
	var obj = track._layers[key];

        var datum = obj._latlng;
        var loc = new L.LatLng(datum.lat, datum.lng);
	//bounds.extend(loc);

	if (obj.options.id=="icon_video") {
        var marker = new L.Marker(loc, {icon: new videoCol()});
	} else if (obj.options.id=="icon3") {
	var marker = new L.Marker(loc, {icon: new imageCol()});
	} else {
	var marker = new L.Marker(loc, {icon: new livingCol()}); //new livingCol()
	}

	marker.icon = obj.options.id;

        marker.desc = obj._popup._content;

        //map.addLayer(marker);
	layerMedia.addLayer(marker);
        oms.addMarker(marker);

	//Spider TILLÄGG

	var popup = new L.Popup({className: 'popup-size'});
	oms.addListener('click', function(marker) {
	  popup.setContent(marker.desc);
	  popup.setLatLng(marker.getLatLng());
	  map.openPopup(popup);
	});

	}

}

      oms.addListener('spiderfy', function(markers) {
        for (var i = 0, len = markers.length; i < len; i ++) {
	if (markers[i].icon=="icon_video") {
        markers[i].setIcon(new videoCol());
	} else if (markers[i].icon=="icon3") {
	markers[i].setIcon(new imageCol());
	} else {
	markers[i].setIcon(new livingCol()); //new livingExp()
	}
	}
        map.closePopup();
      });
      oms.addListener('unspiderfy', function(markers) {
        for (var i = 0, len = markers.length; i < len; i ++) {
	if (markers[i].icon=="icon_video") {
        markers[i].setIcon(new videoCol());
	} else if (markers[i].icon=="icon3") {
	markers[i].setIcon(new imageCol());
	} else {
	markers[i].setIcon(new livingCol()); //new livingCol()
	}
	}
      });

 // Adjust map to show the kml
 //map.fitBounds( track.getBounds() );

};



// load KML file 
//kml_trip.php?id=F-14
fetch('kml.php?type=accommodation&id=<?php echo $_GET["id"]; ?>')
  .then( res => res.text() )
  .then( addTrackAndBoundsFromKmlBound);

fetch('kml.php?type=immich&id=<?php echo $_GET["id"]; ?>')
  .then( res => res.text() )
  .then( addTrackAndBoundsFromKml);


}

document.onload=overviewMap();
document.onload=mediaMap();

/*
var overlay = {'Översikt': layerOverview,'Boende': layerNights,'Media': layerMedia};
L.control.layers(null, overlay).addTo(map);
*/

</script>

<style>
.popup-size {
    width: 250pt;
    //text-align:center;
    //height: 250pt;
}
</style>

<script>
/* ÄNDRAR TOPPFÄLTSFÄRGEN PÅ ANDROID TILL SAMMA SOM RESETYPEN */
document.querySelector('meta[name="theme-color"]').setAttribute('content', '#<?php echo $marker_color; ?>');
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
//}
//}

?>
<script>
function toggleMap() {
	if (map.hasLayer(layerOverview)) {
		document.getElementById("toggleMapLink").innerHTML = "Show map overview";
		map.removeLayer(layerOverview);
		map.addLayer(layerMedia);
		map.addLayer(layerNights);
		map.addControl(fullscreen);
		map.options.minZoom = 0;
		map.options.maxZoom = 18;
		map.attributionControl.removeAttribution(attrOverview);
		map.attributionControl.addAttribution(attrMediaNights);
	} else if (map.hasLayer(layerMedia)) {
		document.getElementById("toggleMapLink").innerHTML = "Show map with accommodations";
		map.removeLayer(layerMedia);
		map.removeLayer(layerNights);
		map.addLayer(layerOverview);
		map.removeControl(fullscreen);
		map.options.minZoom = 2;
		map.options.maxZoom = 7;
		map.fitBounds(window.boundOverview);
		map.attributionControl.removeAttribution(attrMediaNights);
		map.attributionControl.addAttribution(attrOverview);
	}
}


</script>

<!--<div style="cursor:pointer;margin-top:10pt;">
<b>Map Layer:</b>
<div>X Show overview</div>
<div>X Show accommodation</div>
<div>X Show media</div>
</div>-->
<div style="cursor:pointer;margin-top:20pt;" onclick="toggleMap()"><a style="color:<?php echo $color; ?>;" id="toggleMapLink">Show map with accommodations</a></div>

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
	if (file_exists("path-plugin-extra-trip-object")) {
		include file_get_contents("path-plugin-extra-trip-object");
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
