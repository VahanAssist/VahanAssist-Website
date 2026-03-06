<?php include 'inc/header.php';
$id = $this->uri->segment(3);
if ($id != "") {
    $getServices = $this->Manage_product->getServicesById($id);
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
                    <div> Add Services
                        <div class="page-title-subheading">Add New Services
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="main-card mb-3 col-lg-8 card">
                <div class="card-body">
                    <form method="post" action="<?php echo base_url(); ?>Insert_con/insertServices" enctype="multipart/form-data">
                        <input name="id" id="id" type="hidden" value="<?php echo $getServices[0]['id'] ?>">
                        <legend class="col-form-label col-sm-12">Basic Information</legend>
                        <div class="position-relative row form-group">
                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input name="name" id="name" placeholder="enter name" type="text" class="form-control" value="<?php echo $getServices[0]['name'] ?>">
                            </div>
                            </div>
                        <div class="position-relative row form-group">
                            <label for="image" class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input name="image" id="image" placeholder="" type="file" class="form-control" >
                                <input name="image_old" id="image_old" placeholder="" type="hidden" class="form-control" value="<?php echo $getServices[0]['image']; ?>">
                                <?php if ($getServices[0]['image']!="") {
                                    ?>
                                    <img src="<?php echo base_url(); ?>images/banner_image/<?php echo $getServices[0]['image']; ?>" width="200">
                               <?php } ?>

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