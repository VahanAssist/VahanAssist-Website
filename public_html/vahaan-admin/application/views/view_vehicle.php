<?php  include 'inc/header.php'; 
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
               All Vehicles
               <div class="page-title-subheading">
                  <a href="<?php echo base_url(); ?>Main_con/add_vehicle">Add Vehicle</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12">
         <div class="main-card mb-3 card">
            <div class="card-body">
               <table class="mb-0 table">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Regno</th>
                        <th>price</th>
                        <th>Added By</th>
                        <th>Location</th>
                        <th>year</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                    //  print_r($vehicles);
                       $i=1;
                        foreach ($vehicles as $fr) {
                            ?>
                     <tr>
                        <!-- <td><?php echo $i ?></td> -->
                        <td><?php echo $fr['vehicle_id'] ?></td>
                        <td><?php echo $fr['category_name'] ?></td>
                        <td><?php echo $fr['brand_name'] ?></td>
                        <td><?php echo $fr['model_name'] ?></td>
                        <td><?php echo $fr['regno'] ?></td>
                        <td><?php echo $fr['price'] ?></td>
                        <td><?php echo $fr['owner_name'] ?></td>
                        <td><?php echo $fr['location'] ?></td>
                        <td><?php echo $fr['year'] ?></td>
                        <td>
                           <a href="<?php echo base_url(); ?>Main_con/add_vehicle/<?php echo $fr['id'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                           /<a onclick="return deleteVehicle('<?php echo $fr['id'] ?>');" class="mb-2 mr-2 border-0 btn-transition btn btn-outline-danger "><i class="fa fa-trash-alt"></i> </a>
                        </td>
                     </tr>
                     <?php  $i++; } ?>
                  </tbody> 
                   <?php echo $links; ?>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<?php 
   include 'inc/footer.php';
   
   
   
   ?>