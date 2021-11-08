//obtain the user's location and pass it to a function which will process it
//takes in the obj which called it, that way we can verify which page it came from
function findLocation(obj) {
    if (navigator.geolocation) {
        if (obj.id === 'find-location') {
            navigator.geolocation.getCurrentPosition(displayLocationSearchPage);
        } else if (obj.id === 'submit-find-me') {
            navigator.geolocation.getCurrentPosition(displayLocationSubmitPage);
        }
    } else {
        alert("Geolocation is not supported by this browser");
    }
}

//enters the user's coordinates into the search bar and submit the form
function displayLocationSearchPage(location) {
    let latitudeLongitude = getCoords(location);
    $('#user-location-search').val(latitudeLongitude);

    $('#search-form-submit').click();
}

//enters the user's coordinates into the address text field
function displayLocationSubmitPage(location) {
    let latitudeLongitude = getCoords(location);
    $('#address-input').val(latitudeLongitude)
}

function getCoords(location) {
    return location.coords.latitude + ", " + location.coords.longitude;
}