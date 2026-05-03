<?php  include 'inc/header.php'; ?>   
<div class="app-main__outer">
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-cash icon-gradient bg-mean-fruit">
               </i>
            </div>
            <div>
               Marketplace Price Requests
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12">
         <div class="main-card mb-3 card">
            <div class="card-body" style="overflow-x: auto;">
               <table class="mb-0 table">
                  <thead>
                     <tr>
                        <th>S.no</th>
                        <th>Request Date</th>
                        <th>Vehicle</th>
                        <th>Listed Price</th>
                        <th>Offered Price</th>
                        <th>Owner</th>
                        <th>Requested By</th>
                        <th>Contact No</th>
                        <th>Email</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                       $i=1;
                        foreach ($requests as $data) { ?>
                     <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo date('d-M-Y H:i', strtotime($data['created'])); ?></td>
                        <td>
                            <b><?php echo $data['brand_name'] . ' ' . $data['model_name'] ?></b><br>
                            <?php echo $data['variant'] ?><br>
                            <small class="text-muted"><?php echo $data['regno'] ?></small>
                        </td>
                        <td>₹<?php echo $data['actual_price'] ?></td>
                        <td><b class="text-success">₹<?php echo $data['price'] ?></b></td>
                        <td><?php echo $data['owner_name'] ?> (<?php echo ucfirst(strtolower($data['added_type'])); ?>)</td>
                        <td><?php echo $data['request_by'] ?></td>
                        <td><?php echo $data['contactNo'] ?></td>
                        <td><?php echo $data['email'] ?></td>
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
