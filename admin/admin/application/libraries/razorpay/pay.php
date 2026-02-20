<?php
error_reporting(0);
$all =  $this->cart->contents();
$order_id  = $_POST['order_id'];
// echo $order_id;
$getData = $this->Manage_code->getOrderDataForPay($order_id);
?>
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
  <!-- Css Styles -->
  <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url() ?>css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url() ?>css/elegant-icons.css" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url() ?>css/jquery-ui.min.css" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url() ?>css/magnific-popup.css" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url() ?>css/owl.carousel.min.css" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url() ?>css/slicknav.min.css" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url() ?>css/style.css" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url() ?>css/selfstyle.css" type="text/css">
</head>

<body>




  <div class="page-header-wrapper bg-offwhite border-bottom">
    <div class="container">
      <div class="row justify-content-center">
        <a href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>admin/images/Logo-new.png" alt="logo"></a>
      </div>
      <div class="row align-items-center border-top">
        <div class="col-8 text-center">
          <div class="page-header-content d-flex">
            <h2 class="my-4 text-dark">Order Details</h2>
          </div>
        </div>
       
      </div>
    </div>
  </div>
  <div class="col-lg-12 pull-left text-center padding-xxx">
    <div class="col-lg-12 text-center pull-left">
      <div class="col-lg-6 text-center pull-left">
        <h4 class="py-4">Shipping Information</h4>
        <table class="table">
          <tr>
            <td>Name</td>
            <td><?php echo $getData['name'] ?></td>
          </tr>
          <tr>
            <td>Email</td>
            <td><?php echo $getData['email'] ?></td>
          </tr>
          <tr>
            <td>Contact no</td>
            <td><?php echo $getData['phone'] ?></td>
          </tr>
          <tr>
            <td>Address</td>
            <td><?php echo $getData['address'] ?></td>
          </tr>

        </table>
      </div>
      <div class="col-lg-6 text-center pull-left">
        <h4 class="py-4">Product Information</h4>
        <table class="table table-bordered text-center">
          <thead>
            <tr>
              <th>Products</th>
              <th>Price</th>
              <!-- <th>Quantity</th> -->
              <th>Total</th>
            </tr>
          </thead>
          <tbody>

            <?php
            foreach ($all as $data) {

              $total = $data['subtotal'];

            ?>
              <tr>
                <td class="product-list">
                  <div class="cart-product-item d-flex align-items-center">

                    <p class="product-name"><?php echo $data['name']; ?></p>
                  </div>
                </td>
                <td><span class="price">Rs <?php echo $data['price']; ?></span></td>
                <!--    <td>
                                                <div class="pro-qty">
                                                    <input type="text" class="quantity" title="Quantity" value="<?php echo $data['qty']; ?>">
                                                </div>
                                            </td> -->
                <td colspan="2"><span class="price">Rs <?php echo $data['subtotal']; ?></span></td>
              </tr>
            <?php } ?>
            <tr>
              <td>
                <h6>Total Amount</h6>
              </td>
              <td colspan="2">
                <h6><?php echo "INR ";
                    echo $amount  =    $this->cart->total();
                    echo "<br>"; ?></h6>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>

    <?php

    ////////////
    error_reporting(0);


    /////////////

    require('config.php');
    require('razorpay-php/Razorpay.php');
    //session_start();

    // Create the Razorpay Order

    use Razorpay\Api\Api;

    $api = new Api($keyId, $keySecret);

    //
    // We create an razorpay order using orders api
    // Docs: https://docs.razorpay.com/docs/orders
    //
    @session_start();
    $_SESSION['order_id'] = $order_id;
    $orderData = [
      'receipt'         => 3456,
      'amount'          => $amount * 100, // 2000 rupees in paise
      'currency'        => 'INR',
      'payment_capture' => 1 // auto capture
    ];

    $razorpayOrder = $api->order->create($orderData);

    $razorpayOrderId = $razorpayOrder['id'];

    $_SESSION['razorpay_order_id'] = $razorpayOrderId;

    $displayAmount = $amount = $orderData['amount'];

    if ($displayCurrency !== 'INR') {
      $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
      $exchange = json_decode(file_get_contents($url), true);

      $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
    }

    $checkout = 'automatic';

    if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true)) {
      $checkout = $_GET['checkout'];
    }

    $data = [
      "key"               => $keyId,
      "amount"            => $amount,
      "name"              => "Pahadi Lala",
      "description"       => "",
      "image"             => "https://www.pahadilala.com/img/Logo-new.png",
      "prefill"           => [
        "name"              => $getData['name'],
        "email"             => $getData['email'],
        "contact"           => $getData['phone'],
      ],
      "notes"             => [
        "address"           => "Hello World",
        "merchant_order_id" => $order_id,
      ],
      "theme"             => [
        "color"             => "#F37254"
      ],
      "order_id"          => $razorpayOrderId,
    ];

    if ($displayCurrency !== 'INR') {
      $data['display_currency']  = $displayCurrency;
      $data['display_amount']    = $displayAmount;
    }

    $json = json_encode($data);

    require("checkout/{$checkout}.php");

    ?>
  </div>

 

  <!-- ------------------------------------------------------------------------------------------------------------- -->




  <footer class="footer container-fluid">
    <!-- ////////////////// -->
    <div id="myModal" class="modal fade" role="dialog" style="">

      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="margin-top:80px;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <!--    <img src="<?php echo base_url(); ?>img/logo2.png" class="cart-logo center-block" width="100"> -->
            <h4 class="modal-title text-center" style="    margin-left: -20px;">Your Cart</h4>
          </div>
          <div class="modal-body">

            <table class="table">
              <tbody>
                <tr>
                  <th>Item</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Remove</th>
                  <!--    <th>Action</th> -->
                </tr>

                <?php

                $all =  $this->cart->contents();
                //print_r($all);
                foreach ($all as $data) {

                ?>
                  <tr>
                    <td> <?php echo $data['name'] ?></td>
                    <td> <?php echo  $data['qty'] ?></td>
                    <td> <?php echo  $data['price'] ?></td>
                    <td> <a class="btn btn-xs btn-danger" onclick="removeCartData('45');"> <i class="fa fa-trash"></i> </a></td>

                  </tr>
                <?php } ?>

              </tbody>
            </table>
          </div>
          <!--  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
          <div class="modal-footer">


            <button type="button" class="btn btn-warning pull-left button" data-dismiss="modal"> Add more items</button>
            <a href="checkout" class="btn btn-warning button">Order Now</a>
          </div>
        </div>

      </div>
    </div>


    <!-- ////////////////// -->

    <input type="hidden" name="" id="base_url" value="<?php echo base_url(); ?>">


    <div class="footer-bottom">
      <div class="container-fluid">
        <div class="footer-bottom-link">
          <p>Pahadi Lala &copy; 2020</p>
        </div>
      </div>
    </div>
  </footer>

  <div id="logintest" class="modal fade" role="dialog" style="">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content col-md-12 p-none" style="">

        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <!--  <div class="col-lg-6 p-none leftside" style="">
              
            </div> -->
          <div class="rightside" style="">
            <div id="login-wrap">
              <h2 class="text-center">Please Login</h2>
              <form class="" name="doLogin">
                <div class="form-group">
                  <input type="email" class="form-control controls" placeholder="Your email address" required="" name="email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" placeholder="Your password " required="" name="password">
                  <a href="#0" class="forgot" id="show-pwd-wrap"><small>Forgot password?</small></a>
                </div>
                <div class="form-group text-center">
                  <input type="submit" class="btn_1 btn btn-primary" value="Login" name=""><br>
                  <span id="error_msg" class="error"></span>

                </div>

              </form>
              <p class="text-center ">Do not have an account yet? <br><a href="#0" id="showregister"><strong>Register now!</strong></a></p>
              <?php  //echo $login_ur;
              // $this->load->library('facebook');
              // $this->load->library('googleplus');
              ?>
              <?php //echo  $this->facebook->login_url(); 
              ?>
              <!-- <a href="" class="social_bt facebook">Login with Facebook</a> -->
              <?php //echo  $this->googleplus->loginURL(); 
              ?>
              <!-- <a href="" class="social_bt google">Login with Google</a> -->
            </div> <!-- login -->

            <div id="register-wrap">
              <h2 style="">Please Register</h2>
              <form name="insertVender">
                <input type="hidden" name="status" value="0">

                <div class="form-group">

                  <input type="text" class="form-control" placeholder="Your name" name="name" required="">
                </div>
                <div class="form-group">

                  <input type="text" class="form-control" placeholder="Your phone" name="phone" required="">
                </div>

                <div class="form-group">

                  <input type="email" onchange="return checkEmail();" class="form-control" placeholder="Your email address" name="email" required="" id="email">
                  <span id="email_msg" class="error"></span>
                </div>
                <div class="form-group">

                  <input type="text" class="form-control" placeholder="Address" id="pac-input" autocomplete="on" name="address" required="">

                  <!-- <input type="" name="" id="id_address">
                    <div id="postal_code"></div>
                    <div id="map_canvas"></div> -->
                  <div id="map"></div>
                </div>
                <div class="form-group">

                  <input type="password" class="form-control" id="password" name="password" placeholder="Your password" required="">
                </div>
                <div class="form-group">

                  <input type="password" class="form-control" id="cpassword" placeholder="Confirm password" name="cpassword" required="">
                </div>
                <!-- <div id="pass-info" class="clearfix"></div> -->

                <div class="form-group text-center">
                  <input class="btn_1 btn btn-primary" type="submit" value="Submit" onclick="return checkPassword();">
                </div>

                <p class="text-center ">Already have an Account? <a href="#0" id="showlogin"><strong>Login!</strong></a>
              </form>
            </div> <!-- register -->
            <div id="pwd-wrap">
              <h2 style="">Get Password</h2>
              <form name="forgetPassword">
                <div class="form-group">
                  <input type="email" class="form-control controls" placeholder="Your Registered email address" required="" name="email">
                </div>
                <div class="form-group text-center">
                  <input type="submit" class="btn_1" value="Submit" name=""><br>
                  <!-- <span id="error_msg" class="error"></span> --><br>
                  <a href="#0" id="showlogin2"><strong>
                      << Back To Login!</strong> </a> </div> </form> </div> </div> </div> </div> </div> </div> </body>     <!-- <script src="<?php echo base_url(); ?>js/user_main.js" type="text/javascript">
                          </script> -->
                        <!-- <script>
                            $(document).ready(function() {
                              // Add smooth scrolling to all links
                              $("a").on('click', function(event) {

                                // Make sure this.hash has a value before overriding default behavior
                                if  (this.hash !== "") {
                                  // Prevent default anchor click behavior
                                  event.preventDefault();

                                  // Store hash
                                  var hash = this.hash;

                                  // Using jQuery's animate() method to add smooth page scroll
                                  // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                                  $('html, body').animate({
                                    scrollTop: $(hash).offset().top
                                  }, 800, function() {

                                    // Add hash (#) to URL when done scrolling (default click behavior)
                                    // window.location.hash = hash;
                                  });
                                } // End if
                              });
                            });
                          </script> -->

                        <!-- <script type="text/javascript">
                            $("#register-wrap").hide();
                            $("#pwd-wrap").hide();

                            $("#showregister").click(function() {
                              $("#register-wrap").show();
                              $("#login-wrap").hide();
                              $("#pwd-wrap").hide();
                            });


                            $("#showlogin").click(function() {
                              $("#login-wrap").show();
                              $("#register-wrap").hide();
                              $("#pwd-wrap").hide();
                            });

                            $("#showlogin2").click(function() {
                              $("#login-wrap").show();
                              $("#register-wrap").hide();
                              $("#pwd-wrap").hide();
                            });

                            $("#show-pwd-wrap").click(function() {
                              $("#login-wrap").hide();
                              $("#register-wrap").hide();
                              $("#pwd-wrap").show();
                            });

                            function checkPassword() {

                              var password = $("#password").val();
                              var cpassword = $("#cpassword").val();
                              if (password != cpassword) {
                                alert("Password Not match");
                                $("#password").val('');
                                $("#cpassword").val('');
                                return false;
                              }


                            }
                          </script> -->

</html>