<?php  include 'inc/header.php';?>
<style type="text/css">
   .wig-head{
   opacity: 1 !important;
   font-size: 25px;
   text-shadow: 0px 1px 0px #212121;
   }
   .widget-content .widget-content-left .widget-heading {
   opacity: .8;
   font-weight: normal;
   font-size: 15px;
   }
   .widget-content .widget-numbers {
   font-weight: bold;
   font-size: 1.5rem;
   display: block;
   }
</style>
<div class="app-main__outer">
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-car icon-gradient bg-mean-fruit">
               </i>
            </div>
            <div>
               Vahaan Dashboard
               <div class="page-title-subheading">Manage All Data
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <style type="text/css">
         .anchor-dash{
         position: absolute;
         width: 100%;
         height: 100%;
         background: #ffffff08;
         transition: all 0.25s ease-in;
         }
         .anchor-dash:hover{
         background: rgba(255, 255, 255, 0.12);
         border-radius: 5px;
         transition: all 0.25s ease-in;
         }
      </style>
      <div class="col-md-6 col-xl-4">
         <div class="card mb-3 widget-content bg-midnight-bloom">
            <div class="widget-content-wrapper text-white">
               <a class="anchor-dash" href=""></a>  
               <div class="widget-content-left">
                  <div class="widget-heading">Users</div>
                  <div class="widget-subheading">Manage All Users</div>
               </div>
               <div class="widget-content-right">
                  <div class="widget-numbers text-white"><span>10</span></div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-6 col-xl-4">
         <div class="card mb-3 widget-content bg-primary">
            <div class="widget-content-wrapper text-white">
               <a class="anchor-dash" href=""></a>
               <div class="widget-content-left">
                  <div class="widget-heading">Drivers</div>
                  <div class="widget-subheading">Manage All Drivers</div>
               </div>
               <div class="widget-content-right">
                  <div class="widget-numbers text-white"><span>10</span></div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-6 col-xl-4">
         <div class="card mb-3 widget-content bg-grow-early">
            <div class="widget-content-wrapper text-white">
               <a class="anchor-dash" href=""></a>
               <div class="widget-content-left">
                  <div class="widget-heading">Vehicles</div>
                  <div class="widget-subheading">All Vehicles</div>
               </div>
               <div class="widget-content-right">
                  <div class="widget-numbers text-white"><span>200</span></div>
               </div>
            </div>
         </div>
      </div>
  
      
</div>

                    </div>
<?php 
   include 'inc/footer.php';
   ?>
<script type="text/javascript">
var base_url = "<?php echo  base_url(); ?>"
$(document).ready(function(){
$("#datacount").load(base_url+"Main_con/count");
setInterval(function(){
$("#datacount").load(base_url+'Main_con/count')
}, 20000);
 });

</script>