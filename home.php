
					<div class="bersih">&nbsp;</div>
					<div class="gr12 judul">Kurs Terbaru</div>
					<div class="bersih">&nbsp;</div>
					<center>
					<h2> Kurs Bank <font color=red>BNI</font> </h2>
					<?php
					$perintah = "SELECT * FROM bni_terbaru"; 
					$hasil = mysql_query($perintah); 
					echo "<table border=1 cellspacing=0 cellpadding=2>";
					echo "<tr><td><b>mata uang</b></td> 
						<td><b>jual</b></td> 
						<td><b>beli</b></td> 
						<td><b>tanggal</b></td></tr>";
					while ($row = mysql_fetch_array($hasil)) { 
						printf("<tr> <td>%s</td> <td>%s</td> <td>%s</td> <td>%s</td> </tr>",
						$row["mata_uang"],
						$row["jual"],
						$row["beli"],
						$row["tanggal"]); 
					}
					echo "</table></center>";
					?>
					</center>
				<div class="bersih">&nbsp;</div>
				<div class="gr12">
					<center>
					<h2> Kurs Bank <font color=red>BCA</font></h2>
					<?php
					$perintah = "SELECT * FROM bca_terbaru"; 
					$hasil = mysql_query($perintah); 
					echo "<table border=1 cellspacing=0 cellpadding=2>";
					echo "<tr>
						<td><b>waktu</b></td> 
						<td><b>mata uang</b></td> 
						<td><b>e-Rate jual</b></td> 
						<td><b>e-Rate beli</b></td> 
						<td><b>TT-Counter jual</b></td> 
						<td><b>TT-Counter beli</b></td> 
						<td><b>bank notes jual</b></td> 
						<td><b>bank notes beli</b></td></tr>";
					while ($row = mysql_fetch_array($hasil)) { 
						printf("<tr> <td>%s</td> <td>%s</td> <td>%s</td> <td>%s</td> <td>%s</td> <td>%s</td> <td>%s</td> <td>%s</td> </tr>", 
						$row["waktu"],
						$row["mata_uang"],
						$row["eRate_jual"],
						$row["eRate_beli"],
						$row["ttCounter_jual"],
						$row["ttCounter_beli"],
						$row["bank_jual"],
						$row["bank_beli"]);
					}
					echo "</table>";
					?>
					</center>
				</div>
				<div class="bersih">&nbsp;</div>
				<div class="gr12">
					<center>
					<h2> Kurs Bank <font color=red>Mandiri</font></h2>
					<?php
					$perintah = "SELECT * FROM mandiri_terbaru"; 
					$hasil = mysql_query($perintah); 
					echo "<table border=1 cellspacing=0 cellpadding=2>";
					echo "<tr><td><b>tanggal</b></td>
						<td><b>mata uang</b></td>
						<td><b>beli</b></td> 
						<td><b>jual</b></td> </tr>";
					while ($row = mysql_fetch_array($hasil)) { 
						printf("<tr> <td>%s</td> <td>%s</td> <td>%s</td> <td>%s</td> </tr>", 
						$row["tanggal"],
						$row["mata_uang"],
						$row["beli"],
						$row["jual"]); 
					}
					echo "</table>";	 
					?>
					</center>
				</div>
				<div class="bersih">&nbsp;</div>
				<div class="gr12">
					<center>
					<h2><font color=red>Keterangan</font></h2>
					<?php
					$perintah = "SELECT * FROM mandiri_terbaru"; 
					$hasil = mysql_query($perintah); 
					echo "<table border=1 cellspacing=0 cellpadding=2>";
					echo "<tr><td><b>singkatan</b></td>
						<td><b>mata uang</b></td></tr>";
					while ($row = mysql_fetch_array($hasil)) { 
						printf("<tr> <td>%s</td> <td>%s</td> </tr>", 
						$row["mata_uang"],
						$row["nama_mata_uang"]); 
					}
					echo "</table>";	 
					?>
					</center>
				</div>
				<div class="bersih">&nbsp;</div>