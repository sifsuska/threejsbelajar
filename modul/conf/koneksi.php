<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$user = 'root';
$pass = '';
$host = 'localhost';
$db = '3dchem';

/////////
$koneksi = mysql_connect($host , $user , $pass);
if (!$koneksi) {
	die("Error".mysql_error());
}
mysql_select_db($db);

//////////
function tanggal($dt,$with_timestamp=false){
 //format harus yyyy-mm-dd
 $bulan=array(
  "00" => "N/A",
  "01" => "Januari",
  "02" => "Februari",
  "03" => "Maret",
  "04" => "April",
  "05" => "Mei",
  "06" => "Juni",
  "07" => "Juli",
  "08" => "Agustus",
  "09" => "September",
  "10" => "Oktober",
  "11" => "November",
  "12" => "Desember"
 );
 $date=explode("-",$dt);
 $tahun=substr($date[2],0,2); //fix date with timestamp format
 $tanggal=$tahun." ".$bulan[$date[1]]." ".$date[0];
 if($with_timestamp){
  $tanggal .= " ".substr($date[2],3);
 }
 return $tanggal;
}


class ViewAsset{
 public $inlinejs = [];
 
 function set_inline($content){
  $this->inlinejs[] = $content;
 }
 
 function get_inline(){
  return implode('\n', $this->inlinejs);
 }
 
 function reset_inline(){
  $this->inlinejs = [];
 }
}

$vws = new ViewAsset();
 ?>