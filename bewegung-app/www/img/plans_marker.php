<?php
header( 'Content-type: image/svg+xml' ); 
/**
 * Lightens/darkens a given colour (hex format), returning the altered colour in hex format.7
 * @param str $hex Colour as hexadecimal (with or without hash);
 * @percent float $percent Decimal ( 0.2 = lighten by 20%(), -0.4 = darken by 40%() )
 * @return str Lightened/Darkend colour as hexadecimal (with hash);
 */
function color_luminance( $hex, $percent ) {
	
	// validate hex string
	
	$hex = preg_replace( '/[^0-9a-f]/i', '', $hex );
	$new_hex = '#';
	
	if ( strlen( $hex ) < 6 ) {
		$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
	}
	
	// convert to decimal and change luminosity
	for ($i = 0; $i < 3; $i++) {
		$dec = hexdec( substr( $hex, $i*2, 2 ) );
		$dec = min( max( 0, $dec + $dec * $percent ), 255 ); 
		$new_hex .= str_pad( dechex( $dec ) , 2, 0, STR_PAD_LEFT );
	}		
	
	return $new_hex;
}
?>
<!-- <?php echo color_luminance("#".$_GET["color"],3); ?> -->
<svg viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
<defs>
  <filter id="inner-glow">
    <feFlood flood-color="#000"/>
    <feComposite in2="SourceAlpha" operator="out"/>
    <feGaussianBlur stdDeviation="2" result="blur"/>
    <feComposite operator="atop" in2="SourceGraphic"/>
</filter> 
</defs>
  <circle filter="url(#inner-glow)" cx="25" cy="25" r="25" fill="#<?php echo $_GET["color"]; ?>" />
  <text x="50%" y="50%" class="text" text-anchor="middle" fill="#fff" dy=".32em" font-family="Arial, Helvetica, sans-serif" font-weight="normal" font-size="26pt"><?php echo $_GET["letter"]; ?></text><!-- stroke-width=".1em" -->
</svg>