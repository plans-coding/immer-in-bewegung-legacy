<?php

    include '_data.php';
    $pageTitle = $translation["dataset"]["title"] ?? "Dataset";

    if ( ( $settings["trip-data"]["embed"] ?? false ) !== false ) {
        $contentMargin = "0";
        $widthRestriction = false;
        $noFoot = true;
    } else {
        $contentMargin = "auto";
    }

    include '_head.php';

    if ( ( $settings["trip-data"]["embed"] ?? false ) !== true ) {

?>

<div style="margin:0 10pt 0 10pt;">

    <h1 class="normal" id="lang-sync-title"><?php echo $translation["dataset"]["title"] ?? "Dataset"; ?></h1>

    <div style="padding:10pt;font-family: 'Francois+One', sans-serif;" class="pg_grey boxShadow">
    <span id="lang-sync-second-pg"><?php echo $translation["dataset"]["second-pg"] ?? "Your Google Spreadsheet ID according to your configuration"; ?></span><br />
    <b><a target="_blank" href="https://docs.google.com/spreadsheets/d/<?php echo $settings["trip-data"]["spreadsheet-id"]; ?>/edit"><?php echo $settings["trip-data"]["spreadsheet-id"]; ?></a></b><br /><br />
    <span id="lang-sync-third-pg"><?php echo $translation["dataset"]["third-pg"] ?? "Update your files manually by <b>right click</b> on the links below and save the file to your IIB <b>data</b> folder."; ?></span>
    <br />
        <div style="margin-top:10pt;">
            <a class="iib-action-button" href="https://docs.google.com/spreadsheets/d/<?php echo $settings["trip-data"]["spreadsheet-id"]; ?>/export?format=tsv&gid=<?php echo $settings["trip-data"]["overview-gid"]; ?>"><?php echo $settings["trip-data"]["overview-name"]; ?> (tsv)</a>
            
            <a class="iib-action-button" href="https://docs.google.com/spreadsheets/d/<?php echo $settings["trip-data"]["spreadsheet-id"]; ?>/export?format=tsv&gid=<?php echo $settings["trip-data"]["events-gid"]; ?>"><?php echo $settings["trip-data"]["events-name"]; ?> (tsv)</a>
            
            <a class="iib-action-button" href="https://docs.google.com/spreadsheets/d/<?php echo $settings["trip-data"]["spreadsheet-id"]; ?>/export?format=tsv&gid=<?php echo $settings["trip-data"]["map-gid"]; ?>"><?php echo $settings["trip-data"]["map-name"]; ?> (tsv)</a>
            </div>
    </div>
    <p id="lang-sync-first-pg"><?php echo $translation["dataset"]["first-pg"] ?? "You need to be logged on in advance on Google Sheet to perform the actions above. No user authentication details will be sent to the web app."; ?></p>

    <a onclick="document.getElementById('manualOption').style.display='block';this.style.display='none';" style="font-family: 'Francois+One', sans-serif;cursor:pointer;">Show manual option</a>
    <div id="manualOption" style="display:none;margin-top:15pt;padding:10pt;font-family: 'Francois+One', sans-serif;" class="pg_grey boxShadow">
        <div id="lang-sync-other-options-text"><?php echo $translation["dataset"]["other-options-text"] ?? "If you use Microsoft 365 or a local installation of Microsoft Office, LibreOffice or other, you can save tsv files directly to the <b>data</b> folder with the following names"; ?></div>
        <ul>
            <li><u><?php echo $settings["trip-data"]["spreadsheet-name"]." - ".$settings["trip-data"]["overview-name"]; ?>.tsv</u></li>
            <li><u><?php echo $settings["trip-data"]["spreadsheet-name"]." - ".$settings["trip-data"]["events-name"]; ?>.tsv</u></li>
            <li><u><?php echo $settings["trip-data"]["spreadsheet-name"]." - ".$settings["trip-data"]["map-name"]; ?>.tsv</u></li>
        </ul>
    </div>
    
</div>

<?php
} else {
?>

<script>
function toggleCoordinateTool() {
    var tool = document.getElementById('coordinateTool');
    if (tool.style.visibility === 'hidden') {
        tool.style.visibility = '';
    } else {
        tool.style.visibility = 'hidden';
    }
}
</script>

<div class="bar imagesBar" style="display:flex;">

    <div style="text-align:left;font-weight:normal;flex:1 1;">
        <!--
        <a class="iib-action-button" style="cursor:pointer;" onclick="document.getElementById('coordinateTool').style.visibility='hidden';">Sheet</a>
        <a class="iib-action-button" style="cursor:pointer;" onclick="document.getElementById('coordinateTool').style.visibility='';">Coordinate Tool</a>
        -->
        <a class="iib-action-button" style="cursor:pointer;" onclick="toggleCoordinateTool()"><?php echo $translation["dataset"]["toggle"] ?? "Toggle Sheet/Coordinate Tool"; ?></a>
    </div>
    <div style="text-align:right;font-weight:normal;flex:1 1;">
        <a target="_blank" href="https://docs.google.com/spreadsheets/d/<?php echo $settings["trip-data"]["spreadsheet-id"]; ?>/edit"><b>Google Sheet<?php //echo $settings["trip-data"]["spreadsheet-id"]; ?></b></a>&nbsp;
        <a class="iib-action-button" href="https://docs.google.com/spreadsheets/d/<?php echo $settings["trip-data"]["spreadsheet-id"]; ?>/export?format=tsv&gid=<?php echo $settings["trip-data"]["overview-gid"]; ?>"><?php echo $settings["trip-data"]["overview-name"]; ?> (tsv)</a>
        <a class="iib-action-button" href="https://docs.google.com/spreadsheets/d/<?php echo $settings["trip-data"]["spreadsheet-id"]; ?>/export?format=tsv&gid=<?php echo $settings["trip-data"]["events-gid"]; ?>"><?php echo $settings["trip-data"]["events-name"]; ?> (tsv)</a>
        <a class="iib-action-button" href="https://docs.google.com/spreadsheets/d/<?php echo $settings["trip-data"]["spreadsheet-id"]; ?>/export?format=tsv&gid=<?php echo $settings["trip-data"]["map-gid"]; ?>"><?php echo $settings["trip-data"]["map-name"]; ?> (tsv)</a>
    </div>

</div>


<?php

    echo '<div style="position:relative;height:100%;width:100%;overflow:hidden;">';
    echo '<div id="coordinateTool" style="position:absolute;height:100%;width:100%;visibility:hidden;background-color:red;">';
    ?>

    <div style="position:absolute;display:flex;gap:5pt;bottom:10pt;left:10pt;flex-wrap:wrap;margin-right:10pt;z-index:10000;"><input type="text" id="markedCoordinate" style="flex:1;font-size:20pt;padding:5pt;border:3pt solid grey;" disabled /><button class="searchButton" style="align-items:center;padding-left:5pt;" onclick="copyToClipboard();" id="lang-coordTool-copy-coordinates"><?php echo $translation["dataset"]["copy-coordinates"] ?? "Copy coordinates"; ?></button></div>
    <div id="coordMap" style="width:100%;height:100%;cursor:pointer;"></div>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script>
        // Initialize the map
        const map = L.map('coordMap').setView([59.32, 18.06], 5);

        // Add a tile layer (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        // Add click event listener to the map
        map.on('click', function (e) {
            const lat = e.latlng.lat.toFixed(6); // Latitude
            const lng = e.latlng.lng.toFixed(6); // Longitude
            //console.log(`Clicked coordinates: Latitude: ${lat}, Longitude: ${lng}`);
            document.getElementById('markedCoordinate').value = `${lat},${lng}`;
        });

        // Initialize the geocoder
        const geocoder = L.Control.geocoder({
            defaultMarkGeocode: false
        })
        .on('markgeocode', function(e) {
            const latlng = e.geocode.center;
            map.setView(latlng, 13); // Zoom to the location
            L.marker(latlng).addTo(map) // Add a marker at the location
                .bindPopup(e.geocode.name) // Bind a popup with the place name
                .openPopup();
        })
        .addTo(map);

        function copyToClipboard() {
            const text = document.getElementById('markedCoordinate').value;
            navigator.clipboard.writeText(text);
        }

    </script>

    <?php
    echo '</div>';
    echo '<iframe style="width:100%;height:100%;border:none;" src="https://docs.google.com/spreadsheets/d/'.$settings["trip-data"]["spreadsheet-id"].'/edit?gid='.$settings["trip-data"]["overview-gid"].'&rm=minimal"></iframe>';
    echo '</div>';
}

include '_foot.php';

?>