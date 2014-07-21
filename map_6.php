<html>
<head>
  
  <title>Google Maps Multiple Markers</title>
  <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
</head>
<body>
  <h2>Customer Map</h2>
  
    <form name="map" method="POST" action="#">
        <input type="submit" name="proses" id="proses" value="VIEW" />
    <div id="map-canvas" style="width: 100%; height: 500px"></div>
    </form>
	<em>Note: lokasi diambil dari koordinat latitudinal lognitudinal</em>
<script type="text/javascript">
    var locations = [
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
					$i = 0;
					foreach($data as $dat){
						$i++;
						if($dat['lat']!='' || $dat['lng']!=''){
							$nama = $dat['nama'];				
							$alamat = strtolower($dat['alamat']).' ';
							$alamat.= strtolower($dat['desa']).' '.strtolower($dat['kecamatan']).' '.strtolower($dat['kabupaten']);
							$alamat.= ' '.strtolower($dat['propinsi'].' Indonesia');
							
							$alamat_label = $dat['alamat'].' RT/RW '.$dat['rt'].'/'.$dat['rw'].' ';
							$alamat_label.= $dat['desa'].' '.$dat['kecamatan'].' '.$dat['kabupaten'];
							$lat = $dat['lat'];
							$lng = $dat['lng'];
							
							echo " ['".$nama."','".$alamat."', ".$lat.", ".$lng.", ".$i."],";
						}
					}
					
				}
			?>
			
    ];
 
    var map = new google.maps.Map(document.getElementById('map-canvas'), {
      zoom: 15,
      center: new google.maps.LatLng(-7.814448,112.011555),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
 
    var infowindow = new google.maps.InfoWindow();
 
    var marker, i;
 
    for (i = 0; i < locations.length; i++) { 
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][2], locations[i][3]),
        title: locations[i][0],
        map: map
      });
 
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]+'<br>'+locations[i][1]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
</body>
</html>
