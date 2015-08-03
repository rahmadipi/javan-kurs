<form method="post" action="">
	<div class="bersih">&nbsp;</div>
	<div class="gr12 judul">Filter</div>
	<div class="bersih">&nbsp;</div>
	<div class="gr12">
		<div class="gr3">
			<label for="mata_uang" class="gr6"> Mata Uang </label>
			<select name="mata_uang" class="gr6">
			<?php
			$query="select mata_uang from $menu group by mata_uang";
			$sql=mysql_query($query);
			while($hasil=mysql_fetch_array($sql)){
				$mata_uang=$hasil['mata_uang'];
				echo "
				<option value='$mata_uang'>$mata_uang</option>
				";
			}
			?>
			</select>
		</div>
		<div class="gr4">
			<label for="tgl_awal" class="gr6"> Dari Tanggal </label>
			<input type="text" id="tgl_awal" name="tgl_awal" class="gr6">
		</div>
		<div class="gr4">
			<label for="tgl_akhir" class="gr6"> Sampai Tanggal </label>
			<input type="text" id="tgl_akhir" name="tgl_akhir" class="gr6">
		</div>
		<div class="gr1">
			<input type="submit" value="Filter" name="filter" class="gr12">
		</div>
	</div>
</form>
	<?php
	if(isset($_POST['filter'])){
		if($menu=='mandiri'||$menu=='bni'){
			$filter_hasil=filter($menu,$_POST['mata_uang'],$_POST['tgl_awal'],$_POST['tgl_akhir']);
			
			$filter_jual_beli="[$filter_hasil[1]]";
			$filter_tanggal=$filter_hasil[0];
		}
		elseif($menu=='bca'){
			$filter_hasil1=filter('bca_banknotes',$_POST['mata_uang'],$_POST['tgl_awal'],$_POST['tgl_akhir']);	
			$filter_hasil2=filter('bca_erate',$_POST['mata_uang'],$_POST['tgl_awal'],$_POST['tgl_akhir']);	
			$filter_hasil3=filter('bca_ttcounter',$_POST['mata_uang'],$_POST['tgl_awal'],$_POST['tgl_akhir']);	
			
			$filter_jual_beli="[$filter_hasil1[1],$filter_hasil2[1],$filter_hasil3[1]]";
			$filter_tanggal=$filter_hasil3[0];
		}
		$mata_uang=$_POST['mata_uang'];
		$tgl_awal=$_POST['tgl_awal'];
		$tgl_akhir=$_POST['tgl_akhir'];
		echo"
		<br>
		<hr class='gr12'/>
		<br>
		<div id='hasil_filter' class='gr12'></div>
		";
	?>
		<script type="text/javascript">
		$(function () {
			var chart;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'hasil_filter',
						type: 'line',
						marginRight: 180,
						marginBottom: 100
					},
					title: {
						text: <?php echo "'Data Kurs Rupiah(Rp) Bank $menu mata uang $mata_uang'"; ?>,
						x: -20 //center
					},
					subtitle: {
						text: <?php echo "'dari tanggal $tgl_awal sampai $tgl_akhir'"; ?>,
						x: -20
					},
					xAxis: {
						categories:<?php echo $filter_tanggal; ?>
					},
					yAxis: {
						title: {
							text: 'Nilai Kurs'
						},
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}]
					},
					tooltip: {
						valueSuffix: ''
					},
					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'top',
						x: -10,
						y: 100,
						borderWidth: 0
					},
					series:<?php echo $filter_jual_beli; ?>
        });
			});
		});
		</script>
	<?php
	}
	?>