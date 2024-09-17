<?php
    $pageTitle = "Sync";
    $contentMargin = "auto";
    include '_head.php';
    include '_data.php';
?>
<div style="margin:10pt;">
<h1 class="normal">Sync</h1>
<p>Download your latest trip data from Google Sheet. You need to be logged on in advance to perform actions below. No user authentication details will be sent to the web app.</p>

<div style="background-color:#e3e3e3;padding:10pt;font-family: 'Francois+One', sans-serif;">
Your Google Spreadsheet ID according to your configuration<br />
<b><a target="_blank" href="https://docs.google.com/spreadsheets/d/<?php echo $settings["trip-data"]["spreadsheet-id"]; ?>/edit"><?php echo $settings["trip-data"]["spreadsheet-id"]; ?></a></b><br /><br />
Update your files manually by <b>right click</b> on the links below and save the file to your IIB <b>data</b> folder.
<br />
<a class="iib-action-button" href="https://docs.google.com/spreadsheets/d/<?php echo $settings["trip-data"]["spreadsheet-id"]; ?>
/export?format=tsv&gid=<?php echo $settings["trip-data"]["overview-gid"]; ?>">Overview (tsv format)</a>
 
<a class="iib-action-button" href="https://docs.google.com/spreadsheets/d/<?php echo $settings["trip-data"]["spreadsheet-id"]; ?>
/export?format=tsv&gid=<?php echo $settings["trip-data"]["events-gid"]; ?>">Events (tsv format)</a>
 
<a class="iib-action-button" href="https://docs.google.com/spreadsheets/d/<?php echo $settings["trip-data"]["spreadsheet-id"]; ?>
/export?format=tsv&gid=<?php echo $settings["trip-data"]["map-gid"]; ?>">Map (tsv format)</a>
</div>

<h2>Other options</h2>
<p>
An automatically integration it not in place at the moment, but you can achive it on your own by activation of Google Sheet API in Google Cloud console.
<br /><br />If you use Microsoft 365 or a local installation of Microsoft Office, LibreOffice or other, you can save tsv files directly to the <b>data</b> folder with the following names
</p>
<div style="margin-top:15pt;background-color:#e3e3e3;padding:1pt;font-family: 'Francois+One', sans-serif;">

<ul>
    <li><u><?php echo $settings["trip-data"]["spreadsheet-name"]." - ".$settings["trip-data"]["overview-name"]; ?>.tsv</u></li>
    <li><u><?php echo $settings["trip-data"]["spreadsheet-name"]." - ".$settings["trip-data"]["events-name"]; ?>.tsv</u></li>
    <li><u><?php echo $settings["trip-data"]["spreadsheet-name"]." - ".$settings["trip-data"]["map-name"]; ?>.tsv</u></li>
</ul>
</div>

</div>
<?php include '_foot.php'; ?>