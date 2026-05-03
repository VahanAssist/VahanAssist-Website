<?php echo include 'inc/header.php'; ?>   

                <div class="app-main__outer">

                    <div class="app-main__inner">

                        <div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-users icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div> All Sub Category

                                        <div class="page-title-subheading">View Sub Category

                                        </div>

                                    </div>

                                </div>

                                  </div>

                        </div>           

                        <div class="row">

                            <div class="col-lg-12">

                        <div class="main-card mb-3 card">

                                    <div class="card-body">

                                       <table class="mb-0 table" id="myTable">

                                            <thead>

                                            <tr>

                                                <th>ID</th>

                                                <th>Sub Category Name</th>

                                                <th>Image</th>
                                                
                                                
                                                <th>Action</th>

                                            </tr>

                                            </thead>

                                            <tbody>

             <?php $getSubCategory = $this->Manage_product->getSubCategory('');
                            foreach ($getSubCategory as $data) {
                                          
                                             ?>
                                            <tr>
                                                <td><?php echo $data['id'] ?></td>
                                                <td><?php echo $data['subcategory_name'] ?></td>
                                                <td><img width="200" src="<?php echo base_url(); ?>images/subcategory_image/<?php echo $data['image'] ?>"></td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>Main_con/add_subcategory/<?php echo $data['id'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                        
                                                    <a onclick="return deleteSubCategory('<?php echo $data['id'] ?>');" class="btn "><i class="fa fa-trash-alt"></i> </a>
                                                </td>

                                            </tr>
                                            <?php  } ?>
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
