<?PHP
include 'Header.php';
if ($a = $_GET ['task']) {
	$taskid = $a;
} else {
	echo "Error occured";
}
?>
<style>
.container{
margin-top:3%!important;
}
</style>
<?php
$role_session = $_SESSION ['role'];
?>
<h1 style="text-align: center;">Task Details</h1>
<?PHP

$result = mysqli_query ( $connect, "select TaskId, title, description, StatusName, PriorityName, Deadline from Tasks T INNER JOIN Priority P ON T.Priority=P.PriorityId INNER JOIN Status S ON T.TaskStatus=S.StatusId where TaskId = '$taskid';" );

echo "<table class=\"table\" id=\"t01\" align=\"center\"
		<tr></tr>";
while ( $row = mysqli_fetch_row ( $result ) ) {
	echo "<tr><td>TaskId</td>
        <td>$row[0]</td></tr>";
	$projectid = $row [0];
	echo "<tr><td>Title</td>
        <td>$row[1]</td></tr>
        <tr><td>Description</td>
        <td>$row[2]</td>
        </tr><tr><td>Status</td>
        <td>$row[3]</td></tr>
        <tr><td>Priority</td>
        <td>$row[4]</td></tr>
	    <tr><td>Deadline</td>
        <td>$row[5]</td></tr>";
}
?>
</table>

<?php  if($role_session !=2){  ?>
<div>Edit actions</div>
<div>Update Status</div>
<form action="#" method="post">
<?php $result2 = mysqli_query ( $connect, "select StatusId, StatusName from Status;");?>
<select class="selectpicker" name="status">
<?php while ( $row2 = mysqli_fetch_row ( $result2 ) ) {
	echo "<option value=$row2[0]>$row2[1]</option>";	
	
}
echo "<input type=\"submit\" value=\"Update\" name=\"updatestatus\" />";
echo "</select></form>";
if(isset($_POST['status']))
{
	$status = $_POST['status'];
	
	if ($stmt = mysqli_prepare($connect,"update Tasks set TaskStatus = ? where TaskId= ?;"))
	{
		$stmt->bind_param('ii', $status,$taskid);
		if($stmt->execute())
		{
			$message = "Status has been updated";
			echo "<script type='text/javascript'>alert('$message');window.location = 'Taskdesc.php?task=$taskid';</script>";
		}
		else {
			die("Errormessage: ". mysqli_error($connect));
		}
	}
	else {
		die("Errormessage: ". mysqli_error($connect));
	}
	}
?>

<form action="#" method="post" >
<div><span>Re Assign task To</span></div>
<?php $query = mysqli_query ($connect, "Select S.ProjectId from Sprint S INNER JOIN UserStoriestoSprint US ON S.SprintId = US.SprintId INNER JOIN Tasks T ON US.UserStoryId=T.UserStoryId where T.TaskId = $taskid;");
while ( $value = mysqli_fetch_row ($query)) {
	$Projectid = $value[0];
}
?>
<select class="selectpicker" data-live-search="true" name="Tselection" title="Choose one of the following...">
<?php 

$result = mysqli_query ( $connect, "Select r.EmpId, CONCAT(u.FirstName,' ',u.LastName) from user u INNER JOIN usertorole r on u.EmpId = r.EmpId INNER JOIN usertoproject p on r.id = p.UtoRId Where ProjectId = $Projectid and r.roleid =4;" );
while ( $row = mysqli_fetch_row ( $result ) ) {
	echo "<option value=$row[0]>$row[1]</option>";
}
?>
</select>
<input type="submit" value="Reassign" name="save" />
</form>
</div>
<?php 
if(isset($_POST['Tselection']))
{
	$taskassigned = $_POST['Tselection'];	
	
if ($stmt = mysqli_prepare($connect,"update Tasks set AssignedTo = ? where taskid = ?;"))
{
$stmt->bind_param('ii', $taskassigned,$taskid);
if($stmt->execute())
{
	$message = "Task has been created";
	echo "<script type='text/javascript'>alert('$message');window.location = 'TaskDetails.php?link=$Projectid';</script>";
}
else {
	die("Errormessage: ". mysqli_error($connect));
}
}
else {
	die("Errormessage: ". mysqli_error($connect));
}
}
}
?>

</body>
</html>

