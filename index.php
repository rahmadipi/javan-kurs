<?php
	include "koneksi.php";
	$limit="limit 0,5";
	if (isset($_GET['menu'])){
		$menu = $_GET['menu'];
		if($menu!="BNI"&&$menu!="BCA"&&$menu!="Mandiri"){
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
		<script src="script/highcharts.js" type="text/javascript"></script>
		<script src="script/exporting.js"  type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		

	</head>
	<body onLoad="fixed()">
		<div class="logo">
			<a href='?'><div></div></a>
		</div>
		<div class="bersih">&nbsp;</div>
		<div id=menubar-clone></div>
		<div class=menubar id="menubar">
			<center>
				<?php
				echo "
				<ul>
					<li><a href='?'>Home</a>
					<li><a href='?menu=BNI'>BNI</a>
					<li><a href='?menu=BCA'>BCA</a>
					<li><a href='?menu=Mandiri'>Mandiri</a>
				</ul>
				";
				?>
			</center>
		</div>
		<div class="bersih">&nbsp;</div>
		<div class="grid">
			<div class="gr12 konten">
				<?php
				include "$menu.php";
				?>
			</div>
		</div>
	</body>
</html>