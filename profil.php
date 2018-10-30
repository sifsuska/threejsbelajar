<?php
include_once('conf/koneksi.php');
$query = mysql_query("select id_artikel,judul_artikel from profil");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tentang - 3DChem</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="assets/css/w3.css">
    <link rel="stylesheet" href="assets/css/test.css">
    <style>

      @font-face {
        font-family: 'inconsolata';
        src: url('files/inconsolata.woff') format('woff');
        font-weight: normal;
        font-style: normal;
      }

      * {
        box-sizing: border-box;
      }

      html {
        height: 100%;
      }

      body {
        background-color: #ffffff;
        margin: 0px;
        height: 100%;
        color: #555;
        font-family: 'inconsolata';
        font-size: 15px;
        line-height: 18px;
        overflow: hidden;
      }

      h1 {
        margin-top: 20px;
        margin-bottom: 20px;
        margin-left: 20px;
        font-size: 25px;
        font-weight: normal;
      }

      h2 {
        font-size: 20px;
        font-weight: normal;
      }

      a {
        font-family: 'Segoe UI';
        font-size: 15px;
        text-decoration: none;
      }

      #panel {
        position: fixed;
        left: 0px;
        width: 310px;
        height: 100%;
        overflow: auto;
        background: #fafafa;
      }

      #panel #content {
        /*padding: 0px 20px 20px 20px;*/
        /*padding: 0 18px;*/
        
        max-height: 0;
          background-color: white;
          overflow: hidden;
          transition: max-height 0.2s ease-out;

      }

      #panel #content .link {
        color: #2194CE;
        text-decoration: none;
        cursor: pointer;
        display: block;
      }

      #panel #content .selected {
        color: #ff0000;
      }

      #panel #content .link:hover {
        text-decoration: underline;
      }

      #viewer {
        position: absolute;
        border: 0px;
        left: 310px;
        width: calc(100% - 310px);
        height: 100%;
        overflow: auto;
      }

      #viewSrcButton {
        position: fixed;
        bottom: 20px;
        right: 20px;
        padding: 8px;
        color: #fff;
        background-color: #555;
        opacity: 0.7;
      }

      #viewSrcButton:hover {
        cursor: pointer;
        opacity: 1;
      }

      .filterBlock{
        margin: 20px;
        position: relative;
      }

      .filterBlock p {
        margin: 0;
      }

      #filterInput {
        width: 100%;
        padding: 5px;
        font-family: inherit;
        font-size: 15px;
        outline: none;
        border: 1px solid #dedede;
      }

      #filterInput:focus{
        border: 1px solid #2194CE;
      }

      #clearFilterButton {
        position: absolute;
        right: 6px;
        top: 50%;
        margin-top: -8px;
        width: 16px;
        height: 16px;
        font-size: 14px;
        color: grey;
        text-align: center;
        line-height: 0;
        padding-top: 7px;
        opacity: .5;
      }

      #clearFilterButton:hover {
        opacity: 1;
      }

      .filtered {
        display: none !important;
      }

      #panel li b {
        font-weight: bold;
      }

      /* mobile */

      #expandButton {
        display: none;
        position: absolute;
        right: 20px;
        top: 12px;
        width: 32px;
        height: 32px;
      }

      #expandButton span {
        height: 2px;
        background-color: #2194CE;
        width: 16px;
        position: absolute;
        left: 8px;
        top: 10px;
      }

      #expandButton span:nth-child(1) {
        top: 16px;
      }

      #expandButton span:nth-child(2) {
        top: 22px;
      }

      @media all and ( max-width: 640px ) {
        h1{
          margin-top: 20px;
          margin-bottom: 20px;
        }
        #panel{
          position: absolute;
          left: 0;
          top: 0;
          height: 480px;
          width: 100%;
          right: 0;
          z-index: 100;
          overflow: hidden;
          border-bottom: 1px solid #dedede;
        }
        #content{
          position: absolute;
          left: 0;
          top: 90px;
          right: 0;
          bottom: 0;
          font-size: 17px;
          line-height: 22px;
          overflow: auto;
        }
        #viewer{
          position: absolute;
          left: 0;
          top: 56px;
          width: 100%;
          height: calc(100% - 56px);
        }
        #expandButton{
          display: block;
        }
        #panel.collapsed{
          height: 56px;
        }
      }

    </style>
  </head>
  <body>

    <header>
    <a href="index.php"><img src="logo.jpg"></a>
    </header>

    <div class="topnav">
      <a href="index.php">Beranda</a>
      <a href="materi.php">Materi</a>
      <a href="latihan.php">Latihan</a>
      <div class="dropdown">
      <button class="dropbtn">Tentang</button>
      <div class="dropdown-content">
      <?php
        while($row=mysql_fetch_assoc($query)) { ?>
            <a href="profil.php?id=<?= $row['id_artikel'] ?>"><?= $row['judul_artikel'] ?></a>
        <?php } ?>      
      </div>
    </div> 
      <a style="float:right" href="modul/login.php">Login</a>
    </div>
   
<?php
$query = mysql_query("select * from profil where id_artikel='".$_GET['id']."'");
$artikel = mysql_fetch_assoc($query);
?>
    <div class="container" style="margin-left:400px;margin-right:400px;text-align: justify;font-size:17px;font-family: 'Segoe UI';line-height: 1.6;min-height:70vh">
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