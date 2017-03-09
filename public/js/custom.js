var map = L.map('map').fitWorld();

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
    maxZoom: 18
}).addTo(map);

map.locate({setView: true, maxZoom: 16});

//function onLocationFound(e) {
//    console.log(e)
//    var radius = e.accuracy / 2;
//
//    L.marker(e.latlng).addTo(map)
//        .bindPopup("You are within " + radius + " meters from this point").openPopup();
//
//    L.circle(e.latlng, radius).addTo(map);
//}
//
//map.on('locationfound', onLocationFound);

function success(pos){
    console.log('pos', pos)
    L.marker([pos.coords.latitude, pos.coords.longitude]).addTo(map)
}

function error(err) {
  console.warn('ERROR(' + err.code + '): ' + err.message);
}

var options = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 0
};

navigator.geolocation.watchPosition(success, error, options);