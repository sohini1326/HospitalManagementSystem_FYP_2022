<?php

require "db_config.php";

// this url on direct hitting should not respond. It is built to handle the form sbmssn
// $_SERVER['REQUEST_METHOD']=='POST' incase of form sbmssn

if ($_SERVER['REQUEST_METHOD']=='GET') {
	echo "INVALID URL";
	exit();
}

session_start();

$doctor_name=$_POST['name'];
$doctor_email=$_POST['email'];
$doctor_pswrd=$_POST['password'];

$query = "INSERT INTO doctor_login VALUES (NULL,'$doctor_name','$doctor_email','$doctor_pswrd')";

if(mysqli_query($conn,$query)) {

	$query1 = "SELECT * FROM doctor_login WHERE doctor_email LIKE '$doctor_email' AND doctor_pswrd LIKE '$doctor_pswrd'";
	$result1 = mysqli_query($conn,$query1);

	$fetched_result = mysqli_fetch_assoc($result1);
    
    $_SESSION['doctor_id'] = $fetched_result['doctor_id'];
	$_SESSION['doctor_name'] = $fetched_result['doctor_name'];
	$_SESSION['doctor_email'] = $fetched_result['doctor_email'];
	$_SESSION['doctor_pswrd'] = $fetched_result['doctor_pswrd'];

	header('Location:doctor_dashboard.php');

}else{
	header('Location:index.php?err=4');
}



?>