<?php 
   if (empty($_SESSION['admin_login_id'])) {
      redirect(base_url()."Main_con/login");
   }
   
   ?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta http-equiv="Content-Language" content="en">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title>Vahaan Admin</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
      <meta name="description" content="Kedia" content="no">
      <link href="<?php echo base_url(); ?>main.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
      <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
      <script src="https://cdn.ckeditor.com/4.9.0/standard/ckeditor.js"></script>
   </head>
   <body>
      <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
      <div class="app-header header-shadow">
         <div class="app-header__logo">
            <div class="">Vahaan Admin</div>
            <div class="header__pane ml-auto">
               <div>
                  <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                  <span class="hamburger-box">
                  <span class="hamburger-inner"></span>
                  </span>
                  </button>
               </div>
            </div>
         </div>
         <div class="app-header__mobile-menu">
            <div>
               <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
               <span class="hamburger-box">
               <span class="hamburger-inner"></span>
               </span>
               </button>
            </div>
         </div>
         <div class="app-header__menu">
            <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
            <span class="btn-icon-wrapper">
            <i class="fa fa-ellipsis-v fa-w-6"></i>
            </span>
            </button>
            </span>
         </div>
         <div class="app-header__content">
            <div class="app-header-right">
               <div class="header-btn-lg pr-0">
                  <div class="widget-content p-0">
                     <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                           <div class="btn-group">
                              <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                              <img width="42" class="rounded-circle" src="<?php echo base_url(); ?>assets/images/avatars/1.jpg" alt="">
                              <i class="fa fa-angle-down ml-2 opacity-8"></i>
                              </a>
                              <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                 <a href="<?php echo base_url() ?>Insert_con/logout" tabindex="0" class="dropdown-item">Logout</a>
                              </div>
                           </div>
                        </div>
                        <div class="widget-content-left  ml-3 header-user-info">
                           <div class="widget-heading">
                              Admin
                           </div>
                           <div class="widget-subheading">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="app-main">
      <div class="app-sidebar sidebar-shadow">
         <div class="app-header__logo">
            <div class="logo-src">Ecm</div>
            <div class="header__pane ml-auto">
               <div>
                  <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                  <span class="hamburger-box">
                  <span class="hamburger-inner"></span>
                  </span>
                  </button>
               </div>
            </div>
         </div>
         <div class="app-header__mobile-menu">
            <div>
               <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
               <span class="hamburger-box">
               <span class="hamburger-inner"></span>
               </span>
               </button>
            </div>
         </div>
         <div class="app-header__menu">
            <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
            <span class="btn-icon-wrapper">
            <i class="fa fa-ellipsis-v fa-w-6"></i>
            </span>
            </button>
            </span>
         </div>
         <div class="scrollbar-sidebar">
            <div class="app-sidebar__inner">
               <ul class="vertical-nav-menu">
                  <li class="app-sidebar__heading">Dashboard</li>
                  <li>
                     <a href="<?php echo base_url(); ?>" class="mm-active">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     Dashboard
                     </a>
                  </li> 
                    <li class="app-sidebar__heading">Booking Management</li>
                  <li>
                     <a href="<?php echo base_url(); ?>Main_con/driver_booking">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     Trailer Booking
                     </a>
                  </li> 
                  <li>
                     <a href="<?php echo base_url(); ?>Main_con/view_booking">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     Driver Booking
                     </a>
                  </li>   
                  <li>
                     <a href="<?php echo base_url(); ?>Main_con/inspection_booking">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     Inspection Booking
                     </a>
                  </li>  
                  <li>
                     <a href="<?php echo base_url(); ?>Main_con/towing_booking">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     Towing Booking
                     </a>
                  </li>  
                  

                  <li>
                     <a href="<?php echo base_url(); ?>Main_con/rto_booking">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     RTO Booking
                     </a>
                  </li>  

                  <li>
                     <a href="<?php echo base_url(); ?>Main_con/insurance_booking">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     Insurance Booking
                     </a>
                  </li>  
                  
                  <li class="app-sidebar__heading">User Management</li>
                  <li>
                     <a href="<?php echo base_url(); ?>Main_con/view_user">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     User
                     </a>
                  </li> 
                  <li>
                     <a href="<?php echo base_url(); ?>Main_con/view_driver">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     Driver
                     </a>
                  </li>  
                  <li>
                     <a href="<?php echo base_url(); ?>Main_con/view_dealers">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     Dealer
                     </a>
                  </li>  

                  <li class="app-sidebar__heading">Enquiry Management</li>
                  <li>
                     <a href="<?php echo base_url(); ?>Main_con/view_enquiry">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     Enquiry
                     </a>
                  </li>    
                  <li class="app-sidebar__heading">Vehicle Management</li>
                  <li>
                     <a href="<?php echo base_url(); ?>Main_con/view_category">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     Vehicle Category
                     </a>
                  </li>
                  <li>
                     <a href="<?php echo base_url(); ?>Main_con/view_car_brand">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     Vehicle Brand
                     </a>
                  </li>
                  <li>
                     <a href="<?php echo base_url(); ?>Main_con/view_car_model">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     Vehicle Model
                     </a>
                  </li>


                  <li class="app-sidebar__heading">Vehicle Detail Management</li>
                  <li>
                     <a href="<?php echo base_url(); ?>Main_con/view_vehicle">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     Vehicle
                     </a>
                  </li>
                  <li>
                     <a href="<?php echo base_url(); ?>Main_con/view_state">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     States
                     </a>
                  </li>
                  <li>
                     <a href="<?php echo base_url(); ?>Main_con/view_city">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     City
                     </a>
                  </li>
                
                  <li class="app-sidebar__heading">App Banner Management</li>
                  <li>
                     <a href="<?php echo base_url(); ?>Main_con/view_banner">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     Banner
                     </a>
                  </li>  
                  <li class="app-sidebar__heading">Pages Management</li>
                  <li>
                     <a href="<?php echo base_url(); ?>Main_con/view_page">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     Pages
                     </a>
                  </li>   
                  <li class="app-sidebar__heading">Subscription Management</li>
                  <li>
                     <a href="<?php echo base_url(); ?>Main_con/view_packages">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     Subscription
                     </a>
                  </li>   
                  <li class="app-sidebar__heading">Coupon Management</li>
                  <li>
                     <a href="<?php echo base_url(); ?>Main_con/add_coupon">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     Coupon
                     </a>
                  </li>   
                  <li class="app-sidebar__heading">App Service Management</li>
                  <li>
                     <a href="<?php echo base_url(); ?>Main_con/view_services">
                     <i class="metismenu-icon pe-7s-rocket"></i>
                     Services
                     </a>
                  </li>   
               </ul>
            </div>
         </div>
      </div>