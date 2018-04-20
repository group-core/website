<?php /* Template Name: Main Page */ ?>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>



    <title>Home Page</title>


    <?php
    //create connection to Database
    //$conn = mysqli_connect("localhost", "root", "");

    //select the database name
   // mysqli_select_db($conn,'bpacapstonedb');

   // $sql = "SELECT * FROM wp_mlw_results ORDER BY name";

    //$records = $conn->query($sql);


    $databaseHost = 'localhost';
    $databaseName = 'bpacapstonedb';
    $databaseUsername = 'root';
    $databasePassword = '';

    $mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);


    // NUMBER OF ROWS TO SHOW PER PAGE
    $limit = 4;

    // GET PAGE AND OFFSET VALUE
    if (isset($_GET['page'])) {
        $page = $_GET['page'] - 1;
        $offset = $page * $limit;
    } else {
        $page = 0;
        $offset = 0;
    }

    // COUNT TOTAL NUMBER OF ROWS IN TABLE
    $sql = "SELECT count(result_id) FROM wp_mlw_results";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($result);
    $total_rows = $row[0];

    // DETERMINE NUMBER OF PAGES
    if ($total_rows > $limit) {
        $number_of_pages = ceil($total_rows / $limit);
    } else {
        $pages = 1;
        $number_of_pages = 1;
    }

    // FETCH DATA USING OFFSET AND LIMIT
    $result = mysqli_query($mysqli, "SELECT * FROM wp_mlw_results ORDER BY name DESC LIMIT $offset, $limit");

    ?>

</head>
<body>

<div class="container sticky-top">
    <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #f2f2f2;">
        <div class="site-branding text-center">
            <div id="site-header" class="container">
                <div style="width: 150px; display: inline-block; vertical-align: top;">
                    <a href="http://localhost/wordpress/">
                        <img class="custom-logo" src="http://localhost/wordpress/wp-content/themes/twentyseventeen/sixspartners_logo.png" style="width: 150px;">
                    </a>
                </div>
                <div style="display: inline-block;">
                    <h1 class="site-title"><a href="http://localhost/wordpress/dashboard" rel="home" style="color:#717273; text-decoration: none;">BPA Automation</a></h1>
                    <p class="site-description">Client Managment Dashboard</p>
                </div>
            </div><!-- .site-header -->
        </div><!-- end .site-branding -->
    </nav>


    <nav class="navbar navbar-expand-md navbar-dark mb-4 bg-dark rounded">
        <a class="navbar-brand" href="https://sixspartners.com/" target="_blank">Epicor</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="http://localhost/wordpress/dashboard/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/wordpress/wp-admin/" target="_blank">WP-Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/wordpress/surveys/" id="surveys">Questionnaires</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-md-0">
                <input class="form-control" type="text" placeholder="Search Client" aria-label="Search">
            </form>
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="http://localhost/wordpress/wp-login.php?action=logout&_wpnonce=a8c5c14c53">Sign out</a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<main role="main" class="container">
    <div class="jumbotron">
        <h1>CMS Dashboard</h1>
        <p class="lead">This is the main CMS page where you can find all clients that answered surveys.
            If you want to manage all surveys please go to Wordpress Dashboard by clicking on the button bellow.</p>
        <a class="btn btn-lg btn-primary" href="http://localhost/wordpress/wp-admin/" target="_blank" role="button">Wordpress &raquo;</a>
    </div>


    <div class="container">
        <h2>Clients Table</h2>
        <p>Clients tracking</p>
        <table class="table table-hover" id="clients_table">
            <thead>
             <tr>
				<th>Client</th>
				<th>Business</th>
				<th>Contact</th>
			</tr>
            </thead>
            <tbody>
            <tr>



        <?php

        while ($results = mysqli_fetch_assoc($result))
        {
            //On page 1

            echo "<tr>";

            echo "<td><a href=\"http://localhost/wordpress/client-page?client=".$results['name']."\">".$results['name']."</a></td>";

            echo "<td>".$results['business']."</td>";

            echo "<td>".$results['email']."</td>";

            echo "</td>";

            $client_name = $results['name'];

        if( isset( $_SESSION['client'] ) )
            {
            $_SESSION['client'] = $client_name;
            }
        }

        ?>
            </tr>
            </tbody>
        </table>

        <?php
        // SHOW PAGE NUMBERS
        if ($page) {
            echo "<a href='?page=1'>First</a> ";
        }
        for ($i=1;$i<=$number_of_pages;$i++) {
            echo "<a href='?page=$i'>".$i."</a> ";
        }
        if (($page + 1) != $number_of_pages) {
            echo "<a href='?page=$number_of_pages'>Last</a> ";
        }
        ?>

        <!--
    <nav class="container">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $startpage ?>" tabindex="-1" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">First</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item active"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Last</span>
                </a>
            </li>
        </ul>
    </nav> -->

    </div>



</main>


<!--Footer-->
<footer class="page-footer font-small stylish-color-dark pt-2 mt-2">
    <!--Copyright-->
    <div class="footer-copyright py-3 text-center" style="background-color: #f2f2f2;">
        <ul class="list-unstyled">
            <li style="font-size: small">Epicor is a trademark of Epicor Software Corporation registered in the United States and other countries.</li>
            <li style="font-size: x-small"> &copy; <script>new Date().getFullYear()>2010&&document.write(new Date().getFullYear());</script> Copyright Sixspartners.</li>
        </ul>
    </div>
    <!--/.Copyright-->
</footer>
<!--/.Footer-->
</body>
</html>