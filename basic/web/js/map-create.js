let map,
  polygons = [];

$('#form-with-map').on('submit', function() {
  let coords = getCoords();
  $('#coords').val(JSON.stringify(coords));
});

function startCoords () {
  return [
    new google.maps.LatLng(52.09141, 108.6377),
    new google.maps.LatLng(52.27859, 107.67041),
    new google.maps.LatLng(52.70428, 108.65869)
  ];
}

function createPolygon (path) {
  return new google.maps.Polygon({
    paths: path,
    draggable: true, // turn off if it gets annoying
    editable: true,
    strokeColor: '#FF0000',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: '#FF0000',
    fillOpacity: 0.35
  });
}

function initMap() {
  // Map Center
  const myLatLng = new google.maps.LatLng(52.988843, 108.495045);
  // General Options
  const mapOptions = {
    zoom: 6,
    center: myLatLng,
    //mapTypeId: google.maps.MapTypeId.RoadMap
  };
  map = new google.maps.Map(document.getElementById('map'), mapOptions);

  const mapElement = document.getElementById('map');
  const coords = JSON.parse(mapElement.dataset.coords);

  if(coords.length > 0)
    for (let i = 0; i < coords.length; i++) {
      let poly = createPolygon(coords[i]);
      poly.setMap(map);
      google.maps.event.addListener(poly, 'click', removePolygon);
      polygons.push(poly);
    }
  else {
    let poly = createPolygon(startCoords());
    poly.setMap(map);
    google.maps.event.addListener(poly, 'click', removePolygon);
    polygons.push(poly);
  }
}

$('#add-polygon').click(addPolygon);

function getCoords () {
  let result = [];
  for (let i = 0; i < polygons.length; i++) {
    let poly = polygons[i].getPath();
    result[i] = [];
    for (let j = 0; j < poly.length; j++) {
      result[i].push({lat: poly.getAt(j).lat(), lng: poly.getAt(j).lng()});
    }
  }
  return result;
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
  polygons.push(polygon);
}

function removePolygon () {
  if (window.event.ctrlKey) {
    let index = polygons.indexOf(this);
    if(index !== -1) {
      polygons.splice(index, 1);
    }
    this.setMap(null);
  }
}

$(document).ready(function () {
  initMap();
});


