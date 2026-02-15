<?php include 'inc/header.php'; ?>
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
                  Insurance Booking
                  <!-- <div class="page-title-subheading">
                     <a href="<?php echo base_url(); ?>Main_con/add_booking">Driver Booking</a>
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
                           <th>Customer Name</th>
                           <th>Email Id</th>
                           <th>Phone No</th>
                           <th>Message</th>
                           <th>Insurance Type </th>
                           <!-- <th>Status</th> -->
                           <th>Booked on</th>
                        
                           <th colspan="2">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $i = 1;
                        foreach ($vBookings as $data) { 
                           $getUserById = $this->Manage_product->getUserById($data['userId']);
                           $getVehicleById = $this->Manage_product->getVehicleById($data['userId'])
                           ?>
                        
                           <tr>
                              <td><?php echo $getUserById[0]['firstName'] ?></td>
                              <td><?php echo $getUserById[0]['email'] ?></td>
                              <td><?php echo $getUserById[0]['phoneNumber'] ?></td>
                              <td><?php echo $data['comments'] ?></td>
                              <td><?php echo $data['insuranceType'] ?></td>
                            
                              <!-- <td><?php echo $getVehicleById[0]['name'] ?></td> -->
                             <!--  <td><?php echo $data['pickup'] ?></td>
                              <td><?php echo $data['drop'] ?></td>
                              <td><?php echo $data['date'] ?></td>
                              <td><?php echo $data['time'] ?></td> -->
                             
                              <!-- <td><?php echo $data['status'] ?></td> -->
                              <td><?php echo $data['created'] ?></td>
                              <td>
                                 <a href="<?php echo base_url(); ?>Main_con/insuranceorderdetails/<?php echo $data['id'] ?>" class="mb-2 mr-2 border-0 btn-transition btn btn-outline-danger "><i class="fa fa-eye"></i> </a>
                              </td>
                              <td>
                                <a onclick="return deleteBooking('<?php echo $data['id'] ?>');" class="mb-2 mr-2 border-0 btn-transition btn btn-outline-danger "><i class="fa fa-trash-alt"></i> </a>
                              </td>
                           </tr>
                        <?php $i++;
                        } ?>
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