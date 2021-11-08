var map = L.map( 'Park-Map', {
    center: [43.44545392984603, -79.72754183902522],
    minZoom: 2,
    zoom: 9
  });

  L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    subdomains: ['a','b','c']
  }).addTo( map );

  var pawIcon = L.icon({
    iconUrl: 'https://www.gstatic.com/earth/images/stockicons/190201-2016-animal-paw_4x.png',
    iconSize: [64, 64], // size of the icon
  });
  
  L.marker([43.48781369500409, -79.73612490754945], {icon: pawIcon}).addTo(map).bindPopup("<center><a href='object_page.html'><b>Oakville Dog Park</b></a></center><p>Address: 230 Random St, Oakville, ON L67M35</p><center><b>1.5 Km</b> Away</center>");

