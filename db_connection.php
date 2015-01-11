<?php
	function connect_db() {
	date_default_timezone_set('Europe/Stockholm');
	$mysqli = new mysqli("localhost", "root", "root", "typografique_se");
	if (!$mysqli->set_charset("utf8")) {
    	echo "Fel vid inställning av teckentabell utf8: %s\n". $mysqli->error;
	}
	if ($mysqli->connect_errno) {
	    echo "Misslyckades att ansluta till MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	return $mysqli;
}

define('DB_HOST', 'localhost');
define('DB_NAME', 'typografique_se');
define('DB_USER','root');
define('DB_PASSWORD','root');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

?>
