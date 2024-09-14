<?php
header( 'Content-type: image/svg+xml' ); 
?>
<svg viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
  <circle cx="25" cy="25" r="23" stroke-width="4" stroke="<?php echo 'rgba('.hexdec(substr($_GET["color"],0,2)).','.hexdec(substr($_GET["color"],2,2)).','.hexdec(substr($_GET["color"],4,2)).',0.5)'; ?>" fill="transparent" /><!-- #<?php echo $_GET["color"]; ?>-->
  <circle cx="25" cy="25" r="8" fill="<?php echo 'rgba('.hexdec(substr($_GET["color"],0,2)).','.hexdec(substr($_GET["color"],2,2)).','.hexdec(substr($_GET["color"],4,2)).',0.5)'; ?>" />
</svg>