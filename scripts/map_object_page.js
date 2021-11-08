
// Main instantiation for the Map, Park-Map is the div we target to place the map in
var map = L.map( 'Park-Map', {
    // Center is the focal point of the map for the default view on load
    // These Long/Lat refer to central Oakville
    center: [43.44545392984603, -79.72754183902522],
    minZoom: 2,
    // This is a Cities level Zoom, enough to see neighboring cities
    zoom: 9
  });


L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    subdomains: ['a','b','c']
}).addTo( map );

// Custom Icon for 'Paw' print marker, credit goes to Google Earth (although I dont think they care)
var pawIcon = L.icon({
    iconUrl: 'https://www.gstatic.com/earth/images/stockicons/190201-2016-animal-paw_4x.png',
    iconSize: [64, 64], // size of the icon
});

// Custom Marker, Shows the location of Oakville Dog Park (Imaginary),
// shows popup when clicked which contains a link to the object page as well as the Park's Address
L.marker([43.48781369500409, -79.73612490754945], {icon: pawIcon}).addTo(map).bindPopup("<center><a href='object_page.html'><b>Oakville Dog Park</b></a></center><p>Address: 230 Random St, Oakville, ON L67M35</p><center><b>1.5 Km</b> Away</center>");