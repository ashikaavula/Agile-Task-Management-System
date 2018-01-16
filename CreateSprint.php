<?php
include 'Header.php';
if ($a= $_GET['link'])
{
	$Projectid = $a;
} else {
	echo "Error occured";
}
$Stitle = $Sstartdate = "";
$StitleErr = $SstartdateErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["Stitle"])) {
		$StitleErr = "Sprint title is required";
	} else {
		$Stitle = test_input($_POST["Stitle"]);
	}

	if (empty($_POST["Sstartdate"])) {
		$PstartdateErr = "Start date is required";
	} else {
		$Sstartdate = test_input($_POST["Sstartdate"]);
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>

<body>
<h1 style="text-align:center;"> Create New Sprint</h1> <br/>
<?php

$role_session = $_SESSION['role'];
?>
<div class="login-style" style="display: block;">
<form action="#" method="post" >
<div><span>Title</span></div>
<input type="text" name="Stitle" style="width:300px"/>
<span class="error">* <?php echo $StitleErr;?></span>
<div><span>Start Date</span></div>
<input type="date" name="Sstartdate"/>
<span class="error">* <?php echo $SstartdateErr;?></span>
<div><span>End Date</span></div>
<input type="date" name="Senddate"/><br/>
<input type="submit" value="Add" name="save" />
</form>
</div>
<?php 
if(isset($_POST['Stitle'], $_POST['Sstartdate'],$_POST['Senddate']))
{
	$Sprinttitle = $_POST['Stitle'];
	$Sprintstart = $_POST['Sstartdate'];
	$Sprintend = $_POST['Senddate'];


if ($stmt = mysqli_prepare($connect,"INSERT INTO Sprint (ProjectId,Title, StartDate, EndDate,CreatedBy) VALUES (?,?,?,?,?);"))
{
$stmt->bind_param('isssi',$Projectid,$Sprinttitle,$Sprintstart ,$Sprintend,$EmpId_session);
if($stmt->execute())
{
	$message = "Sprint has been created";
	echo "<script type='text/javascript'>alert('$message');window.location = 'ProjectHome.php?link=$Projectid'</script>";
}
}
else {
	die("Errormessage: ". mysqli_error($connect));
}
}
?>

</body>
</html>