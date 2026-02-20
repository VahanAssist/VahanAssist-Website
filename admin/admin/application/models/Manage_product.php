<?php

class Manage_product extends CI_Model
{

	function __construct()
	{
		# code...
	}


	function checkEmail($email)
	{

		$query  = $this->db->where('email', $email);

		$query = $this->db->get('tbl_signup');

		return $query->result_array();
	}
	function getShopImage($shop_id)
	{

		$query  = $this->db->where('shop_id', $shop_id);

		$query = $this->db->get('tbl_shop_image');

		return $query->result_array();
	}

	/////////////////////////////A to Z New Code 25-03-2021 vyanzan////////////////////////////////


	function getCoupon($id)
	{

		if ($id == "") {
		} else {

			$query  = $this->db->where('id', $id);
		}
		//$query  = $this->db->where(1);
		$query = $this->db->get('tbl_coupon');
		return $query->result_array();
	}
	function getSociety($id)
	{

		if ($id == "") {
		} else {

			$query  = $this->db->where('id', $id);
		}
		//$query  = $this->db->where(1);
		$query = $this->db->get('tbl_society');
		return $query->result_array();
	}

	function getOders($id)
	{

		// $this->db->select('*');

		// $this->db->from('tbl_product_category');

		if ($id == "") {

			// $query  = $this->db->where(1);

		} else {

			$query  = $this->db->where('id', $id);
		}

		//$query  = $this->db->where(1);

		$query = $this->db->get('tbl_orders');

		return $query->result_array();
	}
	function getCategoryBySlug($category_name, $slug)
	{


		$query  = $this->db->where('category_name', $category_name);
		$query  = $this->db->where('slug', $slug);


		$query = $this->db->get('tbl_product_category');

		return $query->result_array();
	}

	public function deleteCoupon($id)

	{

		$this->db->where('id', $id);

		$this->db->delete('tbl_coupon');
	}
	public function deleteSociety($id)

	{

		$this->db->where('id', $id);

		$this->db->delete('tbl_society');
	}
	public function deleteUser($id)

	{

		$this->db->where('id', $id);

		$this->db->delete('tbl_signup');
	}

	public function deleteMultiImage($id, $image)

	{
		//			unlink("https://vyanzan.in/admin/images/product_image/napkin_rack_Rs_250.jpeg");
		//			unlink(base_url()."images/product_image/".$image);

		$this->db->where('id', $id);

		$this->db->delete('tbl_shop_image');
	}

	public function deleteProduct($id)

	{

		$this->db->where('id', $id);

		$this->db->delete('tbl_product_details');
	}



	function getProduct($id)
	{

		if ($id == "") {
		} else {

			$query  = $this->db->where('t1.id', $id);
		}

		//$this->db->limit($limit,0);

		// $this->db->order_by('rand()');

		$this->db->select('t1.*,t2.category_name,t2.image');

		$this->db->from('tbl_product_details t1');

		$this->db->join('tbl_product_category t2', 't1.category_id=t2.id');

		//$this->db->join('tbl_subcategory t3' ,'t1.sub_category_id=t3.id');

		$query = $this->db->get();

		//echo $this->db->last_query();

		// $query = $this->db->get('tbl_post');

		return $query->result_array();
	}



	function insertProduct($data)
	{

		if ($data) {
			$this->db->insert('tbl_product_details', $data);
			$last_id = $this->db->insert_id();
			return array('last_id' => $last_id, 'msg' => '1');
		} else {
			return 0;
		}
	}
	function updateProduct($id, $data)
	{
		$this->db->where('id', $id);
		if ($this->db->update('tbl_product_details', $data)) {
			return 1;
		} else {

			return 0;
		}
	}

	function insertSociety($data)
	{

		if ($data) {
			$this->db->insert('tbl_society', $data);
			$last_id = $this->db->insert_id();
			return array('last_id' => $last_id, 'msg' => '1');
		} else {
			return 0;
		}
	}
	function updateSociety($id, $data)
	{
		$this->db->where('id', $id);
		if ($this->db->update('tbl_society', $data)) {
			return 1;
		} else {

			return 0;
		}
	}


	function insertCoupon($data)

	{

		if ($data) {

			$this->db->insert('tbl_coupon', $data);

			$last_id = $this->db->insert_id();

			return array('last_id' => $last_id, 'msg' => '1');
		} else {

			return 0;
		}
	}

	function updateCoupon($id, $data)
	{

		$this->db->where('id', $id);

		if ($this->db->update('tbl_coupon', $data)) {

			return 1;
		} else {



			return 0;
		}
	}



	function getSubCategoryById($category_id)
	{



		if ($category_id == "") {
		} else {

			$query  = $this->db->where('category_id', $category_id);
		}

		$query = $this->db->get('tbl_subcategory');

		// echo  $this->db->last_query();

		return $query->result_array();
	}

	function getSubCatgByCatId($category_id)
	{

		if ($category_id == "") {

			// $query  = $this->db->where(1);

		} else {

			$query  = $this->db->where('category_id', $category_id);
		}



		$query = $this->db->get('tbl_subcategory');

		$allData =  $query->result_array();

?>

		<select id="sub_category_id" class="form-control col-md-7 col-xs-12" name="sub_category_id">

			<option value="">Select SubCategory</option>

			<?php foreach ($allData as $data) {

				//echo $data['id'];



			?>

				<option value="<?php echo $data['id'] ?>" <?php if ($getProduct[0]['sub_category_id'] == $data['id']) {
																echo "selected";
															} ?>> <?php echo $data['subcategory_name'] ?></option>

			<?php  } ?>

		</select>

<?php



	}



	function insertSlider($data)

	{

		if ($data) {

			$this->db->insert('tblg_home_slider', $data);

			$last_id = $this->db->insert_id();

			return array('last_id' => $last_id, 'msg' => '1');
		} else {

			return 0;
		}
	}

	function updateSlider($id, $data)
	{

		$this->db->where('id', $id);

		if ($this->db->update('tblg_home_slider', $data)) {

			return 1;
		} else {



			return 0;
		}
	}

	function getSlider($id)
	{

		// $this->db->select('*');

		// $this->db->from('tbl_product_category');

		if ($id == "") {

			// $query  = $this->db->where(1);

		} else {

			$query  = $this->db->where('id', $id);
		}

		//$query  = $this->db->where(1);

		$query = $this->db->get('tblg_home_slider');

		return $query->result_array();
	}

	public function deleteSlider($id)

	{

		$this->db->where('id', $id);

		$this->db->delete('tblg_home_slider');
	}
	function insertSplace($data)

	{

		if ($data) {

			$this->db->insert('tbl_splace', $data);

			$last_id = $this->db->insert_id();

			return array('last_id' => $last_id, 'msg' => '1');
		} else {

			return 0;
		}
	}

	function updateSplace($id, $data)
	{

		$this->db->where('id', $id);

		if ($this->db->update('tbl_splace', $data)) {

			return 1;
		} else {



			return 0;
		}
	}

	function getSplace($id)
	{

		// $this->db->select('*');

		// $this->db->from('tbl_product_category');

		if ($id == "") {

			// $query  = $this->db->where(1);

		} else {

			$query  = $this->db->where('id', $id);
		}

		//$query  = $this->db->where(1);

		$query = $this->db->get('tbl_splace');

		return $query->result_array();
	}

	public function deleteSplace($id)

	{

		$this->db->where('id', $id);

		$this->db->delete('tbl_splace');
	}





	function insertPage($data)
	{
		if ($data) {
			$this->db->insert('tbl_pages', $data);
			$last_id = $this->db->insert_id();
			return array('last_id' => $last_id, 'msg' => '1');
		} else {
			return 0;
		}
	}
	function insertTestimonial($data)
	{
		if ($data) {
			$this->db->insert('tbl_testimonial', $data);
			$last_id = $this->db->insert_id();
			return array('last_id' => $last_id, 'msg' => '1');
		} else {
			return 0;
		}
	}


	function updatePage($id, $data)
	{
		$this->db->where('id', $id);
		if ($this->db->update('tbl_pages', $data)) {
			return 1;
		} else {
			return 0;
		}
	}
	function updateTestimonial($id, $data)
	{
		$this->db->where('id', $id);
		if ($this->db->update('tbl_testimonial', $data)) {
			return 1;
		} else {
			return 0;
		}
	}

	function getPage($id)
	{

		if ($id == "") {
			// $query  = $this->db->where(1);
		} else {
			$query  = $this->db->where('id', $id);
		}
		//$query  = $this->db->where(1);
		$query = $this->db->get('tbl_pages');
		return $query->result_array();
	}
	function getTestimonial($id)
	{

		if ($id == "") {
			// $query  = $this->db->where(1);
		} else {
			$query  = $this->db->where('id', $id);
		}
		//$query  = $this->db->where(1);
		$query = $this->db->get('tbl_testimonial');
		return $query->result_array();
	}

	public function deletePage($id)

	{

		$this->db->where('id', $id);

		$this->db->delete('tbl_pages');
	}
	public function deleteTestimonial($id)

	{

		$this->db->where('id', $id);

		$this->db->delete('tbl_testimonial');
	}
	function getProductBySlug($product_name, $slug)
	{


		$query  = $this->db->where('product_name', $product_name);
		$query  = $this->db->where('slug', $slug);


		//$query  = $this->db->where(1);

		$query = $this->db->get('tbl_product_details');

		return $query->result_array();
	}
	function getProductImage($id)
	{


		$query  = $this->db->where('shop_id', $id);
		//$query  = $this->db->where('slug',$slug);


		//$query  = $this->db->where(1);

		$query = $this->db->get('tbl_shop_image');

		return $query->result_array();
	}
	function getProductByColor($id)
	{


		$query  = $this->db->where('shop_id', $id);
		//	$query  = $this->db->where('color',$color);
		//$query  = $this->db->where('slug',$slug);


		//$query  = $this->db->where(1);

		$query = $this->db->get('tbl_shop_image');

		return $query->result_array();
	}
	function updateOrder($id, $data)
	{
		$this->db->where('order_id', $id);
		if ($this->db->update('tbl_orders', $data)) {
			return 1;
		} else {

			return 0;
		}
	}
	function getOderDetails($id)
	{



		$query  = $this->db->where('order_id', $id);

		$query = $this->db->get('tbl_ordersdetail');

		// echo $this->db->last_query();

		return $query->result_array();
	}
	function getOderByOrderId($id)
	{



		$query  = $this->db->where('order_id', $id);



		$query = $this->db->get('tbl_orders');

		return $query->result_array();
	}
	/////////////////////////new code 11-4-2020
	function getUser($id)
	{

		if ($id == "") {
		} else {

			$query  = $this->db->where('id', $id);
		}
		//$query  = $this->db->where(1);
		$query = $this->db->get('tbl_signup');
		//echo $this->db->last_query();
		return $query->result_array();
	}

	function getDrivers()
	{

		$query  = $this->db->where('type', 'DRIVER');
		$query = $this->db->get('tbl_signup');
		//echo $this->db->last_query();
		return $query->result_array();
	}

	function getDealerByCity($id)
	{
		$query  = $this->db->where('type', 'DEALER');
		$query  = $this->db->where('city', $id);
		$query = $this->db->get('tbl_signup');
		// echo $this->db->last_query();
		return $query->result_array();
	}

	function getUserById($id)
	{
		$query  = $this->db->where('id', $id);
		$query = $this->db->get('tbl_signup');
		// echo $this->db->last_query();
		return $query->result_array();
	}

	function getUserByIdUpdate($id)
	{
		$this->db->select('tbl_signup.*,tbl_states.state as state_name,tbl_city.city as city_name');
		$this->db->where('tbl_signup.id', $id);
		$this->db->join('tbl_states', 'tbl_states.id = tbl_signup.state', 'left');
		$this->db->join('tbl_city', 'tbl_city.id = tbl_signup.city', 'left');

		$query = $this->db->get('tbl_signup');
		// echo $this->db->last_query();
		$res = $query->result_array();


		$userData = array();
		$userData['name']  = $res[0]['firstName'];
		$userData['email']  = $res[0]['email'];
		$userData['phoneNumber']  = $res[0]['phoneNumber'];
		$userData['address']  = $res[0]['address'];
		$userData['state_name']  = $res[0]['state_name'];
		$userData['city_name']  = $res[0]['city_name'];
		$userData['userId']  = $res[0]['id'];
		$userData['state']  = $res[0]['state'];
		// ----- added on 1 jul
		$userData['partner']  = $res[0]['partner'];
		$userData['partneremail']  = $res[0]['partneremail'];
		$userData['yearinbzns']  = $res[0]['yearinbzns'];
		$userData['partnerphone']  = $res[0]['partnerphone'];
		$userData['gst']  = $res[0]['gst'];
		$userData['pan']  = $res[0]['pan'];
		$userData['logo']  = $res[0]['logo'];

		return $userData;
	}

	function getUserByIdUpdateV2($id)
	{
		$this->db->select('tbl_signup.*,tbl_states.state as state_name,tbl_city.city as city_name');
		$this->db->where('tbl_signup.id', $id);
		$this->db->join('tbl_states', 'tbl_states.id = tbl_signup.state', 'left');
		$this->db->join('tbl_city', 'tbl_city.id = tbl_signup.city', 'left');

		$query = $this->db->get('tbl_signup');
		// echo $this->db->last_query();
		$res = $query->result_array();

		$getwish = $this->getWishByUser($id);
		$getSubscription = $this->getSubscriptionByUserId($id);
		if (count($getSubscription) > 0) {
			$subsData = $this->getSubscriptionById($getSubscription[0]['package_id']);
		} else {
			$subsData = 'Not Subscribed';
		}


		$userData = array();
		$userData['firstName']  = $res[0]['firstName'];
		$userData['lastName']  = $res[0]['lastName'];
		$userData['logo']  = $res[0]['logo'];
		$userData['image']  = $res[0]['image'];
		$userData['type']  = $res[0]['type'];
		$userData['email']  = $res[0]['email'];
		$userData['phoneNumber']  = $res[0]['phoneNumber'];
		$userData['address']  = $res[0]['address'];
		$userData['login_time']  = $res[0]['login_time'];
		$userData['created']  = $res[0]['created'];
		$userData['state_name']  = $res[0]['state_name'];
		$userData['city_name']  = $res[0]['city_name'];
		$userData['userId']  = $res[0]['id'];
		$userData['state']  = $res[0]['state'];
		$userData['yearinbzns']  = $res[0]['yearinbzns'];
		$userData['partner']  = $res[0]['partner'];
		$userData['partnerphone']  = $res[0]['partnerphone'];
		$userData['partneremail']  = $res[0]['partneremail'];
		$userData['gst']  = $res[0]['gst'];
		$userData['pan']  = $res[0]['pan'];
		$userData['wishList'] = $getwish;
		$userData['subscription_data'] = $subsData;

		return $userData;
	}


	function getAllDealerDataById($id)
	{
		$this->db->select('tbl_signup.*,tbl_states.state as state_name,tbl_city.city as city_name');
		$this->db->where('tbl_signup.id', $id);
		$this->db->join('tbl_states', 'tbl_states.id = tbl_signup.state', 'left');
		$this->db->join('tbl_city', 'tbl_city.id = tbl_signup.city', 'left');

		$query = $this->db->get('tbl_signup');
		// echo $this->db->last_query();
		$res = $query->result_array();
		$userData = array();
		unset($res[0]['password']);
		$userData['userData']  = $res[0];
		return $userData;
	}


	function getUserByEmail($email)
	{
		$query  = $this->db->where('email', $email);
		$query = $this->db->get('tbl_signup');
		//echo $this->db->last_query();
		return $query->result_array();
	}

	function getWishByUser($id)
	{
		$query  = $this->db->where('user_id', $id);
		$query = $this->db->get('tbl_wishlist');
		//echo $this->db->last_query();
		$res =  $query->result_array();

		$i = 0;
		foreach ($res as $list) {
			$getVehicleById = $this->getMPVehicleByIdApp($list['product_id']);
			$getStateName = $this->getStateById($getVehicleById[0]['state']);
			$getCityName = $this->getCityById($getVehicleById[0]['city']);
			$getDealerName = $this->getUserById($getVehicleById[0]['added_by']);
			$res[$i]['image'] = $getVehicleById[0]['image'];
			$res[$i]['variant'] = $getVehicleById[0]['variant'];
			$res[$i]['price'] = $getVehicleById[0]['price'];
			$res[$i]['brand_name'] = $getVehicleById[0]['brand_name'];
			$res[$i]['model_name'] = $getVehicleById[0]['model_name'];
			$res[$i]['discount_price'] = $getVehicleById[0]['discount_price'];
			$res[$i]['discount_percent'] = $getVehicleById[0]['discount_percent'];
			$res[$i]['year'] = $getVehicleById[0]['year'];
			$res[$i]['fuel_type'] = $getVehicleById[0]['fuel_type'];
			$res[$i]['kms'] = $getVehicleById[0]['kms'];
			$res[$i]['listingtype'] = $getVehicleById[0]['listingtype'];
			$res[$i]['regno'] = $getVehicleById[0]['regno'];
			$res[$i]['state'] = $getStateName[0]['state'];
			$res[$i]['city'] = $getCityName[0]['city'];
			$res[$i]['dealerName'] = $getDealerName[0]['firstName'] . ' ' . $getDealerName[0]['lastName'];
			$i++;
		}

		return $res;
	}

	function getUserByPhone($phone)
	{
		$query  = $this->db->where('phoneNumber', $phone);
		$query = $this->db->get('tbl_signup');
		//echo $this->db->last_query();
		return $query->result_array();
	}
	function getShop($id)
	{

		if ($id == "") {
			$query  = $this->db->where('status', 1);
		} else {

			$query  = $this->db->where('id', $id);
		}
		//$query  = $this->db->where(1);
		$query = $this->db->get('tbl_signup');
		return $query->result_array();
	}
	function getCategory($id)
	{

		if ($id == "") {
			// $query  = $this->db->where(1);
		} else {
			$query  = $this->db->where('id', $id);
		}
		// $query  = $this->db->where('status', 1);
		$query = $this->db->get('tbl_vehicle_category');
		return $query->result_array();
	}
	function getSubCategory($id)
	{

		if ($id == "") {
			// $query  = $this->db->where(1);
		} else {
			$query  = $this->db->where('id', $id);
		}
		//$query  = $this->db->where(1);
		$query = $this->db->get('tbl_subcategory');
		return $query->result_array();
	}
	function insertCategory($data)
	{
		if ($data) {
			$this->db->insert('tbl_vehicle_category', $data);
			$last_id = $this->db->insert_id();
			return array('last_id' => $last_id, 'msg' => '1');
		} else {
			return 0;
		}
	}

	function updateCategory($id, $data)
	{

		$this->db->where('id', $id);

		if ($this->db->update('tbl_vehicle_category', $data)) {

			return 1;
		} else {



			return 0;
		}
	}

	function insertServiceCategory($data)
	{
		if ($data) {
			$this->db->insert('tbl_service_category', $data);
			return 1;
		} else {
			return 0;
		}
	}

	function updateServiceCategory($id, $data)
	{

		$this->db->where('id', $id);

		if ($this->db->update('tbl_service_category', $data)) {

			return 1;
		} else {

			return 0;
		}
	}

	function insertSubCategory($data)
	{
		if ($data) {
			$this->db->insert('tbl_subcategory', $data);
			$last_id = $this->db->insert_id();
			return array('last_id' => $last_id, 'msg' => '1');
		} else {

			return 0;
		}
	}

	function updateSubCategory($id, $data)
	{
		$this->db->where('id', $id);
		if ($this->db->update('tbl_subcategory', $data)) {
			return 1;
		} else {
			return 0;
		}
	}

	function insertCash($data)
	{
		if ($data) {
			$this->db->insert('tbl_cash_details', $data);
			$last_id = $this->db->insert_id();
			return array('last_id' => $last_id, 'msg' => '1');
		} else {

			return 0;
		}
	}

	function updateCash($id, $data)
	{
		$this->db->where('id', $id);
		if ($this->db->update('tbl_cash_details', $data)) {
			return 1;
		} else {
			return 0;
		}
	}

	function insertShop($data)
	{
		if ($data) {
			$this->db->insert('tbl_signup', $data);
			$last_id = $this->db->insert_id();
			return array('last_id' => $last_id, 'msg' => '1');
		} else {

			return 0;
		}
	}

	function updateShop($id, $data)
	{
		$this->db->where('id', $id);
		if ($this->db->update('tbl_signup', $data)) {
			return 1;
		} else {
			return 0;
		}
	}

	function updateUser($id, $data)
	{
		$this->db->where('id', $id);
		if ($this->db->update('tbl_signup', $data)) {
			// echo $this->db->last_query();
			return 1;
		} else {
			return 0;
		}
	}

	public function deleteCategory($id)

	{

		$this->db->where('id', $id);

		$this->db->delete('tbl_vehicle_category');
	}

	public function deleteBooking($id)

	{

		$this->db->where('id', $id);

		$this->db->delete('tbl_booking');
	}
	public function deleteSubCategory($id)
	{
		$this->db->where('id', $id);

		$this->db->delete('tbl_subcategory');
	}
	function insertShopImage($data)
	{
		if ($data) {
			$this->db->insert('tbl_shop_image', $data);
			$last_id = $this->db->insert_id();
			return array('last_id' => $last_id, 'msg' => '1');
		} else {
			return 0;
		}
	}

	function getDeliveryBoy($id)
	{



		$query  = $this->db->where('status', 2);

		//$query  = $this->db->where(1);
		$query = $this->db->get('tbl_signup');
		return $query->result_array();
	}
	function getCashDetails($id)
	{



		$query  = $this->db->where('created_date', $id);

		//$query  = $this->db->where(1);
		$query = $this->db->get('tbl_cash_details');
		return $query->result_array();
	}
	function getCash($id)
	{



		//$query  = $this->db->where('created_date',$id);

		//$query  = $this->db->where(1);
		$query = $this->db->get('tbl_cash_details');
		return $query->result_array();
	}
	function getOdersCount($id)
	{


		$query  = $this->db->where('show', 0);

		$query = $this->db->get('tbl_orders');
		return $query->result_array();
	}
	function updateAllOrder($id, $data)
	{
		$this->db->where('id', $id);
		if ($this->db->update('tbl_orders', $data)) {
			return 1;
		} else {
			return 0;
		}
	}

	/////////////////////////new code////////////////////////////////////////////////////////


	function getAllEnquiry($id)
	{

		$query = $this->db->get('tbl_enquiry');

		return $query->result_array();
	}

	function getAllBooking($id)
	{

		$query = $this->db->get('tbl_booking');

		return $query->result_array();
	}

	function insertEnquiry($data)
	{

		if ($data) {
			$this->db->insert('tbl_enquiry', $data);
			return 1;
		} else {
			return 0;
		}
	}


	function insertBookingBreakDown($data)
	{

		if ($data) {
			$this->db->insert('tbl_booking_breakdown', $data);
			return 1;
		} else {
			return 0;
		}
	}


	function insertBooking($data)
	{

		if ($data) {
			$this->db->insert('tbl_booking', $data);
			$last_id = $this->db->insert_id();
			return array('last_id' => $last_id, 'msg' => '1');;
		} else {
			return 0;
		}
	}

	function updateBooking($id, $data)
	{
		$this->db->where('id', $id);
		if ($this->db->update('tbl_booking', $data)) {
			return 1;
		} else {
			return 0;
		}
	}

	function updateCarTrailorBooking($id, $data)
	{
		$this->db->where('id', $id);
		if ($this->db->update('tbl_car_detail', $data)) {
			return 1;
		} else {
			return 0;
		}
	}

	// public function get_booking_counts_by_driver($driver_id)
	// {
	// 	$this->db->select('b.bookingType, COUNT(*) as total_bookings');
	// 	$this->db->from('tbl_booking b');
	// 	$this->db->join('tbl_car_detail c', 'b.id = c.bookingId');
	// 	$this->db->group_start(); // For OR condition
	// 	$this->db->where('c.assignDriverId', $driver_id);
	// 	$this->db->or_where('c.assignSecondDriverId', $driver_id);
	// 	$this->db->group_end();
	// 	$this->db->group_by('b.bookingType');

	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

	public function get_booking_counts_by_driver($driver_id)
	{
		$this->db->select('b.bookingType, COUNT(*) as total_bookings');
		$this->db->from('tbl_booking b');
		$this->db->join('tbl_car_detail c', 'b.id = c.bookingId');
		$this->db->group_start();
		$this->db->where('c.assignDriverId', $driver_id);
		$this->db->or_where('c.assignSecondDriverId', $driver_id);
		$this->db->group_end();
		$this->db->group_by('b.bookingType');
		$booking_type_result = $this->db->get()->result();

		// Second Query: Booking Status Counts
		$this->db->select('b.status, COUNT(*) as total_status');
		$this->db->from('tbl_booking b');
		$this->db->join('tbl_car_detail c', 'b.id = c.bookingId');
		$this->db->group_start();
		$this->db->where('c.assignDriverId', $driver_id);
		$this->db->or_where('c.assignSecondDriverId', $driver_id);
		$this->db->group_end();
		$this->db->group_by('b.status');
		$booking_status_result = $this->db->get()->result();

		// Return both in a single response
		return [
			'booking_type_counts' => $booking_type_result,
			'booking_status_counts' => $booking_status_result
		];
	}


	function getBookingById($id)
	{
		$query  = $this->db->where('id', $id);
		$query = $this->db->get('tbl_booking');
		return $query->result_array();
	}

	function getCarDetailsById($id)
	{
		$query  = $this->db->where('id', $id);
		$query = $this->db->get('tbl_car_detail');
		return $query->result_array();
	}

	function getCarDetailsByBooking($id)
	{
		$query  = $this->db->where('bookingId', $id);
		$query = $this->db->get('tbl_car_detail');
		return $query->result_array();
	}

	function getCarDetailsByDriverId($id)
	{
		$query  = $this->db->where('assignDriverId', $id);
		$query = $this->db->get('tbl_car_detail');
		return $query->result_array();
	}
	function getCarDetailsByDriverIdV2($id)
	{
		$query  = $this->db->where('assignSecondDriverId', $id);
		$query = $this->db->get('tbl_car_detail');
		return $query->result_array();
	}

	function getTrackingByBooking($id)
	{
		$query  = $this->db->where('bookingId', $id);
		$query = $this->db->get('tbl_booking_tracking');
		return $query->result_array();
	}

	function getCarPickupImages($id)
	{
		$query  = $this->db->where('driverId', $id);
		$query = $this->db->get('tbl_car_pickup_images');
		return $query->result_array();
	}

	function getCarDropImages($id)
	{
		$query  = $this->db->where('driverId', $id);
		$query = $this->db->get('tbl_car_drop_images');
		return $query->result_array();
	}

	function getTotalCarByBooking($id)
	{
		$query  = $this->db->where('bookingId', $id);
		$query = $this->db->get('tbl_car_detail');
		return $query->num_rows();
	}

	function getCarAssigned($id)
	{
		$query  = $this->db->where('bookingId', $id);
		$query  = $this->db->where('assignDriverId >', 0);
		$query = $this->db->get('tbl_car_detail');
		return $query->num_rows();
	}
	function getCarNotAssigned($id)
	{
		$query  = $this->db->where('bookingId', $id);
		$query  = $this->db->where('assignDriverId =', 0);
		$query = $this->db->get('tbl_car_detail');
		return $query->num_rows();
	}

	function updateCarDetails($id, $data)
	{
		$this->db->where('id', $id);
		if ($this->db->update('tbl_car_detail', $data)) {
			// echo $this->db->last_query();
			return 1;
		} else {
			return 0;
		}
	}

	function insertCarDetails($data)
	{

		if ($data) {
			$this->db->insert('tbl_car_detail', $data);
			return 1;
		} else {
			return 0;
		}
	}

	function updateCarPickupImages($id, $data)
	{
		$this->db->where('carId', $id);
		if ($this->db->update('tbl_car_pickup_images', $data)) {
			return 1;
		} else {
			return 0;
		}
	}
	function updateCarDropImages($id, $data)
	{
		$this->db->where('carId', $id);
		if ($this->db->update('tbl_car_drop_images', $data)) {
			return 1;
		} else {
			return 0;
		}
	}
	//new code


	function getAllCategorys()
	{
		return $this->db->count_all('tbl_vehicle_category');
	}

	function getAllCatsWithLimit($limit, $start)
	{

		$this->db->limit($limit, $start);
		// $this->db->order_by('id', 'DESC');
		$query = $this->db->get('tbl_vehicle_category');
		// echo $this->db->last_query();
		return $query->result_array();
	}

	function getAllEnquirys()
	{
		return $this->db->count_all('tbl_enquiry');
	}

	function getAllEnqWithLimit($limit, $start)
	{

		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('tbl_enquiry');
		// echo $this->db->last_query();
		return $query->result_array();
	}

	function getAllDBookings()
	{
		$this->db->where('bookingType', 'DRIVER');
		$query = $this->db->get('tbl_booking');
		return $query->result_array();
	}

	function getAllBookWithLimit($limit, $start)
	{

		$this->db->where('bookingType', 'DRIVER');
		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('tbl_booking');
		// echo $this->db->last_query();
		return $query->result_array();
	}


	function getAllVBookings()
	{
		$this->db->where('bookingType', 'TRAILER');
		$query = $this->db->get('tbl_booking');
		return $query->result_array();
	}

	function getAllVBookWithLimit($limit, $start)
	{

		$this->db->where('bookingType', 'TRAILER');
		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('tbl_booking');
		// echo $this->db->last_query();
		return $query->result_array();
	}

	function getAllINSPBookings()
	{
		$this->db->where('bookingType', 'INSPECTION');
		$query = $this->db->get('tbl_booking');
		return $query->result_array();
	}

	function getAllINSPWithLimit($limit, $start)
	{

		$this->db->where('bookingType', 'INSPECTION');
		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('tbl_booking');
		// echo $this->db->last_query();
		return $query->result_array();
	}
	function getAlltowingBookings()
	{
		$this->db->where('bookingType', 'TOWING');
		$query = $this->db->get('tbl_booking');
		return $query->result_array();
	}

	function getAlltowingWithLimit($limit, $start)
	{

		$this->db->where('bookingType', 'TOWING');
		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('tbl_booking');
		// echo $this->db->last_query();
		return $query->result_array();
	}
	function getAllrtoBookings()
	{
		$this->db->where('bookingType', 'RTO');
		$query = $this->db->get('tbl_booking');
		return $query->result_array();
	}

	function getAllrtoWithLimit($limit, $start)
	{

		$this->db->where('bookingType', 'RTO');
		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('tbl_booking');
		// echo $this->db->last_query();
		return $query->result_array();
	}

	function getAllinsuranceBookings()
	{
		$this->db->where('bookingType', 'INSURANCE');
		$query = $this->db->get('tbl_booking');
		return $query->result_array();
	}

	function getAllinsuranceWithLimit($limit, $start)
	{

		$this->db->where('bookingType', 'INSURANCE');
		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('tbl_booking');
		// echo $this->db->last_query();
		return $query->result_array();
	}

	function getAllUsers()
	{
		$this->db->where('type', 'USER');
		$query = $this->db->get('tbl_signup');
		// echo $this->db->last_query();
		return $query->result_array();
	}

	function getAllUsersWithLimit($limit, $start)
	{

		$this->db->where('type', 'USER');
		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('tbl_signup');
		// echo $this->db->last_query();
		return $query->result_array();
	}


	function getAllDrivers()
	{
		$this->db->where('type', 'DRIVER');
		$query = $this->db->get('tbl_signup');
		// echo $this->db->last_query();
		return $query->result_array();
	}

	function getAllDriversWithLimit($limit, $start)
	{

		$this->db->where('type', 'DRIVER');
		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('tbl_signup');
		// echo $this->db->last_query();
		return $query->result_array();
	}

	function getAllPages()
	{
		return $this->db->count_all('tbl_pages');
	}

	function getAllPageWithLimit($limit, $start)
	{

		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('tbl_pages');
		// echo $this->db->last_query();
		return $query->result_array();
	}

	function getAllDealers()
	{
		$this->db->where('type', 'DEALER');
		$query = $this->db->get('tbl_signup');
		return $query->num_rows();
	}

	function getAllDealersWithLimit($limit, $start)
	{
		$this->db->where('type', 'DEALER');
		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('tbl_signup');
		// echo $this->db->last_query();
		return $query->result_array();
	}

	function getAllDealersCarsByDealerId($id)
	{
		$this->db->where('added_by', $id);
		$this->db->where('hide', 0);
		$query = $this->db->get('tbl_mp_vehicle');
		return $query->num_rows();
	}

	function getAllDealersCarsByDealerIdWithLimit($id, $start, $limit)
	{

		$this->db->where('added_by', $id);
		$this->db->where('hide', 0);
		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('tbl_mp_vehicle');
		// echo $this->db->last_query();
		return $query->result_array();
	}

	function insertUser($data)
	{

		if ($data) {
			$this->db->insert('tbl_signup', $data);
			return 1;
		} else {
			return 0;
		}
	}

	function getUserLogin($dt)
	{

		$query  = $this->db->where('phoneNumber', $dt['phoneNumber']);
		$query  = $this->db->where('password', $dt['password']);
		$query  = $this->db->where('status', 1);
		$query  = $this->db->where('blocked', 0);
		$query  = $this->db->where('deleteAccountReq', 0);
		$query = $this->db->get('tbl_signup');
		// echo $this->db->last_query();
		return $query->result_array();
	}

	function getBannerById($id)
	{
		$query  = $this->db->where('id', $id);
		$query = $this->db->get('tbl_banner');
		return $query->result_array();
	}

	function getCarBrandById($id)
	{
		$query  = $this->db->where('id', $id);
		$query = $this->db->get('tbl_car_brand');
		return $query->result_array();
	}


	function getCarBrandByCatId($id)
	{
		$query  = $this->db->where('category_id', $id);
		$query = $this->db->get('tbl_car_brand');
		return $query->result_array();
	}
	function getCarModelById($id)
	{
		$query  = $this->db->where('id', $id);
		$query = $this->db->get('tbl_car_model');
		return $query->result_array();
	}

	function getCarModelByBrandId($id)
	{
		$query  = $this->db->where('brand_id', $id);
		$query = $this->db->get('tbl_car_model');
		return $query->result_array();
	}

	function getBanner()
	{
		$query = $this->db->get('tbl_banner');
		return $query->result_array();
	}

	function getCarBrand()
	{
		$query = $this->db->get('tbl_car_brand');
		return $query->result_array();
	}

	function getAllModelV2()
	{
		$query = $this->db->get('tbl_car_model');
		return $query->result_array();
	}

	function getAllModelV3($id)
	{
		$query  = $this->db->where_in('brand_id', json_decode($id));
		$query = $this->db->get('tbl_car_model');
		return $query->result_array();
	}

	function getAllBrandV3($id)
	{
		$query  = $this->db->where_in('category_id', json_decode($id));
		$query = $this->db->get('tbl_car_brand');
		return $query->result_array();
	}

	function getAllBrandByCategoryId($id)
	{
		$query  = $this->db->where('category_id', $id);
		$query = $this->db->get('tbl_car_brand');
		return $query->result_array();
	}

	function getCarModel()
	{
		$query = $this->db->get('tbl_car_model');
		return $query->result_array();
	}

	function insertBanner($data)
	{

		if ($data) {
			$this->db->insert('tbl_banner', $data);
			return 1;
		} else {
			return 0;
		}
	}

	function insertBookingTracking($data)
	{

		if ($data) {
			$this->db->insert('tbl_booking_tracking', $data);
			return 1;
		} else {
			return 0;
		}
	}

	public function deleteBanner($id)

	{

		$this->db->where('id', $id);

		$this->db->delete('tbl_banner');
	}

	function getServices()
	{
		$query = $this->db->get('tbl_services');
		return $query->result_array();
	}

	function getServicesById($id)
	{
		$query  = $this->db->where('id', $id);
		$query = $this->db->get('tbl_services');
		return $query->result_array();
	}


	function insertServices($data)
	{

		if ($data) {
			$this->db->insert('tbl_services', $data);
			return 1;
		} else {
			return 0;
		}
	}


	function updateServices($id, $data)
	{
		$this->db->where('id', $id);
		if ($this->db->update('tbl_services', $data)) {
			return 1;
		} else {
			return 0;
		}
	}

	public function deleteServices($id)

	{

		$this->db->where('id', $id);

		$this->db->delete('tbl_services');
	}

	public function deleteCarBrand($id)

	{

		$this->db->where('id', $id);

		$this->db->delete('tbl_car_brand');
	}

	public function deleteCarModel($id)

	{

		$this->db->where('id', $id);

		$this->db->delete('tbl_car_model');
	}


	function getAllCategoryV2()
	{
		// $query  = $this->db->where('status', 1);
		$query = $this->db->get('tbl_vehicle_category');
		return $query->result_array();
	}

	function getAllVehicles()
	{
		$this->db->where('hide', 0);
		return $this->db->count_all_results('tbl_mp_vehicle');
	}

	function getAllVehiclesWithLimit($limit, $start)
	{


		$this->db->select('tbl_mp_vehicle.*,tbl_vehicle_category.name as category_name,tbl_car_brand.name as brand_name,tbl_car_model.name as model_name,tbl_signup.phoneNumber as owner_contact,tbl_signup.firstName as owner_name');
		$this->db->join('tbl_vehicle_category', 'tbl_vehicle_category.id = tbl_mp_vehicle.category_id', 'left');
		$this->db->join('tbl_car_brand', 'tbl_car_brand.id = tbl_mp_vehicle.brand_id', 'left');
		$this->db->join('tbl_car_model', 'tbl_car_model.id = tbl_mp_vehicle.model_id', 'left');
		$this->db->join('tbl_signup', 'tbl_signup.id = tbl_mp_vehicle.added_by', 'left');
		$this->db->where('tbl_mp_vehicle.hide', 0);

		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('tbl_mp_vehicle');
		// echo $this->db->last_query();
		$res = $query->result_array();

		$i = 0;
		foreach ($res as $r) {
			$getAllImages = $this->getAllMPImages($r['id']);

			$res[$i]['images'] = $getAllImages;
			$i++;
		}

		return $res;
	}

	function getAllCity()
	{
		return $this->db->count_all('tbl_city');
	}

	function getAllCityWithLimit($limit, $start)
	{

		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('tbl_city');
		// echo $this->db->last_query();
		return $query->result_array();
	}

	function getAllStatesp()
	{
		return $this->db->count_all('tbl_states');
	}

	function getAllStatespWithLimit($limit, $start)
	{

		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('tbl_states');
		// echo $this->db->last_query();
		return $query->result_array();
	}

	function insertVehicle($data)
	{

		if ($data) {
			$this->db->insert('tbl_vehicle', $data);
			$last_id = $this->db->insert_id();
			return array('last_id' => $last_id, 'msg' => '1');;
		} else {
			return 0;
		}
	}


	function updateVehicle($id, $data)
	{
		$this->db->where('id', $id);
		if ($this->db->update('tbl_vehicle', $data)) {
			return 1;
		} else {
			return 0;
		}
	}

	function insertVehicleImage($data)
	{

		if ($data) {
			$this->db->insert('tbl_vehicle_images', $data);
			$last_id = $this->db->insert_id();
			return 1;
		} else {
			return 0;
		}
	}

	function getCategoryById($id)
	{
		$query  = $this->db->where('id', $id);
		// $query  = $this->db->where('status', 1);
		$query = $this->db->get('tbl_vehicle_category');
		return $query->result_array();
	}

	function getVehicle()
	{
		$query = $this->db->get('tbl_vehicle');
		return $query->result_array();
	}

	function getCityById($id)
	{
		$query  = $this->db->where('id', $id);
		$query = $this->db->get('tbl_city');
		return $query->result_array();
	}
	function getVehicleById($id)
	{
		$query  = $this->db->where('id', $id);
		$query = $this->db->get('tbl_vehicle');
		return $query->result_array();
	}

	function getVehicleByReg($id)
	{
		$query  = $this->db->where('regno', $id);
		$query = $this->db->get('tbl_mp_vehicle');
		return $query->result_array();
	}

	function getMPVehicleByIdv2($id)
	{
		$query  = $this->db->where('id', $id);
		$query = $this->db->get('tbl_mp_vehicle');
		$res =  $query->result_array();

		$i = 0;
		foreach ($res as $r) {
			$getAllImages = $this->getAllMPImages($r['id']);
			$res[$i]['images'] = $getAllImages;
			$i++;
		}

		return $res;
	}

	function getMPVehicleById($id)
	{
		$this->db->select('tbl_mp_vehicle.*,tbl_vehicle_category.name as category_name,tbl_car_brand.name as brand_name,tbl_signup.phoneNumber as owner_contact,tbl_car_model.name as model_name,tbl_car_model.body_type as model_body_type,tbl_car_model.gears as model_gears,tbl_car_model.fuel_tank_capacity as model_fuel_tank_capacity,tbl_car_model.displacement as model_displacement,tbl_car_model.emission_norm as model_emission_norm,tbl_car_model.fuel_type as model_fuel_type,tbl_car_model.height as model_height,tbl_car_model.length as model_length,tbl_car_model.width as model_width,tbl_car_model.kerb_weight as model_kerb_weight,tbl_car_model.ground_clearance as model_ground_clearance,tbl_car_model.front_brakes as model_front_brakes,tbl_car_model.rear_brakes as model_rear_brakes,tbl_car_model.power_windows as model_power_windows,tbl_car_model.power_seats as model_power_seats,tbl_car_model.power as model_power,tbl_car_model.torque as model_torque,tbl_car_model.odometer as model_odometer,tbl_car_model.speedometer as model_speedometer,tbl_car_model.seating_capacity as model_seating_capacity,tbl_car_model.seats_material as model_seats_material,tbl_car_model.transmission as model_transmission,tbl_car_model.central_locking as model_central_locking,tbl_car_model.child_safety_locks as model_child_safety_locks,tbl_car_model.abs as model_abs,tbl_car_model.ventilation_system as model_ventilation_system,tbl_states.state as stateName,tbl_city.city as cityName,tbl_signup.firstName as dealer_firstName,tbl_signup.lastName as dealer_lastName');
		$this->db->where('tbl_mp_vehicle.regno', $id);
		$this->db->join('tbl_vehicle_category', 'tbl_vehicle_category.id = tbl_mp_vehicle.category_id', 'left');
		$this->db->join('tbl_car_brand', 'tbl_car_brand.id = tbl_mp_vehicle.brand_id', 'left');
		$this->db->join('tbl_car_model', 'tbl_car_model.id = tbl_mp_vehicle.model_id', 'left');
		$this->db->join('tbl_signup', 'tbl_signup.id = tbl_mp_vehicle.added_by', 'left');
		$this->db->join('tbl_states', 'tbl_states.id = tbl_mp_vehicle.state', 'left');
		$this->db->join('tbl_city', 'tbl_city.id = tbl_mp_vehicle.city', 'left');

		$query = $this->db->get('tbl_mp_vehicle');
		// echo $this->db->last_query();
		$res = $query->result_array();

		$i = 0;
		foreach ($res as $r) {
			// $getModel = $this->getModelById($r['model_id']);
			$getAllImages = $this->getAllMPImages($r['id']);

			$res[$i]['images'] = $getAllImages;
			// $res[$i]['model_data'] = $getModel[0];
			$i++;
		}

		return $res;
	}

	function getMPVehicleByIdApp($id)
	{
		$this->db->select('tbl_mp_vehicle.*,tbl_vehicle_category.name as category_name,tbl_car_brand.name as brand_name,tbl_signup.phoneNumber as owner_contact,tbl_car_model.name as model_name,tbl_car_model.body_type as model_body_type,tbl_car_model.gears as model_gears,tbl_car_model.fuel_tank_capacity as model_fuel_tank_capacity,tbl_car_model.displacement as model_displacement,tbl_car_model.emission_norm as model_emission_norm,tbl_car_model.fuel_type as model_fuel_type,tbl_car_model.height as model_height,tbl_car_model.length as model_length,tbl_car_model.width as model_width,tbl_car_model.kerb_weight as model_kerb_weight,tbl_car_model.ground_clearance as model_ground_clearance,tbl_car_model.front_brakes as model_front_brakes,tbl_car_model.rear_brakes as model_rear_brakes,tbl_car_model.power_windows as model_power_windows,tbl_car_model.power_seats as model_power_seats,tbl_car_model.power as model_power,tbl_car_model.torque as model_torque,tbl_car_model.odometer as model_odometer,tbl_car_model.speedometer as model_speedometer,tbl_car_model.seating_capacity as model_seating_capacity,tbl_car_model.seats_material as model_seats_material,tbl_car_model.transmission as model_transmission,tbl_car_model.central_locking as model_central_locking,tbl_car_model.child_safety_locks as model_child_safety_locks,tbl_car_model.abs as model_abs,tbl_car_model.ventilation_system as model_ventilation_system,tbl_states.state as stateName,tbl_city.city as cityName');
		$this->db->where('tbl_mp_vehicle.id', $id);
		$this->db->where('tbl_mp_vehicle.hide', 0);
		$this->db->where('tbl_mp_vehicle.status', 'Pending');
		$this->db->join('tbl_vehicle_category', 'tbl_vehicle_category.id = tbl_mp_vehicle.category_id', 'left');
		$this->db->join('tbl_car_brand', 'tbl_car_brand.id = tbl_mp_vehicle.brand_id', 'left');
		$this->db->join('tbl_car_model', 'tbl_car_model.id = tbl_mp_vehicle.model_id', 'left');
		$this->db->join('tbl_signup', 'tbl_signup.id = tbl_mp_vehicle.added_by', 'left');
		$this->db->join('tbl_states', 'tbl_states.id = tbl_mp_vehicle.state', 'left');
		$this->db->join('tbl_city', 'tbl_city.id = tbl_mp_vehicle.city', 'left');

		$query = $this->db->get('tbl_mp_vehicle');
		// echo $this->db->last_query();
		$res = $query->result_array();

		$i = 0;
		foreach ($res as $r) {
			// $getModel = $this->getModelById($r['model_id']);
			$getAllImages = $this->getAllMPImages($r['id']);

			$res[$i]['images'] = $getAllImages;
			// $res[$i]['model_data'] = $getModel[0];
			$i++;
		}

		return $res;
	}

	function getMPVehicleByUserIdApp($id)
	{
		$this->db->select('tbl_mp_vehicle.*,tbl_vehicle_category.name as category_name,tbl_car_brand.name as brand_name,tbl_signup.phoneNumber as owner_contact,tbl_car_model.name as model_name,tbl_car_model.body_type as model_body_type,tbl_car_model.gears as model_gears,tbl_car_model.fuel_tank_capacity as model_fuel_tank_capacity,tbl_car_model.displacement as model_displacement,tbl_car_model.emission_norm as model_emission_norm,tbl_car_model.fuel_type as model_fuel_type,tbl_car_model.height as model_height,tbl_car_model.length as model_length,tbl_car_model.width as model_width,tbl_car_model.kerb_weight as model_kerb_weight,tbl_car_model.ground_clearance as model_ground_clearance,tbl_car_model.front_brakes as model_front_brakes,tbl_car_model.rear_brakes as model_rear_brakes,tbl_car_model.power_windows as model_power_windows,tbl_car_model.power_seats as model_power_seats,tbl_car_model.power as model_power,tbl_car_model.torque as model_torque,tbl_car_model.odometer as model_odometer,tbl_car_model.speedometer as model_speedometer,tbl_car_model.seating_capacity as model_seating_capacity,tbl_car_model.seats_material as model_seats_material,tbl_car_model.transmission as model_transmission,tbl_car_model.central_locking as model_central_locking,tbl_car_model.child_safety_locks as model_child_safety_locks,tbl_car_model.abs as model_abs,tbl_car_model.ventilation_system as model_ventilation_system,tbl_states.state as stateName,tbl_city.city as cityName');
		$this->db->where('tbl_mp_vehicle.added_by', $id);
		$this->db->where('tbl_mp_vehicle.hide', 0);
		$this->db->where('tbl_mp_vehicle.status', 'Pending');
		$this->db->join('tbl_vehicle_category', 'tbl_vehicle_category.id = tbl_mp_vehicle.category_id', 'left');
		$this->db->join('tbl_car_brand', 'tbl_car_brand.id = tbl_mp_vehicle.brand_id', 'left');
		$this->db->join('tbl_car_model', 'tbl_car_model.id = tbl_mp_vehicle.model_id', 'left');
		$this->db->join('tbl_signup', 'tbl_signup.id = tbl_mp_vehicle.added_by', 'left');
		$this->db->join('tbl_states', 'tbl_states.id = tbl_mp_vehicle.state', 'left');
		$this->db->join('tbl_city', 'tbl_city.id = tbl_mp_vehicle.city', 'left');

		$query = $this->db->get('tbl_mp_vehicle');
		// echo $this->db->last_query();
		$res = $query->result_array();

		$i = 0;
		foreach ($res as $r) {
			// $getModel = $this->getModelById($r['model_id']);
			$getAllImages = $this->getAllMPImages($r['id']);

			$res[$i]['images'] = $getAllImages;
			// $res[$i]['model_data'] = $getModel[0];
			$i++;
		}

		return $res;
	}

	function getVehicleImagesById($id)
	{
		$query  = $this->db->where('vehicleId', $id);
		$query = $this->db->get('tbl_vehicle_images');
		return $query->result_array();
	}


	function deleteVehicleImageById($id)
	{
		$this->db->where('id', $id);
		if ($this->db->delete('tbl_vehicle_images')) {
			return 1;
		} else {

			return 0;
		}
	}

	public function deleteVehicle($id)

	{

		$this->db->where('id', $id);

		$this->db->delete('tbl_vehicle');
	}

	public function deleteVehicleImages($id)

	{

		$this->db->where('vehicleId', $id);

		$this->db->delete('tbl_vehicle_images');
	}


	function insertInspection($data)
	{

		if ($data) {
			$this->db->insert('tbl_inspection', $data);
			return 1;
		} else {
			return 0;
		}
	}

	function insertCarBrand($data)
	{

		if ($data) {
			$this->db->insert('tbl_car_brand', $data);
			return 1;
		} else {
			return 0;
		}
	}


	function updateCarBrand($id, $data)
	{

		$this->db->where('id', $id);

		if ($this->db->update('tbl_car_brand', $data)) {

			return 1;
		} else {



			return 0;
		}
	}


	function insertCarModel($data)
	{

		if ($data) {
			$this->db->insert('tbl_car_model', $data);
			return 1;
		} else {
			return 0;
		}
	}


	function updateCarModel($id, $data)
	{

		$this->db->where('id', $id);

		if ($this->db->update('tbl_car_model', $data)) {

			return 1;
		} else {



			return 0;
		}
	}


	function insertPayment($data)
	{

		if ($data) {
			$this->db->insert('tbl_payment', $data);
			return 1;
		} else {
			return 0;
		}
	}

	function getPaymentByUserId($id)
	{

		$query  = $this->db->where('user_id', $id);

		$query = $this->db->get('tbl_payment');

		return $query->result_array();
	}

	function getPaymentByOrderId($id)
	{

		$query  = $this->db->where('order_id', $id);

		$query = $this->db->get('tbl_payment');

		return $query->result_array();
	}

	function getPaymentByBookingId($id)
	{

		$query  = $this->db->where('bookingId', $id);

		$query = $this->db->get('tbl_booking_payment');

		return $query->result_array();
	}

	function updatePayment($id, $data)
	{
		$this->db->where('id', $id);
		if ($this->db->update('tbl_payment', $data)) {
			return 1;
		} else {

			return 0;
		}
	}

	function getStateById($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('tbl_states');

		return $query->result_array();
	}

	function getSubscription()
	{
		$query = $this->db->get('tbl_packages');

		return $query->result_array();
	}

	function getSubscriptionById($id)
	{

		$query  = $this->db->where('id', $id);

		$query = $this->db->get('tbl_packages');

		return $query->result_array();
	}


	function getSubscriptionByUserId($id)
	{

		$query  = $this->db->where('user_id', $id);
		$query  = $this->db->where('status', 'Completed');

		$query = $this->db->get('tbl_payment');

		return $query->result_array();
	}

	function insertPackages($data)
	{

		if ($data) {
			$this->db->insert('tbl_packages', $data);
			return 1;
		} else {
			return 0;
		}
	}

	function insertPriceRequest($data)
	{

		if ($data) {
			$this->db->insert('tbl_mp_vehicle_price_request', $data);
			return 1;
		} else {
			return 0;
		}
	}

	function insertAppointment($data)
	{

		if ($data) {
			$this->db->insert('tbl_mp_vehicle_appointment', $data);
			return 1;
		} else {
			return 0;
		}
	}

	public function deletePackages($id)

	{

		$this->db->where('id', $id);

		$this->db->delete('tbl_packages');
	}

	function updatePackages($id, $data)
	{
		$this->db->where('id', $id);
		if ($this->db->update('tbl_packages', $data)) {
			return 1;
		} else {

			return 0;
		}
	}

	function getAllMpCategory()
	{
		$query = $this->db->get('tbl_vehicle_category');
		return $query->result_array();
	}

	function getAllPackages()
	{
		$query = $this->db->get('tbl_packages');
		return $query->result_array();
	}

	function insertMPVehicleImages($data)
	{

		if ($data) {
			$this->db->insert('tbl_mp_vehicle_images', $data);
			return 1;
		} else {
			return 0;
		}
	}

	function insertMPVehicle($data)
	{

		if ($data) {
			$this->db->insert('tbl_mp_vehicle', $data);
			$last_id = $this->db->insert_id();
			return array('last_id' => $last_id, 'msg' => '1');
		} else {
			return 0;
		}
	}

	function updateMPVehicle($id, $data)
	{
		$this->db->where('id', $id);
		if ($this->db->update('tbl_mp_vehicle', $data)) {
			return 1;
		} else {

			return 0;
		}
	}

	function getAllMPVehicles($filter)
	{

		$catArr = json_decode($filter['category_id'], true);

		$brandArr = json_decode($filter['brand_id'], true);

		$modelArr = json_decode($filter['model_id'], true);

		$ownershipArr = json_decode($filter['ownership'], true);


		if (!empty($filter['category_id']) && count($catArr) > 0) {
			$query = $this->db->where_in('category_id', json_decode($filter['category_id'], true));
		}

		if (!empty($filter['brand_id']) && count($brandArr) > 0) {
			$query = $this->db->where_in('brand_id', json_decode($filter['brand_id'], true));
		}

		if (!empty($filter['model_id']) && count($modelArr) > 0) {
			$query = $this->db->where_in('model_id', json_decode($filter['model_id'], true));
		}

		if (!empty($filter['ownership']) && count($ownershipArr) > 0) {
			$query = $this->db->where_in('ownership', json_decode($filter['ownership'], true));
		}

		if (!empty($filter['price'])) {
			$query = $this->db->where('price', $filter['price']);
		}

		if (!empty($filter['year'])) {
			$query = $this->db->where('year', $filter['year']);
		}
		if (!empty($filter['listingtype'])) {
			$query = $this->db->where_in('listingtype', json_decode($filter['listingtype']));
		}

		if (!empty($filter['state'])) {
			$query = $this->db->where('state', $filter['state']);
		}

		if (!empty($filter['city'])) {
			$query = $this->db->where('city', $filter['city']);
		}
		// if (!empty($filter['notin'])) {
		// 	$query = $this->db->where_not_in('added_by', $filter['notin']);
		// }


		if (!empty($filter['buyfrom']) && count(json_decode($filter['buyfrom']), true) > 0) {
			$query = $this->db->where_in('added_type', json_decode($filter['buyfrom'], true));
		} else {
			$query = $this->db->where('added_type', "DEALER");
		}


		$query = $this->db->where('is_active', 1);
		$query = $this->db->where('hide', 0);
		$query = $this->db->get('tbl_mp_vehicle');
		// echo $this->db->last_query();
		return $query->num_rows();
	}

	function getAllMPVehiclesWithLimit($filter, $page, $limit)
	{

		$start = ($page - 1) * $limit;

		$catArr = json_decode($filter['category_id'], true);

		$brandArr = json_decode($filter['brand_id'], true);

		$modelArr = json_decode($filter['model_id'], true);

		$ownershipArr = json_decode($filter['ownership'], true);


		$this->db->where('is_active', 1);

		if (!empty($filter['category_id']) && count($catArr) > 0) {
			$query = $this->db->where_in('tbl_mp_vehicle.category_id', json_decode($filter['category_id'], true));
		}

		if (!empty($filter['brand_id']) && count($brandArr) > 0) {
			$query = $this->db->where_in('tbl_mp_vehicle.brand_id', json_decode($filter['brand_id'], true));
		}

		if (!empty($filter['model_id']) && count($modelArr) > 0) {
			$query = $this->db->where_in('tbl_mp_vehicle.model_id', json_decode($filter['model_id'], true));
		}

		if (!empty($filter['ownership']) && count($ownershipArr) > 0) {
			$query = $this->db->where_in('tbl_mp_vehicle.ownership', json_decode($filter['ownership'], true));
		}

		if (!empty($filter['price'])) {
			$query = $this->db->where('tbl_mp_vehicle.price', $filter['price']);
		}

		if (!empty($filter['year'])) {
			$query = $this->db->where('tbl_mp_vehicle.year', $filter['year']);
		}

		if (!empty($filter['listingtype'])) {
			$query = $this->db->where_in('tbl_mp_vehicle.listingtype', json_decode($filter['listingtype'], true));
		}

		if (!empty($filter['state'])) {
			$query = $this->db->where('tbl_mp_vehicle.state', $filter['state']);
		}
		if (!empty($filter['city'])) {
			$query = $this->db->where('tbl_mp_vehicle.city', $filter['city']);
		}
		// if (!empty($filter['notin'])) {
		// 	// $query = $this->db->where_not_in('tbl_mp_vehicle.added_by', $filter['notin']);
		// 	// $this->db->where('tbl_mp_vehicle.listingtype',$filter['listingtype']);

		// }
		// else{
		// 	$this->db->where('tbl_mp_vehicle.listingtype','stc');
		// 	// $this->db->where_not_in('tbl_mp_vehicle.added_type','DEALER');
		// }

		if (!empty($filter['buyfrom']) && count(json_decode($filter['buyfrom']), true) > 0) {
			$query = $this->db->where_in('added_type', json_decode($filter['buyfrom'], true));
		} else {
			$query = $this->db->where('tbl_mp_vehicle.added_type', "DEALER");
		}

		$this->db->select('tbl_mp_vehicle.*,tbl_vehicle_category.name as category_name,tbl_car_brand.name as brand_name,tbl_car_model.name as model_name,tbl_signup.firstName as dealer_name,tbl_states.state as state_name,tbl_city.city as city_name');
		$this->db->join('tbl_vehicle_category', 'tbl_vehicle_category.id = tbl_mp_vehicle.category_id', 'left');
		$this->db->join('tbl_car_brand', 'tbl_car_brand.id = tbl_mp_vehicle.brand_id', 'left');
		$this->db->join('tbl_car_model', 'tbl_car_model.id = tbl_mp_vehicle.model_id', 'left');
		$this->db->join('tbl_signup', 'tbl_signup.id = tbl_mp_vehicle.added_by', 'left');
		$this->db->join('tbl_states', 'tbl_states.id = tbl_mp_vehicle.state', 'left');
		$this->db->join('tbl_city', 'tbl_city.id = tbl_mp_vehicle.city', 'left');

		$this->db->limit($limit, $start);
		$query = $this->db->where('tbl_mp_vehicle.hide', 0);

		$this->db->order_by('tbl_mp_vehicle.id', 'DESC');
		$query = $this->db->get('tbl_mp_vehicle');
		// echo $this->db->last_query();
		$res = $query->result_array();

		$i = 0;
		foreach ($res as $r) {
			$getAllImages = $this->getAllMPImages($r['id']);

			$res[$i]['images'] = $getAllImages;
			$i++;
		}

		return $res;
	}

	function getHomeCarsWithLimit($limit, $notin, $listing)
	{

		$this->db->select('tbl_mp_vehicle.*,tbl_vehicle_category.name as category_name,tbl_car_brand.name as brand_name,tbl_car_model.name as model_name,tbl_signup.firstName as dealer_name,tbl_states.state as state_name,tbl_city.city as city_name');
		$this->db->join('tbl_vehicle_category', 'tbl_vehicle_category.id = tbl_mp_vehicle.category_id', 'left');
		$this->db->join('tbl_car_brand', 'tbl_car_brand.id = tbl_mp_vehicle.brand_id', 'left');
		$this->db->join('tbl_car_model', 'tbl_car_model.id = tbl_mp_vehicle.model_id', 'left');
		$this->db->join('tbl_signup', 'tbl_signup.id = tbl_mp_vehicle.added_by', 'left');
		$this->db->join('tbl_states', 'tbl_states.id = tbl_mp_vehicle.state', 'left');
		$this->db->join('tbl_city', 'tbl_city.id = tbl_mp_vehicle.city', 'left');

		$this->db->where('tbl_mp_vehicle.is_active', 1);
		$this->db->where('tbl_mp_vehicle.hide', 0);

		if (empty($notin)) {
			$this->db->where('tbl_mp_vehicle.listingtype', 'stc');
		}

		if (!empty($listing) && count(json_decode($listing), true) > 0) {
			$query = $this->db->where_in('tbl_mp_vehicle.listingtype', json_decode($listing, true));
		}
		$this->db->limit($limit);
		$this->db->where('tbl_mp_vehicle.added_type', "DEALER");
		$this->db->order_by('tbl_mp_vehicle.id', 'DESC');
		$query = $this->db->get('tbl_mp_vehicle');
		// echo $this->db->last_query();
		$res = $query->result_array();

		$i = 0;
		foreach ($res as $r) {
			$getAllImages = $this->getAllMPImages($r['id']);

			$res[$i]['images'] = $getAllImages;
			$i++;
		}

		return $res;
	}

	function getAllMPVehiclesByVendor($id)
	{
		$this->db->where('added_by', $id);
		$this->db->where('hide', 0);
		$query = $this->db->get('tbl_mp_vehicle');
		return $query->num_rows();
	}

	function getAllMPSoldVehiclesByVendor($id)
	{
		$this->db->where('added_by', $id);
		$this->db->where('hide', 0);
		$this->db->where('status', 'Sold');
		$query = $this->db->get('tbl_mp_vehicle');
		return $query->num_rows();
	}

	function getAllMPLiveVehiclesByVendor($id)
	{
		$this->db->where('added_by', $id);
		$this->db->where('hide', 0);
		$this->db->where('is_active', 1);
		$this->db->where('status', "Pending");
		$query = $this->db->get('tbl_mp_vehicle');
		return $query->num_rows();
	}

	function getAllMPOfflineVehiclesByVendor($id)
	{
		$this->db->where('added_by', $id);
		$this->db->where('hide', 0);
		$this->db->where('is_active', 0);
		$query = $this->db->get('tbl_mp_vehicle');
		return $query->num_rows();
	}

	function getAllMPVehiclesByVendorWithLimit($id, $limit, $page)
	{
		$start = ($page - 1) * $limit;
		$this->db->select('tbl_mp_vehicle.*,tbl_vehicle_category.name as category_name,tbl_car_brand.name as brand_name,tbl_car_model.name as model_name,tbl_states.state as state_name,tbl_city.city as city_name');
		$this->db->where('tbl_mp_vehicle.added_by', $id);
		$this->db->where('tbl_mp_vehicle.hide', 0);
		$this->db->join('tbl_vehicle_category', 'tbl_vehicle_category.id = tbl_mp_vehicle.category_id', 'left');
		$this->db->join('tbl_car_brand', 'tbl_car_brand.id = tbl_mp_vehicle.brand_id', 'left');
		$this->db->join('tbl_car_model', 'tbl_car_model.id = tbl_mp_vehicle.model_id', 'left');
		$this->db->join('tbl_states', 'tbl_states.id = tbl_mp_vehicle.state', 'left');
		$this->db->join('tbl_city', 'tbl_city.id = tbl_mp_vehicle.city', 'left');

		$this->db->limit($limit, $start);
		$this->db->order_by('tbl_mp_vehicle.id', 'DESC');
		$query = $this->db->get('tbl_mp_vehicle');
		// echo $this->db->last_query();
		$res = $query->result_array();

		$i = 0;
		foreach ($res as $r) {
			$getAllImages = $this->getAllMPImages($r['id']);

			$res[$i]['images'] = $getAllImages;
			$i++;
		}

		return $res;
	}

	function getAllMPImages($id)
	{

		$query = $this->db->where('vehicle_id', $id);

		$query = $this->db->get('tbl_mp_vehicle_images');

		return $query->result_array();
	}

	function deleteMPVehicle($id)
	{
		$this->db->where('id', $id);
		if ($this->db->delete('tbl_mp_vehicle')) {
			return 1;
		} else {
			return 0;
		}
	}

	function deleteMPVehicleImages($id, $path)
	{
		$this->db->where('id', $id);
		if ($this->db->delete('tbl_mp_vehicle_images')) {
			unlink($path);
			return 1;
		} else {
			return 0;
		}
	}


	function insertMPEnquiry($data)
	{

		if ($data) {
			$this->db->insert('tbl_mp_vehicle_enquiry', $data);
			$last_id = $this->db->insert_id();
			return array('last_id' => $last_id, 'msg' => 1);
		} else {
			return 0;
		}
	}

	function getAllStates()
	{

		$query = $this->db->get('tbl_states');

		return $query->result_array();
	}

	function getAllCityByState($id)
	{
		$this->db->where('state_id', $id);
		$query = $this->db->get('tbl_city');
		return $query->result_array();
	}

	function insertCustomMPEnquiry($data)
	{

		if ($data) {
			$this->db->insert('tbl_mp_custom_enquiry', $data);
			$last_id = $this->db->insert_id();
			return array('last_id' => $last_id, 'msg' => 1);
		} else {
			return 0;
		}
	}

	function getAllCatBySearch($search)
	{
		$query  = $this->db->like('name', $search);
		$query = $this->db->get('tbl_vehicle_category');
		return $query->result_array();
	}
	function getAllBrandBySearch($search)
	{
		$query  = $this->db->like('name', $search);
		$query = $this->db->get('tbl_car_brand');
		return $query->result_array();
	}
	function getAllModelBySearch($search)
	{
		$query  = $this->db->like('name', $search);
		$query = $this->db->get('tbl_car_model');
		return $query->result_array();
	}

	function getAllVehicleEnquiryByDealer($id)
	{
		$this->db->where('dealer_id', $id);
		$this->db->where('hide', 0);

		$query = $this->db->get('tbl_mp_vehicle_enquiry');

		return $query->num_rows();
	}

	function getAllVehicleEnquiryByDealerWithLimit($id, $page, $limit)
	{
		$start = ($page - 1) * $limit;
		$this->db->where('dealer_id', $id);
		$this->db->where('hide', 0);



		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');


		$query = $this->db->get('tbl_mp_vehicle_enquiry');

		return $query->result_array();
	}

	function getAllVehicleEnquiryByDealerV2($id, $vhId)
	{
		$this->db->where('dealer_id', $id);
		$this->db->where('vehicle_id', $vhId);
		$this->db->where('hide', 0);
		$query = $this->db->get('tbl_mp_vehicle_enquiry');
		return $query->num_rows();
	}

	function getAllVehicleEnquiryByDealerWithLimitV2($id, $vhId, $page, $limit)
	{
		$start = ($page - 1) * $limit;
		$this->db->where('dealer_id', $id);
		$this->db->where('vehicle_id', $vhId);
		$this->db->where('hide', 0);
		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('tbl_mp_vehicle_enquiry');
		return $query->result_array();
	}

	function getAllVehicleEnquiryByDealerCity($id)
	{
		$this->db->where('city', $id);
		$this->db->where('hide', 0);

		$query = $this->db->get('tbl_mp_custom_enquiry');

		return $query->num_rows();
	}


	function getAllVehicleEnquiryByDealerCityWithLimit($id, $start, $limit)
	{
		$this->db->where('city', $id);
		$this->db->where('hide', 0);



		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');


		$query = $this->db->get('tbl_mp_custom_enquiry');

		return $query->result_array();
	}

	function getBrandById($id)
	{
		$query  = $this->db->where('id', $id);
		$query = $this->db->get('tbl_car_brand');
		return $query->result_array();
	}

	function getModelById($id)
	{
		$query  = $this->db->where('id', $id);
		$query = $this->db->get('tbl_car_model');
		return $query->result_array();
	}

	function getMPEnquiryById($id)
	{
		$query  = $this->db->where('id', $id);
		$query = $this->db->get('tbl_mp_vehicle_enquiry');
		return $query->result_array();
	}


	function updateMPEnquiry($id, $data)
	{

		$this->db->where('id', $id);

		if ($this->db->update('tbl_mp_vehicle_enquiry', $data)) {

			return 1;
		} else {



			return 0;
		}
	}

	function updateCustomMPEnquiry($id, $data)
	{

		$this->db->where('id', $id);

		if ($this->db->update('tbl_mp_custom_enquiry', $data)) {

			return 1;
		} else {



			return 0;
		}
	}

	function gettotalCarsByDealer($id)
	{
		$this->db->where('added_by', $id);
		$query = $this->db->get('tbl_mp_vehicle');
		return $query->num_rows();
	}
	function getActivetotalCarsByDealer($id)
	{
		$this->db->where('is_active', 1);
		$this->db->where('hide', 0);
		$this->db->where('status', "Pending");
		$this->db->where('added_by', $id);
		$query = $this->db->get('tbl_mp_vehicle');
		return $query->num_rows();
	}
	function getOfflinetotalCarsByDealer($id)
	{
		$this->db->where('is_active', 0);
		$this->db->where('added_by', $id);
		$this->db->where('hide', 0);
		$this->db->where('status', "Pending");
		$query = $this->db->get('tbl_mp_vehicle');
		return $query->num_rows();
	}
	function getSoldtotalCarsByDealer($id)
	{
		$this->db->where('status', 'Sold');
		$this->db->where('added_by', $id);
		$query = $this->db->get('tbl_mp_vehicle');
		return $query->num_rows();
	}

	function getAllDealersCEnquiryByDealerId($id)
	{
		$this->db->where('userId', $id);
		$query = $this->db->get('tbl_mp_custom_enquiry');
		return $query->num_rows();
	}

	function getAllDealersCEnquiryByDealerIdWithLimit($id, $start, $limit)
	{

		$this->db->where('userId', $id);
		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('tbl_mp_custom_enquiry');
		// echo $this->db->last_query();
		$res =  $query->result_array();

		$enqfinal = array();

		if (count($res) > 0) {
			foreach ($res as $enqv2) {
				$userDetv2 = $this->getUserById($enqv2['userId']);
				$category = json_decode($enqv2['category_id'], true);
				$brand = json_decode($enqv2['brand_id'], true);
				$model = json_decode($enqv2['model_id'], true);

				$carArr = array();
				$i = 0;
				foreach ($category as $c) {

					$getCategory = $this->getCategoryById($c);
					$getBrand = $this->getBrandById($brand[$i]);
					$getModel = $this->getModelById($model[$i]);

					$log['category_id'] = $getCategory[0]['name'];
					$log['brand_id'] = $getBrand[0]['name'];
					$log['model_id'] = $getModel[0]['name'];
					$log['ownership'] = $enqv2['ownership'];

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
				$enqfinal[] = $datm;
			}
		} else {

			$enqfinal = [];
		}

		return $enqfinal;
	}

	function insertCity($data)

	{

		if ($data) {

			$this->db->insert('tbl_city', $data);

			return 1;
		} else {

			return 0;
		}
	}

	function updateCity($id, $data)
	{

		$this->db->where('id', $id);

		if ($this->db->update('tbl_city', $data)) {

			return 1;
		} else {



			return 0;
		}
	}

	function insertState($data)

	{

		if ($data) {

			$this->db->insert('tbl_states', $data);

			return 1;
		} else {

			return 0;
		}
	}

	function updateState($id, $data)
	{

		$this->db->where('id', $id);

		if ($this->db->update('tbl_states', $data)) {

			return 1;
		} else {



			return 0;
		}
	}

	public function deleteCity($id)

	{

		$this->db->where('id', $id);

		$this->db->delete('tbl_city');
	}

	public function deleteState($id)

	{

		$this->db->where('id', $id);

		$this->db->delete('tbl_states');
	}

	public function getMoreMPVehicleByDealer($vehId, $dealerId)
	{

		$this->db->select('tbl_mp_vehicle.*,tbl_vehicle_category.name as category_name,tbl_car_brand.name as brand_name,tbl_car_model.name as model_name,tbl_signup.firstName as dealer_name,tbl_states.state as state_name,tbl_city.city as city_name');
		$this->db->join('tbl_vehicle_category', 'tbl_vehicle_category.id = tbl_mp_vehicle.category_id', 'left');
		$this->db->join('tbl_car_brand', 'tbl_car_brand.id = tbl_mp_vehicle.brand_id', 'left');
		$this->db->join('tbl_car_model', 'tbl_car_model.id = tbl_mp_vehicle.model_id', 'left');
		$this->db->join('tbl_signup', 'tbl_signup.id = tbl_mp_vehicle.added_by', 'left');
		$this->db->join('tbl_states', 'tbl_states.id = tbl_mp_vehicle.state', 'left');
		$this->db->join('tbl_city', 'tbl_city.id = tbl_mp_vehicle.city', 'left');

		$this->db->where('tbl_mp_vehicle.added_by', $dealerId);
		$this->db->where_not_in('tbl_mp_vehicle.id', $vehId);
		$this->db->where('tbl_mp_vehicle.hide', 0);
		$this->db->where('tbl_mp_vehicle.status', "Pending");

		$this->db->order_by('tbl_mp_vehicle.id', 'DESC');
		$query = $this->db->where('tbl_mp_vehicle.hide', 0);
		$this->db->limit(3);

		$query = $this->db->get('tbl_mp_vehicle');
		// echo $this->db->last_query();
		$res = $query->result_array();


		$i = 0;
		foreach ($res as $r) {
			$getAllImages = $this->getAllMPImages($r['id']);
			$res[$i]['images'] = $getAllImages;
			$i++;
		}

		return $res;
	}


	public function getMoreVehicleBySameCars($catId, $brandId, $modelId)
	{

		$this->db->select('tbl_mp_vehicle.*,tbl_vehicle_category.name as category_name,tbl_car_brand.name as brand_name,tbl_car_model.name as model_name,tbl_signup.firstName as dealer_name,tbl_states.state as state_name,tbl_city.city as city_name');
		$this->db->join('tbl_vehicle_category', 'tbl_vehicle_category.id = tbl_mp_vehicle.category_id', 'left');
		$this->db->join('tbl_car_brand', 'tbl_car_brand.id = tbl_mp_vehicle.brand_id', 'left');
		$this->db->join('tbl_car_model', 'tbl_car_model.id = tbl_mp_vehicle.model_id', 'left');
		$this->db->join('tbl_signup', 'tbl_signup.id = tbl_mp_vehicle.added_by', 'left');
		$this->db->join('tbl_states', 'tbl_states.id = tbl_mp_vehicle.state', 'left');
		$this->db->join('tbl_city', 'tbl_city.id = tbl_mp_vehicle.city', 'left');

		$this->db->where('tbl_mp_vehicle.category_id', $catId);
		$this->db->where('tbl_mp_vehicle.brand_id', $brandId);
		$this->db->where('tbl_mp_vehicle.model_id', $modelId);

		$this->db->where('tbl_mp_vehicle.hide', 0);
		$this->db->where('tbl_mp_vehicle.status', "Pending");

		$this->db->order_by('tbl_mp_vehicle.id', 'DESC');
		$query = $this->db->where('tbl_mp_vehicle.hide', 0);
		$this->db->limit(3);

		$query = $this->db->get('tbl_mp_vehicle');
		// echo $this->db->last_query();
		$res = $query->result_array();


		$i = 0;
		foreach ($res as $r) {
			$getAllImages = $this->getAllMPImages($r['id']);
			$res[$i]['images'] = $getAllImages;
			$i++;
		}

		return $res;
	}


	function deleteMPVehicleMultiImage($id)
	{

		$this->db->where('id', $id);

		if ($this->db->delete('tbl_mp_vehicle_images')) {

			return 1;
		} else {



			return 0;
		}
	}

	function insertWishlist($data)
	{
		if ($data) {
			$this->db->insert('tbl_wishlist', $data);
			return 1;
		} else {

			return 0;
		}
	}

	function deleteWishlist($pid, $userId)
	{
		$this->db->where('product_id', $pid);
		$this->db->where('user_id', $userId);

		if ($this->db->delete('tbl_wishlist')) {
			return 1;
		} else {
			return 0;
		}
	}


	function getAllMPVehiclesApp($filter)
	{

		$catArr = json_decode($filter['category_id'], true);

		$brandArr = json_decode($filter['brand_id'], true);

		$modelArr = json_decode($filter['model_id'], true);

		$ownershipArr = json_decode($filter['ownership'], true);

		if (!empty($filter['category_id']) && count($catArr) > 0) {
			$query = $this->db->where_in('category_id', json_decode($filter['category_id'], true));
		}

		if (!empty($filter['brand_id']) && count($brandArr) > 0) {
			$query = $this->db->where_in('brand_id', json_decode($filter['brand_id'], true));
		}

		if (!empty($filter['model_id']) && count($modelArr) > 0) {
			$query = $this->db->where_in('model_id', json_decode($filter['model_id'], true));
		}

		if (!empty($filter['ownership']) && count($ownershipArr) > 0) {
			$query = $this->db->where_in('tbl_mp_vehicle.ownership', json_decode($filter['ownership'], true));
		}

		if (!empty($filter['price'])) {
			$query = $this->db->where('price', $filter['price']);
		}

		if (!empty($filter['year'])) {
			$query = $this->db->where('year', $filter['year']);
		}
		if (!empty($filter['listingtype'])) {
			$query = $this->db->where('listingtype', $filter['listingtype']);
		}

		if (!empty($filter['state'])) {
			$query = $this->db->where('state', $filter['state']);
		}

		if (!empty($filter['city'])) {
			$query = $this->db->where('city', $filter['city']);
		}

		if (!empty($filter['priceFrom']) && !empty($filter['priceToo'])) {
			$query = $this->db->where('price >=', $filter['priceFrom']);
			$query = $this->db->where('price <=', $filter['priceToo']);
		}


		if (!empty($filter['buyfrom']) && count(json_decode($filter['buyfrom']), true) > 0) {
			$query = $this->db->where_in('added_type', json_decode($filter['buyfrom'], true));
		} else {
			$query = $this->db->where('added_type', "DEALER");
		}


		$query = $this->db->where('is_active', 1);
		$query = $this->db->where('hide', 0);
		$query = $this->db->where('status', 'Pending');

		if (!empty($filter['sort_by'])) {

			if ($filter['sort_by'] == 'HLT') {
				$query = $this->db->order_by('price', "DESC");
			} else if ($filter['sort_by'] == 'LTH') {
				$query = $this->db->order_by('price', "ASC");
			} else if ($filter['sort_by'] == 'LATEST') {
				$this->db->order_by('id', 'DESC');
			}
		}

		$query = $this->db->get('tbl_mp_vehicle');
		// echo $this->db->last_query();
		return $query->num_rows();
	}

	function getAllMPVehiclesWithLimitApp($filter, $page, $limit)
	{
		$start = ($page - 1) * $limit;

		$catArr = json_decode($filter['category_id'], true);

		$brandArr = json_decode($filter['brand_id'], true);

		$modelArr = json_decode($filter['model_id'], true);

		$ownershipArr = json_decode($filter['ownership'], true);



		$this->db->where('is_active', 1);

		if (!empty($filter['category_id']) && count($catArr) > 0) {
			$query = $this->db->where_in('tbl_mp_vehicle.category_id', json_decode($filter['category_id'], true));
		}

		if (!empty($filter['brand_id']) && count($brandArr) > 0) {
			$query = $this->db->where_in('tbl_mp_vehicle.brand_id', json_decode($filter['brand_id'], true));
		}

		if (!empty($filter['model_id']) && count($modelArr) > 0) {
			$query = $this->db->where_in('tbl_mp_vehicle.model_id', json_decode($filter['model_id'], true));
		}

		if (!empty($filter['ownership']) && count($ownershipArr) > 0) {
			$query = $this->db->where_in('tbl_mp_vehicle.ownership', json_decode($filter['ownership'], true));
		}

		if (!empty($filter['price'])) {
			$query = $this->db->where('tbl_mp_vehicle.price', $filter['price']);
		}

		if (!empty($filter['year'])) {
			$query = $this->db->where('tbl_mp_vehicle.year', $filter['year']);
		}

		if (!empty($filter['listingtype'])) {
			$query = $this->db->where_in('tbl_mp_vehicle.listingtype', json_decode($filter['listingtype'], true));
		}

		if (!empty($filter['state'])) {
			$query = $this->db->where('tbl_mp_vehicle.state', $filter['state']);
		}
		if (!empty($filter['city'])) {
			$query = $this->db->where('tbl_mp_vehicle.city', $filter['city']);
		}

		if (!empty($filter['priceFrom']) && !empty($filter['priceToo'])) {
			$query = $this->db->where('price >=', $filter['priceFrom']);
			$query = $this->db->where('price <=', $filter['priceToo']);
		}

		if (!empty($filter['buyfrom']) && count(json_decode($filter['buyfrom']), true) > 0) {
			$query = $this->db->where_in('added_type', json_decode($filter['buyfrom'], true));
		} else {
			$query = $this->db->where('tbl_mp_vehicle.added_type', "DEALER");
		}

		$this->db->select('tbl_mp_vehicle.*,tbl_vehicle_category.name as category_name,tbl_car_brand.name as brand_name,tbl_car_model.name as model_name,tbl_signup.firstName as dealer_name,tbl_states.state as state_name,tbl_city.city as city_name');
		$this->db->join('tbl_vehicle_category', 'tbl_vehicle_category.id = tbl_mp_vehicle.category_id', 'left');
		$this->db->join('tbl_car_brand', 'tbl_car_brand.id = tbl_mp_vehicle.brand_id', 'left');
		$this->db->join('tbl_car_model', 'tbl_car_model.id = tbl_mp_vehicle.model_id', 'left');
		$this->db->join('tbl_signup', 'tbl_signup.id = tbl_mp_vehicle.added_by', 'left');
		$this->db->join('tbl_states', 'tbl_states.id = tbl_mp_vehicle.state', 'left');
		$this->db->join('tbl_city', 'tbl_city.id = tbl_mp_vehicle.city', 'left');

		$this->db->limit($limit, $start);
		$query = $this->db->where('tbl_mp_vehicle.hide', 0);
		$query = $this->db->where('tbl_mp_vehicle.status', 'Pending');

		if (!empty($filter['sort_by'])) {


			if ($filter['sort_by'] == 'HTL') {
				$query = $this->db->order_by('tbl_mp_vehicle.price', "DESC");
			} else if ($filter['sort_by'] == 'LTH') {
				$query = $this->db->order_by('tbl_mp_vehicle.price', "ASC");
			} else if ($filter['sort_by'] == 'LATEST') {
				$this->db->order_by('tbl_mp_vehicle.id', 'DESC');
			}
		}
		$query = $this->db->get('tbl_mp_vehicle');
		// echo $this->db->last_query();
		$res = $query->result_array();

		$i = 0;
		foreach ($res as $r) {
			$getAllImages = $this->getAllMPImages($r['id']);

			$res[$i]['images'] = $getAllImages;
			$i++;
		}

		return $res;
	}

	function getWishCheck($user, $product)
	{
		$query = $this->db->where('user_id', $user);
		$query = $this->db->where('product_id', $product);
		// $query = $this->db->where('status', 1);
		$query = $this->db->get('tbl_wishlist');
		// echo $this->db->last_query();
		return $query->result_array();
	}

	function getVehicleLastId()
	{
		$query = $this->db->get('tbl_mp_vehicle');
		$this->db->order_by('id', 'DESC');
		return $query->result_array();
	}

	function getAllUsersNotify($type)
	{
		$this->db->where('type', $type);
		$this->db->where('blocked', 0);
		$this->db->where('status', 1);
		$this->db->where('deleteAccountReq', 0);
		$query = $this->db->get('tbl_signup');
		// echo $this->db->last_query();
		return $query->result_array();
	}

	function getAllUsersV2Notify()
	{
		$this->db->where('blocked', 0);
		$this->db->where('status', 1);
		$this->db->where('deleteAccountReq', 0);
		$query = $this->db->get('tbl_signup');
		// echo $this->db->last_query();
		return $query->result_array();
	}


	function checkAppointment($userId, $vehId)
	{
		$this->db->where('user_id', $userId);
		$this->db->where('vehicle_id', $vehId);
		$query = $this->db->get('tbl_mp_vehicle_appointment');
		// echo $this->db->last_query();
		return $query->result_array();
	}

	function checkPriceReq($userId, $vehId)
	{
		$this->db->where('user_id', $userId);
		$this->db->where('vehicle_id', $vehId);
		$query = $this->db->get('tbl_mp_vehicle_price_request');
		// echo $this->db->last_query();
		return $query->result_array();
	}


	function getAllAppointmentsByVehicleId($id)
	{
		$query = $this->db->where('vehicle_id', $id);
		$query = $this->db->get('tbl_mp_vehicle_appointment');
		return $query->num_rows();
		// return $this->db->count('tbl_booking');
	}

	function getAllAppointmentsByVehicleIdWithLimit($id, $limit, $start)
	{
		$this->db->select('tbl_mp_vehicle_appointment.*,tbl_signup.firstName as request_by,tbl_mp_vehicle.regno,tbl_mp_vehicle.brand_id, tbl_mp_vehicle.model_id,tbl_mp_vehicle.variant,tbl_mp_vehicle.price as actual_price');
		$this->db->from('tbl_mp_vehicle_appointment');
		$this->db->join('tbl_mp_vehicle', 'tbl_mp_vehicle.id = tbl_mp_vehicle_appointment.vehicle_id', 'left');
		$this->db->join('tbl_signup', 'tbl_signup.id = tbl_mp_vehicle_appointment.user_id', 'left');
		$this->db->where('tbl_mp_vehicle_appointment.vehicle_id', $id);
		$this->db->limit($limit, $start);
		$this->db->order_by('tbl_mp_vehicle_appointment.id', 'DESC');

		$query = $this->db->get();

		$res = $query->result_array();

		$appointData = array();

		foreach ($res as $row) {
			$getBrand = $this->getBrandById($row['brand_id']);
			$getModel = $this->getModelById($row['model_id']);

			$data['brand_name'] = $getBrand[0]['name'];
			$data['model_name'] = $getModel[0]['name'];
			$data['user_id'] = $row['user_id'];
			$data['vehicle_id'] = $row['vehicle_id'];
			$data['date'] = $row['date'];
			$data['request_by'] = $row['request_by'];
			$data['regno'] = $row['regno'];
			$data['variant'] = $row['variant'];
			$data['time'] = $row['time'];
			$data['description'] = $row['description'];
			$data['created'] = $row['created'];
			$data['actual_price'] = $row['actual_price'];

			$appointData[] = $data;
		}

		return $appointData;
	}

	function getAllPriceRequestByVehicleId($id)
	{
		$query = $this->db->where('vehicle_id', $id);
		$query = $this->db->get('tbl_mp_vehicle_price_request');
		return $query->num_rows();
		// return $this->db->count('tbl_booking');
	}

	function getAllPriceRequestByVehicleIdWithLimit($id, $limit, $start)
	{
		$this->db->select('tbl_mp_vehicle_price_request.*,tbl_signup.firstName as request_by,tbl_mp_vehicle.regno,tbl_mp_vehicle.brand_id, tbl_mp_vehicle.model_id,tbl_mp_vehicle.variant,tbl_mp_vehicle.price as actual_price');
		$this->db->from('tbl_mp_vehicle_price_request');
		$this->db->join('tbl_mp_vehicle', 'tbl_mp_vehicle.id = tbl_mp_vehicle_price_request.vehicle_id', 'left');
		$this->db->join('tbl_signup', 'tbl_signup.id = tbl_mp_vehicle_price_request.user_id', 'left');
		$this->db->where('tbl_mp_vehicle_price_request.vehicle_id', $id);
		$this->db->limit($limit, $start);
		$this->db->order_by('tbl_mp_vehicle_price_request.id', 'DESC');

		$query = $this->db->get();

		$res = $query->result_array();

		$priceData = array();

		foreach ($res as $row) {
			$getBrand = $this->getBrandById($row['brand_id']);
			$getModel = $this->getModelById($row['model_id']);

			$data['brand_name'] = $getBrand[0]['name'];
			$data['model_name'] = $getModel[0]['name'];
			$data['user_id'] = $row['user_id'];
			$data['vehicle_id'] = $row['vehicle_id'];
			$data['price'] = $row['price'];
			$data['created'] = $row['created'];
			$data['request_by'] = $row['request_by'];
			$data['regno'] = $row['regno'];
			$data['variant'] = $row['variant'];
			$data['actual_price'] = $row['actual_price'];

			$priceData[] = $data;
		}

		return $priceData;
	}


	function getCouponByCode($code)
	{

		$query  = $this->db->where('coupon', $code);
		$query  = $this->db->where('isActive', 1);

		$query = $this->db->get('tbl_coupon');

		return $query->result_array();
	}

	function getPaymentByUser($id)
	{

		$query  = $this->db->where('user_id', $id);
		$query = $this->db->get('tbl_payment');

		return $query->result_array();
	}

	function deletePickupImage($id)
	{
		$this->db->where('id', $id);
		if ($this->db->delete('tbl_pickup_images')) {
			return 1;
		} else {
			return 0;
		}
	}

	function deleteDropImage($id)
	{
		$this->db->where('id', $id);
		if ($this->db->delete('tbl_drop_images')) {
			return 1;
		} else {
			return 0;
		}
	}

	// function deleteCarDropImage($id)
	// {
	// 	$this->db->where('id', $id);
	// 	if ($this->db->delete('tbl_car_drop_images')) {
	// 		return 1;
	// 	} else {
	// 		return 0;
	// 	}
	// }

	function deleteCarDropImage($id)
	{
		// Step 1: Fetch the image filename
		$this->db->where('id', $id);
		$query = $this->db->get('tbl_car_drop_images');
		$result = $query->row();

		if ($result) {
			$image_path = FCPATH . 'images/vehicle_image/' . $result->image;

			// Step 2: Delete the image file from server
			if (file_exists($image_path)) {
				unlink($image_path); // Delete file
			}

			// Step 3: Delete the database record
			$this->db->where('id', $id);
			if ($this->db->delete('tbl_car_drop_images')) {
				return 1;
			}
		}

		return 0;
	}

	function deleteCarPickupImage($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('tbl_car_pickup_images');
		$result = $query->row();

		if ($result) {
			$image_path = FCPATH . 'images/vehicle_image/' . $result->image;

			// Step 2: Delete the image file from server
			if (file_exists($image_path)) {
				unlink($image_path); // Delete file
			}

			// Step 3: Delete the database record
			$this->db->where('id', $id);
			if ($this->db->delete('tbl_car_pickup_images')) {
				return 1;
			}
		}

		return 0;
	}
}
