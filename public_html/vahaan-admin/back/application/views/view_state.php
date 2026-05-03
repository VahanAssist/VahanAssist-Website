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

                                    <div> States

                                        <div class="page-title-subheading">
                  <a href="<?php echo base_url(); ?>Main_con/add_state">Add State</a>


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

                                                <th>Action</th>
                                            </tr>

                                            </thead>

                                            <tbody>

             <?php 
                            foreach ($states as $data) {
                                
                                             ?>
                                            <tr>
                                                <td><?php echo $data['state'] ?></td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>Main_con/add_state/<?php echo $data['id'] ?>" class="mb-2 mr-2 border-0 btn-transition btn btn-outline-info"><i class="fa fa-edit"></i> Edit</a>
                                        
                                                    / <a onclick="return deleteState('<?php echo $data['id'] ?>');" class="btn "><i class="fa fa-trash-alt"></i> </a></td>
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
