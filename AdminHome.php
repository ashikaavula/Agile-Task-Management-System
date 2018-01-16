<?php
include 'Header.php';
//session_start();
?>
<div style="text-align: right;font-size: 25px;">Welcome <?php echo "$login_session |"; ?> &#09; <a href = "logout.php">Sign Out</a></div>
 <h1 style="text-align:center;">Projects</h1>     
<?php
	$selectquery = "SELECT ProjectId,Title,StartDate,EndDate from Project where IsActive = 1;";
	$result = mysqli_query ( $connect, $selectquery );
	?>
	<div id="hometable" class="table-responsive">
	<div><a href = "ViewUsers.php">View Users</a></div>
	<br/>
	<div><a href = "AddProject.php">Add Project</a></div>
	<table class="table table-bordered" id="t01">
		<thead>
			<tr  class="success">
				<th>Project ID</th>
				<th>Project Name</th>
				<th>Start Date</th>
				<th>End Date</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if (! $result) {
			echo "<tr>
			<td>Connection failed</td></tr> ";
		} else {

			
			while ( $row = mysqli_fetch_row ( $result ) ) {
				echo "<tr class=\"info\">
			<td>{$row[0]}</td>
			<td><a href=\"ProjectHome.php?link=$row[0]\">{$row[1]}</a></td>
			<td>{$row[2]}</td>
			<td>{$row[3]}</td>
			</tr>\n";
			}
		}
		?>
		
		</tbody>
	</table>
	</div>
</body>
   
</html>