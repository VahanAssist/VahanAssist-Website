<?php echo include 'inc/header.php'; 
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

                                    <div> Services

                                        <div class="page-title-subheading">
                  <a href="<?php echo base_url(); ?>Main_con/add_services">Add Services</a>


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

                                                <th>S.no</th>

                                                <th>Name</th>

                                                <th>Image</th>

                                                <th>Action</th>

                                                <th></th>

                                            </tr>

                                            </thead>

                                            <tbody>

             <?php 
             $i=1;
             $getServices = $this->Manage_product->getServices();
                            foreach ($getServices as $data) {
                                    
                                               
                                             ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>
                                                <?php echo $data['name'] ?>
                                                 </td>
                                                   <td> <img src="<?php echo base_url(); ?>images/banner_image/<?php echo $data['image']; ?>" width="200"></td>
                                                <td>
                                                <a href="<?php echo base_url(); ?>Main_con/add_services/<?php echo $data['id'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                                                    <a onclick="return deleteServices('<?php echo $data['id'] ?>');" class="btn "><i class="fa fa-trash-alt"></i> </a>
                                                </td>
                                            </tr>
                                            <?php $i++;  } ?>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>

                                </div>

                        </div>

                        

                    

                        

                    

                    </div>
<?php 

include 'inc/footer.php';

?>
