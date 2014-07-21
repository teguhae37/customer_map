<?php
	include 'class_db.php';
	$db = new database();
	
	$sql = "SELECT CS.*, DS.nama as desa, KC.nama as kecamatan, KB.nama as kabupaten, PR.nama as propinsi
			FROM customer CS
			JOIN desa DS ON CS.desa_id=DS.id
			JOIN kecamatan KC ON CS.kecamatan_id=KC.id
			JOIN kabupaten KB ON CS.kabupaten_id=KB.id
			JOIN propinsi PR ON CS.propinsi_id=PR.id
			ORDER BY CS.nama";
	$data = $db->fetchdata($sql);
?>

<html>
	<head>
		<title>Customer</title>
	</head>
	<body>
		<h2>Data Customer</h2>
		<a href='cust_add.php'>TAMBAH</a> 
		<a href='cust.php'>LIHAT</a>
		<hr>
		<table width="100%" border="1">
			<thead>
				<tr>
					<td width="3%">No.</td>
					<td width="20%">Nama</td>
					<td>Alamat</td>
					<td width="10%">Latitudinal</td>
					<td width="10%">Longitudinal</td>
				</tr>
			</thead>
			<tbody>
				<?php
					$i = 0;
					foreach($data as $dat){
						$i++;
						$alamat = $dat['alamat'].', RT/RW'.$dat['rt'].'/'.$dat['rw'].', '.$dat['desa'].', ';
						$alamat.= $dat['kecamatan'].', '.$dat['kabupaten'].', '.$dat['propinsi'];
						$lat = $dat['lat'];
						$lng = $dat['lng'];
						echo "<tr>
								<td>".$i."</td>
								<td><a href='cust_detail.php?id=".$dat['id']."'>".$dat['nama']."</a>&nbsp;</td>
								<td>".$alamat."&nbsp;</td>
								<td>".$lat."&nbsp;</td>
								<td>".$lng."&nbsp;</td>
							</tr>";
					}
				?>
			</tbody>
		</table>
		<hr>
	</body>
</html>
