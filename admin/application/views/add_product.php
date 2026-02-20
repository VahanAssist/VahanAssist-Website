<?php  include 'inc/header.php';    
   $id=$this->uri->segment(3);
   if ($id!="") {
   $getProduct = $this->Manage_product->getProduct($id);
    // $getVerifier = $this->Manage_product->getVerifier('');
   $getSubCategory = $this->Manage_product->getSubCategoryById($getProduct[0]['category_id']);
   }
   
   
   
   ?>
<style type="text/css">
   h5, .h5 {
   font-size: 1.25rem;
   color: #212121;
   font-weight: 600;
   border-bottom: 2px solid #ccc;
   padding: 5px;
   text-transform: uppercase;
   font-family: inherit;
   }
   .hidden{
   display: none;
   }
   #maindiv{
   width:960px;
   margin:10px auto;
   padding:10px;
   font-family:'Droid Sans',sans-serif
   }
   #formdiv{
   width:500px;
   float:left;
   text-align:center
   }
   form{
   /*padding:40px 20px;*/
   /*box-shadow:0 0 10px;*/
   /*border-radius:2px*/
   }
   h2{
   margin-left:30px
   }
   .upload{
   background-color: #0088cc;
   border: 1px solid #47a447;
   color: #fff;
   margin-top: 5px;
   border-radius: 5px;
   padding: 5px 10px;
   float: right;
   /* text-shadow: 1px 1px 0 green; */
   /* box-shadow: 2px 2px 15px rgba(0,0,0,.75); */
   }
   .upload:hover{
   cursor:pointer;
   background:#c20b0b;
   border:1px solid #c20b0b;
   box-shadow:0 0 5px rgba(0,0,0,.75)
   }
   #file{
   padding: 5px;
   margin: 5px 0px;
   border: 1px dashed #123456;
   background-color: #f9ffe5;
   width: 70%;
   display: -webkit-inline-box;
   }
   .pull-left{
   float: left;
   }
   #upload{
   margin-left:45px
   }
   #noerror{
   color:green;
   text-align:left
   }
   #error{
   color:red;
   text-align:left
   }
   #img{
   width:17px;
   border:none;
   height:17px;
   margin-left:-20px;
   margin-bottom:91px
   }
   .abcd{
   text-align:center
   }
   .abcd img{
   height:100px;
   width:100px;
   padding:5px;
   border:1px solid #e8debd
   }
   b{
   color:red
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
               Add Dish / Item
               <div class="page-title-subheading">Add Dish / Item
               </div>
            </div>
         </div>
         <!--  <div class="page-title-actions">
            <a type="button" href="<?php echo base_url(); ?>Main_con/upload_case" class="btn btn-primary">
            
                <span class="btn-icon-wrapper pr-2 opacity-7">
            
                    <i class="fa fa-upload fa-w-20"></i>
            
                </span>
            
                Upload Case
            
            </a>
            
            <a type="button" href="<?php echo base_url(); ?>Main_con/upload_case_partner" class="btn btn-info">
            
                <span class="btn-icon-wrapper pr-2 opacity-7">
            
                    <i class="fa fa-upload fa-w-20"></i>
            
                </span>
            
                Upload Partner Case
            
            </a>
            
            </div> -->
      </div>
   </div>
   <div class="row">
      <div class="main-card mb-3 col-lg-12 card">
         <div class="card-body">
            <!-- <form class="" name="insertCase"> -->
            <form class="" action="<?php echo base_url(); ?>Insert_con/insertProduct" method="post" enctype="multipart/form-data">
               <input type="hidden" name="id" id="id" value="<?php echo $getProduct[0]['id']; ?>">
               <div class="form-row">
                  <div class="col-md-12">
                    <div class="col-md-12  pull-left position-relative form-group" style="padding:0;">
                        <h5>Information Management</h5>
                     </div>
                    <!--  <div class="col-md-6 pull-left position-relative form-group">
                        <label for="portfolio" class="">Select Restaurant</label>
                        <select class="form-control" name="r_id" id="r_id">
                           <option value="">Select Restaurant</option>
                           <?php
                              $getShop = $this->Manage_product->getShop('');
                            foreach ($getShop as $data) { ?>
                           <option value="<?php echo $data['id'] ?>" <?php if ($data['id']==$getProduct[0]['r_id']) { echo "selected"; } ?>><?php echo $data['shop_name'] ?></option>
                           <?php } ?>
                        </select>
                     </div> -->
                     <div class="col-md-6 pull-left position-relative form-group">
                        <label for="portfolio" class="">Select Category</label>
                        <select class="form-control" name="category_id" id="category_id" >
                           <!--  onchange="return getSubCatgByCatId();" -->
                           <option value="">Select Category</option>
                           <?php
                              $getCategory = $this->Manage_product->getCategory('');
                              
                              foreach ($getCategory as $data) {
                              
                              
                              
                                ?>
                           <option value="<?php echo $data['id'] ?>" <?php if ($data['id']==$getProduct[0]['category_id']) {
                              echo "selected";                              } ?>><?php echo $data['category_name'] ?></option>
                           <?php } ?> 
                        </select>
                     </div>
                <div class="col-md-6 pull-left position-relative form-group">
                        <label for="dish_type" class="">Select Product Type</label>
                        <select onchange="getType(this)" class="form-control" name="dish_type" id="dish_type" >
                           <option value="">Select Product Type</option>
                           <option <?php echo $getProduct[0]['dish_type'] == 1 ? 'selected' : '' ?> value="1">Single Price</option>
                           <option <?php echo $getProduct[0]['dish_type'] == 2 ? 'selected' : '' ?> value="2">Multi Price</option>
                        </select>
                     </div>
                     <div class="col-md-6 pull-left position-relative form-group">
                        <label for="cand_name" class="">Product Name</label>
                        <input id="product_name" placeholder="Name" type="text" class="form-control" name="product_name" value="<?php echo $getProduct[0]['product_name']; ?>" onchange="return getSlug();">
                     </div>
                    <div class="col-md-6 pull-left position-relative form-group">
                        <label for="present_address" class="">Slug</label>
                        
                        <input name="slug" id="slug" type="text" class="form-control" value="<?php echo $getProduct[0]['slug']; ?>">
                        
                      </div> 
                        
                       <!--   <div class="col-md-6 pull-left position-relative form-group">
                        
                        <label for="present_address" class="">Minimum Quantity</label>
                        
                        <input name="m_quantity" id="m_quantity" placeholder="m_quantity" type="text" class="form-control" value="<?php echo $getProduct[0]['m_quantity']; ?>">
                        
                        </div>
                        
                        <div class="col-md-6 pull-left position-relative form-group">
                        
                        <label for="present_address" class="">Product Weight</label>
                        
                        <input name="unit" id="unit" placeholder="Weight (Display Weight on Product Page)" type="text" class="form-control" value="<?php echo $getProduct[0]['unit']; ?>">
                        
                        </div>-->
                     <!--    <div class="col-md-6 pull-left position-relative form-group">
                        <label for="present_address" class="">Product USP</label>
                        
                        <input name="usp" id="usp" placeholder="usp" type="text" class="form-control" value="<?php echo $getProduct[0]['usp']; ?>">
                        
                        </div> -->
                     <!--    </div>
                        <div class="col-md-6"> 
                        
                            
                        
                        
                        -->

                 <?php if($id && $getProduct[0]['dish_type'] == 1){?>
                    <div class="col-md-6 pull-left position-relative form-group">
                        <label for="product_price" class="">Full Price</label>
                        <input name="product_price" id="product_price" placeholder="Price" type="text" class="form-control" value="<?php echo $getProduct[0]['product_price']; ?>">
                     </div>
                 <?php }?>

                   <?php if($id && $getProduct[0]['dish_type'] == 2){?>
                        <div class="col-md-6 pull-left position-relative form-group">
                        <label for="product_price" class="">Full Price</label>
                        <input name="product_price" id="product_price" placeholder="Price" type="text" class="form-control" value="<?php echo $getProduct[0]['product_price']; ?>">
                     </div>
                    <div class="col-md-6 pull-left position-relative form-group">
                        <label for="half_product_price" class="">Half Price</label>
                        <input name="half_product_price" id="half_product_price" placeholder="Price" type="text" class="form-control" value="<?php echo $getProduct[0]['half_product_price']; ?>">
                     </div>
                    <?php }?>
                     <div class="col-md-6 pull-left position-relative form-group d-none" id="fullPrice">
                        <label for="product_price" class="">Full Price</label>
                        <input name="product_price" id="product_price" placeholder="Price" type="text" class="form-control" value="<?php echo $getProduct[0]['product_price']; ?>">
                     </div>
                            <div class="col-md-6 pull-left position-relative form-group d-none" id="halfPrice">
                        <label for="half_product_price" class="">Half Price</label>
                        <input name="half_product_price" id="half_product_price" placeholder="Price" type="text" class="form-control" value="<?php echo $getProduct[0]['half_product_price']; ?>">
                     </div>
             <!--         <div class="col-md-6 pull-left position-relative form-group">
                        <label for="cand_phone" class="">Original Price</label>
                        <input name="orginal_price" id="orginal_price" placeholder="Price" type="text" class="form-control" value="<?php echo $getProduct[0]['orginal_price']; ?>">
                     </div> -->
                     
                        <div class="col-md-6 pull-left">
                        
                                                                   <div class=" position-relative form-group">
                        
                                                                        <label for="cand_phone" class="">Product Description</label>
                        
                                                        <textarea name="product_desc" rows="10" id="product_desc" placeholder="Description" class="form-control" ><?php echo $getProduct[0]['product_desc']; ?></textarea>
                        
                                                           <script>
                        
                                // Replace the <textarea id="editor1"> with a CKEditor
                        
                                // instance, using default configuration.
                        
                                CKEDITOR.replace( 'product_desc' );
                        
                            </script>
                        
                                                                    </div>
                        
                                                                    
                        
                                                                </div>
                     <div class="col-md-12  pull-left position-relative form-group" style="padding:0;">
                        <div class="col-md-12  pull-left position-relative form-group" style="padding:0;">
                           <h5>Image Management</h5>
                        </div>
                        <div class="col-md-6 pull-left position-relative form-group">
                           <label for="cand_phone" class="">Product Image</label>
                           <input name="product_image" id="product_image" type="file" class="form-control" >
                           <input name="product_image_old" id="product_image_old" placeholder="" type="hidden" class="form-control" value="<?php echo $getProduct[0]['product_image']; ?>"> 
                           <?php if ($getProduct[0]['product_image']!="") {
                              ?>
                           <img src="<?php echo base_url(); ?>images/product_image/<?php echo $getProduct[0]['product_image']; ?>" width="200">
                           <?php } ?>
                        </div>
                        <!-- <div class="col-md-6 pull-left position-relative form-group" >
                           <label for="cand_phone" class="">Product Detail Image</label>
                           <br>
                           <input name="product_image1[]"  type="file" class="form-control" multiple="multiple" id="file">
                           <?php $getProductImage = $this->Manage_product->getProductImage($getProduct[0]['id']);
                              foreach ($getProductImage as $data) {
                              
                              ?>  
                           <div class="col-lg-4 pull-left text-center"> 
                           <img src="<?php echo base_url(); ?>images/product_image/<?php echo $data['image']; ?>" width="200">
                           <br>
                           <a onclick="return deleteMultiImage($data['id'],$data['image']);" class="btn btn-xs">Delete</a>
                           </div>
                           <?php } ?>                          
                           </div> -->
                     </div>
                  </div>
                  <!--   <div class="col-md-12">
                     <div class="col-md-12">
                     
                     <input type="button" class="btn btn-primary pull-right" value="Add" onclick="addRow1('stock1')" />
                     
                     <button type="button" class="mb-2 mr-2 border-0 btn-transition btn btn-outline-danger" onclick="deleteRow1('stock1')"><i class="fa fa-trash"></i> </button>
                     </div>
                                     
                     
                     
                     
                     
                     </div>
                     -->
               </div>
               <button class="mt-2 btn btn-primary" type="submit">Add</button>
            </form>
         </div>
      </div>
   </div>
</div>
<?php 
   include 'inc/footer.php';
   
   
   
   ?>
<SCRIPT language="javascript">
   function addRow(tableID) {
   
     var table = document.getElementById(tableID);
   
     var rowCount = table.rows.length;
     var row = table.insertRow(rowCount);
   
     var colCount = table.rows[0].cells.length;
   
     for(var i=0; i<colCount; i++) {
   
       var newcell = row.insertCell(i);
   
       newcell.innerHTML = table.rows[0].cells[i].innerHTML;
       //alert(newcell.childNodes);
       switch(newcell.childNodes[0].type) {
         case "text":
             newcell.childNodes[0].value = "";
             break;
         case "checkbox":
             newcell.childNodes[0].checked = false;
             break;
         case "select-one":
             newcell.childNodes[0].selectedIndex = 0;
             break;
       }
     }
   }
   
   function deleteRow(tableID) {
     try {
     var table = document.getElementById(tableID);
     var rowCount = table.rows.length;
   
     for(var i=0; i<rowCount; i++) {
       var row = table.rows[i];
       var chkbox = row.cells[0].childNodes[0];
       if(null != chkbox && true == chkbox.checked) {
         if(rowCount <= 1) {
           alert("Cannot delete all the rows.");
           break;
         }
         table.deleteRow(i);
         rowCount--;
         i--;
       }
   
   
     }
     }catch(e) {
       alert(e);
     }
   }
   function addRow1(tableID) {
   
     var table = document.getElementById(tableID);
   
     var rowCount = table.rows.length;
     var row = table.insertRow(rowCount);
   
     var colCount = table.rows[0].cells.length;
   
     for(var i=0; i<colCount; i++) {
   
       var newcell = row.insertCell(i);
   
       newcell.innerHTML = table.rows[0].cells[i].innerHTML;
       //alert(newcell.childNodes);
       switch(newcell.childNodes[0].type) {
         case "text":
             newcell.childNodes[0].value = "";
             break;
         case "checkbox":
             newcell.childNodes[0].checked = false;
             break;
         case "select-one":
             newcell.childNodes[0].selectedIndex = 0;
             break;
       }
     }
   }
   
   function deleteRow1(tableID) {
     try {
     var table = document.getElementById(tableID);
     var rowCount = table.rows.length;
   
     for(var i=0; i<rowCount; i++) {
       var row = table.rows[i];
       var chkbox = row.cells[0].childNodes[0];
       if(null != chkbox && true == chkbox.checked) {
         if(rowCount <= 1) {
           alert("Cannot delete all the rows.");
           break;
         }
         table.deleteRow1(i);
         rowCount--;
         i--;
       }
   
   
     }
     }catch(e) {
       alert(e);
     }
   }
   
</SCRIPT>