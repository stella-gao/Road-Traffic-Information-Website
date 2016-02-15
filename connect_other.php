<?php
	
	
	define('DB_NAME','web_traffic');
	define('DB_USER','root');
	define('DB_PASSWORD','');
	define('DB_HOST','localhost:3307');
	
	$link=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	
	if(!$link){
		die('Could not connect:' . mysql_error());
	}
	
	$db_selected=mysql_select_db(DB_NAME, $link);
	
	if(!$db_selected){
		die('Can\'t use ' . DB_NAME . ': ' . mysql_error());
	}
	echo 'connected successfully';
	
?>
