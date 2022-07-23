window.lat = 15.3916934;
window.lng = 75.0235759;
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
function trackAmbulance(driverID)
{
    $("#map-canvas").show();
    getLiveDriverLocation = setInterval(function(){
        $.ajax({
            type:"POST",
            url:"utilities/getLocations.php",
            data: {userID: driverID},
            dataType:"html",
            success: function(data)
            {
                positionObj = JSON.parse(data);
                reposition({lat:parseFloat(positionObj.lat), lng:parseFloat(positionObj.lng)});
                if($("#myModal-three").css("display")=="none")
                {
                    stopLive();
                }
            }
        });
    }, 5000);
}
function stopLive()
{
    clearInterval(getLiveDriverLocation);
}