<html>
	<head>
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
	<body>
		<form method="post" action="proses_filter.php">
			<div>
				<label for="tgl_awal"> Dari Tanggal </label>
				<input type="text" id="tgl_awal" name="tgl_awal">&nbsp;&nbsp;
				<label for="tgl_akhir"> Sampai Tanggal </label>
				<input type="text" id="tgl_akhir" name="tgl_akhir">
			</div>
			<input type="submit" value="Cari">
		</form>
	</body>
</html>