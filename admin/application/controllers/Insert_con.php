<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	class Insert_con extends CI_Controller
	{

		public function __construct()

		{
			header("Access-Control-Allow-Origin: *");
			header("Access-Control-Allow-Methods: PUT, GET, POST");
			header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

			parent::__construct();

			$this->load->helper(array('form', 'url'));

			$this->load->model('Manage_product');

			$this->load->model('App_model');

			$this->load->library('session');

			$this->load->library('encryption');
			// $this->load->library('email');
			$this->config->load('email');

			//$this->load->library('Cpdf');



		}

		////a 2 z new code 11-4-2020 Delivery////



		public function insertCategory()
		{

			//print_r($_FILES);

			$id  = empty($this->input->post('id')) ? '' : $this->input->post('id');
			$config['upload_path'] = './images/category_image/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
			$config['width']    = '150';
			$config['height']   = '150';
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

			// $data['r_id'] = empty($this->input->post('r_id')) ? '' :$this->input->post('r_id');
			$data['name'] = empty($this->input->post('name')) ? '' : $this->input->post('name');
			// $data['status'] = 1;
			// $data['slug'] = empty($this->input->post('slug')) ? '' :trim($this->input->post('slug'));
			// $data['description'] = empty($this->input->post('description')) ? '' :$this->input->post('description');
			// $data['meta_title'] = empty($this->input->post('meta_title')) ? '' :$this->input->post('meta_title');
			// $data['meta_keyword'] = empty($this->input->post('meta_keyword')) ? '' :$this->input->post('meta_keyword');
			// $data['meta_desc'] = empty($this->input->post('meta_desc')) ? '' :$this->input->post('meta_desc');

			if ($id == "") {
				$this->Manage_product->insertCategory($data);

				redirect(base_url() . "Main_con/view_category");
			} else {

				$this->Manage_product->updateCategory($id, $data);

				redirect(base_url() . "Main_con/view_category");
			}
		}
		public function insertSubCategory()
		{

			//print_r($_FILES);

			$id  = empty($this->input->post('id')) ? '' : $this->input->post('id');

			$config['upload_path'] = './images/subcategory_image/';

			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';

			$config['width']    = '150';

			$config['height']   = '150';

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

			$data['category_id'] = empty($this->input->post('category_id')) ? '' : $this->input->post('category_id');

			$data['subcategory_name'] = empty($this->input->post('subcategory_name')) ? '' : $this->input->post('subcategory_name');

			$data['description'] = empty($this->input->post('description')) ? '' : $this->input->post('description');
			$data['slug'] = empty($this->input->post('slug')) ? '' : $this->input->post('slug');





			if ($id == "") {



				$this->Manage_product->insertSubCategory($data);

				redirect(base_url() . "Main_con/view_subcategory");
			} else {



				$this->Manage_product->updateSubCategory($id, $data);

				redirect(base_url() . "Main_con/view_subcategory");
			}
		}



		public function insertProduct()
		{

			//print_r($_FILES);

			$id  = empty($this->input->post('id')) ? '' : $this->input->post('id');
			$config['upload_path'] = './images/product_image/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
			$config['width']    = '150';
			$config['height']   = '150';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('product_image')) {
				//echo "jj";
				$product_image	= 	$this->upload->data();
				$config['image_library'] = 'gd2';
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				//echo $this->image_lib->display_errors();
			} else {
				$this->upload->display_errors();
			}


			$data['product_image'] = empty($product_image['file_name']) ? '' : $product_image['file_name'];
			if ($data['product_image'] == "") {

				$data['product_image'] = empty($this->input->post('product_image_old')) ? '' : $this->input->post('product_image_old');
			}
			$data['category_id'] = empty($this->input->post('category_id')) ? '' : $this->input->post('category_id');
			$data['sub_category_id'] = empty($this->input->post('sub_category_id')) ? '' : $this->input->post('sub_category_id');
			$data['product_name'] = empty($this->input->post('product_name')) ? '' : $this->input->post('product_name');
			$data['product_price'] = empty($this->input->post('product_price')) ? '' : $this->input->post('product_price');
			$data['half_product_price'] = empty($this->input->post('half_product_price')) ? '' : $this->input->post('half_product_price');
			$data['dish_type'] = empty($this->input->post('dish_type')) ? '' : $this->input->post('dish_type');
			// $data['orginal_price'] = empty($this->input->post('orginal_price')) ? '' :$this->input->post('orginal_price');

			$data['product_quantity'] = empty($this->input->post('product_quantity')) ? '' : $this->input->post('product_quantity');
			$data['m_quantity'] = empty($this->input->post('m_quantity')) ? '' : $this->input->post('m_quantity');
			$data['r_id'] = empty($this->input->post('r_id')) ? '' : $this->input->post('r_id');



			// $data['unit'] = empty($this->input->post('unit')) ? '' :$this->input->post('unit');
			// $data['itemLength'] = empty($this->input->post('itemLength')) ? '' :$this->input->post('itemLength');
			// $data['itemWidth'] = empty($this->input->post('itemWidth')) ? '' :$this->input->post('itemWidth');
			// $data['itemHeight'] = empty($this->input->post('itemHeight')) ? '' :$this->input->post('itemHeight');
			// $data['itemWeight'] = empty($this->input->post('itemWeight')) ? '' :$this->input->post('itemWeight');
			$data['product_desc'] = empty($this->input->post('product_desc')) ? '' : $this->input->post('product_desc');
			$data['meta_title'] = empty($this->input->post('meta_title')) ? '' : $this->input->post('meta_title');
			$data['meta_keyword'] = empty($this->input->post('meta_keyword')) ? '' : $this->input->post('meta_keyword');
			$data['meta_desc'] = empty($this->input->post('meta_desc')) ? '' : $this->input->post('meta_desc');
			$data['slug'] = empty($this->input->post('slug')) ? '' : trim($this->input->post('slug'));


			if ($id == "") {
				$insertProduct = $this->Manage_product->insertProduct($data);
				/////////////////////////Bulk Upload House//////////////////////////
				$count =  count($_FILES['product_image1']['name']);
				///print_r($_FILES);
				for ($i = 0; $i < $count; $i++) { //loop to get 

					$_FILES['imageUp']['name'] = $_FILES['product_image1']['name'][$i];
					$_FILES['imageUp']['type'] = $_FILES['product_image1']['type'][$i];
					$_FILES['imageUp']['tmp_name'] = $_FILES['product_image1']['tmp_name'][$i];
					$_FILES['imageUp']['error'] = $_FILES['product_image1']['error'][$i];
					$_FILES['imageUp']['size'] = $_FILES['product_image1']['size'][$i];

					$config['upload_path'] = './images/product_image/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
					$config['width']    = '150';
					$config['height']   = '150';
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('imageUp')) {
						$image	= 	$this->upload->data();
						$log_image[$i]['image'] = empty($image['file_name']) ? '' : $image['file_name'];
						// $log_image[$i]['add_id']=empty($id) ? '' :$id; 
						$log_image[$i]['product_id'] = $insertProduct['last_id'];
						$log_image[$i]['color'] = $dataCo['color'][$i];
						// print_r();
						$msg  = $this->Manage_product->insertProductImage($log_image[$i]);
						$this->upload->display_errors();
					} else {

						$this->upload->display_errors();
					}
				}
				///////////////bluk upload///////////////

				redirect(base_url() . "Main_con/add_product");
			} else {

				/////////////////////////Bulk Upload House//////////////////////////
				$count =  count($_FILES['product_image1']['name']);
				//echo $_FILES['product_image1']['name'];
				// print_r($_FILES);
				for ($i = 0; $i < $count; $i++) { //loop to get 

					$_FILES['imageUp']['name'] = $_FILES['product_image1']['name'][$i];
					$_FILES['imageUp']['type'] = $_FILES['product_image1']['type'][$i];
					$_FILES['imageUp']['tmp_name'] = $_FILES['product_image1']['tmp_name'][$i];
					$_FILES['imageUp']['error'] = $_FILES['product_image1']['error'][$i];
					$_FILES['imageUp']['size'] = $_FILES['product_image1']['size'][$i];

					$config['upload_path'] = './images/product_image/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
					$config['width']    = '150';
					$config['height']   = '150';
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('imageUp')) {
						$image	= 	$this->upload->data();
						$log_image[$i]['image'] = empty($image['file_name']) ? '' : $image['file_name'];
						// $log_image[$i]['add_id']=empty($id) ? '' :$id; 
						$log_image[$i]['product_id'] = $id;
						//	 $log_image[$i]['color']=$dataCo['color'][$i];
						// print_r();
						$msg  = $this->Manage_product->insertProductImage($log_image[$i]);
						$this->upload->display_errors();
					} else {

						$this->upload->display_errors();
					}
					//	echo $i;        
				}
				///////////////bluk upload///////////////
				$this->Manage_product->updateProduct($id, $data);
				//print_r($_FILES);
				redirect(base_url() . "Main_con/view_product");
			}
		}

		public function insertSlider()
		{
			//print_r($_FILES);
			$id  = empty($this->input->post('id')) ? '' : $this->input->post('id');

			$config['upload_path'] = './images/slider/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
			$config['width']    = '150';
			$config['height']   = '150';
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
			$data['title'] = empty($this->input->post('title')) ? '' : $this->input->post('title');
			$data['content'] = empty($this->input->post('content')) ? '' : $this->input->post('content');

			if ($id == "") {
				$this->Manage_product->insertSlider($data);
				//echo "1000";
				redirect(base_url() . "Main_con/view_slider");
			} else {
				$this->Manage_product->updateSlider($id, $data);
				//echo "1002";
				redirect(base_url() . "Main_con/view_slider");
			}
		}
		public function insertSplace()
		{
			//print_r($_FILES);
			$id  = empty($this->input->post('id')) ? '' : $this->input->post('id');

			$config['upload_path'] = './images/splace/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
			$config['width']    = '150';
			$config['height']   = '150';
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
			$data['title'] = empty($this->input->post('title')) ? '' : $this->input->post('title');
			//	$data['content'] = empty($this->input->post('content')) ? '' :$this->input->post('content');

			if ($id == "") {
				$this->Manage_product->insertSplace($data);
				//echo "1000";
				redirect(base_url() . "Main_con/add_splace");
			} else {
				$this->Manage_product->updateSplace($id, $data);
				//echo "1002";
				redirect(base_url() . "Main_con/add_splace");
			}
		}


		public function getSubCatgByCatId()
		{

			$id = $_REQUEST['category_id'];



			$data = $this->Manage_product->getSubCatgByCatId($id);



			//echo json_encode($data);

		}

		public function deleteProduct($id)
		{

			$data = $this->Manage_product->deleteProduct($id);

			echo json_encode(array("status" => TRUE));
		}
		public function deleteTestimonial($id)
		{

			$data = $this->Manage_product->deleteTestimonial($id);

			echo json_encode(array("status" => TRUE));
		}
		public function deleteMultiImage()
		{

			$id = $_REQUEST['id'];
			$image = $_REQUEST['image'];
			//echo FCPATH."images/product_image/".$image;
			unlink(FCPATH . "images/product_image/" . $image);
			$data = $this->Manage_product->deleteMultiImage($id, $image);

			echo json_encode(array("status" => TRUE));
		}

		public function deleteCategory($id)
		{

			$data = $this->Manage_product->deleteCategory($id);

			echo json_encode(array("status" => TRUE));
		}

		public function deleteBooking($id)
		{

			$data = $this->Manage_product->deleteBooking($id);

			echo json_encode(array("status" => TRUE));
		}

		public function deleteSubCategory($id)
		{

			$data = $this->Manage_product->deleteSubCategory($id);

			echo "1000";
		}

		public function deleteSlider($id)
		{

			$data = $this->Manage_product->deleteSlider($id);

			echo json_encode(array("status" => TRUE));
		}
		public function updateOrder()
		{

			//print_r($_FILES);

			$id  = empty($this->input->post('order_id')) ? '' : $this->input->post('order_id');


			$data['name'] = empty($this->input->post('name')) ? '' : $this->input->post('name');
			$data['phone'] = empty($this->input->post('phone')) ? '' : $this->input->post('phone');
			$data['email'] = empty($this->input->post('email')) ? '' : $this->input->post('email');
			$data['address'] = empty($this->input->post('address')) ? '' : $this->input->post('address');
			$data['city'] = empty($this->input->post('city')) ? '' : $this->input->post('city');
			$data['state'] = empty($this->input->post('state')) ? '' : $this->input->post('state');
			$data['pin'] = empty($this->input->post('pin')) ? '' : $this->input->post('pin');
			$data['order_status'] = empty($this->input->post('order_status')) ? '' : $this->input->post('order_status');

			$this->Manage_product->updateOrder($id, $data);

			//redirect(base_url()."Main_con/order");
			//	$this->sendSms($data);
			echo 1000;
		}
		public function getSlug()
		{

			$product_name = $_REQUEST['product_name'];
			echo $slug = url_title($product_name, 'dash', true);
		}
		public function insertPage()
		{
			$id  = empty($this->input->post('id')) ? '' : $this->input->post('id');

			// 			$config['upload_path'] = './images/slider/';
			// 			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
			// 			$config['width']    = '150';
			// 			$config['height']   = '150';
			// 			$this->load->library('upload', $config);
			// 			$this->upload->initialize($config);
			// 			if($this->upload->do_upload('image')){
			// 			//echo "jj";
			// 			$image	= 	$this->upload->data();
			// 			$config['image_library']='gd2';
			// 			$this->load->library('image_lib',$config);
			// 			$this->image_lib->resize();
			// 			//echo $this->image_lib->display_errors();
			// 			}else{
			// 			$this->upload->display_errors();
			// 			}
			// $data['image'] = empty($image['file_name']) ? '' :$image['file_name'];
			// if ($data['image']=="") {
			// $data['image'] = empty($this->input->post('image_old')) ? '' :$this->input->post('image_old');
			// }
			$data['page_id'] = empty($this->input->post('page_id')) ? '' : $this->input->post('page_id');
			$data['title'] = empty($this->input->post('title')) ? '' : $this->input->post('title');
			$data['content'] = empty($this->input->post('content')) ? '' : $this->input->post('content');

			if ($id == "") {
				$this->Manage_product->insertPage($data);
				//echo "1000";
				redirect(base_url() . "Main_con/view_page");
			} else {
				$this->Manage_product->updatePage($id, $data);
				//echo "1002";
				redirect(base_url() . "Main_con/view_page");
			}
		}
		public function insertTestimonial()
		{
			//print_r($_FILES);
			$id  = empty($this->input->post('id')) ? '' : $this->input->post('id');

			$config['upload_path'] = './images/testimonial/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
			$config['width']    = '150';
			$config['height']   = '150';
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
			//$data['page_id'] = empty($this->input->post('page_id')) ? '' :$this->input->post('page_id');
			$data['name'] = empty($this->input->post('name')) ? '' : $this->input->post('name');
			$data['content'] = empty($this->input->post('content')) ? '' : $this->input->post('content');
			// $data['phone'] = empty($this->input->post('phone')) ? '' :$this->input->post('phone');
			// $data['email'] = empty($this->input->post('email')) ? '' :$this->input->post('email');
			// $data['address'] = empty($this->input->post('address')) ? '' :$this->input->post('address');
			// //$data['content'] = empty($this->input->post('content')) ? '' :$this->input->post('content');

			if ($id == "") {
				$this->Manage_product->insertTestimonial($data);
				//echo "1000";
				redirect(base_url() . "Main_con/add_testimonial");
			} else {
				$this->Manage_product->updateTestimonial($id, $data);
				//echo "1002";
				redirect(base_url() . "Main_con/add_testimonial");
			}
		}
		function donwloadOrders()
		{

			$from_date = empty($this->input->post('from_date')) ? '' : $this->input->post('from_date');
			$to_date = empty($this->input->post('to_date')) ? '' : $this->input->post('to_date');
			$output .= '
                <table border="2">
                     <tr>
                        <th>Order Id</th>
                        <th>Name </th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Phone</th>
               
                        
                        
                        
                     </tr>
           ';

			$getOrderBySelectDate = $this->Manage_product->getOrderBySelectDate($from_date, $to_date);
			//print_r($getOrderBySelectDate);

			$i = 1;
			foreach ($getOrderBySelectDate as $data) {

				//$nameVerifier = $this->Manage_product->getVerifier($data['verifier_id']);
				//$getAllIns = $this->Manage_product->getAllIns($data['id']);

				//print_r($getAllIns);
				//if ($getVerifier[0]['name']==$data['client']) {

				$output .= '
                     <tr>
                          
                          <td>' . $i . '</td>
                          <td>' . $data["order_id"] . '</td>
                       	  <td>' . $data["phone"] . '</td>
                       	  <td>' . date("d-m-Y", strtotime($data['date_created'])) . '</td>
                       	  <td>' . $data["email"] . '</td>
                       	 
                       	  
                       	                     
                     </tr>
                ';
				$i++;
			} //}
			$output .= '</table>';
			// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			//header('Content-Disposition: attachment;filename="DataAll.xls"');
			//header('Cache-Control: max-age=0');
			echo $output;
		}
		public function insertCoupon()
		{

			$id  = empty($this->input->post('id')) ? '' : $this->input->post('id');

			$data['coupon'] = empty($this->input->post('coupon')) ? '' : $this->input->post('coupon');
			$data['discount'] = empty($this->input->post('discount')) ? '' : $this->input->post('discount');
			$data['type'] = empty($this->input->post('type')) ? '' : $this->input->post('type');

			if ($id == "") {
				$this->Manage_product->insertCoupon($data);

				redirect(base_url() . "Main_con/add_coupon");
			} else {
				$this->Manage_product->updateCoupon($id, $data);

				redirect(base_url() . "Main_con/add_coupon");
			}
		}
		public function insertSeo()
		{
			$id  = empty($this->input->post('id')) ? '' : $this->input->post('id');


			$data['page_id'] = empty($this->input->post('page_id')) ? '' : $this->input->post('page_id');
			$data['meta_title'] = empty($this->input->post('meta_title')) ? '' : $this->input->post('meta_title');

			$data['meta_desc'] = empty($this->input->post('meta_desc')) ? '' : $this->input->post('meta_desc');
			$data['meta_keyword'] = empty($this->input->post('meta_keyword')) ? '' : $this->input->post('meta_keyword');
			$data['url'] = empty($this->input->post('url')) ? '' : $this->input->post('url');

			if ($id == "") {
				$this->Manage_product->insertSeo($data);
				//echo "1000";
				redirect(base_url() . "Post/view_seo");
			} else {
				$this->Manage_product->updateSeo($id, $data);
				//echo "1002";
				redirect(base_url() . "Post/view_seo");
			}
		}
		public function deleteSeo($id)
		{

			$data = $this->Manage_product->deletePage($id);

			echo json_encode(array("status" => TRUE));
		}
		public function deleteCoupon($id)
		{

			$data = $this->Manage_product->deleteCoupon($id);

			echo json_encode(array("status" => TRUE));
		}
		public function deleteUser($id)
		{

			$data = $this->Manage_product->deleteUser($id);

			echo json_encode(array("status" => TRUE));
		}
		public function insertShop()
		{

			//print_r($_FILES);

			$id  = empty($this->input->post('id')) ? '' : $this->input->post('id');

			$config['upload_path'] = './images/shop_image/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('logo')) {
				//echo "jj";
				$logo	= 	$this->upload->data();
				$config['image_library'] = 'gd2';
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				//echo $this->image_lib->display_errors();
			} else {
				$this->upload->display_errors();
			}

			$data['logo'] = empty($logo['file_name']) ? '' : $logo['file_name'];
			if ($data['logo'] == "") {
				$data['logo'] = empty($this->input->post('logo_old')) ? '' : $this->input->post('logo_old');
			}

			$data['r_id'] = empty($this->input->post('r_id')) ? '' : $this->input->post('r_id');
			$data['category_id'] = empty($this->input->post('category_id')) ? '' : $this->input->post('category_id');
			$data['sub_category_id'] = empty($this->input->post('sub_category_id')) ? '' : $this->input->post('sub_category_id');
			$data['name'] = empty($this->input->post('name')) ? '' : $this->input->post('name');
			$data['shop_name'] = empty($this->input->post('shop_name')) ? '' : $this->input->post('shop_name');
			$data['phone'] = empty($this->input->post('phone')) ? '' : $this->input->post('phone');
			$data['email'] = empty($this->input->post('email')) ? '' : $this->input->post('email');
			$data['password'] = empty($this->input->post('password')) ? '' : $this->input->post('password');
			$data['pin'] = empty($this->input->post('pin')) ? '' : $this->input->post('pin');
			$data['address'] = empty($this->input->post('address')) ? '' : $this->input->post('address');
			$data['city'] = empty($this->input->post('city')) ? '' : $this->input->post('city');
			$data['intro'] = empty($this->input->post('intro')) ? '' : $this->input->post('intro');
			$data['description'] = empty($this->input->post('description')) ? '' : $this->input->post('description');
			$data['status'] = empty($this->input->post('status')) ? '' : $this->input->post('status');
			//$data['status'] = 1;
			$data['slug'] = empty($this->input->post('slug')) ? '' : $this->input->post('slug');

			if ($id == "") {

				$insertShop = 	$this->Manage_product->insertShop($data);
				/////////////////////////Bulk Upload House//////////////////////////
				$count =  count($_FILES['banner']['name']);
				///print_r($_FILES);
				for ($i = 0; $i < $count; $i++) { //loop to get 

					$_FILES['imageUp']['name'] = $_FILES['banner']['name'][$i];
					$_FILES['imageUp']['type'] = $_FILES['banner']['type'][$i];
					$_FILES['imageUp']['tmp_name'] = $_FILES['banner']['tmp_name'][$i];
					$_FILES['imageUp']['error'] = $_FILES['banner']['error'][$i];
					$_FILES['imageUp']['size'] = $_FILES['banner']['size'][$i];

					$config['upload_path'] = './images/shop_image/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
					$config['width']    = '150';
					$config['height']   = '150';
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('imageUp')) {
						$image	= 	$this->upload->data();
						$log_image[$i]['image'] = empty($image['file_name']) ? '' : $image['file_name'];
						// $log_image[$i]['add_id']=empty($id) ? '' :$id; 
						$log_image[$i]['shop_id'] = $insertShop['last_id'];
						//$log_image[$i]['color']=$dataCo['color'][$i];
						// print_r();
						$msg  = $this->Manage_product->insertShopImage($log_image[$i]);
						$this->upload->display_errors();
					} else {

						$this->upload->display_errors();
					}
				}

				///////////////bluk upload///////////////



				if ($data['status'] == 1) {
					redirect(base_url() . "Main_con/view_shop");
				} else if ($data['status'] == 3) {

					redirect(base_url() . "Main_con/view_counter");
				} else {
					redirect(base_url() . "Main_con/view_emp");
				}
			} else {

				$this->Manage_product->updateShop($id, $data);

				//$insertShop = 	$this->Manage_product->insertShop($data);
				/////////////////////////Bulk Upload House//////////////////////////
				$count =  count($_FILES['banner']['name']);
				///print_r($_FILES);
				for ($i = 0; $i < $count; $i++) { //loop to get 

					$_FILES['imageUp']['name'] = $_FILES['banner']['name'][$i];
					$_FILES['imageUp']['type'] = $_FILES['banner']['type'][$i];
					$_FILES['imageUp']['tmp_name'] = $_FILES['banner']['tmp_name'][$i];
					$_FILES['imageUp']['error'] = $_FILES['banner']['error'][$i];
					$_FILES['imageUp']['size'] = $_FILES['banner']['size'][$i];

					$config['upload_path'] = './images/shop_image/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
					$config['width']    = '150';
					$config['height']   = '150';
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('imageUp')) {
						$image	= 	$this->upload->data();
						$log_image[$i]['image'] = empty($image['file_name']) ? '' : $image['file_name'];
						// $log_image[$i]['add_id']=empty($id) ? '' :$id; 
						$log_image[$i]['shop_id'] = $id;
						//$log_image[$i]['color']=$dataCo['color'][$i];
						// print_r();
						$msg  = $this->Manage_product->insertShopImage($log_image[$i]);
						$this->upload->display_errors();
					} else {

						$this->upload->display_errors();
					}
				}

				///////////////bluk upload///////////////

				if ($data['status'] == 1) {
					redirect(base_url() . "Main_con/view_shop");
				} else if ($data['status'] == 3) {

					redirect(base_url() . "Main_con/view_counter");
				} else {
					redirect(base_url() . "Main_con/view_emp");
				}
			}
		}
		public function updateDeliveryBoy()
		{

			//print_r($_FILES);

			$id  = empty($this->input->post('order_id')) ? '' : $this->input->post('order_id');
			$data['boy_id'] = empty($this->input->post('boy_id')) ? '' : $this->input->post('boy_id');


			$this->Manage_product->updateOrder($id, $data);

			//redirect(base_url()."Main_con/order");
			//$this->sendSms($data);
			echo 1000;
		}
		public function updateCash()
		{

			//print_r($_FILES);

			$id  = empty($this->input->post('id')) ? '' : $this->input->post('id');
			$data['amount_open'] = empty($this->input->post('amount_open')) ? '' : $this->input->post('amount_open');
			$data['amount_close'] = empty($this->input->post('amount_close')) ? '' : $this->input->post('amount_close');
			$data['created_date'] = date('d-m-Y');
			$getCashDetails = $this->Manage_product->getCashDetails($data['created_date']);
			//print_r($getCashDetails);
			if (empty($getCashDetails)) {
				$this->Manage_product->insertCash($data);
				echo 1000;
			} else {
				$id = $getCashDetails[0]['id'];
				if ($getCashDetails[0]['amount_open'] == 0) {
					$dataNew['amount_open'] = empty($this->input->post('amount_open')) ? '' : $this->input->post('amount_open');
				}
				if ($getCashDetails[0]['amount_close'] == 0) {
					$dataNew['amount_close'] = empty($this->input->post('amount_close')) ? '' : $this->input->post('amount_close');
				}

				$this->Manage_product->updateCash($id, $dataNew);
				echo 1000;
			}
		}
		public function insertSociety()
		{
			//print_r($_FILES);
			$id  = empty($this->input->post('id')) ? '' : $this->input->post('id');


			$data['name'] = empty($this->input->post('name')) ? '' : $this->input->post('name');
			$data['sector'] = empty($this->input->post('sector')) ? '' : $this->input->post('sector');
			$data['cod'] = empty($this->input->post('cod')) ? '' : json_encode($this->input->post('cod'));
			$data['delivery_charge'] = empty($this->input->post('delivery_charge')) ? '' : $this->input->post('delivery_charge');
			$data['status'] = empty($this->input->post('status')) ? '' : $this->input->post('status');

			if ($id == "") {
				$this->Manage_product->insertSociety($data);
				//echo "1000";
				redirect(base_url() . "Main_con/add_society");
			} else {
				$this->Manage_product->updateSociety($id, $data);
				//echo "1002";
				redirect(base_url() . "Main_con/add_society");
			}
		}
		public function deleteSociety($id)
		{

			$data = $this->Manage_product->deleteSociety($id);

			echo json_encode(array("status" => TRUE));
		}


		//new code

		public function insertBookingTracking()
		{
			$bookingId = $this->input->post('bookingId');
			    date_default_timezone_set('Asia/Kolkata');
				$data['bookingId'] = empty($this->input->post('bookingId')) ? '' : $this->input->post('bookingId');
				$data['comment'] = empty($this->input->post('comment')) ? '' : $this->input->post('comment');
				$data['date_time'] = date('Y-m-d H:i:s');
			$this->Manage_product->insertBookingTracking($data);
			redirect(base_url() . "Main_con/orderdetails/$bookingId");
		}


		public function insertBooking()
		{

			// print_r($_REQUEST);
			// die();

			$action = empty($this->input->post('action')) ? '' : $this->input->post('action');
			$user = empty($this->input->post('userId')) ? '' : $this->input->post('userId');
			$email = empty($this->input->post('email')) ? '' : $this->input->post('email');

			$getUser = $this->App_model->getUserByEmailApp($email);
			if (!empty($user)) {
				$data['userId'] = $user;
			} else if (count($getUser) > 0) {
				$data['userId'] = $getUser[0]['id'];
			} else {
				$pass = $this->random_strings(6);
				$log['email'] = empty($this->input->post('email')) ? '' : $this->input->post('email');
				$log['phoneNumber'] = empty($this->input->post('phoneNumber')) ? '' : $this->input->post('phoneNumber');
				$log['firstName'] = empty($this->input->post('name')) ? '' : $this->input->post('name');
				$log['password'] = md5($pass);
				$log['type'] = "USER";
				$log['status'] = 1;
				$log['source'] = "WEB";

				$resUser = $this->App_model->insertUser($log);

				if ($resUser['msg'] == 1) {
					// $this->emailUserDetails($log);
					$data['userId'] = $resUser['last_id'];
				}
			}

			$id = $this->input->post('id');
			$carsArr = json_decode($this->input->post('carsDetails'), true);
			$data['vehicleId'] = empty($this->input->post('vehicleId')) ? '' : $this->input->post('vehicleId');
			$data['picklng'] = empty($this->input->post('pickLng')) ? '' : $this->input->post('pickLng');
			$data['droplng'] = empty($this->input->post('dropLng')) ? '' : $this->input->post('dropLng');
			$data['picklat'] = empty($this->input->post('pickLat')) ? '' : $this->input->post('pickLat');
			$data['droplat'] = empty($this->input->post('dropLat')) ? '' : $this->input->post('dropLat');
			$data['type'] = empty($this->input->post('type')) ? '' : $this->input->post('type');
			$data['comments'] = empty($this->input->post('comments')) ? '' : $this->input->post('comments');
			$data['date'] = empty($this->input->post('date')) ? '' : $this->input->post('date');
			$data['time'] = empty($this->input->post('time')) ? '' : $this->input->post('time');
			$data['status'] = empty($this->input->post('status')) ? '' : $this->input->post('status');
			$data['bookingType'] = empty($this->input->post('bookingType')) ? '' : $this->input->post('bookingType');

			$getData = $this->getDistanceByLatLng($data['picklat'], $data['picklng'], $data['droplat'], $data['droplng']);

			$data['kmDiff'] = $getData['km'];
			$data['pickupLocation'] = $getData['originAddress'];
			$data['dropLocation'] = $getData['destinationAddress'];


			if ($action == 'Admin') {

				if ($id == "") {
					$res = $this->Manage_product->insertBooking($data);

					if ($res['msg'] == 1) {

						if (isset($carsArr)) {
							foreach ($carsArr as $cr) {
								$log['bookingId'] = $res['last_id'];
								$log['model'] = $cr['model'];
								// $log['category'] = $cr['category'];
								// $log['brand'] = $cr['brand'];
								$log['carType'] = $cr['carType'];
								$log['carQuality'] = $cr['carQuality'];
								$log['carCondition'] = $cr['carCondition'];
								$log['doc'] = $cr['image'];

								$this->Manage_product->insertCarDetails($log);
							}
						}

						redirect(base_url() . 'Main_con/view_booking');
					} else {
						echo "Error on Inserting Booking..";
					}
				} else {
					$res = $this->Manage_product->updateBooking($id, $data);
					if ($res == 1) {
						if (isset($carsArr)) {

							for ($i = 0; $i < count($this->input->post('model')); $i++) {
								// print_r($this->input->post('model'));
								$carData['model'] = $this->input->post('model')[$i];
								// $carData['category'] = $this->input->post('category')[$i];
								// $carData['brand'] = $this->input->post('brand')[$i];
								$carData['carType'] = $this->input->post('carType')[$i];
								$carData['carQuality'] = $this->input->post('carQuality')[$i];
								$carData['carCondition'] = $this->input->post('carCondition')[$i];
								$this->Manage_product->updateCarDetails($this->input->post('carId')[$i], $carData);
							}
						}

						redirect(base_url() . 'Main_con/view_booking');
					} else {
						redirect(base_url() . "Main_con/add_booking/$id");
					}
				}
			} else {
				$res = $this->Manage_product->insertBooking($data);

				if ($res['msg'] == 1) {

					if (isset($carsArr)) {
						foreach ($carsArr as $cr) {
							$log['bookingId'] = $res['last_id'];
							$log['model'] = $cr['model'];
							// $log['category'] = $cr['category'];
							// $log['brand'] = $cr['brand'];
							$log['carType'] = $cr['carType'];
							$log['carQuality'] = $cr['carQuality'];
							$log['carCondition'] = $cr['carCondition'];
							$log['doc'] = $cr['image'];

							$this->Manage_product->insertCarDetails($log);
						}
					}
					echo json_encode(array('status' => "ok", 'message' => 'Booked, you will be contact shortly.'));
				} else {
					echo json_encode(array('status' => "error", 'message' => 'Failed, Please try again or Contact Admin.'));
				}
			}
		}

		public function insertEnquiry()
		{

			$data['name'] = empty($this->input->post('name')) ? '' : $this->input->post('name');
			$data['phoneNumber'] = empty($this->input->post('phoneNumber')) ? '' : $this->input->post('phoneNumber');
			$data['email'] = empty($this->input->post('email')) ? '' : $this->input->post('email');
			$data['message'] = empty($this->input->post('message')) ? '' : $this->input->post('message');
			$data['type'] = empty($this->input->post('type')) ? '' : $this->input->post('type');

			$res = $this->Manage_product->insertEnquiry($data);

			if ($res == 1) {
				echo json_encode(array('status' => "ok", 'message' => 'Inserted, you will be contact shortly.'));
			} else {
				echo json_encode(array('status' => "error", 'message' => 'Failed, Please try again or Contact Admin.'));
			}
		}

		public function uploadDocument()
		{

			$config['upload_path'] = './images/booking_image/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
			$config['width']    = '150';
			$config['height']   = '150';
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

			echo json_encode(array('status' => "ok", 'image' => $image['file_name']));
		}

		public function register()
		{
			$action = empty($this->input->post('action')) ? '' : $this->input->post('action');

			$data['firstName'] = empty($this->input->post('firstName')) ? '' : trim($this->input->post('firstName'));
			$data['lastName'] = empty($this->input->post('lastName')) ? '' : $this->input->post('lastName');
			$data['email'] = empty($this->input->post('email')) ? '' : strtolower($this->input->post('email'));
			$data['phoneNumber'] = empty($this->input->post('phoneNumber')) ? '' : strtolower($this->input->post('phoneNumber'));
			$data['password'] = empty($this->input->post('password')) ? '' : md5($this->input->post('password'));
			
			$data['state'] = empty($this->input->post('state')) ? '' : strtolower($this->input->post('state'));
			$data['city'] = empty($this->input->post('city')) ? '' : strtolower($this->input->post('city'));
			$data['type'] = empty($this->input->post('type')) ? '' : $this->input->post('type');
			$data['checkTandC'] = empty($this->input->post('check')) ? '' : $this->input->post('check');

			if($data['type'] == 'USER'){
				$data['status'] = 1;
			}
			else if($data['type'] == 'DEALER'){
				$data['status'] = 0;
			}
			else{
				$data['status'] = 1;
			}

			$getUserByEmail = $this->Manage_product->getUserByEmail($data['email']);

			$getUserByPhone = $this->Manage_product->getUserByPhone($data['phoneNumber']);

			if ($action == "admin") {

				if (count($getUserByEmail) > 0) {
					echo 'Email already exist!!';
				} else if (count($getUserByPhone) > 0) {
					echo 'Phone Number already exist!!';
				} else {
					
					$data['source'] = 'ADMIN';
					$res = $this->Manage_product->insertUser($data);
					if ($res == 1) {
						$this->emailUserRegister($data);
						redirect(base_url() . 'Main_con/view_user');
					} else {
						echo 'Failed, Please try again or Contact Admin.';
					}
				}
			} else {

				if (count($getUserByEmail) > 0) {
					echo json_encode(array('status' => "error", 'message' => 'Email Already exist!!'));
				} else if (count($getUserByPhone) > 0) {
					echo json_encode(array('status' => "error", 'message' => 'Phone Number Already exist!!'));
				} else {
					$data['source'] = 'WEB';
					$res = $this->Manage_product->insertUser($data);

					if ($res == 1) {
						$this->emailUserRegister($data);
						echo json_encode(array('status' => "ok", 'message' => 'Registered Success'));
					} else {
						echo json_encode(array('status' => "error", 'message' => 'Failed, Please try again or Contact Admin.'));
					}
				}
			}
		}


		public function login()
		{
			date_default_timezone_set('Asia/kolkata');
			$data['phoneNumber'] = empty($this->input->post('phoneNumber')) ? '' : $this->input->post('phoneNumber');
			$data['password'] = empty($this->input->post('password')) ? '' : md5($this->input->post('password'));
			// $data['type'] = empty($this->input->post('type')) ? '' : $this->input->post('type');
			$res = $this->Manage_product->getUserLogin($data);

			if (count($res) > 0) {
				$log['name'] = $res[0]['firstName'];
				$log['type'] = $res[0]['type'];
				$log['userId'] = $res[0]['id'];
				$log['email'] = $res[0]['email'];
				$log['city'] = $res[0]['city'];

				$data['login_time'] = date('Y-m-d G:i:s');
				$this->Manage_product->updateUser($res[0]['id'],$data);
				echo json_encode(array('status' => "ok", 'message' => 'Login Success', 'data' => $log));
			} else {
				echo json_encode(array('status' => "error", 'message' => 'Failed Invalid Credentials, Please try again or Contact Admin.'));
			}
		}


		function Logout()
		{

			///echo "kjsdds";

			$this->session->sess_destroy();

			redirect(base_url());
		}



		public function insertBanner()
		{
			$config['upload_path'] = './images/banner_image/';
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

			$this->Manage_product->insertBanner($data);
			redirect(base_url() . "Main_con/view_banner");
		}

		public function deleteBanner($id)
		{

			$data = $this->Manage_product->deleteBanner($id);

			echo json_encode(array("status" => TRUE));
		}

		public function insertServices()
		{
			$id = $this->input->post('id');

			$config['upload_path'] = './images/banner_image/';
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

			$data['name'] = empty($this->input->post('name')) ? '' : $this->input->post('name');
			if ($id == "") {
				$this->Manage_product->insertServices($data);
				redirect(base_url() . "Main_con/view_services");
			}
			else{
				$this->Manage_product->updateServices($id,$data);
				redirect(base_url() . "Main_con/view_services");

			}

		
		}

		public function deleteServices($id)
		{

			$data = $this->Manage_product->deleteServices($id);

			echo json_encode(array("status" => TRUE));
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


		public function insertVehicle()
		{
			$id = $this->input->post('id');

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

			$data['name'] = empty($this->input->post('name')) ? '' : $this->input->post('name');
			$data['categoryId'] = empty($this->input->post('categoryId')) ? '' : $this->input->post('categoryId');

			if ($id == "") {
				$insertVehicle = $this->Manage_product->insertVehicle($data);
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
						$log_image[$i]['vehicleId'] = $insertVehicle['last_id'];
						$msg  = $this->Manage_product->insertVehicleImage($log_image[$i]);
						$this->upload->display_errors();
					} else {

						$this->upload->display_errors();
					}
				}
				redirect(base_url() . "Main_con/view_vehicle");
			} else {

				/////////////////////////Bulk Upload House//////////////////////////
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
						$log_image[$i]['vehicleId'] = $id;
						$msg  = $this->Manage_product->insertVehicleImage($log_image[$i]);
						$this->upload->display_errors();
					} else {

						$this->upload->display_errors();
					}
				}
				///////////////bluk upload///////////////
				$this->Manage_product->updateVehicle($id, $data);
				//print_r($_FILES);
				redirect(base_url() . "Main_con/view_vehicle");
			}
		}

		public function deleteVehicleImageById()
		{
			$id = $this->uri->segment(3);
			$callbackId = $this->uri->segment(4);

			if ($id) {
				$res = $this->Manage_product->deleteVehicleImageById($id);

				if ($res == 1) {
					redirect(base_url() . "Main_con/add_vehicle/$callbackId");
				} else {
					echo "ERROR on Deleting";
				}
			}
		}

		public function deleteVehicle($id)
		{

			// $data = $this->Manage_product->deleteVehicle($id);
			// $datam = $this->Manage_product->deleteVehicleImages($id);
			// echo json_encode(array("status" => TRUE));

			$data = $this->Manage_product->deleteMPVehicle($id);

			$getImages = $this->Manage_product->getAllMPImages($id);

			if($data == 1){

				foreach($getImages as $img){
                    $path = FCPATH . "images/vehicle_image/".$img['image'];
					$this->Manage_product->deleteMPVehicleImages($img['id'],$path);
				}
				echo json_encode(array("status" => TRUE));
			}
			else{
				echo json_encode(array('status' =>'error',"msg"=>"Error On  Deletion.."));
			}
		}

		public function updateBookingStatus()
		{
	
			$bookingId = empty($this->input->post('bookingId')) ? '' : $this->input->post('bookingId');
			$data['status'] = empty($this->input->post('status')) ? '' : $this->input->post('status');
			$res = $this->Manage_product->updateBooking($bookingId, $data);

			if ($res == 1) {
				redirect(base_url() . 'Main_con/driver_booking');
			} else {
				echo 'Error on updating bookings';
			}
		}
		public function updateBooking()
		{
			$bookingId = empty($this->input->post('bookingId')) ? '' : $this->input->post('bookingId');
			$data['assignDriverId'] = empty($this->input->post('assignDriverId')) ? '' : $this->input->post('assignDriverId');
			$data['status'] = "ASSIGNED";

			$res = $this->Manage_product->updateBooking($bookingId, $data);

			if ($res == 1) {
				redirect(base_url() . 'Main_con/view_booking');
			} else {
				echo 'Error on updating bookings';
			}
		}

		public function updateBookingTrailor()
		{
			$bookingId = empty($this->input->post('bookingId')) ? '' : $this->input->post('bookingId');
			$carId = empty($this->input->post('carId')) ? '' : $this->input->post('carId');
			$data['assignDriverId'] = empty($this->input->post('assignDriverId')) ? '' : $this->input->post('assignDriverId');
			$data['assignSecondDriverId'] = 0;
			$log['status'] = "ASSIGNED" ;

			$getCarDetail = $this->Manage_product->getCarDetailsByDriverId($data['assignDriverId']);
			$getCarDetailV2 = $this->Manage_product->getCarDetailsByDriverIdV2($data['assignDriverId']);

			if(count($getCarDetail) > 0){
              $getBooking = $this->Manage_product->getBookingById($getCarDetail[0]['bookingId']);

			  if(count($getBooking) > 0 && $getCarDetail[0]['bookingId'] != $bookingId && $getBooking[0]['status'] != 'COMPLETED'){
				$this->session->set_flashdata('error', 'This Driver is Assigned and Booking Yet not Completed!');
				redirect(base_url() . "Main_con/orderdetails/$bookingId");
			  }
			}
			else if(count($getCarDetailV2) > 0){
				$getBooking = $this->Manage_product->getBookingById($getCarDetailV2[0]['bookingId']);

				if(count($getBooking) > 0 &&  $getCarDetail[0]['bookingId'] != $bookingId && $getBooking[0]['status'] != 'COMPLETED'){
				  $this->session->set_flashdata('error', 'This Driver is Assigned and Booking Yet not Completed!');
				  redirect(base_url() . "Main_con/orderdetails/$bookingId");
				}
			}
			$res = $this->Manage_product->updateCarTrailorBooking($carId, $data);
			
			if ($res == 1) {
				$this->Manage_product->updateBooking($bookingId,$log);
				redirect(base_url() . "Main_con/orderdetails/$bookingId");
			} else {
				$this->session->set_flashdata('error', 'Something Went Wrong!');
				redirect(base_url() . "Main_con/orderdetails/$bookingId");
			}
		}

		public function updateBookingTrailorV2()
		{
			$bookingId = empty($this->input->post('bookingId')) ? '' : $this->input->post('bookingId');
			$carId = empty($this->input->post('carId')) ? '' : $this->input->post('carId');
			$data['assignSecondDriverId'] = empty($this->input->post('assignSecondDriverId')) ? '' : $this->input->post('assignSecondDriverId');
			$data['secondDriverAssignFlag'] = 1;
			// $data['assignDriverId'] = 0;
			$log['status'] = "REASSIGNED" ;

			$getCarDetail = $this->Manage_product->getCarDetailsByDriverId($data['assignSecondDriverId']);
			$getCarDetailV2 = $this->Manage_product->getCarDetailsByDriverIdV2($data['assignSecondDriverId']);

			if(count($getCarDetail) > 0){
              $getBooking = $this->Manage_product->getBookingById($getCarDetail[0]['bookingId']);

			  if(count($getBooking) > 0 && $getCarDetail[0]['bookingId'] != $bookingId && $getBooking[0]['status'] != 'COMPLETED'){
				$this->session->set_flashdata('errorv2', 'This Driver is Assigned and Booking Yet not Completed!');
				redirect(base_url() . "Main_con/orderdetails/$bookingId");
			  }
			}
			else if(count($getCarDetailV2) > 0){
				$getBooking = $this->Manage_product->getBookingById($getCarDetailV2[0]['bookingId']);

				if(count($getBooking) > 0 && $getCarDetail[0]['bookingId'] != $bookingId && $getBooking[0]['status'] != 'COMPLETED'){
				  $this->session->set_flashdata('errorv2', 'This Driver is Assigned and Booking Yet not Completed!');
				  redirect(base_url() . "Main_con/orderdetails/$bookingId");
				}
			}

			
			$res = $this->Manage_product->updateCarTrailorBooking($carId, $data);
			
			if ($res == 1) {
				$this->Manage_product->updateBooking($bookingId,$log);
				redirect(base_url() . "Main_con/orderdetails/$bookingId");
			} else {
				$this->session->set_flashdata('errorv2', 'Something Went Wrong!');
				redirect(base_url() . "Main_con/orderdetails/$bookingId");
			}
		}



		public function getAutocompleteGoogle()
		{
			$query = $this->input->post('query');

			$url = "https://maps.googleapis.com/maps/api/place/autocomplete/json?input=$query&types=geocode&key=AIzaSyB39Z-mhm2udO-plmGRgG4QOyX3UjqOqqo";

			$crl = curl_init();
			curl_setopt($crl, CURLOPT_URL, $url);
			curl_setopt($crl, CURLOPT_FRESH_CONNECT, true);
			curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

			$response = curl_exec($crl);
			if (!$response) {
				die('Error: "' . curl_error($crl) . '" - Code: ' . curl_errno($crl));
			}

			$rd = json_decode($response, true);

			$arr = array();

			foreach ($rd['predictions'] as $key) {
				$data['description'] =  $key['description'];
				$data['place_id'] =  $key['place_id'];
				array_push($arr, $data);
			}
			echo json_encode(array('status' => "ok", 'data' => $arr));

			unset($arr);
			curl_close($crl);
		}


		public function getLatLngByPlaceId()
		{
			$place = $this->input->post('placeId');

			$url = "https://maps.googleapis.com/maps/api/place/details/json?place_id=$place&key=AIzaSyB39Z-mhm2udO-plmGRgG4QOyX3UjqOqqo";

			$crl = curl_init();
			curl_setopt($crl, CURLOPT_URL, $url);
			curl_setopt($crl, CURLOPT_FRESH_CONNECT, true);
			curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

			$response = curl_exec($crl);
			if (!$response) {
				die('Error: "' . curl_error($crl) . '" - Code: ' . curl_errno($crl));
			}

			$rd = json_decode($response, true);

			echo json_encode(array('status' => "ok", 'data' => $rd['result']['geometry']['location']));

			curl_close($crl);
		}

		public function getDistanceByLatLng($pickLat, $pickLng, $dropLat, $dropLng)
		{
			// $pickLat = $this->input->post('pickLat');
			// $pickLng = $this->input->post('pickLng');
			// $dropLat = $this->input->post('dropLat');
			// $dropLng = $this->input->post('dropLng');
			$url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$pickLat,$pickLng&destinations=$dropLat,$dropLng&key=AIzaSyB39Z-mhm2udO-plmGRgG4QOyX3UjqOqqo";

			$crl = curl_init();
			curl_setopt($crl, CURLOPT_URL, $url);
			curl_setopt($crl, CURLOPT_FRESH_CONNECT, true);
			curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

			$response = curl_exec($crl);
			if (!$response) {
				die('Error: "' . curl_error($crl) . '" - Code: ' . curl_errno($crl));
			}

			$rd = json_decode($response, true);

			// echo json_encode(array('status' =>"ok",'km'=>($rd['rows'][0]['elements'][0]['distance']['value']/1000),'originAddress'=>$rd['origin_addresses'][0],'destinationAddress'=>$rd['destination_addresses'][0]));

			return array('km' => ($rd['rows'][0]['elements'][0]['distance']['value'] / 1000), 'originAddress' => $rd['origin_addresses'][0], 'destinationAddress' => $rd['destination_addresses'][0]);



			curl_close($crl);
		}


		function emailUserDetails($data)
		{

			$message = "your Password is " . $data['password'];


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

				//	$this->Manage_product->updateEmail($data['email'],$data);

			} else {
				show_error($this->email->print_debugger());
			}

			//////////////email///////////////

		}

		function emailUserRegisterV2($data)
		{

			$message = "Thanks for register.." . $data['firstName'];

			$this->load->library('email');

			$this->email->set_newline("\r\n");

			$this->email->set_header('MIME-Version', '1.0; charset=utf-8');

			$this->email->set_header('Content-type', 'text/html');

			$this->email->from('info@digibytech.com'); // change it to yours

			$this->email->to($data['email']); // change it to yours

			$this->email->subject('Registration');

			$this->email->message($message);

			if ($this->email->send()) {
				echo '1002';

				//	$this->Manage_product->updateEmail($data['email'],$data);

			} else {
				show_error($this->email->print_debugger());
			}

			//////////////email///////////////

		}

		function emailUserRegister($data)
		{

			$message = "Thanks for register..". $data['firstName'];
        $this->load->library('email');
	   $this->email->message($message);
      $this->email->set_newline("\r\n");
      $this->email->from('info@vahanassist.com'); // change it to yours
      $this->email->to($data['email']);// change it to yours
      $this->email->subject('vahanassist.com');
      $this->email->message($message);
    //    $this->email->set_mailtype("html");
      if($this->email->send())
     {
    //   echo 'Email sent.';
     }
     else
    {
     show_error($this->email->print_debugger());
    }

		}


		public function insertInspection()
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


		public function insertCarBrand()
		{
			// $config['upload_path'] = './images/banner_image/';
			// $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
			// $this->load->library('upload', $config);
			// $this->upload->initialize($config);
			// if ($this->upload->do_upload('image')) {
			// 	//echo "jj";
			// 	$image	= 	$this->upload->data();
			// 	$config['image_library'] = 'gd2';
			// 	$this->load->library('image_lib', $config);
			// 	$this->image_lib->resize();

			// 	//echo $this->image_lib->display_errors();
			// } else {
			// 	$this->upload->display_errors();
			// }

			// $data['image'] = empty($image['file_name']) ? '' : $image['file_name'];
			// if ($data['image'] == "") {
			// 	$data['image'] = empty($this->input->post('image_old')) ? '' : $this->input->post('image_old');
			// }

			$id = empty($this->input->post('id')) ? '' : $this->input->post('id');
			$data['category_id'] = empty($this->input->post('category_id')) ? '' : $this->input->post('category_id');
			$data['name'] = empty($this->input->post('name')) ? '' : $this->input->post('name');

			if ($id == "") {
				$this->Manage_product->insertCarBrand($data);
				redirect(base_url() . "Main_con/view_car_brand");
			} else {
				$this->Manage_product->updateCarBrand($id, $data);
				redirect(base_url() . "Main_con/view_car_brand");
			}
		}

		public function deleteCarBrand($id)
		{

			$data = $this->Manage_product->deleteCarBrand($id);

			echo json_encode(array("status" => TRUE));
		}

		public function insertCarModel()
		{
			
			// $config['upload_path'] = './images/banner_image/';
			// $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
			// $this->load->library('upload', $config);
			// $this->upload->initialize($config);
			// if ($this->upload->do_upload('image')) {
			// 	//echo "jj";
			// 	$image	= 	$this->upload->data();
			// 	$config['image_library'] = 'gd2';
			// 	$this->load->library('image_lib', $config);
			// 	$this->image_lib->resize();

			// 	//echo $this->image_lib->display_errors();
			// } else {
			// 	$this->upload->display_errors();
			// }

			// $data['image'] = empty($image['file_name']) ? '' : $image['file_name'];
			// if ($data['image'] == "") {
			// 	$data['image'] = empty($this->input->post('image_old')) ? '' : $this->input->post('image_old');
			// }

			$id = empty($this->input->post('id')) ? '' : $this->input->post('id');
			$data['brand_id'] = empty($this->input->post('brand_id')) ? '' : $this->input->post('brand_id');
			$data['name'] = empty($this->input->post('name')) ? '' : $this->input->post('name');
			$data['displacement'] = empty($this->input->post('displacement')) ? '' : $this->input->post('displacement');
			$data['emission_norm'] = empty($this->input->post('emission_norm')) ? '' : $this->input->post('emission_norm');
			$data['fuel_tank_capacity'] = empty($this->input->post('fuel_tank_capacity')) ? '' : $this->input->post('fuel_tank_capacity');
			$data['fuel_type'] = empty($this->input->post('fuel_type')) ? '' : $this->input->post('fuel_type');
			$data['height'] = empty($this->input->post('height')) ? '' : $this->input->post('height');
			$data['length'] = empty($this->input->post('length')) ? '' : $this->input->post('length');
			$data['width'] = empty($this->input->post('width')) ? '' : $this->input->post('width');
			$data['body_type'] = empty($this->input->post('body_type')) ? '' : $this->input->post('body_type');
			$data['kerb_weight'] = empty($this->input->post('kerb_weight')) ? '' : $this->input->post('kerb_weight');
			$data['gears'] = empty($this->input->post('gears')) ? '' : $this->input->post('gears');
			$data['ground_clearance'] = empty($this->input->post('ground_clearance')) ? '' : $this->input->post('ground_clearance');
			$data['front_brakes'] = empty($this->input->post('front_brakes')) ? '' : $this->input->post('front_brakes');
			$data['rear_brakes'] = empty($this->input->post('rear_brakes')) ? '' : $this->input->post('rear_brakes');
			$data['power_windows'] = empty($this->input->post('power_windows')) ? '' : $this->input->post('power_windows');
			$data['power_seats'] = empty($this->input->post('power_seats')) ? '' : $this->input->post('power_seats');
			$data['power'] = empty($this->input->post('power')) ? '' : $this->input->post('power');
			$data['torque'] = empty($this->input->post('torque')) ? '' : $this->input->post('torque');
			$data['odometer'] = empty($this->input->post('odometer')) ? '' : $this->input->post('odometer');
			$data['speedometer'] = empty($this->input->post('speedometer')) ? '' : $this->input->post('speedometer');
			$data['seating_capacity'] = empty($this->input->post('seating_capacity')) ? '' : $this->input->post('seating_capacity');
			$data['seats_material'] = empty($this->input->post('seats_material')) ? '' : $this->input->post('seats_material');
			$data['transmission'] = empty($this->input->post('transmission')) ? '' : $this->input->post('transmission');
			$data['central_locking'] = empty($this->input->post('central_locking')) ? '' : $this->input->post('central_locking');
			$data['child_safety_locks'] = empty($this->input->post('child_safety_locks')) ? '' : $this->input->post('child_safety_locks');
			$data['abs'] = empty($this->input->post('abs')) ? '' : $this->input->post('abs');
			$data['ventilation_system'] = empty($this->input->post('ventilation_system')) ? '' : $this->input->post('ventilation_system');


			// print_r($_REQUEST);
			// die();

			if ($id == "") {
				$this->Manage_product->insertCarModel($data);
				redirect(base_url() . "Main_con/view_car_model");
			} else {
				$this->Manage_product->updateCarModel($id, $data);
				redirect(base_url() . "Main_con/view_car_model");
			}
		}

		public function deleteCarModel($id)
		{

			$data = $this->Manage_product->deleteCarModel($id);

			echo json_encode(array("status" => TRUE));
		}

		public function getPaymentByUserId()
		{

			$id = empty($this->input->post('id')) ? '' : $this->input->post('id');

			if (!empty($id)) {

				$data = $this->Manage_product->getPaymentByUserId($id);

				echo json_encode($data);
			} else {
				echo json_encode([]);
			}
		}

		public function insertPackages()
		{

			$id = empty($this->input->post('id')) ? '' : $this->input->post('id');

			$config['upload_path'] = './images/package_image/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
			$config['width']    = '150';
			$config['height']   = '150';
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
		
			
			$data['title'] = empty($this->input->post('title')) ? '' : $this->input->post('title');
			$data['content'] = empty($this->input->post('content')) ? '' : $this->input->post('content');
			$data['price'] = empty($this->input->post('price')) ? '' : $this->input->post('price');

			if ($id == "") {
				$this->Manage_product->insertPackages($data);
				redirect(base_url() . "Main_con/view_packages");
			} else {
				$this->Manage_product->updatePackages($id, $data);
				redirect(base_url() . "Main_con/view_packages");
			}
		}

		public function deletePackages($id)
		{

			$data = $this->Manage_product->deletePackages($id);

			echo json_encode(array("status" => TRUE));
		}

		public function getAllPackages()
		{

			$data = $this->Manage_product->getAllPackages();

		   echo json_encode(array($data));

		}

		public function getAllMpCategory()
		{

			$data = $this->Manage_product->getAllMpCategory();
			echo json_encode($data);
		}

		public function getAllBrand()
		{
			$id = $this->input->post('category_id');


			$data = $this->Manage_product->getCarBrandByCatId($id);

			echo json_encode($data);
		}

		public function getAllModelV2()
		{

			$data = $this->Manage_product->getAllModelV2();

			echo json_encode($data);
		}

		public function getAllModel()
		{
			$id = $this->input->post('brand_id');

			$data = $this->Manage_product->getCarModelByBrandId($id);

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

		public function getAllBrandByCategoryId()
		{
			$id = $this->input->post('category_id');

			$data = $this->Manage_product->getAllBrandByCategoryId($id);

			echo json_encode($data);
		}

		public function insertMKVehicle()
		{
			// print_r($_REQUEST);
			// die();
			file_put_contents('C:\xampp\htdocs\vahaan-admin\custom_debug_insert.txt', "insertMKVehicle called at " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
			file_put_contents('C:\xampp\htdocs\vahaan-admin\custom_debug_insert.txt', "POST Data: " . print_r($_POST, true) . "\n", FILE_APPEND);
			file_put_contents('C:\xampp\htdocs\vahaan-admin\custom_debug_insert.txt', "FILES Data: " . print_r($_FILES, true) . "\n", FILE_APPEND);

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
			$data['insurance'] = empty($this->input->post('insurance')) ? '' : $this->input->post('insurance');
			$data['insurancedate'] = empty($this->input->post('insurancedate')) ? '' : $this->input->post('insurancedate');
			$data['vcondition'] = empty($this->input->post('vcondition')) ? '' : $this->input->post('vcondition');
			$data['state'] = empty($this->input->post('state')) ? '' : $this->input->post('state');
			$data['rto'] = empty($this->input->post('rto')) ? '' : $this->input->post('rto');
			$data['year'] = empty($this->input->post('year')) ? '' : $this->input->post('year');
			$data['kms'] = empty($this->input->post('kms')) ? '' : $this->input->post('kms');
			$data['location'] = empty($this->input->post('location')) ? '' : $this->input->post('location');
			$data['discount_percent'] = empty($this->input->post('discount_percent')) ? '' : $this->input->post('discount_percent');
			$data['discount_price'] = empty($this->input->post('discount_price')) ? '' : $this->input->post('discount_price');
			$data['city'] = empty($this->input->post('city')) ? '' : $this->input->post('city');
			$data['price'] = empty($this->input->post('price')) ? '' : $this->input->post('price');
			$data['description'] = empty($this->input->post('description')) ? '' : $this->input->post('description');
			$data['features'] = empty($this->input->post('features')) ? '' : $this->input->post('features');
			$data['fuel_type'] = empty($this->input->post('fuel_type')) ? '' : $this->input->post('fuel_type');
			$data['regno'] = empty($this->input->post('regno')) ? '' : $this->input->post('regno');
			$data['transmission'] = empty($this->input->post('transmission')) ? '' : $this->input->post('transmission');
			$data['ownership'] = empty($this->input->post('ownership')) ? '' : $this->input->post('ownership');
			$data['added_by'] = empty($this->input->post('added_by')) ? '' : $this->input->post('added_by');
			$data['added_type'] = empty($this->input->post('added_type')) ? '' : $this->input->post('added_type');

			

			if($id == ""){
				$data['is_active'] = 1;
				$data['status'] = 'Pending';
			}
			else{
				$data['is_active'] = empty($this->input->post('is_active')) ? '' : $this->input->post('is_active');
			$data['status'] = empty($this->input->post('status')) ? '' : $this->input->post('status');
			}
			

			if ($id == "") {
				if(count($getVehiclebyReg) > 0){
					echo json_encode(array('status' => "error", 'msg' => 'Vehicle with regNo already exist'));
				}
				else{
					$res = $this->Manage_product->insertMPVehicle($data);
					file_put_contents('C:\xampp\htdocs\vahaan-admin\custom_debug_insert.txt', "Insert Result: " . print_r($res, true) . "\n", FILE_APPEND);
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
		}

		public function uploadMKMultipleImages()
		{
			$vehicleId = empty($this->input->post('vehicle_id')) ? '' : $this->input->post('vehicle_id');
			try {
				$config['upload_path'] = './images/vehicle_image/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['width']    = '150';
				$config['height']   = '150';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('image')) {
					$image	= 	$this->upload->data();
					$log_image['image'] = empty($image['file_name']) ? '' : $image['file_name'];
					$log_image['vehicle_id'] = $vehicleId;
					$msg  = $this->Manage_product->insertMPVehicleImages($log_image);
					$this->upload->display_errors();
				} else {

					$this->upload->display_errors();
				}

				echo json_encode(array('msg' => "Uploaded"));
			} catch (Exception $e) {
				echo json_encode(array('msg' => "$e->message"));
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
			$filter['city'] = $this->input->post('city');
			$filter['state'] = $this->input->post('state');


			$totalVehicles = $this->Manage_product->getAllMPVehicles($filter);
			$res = $this->Manage_product->getAllMPVehiclesWithLimit($filter,$start, $limit);

			if ($res) {
				echo json_encode(array('status' => "ok", "data" => $res, "total" => $totalVehicles));
			} else {
				echo json_encode(array('status' => "ok", "data" => [],"total" => 0));
			}
		}

		public function getAllMPVehiclesByVendor()
		{
			$start = $this->input->post('start');
			$limit = $this->input->post('limit');
			$vendor_id = $this->input->post('vendor_id');
			$totalVehicles = $this->Manage_product->getAllMPVehiclesByVendor($vendor_id);
			$soldVehicles = $this->Manage_product->getAllMPSoldVehiclesByVendor($vendor_id);
			$liveVehicles = $this->Manage_product->getAllMPLiveVehiclesByVendor($vendor_id);
			$offlineVehicles = $this->Manage_product->getAllMPOfflineVehiclesByVendor($vendor_id);

			$res = $this->Manage_product->getAllMPVehiclesByVendorWithLimit($vendor_id,$limit, $start);

			if ($res) {
				echo json_encode(array('status' => "ok", "data" => $res, "total" => $totalVehicles,"sold"=>$soldVehicles,"live"=>$liveVehicles,"offline"=>$offlineVehicles));
			} else {
				echo json_encode(array('status' => "error", "data" => []));
			}
		}

		public function updateMPVehicleStatus(){
			$id = $this->input->post('id');

			$data['status'] = empty($this->input->post('status')) ? '' : $this->input->post('status');

			$res = $this->Manage_product->updateMPVehicle($id,$data);

			if($res == 1){
				echo json_encode(array('status' =>'success'));
			}
			else{
				echo json_encode(array('status' =>'error'));

			}

		}

		public function updateMPVehicleActive(){
			$id = $this->input->post('id');

			$data['is_active'] = empty($this->input->post('is_active')) ? '' : $this->input->post('is_active');

			$res = $this->Manage_product->updateMPVehicle($id,$data);

			if($res == 1){
				echo json_encode(array('status' =>'success'));
			}
			else{
				echo json_encode(array('status' =>'error'));

			}

		}

		public function getMPVehicleById(){
			$id = $this->input->post('id');

			$res = $this->Manage_product->getMPVehicleById($id);
			if(count($res) > 0){
				echo json_encode(array('status' =>'success',"data"=>$res[0]));
			}
			else{
				echo json_encode(array('status' =>'error',"data"=>[]));

			}

		}

		function getAllDealerDataById()
	{
		      $id = $this->input->post('id');

				$res = $this->Manage_product->getAllDealerDataById($id);

				if (count($res) > 0) {
					echo json_encode(array('status' => "ok", 'data' => $res));
				} else {
					echo json_encode(array('status' => "ok", 'data'=>[]));
				}
		
	}

	public function getAllMPVehicleByDealerId(){
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

	}

		public function getMoreMPVehicleByDealer(){
			$id = $this->input->post('id');
			$dealerId = $this->input->post('dealerId');

			$res = $this->Manage_product->getMoreMPVehicleByDealer($id,$dealerId);
			// print_r($res);
			if(count($res) > 0){
				echo json_encode(array('status' =>'success',"data"=>$res));
			}
			else{
				echo json_encode(array('status' =>'error',"data"=>[]));

			}

		}

		
		public function getMoreVehicleBySameCars(){
			$catId = $this->input->post('cat');
			$brandId = $this->input->post('brand_id');
			$modelId = $this->input->post('model_id');

			$res = $this->Manage_product->getMoreVehicleBySameCars($catId,$brandId,$modelId);
			// print_r($res);
			if(count($res) > 0){
				echo json_encode(array('status' =>'success',"data"=>$res[0]));
			}
			else{
				echo json_encode(array('status' =>'error',"data"=>[]));

			}

		}

		public function getVehicleByIdEdit(){
			$id = $this->input->post('id');

			$res = $this->Manage_product->getMPVehicleByIdv2($id);
			if(count($res) > 0){
				echo json_encode(array('status' =>'success',"data"=>$res[0]));
			}
			else{
				echo json_encode(array('status' =>'error',"data"=>[]));

			}

		}

		public function deleteMPVehicle()
		{
			$id = $this->input->post('id');


			$data = $this->Manage_product->deleteMPVehicle($id);

			$getImages = $this->Manage_product->getAllMPImages($id);

			if($data == 1){

				foreach($getImages as $img){
                    $path = FCPATH . "images/vehicle_image/".$img['image'];
					$this->Manage_product->deleteMPVehicleImages($img['id'],$path);
				}
				echo json_encode(array('status' =>'success',"msg"=>"Deleted Success"));
			}
			else{
				echo json_encode(array('status' =>'error',"msg"=>"Error On  Deletion.."));
			}
		}

		public function insertMPEnquiry(){
			$data['user_id'] = empty($this->input->post('user_id')) ? '' : $this->input->post('user_id');
			$data['dealer_id'] = empty($this->input->post('dealer_id')) ? '' : $this->input->post('dealer_id');
			$data['vehicle_id'] = empty($this->input->post('vehicle_id')) ? '' : $this->input->post('vehicle_id');
			$data['status'] = empty($this->input->post('status')) ? '' : $this->input->post('status');

			$res = $this->Manage_product->insertMPEnquiry($data);

			if($res['msg'] == 1){
				$getEnq = $this->Manage_product->getMPEnquiryById($res['last_id']);
				$this->sendNotificationEnquiry($data['dealer_id'],$res['last_id'],'Simple',$getEnq);
				echo json_encode(array('status' =>'success'));
			}
			else{
				echo json_encode(array('status' =>'error'));

			}

		}

		public function getAllStates()
		{

			$data = $this->Manage_product->getAllStates();

			echo json_encode($data);
		}


		public function getAllCityByState()
		{
			$stateId= empty($this->input->post('state')) ? '' : $this->input->post('state');

			$data = $this->Manage_product->getAllCityByState($stateId);

			echo json_encode($data);
		}

		
		public function getModelDetailsById()
		{
			$id= empty($this->input->post('id')) ? '' : $this->input->post('id');

			$data = $this->Manage_product->getModelById($id);

			echo json_encode($data);
		}


		public function insertCustomMPEnquiry(){
			$userId = empty($this->input->post('userId')) ? '' : $this->input->post('userId');

			$getUserById = $this->Manage_product->getUserById($userId);

			$cData['userId'] = empty($this->input->post('userId')) ? '' : $this->input->post('userId');
			$cData['ownership'] = empty($this->input->post('ownership')) ? '' : $this->input->post('ownership');
			$cData['city'] = $getUserById[0]['city'];
			$cData['category_id'] = empty($this->input->post('category')) ? '' : $this->input->post('category');
			$cData['brand_id'] = empty($this->input->post('brand')) ? '' : $this->input->post('brand');
			$cData['model_id'] = empty($this->input->post('model')) ? '' : $this->input->post('model');
			$cData['status'] = "Enquired";

			$res = $this->Manage_product->insertCustomMPEnquiry($cData);

			if($res['msg'] == 1){
				$this->sendNotificationCustomEnquiry($cData['city'],$res['last_id'],'Custom');
				echo json_encode(array('status' =>"success"));
			}
			else{
				echo json_encode(array('status' =>"error"));

			}
		}

		///App above api completed .. 
		
		function searchCars(){
			$query = $this->input->post('search');

			$searchResult = [];

			$getAllCatBySearch = $this->Manage_product->getAllCatBySearch($query);
			$getAllBrandBySearch = $this->Manage_product->getAllBrandBySearch($query);
			$getAllModelBySearch = $this->Manage_product->getAllModelBySearch($query);

			foreach($getAllCatBySearch as $cat){
				$data['search_key'] = 'category_id';
				$data['search_id'] = $cat['id'];
				$data['name'] = $cat['name'];

				$searchResult[] = $data;
			}

			foreach($getAllBrandBySearch as $brand){
				$data['search_key'] = 'brand_id';
				$data['search_id'] = $brand['id'];
				$data['name'] = $brand['name'];

				$searchResult[] = $data;
			}


			foreach($getAllModelBySearch as $model){
				$data['search_key'] = 'model_id';
				$data['search_id'] = $model['id'];
				$data['name'] = $model['name'];

				$searchResult[] = $data;
			}

			echo json_encode($searchResult);

		}

		function getAllEnquiry(){
			$user = $this->input->post('userId');
			$start = $this->input->post('start');
			$limit = $this->input->post('limit');

			$getUser = $this->Manage_product->getUserById($user);

			$getCity = $getUser[0]['city'];

			$total = $this->Manage_product->getAllVehicleEnquiryByDealer($user);
			$getAllEnq = $this->Manage_product->getAllVehicleEnquiryByDealerWithLimit($user,$start,$limit);
			
			$enqfinal = array();

			if(count($getAllEnq) > 0){

				foreach($getAllEnq as $enq){
					$userDet = $this->Manage_product->getUserById($enq['user_id']);
					$getVeh = $this->Manage_product->getMPVehicleByIdv2($enq['vehicle_id']);
					$getBrand = $this->Manage_product->getBrandById($getVeh[0]['brand_id']);
					$getModel = $this->Manage_product->getBrandById($getVeh[0]['model_id']);
					$datm['cust_name'] = $userDet[0]['firstName'];
					$datm['cust_email'] = $userDet[0]['email'];
					$datm['cust_phone'] = $userDet[0]['phoneNumber'];
					$datm['vehicle_brand'] = $getBrand[0]['name'];
					$datm['vehicle_model'] = $getModel[0]['name'];
					$datm['vehicle_regno'] = $getVeh[0]['regno'];
					$datm['date'] = date("d-m-Y", strtotime($enq['created']));
					$datm['enqId'] = $enq['id'];
					$datm['status'] = $enq['status'];
					$datm['hide'] = $enq['hide'];
					$enqfinal [] = $datm;
				}

			}
			else{

				$enqfinal = [];

			}

			// print_r($enqfinal);
			echo json_encode(array('data'=>$enqfinal,'total'=>$total));

		}

		function getAllCustomEnquiry(){
			$user = $this->input->post('userId');
			$start = $this->input->post('start');
			$limit = $this->input->post('limit');
			$getUser = $this->Manage_product->getUserById($user);

			$getCity = $getUser[0]['city'];

			$total = $this->Manage_product->getAllVehicleEnquiryByDealerCity($getCity);
			$getAllEnqCity = $this->Manage_product->getAllVehicleEnquiryByDealerCityWithLimit($getCity,$start,$limit);

			
			$enqfinal = array();
			
			if(count($getAllEnqCity) > 0){
				foreach($getAllEnqCity as $enqv2){
					$userDetv2 = $this->Manage_product->getUserById($enqv2['userId']);
					$category = json_decode($enqv2['category_id'],true);
					$brand = json_decode($enqv2['brand_id'],true);
					$model = json_decode($enqv2['model_id'],true);
					$ownership = $enqv2['ownership'];
					
					$carArr= array();
					$i = 0;
					foreach($category as $c){

						$getCategory = $this->Manage_product->getCategoryById($c);
						$getBrand = $this->Manage_product->getBrandById($brand[$i]);
						$getModel = $this->Manage_product->getModelById($model[$i]);

						$log['category_id'] = $getCategory[0]['name'];
						$log['brand_id'] = $getBrand[0]['name'];
						$log['model_id'] = $getModel[0]['name'];
						$log['ownership'] = $enqv2['ownership'];

						$carArr[]=$log;
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
					$enqfinal [] = $datm;
				}
			}
			else{

				$enqfinal = [];

			}


			echo json_encode(array('data'=>$enqfinal,'total'=>$total));

		}

		// function checkUser($id){
		// 	$getUserById = $this->Manage_product->getUserById($id);
		// 	if(count($getUserById) > 0){
		// 		echo json_encode(array("authenticated"=> true));
		// 	}
		// 	else{
		// 		echo json_encode(array("authenticated"=> false));

		// 	}
		// }

		function updateEnquiryStatus(){

			$id = $this->input->post('id');
			$data['status'] = $this->input->post('status');

			$res = $this->Manage_product->updateMPEnquiry($id,$data);
			if($res == 1){
				echo json_encode(array("status"=>"ok"));
			}
			else{
				echo json_encode(array("status"=>"error"));

			}
             
		}

		function updateEnquiryVisibilty(){

			$id = $this->input->post('id');
			$data['hide'] = $this->input->post('hide');

			$res = $this->Manage_product->updateMPEnquiry($id,$data);
			if($res == 1){
				echo json_encode(array("status"=>"ok"));
			}
			else{
				echo json_encode(array("status"=>"error"));

			}
             
		}

		function updateMpVehicleVisibility(){

			$id = $this->input->post('id');
			$data['hide'] = $this->input->post('hide');

			$res = $this->Manage_product->updateMPVehicle($id,$data);
			if($res == 1){
				echo json_encode(array("status"=>"success"));
			}
			else{
				echo json_encode(array("status"=>"error"));

			}
             
		}

		function updateCustomEnquiryStatus(){

			$id = $this->input->post('id');
			$data['status'] = $this->input->post('status');

			$res = $this->Manage_product->updateCustomMPEnquiry($id,$data);
			if($res == 1){
				echo json_encode(array("status"=>"ok"));
			}
			else{
				echo json_encode(array("status"=>"error"));

			}
             
		}

		function updateCustomEnquiryVisibilty(){

			$id = $this->input->post('id');
			$data['hide'] = $this->input->post('hide');

			$res = $this->Manage_product->updateCustomMPEnquiry($id,$data);
			if($res == 1){
				echo json_encode(array("status"=>"ok"));
			}
			else{
				echo json_encode(array("status"=>"error"));

			}
             
		}

		function getHomeCarsWithLimit(){

			$limit = $this->input->post("limit");
			$notinId = $this->input->post("notinId");
			$listing = $this->input->post("listing");
			

			$res = $this->Manage_product->getHomeCarsWithLimit($limit,$notinId,$listing);

			echo json_encode($res);


		}

		function updateBlockStatus(){

			$id = $this->input->post('id');

			$data['blocked'] = $this->input->post('status');

			$res = $this->Manage_product->updateUser($id,$data);
			if($res == 1){
				echo json_encode(array('status' =>"ok"));
			}
			else{
				echo json_encode(array('status' =>"error"));

			}
		}

		
		function updateVerifyStatus(){

			$id = $this->input->post('id');
             
			$data['status'] = $this->input->post('status');

			$res = $this->Manage_product->updateUser($id,$data);
			if($res == 1){
				echo json_encode(array('status' =>"ok"));
			}
			else{
				echo json_encode(array('status' =>"error"));

			}
		}

		function getUserById(){

			$id = $this->input->post("userId");
	
			$res = $this->Manage_product->getUserByIdUpdate($id);

			echo json_encode($res);
		}


		function updateUser(){

			$id = $this->input->post("userId");

			$data['firstName'] = $this->input->post("name");
			$data['email'] = $this->input->post("email");
			$data['phoneNumber'] = $this->input->post("phoneNumber");
			$data['address'] = $this->input->post("address");
			$data['city'] = $this->input->post("city");
			$data['state'] = $this->input->post("state");
			$data['yearinbzns'] = $this->input->post("yearinbzns");
			$data['partner'] = $this->input->post("partner");
			$data['partnerphone'] = $this->input->post("partnerphone");
			$data['partneremail'] = $this->input->post("partneremail");
		
		$config['upload_path'] = './images/profile/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
			$config['width']    = '150';
			$config['height']   = '150';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('gst')) {
				//echo "jj";
				$gst	= 	$this->upload->data();
				$config['image_library'] = 'gd2';
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				//echo $this->image_lib->display_errors();
			} else {
				$this->upload->display_errors();
			}
			$data['gst'] = empty($gst['file_name']) ? '' : $gst['file_name'];

				$config['upload_path'] = './images/profile/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
			$config['width']    = '150';
			$config['height']   = '150';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('pan')) {
				//echo "jj";
				$pan	= 	$this->upload->data();
				$config['image_library'] = 'gd2';
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				//echo $this->image_lib->display_errors();
			} else {
				$this->upload->display_errors();
			}
			$data['pan'] = empty($pan['file_name']) ? '' : $pan['file_name'];

					$config['upload_path'] = './images/profile';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
					$config['width']    = '150';
					$config['height']   = '150';
					$this->load->library('upload', $config);
					if($this->upload->do_upload('logo')){
					$dealerLogo	= 	$this->upload->data();
				$this->load->library('image_lib',$config);
				$this->image_lib->resize();
		 $data['logo'] = empty($dealerLogo['file_name']) ? '' :$dealerLogo['file_name'];
					}

	
			$res = $this->Manage_product->updateUser($id,$data);

			if($res == 1){
				echo json_encode(array("status"=>"success"));
			}
			else{
				echo json_encode(array("status"=>"error"));
			}
		}

		public function insertCity()
		{

			$id  = empty($this->input->post('id')) ? '' : $this->input->post('id');

			$data['state_id'] = empty($this->input->post('state_id')) ? '' : $this->input->post('state_id');
			$data['city'] = empty($this->input->post('city')) ? '' : $this->input->post('city');

			if ($id == "") {
				$this->Manage_product->insertCity($data);

				redirect(base_url() . "Main_con/view_city");
			} else {
				$this->Manage_product->updateCity($id, $data);

				redirect(base_url() . "Main_con/view_city");
			}
		}

		
		public function insertState()
		{

			$id  = empty($this->input->post('id')) ? '' : $this->input->post('id');

			$data['state'] = empty($this->input->post('state')) ? '' : $this->input->post('state');

			if ($id == "") {
				$this->Manage_product->insertState($data);

				redirect(base_url() . "Main_con/view_state");
			} else {
				$this->Manage_product->updateState($id, $data);

				redirect(base_url() . "Main_con/view_state");
			}
		}

		public function deleteCity($id)
		{

			$data = $this->Manage_product->deleteCity($id);

			echo json_encode(array("status" => TRUE));
		}

		public function deleteState($id)
		{

			$data = $this->Manage_product->deleteState($id);

			echo json_encode(array("status" => TRUE));
		}

		public function deleteMPVehicleMultiImage(){
			$id = $this->input->post('id');	

			$res = $this->Manage_product->deleteMPVehicleMultiImage($id);

			if($res == 1){
				echo json_encode(array('status' =>'success'));
			}
			else{
				echo json_encode(array('status' =>'error'));

			}

		}

		public function insertPriceRequest()
		{

			// $id = empty($this->input->post('id')) ? '' : $this->input->post('id');

			// $data['image'] = empty($image['file_name']) ? '' : $image['file_name'];
			// if ($data['image'] == "") {

			// 	$data['image'] = empty($this->input->post('image_old')) ? '' : $this->input->post('image_old');
			// }
		
			
			$data['price'] = empty($this->input->post('price')) ? '' : $this->input->post('price');
			$data['user_id'] = empty($this->input->post('user_id')) ? '' : $this->input->post('user_id');
			$data['vehicle_id'] = empty($this->input->post('vehicle_id')) ? '' : $this->input->post('vehicle_id');

			// if ($id == "") {
				$this->Manage_product->insertPriceRequest($data);
				// redirect(base_url() . "Main_con/view_packages");
			// } else {
				// $this->Manage_product->updatePackages($id, $data);
				// redirect(base_url() . "Main_con/view_packages");
			// }
		}

		

		public function insertAppointment()
		{

			// $id = empty($this->input->post('id')) ? '' : $this->input->post('id');

			// $data['image'] = empty($image['file_name']) ? '' : $image['file_name'];
			// if ($data['image'] == "") {

			// 	$data['image'] = empty($this->input->post('image_old')) ? '' : $this->input->post('image_old');
			// }
		
			
			$data['user_id'] = empty($this->input->post('user_id')) ? '' : $this->input->post('user_id');
			$data['vehicle_id'] = empty($this->input->post('vehicle_id')) ? '' : $this->input->post('vehicle_id');
			$data['date'] = empty($this->input->post('date')) ? '' : $this->input->post('date');
			$data['time'] = empty($this->input->post('time')) ? '' : $this->input->post('time');
			$data['description'] = empty($this->input->post('description')) ? '' : $this->input->post('description');

			// if ($id == "") {
				$this->Manage_product->insertAppointment($data);
				// redirect(base_url() . "Main_con/view_packages");
			// } else {
				// $this->Manage_product->updatePackages($id, $data);
				// redirect(base_url() . "Main_con/view_packages");
			// }
		}

		public function insertServiceCategory()
		{

			$id  = empty($this->input->post('id')) ? '' : $this->input->post('id');
			// $config['upload_path'] = './images/category_image/';
			// $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
			// $config['width']    = '150';
			// $config['height']   = '150';
			// $this->load->library('upload', $config);
			// $this->upload->initialize($config);
			// if ($this->upload->do_upload('image')) {
			// 	$image	= 	$this->upload->data();
			// 	$config['image_library'] = 'gd2';
			// 	$this->load->library('image_lib', $config);
			// 	$this->image_lib->resize();
			// } else {
			// 	$this->upload->display_errors();
			// }



			// $data['image'] = empty($image['file_name']) ? '' : $image['file_name'];
			// if ($data['image'] == "") {
			// 	$data['image'] = empty($this->input->post('image_old')) ? '' : $this->input->post('image_old');
			// }

			$data['name'] = empty($this->input->post('name')) ? '' : $this->input->post('name');
			$data['slug'] = empty($this->input->post('slug')) ? '' : $this->input->post('slug');


			if ($id == "") {
				$this->Manage_product->insertServiceCategory($data);

				// redirect(base_url() . "Main_con/view_category");
				echo 1;
			} else {

				$this->Manage_product->updateServiceCategory($id, $data);

				// redirect(base_url() . "Main_con/view_category");
				echo 2;
			}
		}

		// function tempF(){
		// 	$url = "https://parseapi.back4app.com/classes/Carmodels_Car_Model_List";

		// 	$headers = array(
		// 		'X-Parse-Application-Id: F4z7iiZisloD45lolkgnkhObE8lbJxPFi4YHG9xV',
		// 		'X-Parse-REST-API-Key: ZZYXo7njq9fTilkkcdmMolFl97EUVWYH3Om8OzkV'
		// 	);
		// 	$crl = curl_init();
		// 	curl_setopt($crl, CURLOPT_URL, $url);
		// 	curl_setopt($crl, CURLOPT_HTTPHEADER, $headers);
		// 	curl_setopt($crl, CURLOPT_FRESH_CONNECT, true);
		// 	curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
	
		// 	$response = curl_exec($crl);
		// 	if (!$response) {
		// 		die('Error: "' . curl_error($crl) . '" - Code: ' . curl_errno($crl));
		// 	}
	
		// 	$rd = json_decode($response, true);


		// 	$uniqueMake = [];

		// 	foreach($rd['results'] as $cat){
		// 		if($cat['Category'] == "SUV"){
		// 			if (!in_array($cat['Make'], $uniqueMake)) {
		// 				$uniqueMake[] = $cat['Make'];
		// 				// $log['brand_id'] = 16;
		// 				// $log['name'] = $cat['Model'];

		// 				// $this->Manage_product->insertCarModel($log);
		// 			}
		// 		}
			
		// 	}

		// 	print_r($uniqueMake);

		// 	// echo "done - Jaguar";
	
		// }

		function generateUniqueId($lastInsertedId = null, $prefix = "VA") {
			// Step 1: Get the current date in YYMMDD format
			$dateComponent = date("ymd");
		
			// Step 2: Determine the new sequential number
			$newNumber = 1;
			if ($lastInsertedId !== null) {
				// Extract the sequential number part from the last unique ID
				$lastNumber = intval(substr($lastInsertedId, strlen($prefix) + 6)); // Length of prefix + date component
				$newNumber = $lastNumber + 1;
			}
		
			// Step 3: Combine all parts to form the new unique ID
			$newUniqueId = $prefix . $dateComponent . str_pad($newNumber, 4, '0', STR_PAD_LEFT); // Padding the number with leading zeros
		
			return $newUniqueId;
		}


		function getAccessToken($serviceAccountPath)
		{
			$client = new Client();
			$client->setAuthConfig($serviceAccountPath);
			$client->addScope('https://www.googleapis.com/auth/firebase.messaging');
			$client->useApplicationDefaultCredentials();
			$token = $client->fetchAccessTokenWithAssertion();
			return $token['access_token'];
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


		function sendNotificationEnquiry($userId,$enqId,$enqType,$enqData)
	{

		$getUser = $this->Manage_product->getUserById($userId);

		if(!empty($getUser[0]['device_token'])){
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
				'data'=> ['userId' => "$userId", 'enqId' => "$enqId",'enqType'=>$enqType,'enqData'=>$enqData]
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

	function sendNotificationCustomEnquiry($city,$enqId,$enqType)
	{

		$getUser = $this->Manage_product->getDealerByCity($city);

		foreach($getUser as $user){

			if(!empty($user['device_token'])){
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
					'data'=> ['userId' => "$userId", 'enqId' => "$enqId",'enqType'=>$enqType]
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

	function sendNotificationAdmin()
	{

		$title = $this->input->post('title');
		$body = $this->input->post('body');
		$type = $this->input->post('type');

		if($type == 'ALL'){
			$getUser = $this->Manage_product->getAllUsersV2Notify();
		}
		else{
			$getUser = $this->Manage_product->getAllUsersNotify($type);
		}

		foreach($getUser as $user){

			if(!empty($user['device_token'])){
				$serviceAccountPath = APPPATH . 'libraries/vahan-81416-55634a9d101c.json';

				// Your Firebase project ID
				$projectId = 'vahan-81416';
		
				// Example message payload
				$message = [
					'token' => $user['device_token'],
					'notification' => [
						'title' => $title,
						'body' => $body,
					],
				];
				try {
					$accessToken = $this->getAccessToken($serviceAccountPath);
					$response = $this->sendMessage($accessToken, $projectId, $message);
					echo 'Message sent successfully: ' . print_r($response, true);
				} catch (Exception $e) {
					echo 'Error: ' . $e->getMessage();
				}
			}
	
		}
	

	}

	public function updateQuoteByBookingId()
	{
		date_default_timezone_set("Asia/kolkata");
		$bookingId = empty($this->input->post('bookingId')) ? '' : $this->input->post('bookingId');
		$userId = empty($this->input->post('userId')) ? '' : $this->input->post('userId');
		$getUser = $this->Manage_product->getUserById($userId);
		$data['total_quote'] = empty($this->input->post('total_quote')) ? '' : $this->input->post('total_quote');
		$data['quote_date'] = date("Y-m-d");
		$res = $this->Manage_product->updateBooking($bookingId, $data);

		if ($res == 1) {
			$this->sendQuoteEmail($data,$getUser[0]['email']);
			$this->sendAdminQuoteEmail($data);
			redirect(base_url() . "Main_con/orderdetails/$bookingId");
		} else {
			echo 'Error on updating bookings';
		}
	}

	public function sendQuoteEmail($log_data, $email,$provider = 'gmail')
	{
		$message = $this->load->view('email/quote_email.php', $log_data, true);
		$config = $this->config->item($provider); // Load the selected SMTP config

        if (!$config) {
            echo "Invalid email provider selected!";
            return;
        }

        $this->email->initialize($config); // Apply the SMTP configuration

        // Email details
        $this->email->from($config['smtp_user'], 'Vahan Assist'); // Sender
        $this->email->to($email);  // Recipient
        $this->email->subject('Test Email from CodeIgniter using ');
        $this->email->message($message);

        // Send email
        if ($this->email->send()) {
            // echo '✅ Email sent successfully via ' . ucfirst($provider) . '!';
        } else {
            // echo '❌ Email failed to send via ' . ucfirst($provider) . '. Debug info:';
            // echo $this->email->print_debugger();
        }
	}

	public function sendAdminQuoteEmail($log_data,$provider = 'gmail')
	{
		$message = $this->load->view('email/quote_email.php', $log_data, true);
		$config = $this->config->item($provider); // Load the selected SMTP config

        if (!$config) {
            echo "Invalid email provider selected!";
            return;
        }

        $this->email->initialize($config); // Apply the SMTP configuration

        // Email details
        $this->email->from($config['smtp_user'], 'Vahan Assist'); // Sender
        $this->email->to('info@vahanassist.com');  // Recipient
        $this->email->subject('Test Email from CodeIgniter using ');
        $this->email->message($message);

        // Send email
        if ($this->email->send()) {
            // echo 'Email sent successfully via ' . ucfirst($provider) . '!';
        } else {
            // echo 'Email failed to send via ' . ucfirst($provider) . '. Debug info:';
            // echo $this->email->print_debugger();
        }
	}


	public function deleteCarDropImage()
	{
				$id = $this->input->post('id');
				$bookingId = $this->input->post('bookingId');


				$data = $this->Manage_product->deleteCarDropImage($id);

				if ($data == 1) {
					redirect(base_url()."Main_con/orderdetails/$bookingId");
				} else {
					echo json_encode(array('status' => 'error', "msg" => "Error On  Deletion.."));
				}
	}

	public function deleteCarPickupImage()
	{

				$id = $this->input->post('id');
				$bookingId = $this->input->post('bookingId');


				$data = $this->Manage_product->deleteCarPickupImage($id);

				if ($data == 1) {
					redirect(base_url()."Main_con/orderdetails/$bookingId");
				} else {
					echo json_encode(array('status' => 'error', "msg" => "Error On  Deletion.."));
				}
	}



		public function insertCarPickupDropImages()
		{

			$bookingId = empty($this->input->post('bookingId')) ? '' : $this->input->post('bookingId');
			$type = $this->input->post('type');
			$data['carId'] = empty($this->input->post('carId')) ? '' : $this->input->post('carId');
			$data['driverId'] = empty($this->input->post('driverId')) ? '' : $this->input->post('driverId');

			$config['upload_path'] = './images/vehicle_image/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
			$config['width']    = '150';
			$config['height']   = '150';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('image')) {
				$image	= 	$this->upload->data();
				$config['image_library'] = 'gd2';
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
			} else {
				$this->upload->display_errors();
			}


			$data['image'] = empty($image['file_name']) ? '' : $image['file_name'];

			if(!$type){
				echo "Select  Pickup or Drop Image to upload";
				return;
			}

			if($type == 'pickup'){
				$res = $this->App_model->insertCarPickupImage($data);
				if($res == 1){
					redirect(base_url()."Main_con/orderdetails/$bookingId");
				}
			}

			if($type == 'drop'){
				$res = $this->App_model->insertCarDropImage($data);
				if($res == 1){
					redirect(base_url()."Main_con/orderdetails/$bookingId");
				}
			}

		}

	}
