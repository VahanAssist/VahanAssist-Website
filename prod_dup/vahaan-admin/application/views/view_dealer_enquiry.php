<?php  include 'inc/header.php'; 

$dealer = $this->uri->segment(3);

$getDealer = $this->Manage_product->getUserById($dealer);

// print_r($dealers_custom_enquiry);
// die();

?>   

<style type="text/css">
   .col-lg-3{
      float: left;
   }
   .wrap-dealer{

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
            <?php echo $getDealer[0]['firstName'] ?> - Custom enquiries 
               <div class="page-title-subheading">
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      
   </div>
   <div class="row">
      <div class="col-lg-12">
         <div class="main-card mb-3 card">
            <div class="card-body">
               <table class="mb-0 table">
                  <thead>
                        <tr>
                           <th>S.no</th>
                           <th>Customer Name</th>
                           <th>Email</th>
                           <th>Phone No</th>
                           <th>Car Details</th>
                           <th>Date of Enquiry</th>
                           <th>Status</th>
                       </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $i = 1;
                           foreach($dealers_custom_enquiry as $cen){
                           ?>
                  <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $cen['cust_name'] ?></td>
                      <td><?php echo $cen['cust_email'] ?></td>
                      <td><?php echo $cen['cust_phone'] ?></td>
                      <td>
                          <table class="table ">
                     
                              <tr>
                                  <td>Category</td>
                                  <td>Brand</td>
                                  <td>Model</td>
                                  <td>Ownership</td>
                              </tr>
                              <?php 
                               foreach($cen['carsDetail'] as $cd){
                              ?>
                              <tr>
                                  <td><?php echo $cd['category_id'] ?></td>
                                  <td><?php echo $cd['brand_id'] ?></td>
                                  <td><?php echo $cd['model_id'] ?></td>
                                  <td><?php echo $cd['ownership'] ?></td>
                              </tr>
                              <?php } ?>
                          </table>
                      </td>
                      <td><?php echo $cen['date'] ?></td>
                      <td>
                      <?php echo $cen['status'] ?>
                      </td>
                  </tr>
                  <?php $i++;} ?>
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