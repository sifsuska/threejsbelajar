<?php
include 'conf/koneksi.php'; 
$pass=md5($_POST['pass']);
$query=mysql_query("INSERT INTO login (username, pass) VALUES ('$_POST[username]','$pass')");
if($query){
 echo "<script>alert('Pengguna berhasil ditambah'); window.location = 'user-add.php';</script>";
} else {
 echo "<script>alert('Pengguna gagal ditambah. Kode error: ".mysql_error() ."'); window.location = 'user_add.php';</script>";
}
 
?>