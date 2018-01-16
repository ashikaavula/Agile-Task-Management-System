<?PHP
include 'Header.php';
//session_start();
?>

<h1 style="text-align:center;">Sign in to acess system</h1>
<div class="login-form login-style" style="display: block;">
<form action="" method="post" >	
    <input placeholder="Username" id="uname" type="text" name="un"><br/>   
    <input placeholder="Password" id="pword" type="password" name="pword"><br/>
    <input type="submit" value="Login" id="loginbutton" name="submit" />
    <div id='ajax_result'></div> 
</form>
</div>
<?PHP
if($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST['un'], $_POST['pword']))
{
$username = $_POST['un'];
$password = $_POST['pword'];
}

if (checkuser($username,$connect)){
	
	if ($value = login($username, $password, $connect))
	{
		$_SESSION['loggeduser'] = $username;	
		$role = checkrole($username,$connect);		
		if($role == 1){
		header("location: AdminHome.php");
		}
		else if ($role==3 || $role==4 || $role==2) { header("location: Home.php"); }		
		else { echo "<div class=\"loginmsg login-style login-form\">Only admin,scrum master and team member login allowed at this point</div>"; }
	}
	else { echo "<div class=\"loginmsg login-style login-form\">Wrong password. Try again</div>";}	
}
else{echo "<div class=\"loginmsg login-style login-form\">Sorry, our system doesn't recognize that username</div>";}
}


function checkuser($username,$connect)
{
	$userresult = mysqli_query($connect,"SELECT EmpId from User where Username = '$username';");
	if(mysqli_num_rows($userresult)>0){
		return true;
	}
	else { return false;}
}

function login($username,$password,$connect)
{
	$value = mysqli_query($connect,"SELECT Password from User where Username = '$username';");
	while ($result = mysqli_fetch_row($value)){
	 if($password == $result[0]){
	 return true;
	}	
   else{return false;}	
	}
}
function checkrole($username,$connect)
{
	$RoleId = mysqli_query($connect,"select RoleId from UserToRole UR inner join User U ON UR.EmpId=U.EmpId where UR.EmpId = 
					(SELECT EmpId from User where Username = '$username') limit 0,1;");	
	$RoleId = mysqli_fetch_row($RoleId);
	$_SESSION['role']=$RoleId[0];
	return $RoleId[0];
}

?>

</body>
</html>