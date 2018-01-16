<?php
if ($a= $_GET['link'])
{
$Projectid = $a;
} else {
echo "Error occured";
}
?>
<div class="container">
<?PHP echo "<div><a class=\"btn btn-info\" href = \"CreateUserstory.php?link=$Projectid\">Add new user story</a></div>";
echo "<div><a class=\"btn btn-info\" href=\"addUserstoryToSprint.php?link=$Projectid\">Add user stories to sprints</a></div>";

$productBacklogDisplay = mysqli_query ( $connect, "SELECT u.UserStoryId, u.Title, u.Description, u.StoryPoints from userstories u INNER JOIN productBacklog p ON u.ProductBacklogId = p.ProductBacklogId where p.ProjectId = '$Projectid' and u.UserStoryId not in (select UserStoryId from UserStoriestoSprint);" );

?>

	<div class="table">
		<table class="table table-bordered">
			<caption>
				<h2>Product Backlog</h2>
			</caption>
			<thead>
				<tr class="success">
					<th>User story Id</th>
					<th>Title</th>
					<th>Description</th>
					<th>Story points</th>
				</tr>
			</thead>
			<tbody>
		<?php
		if (! $productBacklogDisplay) {
			echo "<tr>
			<td>Connection failed</td></tr> ";
		} else {
			$productblbutton = mysqli_query ( $connect, "select ProductBacklogId from ProductBacklog where ProjectId = $Projectid;");
			if(mysqli_num_rows($productblbutton)== 0) {			
				echo "<div><a class=\"btn btn-info\" href=\"CreateProductBacklog.php?link=$Projectid\">Create Product Backlog</a></div>";
			}
			else{
			
			while ( $row = mysqli_fetch_row ( $productBacklogDisplay ) ) {
				echo "<tr class=\"info\">
			<td>{$row[0]}</td>
			<td>{$row[1]}</td>
			<td>{$row[2]}</td>
			<td>{$row[3]}</td>
			</tr>\n";
			}
		}
		}
		?>
		
		</tbody>
		</table>
	</div>
	<?PHP
	echo  "<div><a class=\"btn btn-info\" href = \"CreateSprint.php?link=$Projectid\">Add new sprint</a></div>";
	
	$countSprints = mysqli_query($connect, "SELECT SprintId, Title from sprint WHERE ProjectId = '$Projectid'");

if (!$countSprints) {
	echo "<tr>
			<td>Connection failed</td></tr> ";
} else {
	echo"<div class=\"table\"><h2>Sprint Information</h2>";
	
	while ($rowData = mysqli_fetch_row ( $countSprints )) {
		$SprintDisplay = mysqli_query ( $connect, "SELECT u.UserStoryId, u.Title, u.Description, u.StoryPoints from sprint s LEFT JOIN UserStoriestoSprint US ON s.SprintId = US.SprintId INNER JOIN userstories u  ON US.UserStoryId = u.UserStoryId where s.SprintId = '$rowData[0]'");
    echo "<table class=\"table table-bordered\">
			<caption> $rowData[1]</caption>
			<thead>
				<tr class=\"success\">
					<th>User story Id</th>
					<th>Title</th>
					<th>Description</th>
					<th>Story points</th>
				</tr>
			</thead>
			<tbody>";
             while ( $row2 = mysqli_fetch_row ( $SprintDisplay ) ) {
				echo "<tr class=\"info\">
			<td><a href=\"ViewTasks.php?storyid=$row2[0]\">{$row2[0]}</a></td>
			<td>{$row2[1]}</td>
			<td>{$row2[2]}</td>
			<td>{$row2[3]}</td>
			</tr>\n";
			}
		
		echo"</tbody>
		</table>";
	}
	echo "</div>";
}
		?>
</div>
	</body>
	</html>