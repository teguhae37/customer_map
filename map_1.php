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
		showAddress('Jl Hayam Wuruk 45 Kediri','BLC Telkom');
		showAddress('Jl Sersan Bakrun II/26 Mrican Mojoroto Kediri','My Home');
		showAddress('Jl Veteran 1 Mojoroto Kediri','SMAN 1 Kediri');
		showAddress('Jl Hayam Wuruk 46 Kediri','Sri Ratu Kediri');
		showAddress('bogem gurah kediri','Nirus Home');
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

  </body>
</html>
