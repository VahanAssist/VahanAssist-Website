<?php
defined('BASEPATH') or exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require_once(APPPATH . "libraries/razor-pay/Razorpay.php");

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class Payment extends CI_Controller
{
	/**
	 * This function loads the registration form
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Manage_product');
		$this->load->library('session');
	}

	/**
	 * This function creates order and loads the payment methods
	 */

	public function createPaymentId()
	{

		$userId = $this->input->post('user_id');
		$packageId = $this->input->post('package_id');

		$getPackage = $this->Manage_product->getSubscriptionById($packageId);
		
		if(empty($getPackage)) {
			echo json_encode(array('status' => 'error', 'msg' => 'Invalid Package Selected!'));
			return;
		}

		$amount = intval($getPackage[0]['price']);

		$api = new Api('rzp_live_SJ4vZVaVQgQY12', 'UfzHMM81gfApr2hn1XrcwN26');

		$razorpayOrder = $api->order->create(array(
			'receipt'         => "VH".rand(),
			'amount'          => $amount * 100, // 2000 rupees in paise
			'currency'        => 'INR',
			'payment_capture' => 1 // auto capture
		));
		$razorpayOrderId = $razorpayOrder['id'];

		$data['package_id'] = $packageId;
		$data['user_id'] = $userId;
		$data['order_id'] = $razorpayOrderId;
		$data['status'] = 'Pending';


		$getUser = $this->Manage_product->getUserById($userId);
		$res = $this->Manage_product->insertPayment($data);

		if(empty($getUser)) {
			echo json_encode(array('status' => 'error', 'msg' => 'User not found!'));
			return;
		}

		$reponseArr['name'] = $getUser[0]['firstName'];
		$reponseArr['email'] = $getUser[0]['email'];
		$reponseArr['phoneNumber'] = $getUser[0]['phoneNumber'];
		$reponseArr['amount'] = $amount;
		$reponseArr['order_id'] = $razorpayOrderId;

		if ($res == 1) {
			echo json_encode(array('status' => 'success', 'msg' => 'Order Id Created', 'data' => $reponseArr));
		} else {
			echo json_encode(array('status' => 'error', 'msg' => 'Something went wrong, Try Again!'));
		}
	}


	public function verifyRazorPayment(){

		$order_id = $this->input->post('razorpay_order_id');
		$payment_id = $this->input->post('razorpay_payment_id');
		$signature = $this->input->post('razorpay_signature');

		$success = true;
		if (empty($_POST['razorpay_payment_id']) === false) {
			$api = new Api('rzp_live_SJ4vZVaVQgQY12', 'UfzHMM81gfApr2hn1XrcwN26');
			try {
				$attributes = array(
					'razorpay_order_id' => $order_id,
					'razorpay_payment_id' => $payment_id,
					'razorpay_signature' => $signature
				);
				$api->utility->verifyPaymentSignature($attributes);
			} catch (SignatureVerificationError $e) {
				$success = false;
			}
		}
		if ($success === true) {
			
			$getPaymentInfo = $this->Manage_product->getPaymentByOrderId($order_id);
			$data['payment_id'] = $payment_id;
			$data['status'] = 'Completed';

			$res = $this->Manage_product->updatePayment($getPaymentInfo[0]['id'],$data);
			if($res == 1){
				echo json_encode(array('status'=>'success','msg'=>'Payment Completed!'));
			}
			else{
				echo json_encode(array('status'=>'error','msg'=>'Internal Db Error!!'));

			}

		} else {
			echo json_encode(array('status'=>'error','msg'=>'Payment Not Verified!!'));
		
		}
      
	}


	public function pay()
	{
		$api = new Api('rzp_live_SJ4vZVaVQgQY12', 'UfzHMM81gfApr2hn1XrcwN26');

		/**
		 * You can calculate payment amount as per your logic
		 * Always set the amount from backend for security reasons
		 */

		$razorpayOrder = $api->order->create(array(
			'receipt'         => rand(),
			'amount'          => $_SESSION['payable_amount'] * 100, // 2000 rupees in paise
			'currency'        => 'INR',
			'payment_capture' => 1 // auto capture
		));


		$amount = $razorpayOrder['amount'];

		$razorpayOrderId = $razorpayOrder['id'];

		$_SESSION['razorpay_order_id'] = $razorpayOrderId;
		$_SESSION['order_db_id'] = $orderId;

		$data = $this->prepareData($amount, $razorpayOrderId);

		$this->load->view('rezorpay', array('data' => $data));
	}

	/**
	 * This function verifies the payment,after successful payment
	 */
	public function verify()
	{
		$success = true;
		$error = "payment_failed";
		if (empty($_POST['razorpay_payment_id']) === false) {
			$api = new Api('rzp_live_SJ4vZVaVQgQY12', 'UfzHMM81gfApr2hn1XrcwN26');
			try {
				$attributes = array(
					'razorpay_order_id' => $_SESSION['razorpay_order_id'],
					'razorpay_payment_id' => $_POST['razorpay_payment_id'],
					'razorpay_signature' => $_POST['razorpay_signature']
				);
				$api->utility->verifyPaymentSignature($attributes);
			} catch (SignatureVerificationError $e) {
				$success = false;
				$error = 'Razorpay_Error : ' . $e->getMessage();
			}
		}
		if ($success === true) {
			/**
			 * Call this function from where ever you want
			 * to save save data before of after the payment
			//  */

			// redirect(base_url().'success');

		} else {
			// redirect(base_url().'paymentFailed');
		}
	}

	/**
	 * This function preprares payment parameters
	 * @param $amount
	 * @param $razorpayOrderId
	 * @return array
	 */
	public function prepareData($amount, $razorpayOrderId)
	{
		$getUser = $this->User_model->getUsers($_SESSION['login_id']);
		$data = array(
			"key" => 'rzp_live_SJ4vZVaVQgQY12',
			"amount" => $amount,
			"name" => "DUKANSE",
			"description" => "Best Shops",
			"image" => "https://dukanse.in/img/logo-icon.png",
			"prefill" => array(
				"name"  => $getUser[0]['name'],
				"email"  => $getUser[0]['email'],
				"contact" => $getUser[0]['phoneNumber'],
			),
			"notes"  => array(
				"address"  => "Testing",
				// "merchant_order_id" => rand(),
			),
			"theme"  => array(
				"color"  => "#F37254"
			),
			"order_id" => $razorpayOrderId,
		);
		return $data;
	}

	/**
	 * This function saves your form data to session,
	 * After successfull payment you can save it to database
	 */
	// public function setRegistrationData()
	// {
	// 	$getUser = $this->User_model->getUsers($_SESSION['login_id']);

	// 	$name = $getUser[0]['name'];
	// 	$email = $getUser[0]['email'];
	// 	$contact = $getUser[0]['phoneNumber'];
	// 	$amount = $_SESSION['payable_amount'];

	// 	$registrationData = array(
	// 		'order_id' => $_SESSION['order_db_id'],
	// 		'user_id'=> $_SESSION['login_id'],
	// 		'name' => $name,
	// 		'email' => $email,
	// 		'phoneNumber' => $contact,
	// 		'amount' => $amount,
	// 		'razor_pay_order_id'=>$_SESSION['razorpay_order_id']
	// 	);
	// 	// save this to database

	// 	// print_r($registrationData);

	// 	$logData['payment_type'] = $_SESSION['payment_type'];

	// 	$this->User_model->insertPaymentData($registrationData);
	// 	$this->User_model->updateOrderData($_SESSION['order_db_id']);
	// 	$this->User_model->updateOrders($_SESSION['order_db_id'],$logData);

	// }

}
