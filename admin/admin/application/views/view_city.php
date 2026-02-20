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

                                    <div> Cities

                                        <div class="page-title-subheading">
                  <a href="<?php echo base_url(); ?>Main_con/add_city">Add City</a>


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
                                                <th>State Name</th>

                                                <th>City Name</th>

                                                <th>Action</th>
                                            </tr>

                                            </thead>

                                            <tbody>

             <?php 
                            foreach ($cities as $data) {

                                $getStateById = $this->Manage_product->getStateById($data['state_id']);
                                
                                             ?>
                                            <tr>
                                                <td><?php echo $getStateById[0]['state'] ?></td>
                                                <td><?php echo $data['city'] ?></td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>Main_con/add_city/<?php echo $data['id'] ?>" class="mb-2 mr-2 border-0 btn-transition btn btn-outline-info"><i class="fa fa-edit"></i> Edit</a>
                                        
                                                    / <a onclick="return deleteCity('<?php echo $data['id'] ?>');" class="btn "><i class="fa fa-trash-alt"></i> </a></td>
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
