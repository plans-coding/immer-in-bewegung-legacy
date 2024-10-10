<?php
  include '_data.php';
  $pageTitle = $translation["statistics"]["title"] ?? "Statistics";
  $contentMargin = "auto";
  include '_head.php';
	include 'dep/chartjs/chartjs.php';

?>
<div style="margin:0 5pt 0 5pt;">
<?php

echo '<h1 class="normal" id="lang-statistics-title">'.($translation["statistics"]["title"] ?? "Statistics").'</h1>';

//print_r($tripDetails);
//print_r($trip_categories);

$countryStats = [];
$accommodation_countries = [];
$total_trips = [];

foreach ($tripBlocks as $tripBlock) {
	
	$total_trips[$tripBlock["TripType"]] = 0;

}

// Antal resor per typ
foreach ($tripBlocks as $tripBlock) {

	$total_trips[$tripBlock["TripType"]] += 1;

	// Ta bort förtydligande kommentarer inom { och }
	$tripBlock["CountryTripMovements"] = preg_replace("/\{.*?\}/", "", $tripBlock["CountryTripMovements"]);

	$countries = explode(",", $tripBlock["CountryTripMovements"]);
	$countries = array_map('trim', $countries);
	$countries = array_filter($countries, 'trim');

	$countriesMultiple = $countries;
	$countriesUnnique = array_unique($countries);

	// Ett kvalificerat besök per resa 
	foreach ( $countriesUnnique as $countryUnique ) {
		$countryStats[$countryUnique] = ($countryStats[$countryUnique] ?? 0) + 1;
	}

	// Flera kvalificerade besök per resa
	foreach ( $countriesMultiple as $countryMultiple ) {
		$countryStatsMulti[$countryMultiple] = ($countryStatsMulti[$countryMultiple] ?? 0) + 1;
	}

}

// Antal länder totalt
$totalCountries = [];
foreach ( $countryStats as $countryStat => $value ) {
	// Plockar både *, ** (behövs ej explicit) och +
	if ( strpos($countryStat, "*") === false && strpos($countryStat, "+") === false ) {
		$totalCountries[] = explode("-",$countryStat)[0];
	}
}
$totalCountries = array_unique($totalCountries);
//$key = array_search("Sweden", $totalCountries);

if ($key !== false) {
    unset($totalCountries[$key]);
}
asort($totalCountries);
//print_r($totalCountries);

arsort($countryStats);
//print_r($countryStats);
//print_r($countryStatsMulti);

// Antal besök per land samt antal övernattningar

foreach ( $tripDetails as $tripDetail ) {
	foreach ( $tripDetail as $day ) {
		if ( in_array($day["TripType"],array_column($settings["trip-categories"],"category-abbreviation")) ) {
			$accommodation_countries[$day["AccommodationCountry"]] = ($accommodation_countries[$day["AccommodationCountry"]] ?? 0) + 1;
		}
	}
}

arsort($accommodation_countries);

$chartLabel = "";
$chartData = "";
$chartColor = "";
$chartTotalTrips = 0;
foreach ( $settings["trip-categories"] as $tripType ) {
	$chartLabel .= "'".$tripType["category"]."', ";
	$chartData .= "".$total_trips[$tripType["category-abbreviation"]].", ";
	$chartColor .= "'#".$tripType["category-color"]."', ";
	$chartTotalTrips += $total_trips[$tripType["category-abbreviation"]];
}

//print_r($stat_countries);
//print_r($accommodation_countries);
?>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 5pt; padding: 0;max-width:100%;">
    <div style="">
		<div><span id="lang-statistics-unique-countries"><?php echo ($translation["statistics"]["unique-countries"] ?? "Count of unique countries"); ?></span></div>
		<div style="line-height:1em;font-family: 'Cairo', sans-serif;font-weight: bold;font-size:3em;"><?php echo sizeof($totalCountries); ?></div>
	</div>
    <div style="text-align:right;">
		<span id="lang-statistics-total-trips"><?php echo ($translation["statistics"]["total-trips"] ?? "Number of trips in total"); ?></span><br />
		<span style="line-height:1em;font-family: 'Cairo', sans-serif;font-weight: bold;font-size:3em;"><?php echo $chartTotalTrips; ?></span>
	</div>
</div>

<canvas id="statOverview" style="width:400pt;max-width:100%;margin:auto;"></canvas>


<br />
<script>
  const ctx = document.getElementById('statOverview');

  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: [<?php echo $chartLabel; ?>],
      datasets: [{
        label: 'Trip Count',
        data: [<?php echo $chartData; ?>],
		backgroundColor: [
			<?php echo $chartColor; ?>
        ],
        borderWidth: 1
      }],
    },
    options: {
		plugins: {
        legend: {
          position: 'top'
        }
      },
    }
  });
</script>

<?php

echo '<div style="text-align:center;margin-bottom:20pt;"><h2>'.($translation["statistics"]["visit-country-count"] ?? "Count over visits per country").'</h2></div>';

echo '<div style="overflow-x: clip;">';
echo '<table style="border-collapse: collapse;" id="visitsPerCountry">';

echo '<thead style="position:sticky;top:0;background-color:'.$bodyBackgroundColor.';">';
echo '<tr style="font-weight:normal;"><td></td><td colspan="3"><i>'.($translation["statistics"]["1-qualified"] ?? "One qualified visit per trip").'</i></td><td><i>'.($translation["statistics"]["many-qualified"] ?? "More than one qualified visit per trip").'</i></td><td><i>'.($translation["statistics"]["border-crossings"] ?? "Border crossings (in and out)").'</i></td></tr>';
echo '<tr><td><b>'.($translation["statistics"]["country"] ?? "Country").'</b></td><td><b>'.($translation["statistics"]["ordinary-length"] ?? "Ordinary length").'</b></td><td><b>'.($translation["statistics"]["shorter-stop"] ?? "Shorter stop incl.").'</b></td><td><b>'.($translation["statistics"]["short-very-short"] ?? "Shorter and very short stop incl.").'</b></td><td><b>'.($translation["statistics"]["ordinary-length"] ?? "Ordinary length").'</b></td><td><b>'.($translation["statistics"]["minimal-number"] ?? "Minimal number").'</b></td></tr>';
echo '</thead>';

//print_r($stat_countries);

// Ensure $countryStats is set and is an array
if (isset($countryStats) && is_array($countryStats)) {
    foreach ($countryStats as $countryStat => $value) {
        // Check if the current key does not start with '*' or '+' (and '**' is implicitly included)
        if (strpos($countryStat, "*") === false && strpos($countryStat, "+") === false) {
            
            // Initialize variables to avoid undefined index notices
            $valueStar = isset($countryStats['*'.$countryStat]) ? $countryStats['*'.$countryStat] : 0;
            $valueDoubleStar = isset($countryStats['**'.$countryStat]) ? $countryStats['**'.$countryStat] : 0;
            $valuePlus = isset($countryStats['+'.$countryStat]) ? $countryStats['+'.$countryStat] : 0;

            $valueMulti = isset($countryStatsMulti[$countryStat]) ? $countryStatsMulti[$countryStat] : 0;
            $valueMultiStar = isset($countryStatsMulti['*'.$countryStat]) ? $countryStatsMulti['*'.$countryStat] : 0;
            $valueMultiDoubleStar = isset($countryStatsMulti['**'.$countryStat]) ? $countryStatsMulti['**'.$countryStat] : 0;
            $valueMultiPlus = isset($countryStatsMulti['+'.$countryStat]) ? $countryStatsMulti['+'.$countryStat] : 0;

            $totalMulti = ($valueMulti + $valueMultiStar + $valueMultiDoubleStar + $valueMultiPlus) * 2;

            echo '<tr><td>'.$countryStat.'</td><td>'.$value.'</td><td>'.($value + $valueStar).'</td><td>'.($value + $valueDoubleStar).'</td><td>'.$valueMulti.'</td><td>'.$totalMulti.'</td></tr>';
        }
    }
} else {
    echo 'No country stats available.';
}


echo '</table>';
echo '</div>';
?>


<div id="statComment" class="roundBorder" style="padding:10pt;font-family: 'Francois+One', sans-serif;margin-top:10pt;">
<?php echo ($translation["statistics"]["note"] ?? "All columns display visits of significant importance. The actual number of border crossings may therefore
be greater than reported. Stops that are crucial for the travel experience are considered significant.
A qualified visit is defined as a visit that does not resume a previous visit after a break caused by a
short or very short visit to another country."); ?>
</div>
<br />

<?php

echo '<div style="text-align:center;"><h2>'.($translation["statistics"]["overnight-stays-country"] ?? "Number of overnight stays per country").'</h2>';

echo '<div style="margin-top:10pt;margin-bottom:10pt;"><b>'.($translation["statistics"]["top-ten-countries"] ?? "Top ten countries").'</b></div><canvas id="statPerCountry" style="width:425pt;max-width:100%;margin:auto;"></canvas>';

echo '</div>';

//echo '<div style="overflow:hidden;overflow-x: auto;">';
echo '<table style="margin:auto;margin-top:20pt;" cellspacing="0" id="nightPerCountry">';
echo '<thead style="position:sticky;top:0;background-color:'.$bodyBackgroundColor.'"><tr style=""><td><b>'.($translation["statistics"]["country"] ?? "Country").'</b></td><td><b>'.($translation["statistics"]["overnight-stays"] ?? "Overnights").'</b></td></tr></thead>';

foreach ( $accommodation_countries as $accommodation_country => $value ) {
	if ( $value != 0) { echo '<tr><td>'.$accommodation_country.'</b></td><td style="text-align:center;">'.$value.'</td></tr>'."\n"; }
}

echo '</table>';

$chartLabelPC = "";
$chartDataPC = "";
$chartPcno = 0;
foreach ( $accommodation_countries as $accommodation_country => $value ) {
	if ($chartPcno == 10) {break;}
	if ( $value != 0) {
		$chartLabelPC .= "'".$accommodation_country."', ";
		$chartDataPC .= "".$value.", ";
	}
	$chartPcno += 1;
}

?>

<script>
  const ctx2 = document.getElementById('statPerCountry');

  new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: [<?php echo $chartLabelPC; ?>],
      datasets: [{
        label: 'Number of overnight stays',
        data: [<?php echo $chartDataPC; ?>],
		backgroundColor: [
			'<?php echo $darkColor; ?>'
        ],
        borderWidth: 1
      }],
    },
    options: {
		indexAxis: 'y',
		plugins: {
		legend: {
		display: false
		},
	}
    }
  });
</script>


<?php include '_foot.php'; ?>
