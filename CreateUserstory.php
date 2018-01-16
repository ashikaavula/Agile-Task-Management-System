<?PHP
include 'Header.php';
if ($a= $_GET['link'])
{
	$Projectid = $a;
} else {
	echo "alert('Error occured')";
}
// define variables and set to empty values
$USnameErr = "";
$USname = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["USname"])) {
		$PnameErr = "Userstory title is required";
	} else {
		$Pname = test_input($_POST["USname"]);
	}	
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>
<h1 style="text-align:center;">Create new user story</h1>
<div class="login-style" style="display: block;">
<form action="#" method="post" >
<div><span>Name</span></div>
<input type="text" name="USname" style="width:300px"/>
<span class="error">* <?php echo $USnameErr;?></span>
<div><span>Description</span></div>
<textarea cols="40" rows="5" name="USdesc"></textarea>
<div><span>Story Points</span></div>
<textarea cols="40" rows="5" name="USpoints"></textarea>
<input type="submit" value="Add" name="save" oncomplete="history.back()"/>
</form>
</div>
<?php 
if(isset($_POST['USname'], $_POST['USdesc'],$_POST['USpoints'],$Projectid))
{
	$UStoriesname = $_POST['USname'];
	$UStoriesdesc = $_POST['USdesc'];
	$UStoriespoints = $_POST['USpoints'];

$isactive = 1;
$PBID = mysqli_query($connect, "SELECT ProductBacklogId from ProductBacklog WHERE ProjectId = '$Projectid'");
$row = mysqli_fetch_row ($PBID);

 if ($stmt = mysqli_prepare($connect,"INSERT INTO UserStories (ProductBacklogId, Title, Description, StoryPoints, CreatedBy) VALUES (?,?,?,?,?);"))
 {
 $stmt->bind_param('isssi', $row[0], $UStoriesname,$UStoriesdesc,$UStoriespoints,$EmpId_session);
 if($stmt->execute())
 {
 	$message = "Userstory has been created";
 	echo "<script type='text/javascript'>alert('$message');window.location = 'ProjectHome.php?link=$Projectid';</script>";
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

<script> 
function redirect()
{
	<?php 
   echo "window.location = \"ProjectHome.php?link='$Projectid'\""; ?>
}
</script>
</body>
</html>
