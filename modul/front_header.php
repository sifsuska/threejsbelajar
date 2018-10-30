<?php
include_once('conf/koneksi.php');
$query = mysql_query("select id_artikel,judul_artikel from profil");
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <title>Sistem Informasi Titik Perceraian Kota Pekanbaru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Informasi Titik Perceraian Kota Pekanbaru">
    <meta name="author" content="Sistem Informasi Titik Perceraian Kota Pekanbaru">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/css/bootflat.min.css"/>
    <link rel="stylesheet" href="assets/css/site.css"/>
    <link rel="stylesheet" href="assets/css/font-awesome.css"/>
    <?= $vws->get_inline() ?>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom:60px">
      <div class="container">
       <div class="navbar-header page-scroll">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar">
             <span class="sr-only">Toggle navigation</span>
             <i class="fa fa-bars"></i>
         </button>
         <a class="navbar-brand" href="index.php">SI Titik Cerai Pekanbaru</a>
        </div>
        <div class="navbar-collapse collapse" id="bs-navbar">
          <ul class="nav navbar-nav">
            <li class="dropdown">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Profil</a>
             <ul class="dropdown-menu">
              <?php 
              while($row=mysql_fetch_assoc($query)) { ?>
              <li><a href="profil.php?id=<?= $row['id_artikel'] ?>"><?= $row['judul_artikel'] ?></a></li>
              <?php } ?>
             </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
           <li><a href="modul/login.php" class="navbar-link">Login</a></li>           
           </ul>
          </div>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>