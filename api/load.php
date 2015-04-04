<?php

/** Load All Classes */
foreach ( glob( "classes/*.class.php" ) as $filename ) {
	$cl = str_replace ( 'classes/', '', str_replace( '.class.php','',$filename ) );
	$var = strtolower ( $cl );
	include $filename;
	$$var = new $cl;
}

/** Load All Functions */
foreach ( glob( "functions/*.func.php" ) as $filename ) include $filename;

/** Load All Pages */
foreach ( glob( "pages/*.page.php" ) as $filename ) {
	$pg = str_replace ( 'pages/', '', str_replace ( '.page.php', '', $filename ) );
	add_page ( $pg, 'page_' . $pg );
	include $filename;
}
