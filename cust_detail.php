<?php
	include 'class_db.php';
	$db = new database();
	include 'class_dropdown.php';
	$dropdown = new dropdown();
	
	$id = $_GET['id'];
	$sql_cust = "SELECT * FROM customer WHERE id='$id'";
	$dat_cust = $db->datasql($sql_cust);
?>
<html>
	<head>
		<title>Customer</title>
		<script type="text/javascript" src="jquery.js"></script>
	</head>
	<body>
		<h2>EDIT Customer</h2>
		<a href='cust_add.php'>TAMBAH</a> 
		<a href='cust.php'>LIHAT</a>
		<hr>
		<form action="cust_proc.php" method="POST" name="addForm" id="addForm" >
			  <table class="cst_table">
				  <tr>
					  <td width="14%">Nama</td><td width="1%">:</td>
					  <td><input type="text" name="nama" id="nama" size="50" value="<?php echo $dat_cust['nama'];?>"></td>
				  </tr>
				  <tr>
					   <td>Alamat</td><td>:</td>
					   <td><textarea name="alamat" rows="2" cols="50"><?php echo $dat_cust['alamat'];?></textarea></td>
				  </tr>
				  <tr>
					  <td colspan="2">&nbsp;</td>
					  <td>
						 RT : <input type="text" name="rt" id="rt" size="3" value="<?php echo $dat_cust['rt'];?>" >&nbsp;
						 RW : <input type="text" name="rw" id="rw"  size="3" value="<?php echo $dat_cust['rw'];?>" >
						 <br>Propinsi<br>
						 <?php
							$sql = "SELECT * FROM propinsi ORDER BY nama";
							$attr = array('name'=>'propinsi_id','sql'=>$sql,'value'=>$dat_cust['propinsi_id']);
							$dropdown->create($attr);
						 ?>
						 <br>Kota/Kab<br>
						 <?php
							$sql = "SELECT * FROM kabupaten WHERE propinsi_id='".$dat_cust['propinsi_id']."' ORDER BY nama";
							$attr = array('name'=>'kabupaten_id','sql'=>$sql,'value'=>$dat_cust['kabupaten_id']);
							$dropdown->create($attr);
						 ?>
						 <br>Kecamatan<br>
						 <?php
							$sql = "SELECT * FROM kecamatan WHERE kabupaten_id='".$dat_cust['kabupaten_id']."' ORDER BY nama";
							$attr = array('name'=>'kecamatan_id','sql'=>$sql,'value'=>$dat_cust['kecamatan_id']);
							$dropdown->create($attr);
						 ?>
						 <br>Desa<br>
						 <?php
							$sql = "SELECT * FROM desa WHERE kecamatan_id='".$dat_cust['kecamatan_id']."' ORDER BY nama";
							$attr = array('name'=>'desa_id','sql'=>$sql,'value'=>$dat_cust['desa_id']);
							$dropdown->create($attr);
						 ?>
					  </td>
				  </tr>
				  <tr>
					  <td>Latitudinal</td><td>:</td>
					  <td><input type="text" name="lat" id="lat" value="<?php echo $dat_cust['lat']?>" size="20"></td>
				  </tr>
				  <tr>
					  <td>Longitudinal</td><td>:</td>
					  <td><input type="text" name="lng" id="lng" value="<?php echo $dat_cust['lng']?>" size="20"></td>
				  </tr>
				  <tr>
					  <td colspan="2">&nbsp;</td>
					  <td>
						  <input type="submit" name="submit_delete" value="Hapus" onclick="return confirm('Yakin?')" />
						  <input type="submit" name="submit_edit" value="Simpan" />
						  <input type="hidden" name="id" value="<?php echo $id;?>" />
					  </td>
				  </tr>
			  </table>
		  </form>
		<hr>
	</body>
</html>
<script type="text/javascript">
$(document).ready(function() {
    $('#nama').focus();
    
    $("#propinsi_id").change(function(){
        var propinsi_id = $("#propinsi_id").val();
        var action = "select_kabupaten";
        $.ajax({
            url: "cust_proc.php",
            type: "post",
            data: "propinsi_id="+propinsi_id+"&action="+action,
            success: function(data){
                $("#kabupaten_id").html(data);
            }
        });
    });

    $("#kabupaten_id").change(function(){
        var kabupaten_id = $("#kabupaten_id").val();
        var action = "select_kecamatan";
        $.ajax({
            url: "cust_proc.php",
            type: "post",
            data: "kabupaten_id="+kabupaten_id+"&action="+action,
            success: function(data){
                $("#kecamatan_id").html(data);
            }
        });
    });

    $("#kecamatan_id").change(function(){
        var kecamatan_id = $("#kecamatan_id").val();
        var action = "select_desa";
        $.ajax({
            url: "cust_proc.php",
            type: "post",
            data: "kecamatan_id="+kecamatan_id+"&action="+action,
            success: function(data){
                $("#desa_id").html(data);
            }
        });
    });

    

});

</script>
