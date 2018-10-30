<?php
include('header.php');
?>

  <!-- ====================================================
  ================= CONTENT ===============================
  ===================================================== -->
  <section id="content">

      <div class="page page-dashboard">

          <div class="pageheader">
          <h2>Menu admin 3DChem</h2>
          
              <div class="page-bar">

                  <ul class="page-breadcrumb">
                      <li>
                          <a href="index.html"><i class="fa fa-home"></i> Beranda</a>
                      </li>

                  </ul>

                  <!--div class="page-toolbar">
                      <a role="button" tabindex="0" class="btn btn-lightred no-border pickDate">
                          <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span></span>&nbsp;&nbsp;<i class="fa fa-angle-down"></i>
                      </a>
                  </div-->

              </div>

          </div>


          <!-- row -->
          <div class="row">



              <!-- col -->
              <div class="col-md-12">

                  <!-- tile -->
                  <section class="tile">



                      <!-- tile widget -->
                      <div class="tile-widget bg-greensea">
                          <h1>Selamat Datang, <?php echo $_SESSION['username']; ?>!</h1>
                          <img src="assets/images/3dchem-full.png" alt="3dchem" width="795" height="284">
                          <!-- <div style="height: 335px;"><img src="assets/images/bg1.png"></div> -->
                      </div>
                      <!-- /tile widget -->

                  </section>
                  <!-- /tile -->

              </div>
              <!-- /col -->
              <div class="col-md-12">

                  <!-- tile -->
                  <section class="tile">



                      <!-- tile widget -->
                      <div class="tile-widget bg-greensea">
                      Copyright © 2018
                                <a href="github.com/whoisKEMAL">whoiskemal</a>
                       All rights reserved.
                      </div>  
                      <!-- /tile widget -->

                  </section>
                  <!-- /tile -->

              </div>
             </div>
           </div>
         </section>
<?php
include('footer.php');