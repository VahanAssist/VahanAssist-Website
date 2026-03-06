<?php include 'inc/header.php';
$id = $this->uri->segment(3);
if ($id != "") {
    $getState = $this->Manage_product->getStateById($id);
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
                    <div> Add State
                        <div class="page-title-subheading">Add New State
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="main-card mb-3 col-lg-8 card">
                <div class="card-body">
                    <form method="post" action="<?php echo base_url(); ?>Insert_con/insertState">
                        <input name="id" id="id" type="hidden" value="<?php echo $getState[0]['id'] ?>">

                        <legend class="col-form-label col-sm-12">Basic Information</legend>
                        <div class="position-relative row form-group">
                            <label for="state" class="col-sm-3 col-form-label"> State Name </label>
                            <div class="col-sm-9">
                                <input name="state" id="state" placeholder="" type="text" class="form-control" value="<?php echo $getState[0]['state']; ?>">
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