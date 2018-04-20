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

echo "<h1>" . $client_value . "</h1><br>";

//Determine how many surveys exist
$mlw_stat_total_active_quiz = "SELECT COUNT(deleted) AS total FROM wp_mlw_quizzes WHERE deleted=0 LIMIT 1";

$records1 = $conn->query($mlw_stat_total_active_quiz);

while($total = mysqli_fetch_assoc($records1)) {
	$totalNumber = $total['total'];
}

//Determine how many quizzes were answered
$totalQuizzesAnswered = "SELECT COUNT(quiz_id) AS total FROM wp_mlw_results WHERE name= '$client_value'";
$records2 = $conn->query($totalQuizzesAnswered);

while($total = mysqli_fetch_assoc($records2)) {
	$totalResults = $total['total'];
}

include("stage-progress.css");
echo "<div style='text-align:center;overflow:hidden'>";
$stage = 2; //supposed to get this from data. current stage
$stagesCount = 4; //total number of stages
for($i = 0; $i < $stagesCount; $i ++) {
	if($i == 0) {
		$stageProgressBar = "<span class='stage bar-left";
	}
	else {
		$stageProgressBar .= "<span class='stage";
		if($i == $stage - 1) {
			$stageProgressBar .= " current-stage";
		}
		else if($i == $stagesCount - 1) {
			$stageProgressBar .= " bar-right";
		}
	}
	$stageProgressBar .= "'>Stage " . ($i + 1) . "</span>";
}
echo $stageProgressBar;
echo "</div>";

echo "<br/>";

echo "<div class='progress-bar bg-success' role='progressbar' aria-valuenow='40' aria-valuemin='0' aria-valuemax='100' style='width:$frameInterval%;'>";
if($totalResults !== 1) {
	echo "$totalResults questionnaires completed";
}
else {
	echo "$totalResults questionnaire completed";
}
echo "</div> <br>";

echo "Total active questionnaires : " . $totalNumber . "<br />";
echo "Number of questionnaires answered: " . $totalResults . "<br />";
echo "Stage progress: " . $frameInterval . "% <br />";

?>

<h2 align=center> Results</h2>
<div class="container-fluid">
    <div id="accordion">
		<?php
		$sql = "SELECT * FROM wp_mlw_results WHERE name LIKE '$client_value'";
		$results = $conn->query($sql);
		if($results !== false && mysqli_num_rows($results) > 0) {
			$i = 1;
			while($records = mysqli_fetch_assoc($results)) {
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
				foreach($record[1] as $var) {
					echo "Question: ", strip_tags(htmlspecialchars_decode($var[0])), "\nResponse: ", $var[1], "\n\n";
				}
				echo "</pre>";
				echo "</div>";
				echo "</div>";
				echo "</div>";
				$i ++;
			}
		}
		else {
		    echo "$client_value has not filled in any questionnaires";
        }
		?>
    </div>
</div>
</div>
</div>


</div>
</div>