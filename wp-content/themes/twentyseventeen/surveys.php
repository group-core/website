<?php /* Template Name: Surveys Page */ ?>
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
                        <img class="custom-logo" src="http://localhost/wordpress/wp-content/themes/twentyseventeen/sixspartners_logo.png" style="width: 150px;">
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
                    <a class="nav-link" href="http://localhost/wordpress/dashboard/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="localhost/wordpress/wp-admin">WP-Admin</a>
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
                    <a class="nav-link" href="#">Sign out</a>
                </li>
            </ul>
        </div>
    </nav>
</div>

<main role="main" class="container">


	<?php
//create connection to Database
$conn = mysqli_connect("localhost", "root", "");

//select the database name
mysqli_select_db($conn,'bpacapstonedb');

$sql = "SELECT * FROM wp_mlw_quizzes";

$records = $conn->query($sql);

?>
	
	
    <div class="container">
        <h2>Surveys Table</h2>
        <p>Surveys tracking</p>
        <table class="table table-hover">
            <thead>
             <tr>
				<th>Survey Name</th>
				<th>Survey views</th>
				<th>Survey Taken</th>
                 <th>Survey Edit</th>
			</tr>
            </thead>
            <tbody>
            <tr>

        <?php


        while ($results = mysqli_fetch_assoc($records))
        {

            //On page 1

            echo "<tr>";


            echo "<td><a href=\"http://localhost/wordpress/quiz/?survey=".$results['quiz_name']."\" target='_blank'>".$results['quiz_name']."</a></td>";

            echo "<td>".$results['quiz_views']."</td>";

            echo "<td>".$results['quiz_taken']."</td>";

            echo "<td><a href=\"http://localhost/wordpress/wp-admin/admin.php?page=mlw_quiz_options&quiz_id=".$results['quiz_id']."\" target='_blank'> Edit </a></td>";

            echo "</td>";

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