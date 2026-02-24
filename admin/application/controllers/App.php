<?php

defined('BASEPATH') or exit('No direct script access allowed');
//header('Access-Control-Allow-Origin : http://localhost:4200');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// require 'vendor/autoload.php';
// use Google\Client;

class App extends CI_Controller
{
	public function __construct()

	{
		parent::__construct();

		$this->AccessKey = '1234';

		$this->load->helper(array('form', 'url'));

		$this->load->model('Manage_product');

		$this->load->model('App_model');

		$this->load->library('session');
		$this->load->library('encryption');
	}

	public function getSubscriptions()
	{

		$data = $this->Manage_product->getAllPackages();

		echo json_encode($data);
	}

	public function insertPaymentData()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);

			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$data['package_id'] = empty($this->input->post('package_id')) ? '' : $this->input->post('package_id');
				$data['user_id'] = empty($this->input->post('user_id')) ? '' : $this->input->post('user_id');;
				$data['order_id'] = empty($this->input->post('order_id')) ? '' : $this->input->post('order_id');;
				$data['status'] = 'Pending';

				$res = $this->Manage_product->insertPayment($data);

				if ($res == 1) {
					echo json_encode(array('status' => 'success'));
				} else {
					echo json_encode(array('status' => 'error', 'msg' => 'Something went wrong, Try Again!'));
				}
			} else {
				echo json_encode(array('status' => "error", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "error", 'message' => 'Auth token is required'));
		}
	}

	public function updatePaymentData()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);

			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {


				$order_id = empty($this->input->post('order_id')) ? '' : $this->input->post('order_id');
				$data['payment_id'] = empty($this->input->post('package_id')) ? '' : $this->input->post('package_id');
				$data['status'] = 'Completed';
				$getPaymentInfo = $this->Manage_product->getPaymentByOrderId($order_id);

				$res = $this->Manage_product->updatePayment($getPaymentInfo[0]['id'], $data);
				if ($res == 1) {
					echo json_encode(array('status' => 'success', 'msg' => 'Payment Completed!'));
				} else {
					echo json_encode(array('status' => 'error', 'msg' => 'Internal Db Error!!'));
				}
			} else {
				echo json_encode(array('status' => "error", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "error", 'message' => 'Auth token is required'));
		}
	}


	public function getCategory()
	{
		// if($this->AccessKey != $this->input->post('accessKey')){
		// 	echo json_encode(array('status'=>'401','msg'=>'Not Accessible'));
		// }
		// else{
		$id = empty($this->input->post('id')) ? '' : $this->input->post('id');

		$getCategory = $this->App_model->getCategory($id);

		echo json_encode(array('status' => '200', 'data' => $getCategory));
	}
	public function getSociety()
	{
		$id = empty($this->input->get_post('id')) ? '' : $this->input->get_post('id');
		//$r_id = empty($this->input->get_post('r_id')) ? '' : $this->input->get_post('r_id');
		$getSociety = $this->App_model->getSociety($id, $r_id);
		//print_r($getCategory);
	}
	public function getSplace()
	{
		$id = empty($this->input->get_post('id')) ? '' : $this->input->get_post('id');

		$getSplace = $this->App_model->getSplace($id);

		//print_r($getCategory);
	}

	public function getSubCatBycatId()
	{
		$category_id = empty($this->input->get_post('category_id')) ? '' : $this->input->get_post('category_id');

		$getCategory = $this->App_model->getSubCatBycatId($category_id);



		//print_r($getCategory);

	}

	public function getDishByRId()
	{

		//$data['category_id'] = empty($this->input->get_post('category_id')) ? '' :$this->input->get_post('category_id');
		$data['r_id'] = empty($this->input->get_post('r_id')) ? '' : $this->input->get_post('r_id');
		$getCategory = $this->App_model->getDishByRId($data);

		//print_r($getCategory);
	}


	public function getProductByShop()
	{
		$data['vender_id'] = empty($this->input->get_post('vender_id')) ? '' : $this->input->get_post('vender_id');
		// $data['sub_category_id'] = empty($this->input->get_post('sub_category_id')) ? '' :$this->input->get_post('sub_category_id');
		$getCategory = $this->App_model->getProductByShop($data);
		//print_r($getCategory);

	}


	public function getProductByCat()
	{
		$category_id = empty($this->input->get_post('category_id')) ? '' : $this->input->get_post('category_id');

		$getProduct = $this->App_model->getProductByCat($category_id);
		echo json_encode($getProduct);
	}
	public function getProductById()
	{
		$category_id = empty($this->input->get_post('id')) ? '' : $this->input->get_post('id');

		//$data['sub_category_id'] = empty($this->input->get_post('sub_category_id')) ? '' :$this->input->get_post('sub_category_id');
		$getProduct = $this->App_model->getProductById($category_id);
		// //////////////////
		$arr = array();
		//print_r($getProduct);
		foreach ($getProduct as $dataAll) {
			//if ($distance<=20) {
			//////////avrg
			$getRatingCount = $this->App_model->getRatingCount($dataAll['id']);
			$total = 0;
			$i = 0;
			//print
			if (!empty($getRatingCount)) {
				foreach ($getRatingCount as $data) {
					$rat = $data['rating'];
					$total = $total + $rat;
					$i++;
				}
				$avr =  $total / $i;
			} else {
				$avr = 0;
			}
			///////////avrg
			//$arr = array();
			$search_details = array(
				"id" => $dataAll['id'],
				"product_name" => $dataAll['product_name'],
				"product_quantity" => $dataAll['product_quantity'],
				"product_price" => $dataAll['product_price'],
				"category_id" => $dataAll['category_id'],
				"sub_category_id" => $dataAll['sub_category_id'],
				"type" => $dataAll['type'],
				"product_type" => $dataAll['product_type'],
				"sort_description" => $dataAll['sort_description'],
				"orginal_price" => $dataAll['orginal_price'],
				"category_name" => $dataAll['category_name'],
				"link" => $dataAll['link'],
				"product_image" => $this->App_model->getProductImage($dataAll['id']),
				"product_rating" => $this->App_model->getRatingForOrder($dataAll['id']),
				"rat_avr" => $avr
			);

			array_push($arr, $search_details);
		} ////loop close


		echo json_encode($arr);
	}

	public function getProductSuggestion()
	{
		$search = empty($this->input->get_post('search')) ? '' : $this->input->get_post('search');

		//$getCategory = $this->App_model->getProductSuggestion($search);
		//print_r($getCategory);

	}
	public function getApiKey()
	{
		//$search = empty($this->input->get_post('search')) ? '' : $this->input->get_post('search');

		//$getCategory = $this->App_model->getProductSuggestion($search);
		//print_r($getCategory);
		$keyId = 'rzp_live_SJ4vZVaVQgQY12';
		$keySecret = 'UfzHMM81gfApr2hn1XrcwN26';
		$displayCurrency = 'INR';
		echo  json_encode(array("keyId" => $keyId, "keySecret" => $keySecret, "displayCurrency" => $displayCurrency));
	}

	public function getSlider()
	{
		$id = empty($this->input->get_post('id')) ? '' : $this->input->get_post('id');

		$this->App_model->getSlider($id);



		//print_r($getCategory);

	}

	public function getContactInfo()
	{
		$id = empty($this->input->get_post('id')) ? '' : $this->input->get_post('id');

		$this->App_model->getContactInfo($id);

		//print_r($getCategory);

	}
	public function getCouponCode()
	{
		$id = empty($this->input->get_post('code')) ? '' : $this->input->get_post('code');

		$getCouponCode =	$this->App_model->getCouponCode($id);
		///print_r($getCouponCode);
		if ($getCouponCode) {

			echo json_encode(array('msg' => 'coupon code exit', 'discount' => $getCouponCode[0]['discount']));
		} else {
			echo json_encode(array('msg' => 'coupon code does not  exit'));
		}
	}
	public function getProductSearch()
	{
		$search = empty($this->input->get_post('search')) ? '' : $this->input->get_post('search');

		$getProductSearch = $this->App_model->getProductSearch($search);
		//print_r($getCategory);
		$arr = array();
		foreach ($getProductSearch as $dataAll) {
			//if ($distance<=20) {
			//////////avrg
			$getRatingCount = $this->App_model->getRatingCount($dataAll['id']);
			$total = 0;
			$i = 0;
			if (!empty($getRatingCount)) {
				foreach ($getRatingCount as $data) {
					$rat = $data['rating'];
					$total = $total + $rat;
					$i++;
				}
				$avr =  $total / $i;
			}
			///////////avrg
			$search_details = array(
				"id" => $dataAll['id'],
				"user_id" => $dataAll['user_id'],
				"product_name" => $dataAll['product_name'],
				"product_price" => $dataAll['product_price'],
				"category_id" => $dataAll['category_id'],
				"sub_category_id" => $dataAll['sub_category_id'],
				"type" => $dataAll['type'],
				"product_type" => $dataAll['product_type'],
				"sort_description" => $dataAll['sort_description'],
				"orginal_price" => $dataAll['orginal_price'],
				"category_name" => $dataAll['category_name'],
				"link" => $dataAll['link'],
				"product_image" => $this->App_model->getProductImage($dataAll['id']),
				"product_rating" => $this->App_model->getRatingForOrder($dataAll['id']),
				"rat_avr" => $avr
			);

			array_push($arr, $search_details);
		} ////loop close


		echo json_encode($arr);
	}

	function updatePassword()
	{

		//$data['id'] = '2129';

		$data['id'] = empty($this->input->get_post('user_id')) ? '' : $this->input->get_post('user_id');

		$data['email'] = empty($this->input->get_post('email')) ? '' : $this->input->get_post('email');
		//$data['email'] = "aman@gmail.com";

		$data['password'] = empty($this->input->get_post('old_password')) ? '' : $this->input->get_post('old_password');

		$dataUp['password'] = empty($this->input->get_post('new_password')) ? '' : $this->input->get_post('new_password');

		//$data['password'] = "123";
		$getUsers = $this->App_model->getUserEmailPass($data['email'], $data['password']);

		//print_r($getUsers);

		if ($getUsers[0]['password'] != "") {
			$this->App_model->updatePassword($data['id'], $dataUp);
		} else {
			echo json_encode(array('msg' => 'password not match'));
		}
	}

	function forgetPassword()
	{
		$data['email'] = empty($this->input->get_post('email')) ? '' : $this->input->get_post('email');

		$chars = "0123456789";

		$val = substr(str_shuffle($chars), 0, 3);

		$password = date('dm') . $val;

		$dataUp['password'] = md5($password);

		$getUsers = $this->App_model->getUserByEmail($data['email']);

		if (!empty($getUsers) && $getUsers[0]['id'] != "") {
			$this->App_model->updatePassword($getUsers[0]['id'], $dataUp);

			$message = '<h3>VahanAssist - Password Reset</h3>
				<p>Hello ' . $getUsers[0]['firstName'] . ',</p>
				<p>Your new password is: <strong>' . $password . '</strong></p>
				<p>Please login and change your password immediately.</p>
				<br><p>Regards,<br>Team VahanAssist</p>';

			$this->load->config('email');
			$config = $this->config->item('gmail');
			$this->load->library('email');
			$this->email->initialize($config);

			$this->email->set_newline("\r\n");
			$this->email->from($config['smtp_user'], 'VahanAssist');
			$this->email->to($data['email']);
			$this->email->subject('VahanAssist - Password Reset');
			$this->email->message($message);

			if ($this->email->send()) {
				echo json_encode(array('msg' => 'email Sent'));
			} else {
				echo json_encode(array('msg' => 'Password updated but email could not be sent. Please try again later.'));
			}
		} else {
			echo json_encode(array('msg' => 'email Not found'));
		}
	}

	// function updateUser()
	// {
	// 	$user_id = empty($this->input->get_post('user_id')) ? '' : $this->input->get_post('user_id');
	// 	$data['phone'] = empty($this->input->get_post('phone')) ? '' : $this->input->get_post('phone');
	// 	$data['email'] = empty($this->input->get_post('email')) ? '' : $this->input->get_post('email');
	// 	$data['address'] = empty($this->input->get_post('address')) ? '' : $this->input->get_post('address');
	// 	$data['location'] = empty($this->input->get_post('location')) ? '' : $this->input->get_post('location');
	// 	//$data['location'] = empty($this->input->get_post('location')) ? '' : $this->input->get_post('location');
	// 	$data['city'] = empty($this->input->get_post('city')) ? '' : $this->input->get_post('city');
	// 	$data['state'] = empty($this->input->get_post('state')) ? '' : $this->input->get_post('state');
	// 	$this->App_model->updateUser($user_id, $data);
	// }
	function updateOrderStatus()
	{
		$order_id = empty($this->input->get_post('order_id')) ? '' : $this->input->get_post('order_id');

		$data['order_status'] = empty($this->input->get_post('order_status')) ? '' : $this->input->get_post('order_status');
		$data['payment_status'] = empty($this->input->get_post('payment_status')) ? '' : $this->input->get_post('payment_status');

		$this->App_model->updateOrderStatus($order_id, $data);
	}

	function userSignup()
	{
		//	print_r($_POST);
		$data['category_id'] = empty($this->input->get_post('category_id')) ? '' : $this->input->get_post('category_id');
		$data['oauth_provider'] = empty($this->input->get_post('oauth_provider')) ? '' : $this->input->get_post('oauth_provider');
		$data['sub_category_id'] = empty($this->input->get_post('sub_category_id')) ? '' : $this->input->get_post('sub_category_id');
		$data['oauth_uid'] = empty($this->input->get_post('oauth_uid')) ? '' : $this->input->get_post('oauth_uid');
		$data['email'] = empty($this->input->get_post('email')) ? '' : $this->input->get_post('email');
		$data['name'] = empty($this->input->get_post('name')) ? '' : $this->input->get_post('name');
		$data['phone'] = empty($this->input->get_post('phone')) ? '' : $this->input->get_post('phone');
		$data['address'] = empty($this->input->get_post('address')) ? '' : $this->input->get_post('address');
		$data['location'] = empty($this->input->get_post('location')) ? '' : $this->input->get_post('location');
		$data['pin'] = empty($this->input->get_post('pin')) ? '' : $this->input->get_post('pin');
		$data['lat'] = empty($this->input->get_post('lat')) ? '' : $this->input->get_post('lat');
		$data['lng'] = empty($this->input->get_post('lng')) ? '' : $this->input->get_post('lng');

		$getData['oauth_provider'] = empty($this->input->get_post('oauth_provider')) ? '' : $this->input->get_post('oauth_provider');

		$getData['oauth_uid'] = empty($this->input->get_post('oauth_uid')) ? '' : $this->input->get_post('oauth_uid');

		if ($getData['oauth_provider'] == "truecaller") {
			$getUsersData = $this->App_model->getUsersDataTrue($data['phone']);
		} else {
			$getUsersData = $this->App_model->getUsersData($getData);
		}
		//print_r($data);

		if (empty($getUsersData)) {
			//	echo "1 hola";
			$msg = $this->App_model->insertUser($data);

			//$msg = $this->App_model->insertLog($dataLog);

			$session_data['login_id'] = $msg['last_id'];

			if ($getData['oauth_provider'] == "truecaller") {
				$getLogUserLofTime = $this->App_model->getUsersDataTrue($data['phone']);
			} else {
				$getLogUserLofTime = $this->App_model->getLogUserLofTime($data['email']);
			}

			echo json_encode(array('user_id' => $msg['last_id'], 'msg' => '1', 'data' => $getLogUserLofTime));

			//	$session_data['email'] = $dataLog['username'];

			$this->session->set_userdata($session_data);
		} else {
			if ($getData['oauth_provider'] == "truecaller") {
				$getLogUser = $this->App_model->getUsersDataTrue($data['phone']);
			} else {
				$getLogUser = $this->App_model->getLogUser($data);
			}
			//	print_r($getLogUser);
			//$session_data['login_id'] = $getLogUser[0]['id'];
			//$session_data['email'] = $getLogUser[0]['email'];
			echo json_encode(array('data' => $getLogUser, 'msg' => '1'));

			$this->session->set_userdata($session_data);
		}
	}

	function getEmailsDetails()
	{
		$id = empty($this->input->get_post('page_id')) ? '' : $this->input->get_post('page_id');



		//$data['mobile'] = empty($this->input->get_post('mobile')) ? '' :$this->input->get_post('mobile');

		$this->Service_model->getEmailsDetails($id);
	}

	function getUserDetails()
	{
		$id = empty($this->input->get_post('id')) ? '' : $this->input->get_post('id');



		//$data['mobile'] = empty($this->input->get_post('mobile')) ? '' :$this->input->get_post('mobile');

		$getUserDetails = $this->App_model->getUserDetails($id);

		echo json_encode($getUserDetails);
	}

	function getOrderByUserId()
	{
		$id = empty($this->input->get_post('user_id')) ? '' : $this->input->get_post('user_id');
		//$data['mobile'] = empty($this->input->get_post('mobile')) ? '' :$this->input->get_post('mobile');

		$getOrder = $this->App_model->getOrder($id);
		//echo json_encode($getOrder);
	}
	function getOrders()
	{
		//$id = empty($this->input->get_post('user_id')) ? '' : $this->input->get_post('user_id');
		//$data['mobile'] = empty($this->input->get_post('mobile')) ? '' :$this->input->get_post('mobile');

		$getOrder = $this->App_model->getOrders($id);
		//echo json_encode($getOrder);
	}

	function getOrderDetails()
	{

		$id = empty($this->input->get_post('order_id')) ? '' : $this->input->get_post('order_id');
		$user_id = empty($this->input->get_post('user_id')) ? '' : $this->input->get_post('user_id');

		//$data['mobile'] = empty($this->input->get_post('mobile')) ? '' :$this->input->get_post('mobile');
		$getOrderDetails = $this->App_model->getOrderDetails($id);

		//print_r($getOrderDetails);

		$arr = array();

		foreach ($getOrderDetails as $dataAll) {


			//////////avrg
			//$getRatingCount = $this->App_model->getRatingCount($dataAll['product_id']);
			$total = 0;
			$i = 0;
			if (!empty($getRatingCount)) {
				foreach ($getRatingCount as $data) {
					$rat = $data['rating'];
					$total = $total + $rat;
					$i++;
				}
				$avr =  $total / $i;
			} else {
				$avr =  0;
			}
			///////////avrg

			$search_details = array(
				"id" => $dataAll['id'],
				"order_id" => $dataAll['order_id'],
				"product_id" => $dataAll['product_id'],
				"product_name" => $dataAll['name'],
				"type" => $dataAll['type'],
				"product_price" => $dataAll['price'],
				"quantity" => $dataAll['quantity'],
				"product_image" => $this->App_model->getProductImage($dataAll['product_id'])
			);

			array_push($arr, $search_details);
		} ////loop close

		//print_r($arr);
		echo json_encode($arr);
		//echo json_encode($getOrderDetails);
	}

	function insertContact()
	{
		$data['name'] = empty($this->input->get_post('name')) ? '' : $this->input->get_post('name');

		$data['email'] = empty($this->input->get_post('email')) ? '' : $this->input->get_post('email');

		$data['phone'] = empty($this->input->get_post('phone')) ? '' : $this->input->get_post('phone');

		$data['message'] = empty($this->input->get_post('message')) ? '' : $this->input->get_post('message');

		$this->App_model->insertContact($data);
	}

	function insertOrder()
	{

		//////////////insert order 
		$dataOrder['order_id'] = empty($this->input->post('order_id')) ? '' : trim($this->input->post('order_id'));
		$dataOrder['amount'] = empty($this->input->post('amount')) ? '' : $this->input->post('amount');
		$dataOrder['name'] = empty($this->input->post('name')) ? '' : $this->input->post('name');
		$dataOrder['email'] =  empty($this->input->post('email')) ? '' : $this->input->post('email');
		$dataOrder['phone'] =  empty($this->input->post('phone')) ? '' : $this->input->post('phone');
		$dataOrder['address'] = empty($this->input->post('address')) ? '' : $this->input->post('address');
		$dataOrder['location'] = empty($this->input->post('location')) ? '' : $this->input->post('location');
		$dataOrder['city'] = empty($this->input->post('city')) ? '' : $this->input->post('city');
		$dataOrder['pin'] = empty($this->input->post('pin')) ? '' : $this->input->post('pin');
		/// $dataOrder['status'] =  empty($this->input->post('status')) ? '' :$this->input->post('status');
		$dataOrder['payment_mode'] = empty($this->input->post('payment_mode')) ? '' : $this->input->post('payment_mode');
		$dataOrder['address'] = empty($this->input->post('address')) ? '' : $this->input->post('address');
		$dataOrder['user_id'] = empty($this->input->post('user_id')) ? '' : $this->input->post('user_id');
		$dataOrder['r_id'] = empty($this->input->post('r_id')) ? '' : $this->input->post('r_id');
		$dataOrder['date_created'] = date('d-m-Y');
		//   print_r($_POST);
		$this->App_model->insertOrder($dataOrder);
		/////////////for order details////////////////////////
		$dataArr = empty($this->input->get_post('product_details')) ? '' : $this->input->get_post('product_details');
		$dcode = json_decode($dataArr, true);
		//print_r($dcode);
		$count = count($dcode);
		for ($i = 0; $i < $count; $i++) {
			$data['order_id'] = trim($dcode[$i]['order_id']);
			// 	$data['vender_id'] = $dcode[$i]['vender_id'];
			$data['name'] = $dcode[$i]['product_name'];
			$data['product_id'] = $dcode[$i]['id'];
			$data['price'] = $dcode[$i]['product_price'];
			$data['quantity'] = $dcode[$i]['item_quantity'];
			//$data['type'] = $dcode[$i]['type'];
			$data['date_created'] = date('d-m-Y');
			$msg = $this->App_model->insertOrderDetails($data);
		}

		/////////////for order details////////////////////////

	}

	//? Api for the top products which have high buying
	public function getTopProducts()
	{
		$category_id = empty($this->input->get_post('id')) ? '' : $this->input->get_post('id');

		//$data['sub_category_id'] = empty($this->input->get_post('sub_category_id')) ? '' :$this->input->get_post('sub_category_id');
		$getProduct = $this->App_model->getTopProducts($category_id);
		// //////////////////
		$arr = array();
		//print_r($getProduct);
		foreach ($getProduct as $dataAll) {
			//if ($distance<=20) {
			//////////avrg
			$getRatingCount = $this->App_model->getRatingCount($dataAll['id']);
			$total = 0;
			$i = 0;
			//print
			if (!empty($getRatingCount)) {
				foreach ($getRatingCount as $data) {
					$rat = $data['rating'];
					$total = $total + $rat;
					$i++;
				}
				$avr =  $total / $i;
			} else {
				$avr = 0;
			}
			///////////avrg
			//$arr = array();
			$search_details = array(
				"id" => $dataAll['id'],
				"product_name" => $dataAll['product_name'],
				"product_quantity" => $dataAll['product_quantity'],
				"product_price" => $dataAll['product_price'],
				"category_id" => $dataAll['category_id'],
				"sub_category_id" => $dataAll['sub_category_id'],
				"type" => $dataAll['type'],
				"product_type" => $dataAll['product_type'],
				"sort_description" => $dataAll['sort_description'],
				"orginal_price" => $dataAll['orginal_price'],
				"category_name" => $dataAll['category_name'],
				"link" => $dataAll['link'],
				"product_image" => $this->App_model->getProductImage($dataAll['id']),
				"product_rating" => $this->App_model->getRatingForOrder($dataAll['id']),
				"rat_avr" => $avr
			);

			array_push($arr, $search_details);
		} ////loop close


		echo json_encode($arr);
	}

	public function getFeaturedProduct()
	{
		$category_id = empty($this->input->get_post('id')) ? '' : $this->input->get_post('id');

		//$data['sub_category_id'] = empty($this->input->get_post('sub_category_id')) ? '' :$this->input->get_post('sub_category_id');
		$getProduct = $this->App_model->getFeaturedProduct($category_id);
		// //////////////////
		$arr = array();
		//print_r($getProduct);
		foreach ($getProduct as $dataAll) {
			//if ($distance<=20) {
			//////////avrg
			$getRatingCount = $this->App_model->getRatingCount($dataAll['id']);
			$total = 0;
			$i = 0;
			//print
			if (!empty($getRatingCount)) {
				foreach ($getRatingCount as $data) {
					$rat = $data['rating'];
					$total = $total + $rat;
					$i++;
				}
				$avr =  $total / $i;
			} else {
				$avr = 0;
			}
			///////////avrg
			//$arr = array();
			$search_details = array(
				"id" => $dataAll['id'],
				"product_name" => $dataAll['product_name'],
				"product_quantity" => $dataAll['product_quantity'],
				"product_price" => $dataAll['product_price'],
				"category_id" => $dataAll['category_id'],
				"sub_category_id" => $dataAll['sub_category_id'],
				"type" => $dataAll['type'],
				"product_type" => $dataAll['product_type'],
				"sort_description" => $dataAll['sort_description'],
				"orginal_price" => $dataAll['orginal_price'],
				"category_name" => $dataAll['category_name'],
				"link" => $dataAll['link'],
				"product_image" => $this->App_model->getProductImage($dataAll['id']),
				"product_rating" => $this->App_model->getRatingForOrder($dataAll['id']),
				"rat_avr" => $avr
			);

			array_push($arr, $search_details);
		} ////loop close


		echo json_encode($arr);
	}

	function inserUserReffral()
	{
		$data['user_id'] = empty($this->input->get_post('user_id')) ? '' : $this->input->get_post('user_id');

		$data['reffral_code'] = empty($this->input->get_post('reffral_code')) ? '' : $this->input->get_post('reffral_code');

		$this->App_model->inserUserReffral($data);
	}

	function updateProfile()
	{
		$config['upload_path'] = './profile';

		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';

		$config['width']    = '150';

		$config['height']   = '150';

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('image')) {
			$dataImage = $this->upload->data();

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();

			$this->image_lib->display_errors();
		} else {
			$this->upload->display_errors();
		}

		$data['image'] = empty($dataImage['file_name']) ? '' : $dataImage['file_name'];

		$id = empty($this->input->get_post('user_id')) ? '' : $this->input->get_post('user_id');

		$data['email'] = empty($this->input->get_post('email')) ? '' : $this->input->get_post('email');

		$data['name'] = empty($this->input->get_post('name')) ? '' : $this->input->get_post('name');

		$this->App_model->updateProfile($id, $data);
	}

	function getGcmApi($user_id, $order_status)
	{



		//echo $user_id;



		//echo $order_status;



		//$getOrdersByid = $this->Manage_product->getOrdersByid($order_id);

		$getTocken = $this->App_model->getTocken($user_id);



		//print_r($getTocken);

		$token = $getTocken[0]['tocken'];

		$message = str_replace(' ', "+", $order_status);

		$name = $getOrdersByid[0]['name'];



		//$shipName   =   $getOrdersByid[0]['shipName'];

		$data = file_get_contents(base_url() . "/call.php?token=" . $token . "&message=" . $message . "&order_id=" . $order_id);



		//print_r($data);

	}

	function getGcmApi1()
	{
		$token = "fKPUU6nBTumRvkqgb87mBQ:APA91bFL1JZltO5V0VOP2y_399AAn9219G5wVw0IKlV8BcPSvD1lgU-5flfFbprf1iytGhnUxC1CCsqUYKQBqVC9F_tRpd1R0AkY2R_irlVbhOB4h6SUP0oronJfsT2rRYjHBXXmuQjg";

		$message = str_replace(' ', "+", " Vinva yms gmil gya");

		$name = "name";

		$data = file_get_contents("https://vahanassist.com/vahaan-admin/call.php?token=" . $token . "&message=" . $message);

		print_r($data);
	}

	function insertTocken()
	{
		$data['tocken'] = empty($this->input->get_post('tocken')) ? '' : $this->input->get_post('tocken');

		$data['user_id'] = empty($this->input->get_post('user_id')) ? '' : $this->input->get_post('user_id');

		$id = empty($this->input->get_post('tocken_id')) ? '' : $this->input->get_post('tocken_id');

		//print_r($data);

		if ($id == "") {



			///echo "sdjhfsdh";

			$getTocken = $this->App_model->getTocken($data['user_id']);



			//print_r($getTocken);

			if (empty($getTocken)) {
				$this->App_model->insertTocken($data);
			} else {
				$this->App_model->updateTockenByUser($data['user_id'], $data);
			}
		} else {
			$this->App_model->updateTocken($data['user_id'], $data);
		}
	}

	function doLogin()
	{
		$data['email'] = empty($this->input->get_post('email')) ? '' : $this->input->get_post('email');

		$data['password'] = empty($this->input->get_post('password')) ? '' : $this->input->get_post('password');

		$doLogin = $this->App_model->doLogin($data);



		//print_r($doLogin);

		if (empty($doLogin)) {
			echo json_encode(array('msg' => 'Email Or password not match'));
		} else {
			echo json_encode(array('msg' => 'Login Successfully.', 'data' => $doLogin));
		}
	}

	function getTocken()
	{
		$id = empty($this->input->get_post('id')) ? '' : $this->input->get_post('id');

		$this->App_model->getTocken($id);
	}
	function cancelOrder()
	{
		$id = empty($this->input->get_post('order_id')) ? '' : $this->input->get_post('order_id');
		$data['order_status'] = "Cnacel By User";

		$this->App_model->cancelOrder($id, $data);
	}

	function insertRating()
	{
		$id = empty($this->input->get_post('id')) ? '' : $this->input->get_post('id');

		$data['msg'] = empty($this->input->get_post('msg')) ? '' : $this->input->get_post('msg');

		$data['rating'] = empty($this->input->get_post('rating')) ? '' : $this->input->get_post('rating');

		$data['user_id'] = empty($this->input->get_post('user_id')) ? '' : $this->input->get_post('user_id');

		$data['product_id'] = empty($this->input->get_post('product_id')) ? '' : $this->input->get_post('product_id');

		if ($id == "") {
			$this->App_model->insertRating($data);
		} else {
			$this->App_model->updateRating($id, $data);
		}
	}

	function insertSupport()
	{
		$id = empty($this->input->get_post('id')) ? '' : $this->input->get_post('id');

		$data['msg'] = empty($this->input->get_post('msg')) ? '' : $this->input->get_post('msg');

		$data['name'] = empty($this->input->get_post('name')) ? '' : $this->input->get_post('name');

		$data['email'] = empty($this->input->get_post('email')) ? '' : $this->input->get_post('email');

		$data['phone'] = empty($this->input->get_post('phone')) ? '' : $this->input->get_post('phone');

		if ($id == "") {
			$this->App_model->insertSupport($data);
		} else {
			$this->App_model->updateSupport($id, $data);
		}
	}

	public function getRating()
	{
		$id = empty($this->input->get_post('user_id')) ? '' : $this->input->get_post('user_id');

		$getRating = $this->App_model->getRating($id);
		//print_r($getCategory);
	}
	// public function getRatingCount()
	// 	{
	// 		//$id = empty($this->input->get_post('user_id')) ? '' : $this->input->get_post('user_id');

	// 		$getRatingCount = $this->App_model->getRatingCount('103');
	// 		$total = 0;
	// 		$i = 0;
	// 		foreach ($getRatingCount as $data) {
	// 			$rat = $data['rating'];
	// 			 $total = $total+$rat;
	// 			 $i++;
	// 		}
	// 		echo  $total/$i;
	// 		//echo $i;
	// 		//print_r($getCategory);
	// 	}

	public function getLocation()
	{
		$id = empty($this->input->get_post('user_id')) ? '' : $this->input->get_post('user_id');

		$getLocation = $this->App_model->getLocation($id);



		//print_r($getCategory);

	}

	public function getVenderByLat()
	{
		$lat  = empty($this->input->get_post('lat')) ? '' : $this->input->get_post('lat');

		$lng  = empty($this->input->get_post('lng')) ? '' : $this->input->get_post('lng');

		$getAllUsers = $this->App_model->getAllUsers('');



		//	print_r($getAllUsers);

		$arr = array();

		foreach ($getAllUsers as $dataAll) {



			//$data['lat'] = $dataAll['lat'];



			//$data['lng'] = $dataAll['lng'];

			$point1 = array("lat" => $lat, "long" => $lng);

			$point2 = array("lat" => $user_lat, "long" => $user_long);

			$distance = $this->distanceCalculation($point1['lat'], $point1['long'], $dataAll['lat'], $dataAll['lng']);

			if ($distance <= 20) {
				$search_details = array(
					"id" => $dataAll['id'],
					"name" => $dataAll['name'],
					"vender_name" => $dataAll['vender_name'],
					"email" => $dataAll['email'],
					"address" => $dataAll['address'],
					"city" => $dataAll['city'],
					"state" => $dataAll['state'],
					"location" => $dataAll['location'],
					"image" => $dataAll['image'],
					"user_lat" => $dataAll['lat'],
					"user_long" => $dataAll['lng'],
					"distance" => $distance
				);

				array_push($arr, $search_details);
			}
		}

		echo json_encode($arr);
	}

	function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2)
	{



		// Calculate the distance in degrees

		$degrees = rad2deg(
			acos(
				(sin(deg2rad($point1_lat)) * sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat)) * cos(deg2rad($point2_lat)) * cos(deg2rad($point1_long - $point2_long)))
			)
		);







		// Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)

		switch ($unit) {
			case 'km':
				$distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)

				break;

			case 'mi':
				$distance = $degrees * 69.05482; // 1 degree = 69.05482 miles, based on the average diameter of the Earth (7,913.1 miles)

				break;

			case 'nmi':
				$distance = $degrees * 59.97662; // 1 degree = 59.97662 nautic miles, based on the average diameter of the Earth (6,876.3 nautical miles)

		}

		return round($distance, $decimals);
	}

	public function sendEmails($log_data, $email)
	{
		$message = $this->load->view('email/gmail-template', $log_data, true);

		$this->load->library('email');

		$this->email->set_newline("\r\n");

		$this->email->from('noreply@Kedia.com'); // change it to yours

		$this->email->to($email); // change it to yours

		$this->email->subject('Thank you for register with Kedia.');

		$this->email->message($message);

		$this->email->set_mailtype("html");

		if ($this->email->send()) {



			// echo 'Email sent.';

		} else {



			//show_error($this->email->print_debugger());

		}
	}

	function getAbout()
	{
		$id = 0;



		//$data['mobile'] = empty($this->input->get_post('mobile')) ? '' :$this->input->get_post('mobile');

		$this->App_model->getEmailsDetails($id);
	}

	function getContact()
	{
		$id = 1;



		//$data['mobile'] = empty($this->input->get_post('mobile')) ? '' :$this->input->get_post('mobile');

		$this->App_model->getEmailsDetails($id);
	}



	// rent app 7-5-2019////////////

	function getTypeFeatures()
	{
		$category_id = empty($this->input->get_post('category_id')) ? '' : $this->input->get_post('category_id');

		$getFeature = $this->App_model->getFeature($category_id);

		$getType = $this->App_model->getType($category_id);

		echo json_encode(array('type' => $getType, 'feature' => $getFeature));
	}

	function getUserByPhone()
	{
		$phone = empty($this->input->get_post('phone')) ? '' : $this->input->get_post('phone');

		$getUserByPhone = $this->App_model->getUserByPhone($phone);

		if (!empty($getUserByPhone)) {
			echo json_encode(array('msg' => 'Exit', 'data' => $getUserByPhone));
		} else {
			echo json_encode(array('msg' => 'not Exit'));
		}
	}

	public function getPostByCat()
	{
		$lat  = empty($this->input->get_post('lat')) ? '' : $this->input->get_post('lat');

		$lng  = empty($this->input->get_post('lng')) ? '' : $this->input->get_post('lng');

		$user_id = empty($this->input->get_post('user_id')) ? '' : $this->input->get_post('user_id');

		$type  = empty($this->input->get_post('type')) ? '' : $this->input->get_post('type');

		$category_id = empty($this->input->get_post('category_id')) ? '' : $this->input->get_post('category_id');

		$getProduct =  $this->App_model->getProductByType($type, $category_id);



		//print_r($getProduct);

		$arr = array();

		foreach ($getProduct as $dataAll) {



			//$data['lat'] = $dataAll['lat'];



			//$data['lng'] = $dataAll['lng'];

			$point1 = array("lat" => $lat, "long" => $lng);

			$point2 = array("lat" => $user_lat, "long" => $user_long);

			$distance = $this->distanceCalculation($point1['lat'], $point1['long'], $dataAll['lat'], $dataAll['lng']);

			if ($dataAll['user_id'] != $user_id) {







				//if ($distance<=20) {

				$search_details = array(
					"id" => $dataAll['id'],
					"user_id" => $dataAll['user_id'],
					"product_name" => $dataAll['product_name'],
					"product_price" => $dataAll['product_price'],
					"category_id" => $dataAll['category_id'],
					"sub_category_id" => $dataAll['sub_category_id'],
					"type" => $dataAll['type'],
					"features" => $dataAll['features'],
					"flat_type" => $dataAll['flat_type'],
					"locality" => $dataAll['locality'],
					"city" => $dataAll['city'],
					"category_name" => $dataAll['category_name'],
					"product_image" => $this->App_model->getProductImage($dataAll['id']),
					"lat" => $dataAll['lat'],
					"long" => $dataAll['lng'],
					"distance" => $distance
				);

				array_push($arr, $search_details);

				//	  }//////////less then km

			} //////////// not show same user add 

		} ////loop close



		//print_r($arr);

		echo json_encode($arr);
	}


	function emailOtp()
	{
		$chars = "0123456789";

		$val = substr(str_shuffle($chars), 0, 3);

		$otp = date('dm') . $val;

		$data['email'] = empty($this->input->get_post('email')) ? '' : $this->input->get_post('email');

		///////////////////email//////////////////////////

		$message = "your OTP is " . $otp;

		//$message = $this->load->view('email/email-template',$dataShow,true);

		$this->load->library('email');

		$this->email->set_newline("\r\n");

		$this->email->set_header('MIME-Version', '1.0; charset=utf-8');

		$this->email->set_header('Content-type', 'text/html');

		$this->email->from('info@shivkrpadham.com'); // change it to yours

		$this->email->to('bishtj94@gmail.com'); // change it to yours

		$this->email->subject('OTP');

		$this->email->message($message);

		if ($this->email->send()) {
			echo '1002';

			//	$this->Manage_product->updateEmail($data['email'],$data);

		} else {
			show_error($this->email->print_debugger());
		}

		//////////////email///////////////

	}

	public function getPostFilter()
	{
		$lat  = empty($this->input->get_post('lat')) ? '' : $this->input->get_post('lat');

		$lng  = empty($this->input->get_post('lng')) ? '' : $this->input->get_post('lng');

		$user_id  = empty($this->input->get_post('user_id')) ? '' : $this->input->get_post('user_id');

		$cateory_id = empty($this->input->get_post('cateory_id')) ? '' : $this->input->get_post('cateory_id');

		$type = empty($this->input->get_post('type')) ? '' : $this->input->get_post('type');

		$min_price  = empty($this->input->get_post('min_price')) ? '' : $this->input->get_post('min_price');

		$max_price  = empty($this->input->get_post('max_price')) ? '' : $this->input->get_post('max_price');

		$priceLow = empty($this->input->get_post('priceLow')) ? '' : $this->input->get_post('priceLow');

		if ($min_price == "") {
			$getProduct =  $this->App_model->getPostFilter($cateory_id, $type, $priceLow);
		} else {
			$getProduct = $this->App_model->getPostFilterPrice($cateory_id, $type, $min_price, $max_price);
		}



		//print_r($getProduct);

		$arr = array();

		foreach ($getProduct as $dataAll) {

			//$data['lat'] = $dataAll['lat'];

			//$data['lng'] = $dataAll['lng'];

			$point1 = array("lat" => $lat, "long" => $lng);

			$point2 = array("lat" => $user_lat, "long" => $user_long);

			$distance = $this->distanceCalculation($point1['lat'], $point1['long'], $dataAll['lat'], $dataAll['lng']);

			if ($dataAll['user_id'] != $user_id) {



				//if ($distance<=20) {

				$search_details = array(
					"id" => $dataAll['id'],
					"user_id" => $dataAll['user_id'],
					"product_name" => $dataAll['product_name'],
					"product_price" => $dataAll['product_price'],
					"category_id" => $dataAll['category_id'],
					"sub_category_id" => $dataAll['sub_category_id'],
					"type" => $dataAll['type'],
					"features" => $dataAll['features'],
					"flat_type" => $dataAll['flat_type'],
					"locality" => $dataAll['locality'],
					"city" => $dataAll['city'],
					"category_name" => $dataAll['category_name'],
					"product_image" => $this->App_model->getProductImage($dataAll['id']),
					"lat" => $dataAll['lat'],
					"long" => $dataAll['lng'],
					"distance" => $distance
				);

				array_push($arr, $search_details);

				// }//////////less then km

			} //////////// not show same user add

		} ////loop close



		//print_r($arr);

		echo json_encode($arr);
	}
	public function orderCreateApp()
	{
		$order  = $client->order->create([
			'receipt'         => 'order_rcptid_11',
			'amount'          => 50000, // amount in the smallest currency unit
			'currency'        => 'INR', // <a href="https://razorpay.freshdesk.com/support/solutions/articles/11000065530-what-currencies-does-razorpay-support" target="_blank">See the list of supported currencies</a>.)
			'payment_capture' =>  '0'
		]);
	}
	public function getShop()
	{

		$getShop = $this->App_model->getShop($shop_status);
		//print_r($getShop);
		$arr = array();
		foreach ($getShop as $dataAll) {
			//$data['lat'] = $dataAll['lat'];
			//$data['lng'] = $dataAll['lng'];
			$point1 = array("lat" => $lat, "long" => $lng);
			$point2 = array("lat" => $user_lat, "long" => $user_long);
			$distance = $this->distanceCalculation($point1['lat'], $point1['long'], $dataAll['lat'], $dataAll['lng']);
			//	if ($dataAll['user_id'] != $user_id) {
			//if ($distance<=20) {
			$search_details = array(
				"id" => $dataAll['id'],
				"shop_name" => $dataAll['shop_name'],
				"email" => $dataAll['email'],
				"phone" => $dataAll['phone'],
				"logo" => $dataAll['logo'],
				"location" => $dataAll['location'],
				"state" => $dataAll['state'],
				"r_id" => $dataAll['r_id'],
				"city" => $dataAll['city'],
				"banner" => $this->App_model->getShopImage($dataAll['id']),
				"lat" => $dataAll['lat'],
				"long" => $dataAll['lng'],
				"distance" => $distance
			);
			array_push($arr, $search_details);
			//	  }//////////less then km
			//	} //////////// not show same user add 
		} ////loop close
		//print_r($arr);
		echo json_encode($arr);
	}
	function getOrderByBoyID()
	{
		$id = empty($this->input->get_post('boy_id')) ? '' : $this->input->get_post('boy_id');
		$order_status = empty($this->input->get_post('order_status')) ? '' : $this->input->get_post('order_status');

		$getOrder = $this->App_model->getOrderByBoyID($id, $order_status);
		//echo json_encode($getOrder);
	}


	// new code

	function adminLogin()
	{



		$log_data['email'] = empty($this->input->post('email')) ? '' : $this->input->post('email');

		$log_data['password'] = empty($this->input->post('password')) ? '' : $this->input->post('password');



		$result = $this->App_model->adminLogin($log_data);

		//print_r($result);

		if ($result != false) {

			$session_data['admin_login_id'] = $result[0]['id'];

			$session_data['email'] = $result[0]['email'];

			$session_data['status'] = $result[0]['status'];
			$this->session->set_userdata($session_data);
			// Add user data in session

			echo "1000";
		} else {

			echo "1001";
			//echo "heloo";
		}
	}

	public function verifyToken($token)
	{
		$checkToken = $this->App_model->getUserByTokenApp($token);

		if (count($checkToken) > 0) {
			$data = $this->encryption->decrypt($token);
			$getUser = $this->App_model->getUserByIdApp($data);
			if (count($getUser) > 0) {
				return 1;
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}

	public function registration()
	{

		$config['upload_path'] = './images/driver_docs';

		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';

		$config['width']    = '150';

		$config['height']   = '150';

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('frontLic')) {
			$frontlicense = $this->upload->data();

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();

			$this->image_lib->display_errors();
		} else {
			$this->upload->display_errors();
		}

		$config['upload_path'] = './images/driver_docs';

		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';

		$config['width']    = '150';

		$config['height']   = '150';

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('backLic')) {
			$backlicense = $this->upload->data();

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();

			$this->image_lib->display_errors();
		} else {
			$this->upload->display_errors();
		}

		$config['upload_path'] = './images/profile';

		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';

		$config['width']    = '150';

		$config['height']   = '150';

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('image')) {
			$profile = $this->upload->data();

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();

			$this->image_lib->display_errors();
		} else {
			$this->upload->display_errors();
		}

		$data['image'] = empty($dataImage['file_name']) ? '' : $dataImage['file_name'];


		$first_name = strip_tags($this->input->post('firstName'));
		$last_name = strip_tags($this->input->post('lastName'));
		$email = strip_tags(strtolower($this->input->post('email')));
		$type = strip_tags($this->input->post('type'));
		$password = $this->input->post('password');
		$phoneNumber = strip_tags($this->input->post('phoneNumber'));
		$city = strip_tags($this->input->post('city'));
		$state = strip_tags($this->input->post('state'));

		if ($type == 'USER') {
			$status = 1;
		} else if ($type == 'DEALER') {
			$status = 0;
		} else {
			$status = 1;
		}

		// Validate the post data
		if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($password) && !empty($phoneNumber)) {

			$userCount = $this->App_model->checkUserEmail($email);
			$userPhoneCount = $this->App_model->checkUserPhone($phoneNumber);

			if (count($userCount) > 0) {
				echo json_encode(array('status' => "error", 'message' => 'The given email already exists.'));
			} else if (count($userPhoneCount) > 0) {
				echo json_encode(array('status' => "error", 'message' => 'The given Phone Number already exists.'));
			} else {
				// Insert user data
				$userData = array(
					'firstName' => $first_name,
					'lastName' => $last_name,
					'email' => $email,
					'password' => md5($password),
					'phoneNumber' => $phoneNumber,
					'frontLic' => empty($frontlicense['file_name']) ? '' : $frontlicense['file_name'],
					'backLic' => empty($backlicense['file_name']) ? '' : $backlicense['file_name'],
					'image' => empty($profile['file_name']) ? '' : $profile['file_name'],
					'status' => $status,
					'type' => $type,
					'source' => 'APP',
					'city' => $city,
					'state' => $state,

				);
				$insert = $this->App_model->insertAppUser($userData);

				if ($insert) {
					$this->emailUserRegister($userData);
					echo json_encode(array('status' => "ok", 'message' => 'The user has been added successfully.'));
				} else {
					echo json_encode(array('status' => "error", 'message' => 'Some problems occurred, please try again.'));
				}
			}
		} else {
			echo json_encode(array('status' => "error", 'message' => 'Provide complete user info to add.'));
		}
	}

	public function login()
	{
		// Get the post data

		$phone = $this->input->post('phoneNumber');
		$password = $this->input->post('password');
		// $type = $this->input->post('type');

		// Validate the post data
		if (!empty($phone) && !empty($password)) {

			$con = array(
				'phoneNumber' => $phone,
				'password' => md5($password),
				// 'status' => 1,
				// 'type' => $type
			);
			$user = $this->App_model->getUserLogin($con);

			if (count($user) > 0) {
				// Set the response and exit

				if (!empty($user[0]['id'])) {

					date_default_timezone_set('Asia/Kolkata');
					$current_time = date('Y-m-d H:i:s');

					$token = $this->encryption->encrypt($user[0]['id']);

					$log['token'] = $token;
					$log['login_time'] = $current_time;

					$this->App_model->updateUser($user[0]['id'], $log);

					echo json_encode(array('status' => TRUE, 'message' => 'User login successful.', 'token' => $token));
				} else {
					echo json_encode(array('status' => FALSE, 'message' => 'User Not found'));
				}
			} else {
				echo json_encode(array('status' => FALSE, 'message' => 'Wrong PhoneNumber or password.'));
			}
		} else {
			echo json_encode(array('status' => FALSE, 'message' => 'Provide PhoneNumber and password.'));
		}
	}

	public function updateUserApp()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				// echo "authorised";
				$data['address'] = empty($this->input->post('address')) ? '' : $this->input->post('address');
				$data['email'] = empty($this->input->post('email')) ? '' : trim($this->input->post('email'));
				$data['state'] = empty($this->input->post('state')) ? '' : $this->input->post('state');
				$data['city'] = empty($this->input->post('city')) ? '' : $this->input->post('city');
				$data['yearinbzns'] = empty($this->input->post('yearinbusiness')) ? '' : $this->input->post('yearinbusiness');
				$data['partner'] = empty($this->input->post('partnername')) ? '' : $this->input->post('partnername');
				$data['partnerphone'] = empty($this->input->post('partnerphone')) ? '' : $this->input->post('partnerphone');
				$data['partneremail'] = empty($this->input->post('partneremail')) ? '' : $this->input->post('partneremail');
				$data['gst'] = empty($this->input->post('gst')) ? '' : $this->input->post('gst');
				$data['pan'] = empty($this->input->post('pan')) ? '' : $this->input->post('pan');

				$res = $this->Manage_product->updateUser($idUser, $data);

				if ($res == 1) {
					echo json_encode(array('status' => "ok", 'message' => 'Updated Sucess!!'));
				} else {
					echo json_encode(array('status' => "error", 'message' => 'Failed, Please try again or Contact Admin.'));
				}
			} else {
				echo json_encode(array('status' => 'error', 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Auth token is required'));
		}
	}

	public function updateLatLngApp()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {
				$data['lat'] = empty($this->input->post('lat')) ? '' : $this->input->post('lat');
				$data['lng'] = empty($this->input->post('lng')) ? '' : trim($this->input->post('lng'));

				$res = $this->Manage_product->updateUser($idUser, $data);

				if ($res == 1) {
					echo json_encode(array('status' => "ok", 'message' => 'Updated Sucess!!'));
				} else {
					echo json_encode(array('status' => "error", 'message' => 'Failed, Please try again or Contact Admin.'));
				}
			} else {
				echo json_encode(array('status' => 'error', 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Auth token is required'));
		}
	}

	public function deleteUserAccount()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				// echo "authorised";
				$data['deleteAccountReq'] = 1;

				$res = $this->Manage_product->updateUser($idUser, $data);

				if ($res == 1) {
					echo json_encode(array('status' => "ok", 'message' => 'Scheduled for deletion!!'));
				} else {
					echo json_encode(array('status' => "error", 'message' => 'Failed, Please try again or Contact Admin.'));
				}
			} else {
				echo json_encode(array('status' => 'error', 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Auth token is required'));
		}
	}

	function updateLogo()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {
				$config['upload_path'] = './images/profile';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
				$config['width']    = '150';
				$config['height']   = '150';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('logo')) {
					$gstdealer	= 	$this->upload->data();
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$data['logo'] = empty($gstdealer['file_name']) ? '' : $gstdealer['file_name'];

					$res = $this->Manage_product->updateUser($idUser, $data);

					if ($res == 1) {
						echo json_encode(array('status' => "ok", 'message' => 'Upload Sucess!!'));
					} else {
						echo json_encode(array('status' => "error", 'message' => 'Failed, Please try again or Contact Admin.'));
					}
				} else {
					echo json_encode(array('status' => 'error', 'message' => 'User is Unauthorized.'));
				}
			} else {
				echo json_encode(array('status' => 'error', 'message' => 'Auth token is required'));
			}
		}
	}

	function removeLogo()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {
			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {
				// Get current user data to find existing logo file name
				$userData = $this->Manage_product->getUserById($idUser); // Create this function if not already

				if (!empty($userData[0]['logo'])) {
					$logoPath = './images/profile/' . $userData[0]['logo'];

					// Delete file from server
					if (file_exists($logoPath)) {
						unlink($logoPath);
					}

					// Remove logo name from DB
					$data['logo'] = '';
					$res = $this->Manage_product->updateUser($idUser, $data);

					if ($res == 1) {
						echo json_encode(array('status' => "ok", 'message' => 'Logo removed successfully.'));
					} else {
						echo json_encode(array('status' => "error", 'message' => 'Failed to update database.'));
					}
				} else {
					echo json_encode(array('status' => "error", 'message' => 'No logo found.'));
				}
			} else {
				echo json_encode(array('status' => 'error', 'message' => 'Invalid token.'));
			}
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Authorization header missing.'));
		}
	}


	public function insertBookingApp()
	{

		// print_r($_REQUEST);
		// die();

		$id = $this->input->post('id');


		$email = empty($this->input->post('email')) ? '' : $this->input->post('email');

		$getUser = $this->App_model->getUserByEmailApp($email);

		if (!empty($email)) {
			if (count($getUser) > 0) {
				$data['userId'] = $getUser[0]['id'];
			} else {
				$pass = $this->random_strings(6);
				$log['email'] = empty($this->input->post('email')) ? '' : $this->input->post('email');
				$log['phoneNumber'] = empty($this->input->post('phoneNumber')) ? '' : $this->input->post('phoneNumber');
				$log['firstName'] = empty($this->input->post('name')) ? '' : $this->input->post('name');
				$log['password'] = md5($pass);
				$log['type'] = "USER";
				$log['status'] = 1;
				$log['source'] = "APP";

				$resUser = $this->App_model->insertUser($log);

				$usertoken = $this->encryption->encrypt($resUser['last_id']);
				if ($resUser['msg'] == 1) {

					// $this->emailUserDetails($log);
					$data['userId'] = $resUser['last_id'];

					$logOf['token'] = $usertoken;

					$this->App_model->updateUser($resUser['last_id'], $logOf);
				}
			}
		}

		$config['upload_path'] = './images/vehicle_image/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ($this->upload->do_upload('rcFront')) {
			//echo "jj";
			$imageRc = 	$this->upload->data();
			$config['image_library'] = 'gd2';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			//echo $this->image_lib->display_errors();
		} else {
			$this->upload->display_errors();
		}

		$data['rcFrontUpload'] = empty($imageRc['file_name']) ? '' : $imageRc['file_name'];

		$config['upload_path'] = './images/vehicle_image/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ($this->upload->do_upload('rcBack')) {
			//echo "jj";
			$imageRcb = 	$this->upload->data();
			$config['image_library'] = 'gd2';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			//echo $this->image_lib->display_errors();
		} else {
			$this->upload->display_errors();
		}

		$data['rcBackUpload'] = empty($imageRcb['file_name']) ? '' : $imageRcb['file_name'];
		// if ($data['image'] == "") {
		// 	$data['image'] = empty($this->input->post('image_old')) ? '' : $this->input->post('image_old');
		// }

		$data['bookFrom'] = empty($this->input->post('bookFrom')) ? '' : $this->input->post('bookFrom');
		$data['bookTo'] = empty($this->input->post('bookTo')) ? '' : $this->input->post('bookTo');
		$data['insuranceType'] = empty($this->input->post('insuranceType')) ? '' : $this->input->post('insuranceType');
		$data['regNo'] = empty($this->input->post('regNo')) ? '' : $this->input->post('regNo');
		$data['mfgYear'] = empty($this->input->post('mfgYear')) ? '' : $this->input->post('mfgYear');
		$data['chasis'] = empty($this->input->post('chasis')) ? '' : $this->input->post('chasis');
		$data['engNo'] = empty($this->input->post('engNo')) ? '' : $this->input->post('engNo');
		$data['picklng'] = empty($this->input->post('pickLng')) ? '' : $this->input->post('pickLng');
		$data['droplng'] = empty($this->input->post('dropLng')) ? '' : $this->input->post('dropLng');
		$data['picklat'] = empty($this->input->post('pickLat')) ? '' : $this->input->post('pickLat');
		$data['droplat'] = empty($this->input->post('dropLat')) ? '' : $this->input->post('dropLat');
		$data['type'] = empty($this->input->post('type')) ? '' : $this->input->post('type');
		// $data['withFuel'] = empty($this->input->post('withFuel')) ? '' : $this->input->post('withFuel');
		$data['includeTollAndFuel'] = empty($this->input->post('includeTollAndFuel')) ? '' : $this->input->post('includeTollAndFuel');
		$data['comments'] = empty($this->input->post('comments')) ? '' : $this->input->post('comments');
		$data['name'] = empty($this->input->post('name')) ? '' : $this->input->post('name');
		$data['email'] = empty($this->input->post('email')) ? '' : $this->input->post('email');
		$data['phoneNumber'] = empty($this->input->post('phoneNumber')) ? '' : $this->input->post('phoneNumber');
		$data['service_type'] = empty($this->input->post('service_type')) ? '' : $this->input->post('service_type');
		$data['category'] = empty($this->input->post('category')) ? '' : $this->input->post('category');
		$data['brand'] = empty($this->input->post('brand')) ? '' : $this->input->post('brand');
		$data['model'] = empty($this->input->post('model')) ? '' : $this->input->post('model');
		$data['date'] = empty($this->input->post('date')) ? '' : $this->input->post('date');
		$data['time'] = empty($this->input->post('time')) ? '' : $this->input->post('time');
		$data['status'] = empty($this->input->post('status')) ? '' : $this->input->post('status');
		$data['bookingType'] = empty($this->input->post('bookingType')) ? '' : $this->input->post('bookingType');
		$data['pickupLocation'] = empty($this->input->post('pickupLocation')) ? '' : $this->input->post('pickupLocation');
		$data['dropLocation'] = empty($this->input->post('dropLocation')) ? '' : $this->input->post('dropLocation');
		$data['startOdometerReading'] = empty($this->input->post('startOdometerReading')) ? '' : $this->input->post('startOdometerReading');
		$data['endOdometerReading'] = empty($this->input->post('endOdometerReading')) ? '' : $this->input->post('endOdometerReading');
		$data['source'] = "APP";

		$getData = $this->getDistanceByLatLng($data['picklat'], $data['picklng'], $data['droplat'], $data['droplng']);

		$data['kmDiff'] = !empty($getData['km']) ? $getData['km'] : '';
		// $data['pickupLocation'] = !empty($getData['originAddress']) ? $getData['originAddress'] : '';
		// $data['dropLocation'] = !empty($getData['destinationAddress']) ? $getData['destinationAddress'] : '';

		// if(!empty($getData['km']) && !empty($data['model'])){
		// 	$rate = $this->rateCalculation($data['kmDiff'],$data['model']);
		// }

		if (empty($id)) {
			$res = $this->Manage_product->insertBooking($data);

			if ($res['msg'] == 1) {
				$getUser = $this->App_model->getUserDetails($resUser['last_id']);
				echo json_encode(array('status' => "ok", 'message' => 'Booked.', 'token' => $usertoken, 'type' => $getUser[0]['type'], 'booking_id' => $res['last_id'], 'calculation' => $rate));
			} else {
				echo json_encode(array('status' => "error", 'message' => 'Failed, Please try again or Contact Admin.'));
			}
		} else {
			$res = $this->Manage_product->updateBooking($id, $data);

			if ($res == 1) {
				echo json_encode(array('status' => "ok", 'message' => 'Booking Updated'));
			} else {
				echo json_encode(array('status' => "error", 'message' => 'Failed, Please try again or Contact Admin.'));
			}
		}
	}

	// public function rateCalculation() {


	// 	$authStr = $this->input->request_headers();
	// 	$splitStr = explode(" ", $authStr['Authorization']);

	// 	if (!empty($splitStr)) {

	// 		$verify = $this->verifyToken($splitStr[1]);
	// 		$idUser = $this->encryption->decrypt($splitStr[1]);

	// 		if ($verify) {

	// 					// Fetch user input
	// 	$km = $this->input->post('km');
	// 	// $model = $this->input->post('model');

	// 	// // Get car model details
	// 	// $carModel = $this->Manage_product->getCarModelById($model);
	// 	// $bodyType = $carModel[0]['body_type'];
	// 	$bodyType = $this->input->post('model');

	// 	// Define rates based on body type and distance ranges
	// 	$rates = [
	// 		'HatchBack' => [
	// 			'base_rate' => 1800,
	// 			'rate_100_200' => 21,
	// 			'rate_200_300' => 6,
	// 		],
	// 		'HatchBackAutoMatic' => [
	// 			'base_rate' => 1800,
	// 			'rate_100_200' => 22,
	// 			'rate_200_300' => 7,
	// 		],
	// 		'Sedan' => [
	// 			'base_rate' => 1800,
	// 			'rate_100_200' => 24,
	// 			'rate_200_300' => 8,
	// 		],
	// 		'SedanAutomatic' => [
	// 			'base_rate' => 1800,
	// 			'rate_100_200' => 25,
	// 			'rate_200_300' => 9,
	// 		],
	// 		'SUV' => [
	// 			'base_rate' => 1800,
	// 			'rate_100_200' => 29,
	// 			'rate_200_300' => 11,
	// 		],
	// 		'SUVAutomatic' => [
	// 			'base_rate' => 1950,
	// 			'rate_100_200' => 30,
	// 			'rate_200_300' => 12,
	// 		],
	// 		'LuxuryManual' => [
	// 			'base_rate' => 2100,
	// 			'rate_100_200' => 39,
	// 			'rate_200_300' => 20,
	// 		],
	// 		'LuxuryAutomatic' => [
	// 			'base_rate' => 2100,
	// 			'rate_100_200' => 41,
	// 			'rate_200_300' => 22,
	// 		],
	// 	];

	// 	// Base charge for >200 KM
	// 	$base_200_300 = 3500;

	// 	// Validate body type
	// 	if (!isset($rates[$bodyType])) {
	// 		// return "Invalid car Model!";
	// 	echo json_encode(array('status' => "Error",'msg'=>'Invalid car Model!'));

	// 	}

	// 	// Retrieve rates for the body type
	// 	$rate = $rates[$bodyType];

	// 	// Calculate the rate based on the distance
	// 	if ($km <= 100) {
	// 		// return $rate['base_rate'];
	// 	echo json_encode(array('status' => "ok",'total'=>$rate['base_rate']));

	// 	} elseif ($km > 100 && $km <= 200) {
	// 		$fair =  $rate['base_rate'] + ($km * $rate['rate_100_200']);
	// 	echo json_encode(array('status' => "ok",'total'=>$fair));

	// 	} elseif ($km > 200 && $km <= 300) {
	// 		$fair = $base_200_300 + ($km * $rate['rate_200_300']);
	// 	 echo json_encode(array('status' => "ok",'total'=>$fair));
	// 	}

	// 	return 0;
	// 	// echo json_encode(array('status' => "ok",'rate'=>$fair));


	// 		} else {
	// 			echo json_encode(array('status' => 'error', 'message' => 'Auth token is required'));
	// 		}
	// 	}
	// }

	public function rateCalculation()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				// Fetch input data from POST request
				$km = $this->input->post('km');
				$model = urldecode($this->input->post('model'));
				$includeTollAndFuel = $this->input->post('includeTollAndFuel'); // true or false
				$bookingType = $this->input->post('bookingType'); // 'intercity', 'local', 'one_way', 'hourly', 'daily'
				$hours = $this->input->post('hours'); // For hourly bookings (if applicable)
				$tollPrice = 0; // Toll price (default 0)
				$fuelPrice = 0; // Fuel price (default 0)

				// Get car model details
				$carModel = urldecode($this->input->post('model'));
				if (empty($carModel)) {
					echo json_encode([
						'error' => true,
						'message' => 'Invalid model ID!'
					]);
					return;
				}

				$bodyType = $carModel;

				// Define rates
				$rates = [
					'HatchBack' => [
						'base_rate_intercity' => 1800,
						'rate_100_200' => 21,
						'rate_200_300' => 6,
						'rate_above_300' => 11.5,
						'rate_one_way_above_300' => 12.5,
						'local_base_rate' => 300,
						'local_rate_16_50' => 9,
						'local_rate_51_100' => 11,
						'hourly_first_hour' => 149,
						'hourly_additional_hour' => 129,
					],
					'HatchBack Automatic' => [
						'base_rate_intercity' => 1800,
						'rate_100_200' => 22,
						'rate_200_300' => 7,
						'rate_above_300' => 12,
						'rate_one_way_above_300' => 13,
						'local_base_rate' => 300,
						'local_rate_16_50' => 9,
						'local_rate_51_100' => 11,
						'hourly_first_hour' => 149,
						'hourly_additional_hour' => 129,
					],
					'Sedan' => [
						'base_rate_intercity' => 1800,
						'rate_100_200' => 24,
						'rate_200_300' => 8,
						'rate_above_300' => 12.5,
						'rate_one_way_above_300' => 13.5,
						'local_base_rate' => 300,
						'local_rate_16_50' => 9,
						'local_rate_51_100' => 11,
						'hourly_first_hour' => 149,
						'hourly_additional_hour' => 129,
					],
					'Sedan Automatic' => [
						'base_rate_intercity' => 1800,
						'rate_100_200' => 25,
						'rate_200_300' => 9,
						'rate_above_300' => 13,
						'rate_one_way_above_300' => 14,
						'local_base_rate' => 300,
						'local_rate_16_50' => 9,
						'local_rate_51_100' => 11,
						'hourly_first_hour' => 149,
						'hourly_additional_hour' => 129,
					],
					'SUV' => [
						'base_rate_intercity' => 1800,
						'rate_100_200' => 29,
						'rate_200_300' => 11,
						'rate_above_300' => 13.5,
						'rate_one_way_above_300' => 14.5,
						'local_base_rate' => 300,
						'local_rate_16_50' => 9,
						'local_rate_51_100' => 11,
						'hourly_first_hour' => 149,
						'hourly_additional_hour' => 129,
					],
					'SUV Automatic' => [
						'base_rate_intercity' => 1950,
						'rate_100_200' => 30,
						'rate_200_300' => 12,
						'rate_above_300' => 14,
						'rate_one_way_above_300' => 15,
						'local_base_rate' => 350,
						'local_rate_16_50' => 10,
						'local_rate_51_100' => 12,
						'hourly_first_hour' => 149,
						'hourly_additional_hour' => 129,
					],
					'Luxury Manual' => [
						'base_rate_intercity' => 2100,
						'rate_100_200' => 39,
						'rate_200_300' => 20,
						'rate_above_300' => 15,
						'rate_one_way_above_300' => 16,
						'local_base_rate' => 350,
						'local_rate_16_50' => 10,
						'local_rate_51_100' => 12,
						'hourly_first_hour' => 149,
						'hourly_additional_hour' => 129,
					],
					'Luxury Automatic' => [
						'base_rate_intercity' => 2100,
						'rate_100_200' => 41,
						'rate_200_300' => 22,
						'rate_above_300' => 16,
						'rate_one_way_above_300' => 17,
						'local_base_rate' => 350,
						'local_rate_16_50' => 10,
						'local_rate_51_100' => 12,
						'hourly_first_hour' => 149,
						'hourly_additional_hour' => 129,
					],
				];

				// Validate body type
				if (!isset($rates[$bodyType])) {
					echo json_encode([
						'error' => true,
						'message' => 'Invalid car body type!'
					]);
					return;
				}

				// Retrieve rates for the body type
				$rate = $rates[$bodyType];
				$totalFareWithoutGST = 0;
				$tollPrice = 0;
				$fuelPrice = 0;

				if (!$includeTollAndFuel) {
					$bookingType = 'local';
				}

				// Calculate fare based on booking type
				switch ($bookingType) {
					case 'intercity':
						if ($km <= 100) {
							$totalFareWithoutGST = $rate['base_rate_intercity'];
						} elseif ($km > 100 && $km <= 200) {
							$totalFareWithoutGST = $rate['base_rate_intercity'] + ($km * $rate['rate_100_200']);
						} elseif ($km > 200 && $km <= 300) {
							$totalFareWithoutGST = 3500 + ($km * $rate['rate_200_300']);
						} else {
							$totalFareWithoutGST = $km * $rate['rate_above_300'];
						}
						break;

					case 'one_way':
						if ($km > 300) {
							$totalFareWithoutGST = $km * $rate['rate_one_way_above_300'];
						}
						break;

					case 'local':
						if ($km <= 15) {
							$totalFareWithoutGST = $rate['local_base_rate'];
						} elseif ($km > 15 && $km <= 50) {
							$totalFareWithoutGST = ($rate['local_rate_16_50'] * ($km - 15)) + $rate['local_base_rate'];
						} elseif ($km > 50 && $km <= 100) {
							$totalFareWithoutGST = ($rate['local_rate_51_100'] * ($km - 40)) + 500;
						}
						break;

					case 'hourly':
						if ($hours == 1) {
							$totalFareWithoutGST = $rate['hourly_first_hour'];
						} else {
							$totalFareWithoutGST = $rate['hourly_first_hour'] + ($rate['hourly_additional_hour'] * ($hours - 1));
						}
						break;

					default:
						echo json_encode([
							'error' => true,
							'message' => 'Invalid booking type!'
						]);
						return;
				}

				// Add toll and fuel prices (only for intercity or one_way bookings)
				if ($includeTollAndFuel && in_array($bookingType, ['intercity', 'one_way'])) {
					$tollPrice = $km * 0.5; // Example: ₹0.5 per km for toll
					$fuelPrice = $km * 3.5; // Example: ₹3.5 per km for fuel
					$totalFareWithoutGST += $tollPrice + $fuelPrice;
				}

				// Calculate GST (18%)
				$gst = round($totalFareWithoutGST * 0.18, 2);
				$totalFareWithGST = round($totalFareWithoutGST + $gst, 2);

				// Send response to the frontend
				echo json_encode([
					'error' => false,
					'totalFareWithoutGST' => round($totalFareWithoutGST, 2),
					'totalFareWithGST' => $totalFareWithGST,
					'tollPrice' => round($tollPrice, 2),
					'fuelPrice' => round($fuelPrice, 2),
					'gst' => $gst,
					'bookingType' => $bookingType,
				]);
			} else {
				echo json_encode(array('status' => "error", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "error", 'message' => 'Auth token is required'));
		}
	}


	// Ride cancellation charges
	public function calculateCancellationCharges($km)
	{
		if ($km <= 200) {
			return 500; // Cancellation charge for <= 200 km
		} elseif ($km <= 300) {
			return 700; // Cancellation charge for <= 300 km
		}
		return 0; // No charge for > 300 km
	}

	public function addCarDetails()
	{

		// print_r($_REQUEST);
		// die();
		$bookingId = empty($this->input->post('bookingId')) ? '' : $this->input->post('bookingId');
		$carsArr = json_decode($this->input->post('carsDetails'), true);

		if (count($carsArr) > 0) {
			foreach ($carsArr as $cr) {
				$log['bookingId'] = $bookingId;
				$log['model'] = $cr['model'] ? $cr['model'] : '';
				$log['category'] = $cr['category'] ? $cr['category'] : '';
				$log['brand'] = $cr['brand'] ? $cr['brand']  : '';
				$log['inspectionType'] = $cr['inspectionType'] ? $cr['inspectionType'] : '';
				$log['carQuality'] = $cr['carQuality'] ? $cr['carQuality'] : '';
				$log['carCondition'] = $cr['carCondition'] ? $cr['carCondition'] : '';
				$log['doc'] = $cr['doc'] ? $cr['doc'] : '';

				$this->Manage_product->insertCarDetails($log);
			}
		}

		echo json_encode(array('status' => "Inserted"));
	}


	public function getDistanceByLatLng($pickLat, $pickLng, $dropLat, $dropLng)
	{
		$url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$pickLat,$pickLng&destinations=$dropLat,$dropLng&key=AIzaSyB39Z-mhm2udO-plmGRgG4QOyX3UjqOqqo";

		$crl = curl_init();
		curl_setopt($crl, CURLOPT_URL, $url);
		curl_setopt($crl, CURLOPT_FRESH_CONNECT, true);
		curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($crl);
		if (!$response) {
			die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
		}

		$rd = json_decode($response, true);

		// echo json_encode(array('status' =>"ok",'km'=>($rd['rows'][0]['elements'][0]['distance']['value']/1000),'originAddress'=>$rd['origin_addresses'][0],'destinationAddress'=>$rd['destination_addresses'][0]));

		return array('km' => ($rd['rows'][0]['elements'][0]['distance']['value'] / 1000), 'originAddress' => $rd['origin_addresses'][0], 'destinationAddress' => $rd['destination_addresses'][0]);



		curl_close($crl);
	}

	public function getBookingByUserId()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);

			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {
				// $user = $this->input->post('user');
				$start = $this->input->post('start');
				$limit = $this->input->post('limit');
				$totalBooking = $this->App_model->getAllUserBookings($idUser);
				$res = $this->App_model->getUserBookingsWithLimit($idUser, $limit, $start);

				$user = $this->App_model->getUserDetails($idUser);
				if ($res) {
					echo json_encode(array('status' => "ok", "data" => $res, "total" => $totalBooking, "user" => $user[0]));
				} else {
					echo json_encode(array('status' => "ok", "data" => []));
				}
			} else {
				echo json_encode(array('status' => "error", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "error", 'message' => 'Auth token is required'));
		}
	}


	public function getCategoryApp()
	{

		try {

			$category = $this->App_model->getCategoryV2();

			$log = array();

			foreach ($category as $cat) {
				$data['id'] = $cat['id'];
				$data['name'] = $cat['name'];
				array_push($log, $data);
			}

			echo json_encode(array('status' => "ok", "data" => $log));
		} catch (Exception $e) {
			echo json_encode(array('status' => "error", "error" => $e));
		}
	}

	public function getVehicleApp()
	{

		try {

			$vehicle = $this->App_model->getVehicleV2();

			foreach ($vehicle as $r) {
				$getVehicleImagesById = $this->App_model->getVehicleImagesById($r['id']);

				$r['moreImages'] = $getVehicleImagesById;
			}

			echo json_encode(array('status' => "ok", "data" => $vehicle));
		} catch (Exception $e) {
			echo json_encode(array('status' => "error", "error" => $e));
		}
	}

	public function getBannerApp()
	{

		try {

			$banner = $this->App_model->getBannerV2();

			echo json_encode(array('status' => "ok", "data" => $banner));
		} catch (Exception $e) {
			echo json_encode(array('status' => "error", "error" => $e));
		}
	}

	public function getCarBrandApp()
	{
		$id = $this->input->post('category_id');
		try {

			$carBrand = $this->Manage_product->getCarBrandByCatId($id);

			echo json_encode(array('status' => "ok", "data" => $carBrand));
		} catch (Exception $e) {
			echo json_encode(array('status' => "error", "error" => $e));
		}
	}

	public function getCarModelApp()
	{

		$brandId = empty($this->input->post('brand_id')) ? '' : $this->input->post('brand_id');


		try {

			$getCarModel = $this->App_model->getCarModelByBrandId($brandId);

			echo json_encode(array('status' => "ok", "data" => $getCarModel));
		} catch (Exception $e) {
			echo json_encode(array('status' => "error", "error" => $e));
		}
	}


	public function submitEnquiry()
	{

		$data['name'] = empty($this->input->post('name')) ? '' : $this->input->post('name');
		$data['phoneNumber'] = empty($this->input->post('number')) ? '' : $this->input->post('number');
		$data['email'] = empty($this->input->post('email')) ? '' : $this->input->post('email');
		$data['message'] = empty($this->input->post('msg')) ? '' : $this->input->post('msg');
		$data['type'] = "APP";

		$res = $this->App_model->insertEnquiry($data);

		if ($res == 1) {
			echo json_encode(array('status' => "ok", 'message' => 'Inserted, you will be contact shortly.'));
		} else {
			echo json_encode(array('status' => "error", 'message' => 'Failed, Please try again or Contact Admin.'));
		}
	}

	public function checkoutBooking()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idDriver = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$data['bookingId'] = empty($this->input->post('bookingId')) ? '' : $this->input->post('bookingId');
				$data['orderId'] = empty($this->input->post('orderId')) ? '' : $this->input->post('orderId');
				$data['partialPaymentId'] = empty($this->input->post('partialPaymentId')) ? '' : $this->input->post('partialPaymentId');
				$data['partialPaymentDate'] = empty($this->input->post('partialPaymentDate')) ? '' : $this->input->post('partialPaymentDate');
				$data['partialAmount'] = empty($this->input->post('partialAmount')) ? '' : $this->input->post('partialAmount');
				$data['paymentId'] = empty($this->input->post('paymentId')) ? '' : $this->input->post('paymentId');
				$data['totalAmountDate'] = empty($this->input->post('totalAmountDate')) ? '' : $this->input->post('totalAmountDate');
				$data['totalAmount'] = empty($this->input->post('totalAmount')) ? '' : $this->input->post('totalAmount');
				$data['paidAmount'] = empty($this->input->post('paidAmount')) ? '' : $this->input->post('paidAmount');
				$data['tollPrice'] = empty($this->input->post('tollPrice')) ? '' : $this->input->post('tollPrice');
				$data['fuelPrice'] = empty($this->input->post('fuelPrice')) ? '' : $this->input->post('fuelPrice');
				$data['gst'] = empty($this->input->post('gst')) ? '' : $this->input->post('gst');
				$data['status'] = empty($this->input->post('status')) ? '' : $this->input->post('status');
				$data['type'] = "APP";

				$res = $this->App_model->insertCheckoutBooking($data);

				if ($res == 1) {
					echo json_encode(array('status' => "ok", 'message' => 'Inserted,'));
				} else {
					echo json_encode(array('status' => "error", 'message' => 'Failed, Please try again or Contact Admin.'));
				}
			} else {
				echo json_encode(array('status' => FALSE, 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => FALSE, 'message' => 'Auth token is required'));
		}
	}

	public function submitBookingBreakDown()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idDriver = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$config['upload_path'] = './images/vehicle_image/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('image')) {
					//echo "jj";
					$image	= 	$this->upload->data();
					$config['image_library'] = 'gd2';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					//echo $this->image_lib->display_errors();
				} else {
					$this->upload->display_errors();
				}

				$data['image'] = empty($image['file_name']) ? '' : $image['file_name'];
				if ($data['image'] == "") {
					$data['image'] = empty($this->input->post('image_old')) ? '' : $this->input->post('image_old');
				}
				$data['bookingId'] = empty($this->input->post('bookingId')) ? '' : $this->input->post('bookingId');
				$data['reason'] = empty($this->input->post('reason')) ? '' : $this->input->post('reason');

				$res = $this->Manage_product->insertBookingBreakDown($data);

				if ($res == 1) {
					echo json_encode(array('status' => "ok", 'message' => 'Inserted'));
				} else {
					echo json_encode(array('status' => "error", 'message' => 'Failed, Please try again or Contact Admin.'));
				}
			} else {
				echo json_encode(array('status' => FALSE, 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => FALSE, 'message' => 'Auth token is required'));
		}
	}


	public function getBookingByDriverId()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idDriver = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {
				$start = $this->input->post('start');
				$limit = $this->input->post('limit');
				$totalBooking = $this->App_model->getAllDriverBookings($idDriver);
				$res = $this->App_model->getDriverBookingsWithLimitApp($idDriver, $limit, $start);

				// print_r($totalBooking);
				if ($res) {
					echo json_encode(array('status' => TRUE, "data" => $res, "total" => $totalBooking[0]['totalBookings']));
				} else {
					echo json_encode(array('status' => TRUE, "data" => []));
				}
			} else {
				echo json_encode(array('status' => FALSE, 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => FALSE, 'message' => 'Auth token is required'));
		}
	}

	public function getLocationByUserId()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			// $idDriver = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$idDriver = $this->input->post('userId');
				$getUser = $this->App_model->getUserDetails($idDriver);

				echo json_encode(array('status' => TRUE, 'location' => array('lat' => $getUser[0]['lat'], 'lng' => $getUser[0]['lng'])));
			} else {
				echo json_encode(array('status' => FALSE, 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => FALSE, 'message' => 'Auth token is required'));
		}
	}

	public function getBookingByBookingId()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idDriver = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {
				$id = empty($this->input->post('bookingId')) ? '' : $this->input->post('bookingId');

				$res = $this->App_model->getBookingByBookingId($id);
				if ($res) {
					echo json_encode(array('status' => TRUE, "data" => $res));
				} else {
					echo json_encode(array('status' => TRUE, "data" => []));
				}
			} else {
				echo json_encode(array('status' => FALSE, 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => FALSE, 'message' => 'Auth token is required'));
		}
	}



	function random_strings($length_of_string)
	{
		$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		return substr(
			str_shuffle($str_result),
			0,
			$length_of_string
		);
	}


	function emailUserDetails($data)
	{

		$message = "your Password is " . $data['password'];

		// $message = $this->load->view('email/email-template',$dataShow,true);

		$this->load->library('email');

		$this->email->set_newline("\r\n");

		$this->email->set_header('MIME-Version', '1.0; charset=utf-8');

		$this->email->set_header('Content-type', 'text/html');

		$this->email->from('info@digibytech.com'); // change it to yours

		$this->email->to($data['email']); // change it to yours

		$this->email->subject('Registration');

		$this->email->message($message);

		if ($this->email->send()) {
			// echo '1002';

		} else {
			show_error($this->email->print_debugger());
		}
	}

	function emailUserRegister($data)
	{

		$message = "Thanks for registering " . $data['firstName'];

		// $message = $this->load->view('email/email-template',$dataShow,true);

		$this->load->library('email');

		$this->email->set_newline("\r\n");

		$this->email->set_header('MIME-Version', '1.0; charset=utf-8');

		$this->email->set_header('Content-type', 'text/html');

		$this->email->from('info@digibytech.com'); // change it to yours

		$this->email->to($data['email']); // change it to yours

		$this->email->subject('Registration');

		$this->email->message($message);

		if ($this->email->send()) {
			// echo '1002';

		} else {
			show_error($this->email->print_debugger());
		}
	}

	function emailOtpDetails($data)
	{

		$message = "your Otp is " . $data['otp'];

		// $message = $this->load->view('email/email-template',$dataShow,true);

		$this->load->library('email');

		$this->email->set_newline("\r\n");

		$this->email->set_header('MIME-Version', '1.0; charset=utf-8');

		$this->email->set_header('Content-type', 'text/html');

		$this->email->from('info@digibytech.com'); // change it to yours

		$this->email->to($data['email']); // change it to yours

		$this->email->subject('Booking Otp');

		$this->email->message($message);

		if ($this->email->send()) {
			// echo '1002';

		} else {
			show_error($this->email->print_debugger());
		}
	}



	public function updateBookingV2()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idDriver = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$id = empty($this->input->post('bookingId')) ? '' : $this->input->post('bookingId');

				$data['pickupLocation'] = empty($this->input->post('pickupLocation')) ? '' : $this->input->post('pickupLocation');
				$data['dropLocation'] = empty($this->input->post('dropLocation')) ? '' : $this->input->post('dropLocation');
				$data['picklng'] = empty($this->input->post('pickLng')) ? '' : $this->input->post('pickLng');
				$data['droplng'] = empty($this->input->post('dropLng')) ? '' : $this->input->post('dropLng');
				$data['picklat'] = empty($this->input->post('pickLat')) ? '' : $this->input->post('pickLat');
				$data['droplat'] = empty($this->input->post('dropLat')) ? '' : $this->input->post('dropLat');

				$res = $this->Manage_product->updateBooking($id, $data);

				if ($res == 1) {
					echo json_encode(array('status' => TRUE, 'message' => 'Updated'));
				} else {
					echo json_encode(array('status' => FALSE, 'message' => 'Something went wrong'));
				}
			} else {
				echo json_encode(array('status' => FALSE, 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => FALSE, 'message' => 'Auth token is required'));
		}
	}

	public function updateBookingStatus()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idDriver = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$id = empty($this->input->post('bookingId')) ? '' : $this->input->post('bookingId');

				$log['status'] = empty($this->input->post('status')) ? '' : $this->input->post('status');

				$res = $this->Manage_product->updateBooking($id, $log);

				if ($res == 1) {
					echo json_encode(array('status' => TRUE, 'message' => 'Updated'));
				} else {
					echo json_encode(array('status' => FALSE, 'message' => 'Something went wrong'));
				}
			} else {
				echo json_encode(array('status' => FALSE, 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => FALSE, 'message' => 'Auth token is required'));
		}
	}

	public function getOTP()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);

			if ($verify) {

				$bookingId = empty($this->input->post('bookingId')) ? '' : $this->input->post('bookingId');
				$userId = empty($this->input->post('userId')) ? '' : $this->input->post('userId');

				$getUser = $this->App_model->getUserDetails($userId);

				$rndm = mt_rand(1000, 9999);

				$log['otp'] = $rndm;

				$res = $this->Manage_product->updateBooking($bookingId, $log);

				if ($res == 1) {

					$log['email'] = $getUser[0]['email'];

					$this->emailOtpDetails($log);

					echo json_encode(array('status' => TRUE, 'message' => 'Otp Sent..'));
				} else {
					echo json_encode(array('status' => FALSE, 'message' => 'Something went wrong'));
				}
			} else {
				echo json_encode(array('status' => FALSE, 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => FALSE, 'message' => 'Auth token is required'));
		}
	}


	public function checkOTP()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);

			if ($verify) {


				$bookingId = empty($this->input->post('bookingId')) ? '' : $this->input->post('bookingId');
				$otp = empty($this->input->post('otp')) ? '' : $this->input->post('otp');

				$getBooking = $this->App_model->getBookingByOtp($bookingId, $otp);

				if (count($getBooking) > 0) {
					echo json_encode(array('status' => TRUE, 'message' => 'OTP is Verified. Thank you.'));
				} else {
					echo json_encode(array('status' => FALSE, 'message' => 'Invalid Otp.'));
				}
			} else {
				echo json_encode(array('status' => FALSE, 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => FALSE, 'message' => 'Auth token is required'));
		}
	}


	public function insertCarPickupImages()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idDriver = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {
				$carId = empty($this->input->post('carId')) ? '' : $this->input->post('carId');
				$count =  count($_FILES['images']['name']);
				$getcar = $this->Manage_product->getCarDetailsById($carId);
				try {

					for ($i = 0; $i < $count; $i++) { //loop to get 

						$_FILES['imageUp']['name'] = $_FILES['images']['name'][$i];
						$_FILES['imageUp']['type'] = $_FILES['images']['type'][$i];
						$_FILES['imageUp']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
						$_FILES['imageUp']['error'] = $_FILES['images']['error'][$i];
						$_FILES['imageUp']['size'] = $_FILES['images']['size'][$i];

						$config['upload_path'] = './images/vehicle_image/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['width']    = '150';
						$config['height']   = '150';
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload('imageUp')) {
							$image	= 	$this->upload->data();
							$log_image[$i]['image'] = empty($image['file_name']) ? '' : $image['file_name'];
							$log_image[$i]['carId'] = $carId;
							$log_image[$i]['driverId'] = $idDriver;
							$msg  = $this->App_model->insertCarPickupImage($log_image[$i]);
							$this->upload->display_errors();
						} else {

							$this->upload->display_errors();
						}
					}

					$cr['status'] = "ONGOING";

					$this->Manage_product->updateBooking($getcar[0]['bookingId'],$cr);

					echo json_encode(array("status" => "ok", "msg" => "Image Inserted Success"));
				} catch (Exception $e) {
					echo json_encode(array("status" => "error", "msg" => "Something went wrong"));
				}
			}
		}
	}


	public function insertCarDropImages()
	{


		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idDriver = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$carId = empty($this->input->post('carId')) ? '' : $this->input->post('carId');
				$count =  count($_FILES['images']['name']);

				try {

					for ($i = 0; $i < $count; $i++) { //loop to get 

						$_FILES['imageUp']['name'] = $_FILES['images']['name'][$i];
						$_FILES['imageUp']['type'] = $_FILES['images']['type'][$i];
						$_FILES['imageUp']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
						$_FILES['imageUp']['error'] = $_FILES['images']['error'][$i];
						$_FILES['imageUp']['size'] = $_FILES['images']['size'][$i];

						$config['upload_path'] = './images/vehicle_image/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['width']    = '150';
						$config['height']   = '150';
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload('imageUp')) {
							$image	= 	$this->upload->data();
							$log_image[$i]['image'] = empty($image['file_name']) ? '' : $image['file_name'];
							$log_image[$i]['carId'] = $carId;
							$log_image[$i]['driverId'] = $idDriver;
							$msg  = $this->App_model->insertCarDropImage($log_image[$i]);
							$this->upload->display_errors();
						} else {

							$this->upload->display_errors();
						}
					}

					echo json_encode(array("status" => "ok", "msg" => "Image Inserted Success"));
				} catch (Exception $e) {
					echo json_encode(array("status" => "error", "msg" => "Something went wrong"));
				}
			}
		}
	}


	public function getDriverServiceCounts()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idDriver = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {
				try {

					$res = $this->Manage_product->get_booking_counts_by_driver($idDriver);

					$response = [
						'status' => true,
						'message' => 'Booking summary fetched successfully',
						'data' => [
							'booking_type_counts' => $res['booking_type_counts'],
							'booking_status_counts' => $res['booking_status_counts']
						]
					];

					echo json_encode($response);

		
				} catch (Exception $e) {
					echo json_encode(array("status" => "error", "msg" => "Something went wrong"));
				}
			}
		}
	}

	public function verifyCarPickupImages()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idDriver = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$id = empty($this->input->post('carId')) ? '' : $this->input->post('carId');
				$log['is_verified'] = empty($this->input->post('is_verified')) ? '' : $this->input->post('is_verified');

				$data['pickup_images_verified'] = 1;
				$res = $this->Manage_product->updateCarPickupImages($id, $log);

				if ($res == 1) {
					$this->Manage_product->updateCarDetails($id, $data);
					echo json_encode(array('status' => TRUE, 'message' => 'Updated'));
				} else {
					echo json_encode(array('status' => FALSE, 'message' => 'Something went wrong'));
				}
			} else {
				echo json_encode(array('status' => FALSE, 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => FALSE, 'message' => 'Auth token is required'));
		}
	}

	public function verifyCarDropImages()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idDriver = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$id = empty($this->input->post('carId')) ? '' : $this->input->post('carId');

				$log['is_verified'] = empty($this->input->post('is_verified')) ? '' : $this->input->post('is_verified');
				$data['drop_images_verified'] = 1;


				$res = $this->Manage_product->updateCarDropImages($id, $log);

				if ($res == 1) {
					$this->Manage_product->updateCarDetails($id, $data);
					echo json_encode(array('status' => TRUE, 'message' => 'Updated'));
				} else {
					echo json_encode(array('status' => FALSE, 'message' => 'Something went wrong'));
				}
			} else {
				echo json_encode(array('status' => FALSE, 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => FALSE, 'message' => 'Auth token is required'));
		}
	}


	public function insertPickupImages()
	{

		$bookingId = empty($this->input->post('bookingId')) ? '' : $this->input->post('bookingId');
		$count =  count($_FILES['images']['name']);
		try {

			for ($i = 0; $i < $count; $i++) { //loop to get 

				$_FILES['imageUp']['name'] = $_FILES['images']['name'][$i];
				$_FILES['imageUp']['type'] = $_FILES['images']['type'][$i];
				$_FILES['imageUp']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
				$_FILES['imageUp']['error'] = $_FILES['images']['error'][$i];
				$_FILES['imageUp']['size'] = $_FILES['images']['size'][$i];

				$config['upload_path'] = './images/vehicle_image/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['width']    = '150';
				$config['height']   = '150';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('imageUp')) {
					$image	= 	$this->upload->data();
					$log_image[$i]['image'] = empty($image['file_name']) ? '' : $image['file_name'];
					$log_image[$i]['bookingId'] = $bookingId;
					$msg  = $this->App_model->insertPickupImage($log_image[$i]);
					$this->upload->display_errors();
				} else {

					$this->upload->display_errors();
				}
			}

			echo json_encode(array("status" => "ok", "msg" => "Image Inserted Success"));
		} catch (Exception $e) {
			echo json_encode(array("status" => "error", "msg" => "Something went wrong"));
		}
	}

	public function insertDropImages()
	{
		$bookingId = empty($this->input->post('bookingId')) ? '' : $this->input->post('bookingId');
		$count =  count($_FILES['images']['name']);

		try {

			for ($i = 0; $i < $count; $i++) { //loop to get 

				$_FILES['imageUp']['name'] = $_FILES['images']['name'][$i];
				$_FILES['imageUp']['type'] = $_FILES['images']['type'][$i];
				$_FILES['imageUp']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
				$_FILES['imageUp']['error'] = $_FILES['images']['error'][$i];
				$_FILES['imageUp']['size'] = $_FILES['images']['size'][$i];

				$config['upload_path'] = './images/vehicle_image/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['width']    = '150';
				$config['height']   = '150';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('imageUp')) {
					$image	= 	$this->upload->data();
					$log_image[$i]['image'] = empty($image['file_name']) ? '' : $image['file_name'];
					$log_image[$i]['bookingId'] = $bookingId;
					$msg  = $this->App_model->insertDropImage($log_image[$i]);
					$this->upload->display_errors();
				} else {

					$this->upload->display_errors();
				}
			}

			echo json_encode(array("status" => "ok", "msg" => "Image Inserted Success"));
		} catch (Exception $e) {
			echo json_encode(array("status" => "error", "msg" => "Something went wrong"));
		}
	}

	public function uploadCarsImage()
	{

		$config['upload_path'] = './images/vehicle_image/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['width']    = '150';
		$config['height']   = '150';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ($this->upload->do_upload('image')) {
			$image	= 	$this->upload->data();
			echo json_encode(array("status" => "ok", "imageName" => $image['file_name'], 'msg' => "Image uploaded successfully"));
		} else {

			$this->upload->display_errors();
			echo json_encode(array("status" => "error", "msg" => 'Error on Uploading'));
		}
	}

	function getUserById()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		// print_r($splitStr);
		// die();

		if (count($splitStr) > 1) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			// print_r($idUser);
			// die();

			if ($verify) {

				$res = $this->Manage_product->getUserByIdUpdateV2($idUser);
				if (count($res) > 0) {
					echo json_encode(array('status' => "ok", 'data' => $res));
				} else {
					echo json_encode(array('status' => "ok", 'data' => []));
				}
			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}

	public function updateBooking()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idDriver = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$id = empty($this->input->post('bookingId')) ? '' : $this->input->post('bookingId');

				$log['startOdometerReading'] = empty($this->input->post('startOdometerReading')) ? '' : $this->input->post('startOdometerReading');
				$log['endOdometerReading'] = empty($this->input->post('endOdometerReading')) ? '' : $this->input->post('endOdometerReading');

				$res = $this->Manage_product->updateBooking($id, $log);

				if ($res == 1) {
					echo json_encode(array('status' => TRUE, 'message' => 'Updated'));
				} else {
					echo json_encode(array('status' => FALSE, 'message' => 'Something went wrong'));
				}
			} else {
				echo json_encode(array('status' => FALSE, 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => FALSE, 'message' => 'Auth token is required'));
		}
	}



	public function insertStartOdometerImages()
	{
		$bookingId = empty($this->input->post('bookingId')) ? '' : $this->input->post('bookingId');
		$count =  count($_FILES['images']['name']);
		for ($i = 0; $i < $count; $i++) { //loop to get 

			$_FILES['imageUp']['name'] = $_FILES['images']['name'][$i];
			$_FILES['imageUp']['type'] = $_FILES['images']['type'][$i];
			$_FILES['imageUp']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
			$_FILES['imageUp']['error'] = $_FILES['images']['error'][$i];
			$_FILES['imageUp']['size'] = $_FILES['images']['size'][$i];

			$config['upload_path'] = './images/vehicle_image/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['width']    = '150';
			$config['height']   = '150';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('imageUp')) {
				$image	= 	$this->upload->data();
				$log_image[$i]['image'] = empty($image['file_name']) ? '' : $image['file_name'];
				$log_image[$i]['bookingId'] = $bookingId;
				$msg  = $this->Manage_product->insertPickupOdometerImage($log_image[$i]);
				$this->upload->display_errors();
			} else {

				$this->upload->display_errors();
			}
		}
	}


	public function insertEndOdometerImages()
	{
		$bookingId = empty($this->input->post('bookingId')) ? '' : $this->input->post('bookingId');
		$count =  count($_FILES['images']['name']);
		for ($i = 0; $i < $count; $i++) { //loop to get 

			$_FILES['imageUp']['name'] = $_FILES['images']['name'][$i];
			$_FILES['imageUp']['type'] = $_FILES['images']['type'][$i];
			$_FILES['imageUp']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
			$_FILES['imageUp']['error'] = $_FILES['images']['error'][$i];
			$_FILES['imageUp']['size'] = $_FILES['images']['size'][$i];

			$config['upload_path'] = './images/vehicle_image/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['width']    = '150';
			$config['height']   = '150';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('imageUp')) {
				$image	= 	$this->upload->data();
				$log_image[$i]['image'] = empty($image['file_name']) ? '' : $image['file_name'];
				$log_image[$i]['bookingId'] = $bookingId;
				$msg  = $this->Manage_product->insertDropOdometerImage($log_image[$i]);
				$this->upload->display_errors();
			} else {
				$this->upload->display_errors();
			}
		}
	}


	public function insertInspectionApp()
	{
		//  print_r($_REQUEST);
		//  die();
		$data['vehicleType'] = empty($this->input->post('vehicleType')) ? '' : $this->input->post('vehicleType');
		$data['make'] = empty($this->input->post('make')) ? '' : $this->input->post('make');
		$data['model'] = empty($this->input->post('model')) ? '' : $this->input->post('model');
		$data['variant'] = empty($this->input->post('variant')) ? '' : $this->input->post('variant');
		$data['color'] = empty($this->input->post('color')) ? '' : $this->input->post('color');
		$data['regNumber'] = empty($this->input->post('regNumber')) ? '' : $this->input->post('regNumber');
		$data['rcAvailable'] = empty($this->input->post('rcAvailable')) ? '' : $this->input->post('rcAvailable');
		$data['rcCondition'] = empty($this->input->post('rcCondition')) ? '' : $this->input->post('rcCondition');
		$data['misMatched'] = empty($this->input->post('misMatched')) ? '' : $this->input->post('misMatched');
		$data['regState'] = empty($this->input->post('regState')) ? '' : $this->input->post('regState');
		$data['regCity'] = empty($this->input->post('regCity')) ? '' : $this->input->post('regCity');
		$data['rtoCity'] = empty($this->input->post('rtoCity')) ? '' : $this->input->post('rtoCity');
		$data['noOfOwner'] = empty($this->input->post('noOfOwner')) ? '' : $this->input->post('noOfOwner');
		$data['mgdMonthYear'] = empty($this->input->post('mgdMonthYear')) ? '' : $this->input->post('mgdMonthYear');
		$data['regMonthYear'] = empty($this->input->post('regMonthYear')) ? '' : $this->input->post('regMonthYear');
		$data['insurance'] = empty($this->input->post('insurance')) ? '' : $this->input->post('insurance');
		$data['fitnessUpto'] = empty($this->input->post('fitnessUpto')) ? '' : $this->input->post('fitnessUpto');
		$data['rtoNocIssued'] = empty($this->input->post('rtoNocIssued')) ? '' : $this->input->post('rtoNocIssued');
		$data['underHypothecation'] = empty($this->input->post('underHypothecation')) ? '' : $this->input->post('underHypothecation');
		$data['fuelType'] = empty($this->input->post('fuelType')) ? '' : $this->input->post('fuelType');
		$data['drivernKm'] = empty($this->input->post('drivernKm')) ? '' : $this->input->post('drivernKm');
		$data['chasisNumberEmbossing'] = empty($this->input->post('chasisNumberEmbossing')) ? '' : $this->input->post('chasisNumberEmbossing');
		$data['roadTaxPaid'] = empty($this->input->post('roadTaxPaid')) ? '' : $this->input->post('roadTaxPaid');
		$data['duplicateKey'] = empty($this->input->post('duplicateKey')) ? '' : $this->input->post('duplicateKey');
		$data['toBeScrapped'] = empty($this->input->post('toBeScrapped')) ? '' : $this->input->post('toBeScrapped');
		$data['ownershipDetail'] = empty($this->input->post('ownershipDetail')) ? '' : $this->input->post('ownershipDetail');
		$data['cnglpgFitmentRc'] = empty($this->input->post('cnglpgFitmentRc')) ? '' : $this->input->post('cnglpgFitmentRc');
		$data['cngFitnessPlate'] = empty($this->input->post('cngFitnessPlate')) ? '' : $this->input->post('cngFitnessPlate');
		$data['cngCertificate'] = empty($this->input->post('cngCertificate')) ? '' : $this->input->post('cngCertificate');
		$data['insuranceValidity'] = empty($this->input->post('insuranceValidity')) ? '' : $this->input->post('insuranceValidity');
		$data['pucValidity'] = empty($this->input->post('pucValidity')) ? '' : $this->input->post('pucValidity');
		$data['userServiceManual'] = empty($this->input->post('userServiceManual')) ? '' : $this->input->post('userServiceManual');
		$data['vinChasisPlate'] = empty($this->input->post('vinChasisPlate')) ? '' : $this->input->post('vinChasisPlate');
		$data['chasisNumber'] = empty($this->input->post('chasisNumber')) ? '' : $this->input->post('chasisNumber');
		$data['engineNumber'] = empty($this->input->post('engineNumber')) ? '' : $this->input->post('engineNumber');
		$data['purchasingInvoice'] = empty($this->input->post('purchasingInvoice')) ? '' : $this->input->post('purchasingInvoice');
		$data['bankNocForm35'] = empty($this->input->post('bankNocForm35')) ? '' : $this->input->post('bankNocForm35');
		$data['roadTaxValidity'] = empty($this->input->post('roadTaxValidity')) ? '' : $this->input->post('roadTaxValidity');
		$data['permit'] = empty($this->input->post('permit')) ? '' : $this->input->post('permit');
		$data['batteryWarrantyCard'] = empty($this->input->post('batteryWarrantyCard')) ? '' : $this->input->post('batteryWarrantyCard');
		$data['bumperFront'] = empty($this->input->post('bumperFront')) ? '' : $this->input->post('bumperFront');
		$data['bumperRear'] = empty($this->input->post('bumperRear')) ? '' : $this->input->post('bumperRear');
		$data['bonetHood'] = empty($this->input->post('bonetHood')) ? '' : $this->input->post('bonetHood');
		$data['frontWindsheild'] = empty($this->input->post('frontWindsheild')) ? '' : $this->input->post('frontWindsheild');
		$data['rearWindSheild'] = empty($this->input->post('rearWindSheild')) ? '' : $this->input->post('rearWindSheild');
		$data['fendorLeft'] = empty($this->input->post('fendorLeft')) ? '' : $this->input->post('fendorLeft');
		$data['fendorRight'] = empty($this->input->post('fendorRight')) ? '' : $this->input->post('fendorRight');
		$data['doorRhsFront'] = empty($this->input->post('doorRhsFront')) ? '' : $this->input->post('doorRhsFront');
		$data['doorRhsRear'] = empty($this->input->post('doorRhsRear')) ? '' : $this->input->post('doorRhsRear');
		$data['doorLhsFront'] = empty($this->input->post('doorLhsFront')) ? '' : $this->input->post('doorLhsFront');
		$data['doorLhsRear'] = empty($this->input->post('doorLhsRear')) ? '' : $this->input->post('doorLhsRear');
		$data['dickyDoor'] = empty($this->input->post('dickyDoor')) ? '' : $this->input->post('dickyDoor');
		$data['dickyShockAbsorber'] = empty($this->input->post('dickyShockAbsorber')) ? '' : $this->input->post('dickyShockAbsorber');
		$data['bootSpace'] = empty($this->input->post('bootSpace')) ? '' : $this->input->post('bootSpace');
		$data['roofTop'] = empty($this->input->post('roofTop')) ? '' : $this->input->post('roofTop');
		$data['lhPillarA'] = empty($this->input->post('lhPillarA')) ? '' : $this->input->post('lhPillarA');
		$data['lhPillarB'] = empty($this->input->post('lhPillarB')) ? '' : $this->input->post('lhPillarB');
		$data['lhPillarC'] = empty($this->input->post('lhPillarC')) ? '' : $this->input->post('lhPillarC');
		$data['rhPillarA'] = empty($this->input->post('rhPillarA')) ? '' : $this->input->post('rhPillarA');
		$data['rhPillarB'] = empty($this->input->post('rhPillarB')) ? '' : $this->input->post('rhPillarB');
		$data['rhPillarC'] = empty($this->input->post('rhPillarC')) ? '' : $this->input->post('rhPillarC');
		$data['runningBoardLhs'] = empty($this->input->post('runningBoardLhs')) ? '' : $this->input->post('runningBoardLhs');
		$data['runningBoardRhs'] = empty($this->input->post('runningBoardRhs')) ? '' : $this->input->post('runningBoardRhs');
		$data['lhQuaterPanel'] = empty($this->input->post('lhQuaterPanel')) ? '' : $this->input->post('lhQuaterPanel');
		$data['rhQuaterPanel'] = empty($this->input->post('rhQuaterPanel')) ? '' : $this->input->post('rhQuaterPanel');
		$data['lhApron'] = empty($this->input->post('lhApron')) ? '' : $this->input->post('lhApron');
		$data['rhApron'] = empty($this->input->post('rhApron')) ? '' : $this->input->post('rhApron');
		$data['firewall'] = empty($this->input->post('firewall')) ? '' : $this->input->post('firewall');
		$data['cowlTop'] = empty($this->input->post('cowlTop')) ? '' : $this->input->post('cowlTop');
		$data['lowerCrossMember'] = empty($this->input->post('lowerCrossMember')) ? '' : $this->input->post('lowerCrossMember');
		$data['upperCrossMember'] = empty($this->input->post('upperCrossMember')) ? '' : $this->input->post('upperCrossMember');
		$data['headlightSupport'] = empty($this->input->post('headlightSupport')) ? '' : $this->input->post('headlightSupport');
		$data['readiotorSupport'] = empty($this->input->post('readiotorSupport')) ? '' : $this->input->post('readiotorSupport');
		$data['frontShowGrill'] = empty($this->input->post('frontShowGrill')) ? '' : $this->input->post('frontShowGrill');
		$data['bumperGrill'] = empty($this->input->post('bumperGrill')) ? '' : $this->input->post('bumperGrill');
		$data['orvmLh'] = empty($this->input->post('orvmLh')) ? '' : $this->input->post('orvmLh');
		$data['orvmRh'] = empty($this->input->post('orvmRh')) ? '' : $this->input->post('orvmRh');
		$data['headlightLh'] = empty($this->input->post('headlightLh')) ? '' : $this->input->post('headlightLh');
		$data['headlightRh'] = empty($this->input->post('headlightRh')) ? '' : $this->input->post('headlightRh');
		$data['fogLightLh'] = empty($this->input->post('fogLightLh')) ? '' : $this->input->post('fogLightLh');
		$data['fogLightRh'] = empty($this->input->post('fogLightRh')) ? '' : $this->input->post('fogLightRh');
		$data['tailLightLh'] = empty($this->input->post('tailLightLh')) ? '' : $this->input->post('tailLightLh');
		$data['tailLightRh'] = empty($this->input->post('tailLightRh')) ? '' : $this->input->post('tailLightRh');
		$data['tyreFlh'] = empty($this->input->post('tyreFlh')) ? '' : $this->input->post('tyreFlh');
		$data['tyreRlh'] = empty($this->input->post('tyreRlh')) ? '' : $this->input->post('tyreRlh');
		$data['tyreRrh'] = empty($this->input->post('tyreRrh')) ? '' : $this->input->post('tyreRrh');
		$data['tyreFrh'] = empty($this->input->post('tyreFrh')) ? '' : $this->input->post('tyreFrh');
		$data['spareTyre'] = empty($this->input->post('spareTyre')) ? '' : $this->input->post('spareTyre');
		$data['alloyWheels'] = empty($this->input->post('alloyWheels')) ? '' : $this->input->post('alloyWheels');
		$data['roofRailCarrier'] = empty($this->input->post('roofRailCarrier')) ? '' : $this->input->post('roofRailCarrier');
		$data['roofLuggageCarrier'] = empty($this->input->post('roofLuggageCarrier')) ? '' : $this->input->post('roofLuggageCarrier');
		$data['suspension'] = empty($this->input->post('suspension')) ? '' : $this->input->post('suspension');
		$data['axel'] = empty($this->input->post('axel')) ? '' : $this->input->post('axel');
		$data['interior'] = empty($this->input->post('interior')) ? '' : $this->input->post('interior');
		$data['noOfPowerWindows'] = empty($this->input->post('noOfPowerWindows')) ? '' : $this->input->post('noOfPowerWindows');
		$data['powerWindowFlh'] = empty($this->input->post('powerWindowFlh')) ? '' : $this->input->post('powerWindowFlh');
		$data['powerWindowRlh'] = empty($this->input->post('powerWindowRlh')) ? '' : $this->input->post('powerWindowRlh');
		$data['powerWindowFrh'] = empty($this->input->post('powerWindowFrh')) ? '' : $this->input->post('powerWindowFrh');
		$data['powerWindowRrh'] = empty($this->input->post('powerWindowRrh')) ? '' : $this->input->post('powerWindowRrh');
		$data['musicSystem'] = empty($this->input->post('musicSystem')) ? '' : $this->input->post('musicSystem');
		$data['normalSpeakers'] = empty($this->input->post('normalSpeakers')) ? '' : $this->input->post('normalSpeakers');
		$data['steeringMountAudioControl'] = empty($this->input->post('steeringMountAudioControl')) ? '' : $this->input->post('steeringMountAudioControl');
		$data['frontWiper'] = empty($this->input->post('frontWiper')) ? '' : $this->input->post('frontWiper');
		$data['rearWiper'] = empty($this->input->post('rearWiper')) ? '' : $this->input->post('rearWiper');
		$data['wiperWaterSpray'] = empty($this->input->post('wiperWaterSpray')) ? '' : $this->input->post('wiperWaterSpray');
		$data['rearDefogger'] = empty($this->input->post('rearDefogger')) ? '' : $this->input->post('rearDefogger');
		$data['rearCamera'] = empty($this->input->post('rearCamera')) ? '' : $this->input->post('rearCamera');
		$data['parkingSensor'] = empty($this->input->post('parkingSensor')) ? '' : $this->input->post('parkingSensor');
		$data['360Camera'] = empty($this->input->post('360Camera')) ? '' : $this->input->post('360Camera');
		$data['abs'] = empty($this->input->post('abs')) ? '' : $this->input->post('abs');
		$data['gps'] = empty($this->input->post('gps')) ? '' : $this->input->post('gps');
		$data['selfStarter'] = empty($this->input->post('selfStarter')) ? '' : $this->input->post('selfStarter');
		$data['alternator'] = empty($this->input->post('alternator')) ? '' : $this->input->post('alternator');
		$data['centerLocking'] = empty($this->input->post('centerLocking')) ? '' : $this->input->post('centerLocking');
		$data['horn'] = empty($this->input->post('horn')) ? '' : $this->input->post('horn');
		$data['signalSwitchKnob'] = empty($this->input->post('signalSwitchKnob')) ? '' : $this->input->post('signalSwitchKnob');
		$data['sunroofMoonroof'] = empty($this->input->post('sunroofMoonroof')) ? '' : $this->input->post('sunroofMoonroof');
		$data['pushButton'] = empty($this->input->post('pushButton')) ? '' : $this->input->post('pushButton');
		$data['dashboard'] = empty($this->input->post('dashboard')) ? '' : $this->input->post('dashboard');
		$data['odometer'] = empty($this->input->post('odometer')) ? '' : $this->input->post('odometer');
		$data['gloveBox'] = empty($this->input->post('gloveBox')) ? '' : $this->input->post('gloveBox');
		$data['roofTopExtr'] = empty($this->input->post('roofTopExtr')) ? '' : $this->input->post('roofTopExtr');
		$data['seat'] = empty($this->input->post('seat')) ? '' : $this->input->post('seat');
		$data['seatAdjustment'] = empty($this->input->post('seatAdjustment')) ? '' : $this->input->post('seatAdjustment');
		$data['seatBelt'] = empty($this->input->post('seatBelt')) ? '' : $this->input->post('seatBelt');
		$data['floorMat'] = empty($this->input->post('floorMat')) ? '' : $this->input->post('floorMat');
		$data['cruzeControl'] = empty($this->input->post('cruzeControl')) ? '' : $this->input->post('cruzeControl');
		$data['acVentilation'] = empty($this->input->post('acVentilation')) ? '' : $this->input->post('acVentilation');
		$data['climateControlAc'] = empty($this->input->post('climateControlAc')) ? '' : $this->input->post('climateControlAc');
		$data['flooded'] = empty($this->input->post('flooded')) ? '' : $this->input->post('flooded');
		$data['noOfAirbags'] = empty($this->input->post('noOfAirbags')) ? '' : $this->input->post('noOfAirbags');
		$data['transmissionType'] = empty($this->input->post('transmissionType')) ? '' : $this->input->post('transmissionType');
		$data['engineSound'] = empty($this->input->post('engineSound')) ? '' : $this->input->post('engineSound');
		$data['engine'] = empty($this->input->post('engine')) ? '' : $this->input->post('engine');
		$data['engineOil'] = empty($this->input->post('engineOil')) ? '' : $this->input->post('engineOil');
		$data['gearOil'] = empty($this->input->post('gearOil')) ? '' : $this->input->post('gearOil');
		$data['breakOil'] = empty($this->input->post('breakOil')) ? '' : $this->input->post('breakOil');
		$data['clutchOil'] = empty($this->input->post('clutchOil')) ? '' : $this->input->post('clutchOil');
		$data['radiator'] = empty($this->input->post('radiator')) ? '' : $this->input->post('radiator');
		$data['coolant'] = empty($this->input->post('vehicleType')) ? '' : $this->input->post('vehicleType');
		$data['engineMounting'] = empty($this->input->post('engineMounting')) ? '' : $this->input->post('engineMounting');
		$data['enginerCover'] = empty($this->input->post('enginerCover')) ? '' : $this->input->post('enginerCover');
		$data['engineBackCompression'] = empty($this->input->post('engineBackCompression')) ? '' : $this->input->post('engineBackCompression');
		$data['battery'] = empty($this->input->post('battery')) ? '' : $this->input->post('battery');
		$data['exahuast'] = empty($this->input->post('exahuast')) ? '' : $this->input->post('exahuast');
		$data['exahuastCatalyticConverter'] = empty($this->input->post('exahuastCatalyticConverter')) ? '' : $this->input->post('exahuastCatalyticConverter');
		$data['gearShiting'] = empty($this->input->post('gearShiting')) ? '' : $this->input->post('gearShiting');
		$data['clutch'] = empty($this->input->post('clutch')) ? '' : $this->input->post('clutch');
		$data['break'] = empty($this->input->post('break')) ? '' : $this->input->post('break');
		$data['steering'] = empty($this->input->post('steering')) ? '' : $this->input->post('steering');
		$data['comments'] = empty($this->input->post('comments')) ? '' : $this->input->post('comments');
		$data['addtionalFitting'] = empty($this->input->post('addtionalFitting')) ? '' : $this->input->post('addtionalFitting');


		$res = $this->Manage_product->insertInspection($data);

		if ($res == 1) {
			echo json_encode(array('status' => "ok", 'message' => 'Inserted,'));
		} else {
			echo json_encode(array('status' => "error", 'message' => 'Failed, Please try again or Contact Admin.'));
		}
	}


	function updateUser()
	{


		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$dat['name'] = empty($this->input->post('name')) ? '' : $this->input->post('name');
				$dat['email'] = empty($this->input->post('email')) ? '' : $this->input->post('email');
				$dat['password'] = empty($this->input->post('password')) ? '' : md5($this->input->post('password'));
				$dat['type'] = empty($this->input->post('type')) ? '' : $this->input->post('type');
				$dat['address'] = empty($this->input->post('address')) ? '' : $this->input->post('address');
				$dat['city'] = empty($this->input->post('city')) ? '' : $this->input->post('city');
				$dat['state'] = empty($this->input->post('state')) ? '' : $this->input->post('state');
				$dat['yearinbzns'] = empty($this->input->post('yearinbzns')) ? '' : $this->input->post('yearinbzns');
				$dat['partner'] = empty($this->input->post('partner')) ? '' : $this->input->post('partner');
				$dat['partnerphone'] = empty($this->input->post('partnerphone')) ? '' : $this->input->post('partnerphone');
				$dat['partneremail'] = empty($this->input->post('partneremail')) ? '' : $this->input->post('partneremail');
				// $dat['gst'] = empty($this->input->post('gst')) ? '' : $this->input->post('gst');

				$config['upload_path'] = './images/profile';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
				$config['width']    = '150';
				$config['height']   = '150';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('gst')) {
					$gstdealer	= 	$this->upload->data();
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$data['gst'] = empty($gstdealer['file_name']) ? '' : $gstdealer['file_name'];
				}

				$config['upload_path'] = './images/profile';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
				$config['width']    = '150';
				$config['height']   = '150';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('pan')) {
					$pan = $this->upload->data();
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$data['pan'] = empty($pan['file_name']) ? '' : $pan['file_name'];
				}
				// $dat['pan'] = empty($this->input->post('pan')) ? '' : $this->input->post('pan');

				if (!empty($idUser)) {
					$res = $this->App_model->updateUser($idUser, $dat);

					if ($res == 1) {
						echo json_encode(array('status' => "ok", 'msg' => "updated"));
					} else {
						echo json_encode(array('status' => "error", 'msg' => "Error on updating"));
					}
				} else {
					echo json_encode(array('status' => "error", 'msg' => "UserId is Required to update!!"));
				}
			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}

	public function getAllMpCategory()
	{

		$data = $this->Manage_product->getAllMpCategory();

		echo json_encode($data);
	}

	public function getAllModelV3()
	{
		$id = $this->input->post('brand_ids');

		$data = $this->Manage_product->getAllModelV3($id);

		echo json_encode($data);
	}

	public function getAllbrandV3()
	{
		$id = $this->input->post('category_ids');

		$data = $this->Manage_product->getAllBrandV3($id);

		echo json_encode($data);
	}

	public function insertMKVehicle()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$id = empty($this->input->post('id')) ? '' : $this->input->post('id');
				$reg = empty($this->input->post('regno')) ? '' : $this->input->post('regno');
				$getVehiclebyReg = $this->Manage_product->getVehicleByReg($reg);

				$lastID = $this->Manage_product->getVehicleLastId();

				$config['upload_path'] = './images/vehicle_image/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['width']    = '150';
				$config['height']   = '150';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('image')) {
					$image	= 	$this->upload->data();
					$data['image'] = empty($image['file_name']) ? '' : $image['file_name'];
					$this->upload->display_errors();
				} else {
					$this->upload->display_errors();
				}

				$data['vehicle_id'] = $this->generateUniqueId($lastID[0]['vehicle_id']);
				$data['category_id'] = empty($this->input->post('category_id')) ? '' : $this->input->post('category_id');
				$data['brand_id'] = empty($this->input->post('brand_id')) ? '' : $this->input->post('brand_id');
				$data['model_id'] = empty($this->input->post('model_id')) ? '' : $this->input->post('model_id');
				$data['listingtype'] = empty($this->input->post('listingtype')) ? '' : $this->input->post('listingtype');
				$data['variant'] = empty($this->input->post('variant')) ? '' : $this->input->post('variant');
				$data['vcondition'] = empty($this->input->post('vcondition')) ? '' : $this->input->post('vcondition');
				$data['insurance'] = empty($this->input->post('insurance')) ? '' : $this->input->post('insurance');
				$data['insurancedate'] = empty($this->input->post('insurancedate')) ? '' : $this->input->post('insurancedate');
				$data['city'] = empty($this->input->post('city')) ? '' : $this->input->post('city');
				$data['state'] = empty($this->input->post('state')) ? '' : $this->input->post('state');
				$data['rto'] = empty($this->input->post('rto')) ? '' : $this->input->post('rto');
				$data['year'] = empty($this->input->post('year')) ? '' : $this->input->post('year');
				$data['kms'] = empty($this->input->post('kms')) ? '' : $this->input->post('kms');
				$data['location'] = empty($this->input->post('location')) ? '' : $this->input->post('location');
				$data['discount_percent'] = empty($this->input->post('discount_percent')) ? '' : $this->input->post('discount_percent');
				$data['discount_price'] = empty($this->input->post('discount_price')) ? '' : $this->input->post('discount_price');
				$data['price'] = empty($this->input->post('price')) ? '' : round(preg_replace('/[^A-Za-z0-9]/', '', $this->input->post('price')));
				$data['description'] = empty($this->input->post('description')) ? '' : $this->input->post('description');
				$data['features'] = empty($this->input->post('features')) ? '' : $this->input->post('features');
				$data['fuel_type'] = empty($this->input->post('fuel_type')) ? '' : $this->input->post('fuel_type');
				$data['regno'] = empty($this->input->post('regno')) ? '' : $this->input->post('regno');
				$data['transmission'] = empty($this->input->post('transmission')) ? '' : $this->input->post('transmission');
				$data['ownership'] = empty($this->input->post('ownership')) ? '' : $this->input->post('ownership');
				$data['added_by'] = $idUser;
				$data['added_type'] = empty($this->input->post('added_type')) ? '' : $this->input->post('added_type');
				$data['rc_availability'] = empty($this->input->post('rc_availability')) ? '' : $this->input->post('rc_availability');

				if ($id == "") {
					$data['is_active'] = 1;
					$data['status'] = 'Pending';
				} else {
					$data['is_active'] = empty($this->input->post('is_active')) ? '' : $this->input->post('is_active');
					$data['status'] = empty($this->input->post('status')) ? '' : $this->input->post('status');
				}


				if ($id == "") {

					if (count($getVehiclebyReg) > 0) {
						echo json_encode(array('status' => "error", 'msg' => 'Vehicle with regNo already exist'));
					} else {

						$res = $this->Manage_product->insertMPVehicle($data);
						if ($res['msg'] == '1') {
							echo json_encode(array('status' => "success", 'vehicleId' => $res['last_id'], 'msg' => 'Vehicle Added Success!'));
						} else {
							echo json_encode(array('status' => "error", 'msg' => 'Vehicle Added Error, Try Again!'));
						}
					}
				} else {
					$res = $this->Manage_product->updateMPVehicle($id, $data);
					if ($res == 1) {
						echo json_encode(array('status' => "success", 'vehicleId' => $id, 'msg' => 'Vehicle Update Success!'));
					} else {
						echo json_encode(array('status' => "error", 'msg' => 'Vehicle Update Error, Try Again!'));
					}
				}
			} else {
				echo json_encode(array('status' => "error", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "error", 'message' => 'Auth token is required'));
		}
	}

	public function uploadMKMultipleImages()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$vehicleId = empty($this->input->post('vehicle_id')) ? '' : $this->input->post('vehicle_id');
				$count =  count($_FILES['image']['name']);
				for ($i = 0; $i < $count; $i++) {
					$_FILES['imageUp']['name'] = $_FILES['image']['name'][$i];
					$_FILES['imageUp']['type'] = $_FILES['image']['type'][$i];
					$_FILES['imageUp']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
					$_FILES['imageUp']['error'] = $_FILES['image']['error'][$i];
					$_FILES['imageUp']['size'] = $_FILES['image']['size'][$i];
					$config['upload_path'] = './images/vehicle_image/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|svg';
					$config['width']    = '150';
					$config['height']   = '150';
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('imageUp')) {
						$image	= 	$this->upload->data();
						$log_image['image'] = empty($image['file_name']) ? '' : $image['file_name'];
						$log_image['vehicle_id'] = $vehicleId;
						$msg  = $this->Manage_product->insertMPVehicleImages($log_image);
						$this->upload->display_errors();
					} else {
						$this->upload->display_errors();
					}
				}

				echo json_encode(array('msg' => "Uploaded"));
				// $vehicleId = empty($this->input->post('vehicle_id')) ? '' : $this->input->post('vehicle_id');
				// try {
				// 	$config['upload_path'] = './images/vehicle_image/';
				// 	$config['allowed_types'] = 'gif|jpg|png|jpeg';
				// 	$config['width']    = '150';
				// 	$config['height']   = '150';
				// 	$this->load->library('upload', $config);
				// 	$this->upload->initialize($config);
				// 	if ($this->upload->do_upload('image')) {
				// 		$image	= 	$this->upload->data();
				// 		$log_image['image'] = empty($image['file_name']) ? '' : $image['file_name'];
				// 		$log_image['vehicle_id'] = $vehicleId;
				// 		$msg  = $this->Manage_product->insertMPVehicleImages($log_image);
				// 		$this->upload->display_errors();
				// 	} else {

				// 		$this->upload->display_errors();
				// 	}

				// 	echo json_encode(array('msg' => "Uploaded"));
				// } catch (Exception $e) {
				// 	echo json_encode(array('msg' => "$e->message"));
				// }

			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}

	public function getAllMPVehicles()
	{

		$start = $this->input->post('start');
		$limit = $this->input->post('limit');

		$filter['category_id'] = $this->input->post('category_id');
		$filter['brand_id'] = $this->input->post('brand_id');
		$filter['model_id'] = $this->input->post('model_id');
		$filter['year'] = $this->input->post('year');
		$filter['price'] = $this->input->post('price');
		$filter['ownership'] = $this->input->post('ownership');
		$filter['listingtype'] = $this->input->post('listingtype');
		$filter['notin'] = $this->input->post('notin');
		$filter['buyfrom'] = $this->input->post('buyfrom');
		$filter['priceFrom'] = $this->input->post('priceFrom');
		$filter['priceToo'] = $this->input->post('priceToo');
		$filter['city'] = $this->input->post('city');
		$filter['state'] = $this->input->post('state');
		$filter['sort_by'] = $this->input->post('sort_by');



		$totalVehicles = $this->Manage_product->getAllMPVehiclesApp($filter);
		$res = $this->Manage_product->getAllMPVehiclesWithLimitApp($filter, $start, $limit);

		if ($res) {
			echo json_encode(array('status' => "ok", "data" => $res, "total" => $totalVehicles));
		} else {
			echo json_encode(array('status' => "ok", "data" => [], "total" => 0));
		}
	}


	function searchCars()
	{
		$query = $this->input->post('search');

		$searchResult = [];

		$getAllCatBySearch = $this->Manage_product->getAllCatBySearch($query);
		$getAllBrandBySearch = $this->Manage_product->getAllBrandBySearch($query);
		$getAllModelBySearch = $this->Manage_product->getAllModelBySearch($query);

		foreach ($getAllCatBySearch as $cat) {
			$data['search_key'] = 'category_id';
			$data['search_id'] = $cat['id'];
			$data['name'] = $cat['name'];

			$searchResult[] = $data;
		}

		foreach ($getAllBrandBySearch as $brand) {
			$data['search_key'] = 'brand_id';
			$data['search_id'] = $brand['id'];
			$data['name'] = $brand['name'];

			$searchResult[] = $data;
		}


		foreach ($getAllModelBySearch as $model) {
			$data['search_key'] = 'model_id';
			$data['search_id'] = $model['id'];
			$data['name'] = $model['name'];

			$searchResult[] = $data;
		}

		echo json_encode($searchResult);
	}


	public function getAllMPVehiclesByVendor()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$start = $this->input->post('start');
				$limit = $this->input->post('limit');
				$vendor_id = $idUser;
				$totalVehicles = $this->Manage_product->getAllMPVehiclesByVendor($vendor_id);
				$soldVehicles = $this->Manage_product->getAllMPSoldVehiclesByVendor($vendor_id);
				$liveVehicles = $this->Manage_product->getAllMPLiveVehiclesByVendor($vendor_id);
				$offlineVehicles = $this->Manage_product->getAllMPOfflineVehiclesByVendor($vendor_id);

				$res = $this->Manage_product->getAllMPVehiclesByVendorWithLimit($vendor_id, $limit, $start);

				if ($res) {
					echo json_encode(array('status' => "ok", "data" => $res, "total" => $totalVehicles, "sold" => $soldVehicles, "live" => $liveVehicles, "offline" => $offlineVehicles));
				} else {
					echo json_encode(array('status' => "ok", "data" => []));
				}
			} else {
				echo json_encode(array('status' => "error", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "error", 'message' => 'Auth token is required'));
		}
	}


	public function updateMPVehicleStatus()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$id = $this->input->post('id');

				$data['status'] = empty($this->input->post('status')) ? '' : $this->input->post('status');

				$res = $this->Manage_product->updateMPVehicle($id, $data);

				if ($res == 1) {
					echo json_encode(array('status' => 'success'));
				} else {
					echo json_encode(array('status' => 'error'));
				}
			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}

	public function updateMPVehicleActive()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$id = $this->input->post('id');

				$data['is_active'] = empty($this->input->post('is_active')) ? '' : $this->input->post('is_active');

				$res = $this->Manage_product->updateMPVehicle($id, $data);

				if ($res == 1) {
					echo json_encode(array('status' => 'success'));
				} else {
					echo json_encode(array('status' => 'error'));
				}
			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}

	public function getMPVehicleById()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {


				$id = $this->input->post('id');

				$res = $this->Manage_product->getMPVehicleById($id);

				if (count($res) > 0) {
					echo json_encode(array('status' => 'success', "data" => $res[0]));
				} else {
					echo json_encode(array('status' => 'error', "data" => []));
				}
			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}

	public function deleteMPVehicle()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$id = $this->input->post('id');


				$data = $this->Manage_product->deleteMPVehicle($id);

				if ($data == 1) {
					echo json_encode(array('status' => 'success', "msg" => "Deleted Success"));
				} else {
					echo json_encode(array('status' => 'error', "msg" => "Error On  Deletion.."));
				}
			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}

	public function insertMPEnquiry()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$data['user_id'] = $idUser;
				$data['dealer_id'] = empty($this->input->post('dealer_id')) ? '' : $this->input->post('dealer_id');
				$data['vehicle_id'] = empty($this->input->post('vehicle_id')) ? '' : $this->input->post('vehicle_id');
				$data['status'] = "Enquired";

				$res = $this->Manage_product->insertMPEnquiry($data);

				if ($res['msg'] == 1) {
					$getEnq = $this->Manage_product->getMPEnquiryById($res['last_id']);
					$this->sendNotificationEnquiry($data['dealer_id'], $res['last_id'], 'Simple', $getEnq);
					echo json_encode(array('status' => 'success'));
				} else {
					echo json_encode(array('status' => 'error'));
				}
			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}

	public function getAllStates()
	{

		$data = $this->Manage_product->getAllStates();

		echo json_encode($data);
	}


	public function getAllCityByState()
	{
		$stateId = empty($this->input->post('state')) ? '' : $this->input->post('state');

		$data = $this->Manage_product->getAllCityByState($stateId);

		echo json_encode($data);
	}

	public function insertCustomMPEnquiry()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$userId = $idUser;

				$getUserById = $this->Manage_product->getUserById($userId);

				$cData['userId'] = $userId;
				$cData['ownership'] = empty($this->input->post('ownership')) ? '' : $this->input->post('ownership');
				$cData['priceFrom'] = empty($this->input->post('priceFrom')) ? '' : $this->input->post('priceFrom');
				$cData['priceToo'] = empty($this->input->post('priceToo')) ? '' : $this->input->post('priceToo');
				$cData['description'] = empty($this->input->post('description')) ? '' : $this->input->post('description');
				$cData['city'] = $getUserById[0]['city'];
				$cData['category_id'] = empty($this->input->post('category')) ? '' : $this->input->post('category');
				$cData['brand_id'] = empty($this->input->post('brand')) ? '' : $this->input->post('brand');
				$cData['model_id'] = empty($this->input->post('model')) ? '' : $this->input->post('model');
				$cData['status'] = "Enquired";

				$res = $this->Manage_product->insertCustomMPEnquiry($cData);

				if ($res['msg'] == 1) {
					$this->sendNotificationCustomEnquiry($cData['city'], $res['last_id'], 'Custom');
					echo json_encode(array('status' => "success"));
				} else {
					echo json_encode(array('status' => "error"));
				}
			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}

	public function getMPVehicleDetailsById()
	{
		$id = $this->input->post('id');

		$res = $this->Manage_product->getMPVehicleById($id);
		// print_r($res);
		// die();
		if (count($res) > 0) {
			echo json_encode(array('status' => 'success', "data" => $res[0]));
		} else {
			echo json_encode(array('status' => 'error', "data" => []));
		}
	}


	function getHomeCarsWithLimit()
	{

		$limit = $this->input->post("limit");
		$notinId = $this->input->post("notinId");
		$listing = $this->input->post("listing");


		$res = $this->Manage_product->getHomeCarsWithLimit($limit, $notinId, $listing);

		echo json_encode($res);
	}

	function insertWishlist()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (count($splitStr) > 1) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$cData['product_id'] = empty($this->input->post('product_id')) ? '' : $this->input->post('product_id');
				// $cData['status'] = empty($this->input->post('status')) ? '' : $this->input->post('status');
				$cData['user_id'] = $idUser;

				$checkWishlist = $this->Manage_product->getWishCheck($cData['user_id'], $cData['product_id']);

				if (count($checkWishlist) > 0) {
					echo json_encode(array('status' => "error", 'message' => 'Already in a wishlist..'));
				} else {
					$res = $this->Manage_product->insertWishlist($cData);

					if ($res == 1) {
						echo json_encode(array('status' => "ok", 'msg' => "Inserted Success"));
					} else {
						echo json_encode(array('status' => "error", 'msg' => "failed to insert.."));
					}
				}
			} else {
				echo json_encode(array('status' => "error", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "error", 'message' => 'Auth token is required'));
		}
	}


	public function deleteWishlistById()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$id = $this->input->post('product_id');

				$data = $this->Manage_product->deleteWishlist($id, $idUser);

				if ($data == 1) {
					echo json_encode(array('status' => 'success', "msg" => "Deleted Success"));
				} else {
					echo json_encode(array('status' => 'error', "msg" => "Error On  Deletion.."));
				}
			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}


	public function getWishlistByUser()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {
				$res = $this->Manage_product->getWishlistById($idUser, $start, $limit);

				if (count($res) > 0) {
					echo json_encode(array('status' => 'success', "data" => $res[0]));
				} else {
					echo json_encode(array('status' => 'error', "data" => []));
				}
			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}

	function getAllEnquiry()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$start = $this->input->post('start');
				$limit = $this->input->post('limit');

				$getUser = $this->Manage_product->getUserById($idUser);

				$getCity = $getUser[0]['city'];

				$total = $this->Manage_product->getAllVehicleEnquiryByDealer($idUser);
				$getAllEnq = $this->Manage_product->getAllVehicleEnquiryByDealerWithLimit($idUser, $start, $limit);

				$enqfinal = array();

				if (count($getAllEnq) > 0) {

					foreach ($getAllEnq as $enq) {
						$userDet = $this->Manage_product->getUserById($enq['user_id']);
						$getVeh = $this->Manage_product->getMPVehicleByIdv2($enq['vehicle_id']);
						$getBrand = $this->Manage_product->getBrandById($getVeh[0]['brand_id']);
						$getModel = $this->Manage_product->getModelById($getVeh[0]['model_id']);
						$datm['cust_name'] = $userDet[0]['firstName'];
						$datm['cust_email'] = $userDet[0]['email'];
						$datm['cust_phone'] = $userDet[0]['phoneNumber'];
						$datm['vehicle_brand'] = $getBrand[0]['name'];
						$datm['vehicle_variant'] = $getVeh[0]['variant'];;
						$datm['vehicle_model'] = $getModel[0]['name'];
						$datm['vehicle_regno'] = $getVeh[0]['regno'];
						$datm['date'] = date("d-m-Y", strtotime($enq['created']));
						$datm['enqId'] = $enq['id'];
						$datm['status'] = $enq['status'];
						$datm['hide'] = $enq['hide'];
						$enqfinal[] = $datm;
					}
				} else {

					$enqfinal = [];
				}

				// print_r($enqfinal);
				echo json_encode(array('data' => $enqfinal, 'total' => $total));
			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}

	function getAllEnquiryByVehicleId()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$vehId = $this->input->post('carId');
				$start = $this->input->post('start');
				$limit = $this->input->post('limit');

				$getUser = $this->Manage_product->getUserById($idUser);

				$getCity = $getUser[0]['city'];

				$total = $this->Manage_product->getAllVehicleEnquiryByDealerV2($idUser, $vehId);
				$getAllEnq = $this->Manage_product->getAllVehicleEnquiryByDealerWithLimitV2($idUser, $vehId, $start, $limit);

				$enqfinal = array();

				if (count($getAllEnq) > 0) {

					foreach ($getAllEnq as $enq) {
						$userDet = $this->Manage_product->getUserById($enq['user_id']);
						$getVeh = $this->Manage_product->getMPVehicleByIdv2($enq['vehicle_id']);
						$getBrand = $this->Manage_product->getBrandById($getVeh[0]['brand_id']);
						$getModel = $this->Manage_product->getModelById($getVeh[0]['model_id']);
						$datm['cust_name'] = $userDet[0]['firstName'];
						$datm['cust_email'] = $userDet[0]['email'];
						$datm['cust_phone'] = $userDet[0]['phoneNumber'];
						$datm['vehicle_brand'] = $getBrand[0]['name'];
						$datm['vehicle_variant'] = $getVeh[0]['variant'];;
						$datm['vehicle_model'] = $getModel[0]['name'];
						$datm['vehicle_regno'] = $getVeh[0]['regno'];
						$datm['date'] = date("d-m-Y", strtotime($enq['created']));
						$datm['enqId'] = $enq['id'];
						$datm['status'] = $enq['status'];
						$datm['hide'] = $enq['hide'];
						$enqfinal[] = $datm;
					}
				} else {

					$enqfinal = [];
				}

				// print_r($enqfinal);
				echo json_encode(array('data' => $enqfinal, 'total' => $total));
			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}

	public function deleteMPVehicleMultiImage()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$id = $this->input->post('id');

				$res = $this->Manage_product->deleteMPVehicleMultiImage($id);

				if ($res == 1) {
					echo json_encode(array('status' => 'success'));
				} else {
					echo json_encode(array('status' => 'error'));
				}
			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}

	function updateEnquiryStatus()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$id = $this->input->post('id');
				$data['status'] = $this->input->post('status');

				$res = $this->Manage_product->updateMPEnquiry($id, $data);
				if ($res == 1) {
					echo json_encode(array("status" => "ok"));
				} else {
					echo json_encode(array("status" => "error"));
				}
			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}

	function getAllDealerDataById()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		// print_r($splitStr);
		// die();

		if (count($splitStr) > 1) {

			$verify = $this->verifyToken($splitStr[1]);
			// $idUser = $this->encryption->decrypt($splitStr[1]);

			// print_r($idUser);
			// die();

			if ($verify) {

				$id = $this->input->post('id');

				$res = $this->Manage_product->getAllDealerDataById($id);
				if (count($res) > 0) {
					echo json_encode(array('status' => "ok", 'data' => $res));
				} else {
					echo json_encode(array('status' => "ok", 'data' => []));
				}
			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}


	function getAllMPVehicleByDealerId()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (count($splitStr) > 1) {

			$verify = $this->verifyToken($splitStr[1]);
			// $idUser = $this->encryption->decrypt($splitStr[1]);
			if ($verify) {

				$id = $this->input->post('id');
				$start = $this->input->post('start');
				$limit = $this->input->post('limit');


				$totalVeh = $this->Manage_product->getAllMPVehiclesByVendor($id);
				$res = $this->Manage_product->getAllMPVehiclesByVendorWithLimit($id, $limit, $start);
				if ($res) {
					echo json_encode(array('status' => "ok", "data" => $res, "total" => $totalVeh));
				} else {
					echo json_encode(array('status' => "ok", "data" => []));
				}
			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}

	function getAllCustomEnquiry()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {
				$start = $this->input->post('start');
				$limit = $this->input->post('limit');
				$getUser = $this->Manage_product->getUserById($idUser);

				$getCity = $getUser[0]['city'];

				$total = $this->Manage_product->getAllVehicleEnquiryByDealerCity($getCity);
				$getAllEnqCity = $this->Manage_product->getAllVehicleEnquiryByDealerCityWithLimit($getCity, $start, $limit);


				$enqfinal = array();

				if (count($getAllEnqCity) > 0) {
					foreach ($getAllEnqCity as $enqv2) {
						$userDetv2 = $this->Manage_product->getUserById($enqv2['userId']);
						$category = json_decode($enqv2['category_id'], true);
						$brand = json_decode($enqv2['brand_id'], true);
						$model = json_decode($enqv2['model_id'], true);
						$ownership = $enqv2['ownership'];

						$carArr = array();
						$i = 0;
						foreach ($category as $c) {

							$getCategory = $this->Manage_product->getCategoryById($c);
							$getBrand = $this->Manage_product->getBrandById($brand[$i]);
							$getModel = $this->Manage_product->getModelById($model[$i]);

							$log['category_id'] = $getCategory[0]['name'];
							$log['brand_id'] = $getBrand[0]['name'];
							$log['model_id'] = $getModel[0]['name'];
							$log['ownership'] = json_decode($enqv2['ownership'], true);

							$carArr[] = $log;
							$i++;
						}

						$datm['carsDetail'] = $carArr;
						$datm['cust_name'] = $userDetv2[0]['firstName'];
						$datm['cust_email'] = $userDetv2[0]['email'];
						$datm['cust_phone'] = $userDetv2[0]['phoneNumber'];
						$datm['date'] = date("d-m-Y", strtotime($enqv2['created']));
						$datm['status'] = $enqv2['status'];
						$datm['enqId'] = $enqv2['id'];
						$datm['hide'] = $enqv2['hide'];
						$enqfinal[] = $datm;
					}
				} else {

					$enqfinal = [];
				}


				echo json_encode(array('data' => $enqfinal, 'total' => $total));
			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}


	public function insertPriceRequest()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);

			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {
				if (!empty($idUser) && !empty($this->input->post('vehicle_id'))) {


					$checkPrice = $this->Manage_product->checkPriceReq($idUser, $this->input->post('vehicle_id'));

					if (count($checkPrice) > 0) {
						echo json_encode(array('status' => 'error', 'msg' => 'Already submitted a Price Request.'));
					} else {
						$data['price'] = empty($this->input->post('price')) ? '' : $this->input->post('price');
						$data['user_id'] = $idUser;
						$data['vehicle_id'] = empty($this->input->post('vehicle_id')) ? '' : $this->input->post('vehicle_id');

						$res = $this->Manage_product->insertPriceRequest($data);

						if ($res == 1) {
							echo json_encode(array('status' => 'success'));
						} else {
							echo json_encode(array('status' => 'error', 'msg' => 'Something went wrong, Try Again!'));
						}
					}
				} else {
					echo json_encode(array('status' => 'error', 'msg' => 'User id and vehicle id is mandatory..'));
				}
			} else {
				echo json_encode(array('status' => "error", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "error", 'message' => 'Auth token is required'));
		}
	}

	public function insertAppointment()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);

			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				if (!empty($idUser) && !empty($this->input->post('vehicle_id'))) {
					$check = $this->Manage_product->checkAppointment($idUser, $this->input->post('vehicle_id'));
					if (count($check) > 0) {
						echo json_encode(array('status' => 'error', 'msg' => 'Already submitted a apointment.'));
					} else {
						$data['user_id'] = $idUser;
						$data['vehicle_id'] = empty($this->input->post('vehicle_id')) ? '' : $this->input->post('vehicle_id');
						$data['date'] = empty($this->input->post('date')) ? '' : $this->input->post('date');
						$data['time'] = empty($this->input->post('time')) ? '' : $this->input->post('time');
						$data['description'] = empty($this->input->post('description')) ? '' : $this->input->post('description');

						$res = $this->Manage_product->insertAppointment($data);

						if ($res == 1) {
							echo json_encode(array('status' => 'success'));
						} else {
							echo json_encode(array('status' => 'error', 'msg' => 'Something went wrong, Try Again!'));
						}
					}
				} else {
					echo json_encode(array('status' => 'error', 'msg' => 'User id and vehicle id is mandatory..'));
				}
			} else {
				echo json_encode(array('status' => "error", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "error", 'message' => 'Auth token is required'));
		}
	}

	public function freeTrailSubscription()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$getUser = $this->Manage_product->getUserById($idUser);

				if (count($getUser) > 0 && $getUser[0]['freeTrailAccessed'] == 1) {
					echo json_encode(array('status' => "error", 'message' => 'Already Added free trial'));
				} else {

					date_default_timezone_set('Asia/Kolkata');  // Set the time zone

					$current_date = date('Y-m-d');  // Get the current date
					$end_date = date('Y-m-d', strtotime('+90 days'));

					$log['freeTrailAccessed'] = 1;
					$log['freeTrialEndDate'] = $end_date;

					$res = $this->Manage_product->updateUser($idUser, $log);

					if ($res == 1) {
						echo json_encode(array('status' => "ok", 'message' => 'Free Trial Extended!'));
					} else {
						echo json_encode(array('status' => "error", 'message' => 'Something went wrong'));
					}
				}
			} else {
				echo json_encode(array('status' => "error", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "error", 'message' => 'Auth token is required'));
		}
	}


	function generateUniqueId($lastId = null, $prefix = "VA")
	{
		// Ensure the prefix is of the desired length
		$prefixLength = strlen($prefix);
		$maxDigitsLength = 8; // Maximum length for the numeric part

		// Function to generate a random numeric part with a maximum length of 8 digits
		function generateNumericPart($length)
		{
			return str_pad(rand(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
		}

		do {
			// Generate a new unique ID
			$numericPart = generateNumericPart($maxDigitsLength);
			$newId = $prefix . $numericPart;

			// Check if the new ID is different from the last ID
			// In a real-world scenario, you should check against the database here
			$isUnique = ($newId !== $lastId);
		} while (!$isUnique);

		return $newId;
	}


	function insertDeviceToken()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (count($splitStr) > 1) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);
			if ($verify) {

				$cData['device_token'] = empty($this->input->post('token')) ? '' : $this->input->post('token');

				$res = $this->Manage_product->updateUser($idUser, $cData);

				if ($res == 1) {
					echo json_encode(array('status' => "ok", 'msg' => 'Token Updated'));
				} else {
					echo json_encode(array('status' => "error", 'msg' => 'Error on update'));
				}
			} else {
				echo json_encode(array('status' => "error", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "error", 'message' => 'Auth token is required'));
		}
	}

	public function getAppointmentByVehicleId()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idDriver = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {
				$start = $this->input->post('start');
				$limit = $this->input->post('limit');
				$vehicleId = $this->input->post('vehicle_id');
				$totalData = $this->Manage_product->getAllAppointmentsByVehicleId($vehicleId);
				$res = $this->Manage_product->getAllAppointmentsByVehicleIdWithLimit($vehicleId, $limit, $start);
				if ($res) {
					echo json_encode(array('status' => TRUE, "data" => $res, "total" => $totalData));
				} else {
					echo json_encode(array('status' => TRUE, "data" => []));
				}
			} else {
				echo json_encode(array('status' => FALSE, 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => FALSE, 'message' => 'Auth token is required'));
		}
	}

	public function getPriceRequestByVehicleId()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idDriver = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {
				$start = $this->input->post('start');
				$limit = $this->input->post('limit');
				$vehicleId = $this->input->post('vehicle_id');
				$totalData = $this->Manage_product->getAllPriceRequestByVehicleId($vehicleId);
				$res = $this->Manage_product->getAllPriceRequestByVehicleIdWithLimit($vehicleId, $limit, $start);
				if ($res) {
					echo json_encode(array('status' => TRUE, "data" => $res, "total" => $totalData));
				} else {
					echo json_encode(array('status' => TRUE, "data" => []));
				}
			} else {
				echo json_encode(array('status' => FALSE, 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => FALSE, 'message' => 'Auth token is required'));
		}
	}

	function getCouponByCode()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		// print_r($splitStr);
		// die();

		if (count($splitStr) > 1) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$code = $this->input->post('code');


				$res = $this->Manage_product->getCouponByCode($code);
				if (count($res) > 0) {
					echo json_encode(array('status' => "ok", 'data' => $res));
				} else {
					echo json_encode(array('status' => "error", 'msg' => 'No coupon found'));
				}
			} else {
				echo json_encode(array('status' => "error", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "error", 'message' => 'Auth token is required'));
		}
	}


	function getPaymentDetails()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		// print_r($splitStr);
		// die();

		if (count($splitStr) > 1) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$res = $this->Manage_product->getPaymentByUser($idUser);
				if (count($res) > 0) {
					echo json_encode(array('status' => "ok", 'data' => $res));
				} else {
					echo json_encode(array('status' => "error", 'msg' => 'No Details Found'));
				}
			} else {
				echo json_encode(array('status' => "error", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "error", 'message' => 'Auth token is required'));
		}
	}

	function getPriceOfBooking()
	{

		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (count($splitStr) > 1) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {
			} else {
				echo json_encode(array('status' => "error", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "error", 'message' => 'Auth token is required'));
		}
	}

	public function getServicesApp()
	{

		try {

			$services = $this->Manage_product->getServices();

			echo json_encode(array('status' => "ok", "data" => $services));
		} catch (Exception $e) {
			echo json_encode(array('status' => "error", "error" => $e));
		}
	}

	public function deletePickupImage()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$id = $this->input->post('id');


				$data = $this->Manage_product->deletePickupImage($id);

				if ($data == 1) {
					echo json_encode(array('status' => 'success', "msg" => "Deleted Success"));
				} else {
					echo json_encode(array('status' => 'error', "msg" => "Error On  Deletion.."));
				}
			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}

	public function deleteDropImage()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$id = $this->input->post('id');


				$data = $this->Manage_product->deleteDropImage($id);

				if ($data == 1) {
					echo json_encode(array('status' => 'success', "msg" => "Deleted Success"));
				} else {
					echo json_encode(array('status' => 'error', "msg" => "Error On  Deletion.."));
				}
			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}

	public function deleteCarDropImage()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {
				$id = $this->input->post('id');


				$data = $this->Manage_product->deleteCarDropImage($id);

				if ($data == 1) {
					echo json_encode(array('status' => 'success', "msg" => "Deleted Success"));
				} else {
					echo json_encode(array('status' => 'error', "msg" => "Error On  Deletion.."));
				}
			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}

	public function deleteCarPickupImage()
	{
		$authStr = $this->input->request_headers();
		$splitStr = explode(" ", $authStr['Authorization']);

		if (!empty($splitStr)) {

			$verify = $this->verifyToken($splitStr[1]);
			$idUser = $this->encryption->decrypt($splitStr[1]);

			if ($verify) {

				$id = $this->input->post('id');


				$data = $this->Manage_product->deleteCarPickupImage($id);

				if ($data == 1) {
					echo json_encode(array('status' => 'success', "msg" => "Deleted Success"));
				} else {
					echo json_encode(array('status' => 'error', "msg" => "Error On  Deletion.."));
				}
			} else {
				echo json_encode(array('status' => "ok", 'message' => 'User is Unauthorized.'));
			}
		} else {
			echo json_encode(array('status' => "ok", 'message' => 'Auth token is required'));
		}
	}


	function getAccessToken($serviceAccountPath)
	{
		// $client = new Client();
		// $client->setAuthConfig($serviceAccountPath);
		// $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
		// $client->useApplicationDefaultCredentials();
		// $token = $client->fetchAccessTokenWithAssertion();
		// return $token['access_token'];
        return "";
	}

	function sendMessage($accessToken, $projectId, $message)
	{
		$url = 'https://fcm.googleapis.com/v1/projects/' . $projectId . '/messages:send';
		$headers = [
			'Authorization: Bearer ' . $accessToken,
			'Content-Type: application/json',
		];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['message' => $message]));
		$response = curl_exec($ch);
		if ($response === false) {
			throw new Exception('Curl error: ' . curl_error($ch));
		}
		curl_close($ch);
		return json_decode($response, true);
	}

	function sendNotification()
	{

		$token = $this->input->post('token');

		// $getUser = $this->Manage_product->getUserById();
		$serviceAccountPath = APPPATH . 'libraries/vahan-81416-55634a9d101c.json';

		// Your Firebase project ID
		$projectId = 'vahan-81416';

		// Example message payload
		$message = [
			'token' => $token,
			'notification' => [
				'title' => 'New-Enquiry',
				'body' => 'You have a new enquiry for vehicle',
			],
			'data' => ['userId' => '42', 'enqId' => '10', 'enqType' => 'Simple']
		];
		try {
			$accessToken = $this->getAccessToken($serviceAccountPath);
			$response = $this->sendMessage($accessToken, $projectId, $message);
			echo 'Message sent successfully: ' . print_r($response, true);
		} catch (Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}

	// function testNotification(){
	//  $not = $this->sendNotificationEnquiry('10','2','Simple');
	//  print_r($not);
	// }

	function sendNotificationEnquiry($userId, $enqId, $enqType, $enqData)
	{

		$getUser = $this->Manage_product->getUserById($userId);
		if (!empty($getUser[0]['device_token'])) {
			$serviceAccountPath = APPPATH . 'libraries/vahan-81416-55634a9d101c.json';

			// Your Firebase project ID
			$projectId = 'vahan-81416';

			// Example message payload
			$message = [
				'token' => $getUser[0]['device_token'],
				'notification' => [
					'title' => 'New-Enquiry',
					'body' => 'You have a new enquiry for vehicle',
				],
				'data' => ['userId' => "$userId", 'enqId' => "$enqId", 'enqType' => $enqType, 'enqData' => $enqData]
			];

			// print_r($message);
			// die();

			try {
				$accessToken = $this->getAccessToken($serviceAccountPath);
				$response = $this->sendMessage($accessToken, $projectId, $message);
				// echo 'Message sent successfully: ' . print_r($response, true);
			} catch (Exception $e) {
				echo 'Error: ' . $e->getMessage();
			}
		}
	}

	function sendNotificationCustomEnquiry($city, $enqId, $enqType)
	{

		$getUser = $this->Manage_product->getDealerByCity($city);

		foreach ($getUser as $user) {

			if (!empty($user['device_token'])) {
				$serviceAccountPath = APPPATH . 'libraries/vahan-81416-55634a9d101c.json';

				// Your Firebase project ID
				$projectId = 'vahan-81416';

				// Example message payload
				$message = [
					'token' => $user['device_token'],
					'notification' => [
						'title' => 'New-Enquiry',
						'body' => 'You have a new enquiry for vehicle',
					],
					'data' => ['userId' => "$userId", 'enqId' => "$enqId", 'enqType' => $enqType]
				];
				try {
					$accessToken = $this->getAccessToken($serviceAccountPath);
					$response = $this->sendMessage($accessToken, $projectId, $message);
					// echo 'Message sent successfully: ' . print_r($response, true);
				} catch (Exception $e) {
					echo 'Error: ' . $e->getMessage();
				}
			}
		}
	}
}
