<?php
$role_session = $_SESSION ['role'];
?>
<h1 style="text-align: center;">Project Details</h1>

<?PHP

$result = mysqli_query ( $connect, "SELECT ProjectId,Title,Description,StartDate,EndDate from Project where ProjectId= '$Projectid';" );

echo "<table class=\"table\" id=\"t01\" align=\"center\"
		<tr></tr>";
while ( $row = mysqli_fetch_row ( $result ) ) {
	echo "<tr><td>ProjectId</td>
        <td>$row[0]</td></tr>";
	$projectid = $row [0];
	echo "<tr><td>Title</td>
        <td>$row[1]</td></tr>
        <tr><td>Description </td>
        <td>$row[2]</td>
        </tr><tr><td>StartDate</td>
        <td>$row[3]</td></tr>
        <tr><td>EndDate</td>
        <td>$row[4]</td></tr>";
}
echo "</table>";

?>
<?php

if ($role_session == 1) {
	echo "<form action=\"#\" method=\"post\"><input type=\"submit\" name=\"disablep\" value=\"Disable Project\"/></form>";
	if (isset ( $_POST ['disablep'] )) {
		$result3 = mysqli_query ( $connect, "Update Project set isactive = 0 where isactive = 1 and ProjectId = '$Projectid'" );
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Project disabled')
    window.location.href='AdminHome.php';
    </SCRIPT>");
	}
}
?>
<br />
<br />
<div>Scrum Masters:</div>
<?php

$scrummasters = mysqli_query ( $connect, "Select CONCAT(FirstName,' ',LastName) from User U INNER JOIN UserToRole UR on U.EmpId = UR.EmpId INNER JOIN UserToProject UP ON UR.Id=UP.UtoRId where UP.projectId='$projectid' and UR.RoleId=3;" );
if (mysqli_num_rows ( $scrummasters ) > 0) {
	while ( $row = mysqli_fetch_row ( $scrummasters ) ) {
		echo "$row[0]";
	}
} else {
	echo "<div>No Scrum Masters added</div>";
}
echo "<div> Team members: </div>";
$scrummasters = mysqli_query ( $connect, "Select CONCAT(FirstName,' ',LastName) from User U INNER JOIN UserToRole UR on U.EmpId = UR.EmpId INNER JOIN UserToProject UP ON UR.Id=UP.UtoRId where UP.projectId='$projectid' and UR.RoleId=4;" );
if (mysqli_num_rows ( $scrummasters ) > 0) {
	while ( $row = mysqli_fetch_row ( $scrummasters ) ) {
		echo "$row[0]";
	}
} else {
	echo "<div>No Team members added</div>";
}

?>
<br />
<br />
<!-- <div>Add Scrum Master to the Project</div> -->
<!-- <form action="#" method="post"> -->
<?php
// $result = mysqli_query ( $connect, "Select U.EmpId, CONCAT(FirstName,' ',LastName) from User U INNER JOIN UserToRole UR on U.EmpId = UR.EmpId where UR.RoleId=3;" );
// if (! $result) {
// } else {
// 	while ( $row = mysqli_fetch_row ( $result ) ) {
// 		echo "<input type=\"checkbox\" name=\"check_box[]\" value=\"{$row[0]}\"><label> {$row[1]} </label><br/>";
// 	}
// }

?>

<!-- <input type="submit" name="submitScrumMaster" value="Add" /> -->
<!-- </form> -->

<?php
// if (isset ( $_POST ['submitScrumMaster'] )) { // to run PHP script on submit
// 	if (! empty ( $_POST ['check_box'] )) {
// 		foreach ( $_POST ['check_box'] as $selected ) {
// 			$insertInProject = mysqli_query ( $connect, "INSERT INTO UserToProject (EmpId, ProjectId) values($selected,$Projectid)" );
// 			echo "Scrum Master added";
// 		}
// 	}
// }
?>


</body>
</html>