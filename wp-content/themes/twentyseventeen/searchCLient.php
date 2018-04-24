<!-- BPA Automation Capstone project
    purpose: Create a CMS dashboard to manage survey responses and track Sales stage
    Group members:
        Andy Lao
        Fernando Pereira Borges
        Haaris Haq

    Conestoga College - April, 2018
-->
<?php
//Search client Function:
$client_value = $_REQUEST['client'];
$sql = "SELECT * FROM wp_mlw_results WHERE name LIKE '$client_value'";
$results = mysqli_query($mysqli, $sql);

?>



	