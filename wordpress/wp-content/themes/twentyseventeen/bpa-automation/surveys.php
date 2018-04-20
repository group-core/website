<?php
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
            <th>Survey Views</th>
            <th>Survey Taken</th>
            <th>Survey Edit</th>
        </tr>
        </thead>
        <tbody>
		<?php
		while($result = mysqli_fetch_assoc($records)) {
			echo "<tr>";
			echo "<td><a href=\"http://localhost/wordpress/quiz/" . $result['quiz_name'] . "\" target='_blank'>" . $result['quiz_name'] . "</a></td>";
			echo "<td>" . $result['quiz_views'] . "</td>";
			echo "<td>" . $result['quiz_taken'] . "</td>";
			echo "<td><a href=\"http://localhost/wordpress/wp-admin/admin.php?page=mlw_quiz_options&quiz_id=" . $result['quiz_id'] . "\" target='_blank'>Edit</a></td>";
			echo "</td>";
			echo "</tr>";
		}
		?>
        </tbody>
    </table>
</div>