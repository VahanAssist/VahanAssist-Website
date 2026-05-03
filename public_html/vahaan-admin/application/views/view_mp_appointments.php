<?php  include 'inc/header.php'; ?>   
<div class="app-main__outer">
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-date icon-gradient bg-mean-fruit">
               </i>
            </div>
            <div>
               Marketplace Appointments
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
                        <th>Created</th>
                        <th>Appt. Date & Time</th>
                        <th>Vehicle</th>
                        <th>Owner</th>
                        <th>Requested By</th>
                        <th>Contact No</th>
                        <th>Email</th>
                        <th>Note</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                       $i=1;
                        foreach ($appointments as $data) { ?>
                     <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo date('d-M-Y', strtotime($data['created'])); ?></td>
                        <td><b class="text-primary"><?php echo date('d-M-Y', strtotime($data['date'])); ?> at <?php echo $data['time'] ?></b></td>
                        <td>
                            <b><?php echo $data['brand_name'] . ' ' . $data['model_name'] ?></b><br>
                            <small class="text-muted"><?php echo $data['regno'] ?></small>
                        </td>
                        <td><?php echo $data['owner_name'] ?> (<?php echo ucfirst(strtolower($data['added_type'])); ?>)</td>
                        <td><?php echo $data['request_by'] ?></td>
                        <td><?php echo $data['contactNo'] ?></td>
                        <td><?php echo $data['email'] ?></td>
                        <td style="max-width: 200px;"><?php echo $data['description'] ?></td>
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
