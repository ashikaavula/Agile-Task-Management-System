<?php
include 'Header.php';
?>

<h1 style="text-align:center;"> Users in the system</h1>

<div><a href = "AdminHome.php">Go Back</a></div>
<?PHP
$result= mysqli_query($connect,"SELECT EmpId,FirstName,LastName from User;");
if (mysqli_num_rows($result) > 0) {
	// output data of each row
	
	echo	"<table id=\"t01\" align=\"center\"
		<tr>
		<th>Employee ID</th>
		<th>First Name</th>
		<th>LastName</th>
		</tr>";
		while($row = mysqli_fetch_row($result)) {
		echo "<tr>";
		echo "<td> $row[0] </td>"; 
		echo "<td> $row[1] </td>";
		echo "<td> $row[2] </td>";
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "0 results";
}
?>

<h5>Assign Scrum master role</h5>
<?php
$getUsers = "Select EmpId,CONCAT(FirstName,' ',LastName) from User";
$result = mysqli_query ( $connect, $getUsers );
?>
<form action="#" method="post">
<?php 
if (!$result){}
else{
while($row = mysqli_fetch_row($result)){
echo"<input type=\"checkbox\" name=\"check_box[]\" value=\"{$row[0]}\"><label> {$row[1]} </label><br/>";
}
}

?>

<input type="submit" name="submitScrumMaster" value="Add" />
</form>
<?php
include 'config.php';
if(isset($_POST['submitScrumMaster'])){//to run PHP script on submit
if(!empty($_POST['check_box'])){
foreach($_POST['check_box'] as $selected){

$insertquery = "INSERT INTO UserToRole(EmpId,RoleId) values ($selected,'3')";
$result3 = mysqli_query ( $connect, $insertquery ); 
//$insertInProject = "INSERT INTO UserToProject values($selected,$pId)";
//$result4 = mysqli_query ( $connect, $insertInProject ); 
}
echo "Scrum master role added</br>";
}
}

$getUsers = "Select EmpId,CONCAT(FirstName,' ',LastName) from User";
$result = mysqli_query ( $connect, $getUsers );
?>
</td>
<td>
<h5>Assign TeamMember role</h5>
<form action="#" method="post">
<?php 
if (!$result){}
else{
while($row = mysqli_fetch_row($result)){
echo"<input type=\"checkbox\" name=\"check_box2[]\" value=\"{$row[0]}\"><label> {$row[1]} </label><br/>";
}
}

?>

<input type="submit" name="submitTeamMember" value="Add" />
</form>
<?php
include 'config.php';
if(isset($_POST['submitTeamMember'])){//to run PHP script on submit
if(!empty($_POST['check_box2'])){
foreach($_POST['check_box2'] as $selected){

$insertquery = "INSERT INTO UserToRole(EmpId,RoleId) values ($selected,'4')";
$result3 = mysqli_query ( $connect, $insertquery ); 
//$insertInProject = "INSERT INTO UserToProject values($selected,$pId)";
//$result4 = mysqli_query ( $connect, $insertInProject ); 
}
echo "Team member role added</br>";
}
}

$getUsers = "Select EmpId,CONCAT(FirstName,' ',LastName) from User";
$result = mysqli_query ( $connect, $getUsers );
?>
</td>
<td>
<h5>Assign ProductOwner role</h5>
<form action="#" method="post">
	<select name="selectlist">
<?php 
if (!$result){}
else{
while($row = mysqli_fetch_row($result)){
echo"<option value=\"{$row[0]}\">{$row[1]}</option>";
}
}

?>
</select> <input type="submit" name="submitProductowner" value="Add" />
</form>
<?php
include 'config.php';
if(isset($_POST['submitProductowner'])){//to run PHP script on submit
if(!empty($_POST['selectlist'])){
{
$selected = $_POST['selectlist'];	
echo "Product owner role added</br>";
$insertquery = "INSERT INTO UserToRole(EmpId,RoleId) values ($selected,'2')";
$result3 = mysqli_query ( $connect, $insertquery ); 
//$insertInProject = "INSERT INTO UserToProject values($selected,$pId)";
//$result4 = mysqli_query ( $connect, $insertInProject ); 
}
}
}	
?>
</td>
</tr>




</body>
</html>