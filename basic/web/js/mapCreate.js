$('#form-with-map').on('beforeSubmit', function(e) {
    var path = poly.getPath();
    var coords = [];
    for(var i=0;i<path.getLength();i++)
        coords.push(path.getAt(i)); 
    $('#coord').val(coords);
});


// This example creates an interactive map which constructs a polyline based on
// user clicks. Note that the polyline only appears once its path property
// contains two LatLng coordinates.
var poly;
var map;
var mar = [];
$('#map-clear').click(function(){
  var path = poly.getPath();
  for(var i=0;i<mar.length;i++){
    path.pop();
    var marker = mar.pop();
    marker.setMap(null);
    marker = null;
  }
});

$('#erase-last-marker').click(function(){
  var path = poly.getPath();
  path.pop();
  var marker = mar.pop();
  marker.setMap(null);
  marker = null;
});
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 5,
    center: {lat:53.248006,lng: 110.281535}
  });

  poly = new google.maps.Polyline({
    strokeColor: '#000000',
    strokeOpacity: 1.0,
    strokeWeight: 3
  });
  poly.setMap(map);

  // Add a listener for the click event
  map.addListener('click', addLatLng);
}

// Handles click events on a map, and adds a new point to the Polyline.
function addLatLng(event) {
  var path = poly.getPath();

  // Because path is an MVCArray, we can simply append a new coordinate
  // and it will automatically appear.
  path.push(event.latLng);
  // Add a new marker at the new plotted point on the polyline.
  var marker = new google.maps.Marker({
    position: event.latLng,
    title: '#' + path.getLength(),
    map: map
  });
  mar.push(marker);
}
