<?php  include 'inc/header.php';
$id=$this->uri->segment(3);
if ($id!="") {
# code...
$getTestimonial = $this->Manage_product->getTestimonial($id);
}/// print_r($getTestimonial);
?>
<style type="text/css">
    legend{
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
                    <div> Add Testimonial
                        <div class="page-title-subheading">Add New Testimonial
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="main-card mb-3 col-lg-8 card">
                <div class="card-body">
              <!--       <form class="" name="insertVerifier"> -->
                <form method="post"  action="<?php echo base_url(); ?>Insert_con/insertTestimonial" enctype="multipart/form-data">
        <input name="id" id="id" type="hidden"  value="<?php echo $getTestimonial[0]['id'] ?>">
           
                            <legend class="col-form-label col-sm-12">Basic Information</legend>

                        
                        <div class="position-relative row form-group">
                            <label for="name" class="col-sm-3 col-form-label"> Name </label>
                            <div class="col-sm-9">
                                <input name="name" id="name" placeholder="" type="text" class="form-control" value="<?php echo $getTestimonial[0]['name']; ?>"></div>
                            </div>
                                 <div class="position-relative row form-group">
                            <label for="name" class="col-sm-3 col-form-label">Content</label>
                            <div class="col-sm-9">
                                <!-- <input name="content" id="content" placeholder="" type="text" class="form-control" value="<?php echo $getTestimonial[0]['content']; ?>"> -->
                                <textarea name="content" id="content" placeholder="" type="text" class="form-control"><?php echo $getTestimonial[0]['content']; ?></textarea>
                                <script>

                // Replace the <textarea id="editor1"> with a CKEditor

                // instance, using default configuration.

                CKEDITOR.replace( 'content' );

            </script>
                            </div>
                            </div>
                                
                                      
                                   <div class="position-relative row form-group">
                            <label for="name" class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input name="image" id="image" placeholder="" type="file" class="form-control" >
                                <input name="image_old" id="image_old" placeholder="" type="hidden" class="form-control" value="<?php echo $getTestimonial[0]['image']; ?>">
                                <?php if ($getTestimonial[0]['image']!="") {
                                    ?>
                                    <img src="<?php echo base_url(); ?>images/testimonial/<?php echo $getTestimonial[0]['image']; ?>" width="200">
                               <?php } ?>

                            </div>
                            </div>
                                      
                                                
                                             
                                                 
                                               
                                                
                                                <div class="position-relative row form-check">
                                                    <div class="col-sm-10 offset-sm-2">
                                                       <!--  <input type="submit"  value="Submit" > -->
                                                        <input type="submit" class="btn btn-secondary"   value="Submit" >
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <!--     //////////// -->
                                 <div class="col-lg-12">
         <div class="main-card mb-3 card">
            <div class="card-body">
               <table class="mb-0 table"  id="myTable">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th> Name</th>
                        <th>Content</th>
                        <th>Image</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $getTestimonial = $this->Manage_product->getTestimonial('');
                        foreach ($getTestimonial as $data) {
                        
                                        
                        
                                         ?>
                     <tr>
                        <td><?php echo $data['id'] ?></td>
                        <td><?php echo $data['name'] ?></td>
                        <td><?php echo $data['content'] ?></td>
                        <td><img width="200" src="<?php echo base_url(); ?>images/testimonial/<?php echo $data['image'] ?>"></td>
                        <td>
                           <a href="<?php echo base_url(); ?>Main_con/add_testimonial/<?php echo $data['id'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                           /<a onclick="return deleteTestimonial('<?php echo $data['id'] ?>');" class="mb-2 mr-2 border-0 btn-transition btn btn-outline-danger "><i class="fa fa-trash-alt"></i> </a>
                        </td>
                     </tr>
                     <?php  } ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
                                <!--     //////////// -->
                              
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <?php include 'inc/footer.php'; ?>