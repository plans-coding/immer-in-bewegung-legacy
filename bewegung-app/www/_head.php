<!DOCTYPE html>
<html lang="<?php echo $appLanguage; ?>">

<?php
/* Light theme */
$bodyBackgroundColor = "#f8fafd";
$lightColor = "#e4e9ef";
$darkColor = "#6f757e";
$hoverColor = "#8f959eAA";
$objectColor = "#000";

/* Dark theme */
$bodyBackgroundColorNight = "#000D0D";
$lightColorNight = "#001B1B";
$darkColorNight = "#002D2D";
$hoverColorNight = "#002D2D55";
$objectColorNight = $darkColorNight;
?>

<head>
    
    <link rel="shortcut icon" href="favicon.webp" />
    <meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <title><?php echo $pageTitle; ?> - Immer in Bewegung</title>
    <link href="https://fonts.googleapis.com/css?family=Cairo|Francois+One|Merriweather|Righteous" rel="stylesheet">

    <meta name="mobile-web-app-capable" content="yes">
    <link rel="manifest" href="manifest.json">
    <meta name="theme-color" content="<?php echo $darkColor; ?>" id="themeColorMeta">
    <meta name="msapplication-navbutton-color" content="<?php echo $lightColor; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel=icon href="favicon.webp">-->


    <style>

        /* Global */
        html {height:100%;}
        body{margin: 0;padding: 0;font-family: 'Merriweather', serif;height:100%;background-color:<?php echo $bodyBackgroundColor; ?>;}
        p {font-family: 'Francois+One', sans-serif;}
        
        /* Addon */
        .roundBorder { border-radius:10pt; }
        .roundBorderTop { border-top-left-radius:5pt;border-top-right-radius:5pt; }
        .roundBorderBottom { border-bottom-left-radius:10pt;border-bottom-right-radius:10pt; }
        /* .boxShadow { box-shadow: 1px 1px 10px <?php echo $hoverColor; ?>; } */
        .lightColor {background-color:<?php echo $lightColor; ?>;}

        /* Elements */
        .tripDivision { padding:5pt;font-family: 'Francois+One', sans-serif;padding:5pt;text-align:center;color:#fff;background-color:<?php echo $objectColor; ?>; }

        .topBarContainer {z-index:1001;position:sticky;top:0;}
        .topBar {padding: 0pt;background-color:<?php echo $darkColor; ?>;color:#fff;text-align: center;}
        .menuBar {display: flex;flex-wrap: wrap;background-color:#f1f1f1;justify-content: space-between;gap:1pt;border-bottom:3pt solid <?php echo $darkColor; ?>;}
        .menuBar > a {background-color:<?php echo $lightColor; ?>;font-family: 'Francois+One', sans-serif;text-align: center;flex:1;cursor:pointer;padding:5pt;color:#000;}
        .menuBar > a:hover {background-color:<?php echo $hoverColor; ?>;color:#fff;text-decoration:none;}
        
        .container {margin:<?php echo $contentMargin; ?>;<?php if($widthRestriction !== false){ echo "max-width:50em;width:50em;"; } ?>}
        .normal { margin:20pt 0 20pt 0;line-height:1em;font-family: 'Cairo', sans-serif;font-weight:bold;color:#000;font-size:3em;text-align:center;}

        #searchStringPattern {font-family: 'Francois+One', sans-serif;font-size:14pt;border:2pt solid <?php echo $darkColor; ?>;background-color:<?php echo $bodyBackgroundColor; ?>;padding:5pt;border-radius:10pt;}
        
        input[type=text], #searchStringPattern { font-family: 'Francois+One', sans-serif; }

        .immer-in-font-uc {font-family: 'Cairo', sans-serif;text-transform: uppercase;}
        .bewegung-font-uc {font-family: 'Righteous', sans-serif;text-transform: uppercase;}

        .trip_table, .trip_table_details {font-family: 'Francois+One', sans-serif;width:100%;}
        .trip_table_division {border:0.2em solid <?php echo $objectColor; ?>}
        thead {font-weight:bold;}
        td {padding:5pt;}

        .bar {
            padding: 5pt;
            font-family: 'Francois+One', sans-serif;
            display:flex;
            font-weight:bold;
            align-items: center;
            gap:2pt;
        }
        .imageBar{background-color: <?php echo $lightColor; ?>;}
        .tripBar{background-color: <?php echo $darkColor; ?>;border-top:1pt solid #fff;}

        .button {padding: 10pt 10pt 10pt 10pt;background-color: #004c97;color: #fff;text-align: center;margin:auto;margin-top:10pt;width:209pt;}
        .button:hover {background-color:<?php echo $hoverColor; ?>;color:#000;cursor:pointer;}
        .button_inactivated {padding: 10pt 10pt 10pt 10pt;background-color:grey;
            color: #fff;text-align: center;margin:auto;margin-top:10pt;width:209pt;cursor:default;}
        .clearButton {background-color:<?php echo $darkColor; ?>;}
        .clearButton:hover {background-color:<?php echo $hoverColor; ?>; }

        /*.filterButton {background-color:#e5f2ff;border-radius:10pt;padding:4pt 7pt 4pt 7pt;cursor:pointer;}*/
        
        a {color:#1d655e;text-decoration:none;}

        hh1 {display:block;font-family: 'Cairo', sans-serif;font-weight:bold;color:#000;font-size:3em;line-height:0.8em;padding-bottom:15pt;}
        h2 {margin-bottom:0;}
        .iib-action-button {
            display: inline-block;
            background-color: #000000;
            color: #ffffff;
            padding: 2pt;
            border-radius: 2pt;
        }
        .iib-action-button:hover {
            background-color: #000000AA;
        }

        .searchButton {font-family: 'Francois+One', sans-serif;font-size:18pt;border-radius:10pt;background-color:<?php echo $darkColor; ?>;color:#fff;display:flex;cursor:pointer;border:0;}
        .searchButton:hover {background-color:<?php echo $hoverColor; ?>;}

        #aboutTop, #openinLogoSmall{display:none;}

        #statComment, #statSummary tr:nth-child(even), #nightPerCountry tr:nth-child(even), #visitsPerCountry tr:nth-child(even) {
            background-color: <?php echo $lightColor; ?>; /* Color for even rows */
        }
        #statSummary tr:nth-child(even), #visitsPerCountry tr:nth-child(even) td:first-child, #nightPerCountry tr:nth-child(even) td:first-child {
            border-top-left-radius:10pt;
            border-bottom-left-radius:10pt;
        }
        #statSummary tr:nth-child(even), #visitsPerCountry tr:nth-child(even) td:last-child, #nightPerCountry tr:nth-child(even) td:last-child {
            border-top-right-radius:10pt;
            border-bottom-right-radius:10pt;
        }

        #chartFlex {height:300pt;}
        .searchDay {background-color:<?php echo $lightColor; ?>;}

        #trip_nav {margin-top:20pt;}

        #searchResult{height:;}

        .pg_grey {background-color:<?php echo $lightColor; ?>;border-radius:10pt;}
        #update_message{background-color:rgb(255,248,220);}

        #selectTripTypeCurrent, #selectTripTypeAll{font-size:18pt;border-radius:10pt;border-color:#fff;width:300pt;}
        #contentS {border-radius:10pt;}

        .trip_category {font-family: 'Francois+One', sans-serif;font-size:;padding:0.2em;text-align:left;color:#fff;cursor:pointer;border-radius:3pt;display:inline-block;}

        #tripCatCont{display:flex;gap:5pt;flex-wrap:wrap;justify-content:center;margin:0 2pt 5pt 2pt;}
        .node{background-color:<?php echo $darkColor; ?>;color:#fff;margin-right:2pt;}

        #country_dd, #date_dd, #searchStringPattern, input[type=text] {border:3pt solid <?php echo $darkColor; ?>;background-color:<?php echo $bodyBackgroundColor; ?>;border-radius:10pt;}

        .style_cat{border:1px solid #000000;background-color:#000000;}
        .style_cat:hover{border:1px solid #000000BB;background-color:#000000BB;}

        .sepLine {border-bottom:1pt solid <?php echo $objectColor; ?>;}

        /* ##### ANNAN CSS FÖR MINDRE SKÄRM ##### */
        @media (max-width: 1000px ) { /*1440px*/
            .trip_image_button {font-size:;}
            .trip_table {overflow:hidden;word-break:break-all;} /* word-break:break-all; */
            .trip_table tr {display: grid;grid-template-columns: repeat(5, 1fr);}
            .trip_table_division {grid-column: 1 / span 5;}
            .trip_table_country_category {hyphens:auto;line-height:10pt;font-size:0.7em;word-break:break-all;} /* word-break:break-all; */
            #iib-foot, #lang-menu-datasetphp, #lang-menu-aboutphp, #prevDayText, #nextDayText, #backText, #openinText, #openinLogo, #lang-overview-heading {display:none;}
            #aboutTop, #openinLogoSmall {display:inline-block;}
            #selectTripTypeCurrent, #selectTripTypeAll, .topBar, .menuBar{font-size:14pt;}
            #selectTripTypeCurrent, #selectTripTypeAll{width:100pt;}
            #visitsPerCountry {font-size:9pt;margin-top:5pt;}
            #visitsPerCountry td {padding:0pt;}
            #lang-overview-paragraph {margin:5pt;}
            #tripCatCont{margin:5pt 2pt 5pt 2pt;}
            #chartFlex {height:200pt;width:150pt;}
            .normal {font-size:30pt;margin:10pt 0 10pt 0;}
            input::placeholder {font-size: 17pt;}
            #lang-overview-paragraph{display:none;}
            #trip_nav {margin-top:2pt;}
            #map {height:250pt !important;}
            #contentS{margin-top:3pt;}
            #prevTripIDAllTrips, #nextTripIDAllTrips, #prevTripIDCurrentTripType, #nextTripIDCurrentTripType {display:none;}

        }
        /* ##### ANNAN CSS FÖR MINDRE SKÄRM ##### */

        /* ##### ANNAN CSS FÖR DARK MODE ##### */
        @media (prefers-color-scheme: dark) {

            a {color:#07ad67;}
            body, .menulink, thead, .trip_table_details {background-color:<?php echo $bodyBackgroundColorNight; ?>!important;}
            h1, h2,body, .menulink, thead, .trip_table_details > div {color:#fff !important;}
            
            .lightColor {background-color:<?php echo $lightColorNight; ?>;}
            .trip_table, .trip_table_division, .trip_table_details {background-color:<?php echo $lightColorNight; ?> !important;border:0.2em solid <?php echo $objectColorNight; ?> !important;}

            input[type="text"], #searchStringPattern {color:#fff;border:3pt solid <?php echo $darkColorNight; ?> !important;}
            .searchButton, .clearButton, .trip_image_button {background-color:<?php echo $darkColorNight; ?>;}
            .searchButton:hover, .clearButton:hover, .trip_image_button:hover {background-color:<?php echo $hoverColorNight; ?>;}
            .pg_grey { background-color:<?php echo $lightColorNight; ?>;color:#fff; }
            .tripBar, .imagesBar{background-color:<?php echo $lightColorNight; ?> !important;border-top:1pt solid <?php echo $darkColorNight; ?> !important;}
            .nightNumber{color:#000;}
            .topBar{background-color:<?php echo $darkColorNight; ?> !important;}
            #selectTripTypeAll{background-color:<?php echo $lightColorNight; ?> !important;}
            .menuItem{background-color:<?php echo $lightColorNight; ?> !important;color:#fff !important;}
            .menuItem:hover{background-color:<?php echo $hoverColorNight; ?> !important;}
            #statComment, #statSummary tr:nth-child(even), #nightPerCountry tr:nth-child(even), #visitsPerCountry tr:nth-child(even) {
                background-color: <?php echo $lightColorNight; ?>; /* Color for even rows */
            }
            #contentS, .searchDay{background-color:<?php echo $lightColorNight; ?> !important;}
            .menuBar {border-bottom:3pt solid <?php echo $darkColorNight; ?>;background-color:<?php echo $darkColorNight; ?> !important;}
            #update_message {background-color:#07ad67;color:#000;}
            #country_dd, #date_dd, #searchStringPattern, input[type=text] {border:3pt solid <?php echo $darkColorNight; ?> !important;background-color:<?php echo $lightColorNight; ?> !important;color:#fff;}
            .node{background-color:<?php echo $darkColorNight; ?>;}

            .tripDivision, .iib-action-button {background-color: <?php echo $objectColorNight; ?> !important;}
            .style_cat{border:1px solid <?php echo $objectColorNight; ?>;background-color:<?php echo $objectColorNight; ?>;}
            .sepLine {border-bottom:1pt solid <?php echo $objectColorNight; ?>;}

            /* Leaflet */
            .leaflet-touch .leaflet-control-layers, .leaflet-touch .leaflet-control-zoom-in, .leaflet-touch .leaflet-control-zoom-out{color:#fff;background-color:<?php echo $objectColorNight; ?> !important;}
            .leaflet-control-fullscreen a {background: #FFD2D2 url('fullscreen.png') no-repeat 0 0;filter: invert(1);}
            .leaflet-container .leaflet-control-attribution{background-color:<?php echo $objectColorNight; ?>CC !important;color:#fff;}
            .leaflet-container .leaflet-control-attribution a{color:#fff !important;}
            .leaflet-popup-content-wrapper, .leaflet-popup-tip {background-color:<?php echo $objectColorNight; ?> !important;color:#fff !important;}
        }
        /* ##### ANNAN CSS FÖR DARK MODE ##### */

    </style>

    <script>

        const themeColorMeta = document.querySelector('meta[name="theme-color"]');

        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        themeColorMeta.setAttribute('content', '<?php echo $darkColorNight; ?>');  // Dark mode color
        } else {
        themeColorMeta.setAttribute('content', '<?php echo $darkColor; ?>');   // Light mode color
        }

        // Optional: Listen for changes in the color scheme
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
        themeColorMeta.setAttribute('content', event.matches ? '<?php echo $darkColorNight; ?>' : '<?php echo $darkColor; ?>');
        });

</script>
    
</head>

<body>
    <div style="display:flex;flex-direction:column;height:100%;">

        <div class="topBarContainer">
            <div style="position:absolute;right:10pt;top:5pt;"><span id="aboutTop"><a style="font-family: 'Francois+One', sans-serif;color:#fff;" href="about.php">?</a></span></div>
            <div class="topBar" style="display:flex;align-items:center;justify-content: center; "><img src="img/frog_g_72.webp" style="height:24px;" />&nbsp;<span class="immer-in-font-uc">Immer in</span>&nbsp;<span class="bewegung-font-uc">Bewegung</span></div>
            <div class="menuBar">
                <?php

                $refItems["menu"][($translation["overview"]["title"] ?? 'Overview')] = "index.php";
                $refItems["menu"][($translation["map"]["title"] ?? 'Map')] = "map.php";
                $refItems["menu"][($translation["statistics"]["title"] ?? 'Statistics')] = "statistics.php";
                $refItems["menu"][($translation["dataset"]["title"] ?? 'Dataset')] = "dataset.php";
                $refItems["menu"][($translation["about"]["title"] ?? 'About')] = "about.php";

                foreach ($refItems["menu"] as $refItem => $link) {
                    //background-color:#004c97;color:#fff;
                    if ( $link == basename($_SERVER['SCRIPT_NAME']) || ( $link == "index.php" && basename($_SERVER['SCRIPT_NAME']) == "/" ) ) { $selectedItemMenu = ' style="font-weight:bold;"'; } else { $selectedItemMenu = ""; }
                    echo '<a href="'.$link.'" class="menuItem" id="lang-menu-'.str_replace(".","",strtolower($link)).'" '.$selectedItemMenu.'>'.$refItem.'</a>';
                }
                ?>
            </div>
        </div>

        <div class="container" style="display: flex; flex-direction: column; height: 100vh;max-width:100%;">