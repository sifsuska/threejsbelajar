<?php
session_start();

if (!isset($_SESSION["username"])) {
header("location:login.php");
}
elseif ($_SESSION['type'] !=0) {
header("location:login.php");
}

include_once 'conf/koneksi.php';
?>


<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->



<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>3DChem - Admin</title>
<link rel="icon" type="image/ico" href="assets/images/favicon.ico" />
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">




<!-- ============================================
================= Stylesheets ===================
============================================= -->
<!-- vendor css files -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/animate.css">
<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/js/animsition.min.css">
<link rel="stylesheet" href="assets/js/daterangepicker-bs3.css">
<link rel="stylesheet" href="assets/js/morris.css">
<link rel="stylesheet" href="assets/js/owl.carousel.css">
<link rel="stylesheet" href="assets/js/owl.theme.css">
<link rel="stylesheet" href="assets/js/rickshaw.min.css">
<link rel="stylesheet" href="assets/js/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="assets/js/jquery.dataTables.min.css">
<link rel="stylesheet" href="assets/js/datatables.bootstrap.min.css">
<link rel="stylesheet" href="assets/js/chosen.css">
<link rel="stylesheet" href="assets/js/summernote.css">

<!-- project main css files -->
<link rel="stylesheet" href="assets/css/main.css">
<?= $vws->get_inline(); ?>
<!--/ stylesheets -->



<!-- ==========================================
================= Modernizr ===================
=========================================== -->
<script src="assets/js/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<!--/ modernizr -->




</head>





<body id="minovate" class="appWrapper">






<!--[if lt IE 8]>
  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<!-- ====================================================
================= Application Content ===================
===================================================== -->
<div id="wrap" class="animsition">






  <!-- ===============================================
  ================= HEADER Content ===================
  ================================================ -->
  <section id="header">
      <header class="clearfix">

          <!-- Branding -->
          <div class="branding">
              <a class="brand" href="menus-admin.php">
                  <span><strong>3DChem</strong></span>
              </a>
              <a role="button" tabindex="0" class="offcanvas-toggle visible-xs-inline"><i class="fa fa-bars"></i></a>
          </div>
          <!-- Branding end -->

          <!-- Left-side navigation end -->

          <!-- Right-side navigation -->
          <ul class="nav-right pull-right list-inline">

              <li class="dropdown nav-profile">

                  <a href class="dropdown-toggle" data-toggle="dropdown">
                      <img src="assets/images/admin.png" alt="" class="img-circle size-30x30">
                      <span><?php echo $_SESSION['username']; ?><i class="fa fa-angle-down"></i></span>
                  </a>

                  <ul class="dropdown-menu animated littleFadeInRight" role="menu">

                      <li>
                          <a role="button" tabindex="0" href="profile.php">
                              <span class="badge bg-greensea pull-right"></span>
                              <i class="fa fa-user"></i>Profile
                          </a>
                      </li>

                      <li>
                          <a role="button" tabindex="0" href="logout.php">
                              <i class="fa fa-sign-out"></i>Logout
                          </a>
                      </li>

                  </ul>

              </li>

          </ul>
          <!-- Right-side navigation end -->

      </header>

  </section>
  <!--/ HEADER Content  -->





  <!-- =================================================
  ================= CONTROLS Content ===================
  ================================================== -->
  <div id="controls">





      <!-- ================================================
      ================= SIDEBAR Content ===================
      ================================================= -->
      <aside id="sidebar">


          <div id="sidebar-wrap">

              <div class="panel-group slim-scroll" role="tablist">
                  <div class="panel panel-default">
                      <div class="panel-heading" role="tab">
                          <h4 class="panel-title">
                              <a data-toggle="collapse" href="#sidebarNav">
                                  Navigasi <i class="fa fa-angle-up"></i>
                              </a>
                          </h4>
                      </div>
                      <div id="sidebarNav" class="panel-collapse collapse in" role="tabpanel">
                          <div class="panel-body">


                              <!-- ===================================================
                              ================= NAVIGATION Content ===================
                              ==================================================== -->
                              <ul id="navigation">
                                  <li class="active"><a href="menus-admin.php"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li>

                                  <li><a href="kuis/admin.php"><i class="fa fa-list"></i> <span>Input Latihan</span></a></li>

                        

                                  <!--li>
                                      <a role="button" tabindex="0"><i class="fa fa-list"></i> <span>Input Latihan</span></a>
                                      <ul>
                                          <li><a href="kuis/admin.php"><i class="fa fa-caret-right"></i> Input Latihan 1</a></li>
                                          
                                      </ul>
                                      <ul>
                                          <li><a href="new-input-data.php"><i class="fa fa-caret-right"></i> Input Latihan 2</a></li>
                                          
                                      </ul>
                                      

                                  </li-->

                                  <li>
                                      <a role="button" tabindex="0"><i class="fa fa-table"></i> <span>Data</span></a>
                                      <ul>
                                          <li><a href="admin_profil_lihat.php"><i class="fa fa-caret-right"></i> Data Profil</a></li>
                                      </ul>
                                      
                                  </li>

                                  <li>
                                      <a role="button" tabindex="0"><i class="fa fa-user"></i> <span>Pengguna</span></a>
                                      <ul>
                                          <li><a href="user-add.php"><i class="fa fa-caret-right"></i>Tambah Pengguna</a></li>
                                          <li><a href="change-password.php"><i class="fa fa-caret-right"></i>Ganti Password Pengguna</a></li>
                                       </ul>
                                  </li>


                              </ul>
                              <!--/ NAVIGATION Content -->


                          </div>
                      </div>
                  </div>

              </div>

          </div>


      </aside>
      <!--/ SIDEBAR Content -->





      <!-- =================================================
      ================= RIGHTBAR Content ===================
      ================================================== -->
      <aside id="rightbar">

          <div role="tabpanel">

              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#users" aria-controls="users" role="tab" data-toggle="tab"><i class="fa fa-users"></i></a></li>
                  <li role="presentation"><a href="#history" aria-controls="history" role="tab" data-toggle="tab"><i class="fa fa-clock-o"></i></a></li>
                  <li role="presentation"><a href="#friends" aria-controls="friends" role="tab" data-toggle="tab"><i class="fa fa-heart"></i></a></li>
                  <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-cog"></i></a></li>
              </ul>

          </div>

      </aside>
      <!--/ RIGHTBAR Content -->




  </div>
  <!--/ CONTROLS Content -->
