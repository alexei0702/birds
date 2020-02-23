function createPolygon (path) {
  return new google.maps.Polygon({
    paths: path,
    strokeColor: '#FF0000',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: '#FF0000',
    fillOpacity: 0.35
  });
}

function initMap() {
  const mapElement = document.getElementById('map');
  const coords = JSON.parse(mapElement.dataset.coords);
  if (coords.length === 0) {
    Swal.fire({
      icon: 'warning',
      text: 'Координаты для этого вида ещё не внесены в базу!'
    });
    return;
  }
  const center = new google.maps.LatLng(52.988843, 108.495045);

  let map = new google.maps.Map(mapElement, {
    zoom: 6,
    center: center
  });

  for (let i = 0; i < coords.length; i++) {
    let poly = createPolygon(coords[i]);
    poly.setMap(map);
  }
}

$(document).ready(function () {
  initMap();
});