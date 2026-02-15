<?php
class App_model extends CI_Model
{
    function __construct()
    {
    }
    function insertOrder($data)
    {
        if ($data) {
            $this->db->insert('tbl_orders', $data);
            $last_id = $this->db->insert_id();
            //echo   $this->db->last_query();
            echo  json_encode(array('last_id' => $last_id, 'msg' => '1'));
        } else {
            echo  json_encode(array('last_id' => $last_id, 'msg' => '0'));
        }
    }
    function insertOrderDetails($data)
    {
        if ($data) {
            $this->db->insert('tbl_ordersdetail', $data);
            $last_id = $this->db->insert_id();
            //echo   $this->db->last_query();
            //echo  json_encode(array('last_id'=> $last_id,'msg'=>'1'));
            $query  = array('last_id' => $last_id, 'msg' => '1');
            return $query;
        } else {
            $query  = array('last_id' => $last_id, 'msg' => '0');
            return $query;
        }
    }
    function insertProductRequest($data)
    {
        if ($data) {
            $this->db->insert('tbl_product_request', $data);
            $last_id = $this->db->insert_id();
            //echo   $this->db->last_query();
            echo  json_encode(array('last_id' => $last_id, 'msg' => '1'));
        } else {
            echo  json_encode(array('last_id' => $last_id, 'msg' => '0'));
        }
    }
    function inserUserReffral($data)
    {
        if ($data) {
            $this->db->insert('tblg_user_reffral', $data);
            $last_id = $this->db->insert_id();
            //echo   $this->db->last_query();
            echo  json_encode(array('last_id' => $last_id, 'msg' => '1'));
        } else {
            echo  json_encode(array('last_id' => $last_id, 'msg' => '0'));
        }
    }
    function insertUser($data)
    {
        if ($data) {
            $this->db->insert('tbl_signup', $data);
            $last_id = $this->db->insert_id();
            return  array('last_id' => $last_id, 'msg' => '1', 'user' => 'user');
        } else {
            return  array('last_id' => $last_id, 'msg' => '0');
        }
    }
    function insertTocken($data)
    {
        if ($data) {
            $this->db->insert('tblg_tocken', $data);
            $last_id = $this->db->insert_id();
            echo   json_encode(array('last_id' => $last_id, 'msg' => '1'));
        } else {
            echo   json_encode(array('last_id' => $last_id, 'msg' => '0'));
        }
    }
    function insertRating($data)
    {
        if ($data) {
            $this->db->insert('tblg_rating', $data);
            $last_id = $this->db->insert_id();
            echo   json_encode(array('last_id' => $last_id, 'msg' => '1'));
        } else {
            echo   json_encode(array('last_id' => $last_id, 'msg' => '0'));
        }
    }
    function insertSupport($data)
    {
        if ($data) {
            $this->db->insert('tbl_support', $data);
            $last_id = $this->db->insert_id();
            echo   json_encode(array('last_id' => $last_id, 'msg' => '1'));
        } else {
            echo   json_encode(array('last_id' => $last_id, 'msg' => '0'));
        }
    }
    function getCategory($id)
    {
        if ($id == "") {
        } else {
            $query  = $this->db->where('id', $id);
        }
        $query = $this->db->get('tbl_product_category');
       return $query->result_array();
    }
    function getSplace($id)
    {

        if ($id == "") {
            // $query  = $this->db->where(1);
        } else {
            $query  = $this->db->where('id', $id);
        }
        //$query  = $this->db->where(1);
        $query = $this->db->get('tbl_splace');
        $this->db->last_query();
        echo  json_encode($query->result_array());
    }
    function getUserEmailPass($id, $password)
    {
        $query  = $this->db->where('email', $id);
        $query  = $this->db->where('password', $password);
        $query = $this->db->get('tbl_signup');
        $this->db->last_query();
        echo  json_encode($query->result_array());
    }
    function getContactInfo($id)
    {
        if ($id == "") {
        } else {
            $query  = $this->db->where('id', $id);
        }
        $query = $this->db->get('tbl_contact_info');
        $this->db->last_query();
        echo  json_encode($query->result_array());
    }
    function getCouponCode($data)
    {
        $query  = $this->db->where('code', $data);
        //$query  = $this->db->where(1);
        $query = $this->db->get('tbl_coupon');
        $this->db->last_query();
        return $query->result_array();
        //echo  json_encode($query->result_array());
    }

       function getUserByEmail($id)
    {
        $query  = $this->db->where('email', $id);
        $query = $this->db->get('tbl_signup');
        $this->db->last_query();
        return $query->result_array();
    }
    function getUserByCat($data)
    {
        //$query  = $this->db->where('reffral_code',$data['reffral_code']);
        $query  = $this->db->where('category_id', $data['category_id']);
        $query  = $this->db->where('sub_category_id', $data['sub_category_id']);
        $query = $this->db->get('tbl_signup');
        $this->db->last_query();
        return $query->result_array();
    }
    function getAllUsers($data)
    {
        $this->db->where('status', 1);
        $query = $this->db->get('tbl_signup');
        $this->db->last_query();
        return $query->result_array();
    }
    function getUserDetails($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('tbl_signup');
        $this->db->last_query();
        return $query->result_array();
    }
    function getRating($id)
    {
        if ($id == "") {
        } else {
            $query  = $this->db->where('product_id', $id);
        }
        $query = $this->db->get('tblg_rating');
        $this->db->last_query();
        echo  json_encode($query->result_array());
    }
    function getRatingCount($id)
    {
        $query  = $this->db->where('product_id', $id);
        $query = $this->db->get('tblg_rating');
        ///echo $this->db->last_query();
        //echo  json_encode($query->result_array());
        return $query->result_array();
    }
    function getRatingForOrder($id)
    {
        $query  = $this->db->where('product_id', $id);
        $query = $this->db->get('tblg_rating');
        $this->db->last_query();
        return $query->result_array();
    }
    function getRatingForUser($id, $user_id)
    {
        $query  = $this->db->where('product_id', $id);
        $query  = $this->db->where('user_id', $user_id);
        $query = $this->db->get('tblg_rating');
        $this->db->last_query();
        return $query->result_array();
    }
    function getLocation($id)
    {
        $query = $this->db->get('tblg_rating');
        $this->db->last_query();
        echo  json_encode($query->result_array());
    }
    function getTocken($id)
    {
        $query  = $this->db->where('user_id', $id);
        $query = $this->db->get('tblg_tocken');
        //echo  $this->db->last_query();
        return $query->result_array();
    }
    function getOrder($id)
    {
        // $this->db->select('*');
        // $this->db->from('tbl_product_category');
        $query  = $this->db->where('user_id', $id);
        //$query  = $this->db->where('order_type',$order_type);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('tbl_orders');
        $this->db->last_query();
        echo  json_encode($query->result_array());
    }
    function getAllOrder($id, $order_type)
    {
        // $this->db->select('*');
        // $this->db->from('tbl_product_category');
        $query  = $this->db->where('user_id', $id);
        $condtion = "order_type!=2";
        //$query  = $this->db->where('order_type',$order_type);
        $query  = $this->db->where($condtion);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('tbl_orders');
        ///echo 	 $this->db->last_query();
        echo  json_encode($query->result_array());
    }
    function getOffers($id)
    {
        // $this->db->select('*');
        // $this->db->from('tbl_product_category');
        if ($id == "") {
            // $query  = $this->db->where(1);
        } else {
            $query  = $this->db->where('id', $id);
        }
        //$query  = $this->db->where(1);
        $query = $this->db->get('tblg_offers');
        $this->db->last_query();
        echo  json_encode($query->result_array());
    }
    function getOrderByOrderId($id)
    {
        $query  = $this->db->where('order_id', $id);
        $query = $this->db->get('tbl_orders');
        $this->db->last_query();
        echo  json_encode($query->result_array());
    }
    function getOrders($id)
    {
        //$query  = $this->db->where('order_id',$id);
        $query = $this->db->get('tbl_orders');
        $this->db->last_query();
        echo  json_encode($query->result_array());
    }
    function getOrderAll($id)
    {
        $query  = $this->db->where('t1.user_id', $id);
        $query  = $this->db->select('t2.*,t3.product_image');
        $query = $this->db->from('tblg_orders t1');
        $query = $this->db->join('tblg_ordersdetail t2', 't1.order_id=t2.order_id');
        $query = $this->db->join('tbl_product_details t3', 't2.product_id=t3.id');
        $query = $this->db->get();
        $this->db->last_query();
        echo  json_encode($query->result_array());
    }
    function getOderForChat($id)
    {
        $query  = $this->db->where('t1.user_id', $id);
        $query  = $this->db->select('t1.*,t2.msg,t2.image');
        $query = $this->db->from('tblg_orders t1');
        $query = $this->db->join('tblg_chat t2', 't1.chat_id=t2.id');
        $query = $this->db->get();
        $this->db->last_query();
        echo  json_encode($query->result_array());
    }
    function getOrderDetails($id)
    {
        $query  = $this->db->where('t1.order_id', $id);
        $this->db->select('t1.*,t2.product_image');
        $query = $this->db->from('tbl_ordersdetail t1');
        $query = $this->db->join('tbl_product_details t2', 't1.product_id=t2.id');
        $query = $this->db->get();
        $this->db->last_query();
        return $query->result_array();
    }
    function getImage($id)
    {
        // $this->db->select('*');
        // $this->db->from('tbl_product_category');
        if ($id == "") {
            // $query  = $this->db->where(1);
        } else {
            $query  = $this->db->where('id', $id);
        }
        //$query  = $this->db->where(1);
        $query = $this->db->get('tblg_chat');
        $this->db->last_query();
        return $query->result_array();
    }
    function getUsersData($data)
    {
        $this->db->where('oauth_uid', $data['oauth_uid']);
        $this->db->where('oauth_provider', $data['oauth_provider']);
        $query = $this->db->get('tbl_signup');
        $this->db->last_query();
        return $query->result_array();
    }
    function getUsersDataTrue($phone)
    {
        $this->db->where('phone', $phone);
        // $this->db->where('oauth_provider',$data['oauth_provider']);
        $query = $this->db->get('tbl_signup');
        $this->db->last_query();
        return $query->result_array();
    }
    function getLogUserLofTime($phone)
    {
        $this->db->where('email', $phone);
        // $this->db->where('oauth_provider',$data['oauth_provider']);
        $query = $this->db->get('tbl_signup');
        $this->db->last_query();
        return $query->result_array();
    }
    function adminLogin($data)
    {
        $this->db->where('email', $data['email']);
        $this->db->where('password', $data['password']);
        //	$query = $this->db->join('tbl_signup t2','t1.username=t2.email');
        $query =  $this->db->get('tbl_admin_login');
        return $query->result_array();
    }
    function getLogUser($data)
    {
        //echo $data['email'];
        $this->db->where('email', $data['email']);
        $query =  $this->db->get('tbl_signup');
        $this->db->last_query();
        return $query->result_array();
    }
    function insertImage($data)
    {
        if ($data) {
            $this->db->insert('tblg_chat', $data);
            $last_id = $this->db->insert_id();
            echo  json_encode(array('last_id' => $last_id, 'msg' => '1'));
        } else {
            echo  json_encode(array('last_id' => $last_id, 'msg' => '0'));
        }
    }
    function insertContact($data)
    {
        if ($data) {
            $this->db->insert('tbl_contact', $data);
            $last_id = $this->db->insert_id();
            echo  json_encode(array('last_id' => $last_id, 'msg' => '1'));
        } else {
            echo  json_encode(array('last_id' => $last_id, 'msg' => '0'));
        }
    }
    function getSubCatBycatId($id)
    {
        // $this->db->select('*');
        // $this->db->from('tbl_product_category');
        // if ($id=="") {
        // }else{
        $query  = $this->db->where('category_id', $id);
        //}
        //$query  = $this->db->where(1);
        $query = $this->db->get('tbl_subcategory');
        $this->db->last_query();
        echo  json_encode($query->result_array());
    }
    function getEmailsDetails($id)
    {
        // $this->db->select('*');
        // $this->db->from('tbl_product_category');
        // if ($id=="") {
        // }else{
        $query  = $this->db->where('page_id', $id);
        //}
        //$query  = $this->db->where(1);
        $query = $this->db->get('tbl_pages');
        $this->db->last_query();
        echo  json_encode($query->result_array());
    }
    function getProduct($data)
    {
        // $this->db->select('*');
        // $this->db->from('tbl_product_category');
        if ($data['category_id'] == "" and $data['sub_category_id'] == "") {
        } else {
            $query  = $this->db->where('t1.category_id', $data['category_id']);
            //$query  = $this->db->where('sub_category_id',$data['sub_category_id']);
        }
        $this->db->select('t1.*,t2.category_name');
        $this->db->from('tbl_product_details t1');
        $this->db->join('tbl_product_category t2', 't1.category_id=t2.id');
        //$this->db->join('tbl_subcategory t3' ,'t1.sub_category_id=t3.id');
        $query = $this->db->get();
        $this->db->last_query();
        $data = $query->result_array();
        echo  json_encode(array('data' => $data, 'product_price' => $data));
    }
    function getProductBySub($data)
    {
        $query  = $this->db->where('t1.sub_category_id', $data['sub_category_id']);
        $this->db->select('t1.*,t2.subcategory_name');
        $this->db->from('tbl_product_details t1');
        $this->db->join('tbl_subcategory t2', 't1.category_id=t2.id');
        //$this->db->join('tbl_subcategory t3' ,'t1.sub_category_id=t3.id');
        $query = $this->db->get();
        $this->db->last_query();
        $data = $query->result_array();
        echo  json_encode($data);
    }
    function getProductForLat($data)
    {
        $this->db->select('t1.*,t2.category_name');
        $this->db->from('tbl_product_details t1');
        $this->db->join('tbl_product_category t2', 't1.category_id=t2.id');
        //$this->db->join('tbl_subcategory t3' ,'t1.sub_category_id=t3.id');
        $query = $this->db->get();
        $this->db->last_query();
        return $query->result_array();
    }
    function getProductSuggestion($search)
    {
        // $this->db->select('*');
        // $this->db->from('tbl_product_category');
        if ($search == "") {
            // $query  = $this->db->where(1);
        } else {
            $query  = $this->db->like('t1.product_name', $search);
            $query  = $this->db->or_like('t1.product_price', $search, 'after');
            $query  = $this->db->or_like('t2.category_name', $search, 'after');
            //	$query  = $this->db->or_like('t3.subcategory_name',$search,'after');
        }
        //$this->db->select('t1.*,t2.category_name,t3.subcategory_name');
        $this->db->select('t1.*,t2.category_name');
        $this->db->from('tbl_product_details t1');
        $this->db->join('tbl_product_category t2', 't1.category_id=t2.id');
        //	$this->db->join('tbl_subcategory t3' ,'t1.sub_category_id=t3.id');
        $query = $this->db->get();
        // $query = $this->db->get('tbl_post');
        $data = $query->result_array();
        echo  json_encode($data);
    }
    function getProductSearch($search)
    {
        if ($search == "") {
        } else {
            $query  = $this->db->like('t1.product_name', $search);
            $query  = $this->db->or_like('t2.category_name', $search);
        }
        $this->db->select('t1.*,t2.category_name');
        $this->db->from('tbl_product_details t1');
        $this->db->join('tbl_product_category t2', 't1.category_id=t2.id');
        //$this->db->join('tbl_subcategory t3' ,'t1.sub_category_id=t3.id');
        $query = $this->db->get();
        // $query = $this->db->get('tbl_post');
        return $query->result_array();
    }
    function getProductByOffer($vender_id)
    {
        $query  = $this->db->like('t1.vender_id', $vender_id);
        $this->db->select('t1.*,t2.category_name');
        $this->db->from('tbl_product_details t1');
        $this->db->join('tbl_product_category t2', 't1.category_id=t2.id');
        //$this->db->join('tbl_subcategory t3' ,'t1.sub_category_id=t3.id');
        $query = $this->db->get();
        // $query = $this->db->get('tbl_post');
        echo  json_encode($query->result_array());
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
        echo  json_encode($query->result_array());
    }
    function getProductByCat($category_id)
    {
        $query  = $this->db->where('t1.category_id', $category_id);
        $this->db->select('t1.*,t2.category_name');
        $this->db->from('tbl_product_details t1');
        $this->db->join('tbl_product_category t2', 't1.category_id=t2.id');
        $query = $this->db->get();
        //echo $this->db->last_query();
        //echo "JKKJKJKJKJ";
        return $query->result_array();
    }
   // function getProductByCat($category_id)
   //  {
   //      $query  = $this->db->where('t1.category_id', $category_id);
   //      $this->db->select('t1.*,t2.category_name');
   //      $this->db->from('tbl_product_details t1');
   //      $this->db->join('tbl_product_category t2', 't1.category_id=t2.id');
   //      $query = $this->db->get();
   //      //echo $this->db->last_query();
   //      //echo "JKKJKJKJKJ";
   //      return $query->result_array();
   //  }
    function getProductById($id)
    {
        $query  = $this->db->where('t1.id', $id);
        $this->db->select('t1.*,t2.category_name');
        $this->db->from('tbl_product_details t1');
        $this->db->join('tbl_product_category t2', 't1.category_id=t2.id');
        $query = $this->db->get();
        //echo $this->db->last_query();
        //echo "JKKJKJKJKJ";

        return $query->result_array();
    }
    function getTopProducts($id)
    {
        $query  = $this->db->where('t1.product_status', 0);
        $this->db->select('t1.*,t2.category_name');
        $this->db->from('tbl_product_details t1');
        $this->db->join('tbl_product_category t2', 't1.category_id=t2.id');
        $query = $this->db->get();
        //echo $this->db->last_query();
        //echo "JKKJKJKJKJ";

        return $query->result_array();
    }
    function getFeaturedProduct($id)
    {
        $query  = $this->db->where('t1.product_status', 1);
        $this->db->select('t1.*,t2.category_name');
        $this->db->from('tbl_product_details t1');
        $this->db->join('tbl_product_category t2', 't1.category_id=t2.id');
        $query = $this->db->get();
        //echo $this->db->last_query();
        //echo "JKKJKJKJKJ";

        return $query->result_array();
    }
    function getProductBySubCat($category_id, $sub_category_id)
    {
        $query  = $this->db->where('t1.category_id', $category_id);
        $query  = $this->db->or_like('t1.sub_category_id', $sub_category_id);
        //$query  = $this->db->or_like('t2.category_name',$search);
        $this->db->select('t1.*,t2.category_name');
        $this->db->from('tbl_product_details t1');
        $this->db->join('tbl_product_category t2', 't1.category_id=t2.id');
        $this->db->join('tbl_subcategory t3', 't1.sub_category_id=t3.id');
        $query = $this->db->get();
        // $query = $this->db->get('tbl_post');
        $data = $query->result_array();
        $arr = array();
        foreach ($data as $price) {
            $allData['price'] = explode(',', $price['product_price']);
            $allData['kg'] = explode(',', $price['kg']);
            $allData['liter'] = explode(',', $price['liter']);
            $allData['type'] = explode(',', $price['type']);
            $allData['id'] = $price['id'];
            array_push($arr, $allData);
        }
        echo  json_encode(array('data' => $data, 'product_price' => $arr));
    }
    function getAppUsers($data)
    {
        // $this->db->select('*');
        // $this->db->from('tbl_product_category');
        if ($data == "") {
            // $query  = $this->db->where(1);
        } else if ($data['id'] != "" and $data['password'] = !"" and $data['email'] != "") {
            $this->db->where('t2.id', $data['id']);
            $this->db->where('t2.password', $data['password']);
            $this->db->where('t2.username', $data['email']);
        } else if ($data['id'] == "" and $data['password'] == "" and $data['email'] != "") {
            // $this->db->where('t2.id',$data['id']);
            // $this->db->where('t2.password',$data['password']);
            $this->db->where('t2.username', $data['email']);
        }
        $this->db->select('t2.*');
        $this->db->from('tbl_signup t1');
        $this->db->join('tbl_login t2', 't1.email=t2.username');
        $query = $this->db->get();
        /// 	$query = $this->db->last_query();
        return $query->result_array();
    }
    function updatePassword($id, $data)
    {
        $this->db->where('id', $id);
        if ($this->db->update('tbl_signup', $data)) {
            return 1;
        } else {
            return 0;
        }
    }
    function cancelOrder($id, $data)
    {
        //echo $id;
        //echo $data;
        $this->db->where('order_id', $id);
        if ($this->db->update('tbl_orders', $data)) {
            return 1;
            //echo $this->db->last_query();
        } else {
            ///ECHO "JKDFJSK";
            return 0;
        }
    }
    function updateOrderStatus($id, $data)
    {
        $this->db->where('order_id', $id);
        if ($this->db->update('tbl_orders', $data)) {
            echo   json_encode(array('msg' => 'Updated'));
            //echo $this->db->last_query();
        } else {
            ///ECHO "JKDFJSK";
            echo   json_encode(array('msg' => 'Fail'));
        }
    }
    function updateUser($id, $data)
    {
        $this->db->where('id', $id);
        if ($this->db->update('tbl_signup', $data)) {
            return 1;
        } else {
            return 0;
        }
    }
    function updateTocken($id, $data)
    {
        $this->db->where('user_id', $id);
        if ($this->db->update('tblg_tocken', $data)) {
            echo   json_encode(array('last_id' => $last_id, 'msg' => '1'));
        } else {
            echo   json_encode(array('last_id' => $last_id, 'msg' => '0'));
        }
    }
    function updateTockenByUser($id, $data)
    {
        $this->db->where('user_id', $id);
        if ($this->db->update('tblg_tocken', $data)) {
            echo   json_encode(array('last_id' => $last_id, 'msg' => '1'));
        } else {
            echo   json_encode(array('last_id' => $last_id, 'msg' => '0'));
        }
    }
    // function cancelOrder($id,$data){
    // 	$this->db->where('id', $id);
    // 	if($this->db->update('tbl_orders',$data))
    // 	{
    // 		echo json_encode(array('msg'=>'success'));
    // 	}else{
    // 			echo json_encode(array('msg'=>'fails'));
    // 		}
    // 	}		
    function updateProfile($id, $data)
    {
        $this->db->where('id', $id);
        if ($this->db->update('tbl_signup', $data)) {
            echo json_encode(array('msg' => 'success'));
        } else {
            echo json_encode(array('msg' => 'fails'));
        }
    }
    function updateRating($id, $data)
    {
        $this->db->where('id', $id);
        if ($this->db->update('tblg_rating', $data)) {
            echo json_encode(array('msg' => 'success'));
        } else {
            echo json_encode(array('msg' => 'fails'));
        }
    }
    function updateSupport($id, $data)
    {
        $this->db->where('id', $id);
        if ($this->db->update('tbl_support', $data)) {
            echo json_encode(array('msg' => 'success'));
        } else {
            echo json_encode(array('msg' => 'fails'));
        }
    }
    function getCatByLat()
    {
        // $miles = 50;
        // $this->db->select("*, ( 3959 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance");                         
        // $this->db->having('distance <= ' . $miles);                     
        // $this->db->order_by('distance');                    
        // $this->db->limit(20, 0);
    }
    function showRequestByCat($data)
    {
        $this->db->where('category_id', $data['category_id']);
        $this->db->where('sub_category_id', $data['sub_category_id']);
        $query = $this->db->get('tbl_product_request');
        //echo $this->db->last_query();
        $data = $query->result_array();
        echo  json_encode($data);
    }
    function showRequestByCatSingle($data)
    {
        $this->db->where('category_id', $data['category_id']);
        $this->db->where('sub_category_id', $data['sub_category_id']);
        $query = $this->db->get('tbl_product_request');
        //echo $this->db->last_query();
        return $query->result_array();
        //echo  json_encode($data);
    }
    //////////////////rent app/	
    function getUserByPhone($id)
    {
        $query  = $this->db->where('phone', $id);
        $query = $this->db->get('tbl_signup');
        $this->db->last_query();
        return $query->result_array();
    }
    function getProductImage($product_id)
    {
        $query  = $this->db->where('product_id', $product_id);
        $query = $this->db->get('tbl_product_image');
        $this->db->last_query();
        $data = $query->result_array();
        return $data;
        //echo  json_encode($data);
    }
    function getProductByType($type, $category_id)
    {
        $query  = $this->db->where('type', $type);
        $query  = $this->db->where('category_id', $category_id);
        $this->db->select('t1.*,t2.category_name');
        $this->db->from('tbl_product_details t1');
        $this->db->join('tbl_product_category t2', 't1.category_id=t2.id');
        //$this->db->join('tbl_subcategory t3' ,'t1.sub_category_id=t3.id');
        $query = $this->db->get();
        //	echo $this->db->last_query();
        return $query->result_array();
    }
    function getPostByUserId($user_id, $status)
    {
        $query  = $this->db->where('t1.user_id', $user_id);
        $query  = $this->db->where('t1.status', $status);
        $this->db->select('t1.*,t2.category_name');
        $this->db->from('tbl_product_details t1');
        $this->db->join('tbl_product_category t2', 't1.category_id=t2.id');
        //$this->db->join('tbl_subcategory t3' ,'t1.sub_category_id=t3.id');
        $query = $this->db->get();
        //	echo $this->db->last_query();
        return $query->result_array();
    }
    function getType($category_id)
    {
        $query  = $this->db->where('category_id', $category_id);
        $query = $this->db->get('tbl_subcategory');
        //	echo $this->db->last_query();
        return $query->result_array();
    }
    function getFeature($category_id)
    {
        $query  = $this->db->where('category_id', $category_id);
        $query = $this->db->get('tbl_features');
        //	echo $this->db->last_query();
        return $query->result_array();
    }
    function insertProduct($data)
    {
        if ($data) {
            $this->db->insert('tbl_product_details', $data);
            $last_id = $this->db->insert_id();
            return  array('last_id' => $last_id, 'msg' => '1');
        } else {
            return  array('last_id' => $last_id, 'msg' => '0');
        }
    }
    function insertProductImage($data)
    {
        if ($data) {
            $this->db->insert('tbl_product_image', $data);
            $last_id = $this->db->insert_id();
            return  array('last_id' => $last_id, 'msg' => '1');
        } else {
            return  array('last_id' => $last_id, 'msg' => '0');
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
    function adUpdate($id, $data)
    {
        $this->db->where('id', $id);
        if ($this->db->update('tbl_product_details', $data)) {
            echo   json_encode(array('msg' => 'success'));
        } else {
            echo   json_encode(array('msg' => 'fail'));
        }
    }
    function deleteAdd($id, $data)
    {
        $this->db->where('id', $id);
        if ($this->db->delete('tbl_product_details', $data)) {
            echo   json_encode(array('msg' => 'success'));
        } else {
            echo   json_encode(array('msg' => 'fail'));
        }
    }
  
   function getShop($id)
    {

           // $query  = $this->db->where('t1.category_id', $id);
            $query  = $this->db->where('status', 1);
  
       // $query  = $this->db->select('t1.*,t2.category_name');
        //$query = $this->db->from('tbl_signup t1');
      //  $query = $this->db->join('tbl_product_category t2', 't1.category_id=t2.id');
        //$query = $this->db->join('tbl_subcategory t3', 't1.sub_category_id=t3.id');
        $query = $this->db->get('tbl_signup');
        return $query->result_array();
       // echo  json_encode($query->result_array());
    }
   function getShopImage($product_id)
    {
        $query  = $this->db->where('shop_id', $product_id);
        $query = $this->db->get('tbl_shop_image');
      // echo $this->db->last_query();
        $data = $query->result_array();
        return $data;
        //echo  json_encode($data);
    }
    function getOrderByBoyID($id,$order_status)
    {
        // $this->db->select('*');
        // $this->db->from('tbl_product_category');
        $query  = $this->db->where('boy_id', $id);
        $query  = $this->db->where('order_status', $order_status);
        //$query  = $this->db->where('order_type',$order_type);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('tbl_orders');
        $this->db->last_query();
        echo  json_encode($query->result_array());
    }
       function getDishByRId($data)
    {
        $query  = $this->db->where('r_id', $data);
        //$query  = $this->db->where(1);
        $query = $this->db->get('tbl_product_details');
        $this->db->last_query();
        echo  json_encode($query->result_array());
    } 
    function getSociety($data)
    {
       // $query  = $this->db->where('r_id', $data);
        //$query  = $this->db->where(1);
        $query = $this->db->get('tbl_society');
        $this->db->last_query();
        echo  json_encode($query->result_array());
    } 



    // New Code

    function checkUserEmail($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('tbl_signup');
        return $query->result_array();
    }

    function checkUserPhone($phone)
    {
        $this->db->where('phoneNumber', $phone);
        $query = $this->db->get('tbl_signup');
        return $query->result_array();
    }

    function getUserByIdApp($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('tbl_signup');
        // echo $this->db->last_query();
        return $query->result_array();
    }

    function getUserByTokenApp($token)
    {
        $this->db->where('token', $token);
        $query = $this->db->get('tbl_signup');
        // echo $this->db->last_query();
        return $query->result_array();
    }

    function getUserByEmailApp($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('tbl_signup');
        return $query->result_array();
    }

    function getUserLogin($data)
    {
        $this->db->where('phoneNumber', $data['phoneNumber']);
        $this->db->where('password', $data['password']);
        $this->db->where('blocked', 0);
        $this->db->where('deleteAccountReq', 0);
        $query = $this->db->get('tbl_signup');
        // echo $this->db->last_query();
        return $query->result_array();
    }

    function insertAppUser($data)
    {
        if ($data) {
            if($this->db->insert('tbl_signup', $data)){
                return 1;
            }
            else{
                return 0;
            }
            
        } else {
            return 0;
        }
    }

    function getCategoryV2()
    {
        $query = $this->db->get('tbl_vehicle_category');
       return $query->result_array();
    }

    function getVehicleV2()
    {
        $query = $this->db->get('tbl_vehicle');
       return $query->result_array();
    }

    function getBannerV2()
    {
        $query = $this->db->get('tbl_banner');
       return $query->result_array();
    }

    function getCarBrand()
    {
        $query = $this->db->get('tbl_car_brand');
       return $query->result_array();
    }

    function getCarModelByBrandId($id)
    {
        $query = $this->db->where('brand_id',$id);

        $query = $this->db->get('tbl_car_model');
        // echo $this->db->last_query();
       return $query->result_array();
    }

    function getVehicleImagesById($id)
    {
        $query = $this->db->where('vehicleId',$id);

        $query = $this->db->get('tbl_vehicle_images');
        // echo $this->db->last_query();
       return $query->result_array();
    }


    function insertEnquiry($data)
{

if($data)
	{
		$this->db->insert('tbl_enquiry',$data);
		return 1;
		
	}else{
		return 0;
	}
		
	}

    function insertCheckoutBooking($data)
{

if($data)
	{
		$this->db->insert('tbl_booking_payment',$data);
		return 1;
		
	}else{
		return 0;
	}
		
	}


    function getAllUserBookings($id){
        $query = $this->db->where('userId',$id);
		// return $this->db->count_all('tbl_booking');
        $query = $this->db->get('tbl_booking');
        return $query->num_rows();
	  }

      function getUserBookingsWithLimit($id,$limit, $start) {
		if($start == 1){
			$start = 0;
		}
        $this->db->where('userId', $id);
        $this->db->limit($limit, $start);
		$this->db->order_by('id','DESC');
        $query = $this->db->get('tbl_booking');
		// echo $this->db->last_query();
        $bookings =  $query->result_array();
        foreach ($bookings as &$booking) {
            $getCarDetail = $this->Manage_product->getCarDetailsByBooking($booking['id']);
            $getPickupImages = $this->getCarPickupImages($getCarDetail[0]['id']);
            $getDropImages = $this->getCarDropImages($getCarDetail[0]['id']);
           
            if($getPickupImages[0]['is_verified'] == 1){
                $booking['pickup_images_verified ']  = true;
            }

              if($getDropImages[0]['is_verified'] == 1){
                $booking['drop_images_verified ']  = true;
            }
        }

        return $bookings;
    }

    function getAllDriverBookings($id){
        // $query = $this->db->where('assignDriverId',$id);
        // $query = $this->db->get('tbl_booking');
        // $query = $this->db->select('COUNT(tbl_booking.id) as totalBookings');
        // $query =  $this->db->join('car', 'car.booking_id = tbl_booking.id', 'inner');
        // $query = $this->db->where('car.assignDriverId', $id);
        // $query = $this->db->from('tbl_booking');
        // return $query->result_array();
		// return $this->db->count('tbl_booking');
        $this->db->select('COUNT(tbl_booking.id) as totalBookings');
        $this->db->from('tbl_booking');
        $this->db->join('tbl_car_detail', 'tbl_car_detail.bookingId = tbl_booking.id', 'inner');
        $this->db->where('tbl_car_detail.assignDriverId', $id);
        $this->db->group_by('tbl_booking.id');
        
        $query = $this->db->get(); // Execute the query
        return $query->result_array(); 
	  }

      function getDriverBookingsWithLimitApp($id,$limit, $start) {
	    if ($start > 0) {
			$start = ($start - 1) * $limit;
		} else {
			$start = 1;
		}
        $this->db->select('tbl_booking.*,tbl_signup.firstName as name,tbl_signup.email as userEmail,tbl_signup.phoneNumber as userPhoneNumber,tbl_signup.lat as lat,tbl_signup.lng as lng');
        $this->db->from('tbl_booking');
        $this->db->join('tbl_car_detail', 'tbl_booking.id = tbl_car_detail.bookingId', 'inner');
        $this->db->join('tbl_signup', 'tbl_signup.id = tbl_booking.userId','left');
        // $this->db->where('tbl_booking.assignDriverId', $id);
        $this->db->where('tbl_car_detail.assignDriverId', $id);
        $this->db->group_by('tbl_booking.id');
        $this->db->limit($limit, $start);
        $this->db->order_by('tbl_booking.id','DESC');

$query = $this->db->get();

$res = $query->result_array();		
		$userData=array();

        foreach($res as $dat){
        $getPickupImages = $this->getBookingPickupImages($dat['id']);
        $getDropImages = $this->getBookingDropImages($dat['id']);
        $getCarDetail = $this->getCarDetailsByBooking($dat['id']);
        $getTracking = $this->getTrackingByBooking($dat['id']);
        $getPayment = $this->getPaymentByBooking($dat['id']);
        $getFirstDriver = $this->getUserDetails($getCarDetail[0]['assignDriverId']);
        $getSecondDriver = $this->getUserDetails($getCarDetail[0]['assignSecondDriverId']);
        $driver = $this->getUserDetails($dat['assignDriverId']);
		$data['id']  = $dat['id'];
		$data['userId']  = $dat['userId'];
		$data['pickupLocation']  = $dat['pickupLocation'];
		$data['dropLocation']  = $dat['dropLocation'];
		$data['picklat']  = $dat['picklat'];
		$data['droplat']  = $dat['droplat'];
		$data['picklng']  = $dat['picklng'];
		$data['droplng']  = $dat['droplng'];
		$data['kmDiff']  = $dat['kmDiff'];
		$data['date']  = $dat['date'];
		$data['time']  = $dat['time'];
		$data['type']  = $dat['type'];
		$data['comments']  = $dat['comments'];
		$data['name']  = $dat['name'];
		$data['email']  = $dat['email'];
		$data['service_type']  = $dat['service_type'];
		$data['phoneNumber']  = $dat['phoneNumber'];
		$data['status']  = $dat['status'];
		$data['bookingType']  = $dat['bookingType'];
		$data['firstDriver']  = $getFirstDriver;
		$data['secondDriver']  = $getSecondDriver;
		$data['driver']  = $driver;
		$data['otp']  = $dat['otp'];
		$data['withFuel']  = $dat['withFuel'];
		$data['withToll']  = $dat['withToll'];
		$data['startOdometerReading']  = $dat['startOdometerReading'];
		$data['endOdometerReading']  = $dat['endOdometerReading'];
		$data['category']  = $dat['category'];
		$data['brand']  = $dat['brand'];
		$data['model']  = $dat['model'];
		$data['source']  = $dat['source'];
		$data['userEmail']  = $dat['userEmail'];
		$data['userPhoneNumber']  = $dat['userPhoneNumber'];
        $data['pickup_images'] = $getPickupImages;
        $data['drop_images'] = $getDropImages;
        $data['car_details'] = $getCarDetail;
        $data['tracking'] = $getTracking;
        $data['payment_detail'] = $getPayment;

        $userData [] =$data;
		
        }
	return $userData;
        // return $query->result_array();
    }

    function getTrackingByBooking($id)
	{
		$query  = $this->db->where('bookingId', $id);
		$query = $this->db->get('tbl_booking_tracking');
		return $query->result_array();
	}

    function getPaymentByBooking($id)
	{
		$query  = $this->db->where('bookingId', $id);
		$query = $this->db->get('tbl_booking_payment');
		return $query->result_array();
	}

    // function getDriverBookingsWithLimitAppV2($id,$limit, $start){
    //     if ($start > 0) {
	// 		$start = ($start - 1) * $limit;
	// 	} else {
	// 		$start = 1;
	// 	}
    //     $this->db->select('tbl_booking.*,tbl_signup.firstName as name,tbl_signup.email as userEmail,tbl_signup.phoneNumber as userPhoneNumber');
    //     $this->db->join('cars', 'bookings.id = cars.booking_id', 'left');
    //     $this->db->join('tbl_signup', 'cars.assigned_driver_id = drivers.id', 'left');
    //     $this->db->where('cars.assigned_driver_id', $id);
    //     $query = $this->db->get();
    //     $results = $query->result_array();

    //     foreach ($results as &$result) {

    //         $this->db->select('*');
    //         $this->db->from('tbl_pickup_images');
    //         $this->db->where('bookingId', $result['id']);
    //         $pickupImages = $this->db->get()->result_array();
    //         $result['booking_pickup_images'] = $pickupImages;
    
    //         // Get booking drop images
    //         $this->db->select('*');
    //         $this->db->from('tbl_booking');
    //         $this->db->where('booking_id', $result['booking_id']);
    //         $this->db->where('type', 'drop');
    //         $dropImages = $this->db->get()->result_array();
    //         $result['booking_drop_images'] = $dropImages;
    
    //         // Get car pickup images
    //         $this->db->select('*');
    //         $this->db->from('tbl_car_detail');
    //         $this->db->where('car_id', $result['car_id']);
    //         $this->db->where('type', 'pickup');
    //         $carPickupImages = $this->db->get()->result_array();
    //         $result['car_pickup_images'] = $carPickupImages;
    
    //         // Get car drop images
    //         $this->db->select('*');
    //         $this->db->from('tbl_car_detail');
    //         $this->db->where('car_id', $result['car_id']);
    //         $this->db->where('type', 'drop');
    //         $carDropImages = $this->db->get()->result_array();
    //         $result['car_drop_images'] = $carDropImages;
    //     }
    //     return $results;
    // }

    function getBookingByBookingId($id) {
        $this->db->select('tbl_booking.*,tbl_signup.firstName as name,tbl_signup.email as userEmail,tbl_signup.phoneNumber as userPhoneNumber');
$this->db->from('tbl_booking');
$this->db->join('tbl_signup', 'tbl_signup.id = tbl_booking.userId','left');
$this->db->join('tbl_pickup_images', 'tbl_pickup_images.id = tbl_booking.id','left');
$this->db->where('tbl_booking.id', $id);
$this->db->order_by('tbl_booking.id','DESC');

$query = $this->db->get();

       $res = $query->result_array();		
		$userData=array();

        $getPickupImages = $this->getBookingPickupImages($res[0]['id']);
        $getDropImages = $this->getBookingDropImages($res[0]['id']);
        $getCarDetail = $this->getCarDetailsByBooking($res[0]['id']);
        $getTracking = $this->getTrackingByBooking($res[0]['id']);
        $getFirstDriver = $this->getUserDetails($getCarDetail[0]['assignDriverId']);
        $getSecondDriver = $this->getUserDetails($getCarDetail[0]['assignSecondDriverId']);
        $driver = $this->getUserDetails($res[0]['assignDriverId']);
        $getPayment = $this->getPaymentByBooking($res[0]['id']);
		$userData['id']  = $res[0]['id'];
		$userData['userId']  = $res[0]['userId'];
        $userData['total_quote']  = $res[0]['total_quote'];
		$userData['pickupLocation']  = $res[0]['pickupLocation'];
		$userData['dropLocation']  = $res[0]['dropLocation'];
		$userData['picklat']  = $res[0]['picklat'];
		$userData['droplat']  = $res[0]['droplat'];
		$userData['picklng']  = $res[0]['picklng'];
		$userData['droplng']  = $res[0]['droplng'];
		$userData['kmDiff']  = $res[0]['kmDiff'];
		$userData['date']  = $res[0]['date'];
		$userData['time']  = $res[0]['time'];
		$userData['type']  = $res[0]['type'];
		$userData['comments']  = $res[0]['comments'];
		$userData['name']  = $res[0]['name'];
		$userData['email']  = $res[0]['email'];
		$userData['service_type']  = $res[0]['service_type'];
		$userData['phoneNumber']  = $res[0]['phoneNumber'];
		$userData['status']  = $res[0]['status'];
		$userData['bookingType']  = $res[0]['bookingType'];
		$userData['firstDriver']  = $getFirstDriver;
		$userData['secondDriver']  = $getSecondDriver;
		$userData['driver']  = $driver;
		$userData['otp']  = $res[0]['otp'];
		$userData['withFuel']  = $res[0]['withFuel'];
		$userData['withToll']  = $res[0]['withToll'];
		$userData['startOdometerReading']  = $res[0]['startOdometerReading'];
		$userData['endOdometerReading']  = $res[0]['endOdometerReading'];
		$userData['category']  = $res[0]['category'];
		$userData['brand']  = $res[0]['brand'];
		$userData['model']  = $res[0]['model'];
		$userData['source']  = $res[0]['source'];
		$userData['userEmail']  = $res[0]['userEmail'];
		$userData['userPhoneNumber']  = $res[0]['userPhoneNumber'];
        $userData['pickup_images'] = $getPickupImages;
        $userData['drop_images'] = $getDropImages;
        $userData['car_details'] = $getCarDetail;
        $userData['tracking'] = $getTracking;
        $userData['payment_detail'] = $getPayment;
		return $userData;
    }

    function getCarDetailsByBooking($id)
	{
		$query  = $this->db->where('bookingId', $id);
		$query = $this->db->get('tbl_car_detail');
		$res = $query->result_array();	
        
		$userData=array();

        foreach($res as $car){
            $getCarPickupImages = $this->getCarPickupImages($car['id']);
            $getCarDropImages = $this->getCarDropImages($car['id']);

            $data['id']  = $car['id'];
            $data['model']  = $car['model'];
            $data['category']  = $car['category'];
            $data['brand']  = $car['brand'];
            $data['inspectionType']  = $car['inspectionType'];
            $data['doc']  = $car['doc'];
            $data['carQuality']  = $car['carQuality'];
            $data['carCondition']  = $car['carCondition'];
            $data['assignDriverId']  = $car['assignDriverId'];
            $data['assignSecondDriverId']  = $car['assignSecondDriverId'];
            $data['secondDriverAssignFlag']  = $car['secondDriverAssignFlag'];
            $data['status']  = $car['status'];
            $data['pickup_images_verified']  = $car['pickup_images_verified'];
            $data['drop_images_verified']  = $car['drop_images_verified'];
            $data['pickup_images']  = $getCarPickupImages;
            $data['drop_images']  = $getCarDropImages;
            $userData [] = $data;
        }

        return $userData;
       
	}


    function getBookingByOtp($id,$otp)
    {
        $this->db->where('id', $id);
        $this->db->where('otp', $otp);
        $query = $this->db->get('tbl_booking');
        $this->db->last_query();
        return $query->result_array();
    }

    function getCarPickupImages($id)
    {
        $this->db->where('carId', $id);
        $query = $this->db->get('tbl_car_pickup_images');
        $this->db->last_query();
        return $query->result_array();
    }
    function getCarDropImages($id)
    {
        $this->db->where('carId', $id);
        $query = $this->db->get('tbl_car_drop_images');
        $this->db->last_query();
        return $query->result_array();
    }

    function getBookingPickupImages($id)
    {
        $this->db->where('bookingId', $id);
        $query = $this->db->get('tbl_pickup_images');
        $this->db->last_query();
        return $query->result_array();
    }
    function getBookingDropImages($id)
    {
        $this->db->where('bookingId', $id);
        $query = $this->db->get('tbl_drop_images');
        $this->db->last_query();
        return $query->result_array();
    }

    function insertCarPickupImage($data)
    {
    
    if($data)
        {
            $this->db->insert('tbl_car_pickup_images',$data);
            $last_id=$this->db->insert_id();
            return 1;
            
        }else{
            return 0;
        }
            
        }

        function insertCarDropImage($data)
        {
        
        if($data)
            {
                $this->db->insert('tbl_car_drop_images',$data);
                $last_id=$this->db->insert_id();
                return 1;
                
            }else{
                return 0;
            }
                
            }

    function insertPickupImage($data)
    {
    
    if($data)
        {
            $this->db->insert('tbl_pickup_images',$data);
            $last_id=$this->db->insert_id();
            return 1;
            
        }else{
            return 0;
        }
            
        }

        function insertDropImage($data)
        {
        
        if($data)
            {
                $this->db->insert('tbl_drop_images',$data);
                $last_id=$this->db->insert_id();
                return 1;
                
            }else{
                return 0;
            }
                
            }

            
    function insertPickupOdometerImage($data)
    {
    
    if($data)
        {
            $this->db->insert('tbl_pick_odometer_images',$data);
            $last_id=$this->db->insert_id();
            return 1;
            
        }else{
            return 0;
        }
            
        }

        function insertDropOdometerImage($data)
        {
        
        if($data)
            {
                $this->db->insert('tbl_drop_odometer_images',$data);
                $last_id=$this->db->insert_id();
                return 1;
                
            }else{
                return 0;
            }
                
            }

}
