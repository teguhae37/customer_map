<?php
	include 'class_db.php';
	$db = new database();
	include 'class_dropdown.php';
	$dropdown = new dropdown();
?>
<html>
	<head>
		<title>Customer</title>
		<script type="text/javascript" src="jquery.js"></script>
	</head>
	<body>
		<h2>Tambah Customer</h2>
		<a href='cust_add.php'>TAMBAH</a> 
		<a href='cust.php'>LIHAT</a>
		<hr>
		<form action="cust_proc.php" method="POST" name="addForm" id="addForm" >
			  <table class="cst_table">
				  <tr>
					  <td width="14%">Nama</td><td width="1%">:</td>
					  <td><input type="text" name="nama" id="nama" size="50"></td>
				  </tr>
				  <tr>
					   <td>Alamat</td><td>:</td>
					   <td><textarea name="alamat" rows="2" cols="50"></textarea></td>
				  </tr>
				  <tr>
					  <td colspan="2">&nbsp;</td>
					  <td>
						 RT : <input type="text" name="rt" id="rt" size="3" >&nbsp;
						 RW : <input type="text" name="rw" id="rw"  size="3" >
						 <br>Propinsi<br>
						 <?php
							$sql = "SELECT * FROM propinsi ORDER BY nama";
							$attr = array('name'=>'propinsi_id','sql'=>$sql);
							$dropdown->create($attr);
						 ?>
						 <br>Kota/Kab<br>
						 <select name="kabupaten_id" id="kabupaten_id" class="span3">
						  <option value="">Pilih</option>
						</select>
						 <br>Kecamatan<br>
						 <select name="kecamatan_id" id="kecamatan_id" class="span3">
						  <option value="">Pilih</option>
						</select>
						 <br>Desa<br>
						 <select name="desa_id" id="desa_id" class="span3">
						  <option value="">Pilih</option>
						</select>
					  </td>
				  </tr>
				  <tr>
					  <td>Latitudinal</td><td>:</td>
					  <td><input type="text" name="lat" id="lat" size="20"></td>
				  </tr>
				  <tr>
					  <td>Longitudinal</td><td>:</td>
					  <td><input type="text" name="lng" id="lng" size="20"></td>
				  </tr>
				  <tr>
					  <td colspan="2">&nbsp;</td>
					  <td>
						  <input type="submit" name="submit_add" value="Simpan" />
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
