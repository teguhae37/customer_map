<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
 Copyright 2008 Google Inc. 
 Licensed under the Apache License, Version 2.0: 
 http://www.apache.org/licenses/LICENSE-2.0 
 -->
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
	<title>Customer Maps</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<meta name="description" content="customer map - php indonesia kediri">
	<meta name="author" content="teguhae37@gmail.com" >
    <script 
		src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyCCozHnZDqprb-O-sWBAhH7uIxqkcGS0DU" 
		type="text/javascript">
    </script>
    
    <script type="text/javascript">

    var map = null;
    var geocoder = null;

    function initialize() {
      if (GBrowserIsCompatible()) {
        map = new GMap2(document.getElementById("map_canvas"));
        map.setUIToDefault();
        geocoder = new GClientGeocoder();
      }
    }

    function showAddress(address,name) {
      if (geocoder) {
        geocoder.getLatLng(
          address,function(point) {
	            if (!point) {
	              alert(address + " not found");
	            } else {
	              map.setCenter(point, 13);
	              
	              var marker = new GMarker(point, {draggable: false});
	              map.addOverlay(marker);
	
	            GEvent.addListener(marker, "dragend", function() {
	                	marker.openInfoWindowHtml(marker.getLatLng().toUrlValue(6));
	              });
	              GEvent.addListener(marker, "click", function() {
	                	//marker.openInfoWindowHtml(marker.getLatLng().toUrlValue(6));
	                	marker.openInfoWindowHtml(name+"<br>"+marker.getLatLng().toUrlValue(6));
	              });
		      GEvent.trigger(marker, "click");
	            }
	          }
        );
      }
    }
    
    function show_all_address(){
		<?php
	if(isset($_POST['proses'])){
			include 'class_db.php';
			$db = new database();
			
			$sql = "SELECT CS.*, DS.nama as desa, KC.nama as kecamatan, 
					KB.nama as kabupaten, PR.nama as propinsi
					FROM customer CS
					JOIN desa DS ON CS.desa_id=DS.id
					JOIN kecamatan KC ON CS.kecamatan_id=KC.id
					JOIN kabupaten KB ON CS.kabupaten_id=KB.id
					JOIN propinsi PR ON CS.propinsi_id=PR.id
					";
			$data = $db->fetchdata($sql);
			foreach($data as $dat){
				$nama = $dat['nama'];				
				$alamat = strtolower($dat['alamat']).' ';
				$alamat.= strtolower($dat['desa']).' '.strtolower($dat['kecamatan']).' '.strtolower($dat['kabupaten']);
				$alamat.= ' '.strtolower($dat['propinsi'].' Indonesia');
				
				$alamat_label = $dat['alamat'].' RT/RW '.$dat['rt'].'/'.$dat['rw'].' ';
				$alamat_label.= $dat['desa'].' '.$dat['kecamatan'].' '.$dat['kabupaten'];
				
				
				echo "showAddress('".$alamat."','".$nama.'<br>'.$alamat_label."');";
			}
			
		}
		?>
	}
	
    </script>
  </head>

  <body onload="initialize(); 
	<?php 
		if(isset($_POST['proses'])) 
			echo "show_all_address()"; 
		else 
			echo "showAddress('kediri east java','Kediri Jawa Timur')";
	?>" 
	onunload="GUnload(); ">
	  <h2>Customer Map</h2>
    <form name="map" method="POST" action="#">
        <input type="submit" name="proses" id="proses" value="VIEW" />
      <div id="map_canvas" style="width: 100%; height: 500px"></div>
    </form>
    <br>
	<em>Note: lokasi diambil dari alamat</em>
  </body>
</html>
