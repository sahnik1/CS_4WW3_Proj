//obtain the user's location and pass it to a function which will process it
function findLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(displayLocation);
    } else {
        alert("Geolocation is not support by this browser");
    }
}

//enter the user's coordinates into the search bar and submit the form
function displayLocation(location) {
    var latitudeLongitude = location.coords.latitude + ", " + location.coords.longitude;
    $('#userLocationSearch').val(latitudeLongitude);

    $('#SearchBtn').click();
}