<?php
	include 'class_db.php';
	$db = new database();
	include 'class_dropdown.php';
	$dropdown = new dropdown();
	
	if(isset($_POST['id']))
		$id = $_POST['id'];
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$rt = $_POST['rt'];
	$rw = $_POST['rw'];
	$desa_id = $_POST['desa_id'];
	$kecamatan_id = $_POST['kecamatan_id'];
	$kabupaten_id = $_POST['kabupaten_id'];
	$propinsi_id = $_POST['propinsi_id'];
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	
	if(isset($_POST['submit_add'])){
		$sql = "INSERT INTO customer
				(nama,alamat,rt,rw,desa_id,kecamatan_id,kabupaten_id,propinsi_id,lat,lng)
				VALUES
				('$nama','$alamat','$rt','$rw','$desa_id','$kecamatan_id','$kabupaten_id','$propinsi_id','$lat','$lng')";
		if(!$res = $db->sqlquery($sql))
			die($sql.mysql_error());
		else{
			header("Location: cust_add.php");
			exit();
		}
	}
	
	if(isset($_POST['submit_edit'])){
		$sql = "UPDATE customer
				SET
				nama='$nama',alamat='$alamat',rt='$rt',rw='$rw',desa_id='$desa_id',kecamatan_id='$kecamatan_id',
				kabupaten_id='$kabupaten_id',propinsi_id='$propinsi_id',lat='$lat',lng='$lng' 
				WHERE id='$id'";
		if(!$res = $db->sqlquery($sql))
			die($sql.mysql_error());
		else{
			header("Location: cust.php");
			exit();
		}
	}
	
	if(isset($_POST['submit_delete'])){
		$sql = "DELETE FROM customer
				WHERE id='$id'";
		if(!$res = $db->sqlquery($sql))
			die($sql.mysql_error());
		else{
			header("Location: cust.php");
			exit();
		}
	}
	
	//============================ CHAIN COMBOBOX ======================================
	if(isset($_POST['action']) && $_POST['action'] == "select_kabupaten"){
		$propinsi_id = $_POST['propinsi_id'];
			
		$sql = "SELECT * FROM kabupaten WHERE propinsi_id='".$propinsi_id."' ORDER BY nama";
		$data = $db->fetchdata($sql);
		echo "<option value=''>Pilih</option>";
		foreach ($data as $dat) {
			echo "<option value='".$dat['id']."'>".$dat['nama']."</option>";
		}
	}
	if(isset($_POST['action']) && $_POST['action'] == "select_kecamatan"){
		$kabupaten_id = $_POST['kabupaten_id'];
			
		$sql = "SELECT * FROM kecamatan WHERE kabupaten_id='".$kabupaten_id."' ORDER BY nama";
		$data = $db->fetchdata($sql);
		echo "<option value=''>Pilih</option>";
		foreach ($data as $dat) {
			echo "<option value='".$dat['id']."'>".$dat['nama']."</option>";
		}
	}
	if(isset($_POST['action']) && $_POST['action'] == "select_desa"){
		$kecamatan_id = $_POST['kecamatan_id'];
			
		$sql = "SELECT * FROM desa WHERE kecamatan_id='".$kecamatan_id."' ORDER BY nama";
		$data = $db->fetchdata($sql);
		echo "<option value=''>Pilih</option>";
		foreach ($data as $dat) {
			echo "<option value='".$dat['id']."'>".$dat['nama']."</option>";
		}
	}
	
?>
