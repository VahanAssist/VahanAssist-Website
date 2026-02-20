<?php echo include 'inc/header.php'; 

$id=$this->uri->segment(3);
if ($id!="") {

$getPage = $this->Manage_product->getPage($id);
}// print_r($getVerifier);

?>   

                <div class="app-main__outer">

                    <div class="app-main__inner">

                        <div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-users icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div> Pages

                                        <div class="page-title-subheading">
                  <a href="<?php echo base_url(); ?>Main_con/add_page">Add Pages</a>


                                        </div>

                                    </div>

                                </div>

                                  </div>

                        </div>           

                        <div class="row">

                            <div class="col-lg-12">

                        <div class="main-card mb-3 card">

                                    <div class="card-body">


                                       <table class="mb-0 table">

                                            <thead>

                                            <tr>

                                                <!-- <th>ID</th> -->

                                                <!-- <th>Page Name</th> -->

                                                <th>Title</th>

                                                <th>Content </th>

                                                <!-- <th>Image</th> -->

                                               

                                                <th>Action</th>
                                                <th></th>

                                            </tr>

                                            </thead>

                                            <tbody>

             <?php 
                            foreach ($pages as $data) {
                                    
                                               
                                             ?>
                                            <tr>
                                                <td><?php echo $data['title'] ?></td>
                                                <td><?php echo $data['content'] ?></td>
                                                
                                                   <!-- <td> <img src="<?php echo base_url(); ?>images/pages/<?php echo $data['image']; ?>" width="200"></td> -->
                                                <td>
                                                    <a href="<?php echo base_url(); ?>Main_con/add_page/<?php echo $data['id'] ?>" class="mb-2 mr-2 border-0 btn-transition btn btn-outline-info"><i class="fa fa-edit"></i> Edit</a>
                                        
                                                    / <a onclick="return deletePage('<?php echo $data['id'] ?>');" class="btn "><i class="fa fa-trash-alt"></i> </a></td>
                                            </tr>
                                            <?php  } ?>
                                            </tbody>
                                       <?php echo $links; ?>
                                        </table>

                                    </div>

                                </div>

                                </div>

                        </div>

                        

                    

                        

                    

                    </div>
<?php 

include 'inc/footer.php';

?>
