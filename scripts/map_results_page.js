$(document).ready(function () {
    let userLatitude;
    let userLongitude;

    if($("#lat") && $("#lon").length) {
        userLatitude = $("#lat").val();
        userLongitude = $("#lon").val();
    } else {
        //use Mcmaster as default
        userLatitude = 43.257865;
        userLongitude = -79.918617;
    }
  // Main instantiation for the Map, Results-Map is the div we target to place the map in
  var map = L.map("Results-Map", {
    // Center is the focal point of the map for the default view on load
    // These Long/Lat refer to central Oakville
    center: [userLatitude, userLongitude],
    minZoom: 2,
    // This is a Cities level Zoom, enough to see neighboring cities and areas
    zoom: 10,
  });

  L.tileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
      '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    subdomains: ["a", "b", "c"],
  }).addTo(map);

  // Custom Icon for 'Paw' print marker, credit goes to Google Earth (although I dont think they care)
  var pawIcon = L.icon({
    iconUrl:
      "https://www.gstatic.com/earth/images/stockicons/190201-2016-animal-paw_4x.png",
    iconSize: [64, 64], // size of the icon
  });

  // Custom Markers, Show the location of Various Dog Parks (Imaginary),
  // each shows popup when clicked which contains a link to the object page as well as the Park's Address

  $("tbody")
    .find("a")
    .each(function () {
      L.marker(
        [
          parseFloat($(this).attr("latitude")),
          parseFloat($(this).attr("longitude")),
        ],
        {
          icon: pawIcon,
        }
      )
        .addTo(map)
        .bindPopup(
          `<center><a id="${$(this).attr("id")}" href="object_page.php?parkid=${$(this).attr("id")}"><b>${$(
            this
          ).attr("name")}</b></a></center><p>Address: ${$(this).attr(
            "address"
          )}</p><center><b>${$(this).attr("distance") > 0 ? $(this).attr("distance"):"-"}</b> Away</center>`
        );
    });
});
