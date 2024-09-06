<!DOCTYPE html>
<html lang="en">

<head>
    
    <link rel="shortcut icon" href="favicon.webp" />
    <meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <title><?php echo $pageTitle; ?> - Immer in Bewegung</title>
    <link href="https://fonts.googleapis.com/css?family=Cairo|Francois+One|Merriweather|Righteous" rel="stylesheet">

    <meta name="mobile-web-app-capable" content="yes">
    <link rel="manifest" href="manifest.json">
    <meta name="theme-color" content="grey" id="themeColorMeta">
    <meta name="msapplication-navbutton-color" content="#e3e3e3">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel=icon href="favicon.webp">-->


    <style>
        html {height:100%;}
        body{margin: 0;padding: 0;font-family: 'Merriweather', serif;height:100%;font-size:1.2em;}
        .topBarContainer {z-index:1001;position:sticky;top:0;}
        .topBar {padding: 0pt;background-color:grey;color:#fff;text-align: center;}
        .menuBar {display: flex;flex-wrap: wrap;background-color:#f1f1f1;justify-content: space-between;gap:1pt;border-bottom:3pt solid grey;}
        .menuBar > a {background-color:#e3e3e3;font-family: 'Francois+One', sans-serif;text-align: center;flex:1;cursor:pointer;padding:5pt;color:#000;}
        .menuBar > a:hover {background-color:#b3b3b3;color:#fff;text-decoration:none;}
        
        .container {margin:<?php echo $contentMargin; ?>;<?php if($widthRestriction !== false){ echo "max-width:50em;width:50em;"; } ?>}
        .normal { margin-top:20pt;margin-bottom:10pt;}

        .inputDataContainer {background-color:grey;padding:2pt;margin:auto;display:inline-block;margin-top:20pt;}
        .inputDescription {background-color:#fff2cc;margin-right:2pt;text-align:left;line-height:2rem;padding-left:5pt;padding-right:5pt;text-align:center;}
        .inputData {display:flex;flex-direction:row;}
        .inputDataTextarea {
            
            font-family: 'Segoe UI';font-size:14pt;height:217pt;width:200pt;border:0;
            
            background-image: linear-gradient(#F1F1F1 50%, #F9F9F9 50%);
            background-size: 100% 4rem;
            background-attachment: local;
            line-height: 2rem;
            margin: 0 auto;
            padding: 0pt 4pt;
            
        }
        textarea:focus {outline: none;}
        .inputDataSyntaxCheck {line-height: 2rem;background-color:grey;font-size:14pt;width:25pt;}

        select {font-family: 'Francois+One', sans-serif;font-size:14pt;border:2pt solid grey;padding:5pt;}
        
        /*
        input[type=text], input[type=date], input[type=datetime-local] {font-family: 'Segoe UI';font-size:14pt;border:2pt solid grey;padding:5pt;}
        .textareaStd {font-family: 'Segoe UI';font-size:14pt;border:2pt solid grey;padding:5pt;}
        */
        
        input[type=text], select { font-family: 'Francois+One', sans-serif; }

        .immer-in-font-uc {font-family: 'Cairo', sans-serif;text-transform: uppercase;}
        .bewegung-font-uc {font-family: 'Righteous', sans-serif;text-transform: uppercase;}

        .trip_table, .trip_table_details {background-color:#e1e1e1;font-family: 'Francois+One', sans-serif;margin-top:10pt;}
        thead {font-weight:bold;}
        td {padding:5pt;}
        .imagesBar {
            padding: 5pt;
            background-color: #e3e3e3;
            font-family: 'Francois+One', sans-serif;
            display:flex;
            font-weight:bold;
            align-items: center;
            gap:2pt;
        }

        .button {padding: 10pt 10pt 10pt 10pt;background-color: #004c97;color: #fff;text-align: center;margin:auto;margin-top:10pt;width:209pt;}
        .button:hover {background-color:#abd5ff;color:#000;cursor:pointer;}
        .button_inactivated {padding: 10pt 10pt 10pt 10pt;background-color:grey;
            color: #fff;text-align: center;margin:auto;margin-top:10pt;width:209pt;cursor:default;}

        .filterButton {background-color:#e5f2ff;border-radius:10pt;padding:4pt 7pt 4pt 7pt;cursor:pointer;}
        
        a {color:#1d655e;text-decoration:none;}

        h1 {display:block;font-family: 'Cairo', sans-serif;font-weight:bold;color:#000000;font-size:3em;line-height:1.2em;margin-bottom:20pt;}
            h2 {margin-bottom:0;}
        .iib-action-button {
            margin-top: 10pt;
            display: inline-block;
            background-color: #000000;
            color: #ffffff;
            padding: 2pt;
            border-radius: 2pt;
        }

        .searchButton {font-family: 'Francois+One', sans-serif;font-size:18pt;background-color:grey;color:#fff;display:flex;cursor:pointer;border:0;}
        .searchButton:hover {background-color:#b3b3b3;}

        #aboutTop, #openinLogoSmall{display:none;}

        #statComment, #statSummary tr:nth-child(even), #nightPerCountry tr:nth-child(even), #visitsPerCountry tr:nth-child(even) {
            background-color: #e3e3e3; /* Color for even rows */
        }
        #chartFlex {height:300pt;}
        .searchDay {background-color:#e3e3e3;}

        #trip_nav {margin-top:20pt;}

        #searchResult{height:;}

        /* ##### ANNAN CSS FÖR MINDRE SKÄRM ##### */
        @media (max-width: 1440px) {
            .trip_image_button {font-size:1.2em;}
            .trip_table {overflow:hidden;} /* word-break:break-all; */
            .trip_table tr {display: grid;grid-template-columns: repeat(5, 1fr);}
            .trip_table_division {grid-column: 1 / span 5;}
            .trip_table_country_category {hyphens:auto;line-height:10pt;font-size:0.7em;} /* word-break:break-all; */
            #iib-foot, #menuItem_Sync, #menuItem_About, #prevDayText, #nextDayText, #backText, #openinText, #openinLogo, #tripOverview {display:none;}
            #aboutTop, #openinLogoSmall {display:inline-block;}
            .topBar, .menuBar{font-size:14pt;}
            #visitsPerCountry {font-size:9pt;margin-top:5pt;}
            #visitsPerCountry td {padding:0pt;}
            #overviewInfotext {margin:5pt;}
            #tripCatCont{margin:10pt 2pt 0pt 2pt;}
            #chartFlex {height:200pt;}
            .normal {font-size:30pt;margin:0;}
            input::placeholder {font-size: 17pt;}
            #overviewInfotext{display:none;}
            #trip_nav {margin-top:2pt;}
            #map {height:250pt !important;}
        }
        /* ##### ANNAN CSS FÖR MINDRE SKÄRM ##### */

        /* ##### ANNAN CSS FÖR DARK MODE ##### */
        @media (prefers-color-scheme: dark) {
            body, .trip_table, .menulink, thead, .trip_table_details {background-color:#000 !important;}
            h1, h2,body, .menulink, thead, .trip_table_details, #update > div {color:#fff !important;}
            .trip_table_division {background-color:#333333 !important;}
            .trip_table {background-color:#333;}
            input[type="text"], #searchStringPattern, select {background-color:#444 !important;color:#fff;}
            .trip_table_details, menu {background-color:#333 !important;}
            .searchButton, .trip_image_button {background-color:grey;}
            .imagesBar{background-color:#555 !important;}
            .nightNumber{color:#000;}
            .topBar{background-color:#333 !important;}
            .menuItem{background-color:#000 !important;color:#fff !important;}
            .searchDay {background-color:#666;}
            #updateText {color:#000 !important;}
            #statComment, #statSummary tr:nth-child(even), #nightPerCountry tr:nth-child(even), #visitsPerCountry tr:nth-child(even) {
                background-color: #333; /* Color for even rows */
            }
            #contentS{background-color:#333 !important;}
            .menuBar {border-bottom:3pt solid #555;background-color:#333 !important;}
        }
        /* ##### ANNAN CSS FÖR DARK MODE ##### */

    </style>

    <script>

        const themeColorMeta = document.querySelector('meta[name="theme-color"]');

        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        themeColorMeta.setAttribute('content', 'black');  // Dark mode color
        } else {
        themeColorMeta.setAttribute('content', 'grey');   // Light mode color
        }

        // Optional: Listen for changes in the color scheme
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
        themeColorMeta.setAttribute('content', event.matches ? 'black' : 'grey');
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

                $refItems["menu"]["Overview"]="index.php";
                $refItems["menu"]["Map"]="map.php";
                $refItems["menu"]["Statistics"]="statistics.php";
                $refItems["menu"]["Sync"]="sync.php";
                $refItems["menu"]["About"]="about.php";

                foreach ($refItems["menu"] as $refItem => $link) {
                    //background-color:#004c97;color:#fff;
                    if ( $link == basename($_SERVER['SCRIPT_NAME']) || ( $link == "index.php" && basename($_SERVER['SCRIPT_NAME']) == "/" ) ) { $selectedItemMenu = ' style="font-weight:bold;"'; } else { $selectedItemMenu = ""; }

                    echo '<a href="'.$link.'" class="menuItem" id="menuItem_'.$refItem.'"'.$selectedItemMenu.'>'.$refItem.'</a>';
                }
                ?>
            </div>
        </div>

        <div class="container" style="display: flex; flex-direction: column; height: 100vh;max-width:100%;">