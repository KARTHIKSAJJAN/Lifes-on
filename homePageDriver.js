window.lat = 15.3916934;
window.lng = 75.0235759;
var liveStatus = "inactive";
var start = 1;
function getLocation()
{
    if (navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(updatePosition);
    }
    return null;
};
function updatePosition(position)
{
  if (position)
  {
    window.lat = position.coords.latitude;
    window.lng = position.coords.longitude;
  }
}
function currentLocation()
{
  return {lat:window.lat, lng:window.lng};
}
updatePosition(getLocation());
var map, mark;
var initialize = function()
{
  map  = new google.maps.Map(document.getElementById('map-canvas'), {center:{lat:lat,lng:lng},zoom:19, zoomControl: true, mapTypeControl: true, scaleControl: true, streetViewControl: true, rotateControl: true, fullscreenControl: true});
  mark = new google.maps.Marker({position:{lat:lat, lng:lng}, map:map, title:"Emergency!", icon:"assets/mapMarker.gif"});
};
window.initialize = initialize;
var reposition = function(location) {
    lat = location.lat;
    lng = location.lng;
    map.setCenter({lat:lat, lng:lng, alt:0});
    mark.setPosition({lat:lat, lng:lng, alt:0});
};
window.addEventListener("beforeunload", function () {
    $.post("utilities/stopSharing.php", {});
});
togglelive();
function togglelive()
{
    if(liveStatus=="inactive" && start==0)
    {
        clearInterval(getNormalLiveLocation);
        liveStatus = "sharing";
        liveButton = document.getElementById("offerButton");
        liveButton.style.backgroundColor = "red";
        liveButton.innerHTML = "Sharing your live location...(click here to end the live sharing)";
        getSharingLiveLocation = setInterval(function(){updatePosition(getLocation()); $.post("utilities/driverLive.php", {latitude: window.lat, longitude: window.lng});}, 5000);
    }
    else if(liveStatus=="sharing")
    {
        clearInterval(getSharingLiveLocation);
        liveStatus = "inactive";
        liveButton = document.getElementById("offerButton");
        liveButton.style.backgroundColor = "#4255d4";
        liveButton.innerHTML = "Share Live Location to the Authorities";
        $.post("utilities/stopSharing.php", {});
        getNormalLiveLocation = setInterval(function(){start = 0; updatePosition(getLocation()); reposition({lat:window.lat, lng:window.lng})}, 5000);
    }
    else
    {
        getNormalLiveLocation = setInterval(function(){start = 0; updatePosition(getLocation()); reposition({lat:window.lat, lng:window.lng})}, 5000);
    }
}