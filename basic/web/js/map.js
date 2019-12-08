var marker;
function initMap() {  
  $.ajax({
    type:'POST',      
    url:'/basic/web/index.php?r=site/get-coord',
    dataType: 'json',     
    success:function(data){   
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 5,
        center: data[data.length-1]
      });
      data.pop();
      var bermudaTriangle = new google.maps.Polygon({
        paths: data,
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#FF0000',
        fillOpacity: 0.35
      });
      bermudaTriangle.setMap(map);
      /*marker = new google.maps.Marker({
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: data
      });
      marker.addListener('click', toggleBounce);*/
    },
    error:function(){
      alert("Координаты для этой особи, увы, ещё не занесены в базу!");
    }
  }); 
}