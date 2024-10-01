<?php
    include '_data.php';
    $pageTitle = $translation["sync"]["title"] ?? "Sync";
    $contentMargin = "auto";
    include '_head.php';
?>

<div style="margin:10pt;">
<h1 class="normal" id="lang-sync-title"><?php echo $translation["sync"]["title"] ?? "Sync"; ?></h1>
<p id="lang-sync-first-pg"><?php echo $translation["sync"]["first-pg"] ?? "Download your latest trip data from Google Sheet. You need to be logged on in advance to perform actions below. No user authentication details will be sent to the web app."; ?></p>

<div style="padding:10pt;font-family: 'Francois+One', sans-serif;" class="pg_grey">
<span id="lang-sync-second-pg"><?php echo $translation["sync"]["second-pg"] ?? "Your Google Spreadsheet ID according to your configuration"; ?></span><br />
<b><a target="_blank" href="https://docs.google.com/spreadsheets/d/<?php echo $settings["trip-data"]["spreadsheet-id"]; ?>/edit"><?php echo $settings["trip-data"]["spreadsheet-id"]; ?></a></b><br /><br />
<span id="lang-sync-third-pg"><?php echo $translation["sync"]["third-pg"] ?? "Update your files manually by <b>right click</b> on the links below and save the file to your IIB <b>data</b> folder."; ?></span>
<br />
<a class="iib-action-button" href="https://docs.google.com/spreadsheets/d/<?php echo $settings["trip-data"]["spreadsheet-id"]; ?>
/export?format=tsv&gid=<?php echo $settings["trip-data"]["overview-gid"]; ?>"><?php echo $settings["trip-data"]["overview-name"]; ?> (tsv)</a>
 
<a class="iib-action-button" href="https://docs.google.com/spreadsheets/d/<?php echo $settings["trip-data"]["spreadsheet-id"]; ?>
/export?format=tsv&gid=<?php echo $settings["trip-data"]["events-gid"]; ?>"><?php echo $settings["trip-data"]["events-name"]; ?> (tsv)</a>
 
<a class="iib-action-button" href="https://docs.google.com/spreadsheets/d/<?php echo $settings["trip-data"]["spreadsheet-id"]; ?>
/export?format=tsv&gid=<?php echo $settings["trip-data"]["map-gid"]; ?>"><?php echo $settings["trip-data"]["map-name"]; ?> (tsv)</a>
</div>

<h2 id="lang-sync-other-options"><?php echo $translation["sync"]["other-options"] ?? "Other options"; ?></h2>
<p id="lang-sync-other-options-text"><?php echo $translation["sync"]["other-options-text"] ?? "An automatically integration it not in place at the moment, but you can achive it on your own by activation of Google Sheet API in Google Cloud console.
<br /><br />If you use Microsoft 365 or a local installation of Microsoft Office, LibreOffice or other, you can save tsv files directly to the <b>data</b> folder with the following names
"; ?>
</p>
<div style="margin-top:15pt;padding:1pt;font-family: 'Francois+One', sans-serif;" class="pg_grey">

<ul>
    <li><u><?php echo $settings["trip-data"]["spreadsheet-name"]." - ".$settings["trip-data"]["overview-name"]; ?>.tsv</u></li>
    <li><u><?php echo $settings["trip-data"]["spreadsheet-name"]." - ".$settings["trip-data"]["events-name"]; ?>.tsv</u></li>
    <li><u><?php echo $settings["trip-data"]["spreadsheet-name"]." - ".$settings["trip-data"]["map-name"]; ?>.tsv</u></li>
</ul>
</div>

</div>
<?php include '_foot.php'; ?>