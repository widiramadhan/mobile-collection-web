<?php
include"../config/connection.php";

$query = "{call TEST_DELETE_SOON}";  
$exec = sqlsrv_query( $conn, $query) or die( print_r( sqlsrv_errors(), true));
$no=0;
?>
<div id="map" style="width:100%;height:100%;"></div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyDOC4niTnX8QwoxCeEZYjGpOPtKJN3BGQk"></script>
<script>
var geocoder;
var map;
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var locations = [
<?php 
	while($data = sqlsrv_fetch_array($exec)){
		$no++;
		
?>
	['Manly Beach', <?php echo $data['LAT'];?>,  <?php echo $data['LNG'];?>, <?php echo $no;?>],
<?php } ?>
];

function initialize() {
  directionsDisplay = new google.maps.DirectionsRenderer();


  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: new google.maps.LatLng(-33.92, 151.25),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  directionsDisplay.setMap(map);
  var infowindow = new google.maps.InfoWindow();

  var marker, i;
  var request = {
    travelMode: google.maps.TravelMode.DRIVING
  };
  for (i = 0; i < locations.length; i++) {
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
    });

    google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
        infowindow.setContent(locations[i][0]);
        infowindow.open(map, marker);
      }
    })(marker, i));

    if (i == 0) request.origin = marker.getPosition();
    else if (i == locations.length - 1) request.destination = marker.getPosition();
    else {
      if (!request.waypoints) request.waypoints = [];
      request.waypoints.push({
        location: marker.getPosition(),
        stopover: true
      });
    }

  }
  directionsService.route(request, function(result, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(result);
    }
  });
}
google.maps.event.addDomListener(window, "load", initialize);
</script>