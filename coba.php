<?php
include "koneksi.php";
include "filter.php";
 $coba=filter('bca_ttcounter','AUD','2015-7-15','2015-7-24','10');
 foreach($coba as $value){
	 echo "
	 $value<br>
	 ";
 }
?>