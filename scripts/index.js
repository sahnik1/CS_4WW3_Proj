//obtain the user's location and pass it to a function which will process it
//takes in the obj which called it, that way we can verify which page it came from
function findLocation(obj) {
  if (navigator.geolocation) {
    if (obj.id === "find-location") {
      navigator.geolocation.getCurrentPosition(displayLocationSearchPage);
    } else if (obj.id === "submit-find-me") {
      navigator.geolocation.getCurrentPosition(displayLocationSubmitPage);
    }
  } else {
    alert("Geolocation is not supported by this browser");
  }
}

//enters the user's address into the search bar
function displayLocationSearchPage(location) {
  reverseGeocodeUserAddress(location, "#user-location-search");
}

//enters the user's address into the address text field
function displayLocationSubmitPage(location) {
  reverseGeocodeUserAddress(location, "#address-input");
}

//contact mapquestapi for reverse geolocation to convert lat lon to address
function reverseGeocodeUserAddress(location, id) {
  //compose url by appending latitude and longitude
  let url =
    "https://www.mapquestapi.com/geocoding/v1/reverse?key=HQgoCTT0q3L43jSIZaO1XkFiqYu9f38k&location=" +
    location.coords.latitude +
    "," +
    location.coords.longitude;

  //get request which gets a json file with the information about the user's address based on their latitude and longitude
  //it formats the address to "address, city, province, postal code"
  $.ajax({
    url: url,
    type: "GET",
    dataType: "json",
    success: function (res) {
      $(id).val(
        res["results"][0]["locations"][0]["street"] +
          ", " +
          res["results"][0]["locations"][0]["adminArea5"] +
          ", " +
          res["results"][0]["locations"][0]["adminArea3"] +
          ", " +
          res["results"][0]["locations"][0]["postalCode"]
      );
    },
    error: function (xhr) {
      console.log(xhr);
    },
  });
}

$('.search-form').submit(function(e) {
    // prevents form from being submitted
    e.preventDefault();
    e.returnValue = false;

    let searchLocation = $("#user-location-search").val();
    let searchRating = $("#rating-search").val();

    if(!searchLocation && searchRating !== 'Rating') {
        $(".search-form").append(
          `<input type="hidden" name="rating" id="rating" value=${searchRating}>`
        );
        $('.search-form').off("submit");
        $('.search-form').submit();
    } else if (searchRating === 'Rating' && searchLocation) {
        let url = `http://mapquestapi.com/geocoding/v1/address?key=HQgoCTT0q3L43jSIZaO1XkFiqYu9f38k&location=${searchLocation.replaceAll(
            " ",
            "%20"
        )}`;

        var $form = $(this);

        //get request which gets a json file with the information about the user's address based on their written address
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            context: $form, // it will become this
            success: function (res) {
                $(".search-form").append(
                  `<input type="hidden" name="lat" id="lat" value=${res["results"][0]["locations"][0]["latLng"]["lat"]}>`
                );
                $(".search-form").append(
                  `<input type="hidden" name="lon" id="lon" value=${res["results"][0]["locations"][0]["latLng"]["lng"]}>`
                );
            },
            error: function (xhr) {
                reject(xhr);
            },
            complete: function() {
                this.off('submit');
                this.submit();
            }
        });
    } else {
        alert('Please either submit your location or select a valid rating.');
    }
});