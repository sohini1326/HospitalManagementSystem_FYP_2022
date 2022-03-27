<?php

require "db_config.php";
require 'razorpay-php/razorpay-php/Razorpay.php';
use Razorpay\Api\Api;
session_start();

if(isset($_POST['payment_id']) && isset($_POST['bid']) && isset($_POST['payment_type'])){
    

    $payment_type = $_POST['payment_type'];
    $payment_id = $_POST['payment_id'];
    $booking_id = $_POST['bid'];

    $api = new Api('rzp_test_mE9XDNP376RHLY', 'fWJwX5sGmbGbyoA2DoRF9Ucq');
    $payment =  $api->payment->fetch($payment_id);
    $payment_method = strtoupper($payment->method);

    
    
}

?>