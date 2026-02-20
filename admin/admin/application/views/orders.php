<?php  include 'inc/header.php'; ?>    
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
               View Orders
               <div class="page-title-subheading"> View Orders
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12">
          <!-- <a class="btn mb-2 mr-2 btn btn-alternate pull-right" href="<?php echo base_url(); ?>Insert_con/downloadOrder"><i class=""></i> Download Orders</a> -->
         <br>
         <br>
         <div class="row">
            <div class="col-lg-12">
               <div class="main-card mb-3 card">
                  <div class="card-body">
                     <table class="mb-0 table"  id="myTable">
                        <thead>
                           <tr>
                              <th>Order No</th>
                              <th> Order Date & Time</th>
                              <th>Customer Name</th>
                              <th>Email ID </th>
                              <th>Phone No</th>
                              <th>Amount</th>
                              <th>Paid/Unpaid</th>
                              <th>Order Details</th>
                              <th>Asign Order</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                            $getOdersCount = $this->Manage_product->getOdersCount('');
                              $dataUp['show']=1;
                              foreach ($getOdersCount as $dataAll) {
                    $updateAllOrder = $this->Manage_product->updateAllOrder($dataAll['id'],$dataUp);
                              }
                              
                              
                              $getOders = $this->Manage_product->getOders('');
                              foreach ($getOders as $data) {
                              
                              $getOders = $this->Manage_product->getOderByOrderId($data['order_id']); 
                              $count = count($getOders);
                              ?>    
                           <tr>
                              <td><?php echo $data['order_id']; ?> </td>
                              <td><?php echo $data['date_modified']; ?> </td>
                              <td><?php echo $data['name']." ".$data['lname']; ?> </td>
                              <td><?php echo $data['email']; ?> </td>
                              <td><?php echo $data['phone']; ?> </td>
                              <td><?php echo $data['amount']; ?> </td>
                              <td><?php if($getOders[0]['payment_status']==0){ echo "UnPaid"; }else{ echo "Paid"; } ?> </td>
                              <td><a href="<?php echo base_url(); ?>Main_con/orderdetails/<?php echo trim($data['order_id']) ?>" class="btn btn-primary"><i class="fa fa-eye"></i> View</a></td>
                              <!-- return orderCreate('<?php echo $data['order_id']; ?>');  -->
                              <td>
                                  <form name="updateDeliveryBoy">
                              <input type="hidden" name="order_id" value="<?php echo $data['order_id'] ?>"> 
                              <select class="" name="boy_id">
                                 <option value="">Select</option>
                                 <?php $getDeliveryBoy = $this->Manage_product->getDeliveryBoy('');
                                 foreach ($getDeliveryBoy as $dataBoy) {
                                    # code...
                                  ?>
                                 <option value="<?php echo $dataBoy['id']; ?>" <?php if($dataBoy['id']==$data['boy_id']){ echo "selected"; } ?>><?php echo $dataBoy['name'];  ?></option> 
                              <?php } ?>

                              </select>
                              <br>
                              <br>
                              <input type="submit" class="btn-xs btn-primary" value="submit" name="">
                           </form>
                              </td>
                              <td><a onclick="return deleteOrder('<?php echo $data['id'] ?>');" class="mb-2 mr-2 border-0 btn-transition btn btn-outline-danger "><i class="fa fa-trash-alt"></i> </a></td>
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
   include 'inc/footer.php';
   
   
   
   ?>