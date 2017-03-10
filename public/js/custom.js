L.MakiMarkers.accessToken = "pk.eyJ1IjoiaXZhbmF0b3JhIiwiYSI6ImNpazd1dmFpbjAwMDF3MW04MjFlMXJ6czMifQ.jeVzm6JIjhsdc5MRhUsd8w";

var map = L.map('map').fitWorld();
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
    maxZoom: 18
}).addTo(map);
var mPlayer = L.marker([0, 0]).addTo(map);
map.locate({setView: true, maxZoom: 16});

var tsLastResourceFetch = 0;
var oResourceMarkerGroup = L.layerGroup().addTo(map);;
var iconFood = L.MakiMarkers.icon({icon: "bakery", color: "#b0b", size: "m"});
var iconWood = L.MakiMarkers.icon({icon: "park", color: "#b0b", size: "m"});
var iconStone = L.MakiMarkers.icon({icon: "square", color: "#b0b", size: "m"});
var iconGold = L.MakiMarkers.icon({icon: "bank", color: "#b0b", size: "m"});

function fnFetchResources() {
    var pos = mPlayer.getLatLng();
    $.ajax({
        url: '/resources/fetch',
        data: {
            lat: pos.lat,
            lng: pos.lng
        },
        success: function(res){
            if (oResourceMarkerGroup){
                oResourceMarkerGroup.clearLayers();
            }
            
            for (var i in res.data){
                var oResourceMarker = L.marker([res.data[i].lat, res.data[i].lng]).addTo(oResourceMarkerGroup);
                switch (res.data[i].type){
                    case 'food': oResourceMarker.setIcon(iconFood); break;
                    case 'wood': oResourceMarker.setIcon(iconWood); break;
                    case 'stone': oResourceMarker.setIcon(iconStone); break;
                    case 'gold': oResourceMarker.setIcon(iconGold); break;
                }
            }
        }
    })
}

function fnMovePlayer(pos) {
    var oNewPosition = L.latLng(pos.coords.latitude, pos.coords.longitude);
    var iDistance = map.getCenter().distanceTo(oNewPosition);

    if (iDistance > 300) {
        map.panTo(oNewPosition);
    }
    mPlayer.setLatLng(oNewPosition);

    var tsNow = parseInt(Date.now() / 1000);
    if (tsNow - tsLastResourceFetch > 10) {
        tsLastResourceFetch = tsNow;
        fnFetchResources();
    }
}

function fnMovePlayerError(err) {
    console.warn('ERROR(' + err.code + '): ' + err.message);
}

var oMovePlayerOptions = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0
};

navigator.geolocation.watchPosition(fnMovePlayer, fnMovePlayerError, oMovePlayerOptions);