<?php

require('config.php');

//session_start();
error_reporting(0);
require('razorpay-php/Razorpay.php');

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false) {
  $api = new Api($keyId, $keySecret);

  try {
    // Please note that the razorpay order ID must
    // come from a trusted source (session here, but
    // could be database or something else)
    $attributes = array(
      'razorpay_order_id' => $_SESSION['razorpay_order_id'],
      'razorpay_payment_id' => $_POST['razorpay_payment_id'],
      'razorpay_signature' => $_POST['razorpay_signature']
    );

    $api->utility->verifyPaymentSignature($attributes);
  } catch (SignatureVerificationError $e) {
    $success = false;
    $error = 'Razorpay Error : ' . $e->getMessage();
  }
}

if ($success === true) {
  $html = "<h3>Your payment was successful</h3>";

  $data['payment_status'] = 1;
  $this->Manage_code->updateOrderStatus($_SESSION['order_id'], $data);
  $this->load->library('cart');
  $this->cart->destroy(); 
  unset($_SESSION['cart_contents']);
  ?>
  <script type="text/javascript">
    setTimeout(function() {
     window.location = "https://www.pahadilala.com/"
    }, 2000);
  </script> 
  <?php
  } else {
    $html = "<p>Your payment failed</p> <p>{$error}</p>";
              
  }
?>

<!--     <p>Payment ID: {$_POST['razorpay_payment_id']}</p> -->


<!DOCTYPE html>

<html dir="ltr" lang="en">

<!--<![endif]-->



<head>

  <meta charset="UTF-8" />

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Pahadi Lala</title>

  <base />

  <meta name="keyword" content="Pahadi Lala,Jhangora,ragi,koda,pahdi jhangora,pahadi koda, tehri koda, organic food, jhakhya,bhatt,soyabean" />

  <meta name="description" content="Pahadi Lala,Jhangora,ragi,koda,pahdi jhangora,pahadi koda, tehri koda, organic food, jhakhya,bhatt,soyabean" />

  <script src="<?php echo base_url(); ?>catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>

  <script src="<?php echo base_url(); ?>catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

  <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700,900' rel='stylesheet' type='text/css'>

  <link href="<?php echo base_url(); ?>catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

  <link href="<?php echo base_url(); ?>catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" rel="stylesheet" media="screen" />

  <link href="<?php echo base_url(); ?>catalog/view/theme/OPC080_07/stylesheet/TemplateTrip/bootstrap.min.css" rel="stylesheet" media="screen" />

  <link href="<?php echo base_url(); ?>catalog/view/theme/OPC080_07/stylesheet/stylesheet.css" rel="stylesheet">

  <link href="<?php echo base_url(); ?>catalog/view/theme/OPC080_07/stylesheet/TemplateTrip/ttblogstyle.css" rel="stylesheet" type="text/css" />

  <link href="<?php echo base_url(); ?>catalog/view/theme/OPC080_07/stylesheet/TemplateTrip/lightbox.css" rel="stylesheet" type="text/css" />

  <link href="<?php echo base_url(); ?>catalog/view/javascript/jquery/swiper/css/swiper.min.css" type="text/css" rel="stylesheet" media="screen" />

  <link href="<?php echo base_url(); ?>catalog/view/javascript/jquery/swiper/css/opencart.css" type="text/css" rel="stylesheet" media="screen" />

  <link href="<?php echo base_url(); ?>css/custom.css" type="text/css" rel="stylesheet" media="screen" />

  <script src="<?php echo base_url(); ?>catalog/view/javascript/common.js" type="text/javascript"></script>

  <script src="<?php echo base_url(); ?>catalog/view/javascript/TemplateTrip/addonScript.js" type="text/javascript"></script>

  <script src="<?php echo base_url(); ?>catalog/view/javascript/TemplateTrip/lightbox-2.6.min.js" type="text/javascript"></script>

  <script src="<?php echo base_url(); ?>catalog/view/javascript/TemplateTrip/waypoints.min.js" type="text/javascript"></script>

  <script src="<?php echo base_url(); ?>catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>

  <script src="<?php echo base_url(); ?>catalog/view/javascript/jquery/swiper/js/swiper.jquery.js" type="text/javascript"></script>



</head>

<body>

  <div id="page">
    <header>
      <div class="container-fluid" style="padding-bottom: 14px;">
        <nav class="navbar navbar-default" role="navigation">
          <div class="container-fluid navbar-border">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url(); ?>img/Logo-new.png" class="mainlogo">
              </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li>
                  <div id="top-links"></div>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
      </div>
    </header>

    <body>
      <div class="container">
        <div class="successfully">
          <!-- <h1>successfully</h1> -->
          <?php echo $html; ?>
        </div>

      </div>
      <footer>
        <div class="footer-bottom">
          <div class="container-fluid">
            <div class="footer-bottom-link">
              <p>Pahadi Lala &copy; 2021</p>
            </div>
          </div>
        </div>
      </footer>

    </body>

</html>