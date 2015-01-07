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
?>
