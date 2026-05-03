    <?php

    include 'inc/header.php';

    $order_id = $this->uri->segment(3);
    // $space = trim($order_id);
    $getbookingData = $this->Manage_product->getBookingById($order_id);
    $getCarDeatail = $this->Manage_product->getCarDetailsByBooking($order_id);
    
    $getUser = [];
    if (!empty($getbookingData)) {
        $getUser = $this->Manage_product->getUserById($getbookingData[0]['userId']);
    }
    
    $getTracking = $this->Manage_product->getTrackingByBooking($order_id);
    $getPaymentByBookingId = $this->Manage_product->getPaymentByBookingId($order_id);

    // Initialize arrays to prevent "Argument #1 must be of type Countable|array, null given"
    $getFirstDriver = [];
    $getFirstPickup = [];
    $getFirstDrop = [];
    $getSecondDriver = [];
    $getSecondPickup = [];
    $getSecondDrop = [];

    if (!empty($getCarDeatail) && isset($getCarDeatail[0])) {
        if (!empty($getCarDeatail[0]['assignDriverId'])) {
            $getFirstDriver = $this->Manage_product->getUserById($getCarDeatail[0]['assignDriverId']);
        }
        if (!empty($getCarDeatail[0]['assignSecondDriverId'])) {
            $getSecondDriver = $this->Manage_product->getUserById($getCarDeatail[0]['assignSecondDriverId']);
        }
    }
    
    // Fetch categorized images directly by booking ID instead of relying on legacy separate tables
    $pickupImages = $this->Manage_product->getCarImagesByBookingAndType($order_id, 'pickup');
    $handoverImages = $this->Manage_product->getCarImagesByBookingAndType($order_id, 'handover');
    $loadingImages = $this->Manage_product->getCarImagesByBookingAndType($order_id, 'loading');
    $dropImages = $this->Manage_product->getCarImagesByBookingAndType($order_id, 'drop');

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
                                                    <?php if(!empty($car['doc'])): ?>
                                                        <a href="<?php echo base_url('images/booking_image/' . $car['doc']) ?>" target="_blank" class="btn btn-primary btn-sm">View Document</a>
                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?>

                                                    <!-- Upload / View Images Button -->
                                                    <button type="button" class="btn btn-info btn-sm mt-1" data-toggle="modal" data-target="#carImagesModal<?php echo $car['id'] ?>">
                                                        <i class="pe-7s-photo"></i> View / Upload Images
                                                    </button>

                                                    <!-- Car Images Modal -->
                                                    <div class="modal fade" id="carImagesModal<?php echo $car['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="carModelLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="carModelLabel">Car Images - <?php echo $car['model'] ?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Upload Form with Type -->
                                                                    <form action="<?php echo base_url() ?>Insert_con/insertCarPickupDropImages" method="post" enctype="multipart/form-data">
                                                                        <input type="hidden" name="carId" value="<?php echo $car['id'] ?>">
                                                                        <input type="hidden" name="bookingId" value="<?php echo $order_id ?>">
                                                                        <input type="hidden" name="driverId" value="<?php echo !empty($car['assignDriverId']) ? $car['assignDriverId'] : '' ?>">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label class="fw-bold">Image Type</label>
                                                                                    <select name="type" class="form-control">
                                                                                        <option value="pickup">Pickup Inspection</option>
                                                                                        <option value="handover">Trailer Handover</option>
                                                                                        <option value="loading">Car Loading</option>
                                                                                        <option value="drop">Delivery</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-5">
                                                                                <div class="form-group">
                                                                                    <label class="fw-bold">Select Images</label>
                                                                                    <input type="file" name="image[]" class="form-control" multiple="multiple" accept="image/*" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 d-flex align-items-end">
                                                                                <button type="submit" class="btn btn-primary btn-block mb-3">Upload</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                    <hr>
                                                                    <!-- Removed legacy image viewer from inside modal -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                                        <!-- Unified Image Gallery (Categorized) -->
                                                                        
                                                                        <!-- Pickup Inspection -->
                                                                        <div class="row mb-4">
                                                                            <div class="col-12"><h5 class="text-primary border-bottom pb-2"><i class="pe-7s-camera"></i> Pickup Inspection Images</h5></div>
                                                                            <?php if(count($pickupImages) > 0) { foreach ($pickupImages as $img) { ?>
                                                                                <div class="col-sm-6 col-md-4 col-lg-3 text-center mb-3">
                                                                                    <a href="<?php echo base_url('images/vehicle_image/' . $img['image']) ?>" target="_blank">
                                                                                        <img src="<?php echo base_url('images/vehicle_image/' . $img['image']) ?>" class="img-fluid img-thumbnail" style="max-height:150px;">
                                                                                    </a>
                                                                                    <form class="mt-2" action="<?php echo base_url() ?>Insert_con/deleteCarPickupImage" method="post" onsubmit="return confirm('Delete this image?');">
                                                                                        <input type="hidden" name="id" value="<?php echo $img['id'] ?>">
                                                                                        <input type="hidden" name="bookingId" value="<?php echo $order_id ?>">
                                                                                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                                                                    </form>
                                                                                </div>
                                                                            <?php } } else { ?>
                                                                                <div class="col-12 text-muted"><em>No pickup images uploaded.</em></div>
                                                                            <?php } ?>
                                                                        </div>

                                                                        <!-- Trailer Handover -->
                                                                        <div class="row mb-4">
                                                                            <div class="col-12"><h5 class="text-info border-bottom pb-2"><i class="pe-7s-shuffle"></i> Trailer Handover Images</h5></div>
                                                                            <?php if(count($handoverImages) > 0) { foreach ($handoverImages as $img) { ?>
                                                                                <div class="col-sm-6 col-md-4 col-lg-3 text-center mb-3">
                                                                                    <a href="<?php echo base_url('images/vehicle_image/' . $img['image']) ?>" target="_blank">
                                                                                        <img src="<?php echo base_url('images/vehicle_image/' . $img['image']) ?>" class="img-fluid img-thumbnail" style="max-height:150px;">
                                                                                    </a>
                                                                                    <form class="mt-2" action="<?php echo base_url() ?>Insert_con/deleteCarPickupImage" method="post" onsubmit="return confirm('Delete this image?');">
                                                                                        <input type="hidden" name="id" value="<?php echo $img['id'] ?>">
                                                                                        <input type="hidden" name="bookingId" value="<?php echo $order_id ?>">
                                                                                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                                                                    </form>
                                                                                </div>
                                                                            <?php } } else { ?>
                                                                                <div class="col-12 text-muted"><em>No trailer handover images uploaded.</em></div>
                                                                            <?php } ?>
                                                                        </div>

                                                                        <!-- Car Loading -->
                                                                        <div class="row mb-4">
                                                                            <div class="col-12"><h5 class="text-warning border-bottom pb-2"><i class="pe-7s-angle-up-circle"></i> Car Loading Images</h5></div>
                                                                            <?php if(count($loadingImages) > 0) { foreach ($loadingImages as $img) { ?>
                                                                                <div class="col-sm-6 col-md-4 col-lg-3 text-center mb-3">
                                                                                    <a href="<?php echo base_url('images/vehicle_image/' . $img['image']) ?>" target="_blank">
                                                                                        <img src="<?php echo base_url('images/vehicle_image/' . $img['image']) ?>" class="img-fluid img-thumbnail" style="max-height:150px;">
                                                                                    </a>
                                                                                    <form class="mt-2" action="<?php echo base_url() ?>Insert_con/deleteCarPickupImage" method="post" onsubmit="return confirm('Delete this image?');">
                                                                                        <input type="hidden" name="id" value="<?php echo $img['id'] ?>">
                                                                                        <input type="hidden" name="bookingId" value="<?php echo $order_id ?>">
                                                                                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                                                                    </form>
                                                                                </div>
                                                                            <?php } } else { ?>
                                                                                <div class="col-12 text-muted"><em>No car loading images uploaded.</em></div>
                                                                            <?php } ?>
                                                                        </div>

                                                                        <!-- Delivery -->
                                                                        <div class="row mb-4">
                                                                            <div class="col-12"><h5 class="text-success border-bottom pb-2"><i class="pe-7s-check"></i> Delivery Images</h5></div>
                                                                            <?php if(count($dropImages) > 0) { foreach ($dropImages as $img) { ?>
                                                                                <div class="col-sm-6 col-md-4 col-lg-3 text-center mb-3">
                                                                                    <a href="<?php echo base_url('images/vehicle_image/' . $img['image']) ?>" target="_blank">
                                                                                        <img src="<?php echo base_url('images/vehicle_image/' . $img['image']) ?>" class="img-fluid img-thumbnail" style="max-height:150px;">
                                                                                    </a>
                                                                                    <form class="mt-2" action="<?php echo base_url() ?>Insert_con/deleteCarPickupImage" method="post" onsubmit="return confirm('Delete this image?');">
                                                                                        <input type="hidden" name="id" value="<?php echo $img['id'] ?>">
                                                                                        <input type="hidden" name="bookingId" value="<?php echo $order_id ?>">
                                                                                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                                                                    </form>
                                                                                </div>
                                                                            <?php } } else { ?>
                                                                                <div class="col-12 text-muted"><em>No delivery images uploaded.</em></div>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?php echo $car['carQuality'] ?></td>
                                                <td><?php echo $car['carCondition'] ?></td>
                                                <td>
                                                    <form class="assign-driver-form" action="javascript:void(0);" method="POST" onsubmit="submitAssignDriverForm(this, 'updateBookingTrailorAjax')">
                                                        <input type="hidden" name="bookingId" value="<?php echo  $order_id ?>" />
                                                        <input type="hidden" name="carId" value="<?php echo $car['id'] ?>" />
                                                        <select name="assignDriverId" class="form-control mb-2">
                                                            <option value="">Select Driver</option>
                                                            <?php
                                                            $getDrivers = $this->Manage_product->getDrivers();
                                                            foreach ($getDrivers as $dr) {
                                                            ?>
                                                                <option <?php echo $car['assignDriverId'] == $dr['id'] ? 'selected' : '' ?> value="<?php echo $dr['id'] ?>"><?php echo $dr['firstName'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <button type="submit" class="btn btn-primary btn-sm btn-block">Assign</button>
                                                    </form>
                                                </td>
                                                <?php
                                                if ($getbookingData[0]['bookingType'] == 'TRAILER') {
                                                ?>
                                                    <td>
                                                        <form class="assign-driver-form-v2" action="javascript:void(0);" method="POST" onsubmit="submitAssignDriverForm(this, 'updateBookingTrailorV2Ajax')">
                                                            <input type="hidden" name="bookingId" value="<?php echo  $order_id ?>" />
                                                            <input type="hidden" name="carId" value="<?php echo $car['id'] ?>" />
                                                            <select name="assignSecondDriverId" class="form-control mb-2">
                                                                <option value="">Select Driver</option>
                                                                <?php
                                                                $getDrivers = $this->Manage_product->getDrivers();
                                                                foreach ($getDrivers as $dr) {
                                                                ?>
                                                                    <option <?php echo $car['assignSecondDriverId'] == $dr['id'] ? 'selected' : '' ?> value="<?php echo $dr['id'] ?>"><?php echo $dr['firstName'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <button type="submit" class="btn btn-primary btn-sm btn-block">Assign</button>
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







                                <?php
                                $tracking_success = $this->session->userdata('tracking_success');
                                if ($tracking_success) {
                                    $this->session->unset_userdata('tracking_success');
                                    echo '<div class="alert alert-success" id="trackingSuccessAlert">' . $tracking_success . '</div>';
                                    echo '<script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var el = document.getElementById("trackingSuccessAlert");
                                            if (el) {
                                                el.scrollIntoView({ behavior: "smooth", block: "center" });
                                                setTimeout(function() {
                                                    el.style.transition = "opacity 0.5s";
                                                    el.style.opacity = "0";
                                                    setTimeout(function() { el.remove(); }, 500);
                                                }, 5000);
                                            }
                                        });
                                    </script>';
                                }
                                
                                $tracking_error = $this->session->userdata('tracking_error');
                                if ($tracking_error) {
                                    $this->session->unset_userdata('tracking_error');
                                    echo '<div class="alert alert-danger" id="trackingErrorAlert">' . $tracking_error . '</div>';
                                    echo '<script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var el = document.getElementById("trackingErrorAlert");
                                            if (el) {
                                                el.scrollIntoView({ behavior: "smooth", block: "center" });
                                                setTimeout(function() {
                                                    el.style.transition = "opacity 0.5s";
                                                    el.style.opacity = "0";
                                                    setTimeout(function() { el.remove(); }, 500);
                                                }, 5000);
                                            }
                                        });
                                    </script>';
                                }
                                ?>
                                <legend class="col-form-label col-sm-12 fw-bold text-primary border-bottom pb-2 mb-3"><i class="pe-7s-map-marker"></i> Transport Tracking</legend>
                                
                                <form class="trackform form" id="trackingForm" method="post" action="<?php echo base_url(); ?>Insert_con/insertBookingTracking">
                                    <input type="hidden" name="bookingId" value="<?php echo $order_id ?>">
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="trackingComment" name="comment" rows="3" placeholder="Enter tracking Details..."></textarea>
                                            <small id="wordCountDisplay" class="form-text text-muted">0 / 200 words</small>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-primary btn-block">Add Tracking</button>
                                        </div>
                                    </div>
                                </form>

                                <hr>

                                <!-- Transit Status Quick Buttons -->
                                <h5 class="mb-3"><i class="pe-7s-car"></i> Transit Status</h5>
                                <div class="mb-3">
                                    <div class="d-flex flex-wrap gap-2 mb-3">
                                        <form method="post" action="<?php echo base_url(); ?>Insert_con/insertTransitStatus" style="display:inline;">
                                            <input type="hidden" name="bookingId" value="<?php echo $order_id ?>">
                                            <input type="hidden" name="status_label" value="Loaded at Origin">
                                            <button type="submit" class="btn btn-sm btn-outline-success"><i class="pe-7s-upload"></i> Loaded at Origin</button>
                                        </form>
                                        <form method="post" action="<?php echo base_url(); ?>Insert_con/insertTransitStatus" style="display:inline;">
                                            <input type="hidden" name="bookingId" value="<?php echo $order_id ?>">
                                            <input type="hidden" name="status_label" value="Unloaded at Destination">
                                            <button type="submit" class="btn btn-sm btn-outline-warning"><i class="pe-7s-download"></i> Unloaded at Destination</button>
                                        </form>
                                    </div>
                                    <form method="post" action="<?php echo base_url(); ?>Insert_con/insertTransitStatus" class="form-inline">
                                        <input type="hidden" name="bookingId" value="<?php echo $order_id ?>">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <input type="text" name="status_label" class="form-control mb-2" placeholder="e.g. Agra Crossed, Indore, Car Unloaded" required>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" name="comment" class="form-control mb-2" placeholder="Optional comment...">
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit" class="btn btn-info btn-block mb-2">Add Status</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <?php
                                $getTransitStatus = $this->Manage_product->getTransitStatusByBooking($order_id);
                                ?>
                                <?php if (count($getTransitStatus) > 0) { ?>
                                <div class="table-responsive mb-3">
                                    <table class="table table-sm table-bordered">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>Status</th>
                                                <th>Comment</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($getTransitStatus as $ts) { ?>
                                                <tr>
                                                    <td><?php echo date('d M Y, h:i A', strtotime($ts['date_time'])); ?></td>
                                                    <td><span class="badge badge-info"><?php echo $ts['status_label']; ?></span></td>
                                                    <td><?php echo $ts['comment']; ?></td>
                                                    <td>
                                                        <form method="post" action="<?php echo base_url(); ?>Insert_con/deleteTransitStatus" onsubmit="return confirm('Delete this status?');" style="display:inline;">
                                                            <input type="hidden" name="id" value="<?php echo $ts['id']; ?>">
                                                            <input type="hidden" name="bookingId" value="<?php echo $order_id; ?>">
                                                            <button class="btn btn-danger btn-sm" type="submit"><i class="pe-7s-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php } ?>

                                <hr>

                                <h5 class="mb-3">Tracking History</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Date Time</th>
                                                <th>Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (count($getTracking) > 0) {
                                                foreach ($getTracking as $track) { ?>
                                                    <tr>
                                                        <td><?php echo date('d M Y, h:i A', strtotime($track['date_time'])); ?></td>
                                                        <td><?php echo $track['comment']; ?></td>
                                                    </tr>
                                            <?php }
                                            } else {
                                                echo '<tr><td colspan="2" class="text-center">No tracking history found</td></tr>';
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>


                <br>
                <br>
                <br>
                <br>
                <?php include 'inc/footer.php'; ?>
                
<script>
function submitAssignDriverForm(form, ajaxFunc) {
    const data = $(form).serialize();
    const btn = $(form).find('button[type="submit"]');
    const originalText = btn.text();
    btn.text('Assigning...').prop('disabled', true);

    // Open entirely blank window synchronously right now to bypass browser popup blockers
    const whatsappWindow = window.open('about:blank', '_blank');

    $.ajax({
        url: '<?php echo base_url(); ?>Insert_con/' + ajaxFunc,
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function(response) {
            btn.text(originalText).prop('disabled', false);
            if(response.status === 'success') {
                btn.removeClass('btn-primary').addClass('btn-success').text('Assigned!');
                setTimeout(() => { btn.removeClass('btn-success').addClass('btn-primary').text('Assign'); }, 2000);
                
                // Now navigate the un-blocked window to WhatsApp!
                if (response.whatsapp_url) {
                    whatsappWindow.location.href = response.whatsapp_url;
                } else {
                    whatsappWindow.close();
                }
            } else {
                whatsappWindow.close();
                alert("Failed: " + response.msg);
            }
        },
        error: function() {
            btn.text(originalText).prop('disabled', false);
            whatsappWindow.close();
            alert("Network error updating driver.");
        }
    });
}
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const commentBox = document.getElementById('trackingComment');
    const wordCountDisplay = document.getElementById('wordCountDisplay');
    const maxWords = 200;
    const trackingForm = document.getElementById('trackingForm');

    if(commentBox && wordCountDisplay) {
        function countWords(str) {
            return str.trim().split(/\s+/).filter(word => word.length > 0).length;
        }

        commentBox.addEventListener('input', function() {
            let words = countWords(this.value);
            wordCountDisplay.textContent = words + ' / ' + maxWords + ' words';
            if (words > maxWords) {
                wordCountDisplay.style.color = 'red';
            } else {
                wordCountDisplay.style.color = '';
            }
        });
        
        if(trackingForm) {
            trackingForm.addEventListener('submit', function(e) {
                if(countWords(commentBox.value) > maxWords) {
                    e.preventDefault();

                    // Hide PHP alerts if they exist on the page
                    const successAlert = document.getElementById('trackingSuccessAlert');
                    if(successAlert) successAlert.style.display = 'none';
                    const errorAlert = document.getElementById('trackingErrorAlert');
                    if(errorAlert) errorAlert.style.display = 'none';

                    const errDiv = document.getElementById('jsTrackingError');
                    if(errDiv) {
                        errDiv.textContent = "Tracking Comment cannot exceed 200 words.";
                        errDiv.style.display = 'block';
                        errDiv.style.opacity = '1';
                        errDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        setTimeout(function() {
                            errDiv.style.transition = 'opacity 0.5s';
                            errDiv.style.opacity = '0';
                            setTimeout(function() { errDiv.style.display = 'none'; }, 500);
                        }, 5000);
                    } else {
                        alert("Tracking Comment cannot exceed 200 words.");
                    }
                }
            });
        }
    }
});
</script>