<?php

require "db_config.php";

session_start();

$name = $_SESSION['patient_name'];
$patient_id = $_SESSION['patient_id'];

$name = $_GET['name'];
$mob = $_GET['mob'];
$mail_id = $_GET['mail_id'];
$bkng_id = $_GET['bkng_id'];
$gender=$_GET['gender'];

$query = "UPDATE test_bookings 
		  SET booking_done_for='$name', patient_contact_number='$mob', 
		  patient_mail_id='$mail_id', p_gender='$gender', status='Confirmed' 
		  WHERE booking_id LIKE '$bkng_id'";

if(mysqli_query($conn,$query)){
	echo("SUCCESS");
}else{
	echo("NOT SUCCESS");
}

?>