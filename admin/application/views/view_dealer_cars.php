<?php  include 'inc/header.php'; 

$dealer = $this->uri->segment(3);

$getDealer = $this->Manage_product->getUserById($dealer);

$totalCarsByDealer = $this->Manage_product->gettotalCarsByDealer($dealer);
$ActivetotalCarsByDealer = $this->Manage_product->getActivetotalCarsByDealer($dealer);
$OfflinetotalCarsByDealer = $this->Manage_product->getOfflinetotalCarsByDealer($dealer);
$SoldtotalCarsByDealer = $this->Manage_product->getSoldtotalCarsByDealer($dealer);

// print_r($dealers_cars);
// die();

?>   

<style type="text/css">
   .col-lg-3{
      float: left;
   }
   .wrap-dealer{

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
            <div>
             <?php echo $getDealer[0]['firstName'] ?>
               <div class="page-title-subheading">
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12">
         <div class="main-card mb-3 card">
            <div class="card-body">
               <div class="col-lg-3">
                  <a href="" class="wrap-dealer">
                     <h5>Total Cars - <?php echo $totalCarsByDealer ?></h5>
                  </a>
               </div>
               <div class="col-lg-3">
                  <a href="" class="wrap-dealer">
                     <h5>Active Cars - <?php echo $ActivetotalCarsByDealer ?></h5>
                  </a>
               </div>
               <div class="col-lg-3">
                  <a href="" class="wrap-dealer">
                     <h5>Offline Cars - <?php echo $OfflinetotalCarsByDealer ?></h5>
                  </a>
               </div>
               <div class="col-lg-3">
                  <a href="" class="wrap-dealer">
                     <h5>Sold Cars - <?php echo $SoldtotalCarsByDealer ?></h5>
                  </a>
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
                        <th>S No.</th>
                        <th>Car Make Model</th>
                        <th>Images</th>
                        <th>Status</th>
                        <th>Date</th>
                        <!-- <th>Action</th> -->
                     </tr>
                  </thead>
                  <tbody>
                     <?php 
                     $i=1;
                     foreach($dealers_cars as $dc){
                        $cat = $this->Manage_product->getCategoryById($dc['category_id']);
                        $make = $this->Manage_product->getBrandById($dc['brand_id']);
                        $model = $this->Manage_product->getModelById($dc['model_id']);
                        $getAllImages = $this->Manage_product->getAllMPImages($dc['id']);
                     ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $cat[0]['name'] ?> <?php echo $make[0]['name'] ?> <?php echo $model[0]['name'] ?></td>
                        <td>
                           <?php 
                           foreach($getAllImages as $img){
                           ?>
                           <img src="<?php echo base_url() ?>vehicle_image/<?php echo $img['image'] ?>" class="" width="100">
                           <?php 
                           }
                           ?>
                        </td>
                        <td>
                           <!-- <form> -->
                              <select class="form-control">
                                 <option <?php echo $dc['status'] == 'Pending' ? 'selected' : ''  ?> value="Pending">Pending</option>
                                 <option <?php echo $dc['status'] == 'Sold' ? 'selected' : ''  ?> value="Sold">Sold</option>
                              </select>
                           <!-- </form> -->
                        </td>
                        <td><?php echo date('Y-m-d',strtotime($dc['created'])) ?></td>
                        
                      </tr>
                      <?php $i++; }?>
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