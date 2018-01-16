<?PHP
include('session.php');
?>
<html>
<head>
<title>Agile Task Management System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="CSS/bootstrap.min.css">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="CSS/Main.css">
  <!-- Include jQuery -->
   <script src="https://code.jquery.com/jquery-1.8.2.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/i18n/defaults-*.min.js"></script>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body>
<?php 
if (isset($_SESSION ['role'])){
$role_session = $_SESSION ['role'];
if ($role_session == 1)
{
echo "<div class=\"topnav\"><a href=\"AdminHome.php\" style=\"text-decoration: none;\">Home</a>";	
}
else if($role_session == 2)
{
	echo "<div class=\"topnav\"><a href=\"Home.php\" style=\"text-decoration: none;\">Home</a>";
}
else if($role_session == 3)
{
echo "<div class=\"topnav\"><a href=\"Home.php\" style=\"text-decoration: none;\">Home</a>";
}
else if($role_session == 4)
{
	echo "<div class=\"topnav\"><a href=\"Home.php\" style=\"text-decoration: none;\">Home</a>";
}
}
?>

</div>
