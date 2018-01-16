<?php
include 'Header.php';
if ($a= $_GET['link'])
{
	$ProjectId = $a;
} else {
	echo "Error occured";
}

$Selecttasks = mysqli_query($connect,"CALL getAllTasks($ProjectId)");
?>
	<div class="table">
		<table class="table table-bordered">
			<caption>
				<h2>Tasks</h2>
			</caption>
			<thead>
				<tr class="success">
					<th>Task Id</th>
					<th>Title</th>
					<th>Status</th>
					<th>Priority</th>
					<th>UserStory</th>
					<th>Sprint</th>
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
			<td><a href=\"Taskdesc.php?task=$row[0]\">{$row[1]}</td>
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