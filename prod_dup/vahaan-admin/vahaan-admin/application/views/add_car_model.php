<?php include 'inc/header.php';
$id = $this->uri->segment(3);
if ($id != "") {
    $getCarModel = $this->Manage_product->getCarModelById($id);
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
                    <div> Add Car Model
                        <div class="page-title-subheading">Add New Car Model
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="main-card mb-3 col-lg-8 card">
                <div class="card-body">
                    <form method="post" action="<?php echo base_url(); ?>Insert_con/insertCarModel" enctype="multipart/form-data">
                        <input name="id" id="id" type="hidden" value="<?php echo $getCarModel[0]['id'] ?>">
                        <legend class="col-form-label col-sm-12">Basic Information</legend>

                        <div class="position-relative row form-group">
                            <label for="name" class="col-sm-3 col-form-label">Brand</label>
                            <div class="col-sm-9">
                                <!-- <input name="name" id="name" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['name']; ?>"> -->
                                <select name="brand_id" class="form-control">
                                    <option value="">Select Brand</option>
                                    <?php 
                                    $getBrand = $this->Manage_product->getCarBrand();
                                    foreach ($getBrand as $brand){
                                    ?>
                                    <option <?php echo $getCarModel[0]['brand_id'] == $brand['id'] ? 'selected' : '' ?> value="<?php echo $brand['id'] ?>"><?php echo $brand['name'] ?></option>
                                    <?php }?>
                                </select>
                            </div>
                            </div>

                        <div class="position-relative row form-group">
                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input name="name" id="name" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['name']; ?>">
                            </div>
                            </div>
                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">Displacement</label>
                                <div class="col-sm-9">
                                    <input name="displacement" id="displacement" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['displacement']; ?>">
                                </div>
                                </div>
                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">emission_norm</label>
                                <div class="col-sm-9">
                                    <input name="emission_norm" id="emission_norm" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['emission_norm']; ?>">
                                </div>
                                </div>
                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">fuel_tank_capacity</label>
                                <div class="col-sm-9">
                                    <input name="fuel_tank_capacity" id="fuel_tank_capacity" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['fuel_tank_capacity']; ?>">
                                </div>
                                </div>
                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">fuel_type</label>
                                <div class="col-sm-9">
                                    <input name="fuel_type" id="fuel_type" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['fuel_type']; ?>">
                                </div>
                                </div>

                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">height</label>
                                <div class="col-sm-9">
                                    <input name="height" id="height" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['height']; ?>">
                                </div>
                                </div>
                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">length</label>
                                <div class="col-sm-9">
                                    <input name="length" id="length" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['length']; ?>">
                                </div>
                                </div>
                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">width</label>
                                <div class="col-sm-9">
                                    <input name="width" id="width" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['width']; ?>">
                                </div>
                                </div>
                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">body_type</label>
                                <div class="col-sm-9">
                                    <input name="body_type" id="body_type" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['body_type']; ?>">
                                </div>
                                </div>
                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">kerb_weight</label>
                                <div class="col-sm-9">
                                    <input name="kerb_weight" id="kerb_weight" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['kerb_weight']; ?>">
                                </div>
                                </div>
                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">gears</label>
                                <div class="col-sm-9">
                                    <input name="gears" id="gears" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['gears']; ?>">
                                </div>
                                </div>
                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">ground_clearance</label>
                                <div class="col-sm-9">
                                    <input name="ground_clearance" id="ground_clearance" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['ground_clearance']; ?>">
                                </div>
                                </div>
                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">front_brakes</label>
                                <div class="col-sm-9">
                                    <input name="front_brakes" id="front_brakes" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['front_brakes']; ?>">
                                </div>
                                </div>
                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">rear_brakes</label>
                                <div class="col-sm-9">
                                    <input name="rear_brakes" id="rear_brakes" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['rear_brakes']; ?>">
                                </div>
                                </div>
                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">power_windows</label>
                                <div class="col-sm-9">
                                    <input name="power_windows" id="power_windows" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['power_windows']; ?>">
                                </div>
                                </div>
                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">power_seats</label>
                                <div class="col-sm-9">
                                    <input name="power_seats" id="power_seats" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['power_seats']; ?>">
                                </div>
                                </div>

                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">power</label>
                                <div class="col-sm-9">
                                    <input name="power" id="power" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['power']; ?>">
                                </div>
                                </div>

                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">torque</label>
                                <div class="col-sm-9">
                                    <input name="torque" id="torque" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['torque']; ?>">
                                </div>
                                </div>

                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">odometer</label>
                                <div class="col-sm-9">
                                    <input name="odometer" id="odometer" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['odometer']; ?>">
                                </div>
                                </div>
                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">speedometer</label>
                                <div class="col-sm-9">
                                    <input name="speedometer" id="speedometer" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['speedometer']; ?>">
                                </div>
                                </div>
                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">seating_capacity</label>
                                <div class="col-sm-9">
                                    <input name="seating_capacity" id="seating_capacity" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['seating_capacity']; ?>">
                                </div>
                                </div>

                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">seats_material</label>
                                <div class="col-sm-9">
                                    <input name="seats_material" id="seats_material" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['seats_material']; ?>">
                                </div>
                                </div>

                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">transmission</label>
                                <div class="col-sm-9">
                                    <input name="transmission" id="transmission" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['transmission']; ?>">
                                </div>
                                </div>
                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">central_locking</label>
                                <div class="col-sm-9">
                                    <input name="central_locking" id="central_locking" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['central_locking']; ?>">
                                </div>
                                </div>

                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">child_safety_locks</label>
                                <div class="col-sm-9">
                                    <input name="child_safety_locks" id="child_safety_locks" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['child_safety_locks']; ?>">
                                </div>
                                </div>


                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">abs</label>
                                <div class="col-sm-9">
                                    <input name="abs" id="abs" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['abs']; ?>">
                                </div>
                                </div>

                            <!-- end -->
                             <div class="position-relative row form-group">
                                <label for="name" class="col-sm-3 col-form-label">ventilation_system</label>
                                <div class="col-sm-9">
                                    <input name="ventilation_system" id="ventilation_system" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['ventilation_system']; ?>">
                                </div>
                                </div>




                      
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