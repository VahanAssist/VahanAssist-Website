<?php  include 'inc/header.php'; 
 
   
   $getUser = $this->Manage_product->getUser('');

   

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
               Restaurants
               <div class="page-title-subheading">View Restaurants
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12">
         <div class="main-card mb-3 card">
            <div class="card-body">
               <table class="mb-0 table"  id="myTable">
                  <thead>
                     <tr>
                        <!-- <th>ID</th> -->
                  
                        <th>Restaurant Name</th>
                       <!--  <th>Owner Name</th>
                        <th>Mobile Number</th>
                        <th>Email</th> -->
                        <th>Location </th>
                        <!-- <th>Add Dish </th> -->
               
                 
                        <th>Action</th>
                  
                     </tr>
                  </thead>
                  <tbody>
                     <?php 
                        foreach ($getUser as $data) {
                               
                        
                        $getCategory = $this->Manage_product->getCategory($data['category_id']);
                        $getSubCategory = $this->Manage_product->getSubCategory($data['sub_category_id']);
                        if($data['status']==1){
                                         
                                         ?>
                     <tr>
                        <!-- <td><?php echo $data['id'] ?></td> -->
                    <!--     <td><?php echo $getCategory[0]['category_name'] ?></td>
                        <td><?php echo $getSubCategory[0]['subcategory_name'] ?></td> -->
                        <td><?php echo $data['shop_name'] ?></td>
                       <!--  <td><?php echo $data['name'] ?></td>
                        <td><?php echo $data['phone'] ?></td>
                        <td><?php echo $data['email'] ?></td> -->
                        <td><?php echo $data['address'] ?></td>
                      <!--   <td>
                           <a href="<?php echo base_url(); ?>Main_con/add_product/<?php echo $data['id'] ?>" class="mb-2 mr-2 border-0 btn-transition btn btn-outline-info"><i class="fa fa-plus"></i> Add Dish</a>
                        </td> -->
                   
                    <td>
                           <a href="<?php echo base_url(); ?>Main_con/add_shop/<?php echo $data['id'] ?>" class="mb-2 mr-2 border-0 btn-transition btn btn-outline-primary"><i class="fa fa-edit"></i> Edit</a>
                       
                           <a onclick="return deleteUser('<?php echo $data['id'] ?>');" class="mb-2 mr-2 border-0 btn-transition btn btn-outline-danger "><i class="fa fa-trash-alt"></i> </a>
                        </td>
                     <!--    <td>
                           <form name="updateVerifier">
                              <input type="hidden" name="id" value="<?php echo $data['id'] ?>"> 
                              <select class="" name="user_status">
                                 <option value="1" <?php if($data['user_status']==1){
                                    echo "selected"; } ?>
                                    >Activate</option>
                                 <option value="0" <?php if($data['user_status']==0){
                                    echo "selected"; } ?>>
                                    De-activate
                                 </option>
                              </select>
                              <br>
                              <br>
                              <input type="submit" class="btn-xs btn-primary" value="submit" name="">
                           </form>
                        </td> -->
                     </tr>
                     <?php } } ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<?php 
   include 'inc/footer.php';
   
   ?>