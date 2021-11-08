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

//enters the user's address into the search bar
function displayLocationSearchPage(location) {
    getAddress(location, '#user-location-search');
}

//enters the user's address into the address text field
function displayLocationSubmitPage(location) {
    getAddress(location, '#address-input');
}

//contact mapquestapi for reverse geolocatio to convert lat lon to address
function getAddress(location, id) {
    //compose url by appending latitude and longitude
    let url = "http://www.mapquestapi.com/geocoding/v1/reverse?key=HQgoCTT0q3L43jSIZaO1XkFiqYu9f38k&location=" + location.coords.latitude + "," + location.coords.longitude;

    //get request which gets a json file with the information about the user's address based on their latitude and longitude
    //it formats the address to "address, city, province, postal code"
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            $(id).val(
                res["results"][0]["locations"][0]["street"] + 
                ", " + 
                res["results"][0]["locations"][0]["adminArea5"] + 
                ", " + 
                res["results"][0]["locations"][0]["adminArea3"] +
                ", " + 
                res["results"][0]["locations"][0]["postalCode"]);
        },
        error: function(xhr) {
            console.log(xhr)
        }
    });
}