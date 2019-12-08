$('#form-with-map').on('beforeSubmit', function(e) {
    var path = poly.getPath();
    var coords = [];
    for(var i=0;i<path.getLength();i++)
        coords.push(path.getAt(i)); 
    $('#coord').val(coords);
});

var map;
var myPolygon = [];

function startCoords () {
  const triangleCoords = [
    new google.maps.LatLng(52.09141,108.6377),
    new google.maps.LatLng(52.27859,107.67041),
    new google.maps.LatLng(52.70428,108.65869)
  ];
  return triangleCoords;
}

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
  // Styling & Controls
  let polygon = new google.maps.Polygon({
    paths: startCoords(),
    draggable: true, // turn off if it gets annoying
    editable: true,
    strokeColor: '#FF0000',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: '#FF0000',
    fillOpacity: 0.35
  });
  polygon.setMap(map);
  google.maps.event.addListener(polygon, 'click', removePolygon);
  myPolygon.push(polygon);
}

$('#get-coords').click(getCoords);
$('#add-polygon').click(addPolygon);


function getCoords () {
  for (let i = 0; i < myPolygon.length; i++) {
    let poly = myPolygon[i].getPath();
    for (let j = 0; j < poly.length; j++) {
      console.log(`Polygon # ${i}: (${poly.getAt(j).lat()},${poly.getAt(j).lng()})`)
    }
  }
}

function addPolygon () {

  let polygon = new google.maps.Polygon({
    paths: startCoords(),
    draggable: true, // turn off if it gets annoying
    editable: true,
    strokeColor: '#FF0000',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: '#FF0000',
    fillOpacity: 0.35
  }); 

  polygon.setMap(map);
  google.maps.event.addListener(polygon, 'click', removePolygon);
  myPolygon.push(polygon);
}

function removePolygon () {
  if (window.event.ctrlKey) {
    let index = myPolygon.indexOf(this);
    if(index !== -1) {
      myPolygon.splice(index, 1);
    }
    this.setMap(null);
  }
}




