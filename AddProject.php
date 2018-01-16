<?PHP
include 'Header.php';

// define variables and set to empty values
$PnameErr = $PstartdateErr = $PenddateErr ="";
$Pname = $Pstartdate = $Penddate =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["Pname"])) {
		$PnameErr = "Project name is required";
	} else {
		$Pname = test_input($_POST["Pname"]);
	}	

	if (empty($_POST["Pstartdate"])) {
		$PstartdateErr = "Start date is required";
	} else {
		$Pstartdate = test_input($_POST["Pstartdate"]);
	}

	if (empty($_POST["Penddate"])) {
		$PenddateErr = "End date is required";
	} else {
		$Penddate = test_input($_POST["Penddate"]);
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>
<h1 style="text-align:center;"> Add New Project</h1>
<div><a href = "AdminHome.php">Go Back</a></div> <br/>
<div class="login-style" style="display: block;">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
<div><span>Name</span></div>
<input type="text" name="Pname" style="width:300px"/>
<span class="error">* <?php echo $PnameErr;?></span>
<div><span>Description</span></div>
<textarea cols="40" rows="5" name="Pdesc"></textarea>
<div><span>Start Date</span></div>
<input type="date" name="Pstartdate"/>
<span class="error">* <?php echo $PstartdateErr;?></span>
<div><span>End Date</span></div>
<input type="date" name="Penddate"/>
<span class="error">* <?php echo $PenddateErr;?></span><br/>
<input type="submit" value="Add" name="save" />
</form>
</div>
<?php 
if(isset($_POST['Pname'], $_POST['Pdesc'],$_POST['Pstartdate'],$_POST['Penddate']))
{
	$projectname = $_POST['Pname'];
	$projectdesc = $_POST['Pdesc'];
	$projectstart = $_POST['Pstartdate'];
	$projectend = $_POST['Penddate'];
}
$isactive = 1;
if ($stmt = mysqli_prepare($connect,"INSERT INTO Project (Title, Description, StartDate, EndDate, IsActive) VALUES (?,?,?,?,?);"))
{
$stmt->bind_param('ssssi', $projectname,$projectdesc,$projectstart,$projectend,$isactive);
if($stmt->execute())
{
	$message = "Project has been created";
	echo "<script type='text/javascript'>alert('$message');window.location = 'AdminHome.php';</script>";
}
}
else {
	die("Errormessage: ". mysqli_error($connect));
}

?>


</body>
</html>
