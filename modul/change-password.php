<?php
include('header.php');
?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

<div class="page page-forms-common">

  <div class="pageheader">

      <div class="page-bar">

          <ul class="page-breadcrumb">
              <li>
                  <a href="index.html"><i class="fa fa-home"></i> Beranda</a>
              </li>
              <li>
                  <a href="#">User</a>
              </li>
              <li>
                  <a href="change-password.php">Ganti Password</a>
              </li>
          </ul>
          
      </div>

  </div>

  <!-- row -->
  <div class="row">
      <!-- col -->
      <div class="col-md-12">

          <!-- tile -->
          <section class="tile">

              <!-- tile header -->
              <div class="tile-header dvd dvd-btm">
                  <h1 class="custom-font"><strong>Ganti</strong> Password</h1>
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
              <div class="tile-body">


                  <form method="POST" class="form-horizontal" id="gantipass" name="gantipass" role="form" action="changepass-proses.php"
                  data-parsley-validate>

                      <div class="form-group">
                          <label class="col-sm-2 control-label">Username</label>
                          <div class="col-sm-10">
                           <select name="username" id="username" class="form-control">
                           <option selected disabled>Pilih Nama Pengguna</option>
                            <?php
                            $query = mysql_query('select id,username from login');
                            while($row=mysql_fetch_assoc($query)){ ?>
                            <option value="<?=  $row['username'] ?>"><?= $row['username'] ?></option>
                            <?php } ?>
                           </select>
                          </div>
                      </div>

                      <hr class="line-dashed line-full" />

                      <div class="form-group">
                          <label class="col-sm-2 control-label">Password Lama</label>
                          <div class="col-sm-10">
                              <input type="password" name="passwordlama" id="passwordlama" class="form-control" placeholder="Password"
                                     data-parsley-trigger="change"
                                     required>
                          </div>
                      </div>   

                      <hr class="line-dashed line-full" />

                      <div class="form-group">
                          <label class="col-sm-2 control-label">Password Baru</label>
                          <div class="col-sm-10">
                              <input type="password" name="passwordbaru" id="passwordbaru" class="form-control" placeholder="Password"
                                     data-parsley-trigger="change"
                                     required>
                          </div>
                      </div>   

                      <hr class="line-dashed line-full" />

                      <div class="form-group">
                          <label class="col-sm-2 control-label">Ulangi Password</label>
                          <div class="col-sm-10">
                              <input type="password" name="konfirmasipassword" id="konfirmasipassword" class="form-control" placeholder="Password"
                                     data-parsley-trigger="change"
                                     required>
                          </div>
                      </div>   

                      <hr class="line-dashed line-full" />

               <div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
                  <!-- SUBMIT BUTTON -->
                  <button type="submit" name="change" id="kirim" class="btn btn-success" id="form1Submit" >Tambah</button>
                  <button type="reset" class="btn btn-danger"> Reset</button>
              </div>
                  <!-- END SUBMIT BUTTON -->
                  </form>

              </div>
              <!-- /tile body -->
          </section>
          <!-- /tile -->

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