<?php

require "db_config.php";

// this url on direct hitting should not respond. It is built to handle the form sbmssn
// $_SERVER['REQUEST_METHOD']=='POST' incase of form sbmssn

if ($_SERVER['REQUEST_METHOD']=='GET') {
	echo "INVALID URL";
	exit();
}

session_start();

$days=$_POST['days'];
$name=$_POST['txt'];
$email=$_POST['email'];
$contact=$_POST['contact'];
$vaccine_id=$_POST['vaccine_id'];
$booking_id=$_POST['booking_id'];
$vaccination_booker_name=$_POST['vaccination_booker_name'];
$vaccination_booker_id=$_POST['vaccination_booker_id'];
$status="INCOMPLETE";


$query = "INSERT INTO `vaccination_bookings` (`unique_id`, `vaccine_id`, `vaccination_booker_id`, `vaccination_booker_name`, `name`, `email`, `contact_no`, `date`, `time`, `vaccination_status`) VALUES ('$booking_id', '$vaccine_id', '$vaccination_booker_id', '$vaccination_booker_name', '$name ', '$email', '$contact', '$days', '9AM - 11AM', '$status')";

$result = mysqli_query($conn,$query);
header('Location:vaccination_booking_success.php?booking_id='.$booking_id.'');

?>