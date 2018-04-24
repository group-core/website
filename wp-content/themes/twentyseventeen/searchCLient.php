<?php

$databaseHost = 'localhost';
$databaseName = 'bpacapstonedb';
$databaseUsername = 'root';
$databasePassword = '';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

$client_value = $_REQUEST['client'];
$sql = "SELECT * FROM wp_mlw_results WHERE name LIKE '$client_value'";
$results = mysqli_query($mysqli, $sql);

?>
	