<?PHP
include 'Header.php';
if ($a= $_GET['link'])
{
	$Projectid = $a;
} else {
	echo "Error occured";
}
echo "test";
echo $Projectid;
$role_session = $_SESSION['role'];
// define variables and set to empty values
$PbTitleErr = $PbTitle = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["PbTitle"])) {
		$PbTitleErr = "Product Backlog title is required";
	} else {
		$PbTitle = test_input($_POST["PbTitle"]);
	}
}
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>

<h1 style="text-align:center;"> Add New Product Backlog</h1> 
<div class="login-style" style="display: block;">
<form action="#" method="post" >
<div><span>Title</span></div>
<input type="text" name="PbTitle" style="width:350px"/>
<span class="error">* <?php echo $PbTitleErr;?></span>
<div><span>Description</span></div>
<textarea cols="45" rows="5" name="Pbdesc"></textarea>
<input type="submit" value="Add" name="save" />
</form>
</div>
<?php
if(isset($_POST['PbTitle'], $_POST['Pbdesc']))
{
	$prbtitle = $_POST['PbTitle'];
	$prbdesc = $_POST['Pbdesc'];

if ($stmt = mysqli_prepare($connect,"INSERT INTO ProductBacklog (ProjectId, Title, Description, CreatedBy) VALUES (?,?,?,?);"))
{
	$stmt->bind_param('issi',$Projectid , $prbtitle, $prbdesc, $EmpId_session);
	if($stmt->execute())
	{
		$message = "Product Backlog has been added to the project";
		echo "<script type='text/javascript'>alert('$message');window.location = 'ProjectHome.php?link=$Projectid#menu2';</script>";
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