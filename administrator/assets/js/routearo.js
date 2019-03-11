var directionDisplay;
var directionsService = new google.maps.DirectionsService();
var gmarkers = [];
var map = null;
var startLocation = null;
var endLocation = null;
var waypts = null;
var infowindow = new google.maps.InfoWindow({
  size: new google.maps.Size(150, 50)
});

function createMarker(latlng, label, html, color) {
  var contentString = '<b>' + label + '</b><br>' + html;
  var marker = new google.maps.Marker({
    position: latlng,
    map: map,
    title: label,
    label: label,
    zIndex: Math.round(latlng.lat() * -100000) << 5
  });
  marker.myname = label;
  gmarkers.push(marker);

  google.maps.event.addListener(marker, 'click', function() {
    infowindow.setContent(contentString);
    infowindow.open(map, marker);
  });
  return marker;
}

function initialize() {
  directionsDisplay = new google.maps.DirectionsRenderer({
    suppressMarkers: true
  });
  var chicago = new google.maps.LatLng(41.850033, -87.6500523);
  var myOptions = {
    zoom: 6,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: chicago
  }
  map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  directionsDisplay.setMap(map);
  calcRoute();
}

function calcRoute() {
  var request = {
    origin: "Bicknacre",
    destination: "Bicknacre",
    waypoints: [{
      location: new google.maps.LatLng(51.744915, 0.573389),
      stopover: false
    }, {
      location: new google.maps.LatLng(51.775197, 0.592035),
      stopover: false
    }, {
      location: new google.maps.LatLng(51.731653, 0.665789),
      stopover: false
    }, {
      location: new google.maps.LatLng(51.671305, 0.714838),
      stopover: false
    }, {
      location: new google.maps.LatLng(51.65319, 0.601305),
      stopover: false
    }],
    optimizeWaypoints: true,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
      var route = response.routes[0];
      var bounds = new google.maps.LatLngBounds();
      var route = response.routes[0];
      startLocation = new Object();
      endLocation = new Object();
      var polyline = new google.maps.Polyline({
        path: [],
        strokeColor: '#FF0000',
        strokeWeight: 3
      });


      var legs = response.routes[0].legs;
      for (i = 0; i < legs.length; i++) {
        if (i == 0) {
          startLocation.latlng = legs[i].start_location;
          startLocation.address = legs[i].start_address;
        } else {
          waypts[i] = new Object();
          waypts[i].latlng = legs[i].start_location;
          waypts[i].address = legs[i].start_address;
        }
        endLocation.latlng = legs[i].end_location;
        console.log("[" + i + "] " + endLocation.latlng.toUrlValue(6));
        endLocation.address = legs[i].end_address;
        var steps = legs[i].steps;
        for (j = 0; j < steps.length; j++) {
          var nextSegment = steps[j].path;
          for (k = 0; k < nextSegment.length; k++) {
            polyline.getPath().push(nextSegment[k]);
            bounds.extend(nextSegment[k]);
          }
        }
      }
      var waypoints = polyline.GetPointsAtDistance(5000);
      for (var i = 0; i < waypoints.length; i++) {
        createMarker(waypoints[i], "" + (i + 1), (i + 1) * 5 + " km");
      }
    } else {
      alert("directions response " + status);
    }
  });
}
google.maps.event.addDomListener(window, 'load', initialize);
// ported to v3 from the epoly library by Mike Williams
// http://econym.org.uk/gmap/epoly.htm
// === A method which returns an array of GLatLngs of points a given interval along the path ===
google.maps.Polyline.prototype.GetPointsAtDistance = function(metres) {
  var next = metres;
  var points = [];
  // some awkward special cases
  if (metres <= 0) return points;
  var dist = 0;
  var olddist = 0;
  for (var i = 1;
    (i < this.getPath().getLength()); i++) {
    olddist = dist;
    dist += google.maps.geometry.spherical.computeDistanceBetween(this.getPath().getAt(i), this.getPath().getAt(i - 1));
    while (dist > next) {
      var p1 = this.getPath().getAt(i - 1);
      var p2 = this.getPath().getAt(i);
      var m = (next - olddist) / (dist - olddist);
      points.push(new google.maps.LatLng(p1.lat() + (p2.lat() - p1.lat()) * m, p1.lng() + (p2.lng() - p1.lng()) * m));
      next += metres;
    }
  }
  return points;
}