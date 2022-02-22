<?php

require 'db_config.php';

$b_id=$_POST['b_id'];
$rep_val=$_POST['rep_val'];
$rep_result=$_POST['rep_result'];
$remarks=$_POST['remarks'];

$query="INSERT INTO labtest_report_ba VALUES ('$b_id',$rep_val,'$rep_result','$remarks')";

if(mysqli_query($conn,$query)){
	header('Location:generate_lab_report.php');
}

?>