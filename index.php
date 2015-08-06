<?php
	include "koneksi.php";
	include "filter.php";
	$limit="limit 0,12";
	if (isset($_GET['menu'])){
		$menu = $_GET['menu'];
		if($menu!="bni"&&$menu!="bca"&&$menu!="mandiri"){
			$menu="home";
		}
	}
	else {
		$menu="home";
	}	
?>
<html>
	<head>
		<title>Kurs</title>
		<script src="script/jquery.min.js" type="text/javascript"></script>
		<script src="script/script.js" type="text/javascript"></script>
		<!--script src="script/highcharts.js" type="text/javascript"></script>
		<script src="script/exporting.js"  type="text/javascript"></script-->
		<script src="script/stock/highstock.js"  type="text/javascript"></script>
		<script src="script/stock/exporting.js"  type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="shortcut icon" href="gambar/rp.ico"/>
		
		<link type="text/css" href="development-bundle/themes/base/ui.all.css" rel="stylesheet" />
		<script type="text/javascript" src="development-bundle/jquery-1.3.2.js"></script>
		<script type="text/javascript" src="development-bundle/ui/ui.core.js"></script>
		<script type="text/javascript" src="development-bundle/ui/ui.datepicker.js"></script>
		<script type="text/javascript" src="development-bundle/ui/i18n/ui.datepicker-id.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#tgl_awal").datepicker({
					altFormat : "dd MM yy",
					changeMonth : true,
					changeYear : true
				});
				$("#tgl_awal").change(function(){
					$("#tgl_awal").datepicker("option","dateFormat","yy-mm-dd");
				});
			});
		</script>	
		<script type="text/javascript">
			$(document).ready(function(){
				$("#tgl_akhir").datepicker({
					altFormat : "dd MM yy",
					changeMonth : true,
					changeYear : true
				});
				$("#tgl_akhir").change(function(){
					$("#tgl_akhir").datepicker("option","dateFormat","yy-mm-dd");
				});
			});
		</script>		
		
	</head>
	<body onLoad="fixed(),jam()">
		<div class="logo">
			<a href='<?php echo $_SERVER['SCRIPT_NAME']; ?>'><div></div></a>
		</div>
		<div class="bersih">&nbsp;</div>
		<div id=menubar-clone></div>
		<div class=menubar id="menubar">
			<div id="jam"></div>
			<center>
			<?php
			echo "
			<ul>
				<li><a href='".$_SERVER['SCRIPT_NAME']."'>Home</a>
				<li><a href='?menu=bni'>BNI</a>
				<li><a href='?menu=bca'>BCA</a>
				<li><a href='?menu=mandiri'>Mandiri</a>
			</ul>
			";
			?>
			</center>
		</div>
		<div class="bersih">&nbsp;</div>
		<div class="grid">
			<div class="gr12 konten">
				<div class=grid>
				<?php
				if($menu!='home'){
					include "filter_form.php";
				}
				include "$menu.php";
				?>
				</div>
			</div>
		</div>
	</body>
</html>