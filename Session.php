<?php
include('Config.php');
session_start();

if(!isset($_SESSION['loggeduser'])){
	$_SESSION['loggeduser']="";
	header("location:Login.php");
}

$user_check = $_SESSION['loggeduser']; 
$ses_sql = mysqli_query($connect,"select Username,EmpId from User where Username = '$user_check' "); 
$row = mysqli_fetch_row($ses_sql); 
$login_session = $row[0];
$EmpId_session = $row[1];
// if(!isset($_SESSION['loggeduser'])){
// 	//header("location:Login.php");
// }

?>