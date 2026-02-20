<?php

require('config.php');
require('razorpay-php/Razorpay.php');
//session_start();

// Create the Razorpay Order

use Razorpay\Api\Api;
//echo $keyId;

$api = new Api($keyId, $keySecret);

//print_r($api);
//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
error_reporting(0);
$amount = $_REQUEST['amount'];
$orderData = [
    'receipt'         => rand(),
    'amount'          => $amount * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

//print_r($orderData);
$razorpayOrder = $api->order->create($orderData);
// echo $razorpayOrderId = $razorpayOrder['id'];
echo json_encode(array('status'=> 1, 'order_id'=>$razorpayOrder['id']));

?>