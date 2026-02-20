    <?php

    include 'inc/header.php';

    $order_id = $this->uri->segment(3);
    // $space = trim($order_id);
    $getbookingData = $this->Manage_product->getBookingById($order_id);
    $getCarDeatail = $this->Manage_product->getCarDetailsByBooking($order_id);
    $getUser = $this->Manage_product->getUserById($getbookingData[0]['userId']);
    $getTracking = $this->Manage_product->getTrackingByBooking($order_id);
    $getPaymentByBookingId = $this->Manage_product->getPaymentByBookingId($order_id);

    if ($getCarDeatail[0]['assignDriverId'] != 0) {
        $getFirstDriver = $this->Manage_product->getUserById($getCarDeatail[0]['assignDriverId']);
        $getFirstPickup = $this->Manage_product->getCarPickupImages($getCarDeatail[0]['assignDriverId']);
        $getFirstDrop = $this->Manage_product->getCarDropImages($getCarDeatail[0]['assignDriverId']);
    }

    if ($getCarDeatail[0]['assignSecondDriverId'] != 0) {
        $getSecondDriver = $this->Manage_product->getUserById($getCarDeatail[0]['assignSecondDriverId']);
        $getSecondPickup = $this->Manage_product->getCarPickupImages($getCarDeatail[0]['assignSecondDriverId']);
        $getSecondDrop = $this->Manage_product->getCarDropImages($getCarDeatail[0]['assignSecondDriverId']);
    }

    

    //    print_r($getPaymentByBookingId);

    ?>
    <style type="text/css">
        legend {
            border-bottom: 1px solid #ccc;
            margin-bottom: 16px !important;
            font-size: 18px !important;
            padding: 0 !important;
        }

        .pull-left {
            float: left;
        }

        .modal-backdrop {
            z-index: 0 !important;
        }

        .modal-dialog {

            margin: 4.75rem auto;
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



                        <div> Order Details



                            <div class="page-title-subheading"> Order Details



                            </div>



                        </div>



                    </div>



                </div>



            </div>



            <div class="row">







                <div class="main-card mb-3 col-lg-12 card">



                    <div class="card-body">

                        <form method="post" action="" name="updateOrder" enctype="multipart/form-data">


                            <div class="col-lg-6 pull-left">

                                <input type="hidden" name="order_id" value="AL-1003241083">



                                <legend class="col-form-label col-sm-12">Customer Information</legend>



                                <div class="position-relative row form-group">

                                    <label for="name" class="col-sm-3 col-form-label">Customer Name </label>

                                    <div class="col-sm-9">



                                        <input name="name" id="" placeholder="" type="text" class="form-control" value="<?php echo $getUser[0]['firstName'] ?>">
                                    </div>

                                </div>

                                <div class="position-relative row form-group">



                                    <label for="name" class="col-sm-3 col-form-label">Email ID</label>



                                    <div class="col-sm-9">



                                        <input name="email" id="" placeholder="" type="text" class="form-control" value="<?php echo $getUser[0]['email'] ?>">
                                    </div>



                                </div>

                                <div class="position-relative row form-group">



                                    <label for="name" class="col-sm-3 col-form-label">Phone No</label>



                                    <div class="col-sm-9">



                                        <input name="phoneNumber" id="" placeholder="" type="text" class="form-control" value="<?php echo $getUser[0]['phoneNumber'] ?>">
                                    </div>



                                </div>





                            </div>
                            <div class="col-lg-6 pull-left">

                                <legend class="col-form-label col-sm-12">Pickup / Drop Information</legend>


                                <div class="position-relative row form-group">



                                    <label for="name" class="col-sm-3 col-form-label">Pick Up Address</label>

                                    <div class="col-sm-9">


                                        <!-- <label class="col-form-label">show pickup location</label> -->
                                        <p>Pickup lat: <?php echo $getbookingData[0]['picklat'] ?></p>
                                        <p>Pickup lng: <?php echo $getbookingData[0]['picklng'] ?></p>
                                        <a href="https://www.google.com/maps/@<?php echo $getbookingData[0]['picklat'] ?>,<?php echo $getbookingData[0]['picklng'] ?>">View on Map </a>


                                    </div>

                                </div>



                                <div class="position-relative row form-group">



                                    <label for="name" class="col-sm-3 col-form-label">Drop Location</label>



                                    <div class="col-sm-9">



                                        <!-- <label class="col-form-label">Drop location</label> -->

                                        <p>Drop lat: <?php echo $getbookingData[0]['droplat'] ?></p>
                                        <p>Drop lng: <?php echo $getbookingData[0]['droplng'] ?></p>
                                        <a href="https://www.google.com/maps/@<?php echo $getbookingData[0]['droplat'] ?>,<?php echo $getbookingData[0]['droplng'] ?>">View on Map </a>

                                    </div>




                                </div>

                                <div class="position-relative row form-group">



                                    <label for="name" class="col-sm-3 col-form-label">KM Difference</label>



                                    <div class="col-sm-9">



                                        <label class="col-form-label"> -</label>



                                    </div>




                                </div>

                            </div>
                        </form>


                        <div class="col-lg-12 text-center pull-left" style="margin-top: 20px;">
                            <form action="<?php echo base_url() ?>Insert_con/updateQuoteByBookingId" method="post" name="updateQuote">
                                <input type="hidden" name="bookingId" value="<?php echo $order_id; ?>">
                                <input type="hidden" name="userId" value="<?php echo $getbookingData[0]['userId']; ?>">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>
                                            <label>Update Quote</label>
                                            <input type="text" class="form-control" name="total_quote" value="<?php echo $getbookingData[0]['total_quote'] ?>">
                                        </td>
                                        <td>
                                            <input type="submit" class="btn btn-info btn-small btn-xs">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Quote Date - <?php echo $getbookingData[0]['quote_date'] ?>
                                        </td>
                                        <td>
                                            Payment Status - <?php echo count($getPaymentByBookingId) > 0 ? $getPaymentByBookingId[count($getPaymentByBookingId) - 1]['status'] : 'pending'  ?>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Payment Status</th>
                                        <th>Date</th>
                                    </tr>
                                    <?php
                                    foreach ($getPaymentByBookingId as $book) {
                                    ?>
                                        <tr>
                                            <?php
                                            if ($book['status'] == 'Partial') {
                                            ?>
                                                <td>
                                                    <?php echo $book['status'] ?> Payment - Rs <?php echo $book['partialAmount'] ?>
                                                </td>
                                            <?php } ?>

                                            <?php
                                            if ($book['status'] == 'Paid') {
                                            ?>
                                                <td>
                                                    <?php echo $book['status'] ?> Payment - Rs <?php echo $book['totalAmount'] ?>
                                                </td>
                                            <?php } ?>

                                            <?php
                                            if ($book['status'] == 'Partial') {
                                            ?>
                                                <td>
                                                    <?php echo $book['partialPaymentDate']  ?>
                                                </td>
                                            <?php } ?>

                                            <?php
                                            if ($book['status'] == 'Paid') {
                                            ?>
                                                <td>
                                                    <?php echo $book['totalAmountDate']  ?>
                                                </td>
                                            <?php } ?>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>





                        <div class="main-card mb-3 col-lg-12 card">



                            <div class="card-body">







                                <legend class="col-form-label col-sm-12">Vehicle Information</legend>

                                <?php
                                $flash_message = $this->session->flashdata('error');
                                if ($flash_message) {
                                    echo '<div class="alert alert-danger">' . $flash_message . '</div>';
                                    $this->session->unset_userdata('error'); // Manually clear the flash message
                                }
                                ?>
                                <?php
                                $flash_messagev2 = $this->session->flashdata('errorv2');
                                if ($flash_messagev2) {
                                    echo '<div class="alert alert-danger">' . $flash_messagev2 . '</div>';
                                    $this->session->unset_userdata('errorv2'); // Manually clear the flash message
                                }
                                ?>
                                <table class="table">

                                    <tbody>
                                        <tr>

                                            <th>Car Model</th>

                                            <!-- <th>Car Type</th> -->
                                            <th>Car Images</th>

                                            <th>Car Quality</th>

                                            <th>Car Condition</th>

                                            <th>Assign Driver</th>
                                            <?php
                                            if ($getbookingData[0]['bookingType'] == 'TRAILER') {
                                            ?>
                                                <th>Assign Second Driver</th>
                                            <?php } ?>

                                        </tr>
                                        <?php
                                        foreach ($getCarDeatail as $car) {
                                        ?>
                                            <tr>
                                                <td><?php echo $car['model'] ?></td>
                                                <!-- <td><?php echo $car['carType'] ?></td> -->
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#carimages">
                                                        Images
                                                    </button>

                                                    <!-- Modal -->
                                                  <!--   <div class="modal fade" id="carimages" tabindex="-1" role="dialog" aria-labelledby="carmodel<?php echo $car['model'] ?>" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="carmodel<?php echo $car['model'] ?>"><?php echo $car['model'] ?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="col-sm-12 pull-left" action="<?php echo base_url() ?>Insert_con/insertCarPickupDropImages" method="post" enctype="multipart/form-data">
                                                                        <input type="hidden" name="carId" value="<?php echo $getCarDeatail[0]['id'] ?>">
                                                                        <input type="hidden" name="bookingId" value="<?php echo $order_id ?>">
                                                                         <div class="col-sm-4 pull-left">
                                                                            <select class="form-control" name="type">
                                                                               <option value="">Select</option>
                                                                               <option value="pickup">Pickup image</option>
                                                                               <option value="drop">Drop Image</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-sm-4 pull-left">
                                                                            <select class="form-control" name="driverId">
                                                                                <?php 
                                                                                if(count($getFirstDriver) > 0){
                                                                                ?>
                                                                                <option value="<?php echo $getFirstDriver[0]['id'] ?>"><?php echo $getFirstDriver[0]['firstName'] ?></option>
                                                                                <?php } ?>
                                                                                <?php 
                                                                                if(count($getSecondDriver) > 0){
                                                                                ?>
                                                                                <option value="<?php echo $getSecondDriver[0]['id'] ?>"><?php echo $getSecondDriver[0]['firstName'] ?></option>
                                                                                <?php }  ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-sm-4 pull-left">
                                                                            <input type="file" class="form-control" name="image">
                                                                        </div>
                                                                        <div class="col-sm-4  pull-left">
                                                                            <input type="submit" name="" class="btn btn-primary btn-small">
                                                                        </div>
                                                                    </form>
                                                                    <hr class="col-sm-12 pull-left">

                                                                    <div class="container-fluid">
                                                                         
                                                                        <div class="row mb-4">
                                                                            <div class="col-12">
                                                                                <h5>Driver 1 - Pickup Images</h5>
                                                                            </div>
                                                                            <?php foreach ($getFirstPickup as $fp) { ?>
                                                                                <div class="col-sm-6 col-md-4 col-lg-3 text-center mb-3">
                                                                                    <a href="<?php echo base_url('images/vehicle_image/' . $fp['image']) ?>" target="_blank">
                                                                                        <img src="<?php echo base_url('images/vehicle_image/' . $fp['image']) ?>" class="img-fluid img-thumbnail" alt="Pickup Image">
                                                                                    </a>
                                                                                     <form class="mt-2" action="<?php echo base_url() ?>Insert_con/deleteCarPickupImage" method="post" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                                                                        <input type="hidden" name="id" value="<?php echo $fp['id'] ?>">
                                                                                        <input type="hidden" name="bookingId" value="<?php echo $order_id ?>">
                                                                                        <button class="btn btn-danger" type="submit">Delete</button>
                                                                                    </form>
                                                                                </div>
                                                                            <?php } ?>
                                                                        </div>

                                                                      
                                                                        <div class="row mb-4">
                                                                            <div class="col-12">
                                                                                <h5>Driver 1 - Drop Images</h5>
                                                                            </div>
                                                                            <?php foreach ($getFirstDrop as $fd) { ?>
                                                                                <div class="col-sm-6 col-md-4 col-lg-3 text-center mb-3">
                                                                                    <a href="<?php echo base_url('images/vehicle_image/' . $fd['image']) ?>" target="_blank">
                                                                                        <img src="<?php echo base_url('images/vehicle_image/' . $fd['image']) ?>" class="img-fluid img-thumbnail" alt="Drop Image">
                                                                                    </a>
                                                                                        <form class="mt-2" action="<?php echo base_url() ?>Insert_con/deleteCarDropImage" method="post" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                                                                        <input type="hidden" name="id" value="<?php echo $fd['id'] ?>">
                                                                                        <input type="hidden" name="bookingId" value="<?php echo $order_id ?>">
                                                                                        <button class="btn btn-danger" type="submit">Delete</button>
                                                                                    </form>
                                                                                </div>
                                                                            <?php } ?>
                                                                        </div>

                                                                       
                                                                        <div class="row mb-4">
                                                                            <div class="col-12">
                                                                                <h5>Driver 2 - Pickup Images</h5>
                                                                            </div>
                                                                            <?php foreach ($getSecondPickup as $sp) { ?>
                                                                                <div class="col-sm-6 col-md-4 col-lg-3 text-center mb-3">
                                                                                    <a href="<?php echo base_url('images/vehicle_image/' . $sp['image']) ?>" target="_blank">
                                                                                        <img src="<?php echo base_url('images/vehicle_image/' . $sp['image']) ?>" class="img-fluid img-thumbnail" alt="Pickup Image">
                                                                                    </a>
                                                                                       <form class="mt-2" action="<?php echo base_url() ?>Insert_con/deleteCarPickupImage" method="post" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                                                                        <input type="hidden" name="id" value="<?php echo $sp['id'] ?>">
                                                                                        <input type="hidden" name="bookingId" value="<?php echo $order_id ?>">
                                                                                        <button class="btn btn-danger" type="submit">Delete</button>
                                                                                    </form>
                                                                                </div>
                                                                            <?php } ?>
                                                                        </div>

                                                                     
                                                                        <div class="row mb-4">
                                                                            <div class="col-12">
                                                                                <h5>Driver 2 - Drop Images</h5>
                                                                            </div>
                                                                            <?php foreach ($getSecondDrop as $sd) { ?>
                                                                                <div class="col-sm-6 col-md-4 col-lg-3 text-center mb-3">
                                                                                    <a href="<?php echo base_url('images/vehicle_image/' . $sd['image']) ?>" target="_blank">
                                                                                        <img src="<?php echo base_url('images/vehicle_image/' . $sd['image']) ?>" class="img-fluid img-thumbnail" alt="Drop Image">
                                                                                    </a>
                                                                                    <form class="mt-2" action="<?php echo base_url() ?>Insert_con/deleteCarDropImage" method="post" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                                                                        <input type="hidden" name="id" value="<?php echo $sd['id'] ?>">
                                                                                        <input type="hidden" name="bookingId" value="<?php echo $order_id ?>">
                                                                                        <button class="btn btn-danger" type="submit">Delete</button>
                                                                                    </form>
                                                                                </div>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </td>
                                                <td><?php echo $car['carQuality'] ?></td>
                                                <td><?php echo $car['carCondition'] ?></td>
                                                <td>
                                                    <form action="<?php echo base_url(); ?>Insert_con/updateBookingTrailor" method="POST">
                                                        <input type="hidden" name="bookingId" value="<?php echo  $order_id ?>" />
                                                        <input type="hidden" name="carId" value="<?php echo $car['id'] ?>" />
                                                        <select name="assignDriverId" class="form-control">
                                                            <option value="">Select Driver</option>
                                                            <?php
                                                            $getDrivers = $this->Manage_product->getDrivers();
                                                            foreach ($getDrivers as $dr) {
                                                            ?>
                                                                <option <?php echo $car['assignDriverId'] == $dr['id'] ? 'selected' : '' ?> value="<?php echo $dr['id'] ?>"><?php echo $dr['firstName'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <button type="submit" class="btn btn-primary btn-sm">Assign</button>
                                                    </form>
                                                </td>
                                                <?php
                                                if ($getbookingData[0]['bookingType'] == 'TRAILER') {
                                                ?>
                                                    <td>
                                                        <form action="<?php echo base_url(); ?>Insert_con/updateBookingTrailorV2" method="POST">
                                                            <input type="hidden" name="bookingId" value="<?php echo  $order_id ?>" />
                                                            <input type="hidden" name="carId" value="<?php echo $car['id'] ?>" />
                                                            <select name="assignSecondDriverId" class="form-control">
                                                                <option value="">Select Driver</option>
                                                                <?php
                                                                $getDrivers = $this->Manage_product->getDrivers();
                                                                foreach ($getDrivers as $dr) {
                                                                ?>
                                                                    <option <?php echo $car['assignSecondDriverId'] == $dr['id'] ? 'selected' : '' ?> value="<?php echo $dr['id'] ?>"><?php echo $dr['firstName'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <button type="submit" class="btn btn-primary btn-sm">Assign</button>
                                                        </form>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>



                            </div>

                        </div>

                        <div class="main-card mb-3 col-lg-12 card">



                            <div class="card-body">







                                <legend class="col-form-label col-sm-12">Tracking Information</legend>



                                <form class="trackform form" method="post" action="<?php echo base_url(); ?>Insert_con/insertBookingTracking">
                                    <input type="hidden" name="bookingId" value="<?php echo $order_id ?>">
                                    <div class="form-group col-lg-8 pull-left">
                                        <label>Tracking Comment</label>
                                        <!-- <input class="form-control" placeholder=""> -->
                                        <textarea class="form-control" name="comment" rows="5"></textarea>
                                    </div>
                                    <div class="form-group col-lg-12 pull-left">
                                        <button type="submit" class="btn btn-sm btn-primary">Add</button>
                                    </div>
                                </form>
                                <br>
                                <br>
                                <table class="table">
                                    <tr>
                                        <th>Tracking Comment</th>
                                        <th>Date & Time</th>
                                    </tr>
                                    <?php
                                    foreach ($getTracking as $track) {
                                    ?>
                                        <tr>
                                            <td><?php echo $track['comment'] ?></td>
                                            <td><?php echo $track['date_time'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>

                    </div>



                </div>


                <br>
                <br>
                <br>
                <br>
                <?php include 'inc/footer.php'; ?>