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
                  Trailer Booking
                  <!-- <div class="page-title-subheading">
                     <a href="<?php echo base_url(); ?>Main_con/add_booking">Driver Booking</a>
                  </div> -->
               </div>
            </div>
         </div>
      </div>
      <?php if ($this->session->flashdata('success')): ?>
         <div class="alert alert-success mt-2"><?php echo $this->session->flashdata('success'); ?></div>
      <?php endif; ?>
      <div class="row">
         <div class="col-lg-12">
            <div class="main-card mb-3 card">
               <div class="card-body">
                  <table class="mb-0 table">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>User</th>
                           <!-- <th>Vehicle</th> -->
                           <th>Pickup Location</th>
                           <th>Drop Location</th>
                           <th>Date</th>
                           <th>time</th>
                           <th>type</th>
                           <th>Comments</th>
                           <th>status</th>
                           <th>VAHAN</th>
                           <th>created</th>
                           <!-- <th>Assign Driver</th> -->
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $i = 1;
                        foreach ($vBookings as $data) { 
                           $getUserById = $this->Manage_product->getUserById($data['userId']);
                           $getVehicleById = $this->Manage_product->getVehicleById($data['userId']);
                           $totalCar = $this->Manage_product->getTotalCarByBooking($data['id']);
                           $assignedCar = $this->Manage_product->getCarAssigned($data['id']);
                           $notassignedCar = $this->Manage_product->getCarNotAssigned($data['id']);
                           ?>
                        
                           <tr>
                              <td><?php echo $data['id'] ?></td>
                              <td><?php echo $getUserById[0]['firstName'] ?></td>
                              <!-- <td><?php echo $getVehicleById[0]['name'] ?></td> -->
                              
                              <td><?php echo $data['pickupLocation'] ?></td>
                              <td><?php echo $data['dropLocation'] ?></td>
                              <td><?php echo $data['date'] ?></td>
                              <td><?php echo $data['time'] ?></td>
                              <td><?php echo $data['type'] ?></td>
                              <td><?php echo $data['comments'] ?></td>
                              <td>
                                 <?php echo $data['status'] ?><br>
                                 <?php echo date("d-m-Y", strtotime($data['updated'])) ?>

                                   <form class="status-form" method="post" action="javascript:void(0);">
                                        <input type="hidden" name="bookingId" value="<?php echo $data['id'] ?>">
                                        <div class="form-group mb-0">
                                            <select name="status" class="form-control form-control-sm status-dropdown" onchange="updateStatusDynamically(this)">
                                                <option value="null">Select Status</option>
                                                <option <?php echo $data['status'] == 'COMPLETED' ? "selected" : '' ?> value="COMPLETED">COMPLETED</option>
                                                <option <?php echo $data['status'] == 'BOOKED' ? "selected" : '' ?> value="BOOKED">BOOKED</option>
                                                <option <?php echo $data['status'] == 'ASSIGNED' ? "selected" : '' ?> value="ASSIGNED">ASSIGNED</option>
                                                <option <?php echo $data['status'] == 'REASSIGNED' ? "selected" : '' ?> value="REASSIGNED">REASSIGNED</option>
                                                <option <?php echo $data['status'] == 'ONGOING' ? "selected" : '' ?> value="ONGOING">ONGOING</option>
                                                <option <?php echo $data['status'] == 'CANCEL' ? "selected" : '' ?> value="CANCEL">CANCEL</option>
                                            </select>
                                        </div>
                                    </form>
                              </td>
                              <td>
                                <p> Total -   <?php echo $totalCar; ?></p>
                                 <p>Assigned  -   <?php echo $assignedCar; ?></p>
                                <p> Unassigned  - <?php echo $notassignedCar; ?></p>
<!-- <table>
                                    <tr><td>Total Cars -</td> <td>1</td> </tr>
                                    <tr><td>Assigned Cars -</td> <td>1</td> </tr>
                                    <tr><td>Unassigned Cars -</td> <td>1</td> </tr>
                                 </table> -->
                              </td>
                              <td><?php echo $data['created'] ?></td>
                              <!--   <td>
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

                              </td> -->
                              <td>
                                 <a href="<?php echo base_url(); ?>Main_con/orderdetails/<?php echo $data['id'] ?>" class="mb-2 mr-2 border-0 btn-transition btn btn-outline-danger "><i class="fa fa-eye"></i> </a>
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

<script>
function updateStatusDynamically(selectElement) {
    const form = $(selectElement).closest('form');
    const bookingId = form.find('input[name="bookingId"]').val();
    const status = $(selectElement).val();
    
    if(status === 'null') return;

    // Optional visual cue that it is saving
    $(selectElement).prop('disabled', true);

    $.ajax({
        url: '<?php echo base_url(); ?>Insert_con/updateBookingStatusAjax',
        type: 'POST',
        data: {
            bookingId: bookingId,
            status: status
        },
        dataType: 'json',
        success: function(response) {
            $(selectElement).prop('disabled', false);
            if(response.status === 'success') {
                // Flash success color briefly
                $(selectElement).css('background-color', '#d4edda');
                setTimeout(() => { $(selectElement).css('background-color', ''); }, 1500);
            } else {
                alert("Failed to update status: " + response.msg);
            }
        },
        error: function() {
            $(selectElement).prop('disabled', false);
            alert("Network error updating status.");
        }
    });
}
</script>