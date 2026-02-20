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
               All Vehicles Category
               <div class="page-title-subheading">
                  <a href="<?php echo base_url(); ?>Main_con/add_category">Add Vehicles Category</a>
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
                        <th>Vehicle Name</th>
                        <th>Image</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                       $i=1;
                        foreach ($categorys as $data) { ?>
                     <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $data['name'] ?></td>
                        <td><img width="200" src="<?php echo base_url(); ?>images/category_image/<?php echo $data['image'] ?>"></td>
                        <td>
                           <a href="<?php echo base_url(); ?>Main_con/add_category/<?php echo $data['id'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                           /<a onclick="return deleteCategory('<?php echo $data['id'] ?>');" class="mb-2 mr-2 border-0 btn-transition btn btn-outline-danger "><i class="fa fa-trash-alt"></i> </a>
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
<?php 
   include 'inc/footer.php';
   
   
   
   ?>