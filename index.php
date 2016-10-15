<!DOCTYPE html>
<html>
<head>
	<title>Map</title>
	<link rel="stylesheet" href="leaflet/leaflet.css" />
	<link rel="stylesheet" href="style.css" />
	<script src="leaflet/leaflet-src.js"></script>
	<script src="jQuery/jquery.js"></script>
</head>
<body>

	
<div id="map"></div>

	<script type="text/javascript">
		var latitude = 0;
		var longitude = 0;
		$.getJSON("http://nominatim.openstreetmap.org/search?street=51%20Mehringdamm&format=json",function(json){console.log(json[0])/*latitude = json[0].lat; longitude = json[0].lon}*/});
		var map = L.map('map').setView([latitude, longitude], 13);
		var OpenStreetMap = L.tileLayer('http://{s}.tile.openstreetmap.se/hydda/full/{z}/{x}/{y}.png', { maxZoom: 15, minZoom: 5, attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>' }).addTo(map);
		L.marker([latitude, longitude])
		.bindPopup("<b>Hello world!</b><br>I am a popup.")
		.openPopup()
		.addTo(map);
	</script>

</body>
</html>