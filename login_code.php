<?php
require_once('connection.php');
$uname = $password = $pwd = '';

$uname = $_POST['uname'];
$pwd = $_POST['password'];
$password = MD5($pwd);
$sql = "SELECT * FROM tbluser WHERE username='$uname' AND Password='$password'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_assoc($result))
	{
		$id = $row["ID"];
		$uname = $row["uname"];
		session_start();
		$_SESSION['id'] = $id;
		$_SESSION['uname'] = $uname;
	}
	header("Location: welcome.php");
}
else
{
	echo "Please Check Your Username or Password!";
}
?>