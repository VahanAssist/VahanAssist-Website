<?php  include 'inc/header.php';
   $id=$this->uri->segment(3);
   if ($id!="") {
   $getSociety = $this->Manage_product->getSociety($id);
   }/// print_r($getSociety);
   
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
               Add Society
               <div class="page-title-subheading">Add New Society
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
            <form method="post"  action="<?php echo base_url(); ?>Insert_con/insertSociety" enctype="multipart/form-data">
               <input name="id" id="id" type="hidden"  value="<?php echo $getSociety[0]['id'] ?>">
               <legend class="col-form-label col-sm-12">Basic Information</legend>
               
               <div class="position-relative row form-group">
                  <label for="name" class="col-sm-3 col-form-label">Society Name </label>
                  <div class="col-sm-9">
                     <input name="name" id="name" placeholder="" type="text" class="form-control" value="<?php echo $getSociety[0]['name']; ?>">
                  </div>
               </div>
                 <div class="position-relative row form-group">
                  <label for="name" class="col-sm-3 col-form-label">Sector </label>
                  <div class="col-sm-9">
                     <input name="sector" id="sector" placeholder="" type="text" class="form-control" value="<?php echo $getSociety[0]['sector']; ?>">
                  </div>
               </div>
               <div class="position-relative row form-group">
                  <label for="name" class="col-sm-3 col-form-label">COD / PAY ONLINE </label>
                  <div class="col-sm-9">
                     <label for="codd">
                     <input name="cod[]" id="codd"  type="checkbox" class="" <?php if($getSociety[0]['cod']=="cod"){ echo "selected"; } ?> value="cod"> COD</label>
                         <label for="onlinee">
                     <input name="cod[]"   type="checkbox" id="onlinee" class="" <?php if($getSociety[0]['cod']=="online"){ echo "selected"; } ?> value="online"> ONLINE</label>
                  </div>
               </div>
               <div class="position-relative row form-group">
                  <label for="name" class="col-sm-3 col-form-label">Delivery Charge </label>
                  <div class="col-sm-9">
                     <input name="delivery_charge" id="delivery_charge"  type="text" class="form-control" value="<?php echo $getSociety[0]['delivery_charge']; ?>">
                  </div>
               </div>
                <div class="position-relative row form-group">
                  <label for="name" class="col-sm-3 col-form-label">block area </label>
                  <div class="col-sm-9">
                     <select name="status" class="form-control">
                        <option value="0" <?php if($getSociety[0]['status']==0){ echo "selected"; } ?>>Unblock</option>
                        <option value="1" <?php if($getSociety[0]['status']==1){ echo "selected"; } ?>>Block</option>
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
                              <th>Society Name</th>
                              <th>Sector</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              $getSociety = $this->Manage_product->getSociety('');
                              foreach ($getSociety as $data) {
                              ?>    
                           <tr>
                              <td><?php echo $data['id']; ?> </td>
                              <td><?php echo $data['name']; ?> </td>
                              <td><?php echo $data['sector'] ?> </td>
                             
                              <td><a href="<?php echo base_url(); ?>Main_con/add_society/<?php echo $data['id'] ?>" class="btn btn-primary"><i class="fa fa-eye"></i> Edit</a>/<a onclick="return deleteSociety('<?php echo $data['id']; ?>'); " class="btn btn-success" style="color: #fff;">Delete<i class="fa fa-angle-right"></i></a></td>
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