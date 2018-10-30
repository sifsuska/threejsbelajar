<?php
include('header.php');
if(isset($_POST['simpan'])){
 $isi=htmlentities($_POST['isi'], ENT_QUOTES);
 $query = mysql_query("insert into profil values('','".$_POST['judul']."','".date('Y-m-d H:i:s')."','".$isi."')");
 if($query){
?>
<script language="javascript">
	alert("Profil berhasil ditambah");
 urlini = document.location.href.split('/');
	document.location = "http://localhost/threejsbelajar-master/modul/admin_profil_lihat.php";
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
                 <li>
                     <a href="admin_profil_edit.php">Edit Data Profil</a>
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
                     <h1 class="custom-font">Edit Data <strong>Profil</strong></h1>
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

<form method="POST" class="form-horizontal" name="form1" role="form" id="form1" action="">
<input type="hidden" name="tgl" value="<?= date('Y-m-d H:i:s') ?>" />
 <div class="form-group">
  <label for="judul" class='control-label col-sm-2'>Judul Halaman</label>
  <div class="col-sm-4">
   <input type="text" name="judul" id="judul" class="form-control" value="" />
  </div>
 </div>
 <div class="form-group">
  <label for="isi" class='control-label col-sm-2'>Isi Halaman</label>
  <div class="col-sm-4">
   <textarea name="isi" id="isi" class="tinymce"></textarea>
  </div>
 </div>
<button name="simpan" type="submit" class="btn btn-success" id="form1Submit" >Submit</button>
<button type="reset" class="btn btn-danger"> Reset</button>
</div>
                     <!-- END SUBMIT BUTTON -->

             </section>
             <!-- /tile -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
 <div class="modal-content">
     <div class="modal-header">
         <h4 class="modal-title" id="myModalLabel">Informasi Data Keseluruhan</h4>
     </div>
     <div class="modal-body"></div>
     <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
         
     </div>
 </div>
</div>
</div>

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
ob_start()
?>
<script type="text/javascript" src="assets/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">
	$().ready(function() {
		$('textarea.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : 'assets/tiny_mce/tiny_mce.js',

			// General options
			theme : "advanced",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
			theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,
		});
	});
</script>
<?php
$mce = ob_get_clean();
$vws->set_inline($mce);
include('footer.php');