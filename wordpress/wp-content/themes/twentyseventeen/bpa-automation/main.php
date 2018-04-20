<?php
@ob_start();
session_start();
?>

<?php
// NUMBER OF ROWS TO SHOW PER PAGE
$limit = 4;
// GET PAGE AND OFFSET VALUE
if (isset($_GET['pagenum'])) {
	$page = $_GET['pagenum'] - 1;
	$offset = $page * $limit;
} else {
	$page = 0;
	$offset = 0;
}
// COUNT TOTAL NUMBER OF ROWS IN TABLE
$sql = "SELECT count(result_id) FROM wp_mlw_results";
$result = mysqli_query($conn, $sql);
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
$result = mysqli_query($conn, "SELECT * FROM wp_mlw_results ORDER BY name DESC LIMIT $offset, $limit");
?>
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
		echo "<a href='?pagenum=1'>First</a>";
	}
	for ($i=1;$i<=$number_of_pages;$i++) {
		echo "<a href='?pagenum=$i'>".$i."</a>";
	}
	if (($page + 1) != $number_of_pages) {
		echo "<a href='?pagenum=$number_of_pages'>Last</a>";
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
<!--
<?php/*
<div class="jumbotron">
    <h1>CMS Dashboard</h1>
    <p class="lead">This is the main CMS page where you can find all clients that answered surveys.
        If you want to manage all surveys please go to Wordpress Dashboard by clicking on the button below.</p>
    <a class="btn btn-lg btn-primary" href="http://localhost/sixspartners/wp-admin/" target="_blank" role="button">Wordpress
        &raquo;</a>
</div>


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
		<?php
		$sql = "SELECT * FROM wp_mlw_results";
		$records = $conn->query($sql);
		while($result = mysqli_fetch_assoc($records)) {
			echo "<tr>";
			echo "<td><a href=\"http://localhost/website/wordpress/client?client=" . $result["name"] . "\">" . $result["name"] . "</a></td>";
			echo "<td>" . $result["business"] . "</td>";
			echo "<td>" . $result["email"] . "</td>";
			echo "</td>";
			echo "</tr>";
		}
		?>
        </tbody>
    </table>
</div>*/?>-->