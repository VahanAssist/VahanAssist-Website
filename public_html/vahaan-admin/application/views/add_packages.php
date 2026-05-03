<?php include 'inc/header.php';
$id = $this->uri->segment(3);
if ($id != "") {
    $getSubsPackages = $this->Manage_product->getSubscriptionById($id);
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
                    <div> Add Subscription Packages
                        <div class="page-title-subheading">Add New Subscription Packages
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="main-card mb-3 col-lg-8 card">
                <div class="card-body">
                    <form method="post" action="<?php echo base_url(); ?>Insert_con/insertPackages" enctype="multipart/form-data">
                        <input name="id" id="id" type="hidden" value="<?php echo $getSubsPackages[0]['id'] ?>">
                        <legend class="col-form-label col-sm-12">Basic Information</legend>

                        <div class="position-relative row form-group">
                            <label for="title" class="col-sm-3 col-form-label">title</label>
                            <div class="col-sm-9">
                                <input name="title" id="title" type="text" class="form-control" value="<?php echo $getSubsPackages[0]['title']; ?>">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="name" class="col-sm-3 col-form-label">Content</label>
                            <div class="col-sm-9">

                                <textarea name="content" id="content" placeholder="" type="text" class="form-control"><?php echo $getSubsPackages[0]['content']; ?></textarea>
                                <script>
                                    CKEDITOR.replace('content');
                                </script>

                            </div>
                        </div>


                        <div class="position-relative row form-group">
                            <label for="price" class="col-sm-3 col-form-label">price</label>
                            <div class="col-sm-9">
                                <input name="price" id="price" placeholder="" type="text" class="form-control" value="<?php echo $getSubsPackages[0]['price']; ?>">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="image" class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" name="image" class="form-control" value="<?php echo $getSubsPackages[0]['image']; ?>">
                            </div>
                            <input type="hidden" value="<?php echo $getSubsPackages[0]['image']; ?>" name="image_old">
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