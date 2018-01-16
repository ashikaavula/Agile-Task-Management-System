<?PHP
$pId = $_GET ['link'];
$role_session = $_SESSION ['role'];
?>

	
	<div class="container">
	<div class="row">
	<div class="col-md-4">
<?php if($role_session == 3) {
	
?>
<h2 style="text-align: center;">Add team members to project</h2>
<form action="#" method="post">
<select class="selectpicker" name="teammemberlist[]" data-live-search="true" multiple = "multiple" data-selected-text-format="count > 3">
<?php 
  $result = mysqli_query ( $connect, "select UR.Id, CONCAT(Firstname,' ', Lastname) from User U INNER JOIN UserToRole UR ON U.EmpId=UR.EmpId where UR.RoleId=4 and UR.Id not in (select UtoRId from UserToProject);");
?>
<?php
if (! $result) {
	echo "Error occured";
} else {
	while ( $row = mysqli_fetch_row ( $result ) ) {
		echo "<option value=\"{$row[0]}\">{$row[1]}</option>";
	}
}
?>
</select>
<input type="submit" name="AddTeamMember" class="btn btn-info"
				value="Add" />
</form>
<?php
if (isset ( $_POST ['AddTeamMember'] )) { // to run PHP script on submit
	if (! empty ( $_POST ['teammemberlist'] )) {
		$value = $_POST ['teammemberlist'];
		foreach ( $value as $selected )
		{			
			$result = mysqli_query ( $connect, "INSERT INTO UserToProject (UtoRId,ProjectId) values($selected,$pId);");
		}

	}
	$message = "Team member has been added";
	echo "<script type='text/javascript'>alert('$message');window.location = 'ProjectHome.php?link=$Projectid'</script>";
}
}
else if($role_session == 1) {
	?>
	<h2 style="text-align: center;">Add Scrum master to project</h2>
<form action="#" method="post">
<select class="selectpicker" name="scrummasterlist[]" data-live-search="true" multiple = "multiple" data-selected-text-format="count > 3">
<?php 
  $result = mysqli_query ( $connect, "Select UR.Id, CONCAT(FirstName,' ',LastName) from User U INNER JOIN UserToRole UR on U.EmpId = UR.EmpId where UR.RoleId=3 and UR.Id not in (select UtoRId from UserToProject);");
?>
<?php
if (! $result) {
	echo "Error occured";
} else {
	while ( $row = mysqli_fetch_row ( $result ) ) {
		echo "<option value=\"{$row[0]}\">{$row[1]}</option>";
	}
}
?>
</select>
<input type="submit" name="AddScrumMaster" class="btn btn-info"
				value="Add" />
</form>
<?php
if (isset ( $_POST ['AddScrumMaster'] )) { // to run PHP script on submit
	if (! empty ( $_POST ['scrummasterlist'] )) {
		$value = $_POST ['scrummasterlist'];
		foreach ( $value as $selected )
		{			
			$result = mysqli_query ( $connect, "INSERT INTO UserToProject (UtoRId,ProjectId) values($selected,$pId);");
		}

	}
}
?>


	<h2 style="text-align: center;">Add product owner to the project</h2>
<form action="#" method="post">
<select class="selectpicker" name="scrummasterlist[]" data-live-search="true" multiple = "multiple" data-selected-text-format="count > 3">
<?php 
  $result = mysqli_query ( $connect, "Select UR.Id, CONCAT(FirstName,' ',LastName) from User U INNER JOIN UserToRole UR on U.EmpId = UR.EmpId where UR.RoleId=2 and UR.Id not in (select UtoRId from UserToProject);");
?>
<?php
if (! $result) {
	echo "Error occured";
} else {
	while ( $row = mysqli_fetch_row ( $result ) ) {
		echo "<option value=\"{$row[0]}\">{$row[1]}</option>";
	}
}
?>
</select>
<input type="submit" name="AddScrumMaster" class="btn btn-info"
				value="Add" />
</form>
<?php
if (isset ( $_POST ['AddScrumMaster'] )) { // to run PHP script on submit
	if (! empty ( $_POST ['scrummasterlist'] )) {
		$value = $_POST ['scrummasterlist'];
		foreach ( $value as $selected )
		{			
			$result = mysqli_query ( $connect, "INSERT INTO UserToProject (UtoRId,ProjectId) values($selected,$pId);");
		}

	}
}


}
?>	

</div>
</div>
</div>
</body>
</html>