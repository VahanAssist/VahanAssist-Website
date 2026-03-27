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

                                    <div> Car Model

                                        <div class="page-title-subheading">
                  <a href="<?php echo base_url(); ?>Main_con/add_car_model">Add Car Model</a>


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

                                                <th>Brand</th>

                                                <th>Name</th>

                                                <th>Action</th>

                                                <th></th>

                                            </tr>

                                            </thead>

                                            <tbody>

             <?php 
             $i=1;
             $getCarModel = $this->Manage_product->getCarModel();
                            foreach ($getCarModel as $data) {
                                     $getCarBrandById = $this->Manage_product->getCarBrandById($data['brand_id']);
                                               
                                             ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $getCarBrandById[0]['name'] ?></td>
                                                   <td><?php echo $data['name'] ?></td>
                                                <td>
                                                <a href="<?php echo base_url(); ?>Main_con/add_car_model/<?php echo $data['id'] ?>" class="btn "><i class="fa fa-edit"></i></a>
                                                    <a onclick="return deleteCarBrand('<?php echo $data['id'] ?>');" class="btn "><i class="fa fa-trash-alt"></i> </a>
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
