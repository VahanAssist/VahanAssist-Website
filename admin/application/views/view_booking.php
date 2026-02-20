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
                  All Driver Booking
                  <div class="page-title-subheading">
                     <a href="<?php echo base_url(); ?>Main_con/add_booking">Add Driver Booking</a>
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
                           <th>User</th>
                           <th>Vehicle</th>
                           <th>Pickup Location</th>
                           <th>Drop Location</th>
                           <th>Date</th>
                           <th>time</th>
                           <th>type</th>
                           <th>Comments</th>
                           <th>status</th>
                           <th>created</th>
                           <th>Assign Driver</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $i = 1;
                        foreach ($bookings as $data) { 
                           $getUserById = $this->Manage_product->getUserById($data['userId']);
                           $getVehicleById = $this->Manage_product->getVehicleById($data['userId'])
                           ?>
                        
                           <tr>
                              <td><?php echo $i ?></td>
                              <td><?php echo $getUserById[0]['firstName'] ?></td>
                              <td><?php echo $getVehicleById[0]['name'] ?></td>
                              <td><?php echo $data['pickup'] ?></td>
                              <td><?php echo $data['drop'] ?></td>
                              <td><?php echo $data['date'] ?></td>
                              <td><?php echo $data['time'] ?></td>
                              <td><?php echo $data['type'] ?></td>
                              <td><?php echo $data['comments'] ?></td>
                              <td><?php echo $data['status'] ?></td>
                              <td><?php echo $data['created'] ?></td>
                              <td>
                                 <form action="<?php echo base_url();?>Insert_con/updateBooking" method="POST">
                                    <input type="hidden" name="bookingId" value="<?php echo $data['id'] ?>" />
                                    <select name="assignDriverId" class="form-control">
                                       <option value="">Select Driver</option>
                                    <?php
                                    $getDrivers = $this->Manage_product->getDrivers();
                                    foreach ($getDrivers as $dr) {
                                    ?>
                                        <option <?php echo $data['assignDriverId'] == $dr['id'] ? 'selected' : '' ?> value="<?php echo $dr['id'] ?>"><?php echo $dr['firstName'] ?></option>
                                    <?php } ?>
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm">Assign</button>
                                 </form>

                              </td>
                              <td>
                                 <a href="<?php echo base_url(); ?>Main_con/add_booking/<?php echo $data['id'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                                 /<a onclick="return deleteBooking('<?php echo $data['id'] ?>');" class="mb-2 mr-2 border-0 btn-transition btn btn-outline-danger "><i class="fa fa-trash-alt"></i> </a>
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