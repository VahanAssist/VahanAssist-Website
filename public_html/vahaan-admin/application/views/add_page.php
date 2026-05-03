<?php include 'inc/header.php';
$id = $this->uri->segment(3);
if ($id != "") {
    # code...
    $getPage = $this->Manage_product->getPage($id);
} /// print_r($getPage);
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
                    <div> Add page
                        <div class="page-title-subheading">Add New page
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="main-card mb-3 col-lg-8 card">
                <div class="card-body">
                    <form method="post" action="<?php echo base_url(); ?>Insert_con/insertPage" enctype="multipart/form-data">
                        <input name="id" id="id" type="hidden" value="<?php echo $getPage[0]['id'] ?>">

                        <legend class="col-form-label col-sm-12">Basic Information</legend>


                        <div class="position-relative row form-group">
                            <label for="name" class="col-sm-3 col-form-label"> Page </label>
                            <div class="col-sm-9">
                                <select class="form-control" name="page_id">
                                    <option value="">Select Page</option>
                                    <option value="1" <?php if ($getPage[0]['page_id'] == 1) {
                                                            echo "selected";
                                                        } ?>>About Page</option>
                                    <option value="2" <?php if ($getPage[0]['page_id'] == 2) {
                                                            echo "selected";
                                                        } ?>>Contact Page</option>
                                    <option value="3" <?php if ($getPage[0]['page_id'] == 3) {
                                                            echo "selected";
                                                        } ?>>T&C Page</option>
                                    <option value="4" <?php if ($getPage[0]['page_id'] == 4) {
                                                            echo "selected";
                                                        } ?>>Privacy Policy Page</option>
                                    <option value="5" <?php if ($getPage[0]['page_id'] == 5) {
                                                            echo "selected";
                                                        } ?>>Disclaimer</option>
                                </select>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="name" class="col-sm-3 col-form-label"> Title </label>
                            <div class="col-sm-9">
                                <input name="title" id="title" placeholder="" type="text" class="form-control" value="<?php echo $getPage[0]['title']; ?>">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="name" class="col-sm-3 col-form-label">Content</label>
                            <div class="col-sm-9">
                                <textarea name="content" id="content" placeholder="" type="text" class="form-control"><?php echo $getPage[0]['content']; ?></textarea>
                                <script>
                                    CKEDITOR.replace('content');
                                </script>
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