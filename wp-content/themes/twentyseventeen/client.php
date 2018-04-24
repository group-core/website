<?php /* Template Name: Clients Page */ ?>
<?php
session_start();

//create connection to Database
$conn = mysqli_connect("localhost", "root", "");

//select the database name
mysqli_select_db($conn, 'bpacapstonedb');

include 'searchClient.php';
?>
<!DOCTYPE html>
<html lang="en">
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


    <title>Client Profile</title>
</head>
<body>

<div class="container sticky-top">
    <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #f2f2f2;">
        <div class="site-branding text-center">
            <div id="site-header" class="container">
                <div style="width: 150px; display: inline-block; vertical-align: top;">
                    <a href="http://localhost/wordpress/">
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
                    <a class="nav-link" href="http://localhost/wordpress/dashboard/">Home</a>
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
                <input class="form-control" type="text" placeholder="Search Client" aria-label="Search"
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


<main role="main" class="container-fluid col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Client</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <script>
                function printPage() {
                    window.print();
                }
            </script>

            <button class="btn btn-sm btn-outline-secondary" onclick="printPage()">
                Print
            </button>
        </div>
    </div>

    <?php
    //Using GET, POST or COOKIE.
    $client_value = $_REQUEST['client'];

    $sql = "SELECT * FROM wp_mlw_results WHERE name LIKE '$client_value'";
    $results = $conn->query($sql);
    if ($results !== false && mysqli_num_rows($results) > 0) {

        echo "<h1>" . $client_value . "</h1><br>";
    } else {
        $failedSearch = "$client_value has not filled in any questionnaire!";
        echo "<h3 style='color:red;'>" . $failedSearch . "</h3><br>";
    }


    //Determine how many surveys exist
    $mlw_stat_total_active_quiz = "SELECT COUNT(deleted) FROM wp_mlw_quizzes WHERE deleted=0 LIMIT 1";

    $records1 = $conn->query($mlw_stat_total_active_quiz);


    while ($total = mysqli_fetch_assoc($records1)) {
        $totalNumber = $total['COUNT(deleted)'];
    }

    //Determine how many quizzes were answered
    $totalQuizzesAnswered = "SELECT COUNT(quiz_id) FROM wp_mlw_results WHERE name= '$client_value'";
    $records2 = $conn->query($totalQuizzesAnswered);

    while ($total = mysqli_fetch_assoc($records2)) {
        $totalResults = $total['COUNT(quiz_id)'];
    }
    $frameInterval = ROUND((($totalResults * 100) / $totalNumber), 0);


    include("stage-progress.css");
    echo "<div style='text-align:center;overflow:hidden'>";
    $stage = $totalResults; //supposed to get this from data. current stage
    $stagesCount = $totalNumber; //total number of stages
    for ($i = 0; $i < $stagesCount; $i++) {
        if ($i == 0) {
            $stageProgressBar .= "<span class='stage bar-left";
        } else {
            $stageProgressBar .= "<span class='stage";
            if ($i == $stagesCount - 1) {
                $stageProgressBar .= " bar-right";
            }
        }
        if ($i == $stage - 1) {
            $stageProgressBar .= " current-stage";
        }

        $stageProgressBar .= "'>Stage " . ($i + 1) . "</span>";
    }
    echo $stageProgressBar;
    echo "</div>";
    echo "<br>";
    echo "<br>";

    echo "<div class='progress' style='height:30px;'>
	<div class='progress-bar progress-bar-success' id='stageBar' role='progressbar' style='width:$frameInterval%;' aria-valuenow='50' aria-valuemin='0' aria-valuemax='100'>
	$frameInterval% Stages Completed
	</div>
	</div><br>";

    echo "<div class='progress-bar bg-success' role='progressbar' aria-valuenow='40' aria-valuemin='0' aria-valuemax='100' style='width:$frameInterval%;'>
        $totalResults questionnaires completed
    </div> <br>";

    echo "Total of active surveys : " . $totalNumber . "<br />";
    echo "number of surveys answered: " . $totalResults . "<br />";
    echo "Stage progress: " . $frameInterval . "% <br />";


    ?>


    <h2 align=center> Results</h2>
    <div class="container-fluid">
        <div id="accordion">
            <?php
            $sql = "SELECT * FROM wp_mlw_results WHERE name LIKE '$client_value'";
            $results = $conn->query($sql);
            if ($results !== false && mysqli_num_rows($results) > 0) {
                $i = 1;
                while ($records = mysqli_fetch_assoc($results)) {
                    echo "<div class='card'>";
                    echo "<div class='card-header' id='heading$i'>";
                    echo "<h5 class='mb-0' >";
                    echo "<button class='btn btn-link' data-toggle='collapse' data-target='#collapse$i' aria-expanded='true' aria-controls='collapse$i'>";
                    echo "Survey #$i";
                    echo "</button>";
                    echo "</h5>";
                    echo "</div>";

                    echo "<div id='collapse$i' class='collapse show' aria-labelledby='heading$i' data-parent='#accordion'>";
                    echo "<div class='card-body' >";
                    echo "<pre>";
                    echo "<h4>" . $records['quiz_name'] . "</h4>";
                    $record = unserialize($records['quiz_results']);
                    foreach ($record[1] as $var) {
                        echo "Question: ", strip_tags(htmlspecialchars_decode($var[0])), "\nResponse: ", $var[1], "\n\n";
                    }
                    echo "</pre>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    $i++;
                }
            } else {
                $failedSearch = "$client_value has not filled in any questionnaire";
                echo "<div style='color:red;'>" . $failedSearch . "<br>";
            }
            ?>
        </div>
    </div>
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


<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>

<!-- Graphs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

</body>
</html>