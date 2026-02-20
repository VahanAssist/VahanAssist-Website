<?php  include 'inc/header.php';
   $id=$this->uri->segment(3);
   
   if ($id!="") {
   
   $getSplace = $this->Manage_product->getSplace($id);
   
   }/// print_r($getSplace);
   
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
               Add Splace
               <div class="page-title-subheading">Add New Splace
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
            <form method="post"  action="<?php echo base_url(); ?>Insert_con/insertSplace" enctype="multipart/form-data">
               <input name="id" id="id" type="hidden"  value="<?php echo $getSplace[0]['id'] ?>">
               <legend class="col-form-label col-sm-12">Basic Information</legend>
               <div class="position-relative row form-group">
                  <label for="name" class="col-sm-3 col-form-label">Title </label>
                  <div class="col-sm-9">
                     <input name="title" id="title" placeholder="" type="text" class="form-control" value="<?php echo $getSplace[0]['title']; ?>">
                  </div>
               </div>
               
                <div class="position-relative row form-group">
                  <label for="name" class="col-sm-3 col-form-label">Image </label>
                  <div class="col-sm-9">
                     <input name="image" id="image" placeholder="" type="file" class="form-control" >
                     <input name="image_old" id="image"  type="hidden" value="<?php echo $getSplace[0]['image']; ?>">
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
                              <th>Title</th>
                              <th>Image</th>
                      
                          
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              $getSplace = $this->Manage_product->getSplace('');
                              
                              
                              
                              foreach ($getSplace as $data) {
                              
                              
                              ?>    
                           <tr>
                              <td><?php echo $data['id']; ?> </td>
                              <td><?php echo $data['title']; ?> </td>
                              <td><?php echo $data['image'] ?> </td>
                             
                              <td><a href="<?php echo base_url(); ?>Main_con/add_coupon/<?php echo $data['id'] ?>" class="btn btn-primary"><i class="fa fa-eye"></i> Edit</a></td>
                              <td><a onclick="return deleteSplace('<?php echo $data['id']; ?>'); " class="btn btn-success" style="color: #fff;">Delete<i class="fa fa-angle-right"></i></a></td>
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