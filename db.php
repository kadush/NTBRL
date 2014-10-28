<?php
$hostname = "localhost";
$database = "db_NTBRL";
$username = "ntbrl";
$password = "ntbrl@2014";


// Make the connection:
$ntrl = mysql_connect($hostname, $username, $password);

@$mydb=mysql_select_db($database,$ntrl);

if (!$ntrl) {
    trigger_error('Could not connect to the database: ' . mysqli_connect_error());
	}
?>
