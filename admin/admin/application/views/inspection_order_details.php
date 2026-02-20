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



                        <div> Inspection Order Details



                            <div class="page-title-subheading"> Inspection Order Details



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



                                <legend class="col-form-label col-sm-12">Information</legend>
                                  <table class="table">
                                    <tr><th>Customer Name </th><td><?php echo $getUser[0]['firstName'] ?></td></tr>
                                    <tr><th>Email ID</th><td><?php echo $getUser[0]['email'] ?></td></tr>
                                    <tr><th>Phone No</th><td><?php echo $getUser[0]['phoneNumber'] ?></td></tr>


                                    <tr><th>Date & Time</th><td><?php echo $getbookingData[0]['date'] ?>, <?php echo $getbookingData[0]['time'] ?></td></tr>
                                  
                                    <tr><th>Booked On</th><td><?php echo $getbookingData[0]['created'] ?></td></tr>
                                      <tr><th>Comments</th><td><?php echo $getbookingData[0]['comments'] ?></td></tr>

                                </table>


<!-- 
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
 -->




                            </div>
                            <div class="col-lg-6 pull-left">

                                <legend class="col-form-label col-sm-12">Location Information</legend>


                                <div class="position-relative row form-group">



                                    <label for="name" class="col-sm-3 col-form-label">Location</label>

                                    <div class="col-sm-9">


                                        <!-- <label class="col-form-label">show pickup location</label> -->
                                        <p>Lat: <?php echo $getbookingData[0]['picklat'] ?></p>
                                        <p>Lng: <?php echo $getbookingData[0]['picklng'] ?></p>

                                        <a target="_blank" href="https://www.google.com/maps?q=<?php echo $getbookingData[0]['picklat'] ?>,<?php echo $getbookingData[0]['picklng'] ?>">View on Map </a>


                                    </div>

                                </div>

                               <!--   <div class="position-relative row form-group">



                                    <label for="name" class="col-sm-3 col-form-label">Report</label>

                                    <div class="col-sm-9">


                                         <a href="<?php echo base_url() ?>Main_con/inspectionreport/<?php echo $getbookingData[0]['id'] ?>" class="btn btn-info" target="_blank">
                                             View Report
                                         </a>



                                    </div>

                                </div> -->


<!-- 
                                <div class="position-relative row form-group">



                                    <label for="name" class="col-sm-3 col-form-label">Drop Location</label>



                                    <div class="col-sm-9">



                                      

                                        <p>Drop lat: <?php echo $getbookingData[0]['droplat'] ?></p>
                                        <p>Drop lng: <?php echo $getbookingData[0]['droplng'] ?></p>
                                        <a href="https://www.google.com/maps/@<?php echo $getbookingData[0]['droplat'] ?>,<?php echo $getbookingData[0]['droplng'] ?>">View on Map </a>

                                    </div>




                                </div> -->

                            
                            </div>
                        </form>


                        <div class="col-lg-12 text-center pull-left d-none" style="margin-top: 20px;">
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

                               
                                <table class="table">

                                    <tbody>
                                        <tr>

                                            <th>Car Model</th>

                                            <!-- <th>Car Type</th> -->
                                            <th>Car Images</th>

                                            <th>Car Quality</th>

                                            <th>Car Condition</th>

                                            <th>Report</th>

                                        

                                        </tr>
                                        <?php
                                        foreach ($getCarDeatail as $car) {
                                        ?>
                                            <tr>
                                                <td><?php echo $car['model'] ?></td>
                                                <!-- <td><?php echo $car['carType'] ?></td> -->
                                        
                                                <td><?php echo $car['carQuality'] ?></td>
                                                <td><?php echo $car['carCondition'] ?></td>
                                               
                                                
                                             
                                            </tr>
                                        <?php } ?>

                                    </tbody>
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