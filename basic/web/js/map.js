function createPolygon (path) {
  return new google.maps.Polygon({
    paths: path,
    strokeColor: '#FF0000',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: '#FF0000',
    fillOpacity: 0.35
  })
}

function initMap() {  
  $.ajax({
    type:'POST',      
    url:'/basic/web/index.php?r=site/get-coord',
    dataType: 'json',     
    success:function(data){   
      if (!data){
        alert("Координаты для этой особи, увы, ещё не занесены в базу!");
        return;
      }

      let center = new google.maps.LatLng(52.988843, 108.495045);

      let map = new google.maps.Map(document.getElementById('map'), {
        zoom: 6,
        center: center
      });
      for (let i = 0; i < data.length; i++) {
        let poly = createPolygon(data[i]);
        poly.setMap(map);
      }
    },
    error:function(){
      alert("Координаты для этой особи, увы, ещё не занесены в базу!");
    }
  }); 
}