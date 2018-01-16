<?PHP
include 'Header.php';
if ($a = $_GET ['link']) {
	$Projectid = $a;
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
// if ($role_session == 1) {
// 	echo "<div><a href = \"AdminHome.php\">Go Back</a></div>";
// } else if ($role_session == 3) {
// 	echo "<div><a href = \"ScrumMasterHome.php\">Go Back</a></div>";
// }
?>
<div class="container">  
  <ul class="nav nav-pills nav-justified">
    <li class="active"><a href="#home" data-toggle="pill" >Project Information</a></li>
    <li><a href="#menu1" data-toggle="pill" >User Management</a></li>
    <?php  if ($role_session ==3) { ?>
    <li><a href="#menu2" data-toggle="pill" >User stories Management</a></li>
    <?php } ?>
  </ul>
  
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3></h3>
      <?php 
include 'ProjectDetail.php';
?>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3></h3>
      <?php 
include 'ProjectUsers.php';
?>
    </div>
    <?php  if ($role_session ==3) { ?>
    <div id="menu2" class="tab-pane fade">
      <h3></h3>
     <?php 
     include 'ProjectData.php';
     ?>
    </div>
    <?php  } ?>
  </div>  
</div>
</body>
</html>

