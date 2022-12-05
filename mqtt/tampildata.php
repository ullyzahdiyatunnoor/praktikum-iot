<link rel="stylesheet" 
href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" 
integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<?php
//konfigurasi database
$host     = "localhost";
$user 	  = "root";
$password = "";
$database = "iot";
//perintah php untuk akses ke database
$koneksi = mysqli_connect($host, $user, $password, $database);
?>

<center>
	<h2>DATA SUHU</h2>
</center>

<table border="1" class="table table-striped">
	<thead class="thead-dark">
		<tr><th>TANGGAL</th><th> SUHU </th> <th> KETERANGAN </th> </tr>
	</thead>
		<?php
		$data = mysqli_query($koneksi, "SELECT * from suhu");
		$no=1;
		foreach ($data as $row) {
			echo "<tr>";
	if ($row['suhu']>30) $ket="PANAS"; else $ket="NORMAL";
	echo "
				<td>".$row['jam']."</td>
				<td>".$row['suhu']."</td>
				<td>".$ket."</td>
				  </tr>";
		$no++;

	$jamx[]= @$row['jam'];
	$suhux[]=  @$row['suhu'];
		}

	$jam_json=json_encode($jamx); $suhu_json=json_encode($suhux);
	 ?>
</table>

<div>
	<canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
	const ctx = document.getElementById('myChart');

	new Chart(ctx, {
		type: 'bar',
		data: {
		labels: <?=$jam_json; ?>
		  datasets: [{
		  	label: '# SUHU',
	data: <?=$suhu_json;?>
		  borderWidht: 1
		  }]
		},
		options: {
		  scales: {
		   y: {
		   	beginAtZero: true
		   }
			}
		}
	});
</script>