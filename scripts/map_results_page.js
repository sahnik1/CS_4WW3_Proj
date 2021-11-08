// Main instantiation for the Map, Results-Map is the div we target to place the map in
var map = L.map( 'Results-Map', {
    // Center is the focal point of the map for the default view on load
    // These Long/Lat refer to central Oakville
    center: [43.44545392984603, -79.73754183902522],
    minZoom: 2,
    // This is a Cities level Zoom, enough to see neighboring cities and areas
    zoom: 10
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

// Custom Markers, Show the location of Various Dog Parks (Imaginary),
// each shows popup when clicked which contains a link to the object page as well as the Park's Address
L.marker([43.48781369500409, -79.73612490754945], {icon: pawIcon}).addTo(map).bindPopup("<center><a href='object_page.html'><b>Oakville Dog Park</b></a></center><p>Address: 230 Random St, Oakville, ON L67M35</p><center><b>1.5 Km</b> Away</center>");
L.marker([43.415535047464736, -79.72101870694681], {icon: pawIcon}).addTo(map).bindPopup("<center><a href='object_page.html'><b>Burlington Dog Park</b></a></center><p>Address: 53 RayLawson Dr, Burlington, ON L61NO1</p><center><b>4.9 Km</b> Away</center>");
L.marker([43.48357905429936, -79.62729159866215], {icon: pawIcon}).addTo(map).bindPopup("<center><a href='object_page.html'><b>Lakeshore Dog Zone</b></a></center><p>Address: 10 Downing St., Oakville, ON L6W9IP</p><center><b>2.1 Km</b> Away</center>");
L.marker([43.56122067083931, -79.82915827104833], {icon: pawIcon}).addTo(map).bindPopup("<center><a href='object_page.html'><b>Milton North Dog Park</b></a></center><p>Address: 7 Race Course Rd, Milton, ON L0A9W1</p><center><b>15.5 Km</b> Away</center>");
L.marker([43.5452735888931, -80.20670125418825], {icon: pawIcon}).addTo(map).bindPopup("<center><a href='object_page.html'><b>Guelph Central Dog Park</b></a></center><p>Address: 24 Sussex Dr, Guelph, ON M9Q2D1</p><center><b>10.5 Km</b> Away</center>");
L.marker([43.446980138617114, -80.06020068225322], {icon: pawIcon}).addTo(map).bindPopup("<center><a href='object_page.html'><b>Eastern Plains Dog Park</b></a></center><p>Address: 1600 Pennsylvania Ave, Burlington, ON L9Q1P8</p><center><b>1.5 Km</b> Away</center>");
