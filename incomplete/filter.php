<?php
function filter($nama_bank,$mata_uang,$tanggal_mulai,$tanggal_selesai){
	if($tanggal_selesai==""){
		$tanggal_selesai=new DateTime();
		$tanggal_selesai=$tanggal_selesai->format('Y-m-d H:i:s');
	}
	if($tanggal_mulai==""){
		$tanggal_selesai=new DateTime();
		$tanggal_selesai=$tanggal_selesai->format('Y-m-d H:i:s');$tanggal_selesai=strtotime('-1 day',strtotime($tanggal_selesai));
	}
	$simpan_jual="{name:'$nama_bank-jual',data:[";
	$simpan_beli="{name:'$nama_bank-beli',data:[";
	
	$hitung=1;
	$tanggal_sekarang="";
	$tanggal_sebelumnya="";
	#$time = date('Gi.s', $timestamp);
	#$tanggal_sebelumnya=date($tanggal_mulai);
	
	
	$query="select * from $nama_bank where mata_uang='$mata_uang' and date(tanggal)>=date('$tanggal_mulai') and date(tanggal)<=date('$tanggal_selesai') order by tanggal";
	$sql=mysql_query($query);
	while($hasil=mysql_fetch_array($sql)){
		$jual=$hasil['jual'];
		$beli=$hasil['beli'];
		$tanggal=$hasil['tanggal'];

		$simpan_jual="$simpan_jual$jual,";
		$simpan_beli="$simpan_beli$beli,";
		
		
		if($hitung==1){
			$tanggal_sebelumnya=date('Y-m-d',strtotime($tanggal));
			$simpan_tanggal="[{name:'$tanggal_sebelumnya',categories:[";
			$hitung=0;
		}
		$tanggal_sekarang=date('Y-m-d',strtotime($tanggal));
		if($tanggal_sebelumnya==$tanggal_sekarang){
			$simpan_tanggal="$simpan_tanggal'".date('h:i:s',strtotime($tanggal))."',";
		}
		else{
			$tanggal_sebelumnya=$tanggal_sekarang;
			$simpan_tanggal=substr($simpan_tanggal,0,strlen($simpan_tanggal)-1);
			$simpan_tanggal="$simpan_tanggal]},{name:'$tanggal_sekarang',categories:['".date('h:i:s',strtotime($tanggal))."',";
		}
		
		
		#$simpan_tanggal="$simpan_tanggal'$tanggal',";
	}
	$simpan_jual=substr($simpan_jual,0,strlen($simpan_jual)-1)."]}";
	$simpan_beli=substr($simpan_beli,0,strlen($simpan_beli)-1)."]}";
	$simpan_tanggal=substr($simpan_tanggal,0,strlen($simpan_tanggal)-1)."]}]";
	$simpan_jual_beli="$simpan_jual,$simpan_beli";
	$simpan_data=array($simpan_tanggal,$simpan_jual_beli);
	return $simpan_data;
}
?>