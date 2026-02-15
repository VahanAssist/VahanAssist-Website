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
               All Driver
               <div class="page-title-subheading">
                  <a href="<?php echo base_url(); ?>Main_con/add_driver">Add Driver</a>
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
                        <th>SNo.</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Source</th>
                        <th>created</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     // print_r($drivers);
                       $i=1;
                        foreach ($drivers as $data) { ?>
                     <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $data['firstName'] ?></td>
                        <td><?php echo $data['email'] ?></td>
                        <td><?php echo $data['phoneNumber'] ?></td>
                        <td><?php echo $data['source'] ?></td>
                        <td><?php echo $data['date'] ?></td>
                        <td><?php echo $data['created'] ?></td>
                        <td>
                           <a href="<?php echo base_url(); ?>Main_con/add_driver/<?php echo $data['id'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                           /<a onclick="return deleteUser('<?php echo $data['id'] ?>');" class="mb-2 mr-2 border-0 btn-transition btn btn-outline-danger "><i class="fa fa-trash-alt"></i> </a>
                        </td>
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