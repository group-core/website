<!-- BPA Automation Capstone project
    purpose: Create a CMS dashboard to manage survey responses and track Sales stage
    Group members:
        Andy Lao
        Fernando Pereira Borges
        Haaris Haq

    Conestoga College - April, 2018
-->
<?php
/**
 * Template for displaying DAO in Twenty Seventeen
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<?php 
	$databaseHost = 'localhost';
    $databaseName = 'bpacapstonedb';
    $databaseUsername = 'root';
    $databasePassword = '';

    $mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
 ?>

