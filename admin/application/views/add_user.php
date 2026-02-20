<?php include 'inc/header.php';
$id = $this->uri->segment(3);
if ($id != "") {
    $getUser = $this->Manage_product->getUserById($id);
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
                    <div> Add Driver
                        <div class="page-title-subheading">Add New Driver
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="main-card mb-3 col-lg-8 card">
                <div class="card-body">
                    <form method="post" action="<?php echo base_url(); ?>Insert_con/register" enctype="multipart/form-data">
                    <input name="action" id="action" type="hidden" value="admin">
                        <input name="id" id="id" type="hidden" value="<?php echo $getUser[0]['id'] ?>">
                        <legend class="col-form-label col-sm-12">Basic Information</legend>
                        <div class="position-relative row form-group">
                            <label for="firstName" class="col-sm-3 col-form-label"> First Name </label>
                            <div class="col-sm-9">
                                <input name="firstName" id="firstName" placeholder="" type="text" class="form-control" value="<?php echo $getUser[0]['firstName']; ?>" required="required">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="lastName" class="col-sm-3 col-form-label"> last Name </label>
                            <div class="col-sm-9">
                                <input name="lastName" id="lastName" placeholder="" type="text" class="form-control" value="<?php echo $getUser[0]['lastName']; ?>">
                            </div>
                        </div>
                       
                        <div class="position-relative row form-group">
                            <label for="email" class="col-sm-3 col-form-label"> Email </label>
                            <div class="col-sm-9">
                                <input name="email" id="email" placeholder="" type="email" class="form-control" value="<?php echo $getUser[0]['email']; ?>" required="required"> 
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="password" class="col-sm-3 col-form-label"> Password </label>
                            <div class="col-sm-9">
                                <input name="password" id="password" placeholder="" type="password" class="form-control" value="" required="required">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="type" class="col-sm-3 col-form-label"> Type </label>
                            <div class="col-sm-9">
                                <select class="form-control" name="type" required="required">
                                    <option value="">Select type</option>
                                <!--     <option value="USER" <?php if ($getUser[0]['type'] == "USER") {
                                                            echo "selected";
                                                        } ?>>User</option> -->
                                        <option value="DRIVER" <?php if ($getUser[0]['type'] == "DRIVER") {
                                            echo "selected";
                                        } ?>>Driver</option>
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