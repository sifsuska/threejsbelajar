<?php 
include('header.php');
if(isset($_GET['hapus_id'])){
 $query = mysql_query("delete from profil where id_artikel='".$_GET['hapus_id']."'");
 if($query){
?>
<script language="javascript">
	alert("Data Dihapus");
</script>
<?php
 } else {
  echo mysql_error();
 }
}
?>
<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">

<div class="page page-tables-datatables">

    <div class="pageheader">

        <div class="page-bar">

            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html"><i class="fa fa-home"></i> Beranda</a>
                </li>
                <li>
                    <a href="#">Data</a>
                </li>
                <li>
                    <a href="admin_profil_lihat.php">Data Profil</a>
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
                    <h1 class="custom-font">Data <strong>Profil</strong></h1>
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
                    <div class="row">
                        <div class="col-md-6"><div id="tableTools"></div></div>
                        <div class="col-md-6"><div id="colVis"></div></div>
                    </div>
                    <a href="admin_profil_baru.php" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah Halaman Profil Baru</a>
                    <table class="table table-custom" id="advanced-usage">
                        <thead>
                        <tr>
                            <th>Nama Halaman</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            
            <?php

            $query = mysql_query("SELECT * FROM profil ") or die(mysql_error());
            if(mysql_num_rows($query) == 0){
                echo '<tr><td colspan="6">Tidak ada data!</td></tr>';
            }else{
                while($data = mysql_fetch_assoc($query)){   
                    echo '<tr>';
                        echo '<td><a href="profil.php?id='.$data['id_artikel'].'" target="_blank"><strong>'.$data['judul_artikel'].'</strong></a><br>Terakhir Diperbarui '.$data['tgl_terbit_artikel'].'</td>';
                        echo '<td>
                        <a href=admin_profil_edit.php?id='.$data['id_artikel'].'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                        <a href="admin_profil_lihat.php?hapus_id='.$data['id_artikel'].'" onclick="return confirm(\'Hapus profil ini?\')"><i class="fa fa-trash" aria-hidden="true"></i>
</a></td>';   
                    echo '</tr>';
                }
            }
            ?>

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

</div>

</section>
<!--/ CONTENT -->



</div>
<?php 
include('footer.php');
?>