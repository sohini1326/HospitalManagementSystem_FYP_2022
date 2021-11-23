<?php

require "db_config.php";

// this url on direct hitting should not respond. It is built to handle the form sbmssn
// $_SERVER['REQUEST_METHOD']=='POST' incase of form sbmssn

if ($_SERVER['REQUEST_METHOD']=='GET') {
	echo "INVALID URL";
	exit();
}

session_start();

$admin_name=$_POST['name'];
$admin_email=$_POST['email'];
$admin_pswrd=$_POST['password'];

$query = "INSERT INTO admin VALUES (NULL,'$admin_name','$admin_email','$admin_pswrd')";

if(mysqli_query($conn,$query)) {

	$query1 = "SELECT * FROM admin WHERE admin_email LIKE '$admin_email' AND admin_pswrd LIKE '$admin_pswrd'";
	$result1 = mysqli_query($conn,$query1);

	$fetched_result = mysqli_fetch_assoc($result1);

	$_SESSION['admin_name'] = $fetched_result['admin_name'];
	$_SESSION['admin_id'] = $fetched_result['admin_id'];
	$_SESSION['admin_email'] = $fetched_result['admin_email'];
	$_SESSION['admin_pswrd'] = $fetched_result['admin_pswrd'];

	header('Location:admin_dashboard.php');

}else{
	header('Location:index.php?err=2');
}



?>