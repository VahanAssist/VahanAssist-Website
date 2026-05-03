<?php  include 'inc/header.php'; ?>   
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
               All Enquiry
               <!-- <div class="page-title-subheading">
                  <a href="<?php echo base_url(); ?>Main_con/add_category">Add Vehile Category</a>
               </div> -->
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
                        <th>S.no</th>
                        <th>Name</th>
                        <th>email</th>
                        <th>Phone Number</th>
                        <th>Message</th>
                        <th>Type</th>
                        <th>Date and Time</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                       $i=1;
                        foreach ($enquirys as $data) { ?>
                     <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $data['name'] ?></td>
                        <td><?php echo $data['email'] ?></td>
                        <td><?php echo $data['phoneNumber'] ?></td>
                        <td><?php echo $data['message'] ?></td>
                        <td><?php echo $data['type'] ?></td>
                        <td><?php echo $data['created'] ?></td>
                     </tr>
                     <?php  $i++; } ?>
                  </tbody>
               </table>
               <?php echo $links; ?>
            </div>
         </div>
      </div>
   </div>
</div>
<?php 
   include 'inc/footer.php';
   
   
   
   ?>