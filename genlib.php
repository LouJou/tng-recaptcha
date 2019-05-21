<?php
function tng_header( ) {

  // First part of original code
	echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS\" href=\"{$cms['tngpath']}tngrss.php\" />\n";

  include($cms['tngpath'] . "ggl_analytics.php");
  // Rest of original code

}
?>
