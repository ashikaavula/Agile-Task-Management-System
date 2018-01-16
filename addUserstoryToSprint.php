<?php
include 'Header.php';
?>
<?php
if ($a= $_GET['link'])
{
$Projectid = $a;
} else {
echo "Error occured";
}
?>
<?PHP
$Sprintresult = mysqli_query($connect,"SELECT SprintId, Title from Sprint where ProjectId = '$Projectid'");
$UserStories = mysqli_query($connect,"SELECT u.UserStoryId, u.Title from userstories u INNER JOIN productBacklog p ON u.ProductBacklogId = p.ProductBacklogId where p.ProjectId = '$Projectid' and u.UserStoryId not in (select UserStoryId from UserStoriestoSprint); ");

?>
<div class="container">
<h3> Add user stories to sprints</h3>
<form action="#" method="post">
<select class="form-control" name="selectSprint">
<?php
if (! $Sprintresult) {
} else {
	while ( $row = mysqli_fetch_row ( $Sprintresult ) ) {
		echo "<option value=\"{$row[0]}\">{$row[1]}</option>";
	}
}
?>
</select>
<!-- </form>
<form action="#" method="post">  -->
<div class="checkbox">
<?php
if (! $UserStories) {
} else {
	while ( $row2 = mysqli_fetch_row ( $UserStories ) ) {
		echo "<label><input type=\"checkbox\" name=\"check_box[]\" value=\"{$row2[0]}\"> {$row2[1]} </label><br/>";
	}
}

?>
</div>
<input type="submit" name="AddUserStoriesToSprint" value="Add User Stories to selected Sprint" class="btn btn-warning" onClick="window.location.reload()"/>
</form>
<?php
if (isset ( $_POST ['AddUserStoriesToSprint'] )) { // to run PHP script on submit
	
	if (! empty ( $_POST ['selectSprint'] )) {
		$SprintValue = $_POST ['selectSprint'];
		
		if (! empty ( $_POST ['check_box'] )) {
			foreach ( $_POST ['check_box'] as $selected ) {
				$UpdateUserStories = "INSERT INTO UserStoriestoSprint(UserStoryId,SprintId) values($selected,$SprintValue);";
				$UpdateUserStoriesresult = mysqli_query ( $connect, $UpdateUserStories );
			}
		}
	}
	$message = "Sprint has been added";
	echo "<script type='text/javascript'>alert('$message');window.location = 'addUserstoryToSprint.php?link=$Projectid'</script>";
}
?>
</div>
</body>
</html>
