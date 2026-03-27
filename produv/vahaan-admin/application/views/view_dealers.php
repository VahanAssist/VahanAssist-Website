<?php  include 'inc/header.php'; 
// print_r($dealers);
// die();
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
               All Dealers
               <div class="page-title-subheading">
                  <!-- <a href="<?php echo base_url(); ?>Main_con/add_user">Add User</a> -->
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
                        <th>S No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Source</th>
                        <th>Reg. Date</th>
                        <th>Cars</th>
                        <th>Enquiry Made</th>
                        <th>Block/Unblock</th>
                        <th>Verified Dealer</th>
                        <th>Delete Request</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php 
                     $i=1;
                     foreach($dealers as $dealer){
                     ?>
                       <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $dealer['firstName'] ?></td>
                        <td><?php echo $dealer['email'] ?></td>
                        <td><?php echo $dealer['phoneNumber'] ?></td>
                        <td><?php echo $dealer['source'] ?></td>
                        
                        <td><?php echo $dealer['created'] ?></td>
                        <td>
                           <a href="<?php echo base_url(); ?>Main_con/view_dealer_cars/<?php echo $dealer['id'] ?>" class="btn btn-xs btn-small btn-primary">View Cars</a>
                        </td>
                        <td>
                           <a href="<?php echo base_url(); ?>Main_con/view_dealer_enquiry/<?php echo $dealer['id'] ?>" class="btn btn-xs btn-small btn-primary">View Enquiry</a>
                        </td>
                        <td>
                             <select name="blocked" class="" onchange="updateBlockStatus('<?php echo $dealer['id'] ?>',this)">
                              <option <?php echo  $dealer['blocked'] == 1 ? 'selected' : '' ?> value="1">Block</option>
                              <option <?php echo $dealer['blocked'] == 0 ? 'selected' : '' ?> value="0">Unblock</option>
                             </select>
                        </td>

                        <td>
                             <select name="blocked" class="" onchange="updateVerifyStatus('<?php echo $dealer['id'] ?>',this)">
                              <option <?php echo  $dealer['status'] == 1 ? 'selected' : '' ?> value="1">Verified</option>
                              <option <?php echo $dealer['status'] == 0 ? 'selected' : '' ?> value="0">not Verified</option>
                             </select>
                        </td>
                        <td>
                           <?php echo $dealer['deleteAccountReq'] == 1 ? 'Yes' : 'No' ?>
                        </td>
                        <td>
                           <a onclick="return deleteUser('<?php echo $dealer['id'] ?>');" class="mb-2 mr-2 border-0 btn-transition btn btn-outline-danger "><i class="fa fa-trash-alt"></i></a>
                        </td>
                     </tr>
                     <?php $i++; } ?>
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