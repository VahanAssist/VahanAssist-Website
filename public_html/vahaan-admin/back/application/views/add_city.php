<?php include 'inc/header.php';
$id = $this->uri->segment(3);
if ($id != "") {
    $getCity = $this->Manage_product->getCityById($id);
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
                    <div> Add City
                        <div class="page-title-subheading">Add New City
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="main-card mb-3 col-lg-8 card">
                <div class="card-body">
                    <form method="post" action="<?php echo base_url(); ?>Insert_con/insertCity">
                        <input name="id" id="id" type="hidden" value="<?php echo $getCity[0]['id'] ?>">

                        <legend class="col-form-label col-sm-12">Basic Information</legend>
                        <div class="position-relative row form-group">
                            <label for="name" class="col-sm-3 col-form-label"> State </label>
                            <div class="col-sm-9">
                                <select class="form-control" name="state_id">
                                    <option value="">Select State</option>
                                    <?php 
                                    $getState = $this->Manage_product->getAllStates();
                                    foreach ($getState as $ct){
                                    ?>
                                    <option <?php echo $getCity[0]['state_id'] == $ct['id'] ? 'selected' : '' ?> value="<?php echo $ct['id'] ?>"><?php echo $ct['state'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="city" class="col-sm-3 col-form-label"> City Name </label>
                            <div class="col-sm-9">
                                <input name="city" id="city" placeholder="" type="text" class="form-control" value="<?php echo $getCity[0]['city']; ?>">
                            </div>
                        </div>
                        <div class="position-relative row form-check">
                            <div class="col-sm-10 offset-sm-2">
                                <!--  <input type="submit"  value="Submit" > -->
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