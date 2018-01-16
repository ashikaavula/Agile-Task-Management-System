<?PHP
include 'Header.php';

if ($a = $_GET ['storyid']) {
	$Userstoryid = $a;
} else {
	echo "Error occured";
}
$role_session = $_SESSION ['role'];

// define variables and set to empty values
$TnameErr = "";
$Tname = "";
$TdeadlineErr = "";
$Tdeadline = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["Tname"])) {
		$TnameErr = "Task title is required";
	} else {
		$Tname = test_input($_POST["Tname"]);
	}
	if (empty($_POST["Tdeadline"])) {
		$TdeadlineErr = "Deadline is required";
	} else {
		$Tdeadline = test_input($_POST["Tdeadline"]);
	}

}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>
<h1 style="text-align:center;"> Add New task</h1>
<?php echo "<div><a href = \"ViewTasks.php?storyid=$Userstoryid\">Go Back</a></div> <br/>" ?>
<div class="login-style" style="display: block;">
<form action="#" method="post" >

<div><span>Title</span></div>
<input type="text" name="Tname" style="width:300px"/>
<span class="error">* <?php echo $TnameErr;?></span>
<div><span>Description</span></div>
<textarea cols="40" rows="5" name="Tdesc"></textarea>

<div><span>Deadline</span></div>
<input type="date" name="Tdeadline"/>
<span class="error">* <?php echo $TdeadlineErr;?></span>


<div><span>Assigned To</span></div>
<?php $query = mysqli_query ($connect, "Select p.ProjectId from productbacklog p INNER JOIN userstories u ON p.ProductBacklogId = u.ProductBacklogId where u.UserStoryId = $Userstoryid;");
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
<div><span>Priority</span></div>
<select class="selectpicker" name="Tpriority">
<?php 
$result = mysqli_query ( $connect, "Select priorityid,priorityname from priority;" );
while ( $row = mysqli_fetch_row ( $result ) ) {
	echo "<option value=$row[0]>$row[1]</option>";
}
?>
</select><br/>
<input type="submit" value="Add" name="save" />
</form>
</div>
<?php 
if(isset($_POST['Tname'], $_POST['Tdesc'],$_POST['Tselection'],$_POST['Tpriority'],$_POST['Tdeadline']))
{
	$taskname = $_POST['Tname'];
	$taskdesc = $_POST['Tdesc'];
	$taskassigned = $_POST['Tselection'];
	$taskpriority = $_POST['Tpriority'];
	$taskdeadline = $_POST['Tdeadline'];
	$taskcreated = $EmpId_session;
	
if ($stmt = mysqli_prepare($connect,"INSERT INTO Tasks (UserStoryId, Title, Description, AssignedTo, Priority, CreatedBy, Deadline) VALUES (?,?,?,?,?,?,?);"))
{
$stmt->bind_param('issiiis', $Userstoryid,$taskname,$taskdesc,$taskassigned,$taskpriority,$EmpId_session,$taskdeadline);
if($stmt->execute())
{
	$message = "Task has been created";
	echo "<script type='text/javascript'>alert('$message');window.location = 'ViewTasks.php?storyid=$Userstoryid';</script>";
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


</body>
</html>