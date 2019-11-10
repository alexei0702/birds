var map;
var myPolygon = [];

function initMap() {
  // Map Center
  var myLatLng = new google.maps.LatLng(52.988843, 108.495045);
  // General Options
  var mapOptions = {
    zoom: 6,
    center: myLatLng,
    //mapTypeId: google.maps.MapTypeId.RoadMap
  };
  map = new google.maps.Map(document.getElementById('map'),mapOptions);
  // Polygon Coordinates
  var triangleCoords = [
    new google.maps.LatLng(52.09141,108.6377),
    new google.maps.LatLng(52.27859,107.67041),
    new google.maps.LatLng(52.70428,108.65869)
  ];
  // Styling & Controls
  let polygon = new google.maps.Polygon({
    paths: triangleCoords,
    draggable: true, // turn off if it gets annoying
    editable: true,
    strokeColor: '#FF0000',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: '#FF0000',
    fillOpacity: 0.35
  });
  polygon.setMap(map);
  myPolygon.push(polygon);
}

$('#get-coords').click(getCoords);
$('#add-polygon').click(addPolygon);


function getCoords () {
  for (let i = 0; i < myPolygon.length; i++) {
    console.log(myPolygon[i].getPath());
  }
}

function addPolygon () {

  // Polygon Coordinates
  var triangleCoords = [
    new google.maps.LatLng(52.09141,108.6377),
    new google.maps.LatLng(52.27859,107.67041),
    new google.maps.LatLng(52.70428,108.65869)
  ];

  let polygon = new google.maps.Polygon({
    paths: triangleCoords,
    draggable: true, // turn off if it gets annoying
    editable: true,
    strokeColor: '#FF0000',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: '#FF0000',
    fillOpacity: 0.35
  }); 

  polygon.setMap(map);

  myPolygon.push(polygon);
}





