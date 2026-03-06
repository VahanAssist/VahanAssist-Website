<?php  include 'inc/header.php';
   $id=$this->uri->segment(3);
   if ($id!="") {
   # code...
   $getUser = $this->Manage_product->getUser($id);
   $getSubCategory = $this->Manage_product->getSubCategoryById($getUser[0]['category_id']);
   
   } 
   // print_r($getUser);
   ?>
<div class="app-main__outer">
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-users icon-gradient bg-mean-fruit">
               </i>
            </div>
            <div>
               Add Restaurant
               <div class="page-title-subheading">Add New Restaurant
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-2"></div>
      <div class="main-card mb-3 col-lg-8 card">
         <div class="card-body">
            <!--  <form class="" name="insertVerifier"> -->
            <form method="post"  action="<?php echo base_url(); ?>Insert_con/insertShop" enctype="multipart/form-data">
               <input name="id" id="id" type="hidden"  value="<?php echo $getUser[0]['id'] ?>">
               <input name="status" id="status" type="hidden"  value="1">
              
             <!-- <div class="position-relative row form-group">
                  <label for="portfolio" class="">Select Category</label>
                  <select class="form-control" name="category_id" id="category_id" onchange="return getSubCatgByCatId();">
                   
                     <option value="">Select Category</option>
                     <?php
                        $getCategory = $this->Manage_product->getCategory('');
                        foreach ($getCategory as $data) {
                        
                          ?>
                     <option value="<?php echo $data['id'] ?>" <?php if ($data['id']==$getUser[0]['category_id']) {  echo "selected"; } ?>><?php echo $data['category_name'] ?></option>
                     <?php } ?> 
                  </select>
               </div> -->
             
               <div class="position-relative row form-group">
                  <label for="name" class="col-sm-3 col-form-label">Restaurant Name </label>
                  <div class="col-sm-9">
                     <input name="shop_name" id="shop_name" placeholder="Restaurant Name" type="text" class="form-control" value="<?php echo $getUser[0]['shop_name'] ?>">
                     <span class="error" id="name_msg"></span>
                  </div>
               </div>
              <!--  <div class="position-relative row form-group">
                  <label for="name" class="col-sm-3 col-form-label">Owner Name </label>
                  <div class="col-sm-9">
                     <input name="name" id="name" placeholder="Owner Name" type="text" class="form-control" value="<?php echo $getUser[0]['name'] ?>">
                     <span class="error" id="name_msg"></span>
                  </div>
               </div>
               <div class="position-relative row form-group">
                  <label for="mobile" class="col-sm-3 col-form-label">Mobile Number </label>
                  <div class="col-sm-9">
                     <input name="phone" id="phone" placeholder="Mobile" type="text" class="form-control" value="<?php echo $getUser[0]['phone'] ?>">
                     <span class="error" id="phone_msg"></span>
                  </div>
               </div>
               <div class="position-relative row form-group">
                  <label for="email" class="col-sm-3 col-form-label">Email </label>
                  <div class="col-sm-9">
                     <input name="email" id="email" placeholder="Email " type="text" class="form-control" value="<?php echo $getUser[0]['email'] ?>">
                     <span class="error" id="email_msg"></span>
                  </div>
               </div>
               <div class="position-relative row form-group">
                  <label for="password" class="col-sm-3 col-form-label">Password </label>
                  <div class="col-sm-9">
                     <input name="password" id="password" placeholder="Password " type="password" class="form-control" value="<?php echo $getUser[0]['password'] ?>">
                     <span class="error" id="password_msg"></span>
                  </div>
               </div> -->
               <div class="position-relative row form-group">
                  <label for="address1" class="col-sm-3 col-form-label">Address </label>
                  <div class="col-sm-9">
                     <input name="address" id="address" placeholder="Houseno/Street" type="text" class="form-control" value="<?php echo $getUser[0]['address'] ?>">
                     <span class="error" id="address_msg"></span>
                  </div>
               </div>
               <div class="position-relative row form-group">
                  <label for="city" class="col-sm-3 col-form-label">City </label>
                  <div class="col-sm-9">
                     <input name="city" id="city" placeholder="City" type="text" class="form-control" value="<?php echo $getUser[0]['city'] ?>">
                     <span class="error" id="city_msg"></span>
                  </div>
               </div>
              <!--  <div class="position-relative row form-group">
                  <label for="PIN" class="col-sm-3 col-form-label">PIN </label>
                  <div class="col-sm-9">
                     <input name="pin" id="pin" maxlength="6" placeholder="PIN" type="text" class="form-control" value="<?php echo $getUser[0]['pin'] ?>">
                     <span class="error" id="pin_msg"></span>
                  </div>
               </div>
               <div class="position-relative row form-group">
                  <label for="PIN" class="col-sm-3 col-form-label">Intro </label>
                  <div class="col-sm-9">
                     <textarea class="form-control" name="intro"><?php echo $getUser[0]['intro'] ?></textarea>
                     <span class="error" id="pin_msg"></span>
                  </div>
               </div>
               <div class="position-relative row form-group">
                  <label for="PIN" class="col-sm-3 col-form-label">Description </label>
                  <div class="col-sm-9">
                     <textarea class="form-control" name="description"><?php echo $getUser[0]['description'] ?></textarea>
                     <span class="error" id="pin_msg"></span>
                  </div>
               </div>
               <div class="position-relative row form-group">
                  <label for="PIN" class="col-sm-3 col-form-label">Slug </label>
                  <div class="col-sm-9">
                     <input name="slug" id="slug"  placeholder="slug" type="text" class="form-control" value="<?php echo $getUser[0]['slug'] ?>">
                     <span class="error" id="pin_msg"></span>
                  </div>
               </div> -->
               <div class="position-relative row form-group">
                  <label for="PIN" class="col-sm-3 col-form-label">Logo </label>
                  <div class="col-sm-9">
                     <input name="logo" id="logo" type="file" class="form-control">
                     <input name="logo_old" id="logo_old" type="hidden" value="<?php echo $getUser[0]['logo'] ?>">
                     <?php if($getUser[0]['logo']!=""){ ?>
                        <img src="<?php echo base_url(); ?>images/shop_image/<?php echo $getUser[0]['logo'] ?>" width="200">
                     <?php } ?>
                  </div>
               </div>
            <div class="position-relative row form-group">
                  <label for="PIN" class="col-sm-3 col-form-label">Banner Image </label>
                  <div class="col-sm-9">
                     <input name="banner[]" id="banner" type="file" class="form-control" multiple="multiple">
                    
                   <?php $getShopImage  = $this->Manage_product->getShopImage($getUser[0]['id']);
                      foreach ($getShopImage as $data) {
                        # code...
                       ?>
                        <img src="<?php echo base_url(); ?>images/shop_image/<?php echo $data['image'] ?>" width="200">
                     <?php } ?>
                  </div>
               </div> 
               <div class="position-relative row form-check">
                  <div class="col-sm-10 offset-sm-2">
                     <!--  <input type="submit"  class="btn btn-secondary" value="Submit" > -->
                     <input type="submit" class="btn btn-secondary"  value="Submit" >
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<br>
<br>
<br>
<br>
<?php include 'inc/footer.php'; ?>