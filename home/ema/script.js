// Initialize the map and set the hospital's location
function initMap() {
  const hospitalLocation = { lat: 40.730610, lng: -73.935242 }; // Replace with your hospital's coordinates
  const map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
    center: hospitalLocation
  });

  const marker = new google.maps.Marker({
    position: hospitalLocation,
    map: map,
    title: 'Hospital'
  });
}

// Get user's current location and provide directions
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else {
    alert("Geolocation is not supported by this browser.");
  }
}

// Show position and redirect to Google Maps
function showPosition(position) {
  const userLat = position.coords.latitude;
  const userLng = position.coords.longitude;
  window.open(`https://www.google.com/maps/dir/?api=1&destination=40.730610,-73.935242&origin=${userLat},${userLng}&travelmode=driving`, '_blank');
}

function showError(error) {
  switch(error.code) {
    case error.PERMISSION_DENIED:
      alert("User denied the request for Geolocation.");
      break;
    case error.POSITION_UNAVAILABLE:
      alert("Location information is unavailable.");
      break;
    case error.TIMEOUT:
      alert("The request to get user location timed out.");
      break;
    case error.UNKNOWN_ERROR:
      alert("An unknown error occurred.");
      break;
  }
}
