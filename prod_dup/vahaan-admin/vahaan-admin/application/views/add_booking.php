<?php include 'inc/header.php';
$id = $this->uri->segment(3);
if ($id != "") {
    $getBooking = $this->Manage_product->getBookingById($id);
}
?>
<style type="text/css">
    legend {
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
                        All Bookings
                        <div class="page-title-subheading">
                            <a href="<?php echo base_url(); ?>Main_con/view_booking">Bookings</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="main-card mb-3 col-lg-8 card">
                <div class="card-body">
                    <form method="post" action="<?php echo base_url(); ?>Insert_con/insertBooking" enctype="multipart/form-data">
                    <input name="action" id="action" type="hidden" value="Admin">
                        <input name="id" id="id" type="hidden" value="<?php echo $getBooking[0]['id'] ?>">
                        <input name="status" id="status" type="hidden" value="BOOKED">
                        <input name="bookingType" id="bookingType" type="hidden" value="DRIVER">
                        <div class="position-relative row form-group">
                            <label class="col-sm-3 col-form-label">User</label>
                            <div class="col-sm-9">
                                <!-- <input name="userId" type="text" class="form-control" value="<?php echo $getBooking[0]['userId']; ?>"> -->
                                <select name="userId" required="required" class="form-control">
                                    <option value="">Select User</option>
                                    <?php
                                    $getUsers = $this->Manage_product->getUser('');
                                    foreach ($getUsers as $usr) {
                                    ?>
                                        <option <?php echo $getBooking[0]['userId'] == $usr['id'] ? 'selected' : '' ?> value="<?php echo $usr['id'] ?>"><?php echo $usr['firstName'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label class="col-sm-3 col-form-label">Vehicle</label>
                            <div class="col-sm-9">
                                <!-- <input name="vehicleId" type="text" class="form-control" value="<?php echo $getBooking[0]['vehicleId']; ?>"> -->
                                <select name="vehicleId" required="required" class="form-control">
                                    <option value="">Select Vehicle</option>
                                    <?php
                                    $getVehicles = $this->Manage_product->getVehicle();
                                    foreach ($getVehicles as $vh) {
                                    ?>
                                        <option <?php echo $getBooking[0]['vehicleId'] == $vh['id'] ? 'selected' : '' ?> value="<?php echo $vh['id'] ?>"><?php echo $vh['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label class="col-sm-3 col-form-label">Pickup</label>
                            <div class="col-sm-9">
                                <input name="pickup" type="text" class="form-control" value="<?php echo $getBooking[0]['pickup']; ?>">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label class="col-sm-3 col-form-label">Drop</label>
                            <div class="col-sm-9">
                                <input name="drop" type="text" class="form-control" value="<?php echo $getBooking[0]['drop']; ?>">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label class="col-sm-3 col-form-label">Date</label>
                            <div class="col-sm-9">
                                <input name="date" type="date" class="form-control" value="<?php echo $getBooking[0]['date']; ?>">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label class="col-sm-3 col-form-label">Time</label>
                            <div class="col-sm-9">
                                <input name="time" type="time" class="form-control" value="<?php echo $getBooking[0]['time']; ?>">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label class="col-sm-3 col-form-label">Comments</label>
                            <div class="col-sm-9">
                                <input name="comments" type="text" class="form-control" value="<?php echo $getBooking[0]['comments']; ?>">
                            </div>
                        </div>
                        <?php
                        $cd = $this->Manage_product->getCarDetailsByBooking($getBooking[0]['id']);

                        if (count($cd) > 0) {

                        ?>
                            <div class="position-relative row form-group">
                                <label class="col-sm-3 col-form-label">Car details</label>
                                <div class="col-sm-9">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Model</th>
                                                <th>Car type</th>
                                                <!-- <th>Car Doc</th> -->
                                                <th>Car quality</th>
                                                <th>Car condition</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($cd as $data) {
                                            ?>
                                                <tr>
                                                    <input type="hidden" name="carId[]" value="<?php echo $data['id']; ?>">
                                                    <td>
                                                        <input type="text" name="model[]" value="<?php echo $data['model'] ?>" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="carType[]" value="<?php echo $data['carType'] ?>" class="form-control">

                                                    </td>
                                                    <td>
                                                        <!-- <input type="text" name="carQuality[]" value="<?php echo $data['carQuality'] ?>" class="form-control"> -->
                                                        <select name="carQuality[]" id="" class="form-control">
                                                            <option <?php echo $data['carQuality'] == 'Used Car' ? 'selected' :  '' ?> value="Used Car">Used Car</option>
                                                            <option <?php echo $data['carQuality'] == 'New Car' ? 'selected' :  '' ?> value="New Car">New Car</option>
                                                        </select>

                                                    </td>
                                                    <td>
                                                        <!-- <input type="text" name="carCondition[]" value="<?php echo $data['carCondition'] ?>" class="form-control"> -->
                                                        <select name="carCondition[]" id="" class="form-control">
                                                            <option <?php echo $data['carCondition'] == 'Running' ? 'selected' :  '' ?> value="Running">Running</option>
                                                            <option <?php echo $data['carCondition'] == 'Non Running' ? 'selected' :  '' ?> value="Non Running">Non Running</option>
                                                            <option <?php echo $data['carCondition'] == 'Scrap' ? 'selected' :  '' ?> value="Scrap">Scrap</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            <?php
                                            } ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        <?php } ?>

                        <div class="position-relative row form-check">
                            <div class="col-sm-10 offset-sm-2">
                                <input type="submit" class="btn btn-secondary" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <?php include 'inc/footer.php'; ?>