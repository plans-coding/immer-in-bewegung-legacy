<?php

    $latestV = @file_get_contents('https://raw.githubusercontent.com/plans-coding/immer-in-bewegung/main/bewegung-app/www/version');
    $currentV = @file_get_contents('version');

    if ($latestV === false) {
        $error = error_get_last();
        //echo 'Error reading file: ' . $error['message'];
    } else {
        if ( $latestV != $currentV ) { echo '<div style="display:inline-block;padding:5pt;margin-top:10pt;background-color:rgb(255,248,220);font-family: \'Francois+One\', sans-serif;color:#000;">A new update is available <b>'.$latestV."</b></div>"; }
    }

    


?>
