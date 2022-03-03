// JavaScript Document

 function initialize() {
  var myLatlng = new google.maps.LatLng(37.68777545641296, 127.0543628837559);
  var myOptions = {
   zoom: 15,
   center: myLatlng

  }
  var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
 
  var marker = new google.maps.Marker({
   position: myLatlng, 
   map: map, 
   title:"(주)그린컴퓨터아트학원"
  });   
  
 
  var infowindow = new google.maps.InfoWindow({
   content: "우리집주소~~~~전번~~~"
  });
 
  infowindow.open(map,marker);
 }
 
 
 window.onload=function(){
  initialize();
 }

