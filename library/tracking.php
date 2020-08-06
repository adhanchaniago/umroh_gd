
<?php 

$refferer = $_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:'No Refferer';
$ip = $_SERVER['REMOTE_ADDR'];
$tanggal = date('Y-m-d H:i:s');
$data = $tanggal." - ".$ip." - ".$refferer."\r\n";
file_put_contents('../log.txt', $data, FILE_APPEND);

?>