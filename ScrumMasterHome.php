<?php
include 'Header.php';
//session_start();
?>
<div style="text-align: right;font-size: 25px;">Welcome <?php echo "$login_session |"; ?> &#09; <a href = "logout.php">Sign Out</a></div>
 <h1 style="text-align:center;">Projects</h1>     
<?php
	$selectquery = "select P.ProjectId, P.Title, P.StartDate, P.EndDate from Project P INNER JOIN UserToProject UP ON P.ProjectId = UP.ProjectId INNER JOIN UserToRole UR ON UP.UtoRId = UR.Id where UR.RoleId = 3 and UR.EmpId = $EmpId_session;";
	$result = mysqli_query ( $connect, $selectquery );
	?>
	<div id="hometable" class="table-responsive">
	<br/>
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