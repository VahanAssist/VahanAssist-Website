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

                    <div> View Slider

                        <div class="page-title-subheading"> View Slider

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-12">
               <!--  <button class="btn mb-2 mr-2 btn btn-alternate pull-right" data-toggle="collapse" data-target="#filters"><i class="fa fa-filter"></i> Filters</button> -->
              
                                <div class="row">

                            <div class="col-lg-12">

                        <div class="main-card mb-3 card">

                                    <div class="card-body">

                                       <table class="mb-0 table"  id="myTable">

                                            <thead>

                                            <tr>

                                                <th>ID</th>

                                                <th>Title</th>

                                                <th>Content</th>

                                                <th>Image </th>

                                              

                                                <th>Action</th>

                                            </tr>

                                            </thead>

                                            <tbody>
                                                
                <?php 
                
                $getSlider = $this->Manage_product->getSlider('');

 foreach ($getSlider as $data) {

    # code...
  

  ?>    
                                            <tr>
                                                <td><?php echo $data['id']; ?></td>
                                                <td><?php echo $data['title']; ?></td>
                                                <td><?php echo $data['content']; ?></td>
                                        
                                                <td> <img src="<?php echo base_url(); ?>images/slider/<?php echo $data['image']; ?>" width="200"></td>
                                              
                                                <td>
                                      <a href="<?php echo base_url(); ?>Main_con/add_slider/<?php echo $data['id']; ?>" class="btn btn-primary">View</a>
                                                    / <a onclick="return deleteSlider('<?php echo $data['id']; ?>');" class="btn btn-primary">Delete</a> 
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

        </div>

    </div>

                  <?php 

include 'inc/client-footer.php';

?>


