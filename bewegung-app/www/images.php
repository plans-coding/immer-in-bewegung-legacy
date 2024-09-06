<?php
    $pageTitle = "Trip Images";
    $contentMargin = "0";
    $widthRestriction = false;
    $noFoot = true;
    include '_head.php';
	include '_data.php';
?>
<?php

$date_standard=substr($_GET["date"],0,4).'-'.substr($_GET["date"],4,2).'-'.substr($_GET["date"],6,2);
$trip_id=$_GET["trip"];
if (explode("-",$_GET["trip"])[0]=="AA") { $trip_id="AÄ-".explode("-",$_GET["trip"])[1]; }

$date=$_GET["date"];

//:2283
$immich_href = $settings["immich-settings"][0]["immich-server-address"].'search?query=%7B%22takenAfter%22%3A%22'.
substr($_GET["date"],0,4).'-'.
substr($_GET["date"],4,2).'-'.
substr($_GET["date"],6,2).
'T00%3A00%3A00.000Z%22%2C%22takenBefore%22%3A%22'.
substr($_GET["date"],0,4).'-'.
substr($_GET["date"],4,2).'-'.
substr($_GET["date"],6,2).
'T23%3A59%3A59.999Z%22%7D';

//### Ta fram datum som hör till resa

$s_res = array_search($_GET["trip"],array_column($tripBlocks[$_GET["trip"]], "DepartureDate"));

$period = new DatePeriod(
     new DateTime($tripBlocks[$_GET["trip"]]["DepartureDate"]), //Startdatum
     new DateInterval('P1D'),
     (new DateTime($tripBlocks[$_GET["trip"]]["ReturnDate"]))->modify('+1 day') //Slutdatum
);

$dropdown='<select name="date_dd" id="date_dd" style="font-size:16pt;padding:5pt;border:3pt solid grey;display:inline-block;" onchange="document.location=\'?trip='.$_GET["trip"].'&date=\'+this.value">';
foreach ($period as $key => $value) {
	if ($value->format('Ymd') == $_GET["date"] ) { $selected="selected"; } else { $selected=""; }
	$dropdown.='<option value="'.$value->format('Ymd').'" '.$selected.'>'.$value->format('Y-m-d').'</option>'."\n";
}
$dropdown.='</select>';

$i=0;
$prev="";
$next="";

foreach ($period as $key => $value) {

	if ($value->format('Ymd') == $_GET["date"] && $i!=0) { $prev="?trip=".$_GET["trip"]."&date=".Date("Ymd",strtotime('-1 day',strtotime($value->format('Ymd')) ) ); }
	if ($value->format('Ymd') == $_GET["date"] && $i!=(iterator_count($period)-1)) { $next="?trip=".$_GET["trip"]."&date=".Date("Ymd",strtotime('+1 day',strtotime($value->format('Ymd')) ) ); }

$i++;
}

?>

<div class="imagesBar">
    <div style="display: flex; align-items: center; flex: 1;">
        <?php
            if ($prev!="") {
                echo '<a href="'.$prev.'" style="display: flex; align-items: center;color:'.$trip_settings[$tripBlocks[$_GET["trip"]]["TripType"]]["Color"].';"><img src="img/plans_arrow.php?color='.str_replace("#","",$trip_settings[$tripBlocks[$_GET["trip"]]["TripType"]]["Color"]).'" style="height:18pt;margin-right:5pt;" /><b id="prevDayText">Previous day</b></a>';
            }
        ?>
    </div>
    <div style="flex:1;text-align:center;">
    <?php echo '<a href="trip.php?id='.$_GET["trip"].'"><div style="background-color:'.$trip_settings[$tripBlocks[$_GET["trip"]]["TripType"]]["Color"].';display:inline-block;padding:5pt;border-radius:2pt;color:#fff;"><span id="backText">Back to trip </span>'.$_GET["trip"].'</div></a>'; ?>
    </div>
    <div style="flex:1;text-align:center;">
        <?php echo $dropdown; ?>
    </div>
    <div style="flex:1;text-align:center;">
    <?php echo '<a href="'.$immich_href.'" target="_blank" style="display: inline-flex; align-items: center;padding:5pt;border-radius:2pt;color:#fff;justify-content: center;background-color:#000;"><span id="openinText">Open in&nbsp;</span><img id="openinLogo" src="img/immich-logo-inline-dark.png" style="height:18pt;margin-right:5pt;vertical-align:middle;" /><img id="openinLogoSmall" src="img/immich-logo-inline-dark-small.png" style="height:18pt;vertical-align:middle;" /></a>'; ?>
    </div>
    <div style="flex:1;text-align:right;">
        <?php
            if ($next!="") {
                echo '<a href="'.$next.'" style="display: flex; align-items: center;justify-content: flex-end;color:'.$trip_settings[$tripBlocks[$_GET["trip"]]["TripType"]]["Color"].'"><b id="nextDayText">Next day</b><img src="img/plans_arrow.php?color='.str_replace("#","",$trip_settings[$tripBlocks[$_GET["trip"]]["TripType"]]["Color"]).'" style="height:18pt;margin-left:5pt;transform: rotate(180deg);" /></a>';
            }
        ?>
    </div>
</div>

<?php
/* echo '<div style="padding:10pt;background-color:#e0fae0;margin-bottom:20pt;">Samtliga bilder visas. Det kan till exempel bero på att bilderna inte är datummarkerade fullt ut.</div>';*/
?>

<!-- Immich integration -->
<div style="flex-grow: 1;">
    <iframe id="immich_iframe" src="<?php echo $immich_href; ?>" style="display: block;width:100%;height:100%;border:0;"></iframe>
</div>
<!-- Immich integration end -->

<?php include '_foot.php'; ?>