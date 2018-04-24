<!-- BPA Automation Capstone project
    purpose: Create a CMS dashboard to manage survey responses and track Sales stage
    Group members:
        Andy Lao
        Fernando Pereira Borges
        Haaris Haq

    Conestoga College - April, 2018
-->
<?php /* Template Name: Main Page */ ?>
<?php
include 'DAO.php';
include 'searchClient.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" type="text/css"
          href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8"
            src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>



    <title>BPA Automation</title>


    <?php
    //check if the starting row variable was passed in the URL or not
    if (!isset($_GET['clientrow']) or !is_numeric($_GET['clientrow'])) {
        //we give the value of the starting row to 0 because nothing was found in URL
        $clientrow = 0;
        //otherwise we take the value from the URL
    } else {
        $clientrow = (int)$_GET['clientrow'];
    }
    // FETCH DATA USING OFFSET AND LIMIT
    $result = mysqli_query($mysqli, "SELECT * FROM wp_mlw_results ORDER BY time_taken_real DESC LIMIT $clientrow, 10");

    $client_value = $_REQUEST['client'];
    $sql = "SELECT * FROM wp_mlw_results WHERE name LIKE '$client_value'";
    $results = mysqli_query($mysqli, $sql);

    ?>

</head>
<body>

<div class="container sticky-top">
    <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #f2f2f2;">
        <div class="site-branding text-center">
            <div id="site-header" class="container">
                <div style="width: 150px; display: inline-block; vertical-align: top;">
                    <a href="http://localhost/wordpress/dashboard">
                        <img class="custom-logo"
                             src="http://localhost/wordpress/wp-content/themes/twentyseventeen/sixspartners_logo.png"
                             style="width: 150px;">
                    </a>
                </div>
                <div style="display: inline-block;">
                    <h1 class="site-title"><a href="http://localhost/wordpress/dashboard" rel="home"
                                              style="color:#717273; text-decoration: none;">BPA Automation</a></h1>
                    <p class="site-description">Client Managment Dashboard</p>
                </div>
            </div><!-- .site-header -->
        </div><!-- end .site-branding -->
    </nav>


    <nav class="navbar navbar-expand-md navbar-dark mb-4 bg-dark rounded">
        <a class="navbar-brand" href="https://sixspartners.com/" target="_blank">Epicor</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09"
                aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
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
            <form class="form-inline my-2 my-md-0" role="search" method="get" class="search-form"
                  action="<?php echo esc_url(home_url('/')); ?>client-page/">
                <input class="form-control" type="text" placeholder="Search Client" aria-label="Search" id="search-client"
                       value="<?php echo get_search_query(); ?>" name="client"/>
            </form>

            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <a class="nav-link"
                       href="http://localhost/wordpress/wp-login.php?action=logout&_wpnonce=a8c5c14c53">Sign out</a>
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
        <a class="btn btn-lg btn-primary" href="http://localhost/wordpress/wp-admin/" target="_blank" role="button">Wordpress
            &raquo;</a>
    </div>


    <form method='get'>
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

                    while ($results = mysqli_fetch_assoc($result)) {
                        //On page 1

                        echo "<tr>";

                        echo "<td><a href=\"http://localhost/wordpress/client-page?client=" . $results['name'] . "\">" . $results['name'] . "</a></td>";

                        echo "<td>" . $results['business'] . "</td>";

                        echo "<td>" . $results['email'] . "</td>";

                        echo "</td>";

                        $client_name = $results['name'];

                        if (isset($_SESSION['client'])) {
                            $_SESSION['client'] = $client_name;
                        }
                    }

                    ?>
                </tr>
                </tbody>
            </table>

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <?php
                        if ($prev >= 0)
                            echo '<a class="page-link"  href="' . $_SERVER['PHP_SELF'] . '/dashboard' . '?clientrow=' . $prev . '">Previous </a>';
                        ?>
                    </li>
                    <li class="page-item">
                        <?php
                        echo '<a class="page-link" href="' . $_SERVER['PHP_SELF'] . '/dashboard' . '?clientrow=' . ($clientrow + 10) . '"> Next</a>';
                        $prev = $clientrow - 10; ?>
                    </li>
                </ul>
            </nav>

        </div>
    </form>
</main>


<!--Footer-->
<footer class="page-footer font-small stylish-color-dark pt-2 mt-2">
    <!--Copyright-->
    <div class="footer-copyright py-3 text-center" style="background-color: #f2f2f2;">
        <ul class="list-unstyled">
            <li style="font-size: small">Epicor is a trademark of Epicor Software Corporation registered in the United
                States and other countries.
            </li>
            <li style="font-size: x-small"> &copy;
                <script>new Date().getFullYear() > 2010 && document.write(new Date().getFullYear());</script>
                Copyright Sixspartners.
            </li>
        </ul>
    </div>
    <!--/.Copyright-->
</footer>
<!--/.Footer-->
</body>
</html>