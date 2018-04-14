<?php /* Template Name: Main Page */ ?>
<?php
@ob_start();
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


    <title>Home Page</title>
</head>
<body>

<div class="container sticky-top">
    <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #f2f2f2;">
        <div class="site-branding text-center">
            <div id="site-header" class="container">
                <div style="width: 150px; display: inline-block; vertical-align: top;">
                    <a href="http://localhost/bpa/">
                        <img class="custom-logo" src="http://localhost/wordpress/wp-content/themes/twentyseventeen-child/sixspartners_logo.png" style="width: 150px;">
                    </a>
                </div>
                <div style="display: inline-block;">
                    <h1 class="site-title"><a href="http://localhost/bpa/" rel="home" style="color:#717273; text-decoration: none;">BPA Automation</a></h1>
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
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="localhost/wordpress/wp-admin">WP-Admin</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="surveys" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Questionnaires</a>
                    <div class="dropdown-menu" aria-labelledby="surveys">
                        <a class="dropdown-item" href="http://localhost/sixspartners/wp-admin/admin.php?page=mlw_quiz_options&quiz_id=1" target="_blank">BPA-Survey1</a>
                        <a class="dropdown-item" href="#">BPA-Survey2</a>
                        <a class="dropdown-item" href="#">BPA-Survey3</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-md-0">
                <input class="form-control" type="text" placeholder="Search Client" aria-label="Search">
            </form>
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="#">Sign out</a>
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
        <a class="btn btn-lg btn-primary" href="http://localhost/sixspartners/wp-admin/" target="_blank" role="button">Wordpress &raquo;</a>
    </div>


	<?php
//create connection to Database
$conn = mysqli_connect("localhost", "root", "");

//select the database name
mysqli_select_db($conn,'bpacapstonedb');

$sql = "SELECT * FROM wp_mlw_results";

$records = $conn->query($sql);

?>
	
	
    <div class="container">
        <h2>Clients Table</h2>
        <p>Clients tracking</p>
        <table class="table table-hover">
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


        while ($results = mysqli_fetch_assoc($records))
        {


            //On page 1

            echo "<tr>";


            echo "<td><a href=\"http://localhost/sixspartners/client-profile?client=".$results['name']."\">".$results['name']."</a></td>";

            echo "<td>".$results['business']."</td>";

            echo "<td>".$results['email']."</td>";

            echo "</td>";

            $client_name = $results['name'];

            //$var_value = $results['name'];


        if( isset( $_SESSION['client'] ) )
            {
            $_SESSION['client'] = $client_name;
            }


        }
        ?>

            </tr>
            </tbody>
        </table>
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