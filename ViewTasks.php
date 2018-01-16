<?php
include 'Header.php';
if ($a= $_GET['storyid'])
{
	$storyId = $a;
} else {
	echo "Error occured";
}

$Selecttasks = mysqli_query($connect,"Select t.taskId, t.Title, t.Description, t.TaskStatus, P.PriorityName, CONCAT(u.FirstName,' ',u.LastName) from tasks t INNER JOIN user u on t.AssignedTo = u.EmpId INNER JOIN Priority P ON t.Priority = P.PriorityId where t.UserStoryId = '$storyId'");
?>
	<div class="table">
	<?php echo "<div><a class=\"btn btn-info\" href=\"AddTasks.php?storyid=$storyId\">Add new task</a></div>"; ?>
		<table class="table table-bordered">
			<caption>
				<h2>Tasks</h2>
			</caption>
			<thead>
				<tr class="success">
					<th>Task Id</th>
					<th>Title</th>
					<th>Description</th>
					<th>Status</th>
					<th>Priority</th>
					<th>Assigned to</th>
				</tr>
			</thead>
			<tbody>
		<?php
		if (! $Selecttasks) {
			echo "<tr>
			<td>Connection failed</td></tr> ";
		} else {
			
			while ( $row = mysqli_fetch_row ( $Selecttasks ) ) {
				echo "<tr class=\"info\">
			<td>{$row[0]}</td>
			<td>{$row[1]}</td>
			<td>{$row[2]}</td>
			<td>{$row[3]}</td>
			<td>{$row[4]}</td>
			<td>{$row[5]}</td>
			</tr>\n";
			}
		}
		?>
		
		</tbody>
		</table>
	</div>