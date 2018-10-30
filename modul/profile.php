<?php
include_once('conf/koneksi.php');
if(isset($_GET['hapus'])){
 $query=mysql_query("delete from login where id = '".$_GET['hapus']."'");
 if($query){
  echo "<script>alert('Pengguna berhasil dihapus')</script>";
 }
}
include('header.php');
?>

            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <section id="content">

                <div class="page page-dashboard">

                    <div class="pageheader">

                        <h2>Profil Anda<span></span></h2>

                
                    <!-- row -->
                    <div class="row">



                        <!-- col -->
                        <div class="col-md-12">

                            <!-- tile -->
                            <section class="tile">

                               

                                <!-- tile widget -->
                                <div class="tile-widget bg-greensea">
                                    <div style="height: 335px;">
<ul>
        <p><img src="assets/images/admin.png" alt="" class="img-circle size-50x50"></p>
        <p>Your story</p>
</ul>



                                    </div>
                                </div>
                                <!-- /tile widget -->

                            </section>
                            <!-- /tile -->

                        </div>
                        <!-- /col -->

                        <!-- col -->
                        <div class="col-md-4">

                            <!-- tile -->
                            <section class="tile" fullscreen="isFullscreen02">

                                <!-- tile -->
                            <section class="tile bg-slategray widget-calendar hidden">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>Mini </strong>Calendar</h1>
                                    <ul class="controls">
                                        <li class="dropdown">

                                            <a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
                                                <i class="fa fa-cog"></i>
                                                <i class="fa fa-spinner fa-spin"></i>
                                            </a>

                                            <ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
                                                <li>
                                                    <a role="button" tabindex="0" class="tile-toggle">
                                                        <span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Minimize</span>
                                                        <span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Expand</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a role="button" tabindex="0" class="tile-refresh">
                                                        <i class="fa fa-refresh"></i> Refresh
                                                    </a>
                                                </li>
                                                <li>
                                                    <a role="button" tabindex="0" class="tile-fullscreen">
                                                        <i class="fa fa-expand"></i> Fullscreen
                                                    </a>
                                                </li>
                                            </ul>

                                        </li>
                                        <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
                                    </ul>
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body p-0">
                                    <div id="mini-calendar"></div>
                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->

                                <!-- tile widget -->
                                <div class="tile-widget hidden">
                                    <div id="browser-usage" style="height: 250px"></div>
                                </div>
                                <!-- /tile widget -->

                            </section>
                            <!-- /tile -->

                        </div>
                        <!-- /col -->


                    </div>
                    <!-- /row -->

                    <!-- row -->
                    <div class="row">


                        <!-- col -->
                        <div class="col-md-4">


                            <!-- tile -->
                            <section class="tile hidden">

                                <!-- tile body -->
                                <div class="tile-body p-0" style="height: 133px">

                                    <div class="rickshaw" id="realtime-rickshaw"></div>

                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->


                        </div>
                        <!-- /col -->

                        <!-- col -->
                        <div class="col-md-4">


                        </div>
                        <!-- /col -->


                    </div>
                    <!-- /row -->

                </div>

                
            </section>
            <!--/ CONTENT -->






        </div>
        <!--/ Application Content -->

<?php
include('footer.php');

