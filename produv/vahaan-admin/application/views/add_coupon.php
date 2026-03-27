<?php  include 'inc/header.php';
   $id=$this->uri->segment(3);
   
   if ($id!="") {
   
   $getCoupon = $this->Manage_product->getCoupon($id);
   
   }/// print_r($getCoupon);
   
   ?>
<style type="text/css">
   legend{
   border-bottom: 1px solid #ccc;
   margin-bottom: 16px !important;
   font-size: 18px !important;
   padding: 0 !important;
   }
</style>
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
               Add Coupon
               <div class="page-title-subheading">Add New Coupon
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-2"></div>
      <div class="main-card mb-3 col-lg-8 card">
         <div class="card-body">
            <!--       <form class="" name="insertVerifier"> -->
            <form method="post"  action="<?php echo base_url(); ?>Insert_con/insertCoupon" enctype="multipart/form-data">
               <input name="id" id="id" type="hidden"  value="<?php echo $getCoupon[0]['id'] ?>">
               <legend class="col-form-label col-sm-12">Basic Information</legend>
               <div class="position-relative row form-group">
                  <label for="coupon" class="col-sm-3 col-form-label">Code</label>
                  <div class="col-sm-9">
                     <input name="coupon" id="coupon" placeholder="" type="text" class="form-control" value="<?php echo $getCoupon[0]['coupon']; ?>">
                  </div>
               </div>
               
                <div class="position-relative row form-group">
                  <label for="discount" class="col-sm-3 col-form-label">Discount </label>
                  <div class="col-sm-9">
                     <input name="discount" id="discount" placeholder="" type="text" class="form-control" value="<?php echo $getCoupon[0]['discount']; ?>">
                  </div>
               </div>
               <div class="position-relative row form-group">
                  <label for="discount" class="col-sm-3 col-form-label">Type</label>
                  <div class="col-sm-9">
                     <!-- <input name="discount" id="discount" placeholder="" type="text" class="form-control" value="<?php echo $getCoupon[0]['discount']; ?>"> -->
                      <select class="form-control" name="type">
                        <option value="undefined">Select</option>
                        <option <?php echo $getCoupon[0]['type'] == 'Service' ? 'selected' : ''?> value="Service">Service</option>
                        <option <?php echo $getCoupon[0]['type'] == 'Subscription' ? 'selected' : ''?> value="Subscription">Subscription</option>
                      </select>
                  </div>
               </div>
               
               <div class="position-relative row form-check">
                  <div class="col-sm-10 offset-sm-2">
                     <!--  <input type="submit"  value="Submit" > -->
                     <input type="submit" class="btn btn-secondary"   value="Submit" >
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- ////////////////// -->
       <div class="row">
            <div class="col-lg-12">
               <div class="main-card mb-3 card">
                  <div class="card-body">
                     <table class="mb-0 table"  id="myTable">
                        <thead>
                           <tr>
                              <th>Id</th>
                              <th>Coupon</th>
                              <th>Discout</th>
                              <th>Type</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              $getCoupon = $this->Manage_product->getCoupon('');
                              
                              
                              
                              foreach ($getCoupon as $data) {
                              
                              
                              ?>    
                           <tr>
                              <td><?php echo $data['id']; ?> </td>
                              <td><?php echo $data['coupon']; ?> </td>
                              <td><?php echo $data['discount'] ?> </td>
                              <td><?php echo $data['type'] ?> </td>
                              <td><a href="<?php echo base_url(); ?>Main_con/add_coupon/<?php echo $data['id'] ?>" class="btn btn-primary"><i class="fa fa-eye"></i> Edit</a></td>
                              <td><a onclick="return deleteCoupon('<?php echo $data['id']; ?>'); " class="btn btn-success" style="color: #fff;">Delete<i class="fa fa-angle-right"></i></a></td>
                           </tr>
                           <?php  } ?>  
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
          <!-- ////////////////// -->
</div>
<br>
<br>
<br>
<br>
<?php include 'inc/footer.php'; ?>