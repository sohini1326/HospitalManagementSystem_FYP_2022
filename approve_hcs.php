<?php

require 'db_config.php';

$p_id=$_GET['p_id'];
$s_id=$_GET['s_id'];

$query = "UPDATE applicants_hcs SET status = 'Approved', current_status = 'Active'
			WHERE id = '$p_id' AND s_id = '$s_id'";

if(mysqli_query($conn,$query)){
	header('Location:add_health_card_schemes_dashboard.php');
}

?>