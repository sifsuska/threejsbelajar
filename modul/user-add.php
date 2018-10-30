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

<div class="page page-forms-common">

<div class="pageheader">

 <div class="page-bar">

     <ul class="page-breadcrumb">
         <li>
             <a href="index.html"><i class="fa fa-home"></i> Beranda</a>
         </li>
         <li>
             <a href="#">Pengguna</a>
         </li>
         <li>
             <a href="user-add.php">Tambah Pengguna</a>
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
             <h1 class="custom-font"><strong>Tambah</strong> Pengguna</h1>
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


             <form method="POST" class="form-horizontal" name="form1" role="form" id="form1" action="user-add-proses.php"
             data-parsley-validate>

                 <div class="form-group">
                     <label class="col-sm-2 control-label">Username</label>
                     <div class="col-sm-10">
                         <input type="text" name="username" class="form-control" placeholder="Username"
                                data-parsley-trigger="change" 
                                required>
                     </div>
                 </div>

                 <hr class="line-dashed line-full" />

                 <div class="form-group">
                     <label class="col-sm-2 control-label">Password</label>
                     <div class="col-sm-10">
                         <input type="password" name="pass" class="form-control" placeholder="Password"
                                data-parsley-trigger="change"
                                required>
                     </div>
                 </div>                                      

                 <hr class="line-dashed line-full" />

          <div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
             <!-- SUBMIT BUTTON -->
             <button type="submit" class="btn btn-success" id="form1Submit" >Tambah</button>
             <button type="reset" class="btn btn-danger"> Reset</button>
         </div>
             <!-- END SUBMIT BUTTON -->
             </form>
         <h4>Data Pengguna</h4>
         <table class="table table-striped">
          <thead>
           <tr>
            <th>ID Pengguna</th>
            <th>Username</th>
            <th>Aksi</th>
           </tr>
          </thead>
          <tbody>
           <?php
           $query=mysql_query('select * from login');
           while($row=mysql_fetch_assoc($query)){ ?>
           <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['username'] ?></td>
            <td><a href="user-add.php?hapus=<?= $row['id'] ?>" onclick="return confirm('Hapus pengguna ini ?')"><span class="fa fa-remove"></span> Hapus</a></td>
           </tr>
           <?php } ?>
          </tbody>
         </table>
         </div>
         <!-- /tile body -->
     </section>
     <!-- /tile -->

 </div>
 <!-- /col -->
</div>
<!-- /row -->


<div class="tile-widget bg-greensea">
         Copyright © 2018
        <a href="github.com/whoisKEMAL">whoiskemal</a>
        All rights reserved.
         </div>  

</div>

</section>
<!--/ CONTENT -->






</div>
<!--/ Application Content -->
<?php
include('footer.php');