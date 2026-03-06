<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Main_con extends CI_Controller {

		public function __construct()

		{

			parent::__construct();

			$this->load->helper(array('form', 'url'));

			$this->load->model('Manage_product');

		$this->load->library('session');

			$this->load->library('pagination');

			

		}



	public function index()

	{

		$this->load->view('home');

	}

	public function login()

	{

		$this->load->view('login');

	}

public function add_product()

	{

		$this->load->view('add_product');

	}

public function add_category()

	{

		$this->load->view('add_category');

	}



public function add_subcategory()

	{

		$this->load->view('add_subcategory');

	}

public function view_category()

	{

		$config = array();
       	$config["base_url"] = base_url()."Main_con/view_category";
        $config["total_rows"] = $this->Manage_product->getAllCategorys();
        $config["per_page"] = 5;

		$config['full_tag_open'] = "<ul class='pagination justify-content-start'>";
		$config['full_tag_close'] = "</ul";
		$config['next_tag_open'] = " <li class='list-inline-item page-item disabled'>";
		$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['prev_tag_close'] = "</li>";
		$config['num_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = "<li class='list-inline-item page-item'><a class='active'>";
		$config['cur_tag_close'] = "<span class='sr-only'>(current)</span></a></li>";
		$config['attributes'] = array('class' => '');
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();

        $data['categorys'] = $this->Manage_product->getAllCatsWithLimit($config['per_page'], $page);

        $this->load->view('view_category', $data);

		// $this->load->view('view_category');

	}

public function add_slider()

	{

		$this->load->view('add_slider');

	}

public function view_slider()

	{

		$this->load->view('view_slider');

	}

public function add_page()

	{

		$this->load->view('add_page');

	}

public function view_page()

	{
		$config = array();
		$config["base_url"] = base_url()."Main_con/view_page";
	 $config["total_rows"] = $this->Manage_product->getAllPages();
	 $config["per_page"] = 5;

	 $config['full_tag_open'] = "<ul class='pagination justify-content-start'>";
	 $config['full_tag_close'] = "</ul";
	 $config['next_tag_open'] = " <li class='list-inline-item page-item disabled'>";
	 $config['next_tag_close'] = "</li>";
	 $config['prev_tag_open'] = " <li class='list-inline-item page-item'>";
	 $config['prev_tag_close'] = "</li>";
	 $config['num_tag_open'] = " <li class='list-inline-item page-item'>";
	 $config['num_tag_close'] = "</li>";
	 $config['cur_tag_open'] = "<li class='list-inline-item page-item'><a class='active'>";
	 $config['cur_tag_close'] = "<span class='sr-only'>(current)</span></a></li>";
	 $config['attributes'] = array('class' => '');
	 $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

	 $this->pagination->initialize($config);

	 $data["links"] = $this->pagination->create_links();

	 $data['pages'] = $this->Manage_product->getAllPageWithLimit($config['per_page'], $page);

	 $this->load->view('view_page', $data);

	}



public function view_subcategory()

	{

		$this->load->view('view_subcategory');

	}



public function view_product()

	{

		$this->load->view('view_product');

	}
	public function orders()

	{

		$this->load->view('orders');

	}
	public function orderdetails()

	{

		$this->load->view('order_details');

	}
	public function insuranceorderdetails()

	{

		$this->load->view('insurance_order_details');

	}
	public function inspectionorderdetails()

	{

		$this->load->view('inspection_order_details');

	}
	public function inspectionreport()

	{

		$this->load->view('inspection_report');

	}
	public function towingorderdetails()

	{

		$this->load->view('towing_order_details');

	}
public function add_testimonial()

	{

		$this->load->view('add_testimonial');

	}
public function customers()

	{

		$this->load->view('customers');

	}

public function add_coupon()

	{

		$this->load->view('add_coupon');

	}

public function view_review()

	{

		$this->load->view('view_review');

	}
//////////////addd
public function add_shop()

	{

		$this->load->view('add_shop');

	}
public function view_shop()

	{

		$this->load->view('view_shop');

	}
public function add_emp()

	{

		$this->load->view('add_emp');

	}
public function view_emp()

	{

		$this->load->view('view_emp');

	}
public function add_splace()

	{

		$this->load->view('add_splace');

	}
public function add_counter()

	{

		$this->load->view('add_counter');

	}
public function view_counter()

	{

		$this->load->view('view_counter');

	}

public function add_society()

	{

		$this->load->view('add_society');

	}

	public function view_enquiry()

	{

		$config = array();
		$config["base_url"] = base_url()."Main_con/view_enquiry";
        $config["total_rows"] = $this->Manage_product->getAllEnquirys();
        $config["per_page"] = 5;

		$config['full_tag_open'] = "<ul class='pagination justify-content-start'>";
		$config['full_tag_close'] = "</ul";
		$config['next_tag_open'] = " <li class='list-inline-item page-item disabled'>";
		$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['prev_tag_close'] = "</li>";
		$config['num_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = "<li class='list-inline-item page-item'><a class='active'>";
		$config['cur_tag_close'] = "<span class='sr-only'>(current)</span></a></li>";
		$config['attributes'] = array('class' => '');

        $this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["links"] = $this->pagination->create_links();

        $data['enquirys'] = $this->Manage_product->getAllEnqWithLimit($config['per_page'], $page);

        $this->load->view('view_enquiry', $data);

	}

	public function view_booking()

	{

		$getData = $this->Manage_product->getAllDBookings();
		$config = array();
		$config["base_url"] = base_url()."Main_con/view_booking";
        $config["total_rows"] = count($getData);
        $config["per_page"] = 10;

		$config['full_tag_open'] = "<ul class='pagination justify-content-start'>";
		$config['full_tag_close'] = "</ul";
		$config['next_tag_open'] = " <li class='list-inline-item page-item disabled'>";
		$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['prev_tag_close'] = "</li>";
		$config['num_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = "<li class='list-inline-item page-item'><a class='active'>";
		$config['cur_tag_close'] = "<span class='sr-only'>(current)</span></a></li>";
		$config['attributes'] = array('class' => '');

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();

        $data['bookings'] = $this->Manage_product->getAllBookWithLimit($config['per_page'], $page);

        $this->load->view('view_booking', $data);

	}


	public function driver_booking()

	{

		$getData = $this->Manage_product->getAllVBookings();

		$config = array();
		$config["base_url"] = base_url()."Main_con/driver_booking";
        $config["total_rows"] = count($getData);
        $config["per_page"] = 10;

		$config['full_tag_open'] = "<ul class='pagination justify-content-start'>";
		$config['full_tag_close'] = "</ul";
		$config['next_tag_open'] = " <li class='list-inline-item page-item disabled'>";
		$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['prev_tag_close'] = "</li>";
		$config['num_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = "<li class='list-inline-item page-item'><a class='active'>";
		$config['cur_tag_close'] = "<span class='sr-only'>(current)</span></a></li>";
		$config['attributes'] = array('class' => '');

        $this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["links"] = $this->pagination->create_links();

        $data['vBookings'] = $this->Manage_product->getAllVBookWithLimit($config['per_page'], $page);

        $this->load->view('driver_booking', $data);

	}
	public function inspection_booking()

	{

		$getData = $this->Manage_product->getAllINSPBookings();

		$config = array();
		$config["base_url"] = base_url()."Main_con/inspection_booking";
        $config["total_rows"] = count($getData);
        $config["per_page"] = 10;

		$config['full_tag_open'] = "<ul class='pagination justify-content-start'>";
		$config['full_tag_close'] = "</ul";
		$config['next_tag_open'] = " <li class='list-inline-item page-item disabled'>";
		$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['prev_tag_close'] = "</li>";
		$config['num_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = "<li class='list-inline-item page-item'><a class='active'>";
		$config['cur_tag_close'] = "<span class='sr-only'>(current)</span></a></li>";
		$config['attributes'] = array('class' => '');

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();

        $data['vBookings'] = $this->Manage_product->getAllINSPWithLimit($config['per_page'], $page);

        $this->load->view('inspection_booking', $data);

	}
	public function towing_booking()

	{

		$getData = $this->Manage_product->getAlltowingBookings();

		$config = array();
		$config["base_url"] = base_url()."Main_con/towing_booking";
        $config["total_rows"] = count($getData);
        $config["per_page"] = 10;

		$config['full_tag_open'] = "<ul class='pagination justify-content-start'>";
		$config['full_tag_close'] = "</ul";
		$config['next_tag_open'] = " <li class='list-inline-item page-item disabled'>";
		$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['prev_tag_close'] = "</li>";
		$config['num_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = "<li class='list-inline-item page-item'><a class='active'>";
		$config['cur_tag_close'] = "<span class='sr-only'>(current)</span></a></li>";
		$config['attributes'] = array('class' => '');

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();

        $data['vBookings'] = $this->Manage_product->getAlltowingWithLimit($config['per_page'], $page);

        $this->load->view('towing_booking', $data);

	}

	public function rto_booking()

	{

		$getData = $this->Manage_product->getAllrtoBookings();

		$config = array();
		$config["base_url"] = base_url()."Main_con/rto_booking";
        $config["total_rows"] = count($getData);
        $config["per_page"] = 10;

		$config['full_tag_open'] = "<ul class='pagination justify-content-start'>";
		$config['full_tag_close'] = "</ul";
		$config['next_tag_open'] = " <li class='list-inline-item page-item disabled'>";
		$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['prev_tag_close'] = "</li>";
		$config['num_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = "<li class='list-inline-item page-item'><a class='active'>";
		$config['cur_tag_close'] = "<span class='sr-only'>(current)</span></a></li>";
		$config['attributes'] = array('class' => '');

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();

        $data['vBookings'] = $this->Manage_product->getAllrtoWithLimit($config['per_page'], $page);

        $this->load->view('rto_booking', $data);

	}

	public function insurance_booking()

	{
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$getData = $this->Manage_product->getAllinsuranceBookings();

		$config = array();
		$config["base_url"] = base_url()."Main_con/insurance_booking";
        $config["total_rows"] = count($getData);
        $config["per_page"] = 10;

		$config['full_tag_open'] = "<ul class='pagination justify-content-start'>";
		$config['full_tag_close'] = "</ul";
		$config['next_tag_open'] = " <li class='list-inline-item page-item disabled'>";
		$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['prev_tag_close'] = "</li>";
		$config['num_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = "<li class='list-inline-item page-item'><a class='active'>";
		$config['cur_tag_close'] = "<span class='sr-only'>(current)</span></a></li>";
		$config['attributes'] = array('class' => '');

        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();

        $data['vBookings'] = $this->Manage_product->getAllinsuranceWithLimit($config['per_page'], $page);

        $this->load->view('insurance_booking', $data);

	}

	public function add_booking()

	{

		$this->load->view('add_booking');

	}

	public function add_banner()

	{

		$this->load->view('add_banner');

	}

	public function view_banner()

	{

		$this->load->view('view_banner');

	}

	public function add_services()

	{

		$this->load->view('add_services');

	}

	public function view_services()

	{

		$this->load->view('view_services');

	}

	public function add_car_brand()

	{

		$this->load->view('add_car_brand');

	}

	public function view_car_brand()

	{

		$this->load->view('view_car_brand');

	}

	public function add_car_model()

	{

		$this->load->view('add_car_model');

	}

	public function view_car_model()

	{

		$this->load->view('view_car_model');

	}

	public function add_driver()

	{

		$this->load->view('add_driver');

	}

	public function add_user()

	{

		$this->load->view('add_user');

	}

	// public function view_dealers()

	// {

	// 	$this->load->view('view_dealers');

	// }

	public function view_dealers()

	{
		$config = array();
		$config["base_url"] = base_url()."Main_con/view_dealers";
	 $config["total_rows"] = $this->Manage_product->getAllDealers();
	 $config["per_page"] = 10;

	 $config['full_tag_open'] = "<ul class='pagination justify-content-start'>";
	 $config['full_tag_close'] = "</ul";
	 $config['next_tag_open'] = " <li class='list-inline-item page-item disabled'>";
	 $config['next_tag_close'] = "</li>";
	 $config['prev_tag_open'] = " <li class='list-inline-item page-item'>";
	 $config['prev_tag_close'] = "</li>";
	 $config['num_tag_open'] = " <li class='list-inline-item page-item'>";
	 $config['num_tag_close'] = "</li>";
	 $config['cur_tag_open'] = "<li class='list-inline-item page-item'><a class='active'>";
	 $config['cur_tag_close'] = "<span class='sr-only'>(current)</span></a></li>";
	 $config['attributes'] = array('class' => '');
	 $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

	 $this->pagination->initialize($config);

	 $data["links"] = $this->pagination->create_links();

	 $data['dealers'] = $this->Manage_product->getAllDealersWithLimit($config['per_page'], $page);

	 $this->load->view('view_dealers', $data);

	}

	// 	public function view_dealer_cars()

	// {

	// 	$this->load->view('view_dealer_cars');

	// }

	public function view_dealer_cars($dealerId)

	{
		$config = array();
		$config["base_url"] = base_url()."Main_con/view_dealer_cars/$dealerId";
	 $config["total_rows"] = $this->Manage_product->getAllDealersCarsByDealerId($dealerId);
	 $config["per_page"] = 10;

	 $config['full_tag_open'] = "<ul class='pagination justify-content-start'>";
	 $config['full_tag_close'] = "</ul";
	 $config['next_tag_open'] = " <li class='list-inline-item page-item disabled'>";
	 $config['next_tag_close'] = "</li>";
	 $config['prev_tag_open'] = " <li class='list-inline-item page-item'>";
	 $config['prev_tag_close'] = "</li>";
	 $config['num_tag_open'] = " <li class='list-inline-item page-item'>";
	 $config['num_tag_close'] = "</li>";
	 $config['cur_tag_open'] = "<li class='list-inline-item page-item'><a class='active'>";
	 $config['cur_tag_close'] = "<span class='sr-only'>(current)</span></a></li>";
	 $config['attributes'] = array('class' => '');

	 $this->pagination->initialize($config);

	 $data["links"] = $this->pagination->create_links();

	 $data['dealers_cars'] = $this->Manage_product->getAllDealersCarsByDealerIdWithLimit($dealerId,$this->uri->segment(4),$config['per_page']);

	 $this->load->view('view_dealer_cars', $data);

	}

	// 	public function view_dealer_enquiry()

	// {

	// 	$this->load->view('view_dealer_enquiry');

	// }

	public function view_dealer_enquiry($dealerId)

	{
		$config = array();
		$config["base_url"] = base_url()."Main_con/view_dealer_enquiry/$dealerId";
	 $config["total_rows"] = $this->Manage_product->getAllDealersCEnquiryByDealerId($dealerId);
	 $config["per_page"] = 10;

	 $config['full_tag_open'] = "<ul class='pagination justify-content-start'>";
	 $config['full_tag_close'] = "</ul";
	 $config['next_tag_open'] = " <li class='list-inline-item page-item disabled'>";
	 $config['next_tag_close'] = "</li>";
	 $config['prev_tag_open'] = " <li class='list-inline-item page-item'>";
	 $config['prev_tag_close'] = "</li>";
	 $config['num_tag_open'] = " <li class='list-inline-item page-item'>";
	 $config['num_tag_close'] = "</li>";
	 $config['cur_tag_open'] = "<li class='list-inline-item page-item'><a class='active'>";
	 $config['cur_tag_close'] = "<span class='sr-only'>(current)</span></a></li>";
	 $config['attributes'] = array('class' => '');

	 $this->pagination->initialize($config);

	 $data["links"] = $this->pagination->create_links();

	 $data['dealers_custom_enquiry'] = $this->Manage_product->getAllDealersCEnquiryByDealerIdWithLimit($dealerId,$this->uri->segment(4),$config['per_page']);

	 $this->load->view('view_dealer_enquiry', $data);

	}

	public function view_user()

	{

		$data = $this->Manage_product->getAllUsers();
		// print_r(count($data));
		// die();
		$config = array();
		$config["base_url"] = base_url()."Main_con/view_user";
        $config["total_rows"] = count($data);
        $config["per_page"] = 10;

		$config['full_tag_open'] = "<ul class='pagination justify-content-start'>";
		$config['full_tag_close'] = "</ul";
		$config['next_tag_open'] = " <li class='list-inline-item page-item disabled'>";
		$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['prev_tag_close'] = "</li>";
		$config['num_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = "<li class='list-inline-item page-item'><a class='active'>";
		$config['cur_tag_close'] = "<span class='sr-only'>(current)</span></a></li>";
		$config['attributes'] = array('class' => '');

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();

        $data['users'] = $this->Manage_product->getAllUsersWithLimit($config['per_page'], $page);

        $this->load->view('view_user', $data);

	}

	public function view_driver()

	{

		$data = $this->Manage_product->getAllDrivers();
		// print_r($data);
		$config = array();
		$config["base_url"] = base_url()."Main_con/view_driver";
        $config["total_rows"] = count($data);
        $config["per_page"] = 5;

		$config['full_tag_open'] = "<ul class='pagination justify-content-start'>";
		$config['full_tag_close'] = "</ul";
		$config['next_tag_open'] = " <li class='list-inline-item page-item disabled'>";
		$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['prev_tag_close'] = "</li>";
		$config['num_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = "<li class='list-inline-item page-item'><a class='active'>";
		$config['cur_tag_close'] = "<span class='sr-only'>(current)</span></a></li>";
		$config['attributes'] = array('class' => '');

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();

        $data['drivers'] = $this->Manage_product->getAllDriversWithLimit($config['per_page'], $page);

        $this->load->view('view_driver', $data);

	}

	public function add_vehicle()

	{

		$this->load->view('add_vehicle');

	}


	public function view_vehicle()

	{

		$config = array();
		$config["base_url"] = base_url()."Main_con/view_vehicle";
        $config["total_rows"] = $this->Manage_product->getAllVehicles();
        $config["per_page"] = 5;

		$config['full_tag_open'] = "<ul class='pagination justify-content-start'>";
		$config['full_tag_close'] = "</ul";
		$config['next_tag_open'] = " <li class='list-inline-item page-item disabled'>";
		$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['prev_tag_close'] = "</li>";
		$config['num_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = "<li class='list-inline-item page-item'><a class='active'>";
		$config['cur_tag_close'] = "<span class='sr-only'>(current)</span></a></li>";
		$config['attributes'] = array('class' => '');

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();

        $data['vehicles'] = $this->Manage_product->getAllVehiclesWithLimit($config['per_page'], $page);

        $this->load->view('view_vehicle', $data);

	}

	public function add_packages()

	{

		$this->load->view('add_packages');

	}

	public function view_packages()

	{

		$this->load->view('view_packages');

	}

	public function add_city()

	{

		$this->load->view('add_city');

	}

	public function view_city()

	{

		// $this->load->view('view_city');

		$config = array();
		$config["base_url"] = base_url()."Main_con/view_city";
        $config["total_rows"] = $this->Manage_product->getAllCity();
        $config["per_page"] = 5;

		$config['full_tag_open'] = "<ul class='pagination justify-content-start'>";
		$config['full_tag_close'] = "</ul";
		$config['next_tag_open'] = " <li class='list-inline-item page-item disabled'>";
		$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['prev_tag_close'] = "</li>";
		$config['num_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = "<li class='list-inline-item page-item'><a class='active'>";
		$config['cur_tag_close'] = "<span class='sr-only'>(current)</span></a></li>";
		$config['attributes'] = array('class' => '');

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();

        $data['cities'] = $this->Manage_product->getAllCityWithLimit($config['per_page'], $page);

        $this->load->view('view_city', $data);

	}

	public function add_state()

	{

		$this->load->view('add_state');

	}

	public function view_state()

	{

		// $this->load->view('view_state');
		
		$config = array();
		$config["base_url"] = base_url()."Main_con/view_state";
        $config["total_rows"] = $this->Manage_product->getAllStatesp();
        $config["per_page"] = 5;

		$config['full_tag_open'] = "<ul class='pagination justify-content-start'>";
		$config['full_tag_close'] = "</ul";
		$config['next_tag_open'] = " <li class='list-inline-item page-item disabled'>";
		$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['prev_tag_close'] = "</li>";
		$config['num_tag_open'] = " <li class='list-inline-item page-item'>";
		$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = "<li class='list-inline-item page-item'><a class='active'>";
		$config['cur_tag_close'] = "<span class='sr-only'>(current)</span></a></li>";
		$config['attributes'] = array('class' => '');
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();

        $data['states'] = $this->Manage_product->getAllStatespWithLimit($config['per_page'], $page);

        $this->load->view('view_state', $data);

	}

}

