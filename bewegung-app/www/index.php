<?php
	include '_data.php';
    $pageTitle = $translation["overview"]["title"] ?? "Overview";
	$contentMargin = "auto";
    include '_head.php';
?>


<h1 class="normal" id="lang-overview-heading"><?php echo $translation["overview"]["heading"] ?? "Trip Overview"; ?></h1>

<div>

	<div id="contentS" style="justify-content:center;flex-wrap:wrap;max-width:100%;background-color:#e3e3e3;padding:5pt;">

		<div style="flex:1;display:flex;position:relative;">
            <input id="searchString" type="text" placeholder="<?php echo $translation["search"]["search-placeholder"] ?? "What are you looking for?"; ?>" style="flex:1;height:25pt;font-size:20pt;padding:5pt;padding-right:35pt;border:3pt solid grey;width:100%;" />
            <button style="position: absolute; right: 6pt; top: 50%; transform: translateY(-50%); height: 25pt;cursor:pointer;position:absolute;background-color:grey;padding:2pt 4pt 2pt 4pt;border-radius:10pt;text-align:center;color:#fff;font-family: 'Francois+One', sans-serif;border:0;" onclick="document.getElementById('searchString').value='';search()" id="lang-search-search-clear"><?php echo $translation["search"]["search-clear"] ?? "Clear"; ?></button>
        </div>

		<div style="flex: 1; display: flex; align-items: center; justify-content: center;margin-top:5pt;">
    		<div style="display: flex; align-items: center; justify-content: center;padding: 5pt 10pt 5pt 10pt;">
				<select id="searchStringPattern" style="width: 80pt; height: 56px; font-size: 20pt; padding: 5pt; border: 3pt solid grey; margin-right: 10pt;">
					<option value="word" default id="lang-search-search-type-exact-word"><?php echo $translation["search"]["search-type-exact-word"] ?? "Exact word"; ?></option>
					<option value="all" id="lang-search-search-type-all"><?php echo $translation["search"]["search-type-all"] ?? "All"; ?></option>
				</select>
				<button class="searchButton" style="align-items: center;padding-left:5pt;" onclick="search();"><img src="img/frog_g_72.webp" style="height:20pt;cursor: pointer;" /> <div  style="padding:13px;" id="lang-search-search-button"><?php echo $translation["search"]["search-button"] ?? "Search"; ?></div></button>

    		</div>
		</div>

	</div>

	<div id="searchResult" style="flex:1;height:100%;"></div>

</div>

<p id="lang-overview-paragraph"><?php echo $translation["overview"]["paragraph"] ?? 'Click on a trip to see details. You can choose between <a href="#year-devision">year</a> and <a href="#country-devision">country</a> division.'; ?></p>

<style>
.trip_table {
  table-layout: fixed ;
  width: 100% ;
}

.trip_category {font-family: 'Francois+One', sans-serif;font-size:0.6em;padding:0.2em;margin-top:0.4em;text-align:left;color:#ffffff;cursor:pointer;border-radius:3pt;display:inline-block;}

</style>

<div id="tripCatCont">
<?php

foreach ( $trip_categories as $trip_category ) {
	if ( in_array($trip_category, array_column($tripBlocks, "TripType") ) ) {
		echo '<div class="trip_category" style="border:1px solid '.$trip_settings[$trip_category]["Color"].';background-color:'.$trip_settings[$trip_category]["Color"].';" onclick="filter_cat(\''.$trip_category.'\')"><span id="mem_'.$trip_category.'">X</span> '.$trip_settings[$trip_category]["Description"].'</div> ';
	}
}

foreach ( $travelGroups as $travelGroup ) {
	echo '<div class="trip_category" style="border:1px solid #000;background-color:#000;" onclick="filter_cat(\''.preg_replace('/[^a-zA-Z0-9\-_\.]/', 'ao',$travelGroup).'\')"><span id="mem_'.preg_replace('/[^a-zA-Z0-9\-_\.]/', 'ao',$travelGroup).'">X</span> '.$travelGroup.'</div> ';
}

?>

</div>

<?php

$min_year = substr(min(array_column($tripBlocks, "DepartureDate")),0,4);
$max_year = substr(max(array_column($tripBlocks, "DepartureDate")),0,4);

?>

<script>
function filter_cat(classel) {
idel=classel;
console.log(idel)
if (document.getElementById("mem_"+idel).innerHTML=='X') {
document.querySelectorAll(".type_"+classel).forEach(function(el) {
	el.style.display = 'none';
	document.getElementById("mem_"+idel).innerHTML='&nbsp;';
});
} else if (document.getElementById("mem_"+idel).innerHTML=='&nbsp;') {
document.querySelectorAll(".type_"+classel).forEach(function(el) {
	el.style.display = 'block';
	document.getElementById("mem_"+idel).innerHTML='X';
});
}
}

function search() {
var searchString = document.getElementById('searchString').value;
var searchStringPattern = document.getElementById('searchStringPattern').value;

history.pushState({s: searchString, p: "ja"}, "", "?s="+searchString+"&p="+searchStringPattern);

var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById('searchResult').innerHTML=this.responseText;
    }
};
xhr.open('GET', 'search.php?s=' + encodeURIComponent(searchString) + '&p=' + encodeURIComponent(searchStringPattern), true);
xhr.send();
}

// Automatic search onLoad
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const s = urlParams.get("s");
const p = urlParams.get("p");
if (s && p) {
	document.getElementById('searchString').value=s;
	document.getElementById('searchStringPattern').value=p;
	search();
}
// Automatic search onLoad END

/*
// Auto search when typing in
var input = document.getElementById('searchString');
input.addEventListener('keydown', function(event) {
    if (event.keyCode) {
        search();
    }
});
*/

var input = document.getElementById('searchString');
input.addEventListener('keydown', function(event) {
    if (event.keyCode === 13) {
        search();    }
});
</script>

<table class="trip_table" style="width:100%;">

<tr><td class="trip_table_division" colspan="10" style="background-color:#000000;color:#ffffff;text-align:center;" id="lang-overview-division-year"><a name="year-devision"></a><?php echo $translation["overview"]["division-year"] ?? "Division: Year"; ?></td></tr>

<?php

//Skapa årsarray och bryt vid var tioende

$years=[];

for ($x = 0; $x < substr($min_year,3,1); $x++) {
 $years[]="";
}

for ($x = $min_year; $x <= $max_year; $x++) {
  $years[]=$x;
}

$years=array_chunk($years, 10);

foreach ($years as $decade) {
	if (substr($decade[0],2,2)!="") { $decade_title=substr($decade[0],2,2); } else { $decade_title=substr($min_year,2,1)."0"; }
	echo '<tr><td class="trip_table_division" colspan="10" style="text-align:center;font-weight:bold;border:0.2em solid #000000;">'.$decade_title.'<span id="lang-overview-century">'.($translation["overview"]["century"] ?? "s").'</span></td></tr>';
	echo '<tr style="vertical-align:top;">';
	foreach ($decade as $year) {
		echo '<td style="text-align:center;">'.$year;

		foreach ($tripBlocks as $tripBlock) {
			if (substr($tripBlock["DepartureDate"],0,4)==$year) {

				$trip_color = $trip_settings[$tripBlock["TripType"]]["Color"];

				// ### Räkna antalet länder
				// Ta bort innehåll i hakparenteser och hakparenteserna själva
				$total_countries = preg_replace("/\[[^)]+\]/","",$tripBlock["CountryTripMovements"]);

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
				$patterns = '/SE|DK|NOD|STO|Sverige/';
				foreach ($total_array as $key => $value) {
					if (preg_match($patterns, $value)) {
						unset($total_array[$key]);
					}
				}

				//Räkna antalet element
				$amount_countries = count($total_array);
				echo '<a href="trip.php?id='.urlencode($tripBlock["TripID"]).'" class="type_'.$tripBlock["TripType"].' type_'.preg_replace('/[^a-zA-Z0-9\-_\.]/', 'ao',$tripBlock["TravelGroup"]).'"><div id="'.$tripBlock["TripID"].'" style="font-size:0.5em;padding:0.2em;margin-top:0.4em;text-align:left;border:1px solid '.$trip_color.';background-color:'.$trip_color.';color:#ffffff;cursor:pointer;border-radius:3pt;"><b>(+'.$amount_countries.')</b> '.$tripBlock["TripID"].' '.$tripBlock["OverallDestination"].'</div></a>';

			}
		}
		echo '</td>';
	}
	echo '</tr>';
}

?>



<tr><td class="trip_table_division" colspan="10" style="background-color:#000000;color:#ffffff;text-align:center;"  id="lang-overview-division-country"><a name="country-devision"></a><?php echo $translation["overview"]["division-country"] ?? "Division: Country"; ?></td></tr>

<?php

//SORTERA FRAM NAMNEN PÅ LÄNDERNA I URVALET

$country_active=[];
foreach ($tripBlocks as $tripBlock) {
	// Ta bort innehåll i hakparenteser och hakparenteserna själva
	$tripBlock["CountryTripMovements"] = preg_replace("/\[[^)]+\]/","",$tripBlock["CountryTripMovements"]);

	$temp=explode(",",$tripBlock["CountryTripMovements"]);
	foreach ($temp as $temp2) {
		if (strpos($temp2, 'SE') === false && strpos($temp2, 'NOD') === false && strpos($temp2, 'STO') === false && strpos($temp2, 'DK') === false ) {
			$temp2=str_replace("[","",$temp2);
			$temp2=str_replace("]","",$temp2);
			$temp2=str_replace("(","",$temp2);
			$temp2=str_replace(")","",$temp2);
			$country_active[]=trim($temp2);
		}
	}
}
$country_active=array_unique($country_active);
sort($country_active);
//print_r($country_active);

$countries_array=[];

//Sorterar fram aktuellt urval
foreach ($countries_array_original as $worldpart => $country2) {
foreach ($country2 as $country) {
	if (in_array($country,$country_active)) { $countries_array[$worldpart][]=$country; }
}


//print_r($countries_array);

}

$cont=0;
$keys=array_keys($countries_array);
foreach ($countries_array as $continent) {
	echo '<tr><td class="trip_table_division" colspan="10" style="text-align:center;font-weight:bold;border:0.2em solid #000000;">'.$keys[$cont].'</td></tr>';
	$columns=5; //Ändra även colspan nedan, 10 måste vara delbart med talet till vänster och talet nedan
	$counter=0;
	$open_loop=false;
	foreach ($continent as $country) {
		if ($open_loop==false) { echo '<tr>'; $open_loop=true; }
		echo '<td colspan="2" style="text-align:center;vertical-align:top;;"><div class="trip_table_country_category">'.$country.'</div>';
			foreach ($tripBlocks as $tripBlock) {

				$trip_color = $trip_settings[$tripBlock["TripType"]]["Color"];

				// ### Räkna antalet länder
				// Ta bort innehåll i hakparenteser och hakparenteserna själva
				$total_countries = preg_replace("/\[[^)]+\]/","",$tripBlock["CountryTripMovements"]);

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
				$patterns = '/\{SE\}|\{DK\}|\{NOD\}|\{STO\}|Sverige/';
				foreach ($total_array as $key => $value) {
					if (preg_match($patterns, $value)) {
						unset($total_array[$key]);
					}
				}

				//Räkna antalet element
				$amount_countries = count($total_array);


				if (strpos(preg_replace("/\[[^)]+\]/","",$tripBlock["CountryTripMovements"]),$country) !== false) { echo '<a href="trip.php?id='.urlencode($tripBlock["TripID"]).'" class="type_'.$tripBlock["TripType"].' type_'.preg_replace('/[^a-zA-Z0-9\-_\.]/', 'ao',$tripBlock["TravelGroup"]).'"><div style="font-size:0.5em;padding:0.2em;margin-top:0.4em;text-align:left;border:1px solid '.$trip_color.';background-color:'.$trip_color.';color:#ffffff;cursor:pointer;border-radius:3pt;">'.substr($tripBlock["DepartureDate"],0,4).' <b>(+'.$amount_countries.')</b> '.$tripBlock["TripID"].' '.$tripBlock["OverallDestination"].'</div></a>'; }
			}
		echo '</td>';
		$counter+=1;
		if ($counter % $columns == 0) { echo '</tr>'; $open_loop==false; }
	}
	echo '</tr>';
	$cont+=1;
}

?>

</table>


<?php include '_foot.php'; ?>