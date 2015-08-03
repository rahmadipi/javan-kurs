<?php
function filter($nama_bank,$mata_uang,$tanggal_mulai,$tanggal_selesai,$jumlah){
	$simpan_jual="[{name:$nama_bank $mata_uang : jual},data:[";
	$simpan_beli="[{name:$nama_bank $mata_uang : beli},data:[";
	$simpan_tanggal="[{name:$nama_bank $mata_uang : tanggal},data:[";
	$query="select * from $nama_bank where mata_uang='$mata_uang' and date(tanggal)>=date('$tanggal_mulai') and date(tanggal)<=date('$tanggal_selesai') order by tanggal desc";
	$sql=mysql_query($query);
	while($hasil=mysql_fetch_array($sql)){
		$jual=$hasil['jual'];
		$beli=$hasil['beli'];
		$tanggal=$hasil['tanggal'];
		
		$simpan_jual="$simpan_jual$jual,";
		$simpan_beli="$simpan_beli$beli,";
		$simpan_tanggal="$simpan_tanggal$tanggal,";
	}
	$simpan_jual=substr($simpan_jual,0,strlen($simpan_jual)-1)."]}]";
	$simpan_beli=substr($simpan_beli,0,strlen($simpan_beli)-1)."]}]";
	$simpan_tanggal=substr($simpan_tanggal,0,strlen($simpan_tanggal)-1)."]}]";
	
	$simpan_data=array($simpan_tanggal,$simpan_jual,$simpan_beli);
	return $simpan_data;
}
?>