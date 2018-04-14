<?php /* Template Name: Clients Page */ ?>
<?php
session_start();

//create connection to Database
$conn = mysqli_connect("localhost", "root", "");

//select the database name
mysqli_select_db($conn,'bpacapstonedb');

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



    <title>Client Profile</title>
</head>
<body>

<div class="container sticky-top">
    <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #f2f2f2;">
        <div class="site-branding text-center">
            <div id="site-header" class="container">
                <div style="width: 150px; display: inline-block; vertical-align: top;">
                    <a href="http://localhost/bpa/">
                        <img class="custom-logo" src="http://localhost/bpa/wp-content/themes/twentyseventeen-child/assets/images/sixspartners_logo.png" style="width: 150px;">
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
                    <a class="nav-link" href="http://localhost/sixspartners/cms-dashboard/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="localhost/wordpress/wp-admin">WP-Admin</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="surveys" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Questionnaires</a>
                    <div class="dropdown-menu" aria-labelledby="surveys">
                        <a class="dropdown-item" href="#">BPA-Survey1</a>
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
                    <a class="nav-link" href="http://localhost/sixspartners/wp-login.php?action=logout&_wpnonce=a8c5c14c53">Sign out</a>

                </li>
            </ul>
        </div>
    </nav>
</div>


<main role="main" class="container-fluid col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Client</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">               
                <button class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
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

        echo "<h1>" .$client_value. "</h1><br>";

   //Determine how many surveys exist
    $mlw_stat_total_active_quiz = "SELECT COUNT(deleted) FROM wp_mlw_quizzes WHERE deleted=0 LIMIT 1";

    $records1 = $conn->query($mlw_stat_total_active_quiz);


    while($total = mysqli_fetch_assoc($records1))
      {
        $totalNumber = $total['COUNT(deleted)'];
      }

    //Determine how many quizzes were answered
    $totalQuizzesAnswered = "SELECT COUNT(quiz_id) FROM wp_mlw_results WHERE name= '$client_value'";
    $records2 = $conn->query($totalQuizzesAnswered);

    while($total = mysqli_fetch_assoc($records2))
        {
            $totalResults = $total['COUNT(quiz_id)'];
        }
    $frameInterval = ROUND((($totalResults * 100)/$totalNumber),0);


    echo "<div class='progress' style='height:30px;'>
  <div class='progress-bar progress-bar-success' id='stageBar' role='progressbar' style='width:$frameInterval%;' aria-valuenow='50' aria-valuemin='0' aria-valuemax='100'>
  $frameInterval% Stages Completed
  </div>
</div><br>";

    echo "<div class='progress-bar bg-success' role='progressbar' aria-valuenow='40' aria-valuemin='0' aria-valuemax='100' style='width:$frameInterval%;'>
        $totalResults questionnaires completed
    </div> <br>";

    echo "Total of active surveys : ".$totalNumber."<br />";
    echo "number of surveys answered: ".$totalResults."<br />";
    echo "Stage progress: ".$frameInterval."% <br />";

    ?>


	 <h2 align=center> Results</h2>
	 
	 <div class="container-fluid">
	 <div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Survey Results #1
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
          <?php

          $sql = "SELECT * FROM wp_mlw_results WHERE name='$client_value' AND quiz_id='1'";
          $records1 = $conn->query($sql);

          while($results = mysqli_fetch_assoc($records1))  {

              // unserializing data;
              $result = unserialize($results['quiz_results']);

              echo "<pre>";
              echo "<h4>".$results['quiz_name']."</h4>";
              foreach ( $result[1] as $var ) {
                  echo "\n", htmlspecialchars_decode($var[0]), $var[1], '<br/>', '----------------------<br/>';
              }
          }
           ?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Survey Results #2
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">

          <?php

          $sql = "SELECT * FROM wp_mlw_results WHERE name='$client_value' AND quiz_id='2'";
          $records2 = $conn->query($sql);

          while($results = mysqli_fetch_assoc($records2))  {

              // unserializing data;
              $result = unserialize($results['quiz_results']);

              // Show the unserialized data;

              if(empty($result))
              {
                  echo "<h5>This survey was not answered by the client yet!</h5>";
              }
              else {
          echo "<pre>";
          echo "<h4>".$results['quiz_name']."</h4>";
          foreach ( $result[1] as $var ) {
              echo "\n", htmlspecialchars_decode($var[0]), $var[1], '<br/>', '----------------------<br/>';
          }}}
          ?>

	  </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Survey Results #3
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
      <?php
      $sql = "SELECT * FROM wp_mlw_results WHERE name='$client_value' AND quiz_id='3'";
      $records3 = $conn->query($sql);

      while($results = mysqli_fetch_assoc($records3))  {

          // unserializing data;
          $result = unserialize($results['quiz_results']);

          echo "<pre>";
          echo "<h4>".$results['quiz_name']."</h4>";
          foreach ( $result[1] as $var ) {
              echo "\n", htmlspecialchars_decode($var[0]), $var[1], '<br/>', '----------------------<br/>';
          }
      }
        ?>
	  </div>
    </div>
  </div>
</div>
         <div class="card">
             <div class="card-header" id="headingFour">
                 <h5 class="mb-0">
                     <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                         Survey Results #4
                     </button>
                 </h5>
             </div>

             <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordion">
                 <div class="card-body">
                     <?php

                     $sql = "SELECT * FROM wp_mlw_results WHERE name='$client_value' AND quiz_id='4'";
                     $records1 = $conn->query($sql);

                     while($results = mysqli_fetch_assoc($records1))  {

                         // unserializing data;
                         $result = unserialize($results['quiz_results']);

                         echo "<pre>";
                         echo "<h4>".$results['quiz_name']."</h4>";
                         foreach ( $result[1] as $var ) {
                             echo "\n", htmlspecialchars_decode($var[0]), $var[1], '<br/>', '----------------------<br/>';
                         }
                     }
                     ?>
                 </div>
             </div>
         </div>


         <div class="card">
             <div class="card-header" id="headingFive">
                 <h5 class="mb-0">
                     <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                         Survey Results #5
                     </button>
                 </h5>
             </div>

             <div id="collapseFive" class="collapse show" aria-labelledby="headingFive" data-parent="#accordion">
                 <div class="card-body">
                     <?php

                     $sql = "SELECT * FROM wp_mlw_results WHERE name='$client_value' AND quiz_id='5'";
                     $records1 = $conn->query($sql);

                     while($results = mysqli_fetch_assoc($records1))  {

                         // unserializing data;
                         $result = unserialize($results['quiz_results']);

                         echo "<pre>";
                         echo "<h4>".$results['quiz_name']."</h4>";
                         foreach ( $result[1] as $var ) {
                             echo "\n", htmlspecialchars_decode($var[0]), $var[1], '<br/>', '----------------------<br/>';
                         }
                     }
                     ?>
                 </div>
             </div>
         </div>


         <div class="card">
             <div class="card-header" id="headingAll">
                 <h5 class="mb-0">
                     <button class="btn btn-link" data-toggle="collapse" data-target="#collapseAll" aria-expanded="true" aria-controls="collapseAll">
                         Survey Results #All
                     </button>
                 </h5>
             </div>

             <div id="collapseAll" class="collapse show" aria-labelledby="headingAll" data-parent="#accordion">
                 <div class="card-body">
                     <?php

                     $sql = "SELECT * FROM wp_mlw_results WHERE name='$client_value' ORDER BY quiz_id";
                     $records1 = $conn->query($sql);

                     while($results = mysqli_fetch_assoc($records1))  {

                         // unserializing data;
                         $result = unserialize($results['quiz_results']);

                         echo "<pre>";
                         echo "<h4>".$results['quiz_name']."</h4>";
                         foreach ( $result[1] as $var ) {
                             echo "\n",'<h6>', htmlspecialchars_decode($var[0]), $var[1],'</h6>', '<br/>', '----------------------<br/>';
                         }
                     }
                     ?>
                 </div>
             </div>
         </div>
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



<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>

<!-- Graphs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>


<script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Stage1", "Stage2", "Stage3", "Stage4"],
            datasets: [{
                data: [1, 3, 2, 4],
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                borderWidth: 4,
                pointBackgroundColor: '#007bff'
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            },
            legend: {
                display: false,
            }
        }
    });
</script>
</body>
</html>