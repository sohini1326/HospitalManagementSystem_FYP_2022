<?php
require "db_config.php";
$booking_id = $_GET['booking_id'];
$query = "UPDATE `vaccination_bookings` SET `payment_status` = 'COMPLETE' WHERE `vaccination_bookings`.`unique_id` LIKE '$booking_id'";
    $result = mysqli_query($conn,$query);

    header("Location:vaccination_booking_success.php?booking_id=$booking_id");
    ?>