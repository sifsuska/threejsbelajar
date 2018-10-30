<?php
include('conf/koneksi.php');
 
$query = mysql_query("select * from profil where id_artikel='".$_GET['id']."'");
$artikel = mysql_fetch_assoc($query);
?>
    <div class="container" style="margin-top:70px;min-height:70vh">
     <div class="row">
      <div class="col-md-8">
       <h1 style="
      text-align: center;
      font-size: 40px;
      ">
      <?= $artikel['judul_artikel'] ?></h1>
       <p><small>Terakhir diperbarui pada <?= tanggal($artikel['tgl_terbit_artikel'],true) ?></small></p>
           <?= html_entity_decode($artikel['isi_artikel']) ?>
      </div>
     </div>
    </div>
    
    <hr />
<?php 

?>