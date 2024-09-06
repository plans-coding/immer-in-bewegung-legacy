<?php

include '_data.php';

//######
// Listar ["A" => "0", "B" => "1", "C" => "2"] etc
$column_letter = range('A', 'Q');
$column_number = range(0, 16);
$column = array_combine($column_letter, $column_number);
$trip_match = false;
$day_match = false;
//######
?>
<style>
.searchResult {
    border-collapse: separate;
    border-spacing: 0 5pt;
	width:100%;
}

.searchResult tr {
    border-bottom: 10pt;
}
</style>
<?php

$search = $_GET["s"];
$searchStringPattern = urldecode($_GET["p"]);

switch ($searchStringPattern) {
    case 'word':
        $searchStringPattern = "/\\b$search\\b/i";
        break;
    case 'all':
        $searchStringPattern = "/$search/i";
        break;
}

if ($search) {
	echo '<div style="font-size:10pt;margin-top:10pt;font-family: \'Francois+One\', sans-serif;">';
	foreach ($tripBlocks as $tripBlock) {

		$color = $trip_settings[$tripBlock["TripType"]]["Color"];
		//if ($tripBlock[$column["A"]]=="U") { $color=$abroad_color; } else if ($tripBlock[$column["A"]]=="I") { $color=$sweden_color; } else if ($tripBlock[$column["A"]]=="D") { $color=$denmark_color; } else { $color="#e3e3e3"; }

		if (preg_grep($searchStringPattern, $tripBlock)) { //Ord: /\\b$search\\b/i Alla: /$search/i
			if (! $trip_match) { echo '<div style="margin-bottom:5pt;font-size:14pt;"><b>Trips</b></div>'; $trip_match = true; } //Visa rubrik

			echo '<a href="trip.php?id='.urlencode($tripBlock["TripID"]).'"><div style="border-radius:3pt;color:#fff;background-color:'.$color.';margin-bottom:5pt;align-items: center;padding:5pt;">';
			echo '<div style="width:40pt;display:inline-block;">'.$tripBlock["TripID"].'</div>';
			echo '<div style="width:120pt;display:inline-block;"><div style="display:inline;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;">'.$tripBlock["OverallDestination"].'</div></div>';
			echo '<div style="margin-left:10pt;width:140pt;display:inline-block;">'.$tripBlock["DepartureDate"].' - '.$tripBlock["ReturnDate"].' ('.$tripBlock["NumberOfDays"].' d)</div>';
			//echo '<div style="width:50pt;display:inline-block;">'..' dagar</div>';
			echo '<div style="width:auto;display:inline-block;">'.$tripBlock["TripDescription"].'</div>';
			echo '</div></a>';
		}

	}

	echo '<div style="font-size:10pt;margin-top:10pt;font-family: \'Francois+One\', sans-serif;">';
	foreach ($tripDetails as $tripDetail) {
		foreach ($tripDetail as $day) {
			if (preg_grep($searchStringPattern, $day)) { //Ord: /\\b$search\\b/i Alla: /$search/i
				$color = $trip_settings[substr($day["TripNumber"],0,1)]["Color"];
				//if ($day[$column["P"]]=="U") { $color=$abroad_color; } else if ($day[$column["P"]]=="I") { $color=$sweden_color; } else if ($day[$column["P"]]=="D") { $color=$denmark_color; } else { $color="#e3e3e3"; }

				if (! $day_match) { echo '<div style="margin-bottom:5pt;font-size:14pt;"><b>Day notes</b></div>'; $day_match = true; } //Visa rubrik

				echo '<div class="searchDay" style="border-radius:3pt;margin-bottom:5pt;padding:5pt;">';
				echo '<div style="margin-bottom:5pt;display:flex;gap:2pt;align-items:center;flex-wrap:wrap;">';
				echo '<div style="padding:1pt 3pt 1pt 3pt;background-color:'.$color.';border-radius:2pt;"><a style="color:#fff;" href="trip.php?id='.$tripNumber2ID[$day["TripNumber"]].'#'.$day["Date"].'">'.$tripNumber2ID[$day["TripNumber"]].' '.$day["OverallDestination"].'</a></div>';
				echo '<div style="padding:1pt 3pt 1pt 3pt;background-color:#000;border-radius:2pt;"><a style="color:#fff;" href="images.php?trip='.$tripNumber2ID[$day["TripNumber"]].'&date='.str_replace("-","",$day["Date"]).'">'.$day["Date"].'</a></div>';
				echo '<div style="margin-left:auto;font-weight:bold;"><img style="height:0.9em;" src="img/house.svg"> <a target="_blank" style="color:'.$color.';" href="https://www.google.com/maps/?q='.str_replace(" ","",$day["AccommodationCoordinates"]).'">'.explode(",",$day["Accommodation"])[0]." ".$day["AccommodationCountry"].'</a></div></div>';
				echo '<div>'.$day["Events"].'</div>';
				//echo '<div style="margin-top:5pt;font-weight:bold;"></div>';
				echo '</div>';
			}
		}

	}

	if (! $trip_match && ! $day_match ) { echo '<div style="margin-bottom:5pt;font-size:14pt;"><b>No search result</b></div>'; }

}

?>