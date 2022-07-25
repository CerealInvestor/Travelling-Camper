// Make an ajax request
// return page i.e json
function makeRequest(url, callback) {
	var request;
	
	if (window.XMLHttpRequest) {
		request = new XMLHttpRequest(); // IE7+, Firefox, Chrome, Opera, Safari
	} else {
		request = new ActiveXObject("Microsoft.XMLHTTP"); // IE6, IE5
	}
	
	request.onreadystatechange = function() {
	
		if (request.readyState == 4 && request.status == 200) {
			callback(request);
		}
	}
	request.open("GET", url, true);
	request.send();
}

function displayLocation(location) {

	var content =   '<div class="infoWindow"><h2>'  + location.postTitle + '</h2>'
	+ '<br/>'     + location.address
	+ '<br/>'     + location.postBlurb + '</div>';

	if (parseInt(location.lat) == 0) {
		geocoder.geocode( { 'address': location.address }, function(results, status) {
	if (status == google.maps.GeocoderStatus.OK) {

	var marker = new google.maps.Marker({
		map: map,
		position: results[0].geometry.location,
		title: location.postLocation
	});

	google.maps.event.addListener(marker, 'click', function() {
	infowindow.setContent(content);
	infowindow.open(map,marker);
	});
	}
	});
	} else {
		
		var position = new google.maps.LatLng(parseFloat(location.lat), parseFloat(location.lon));
		var marker = new google.maps.Marker({
			map: map,
			position: position,
			title: location.postLocation
		});

		google.maps.event.addListener(marker, 'click', function() {
			infowindow.setContent(content);
			infowindow.open(map,marker);
		});
	}
}


// Google maps api
//<![CDATA[

var map;

// Centre the map
var center = new google.maps.LatLng(47.40569456325504, 0.321647031968702);

var geocoder = new google.maps.Geocoder();
var infowindow = new google.maps.InfoWindow();

function init() {

	var mapOptions = {
	zoom: 4,
	center: center,
	mapTypeId: google.maps.MapTypeId.ROADMAP
	}

	// makeRequest function put in init() function so it loads with the map, needs to load before map is shown
	// parse the JSON and set variable
	// Create location array
	// Loop through json creating array called "location" creating array of json objects
	// use let, map and Object.values to create new array of arrays for google maps compatibility "LocationList"
	// create map and infowindow
	// loop through locationList adding markers from locations


	var myJSON = makeRequest('_requests/getLocations.php', function(data) {
		var myObj = JSON.parse(data.responseText);

		var locations = [];

		console.log(locations);

		for (var i = 0; i < myObj.length; i++) {

  			var item = myObj[i];

  			locations.push({
  				"locationName" : item.postTitle,
  				"locationText" : item.postLocation,
  				"lat" : item.lat,
  				"lon" : item.lon,
  				"order" : i,
  				"postId" : item.postId,
  				"postBlurb" : item.postBlurb,
  				"slug" : item.slug
  			});
		}

		// 
		let locationList = locations.map(obj => Object.values(obj));

		/*

		// Infobox format above converts to
		var locationList2 = [
	      ['Calais', 50.904308, 1.920100, 1],
	      ['Amiens', 49.881783, 2.282649, 2],
	      ['Rouen', 49.444447, 1.101619, 3]
	    ];*/

		map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

		var infowindow = new google.maps.InfoWindow();

	    var marker, i;
	    
	    for (i = 0; i < locationList.length; i++) {
	      marker = new google.maps.Marker({
	        position: new google.maps.LatLng(locationList[i][2], locationList[i][3]),
	        label: { number: i },
	        map: map
	      });
	      
	      google.maps.event.addListener(marker, 'click', (function(marker, i) {
	        return function() {

	        	console.log(locationList[i]);
	        	var contentString = '' + 
	        	'' + locationList[i][0] + '<h1 style="font-size: 18px;">' + locationList[i][1] + '</h1>' +
	        	locationList[i][6] + '...<a href="http://www.travelling-camper.co.uk/blog/' + locationList[i][7] + '">' +
	        	'view post' +
	        	'</a></p>';
	          infowindow.setContent(contentString);
	          //document.getElementById('blogContent').innerHTML = locationList[i][0];
	         // $('#blogContent').load('some.php?id=123');
	          infowindow.open(map, marker);
	        }
	      })(marker, i));
	    }

	});
}
//]]>