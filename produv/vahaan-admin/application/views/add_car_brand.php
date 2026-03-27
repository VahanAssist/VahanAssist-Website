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
                    <div> Add Car Brand
                        <div class="page-title-subheading">Add New Car Brand
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="main-card mb-3 col-lg-8 card">
                <div class="card-body">
                    <form method="post" action="<?php echo base_url(); ?>Insert_con/insertCarBrand" enctype="multipart/form-data">
                        <input name="id" id="id" type="hidden" value="<?php echo $getCarModel[0]['id'] ?>">
                        <legend class="col-form-label col-sm-12">Basic Information</legend>

                        <div class="position-relative row form-group">
                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input name="name" id="name" placeholder="" type="text" class="form-control" value="<?php echo $getCarModel[0]['name']; ?>">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="name" class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-9">
                                <select name="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    <?php
                                    $getCat = $this->Manage_product->getCategory('');
                                    foreach ($getCat as $cat) {
                                    ?>
                                        <option <?php echo $getCarModel[0]['category_id'] == $cat['id'] ? 'selected' : '' ?> value="<?php echo $cat['id'] ?>"><?php echo $cat['name'] ?></option>
                                    <?php } ?>
                                </select>
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