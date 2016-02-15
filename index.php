
<!doctype html>
<html>
<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Traffic Information Homepage</title>
		<meta name="description" content="Simple Effects for Drop-Down Lists" />
		<meta name="keywords" content="drop-down, select, jquery, plugin, fallback, transition, transform, 3d, css3" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="css/style1.css" />
		<script src="js/modernizr.custom.63321.js"></script>
	<?php
		require 'connect_sql.php';
	?>
	</head>
<body>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>




<style>
	  #map-canvas {
		width: 680px;
		height: 620px;
		margin-left:0px;		
	  }
	  a.title:visited {
		  color:#00F;
	  }
	  .mapControl {
					  width: 200px;
					  height: 16px;
					  background-color: #FFFFFF;
					  border-style: solid;
					  border-width: 1px;
					  padding: 2px 5px;
				  }
	</style>
	
	<div class="container">	
			<!-- Codrops top bar -->
			<div class="codrops-top clearfix">
				<a class="current-demo" href="index.php">
					<strong>&laquo; User Interface: </strong>user mode
				</a>
				<span class="right">
					<a href="http://civil.njit.edu/">
						<strong>Welcome to Civil and Environmental Engineering!</strong>
					</a>
				</span>
			</div><!--/ Codrops top bar -->	
			
			<header class="clearfix">			
				<h1>Dashboard<span>Traffic Information Homepage</span></h1>
				<nav class="codrops-demos">
					<a href="main.php">Homepage</a>
					

				</nav>				
			</header>
			</div>

<script type="text/javascript">
$(function () {
var x = 10;
var y = 20;
$("a.ref-img").live('mouseover', function (e) {
	this.myTitle = this.title;
	this.title = "";
	var imgTitle = this.myTitle ? "<br />" + this.myTitle + "11" : "";
	var tooltip_com = "<div id='Bimg'><img src='" + this.href + "' alt='' width='765' height='574' /></div>"; // + imgTitle + "</div>";
	$("body").append(tooltip_com);
	$("#Bimg").css({
		"position": "absolute",
		"top": (e.pageY + y) + "px",
		"left": (e.pageX + x) + "px"
	}).show("fast");
	});
	$("a.ref-img").live('mouseout', function (e) {
		this.title = this.myTitle;
		$("#Bimg").remove();
	});
	$("a.ref-img").live('mousemove', function (e) {
		$("#Bimg").css({
			"position": "absolute",
			"top": (e.pageY + y) + "px",
			"left": (e.pageX + x) + "px"
		});
	});
})
</script>

<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>

  var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();
  var allMarkers = [];
  var allPolylines = [];
  var allLinePoints = [];
  var allMarkerInfs = [];
  var allSegNames = [];
  var allPointNums = [];
  var allDis = [];

  var segMarker = [];
  var segment = [];
  var current;
  var markers = [];
  var polylines = [];
  var linePoints = [];
  var markerInf = [];
  var distance;
  var mid;
  var map;
  var tttt;
  var titleMarker;
  var infowindow;
  
  function initialize() {
  	current =  0;
  	// segment.push(maxSeg());
		var mapCanvas = document.getElementById('map-canvas');
		var myLatlng = new google.maps.LatLng(40.465440, -74.85698);  //<!-- Latitude, Longitude -->

		directionsDisplay = new google.maps.DirectionsRenderer();
		
		var mapOptions = {
		  center: myLatlng,
		  zoom: 12,
		  mapTypeId: google.maps.MapTypeId.ROADMAP,
		  streetViewControl: false,
		  mapTypeControl: false
		}

		directionsDisplay.setMap(map);
		map = new google.maps.Map(mapCanvas, mapOptions);

		infowindow = new google.maps.InfoWindow();

		loadSegment();
		loadMarker();
		
		// if (markers.length > 1) {
			loadLine();
		// }

		// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"WW,WW"+segment.length+allMarkers.length+"\n";  	
		// for (var i = 0; i < segment.length; i++) {
		// 	document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"WW,WW"+segment[i]+"\n";  	
		// };

		for (var i = 0; i < segment.length; i++) {
			markers = allMarkers[i];
	  	polylines = allPolylines[i];
	  	// linePoints = allLinePoints[i];
	  	setStatus(true);
	  }

	  showSegNum();
		
		current = 0;
		if (allMarkers.length < 1) {
			markers = [];
			polylines = [];
			linePoints = [];
			markerInf = [];
			segment.push(0);
		} else {
			markers = allMarkers[current];
			polylines = allPolylines[current];
			linePoints = allLinePoints[current];
			markerInf = allMarkerInfs[current];
			distance = allDis[current];
			setStatus(true);
		}

		// setStatus(true);
		
		// showMarkerInf();
		// showDis();

		
  	// for (var i = 0; i < markerInf.length; i++) {
  	// 	document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+markerInf[i]+"WW,WW"+"\n";  	
  	// 	// for (var j = 0; j < allLinePoints[i].length; j++) {
  	// 	//  	document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+allLinePoints[i][j][1]+"WW,WW"+allLinePoints[i][j][0]+"\n";
  	// 	//  }; //allMarkers[i]
  	// };
  	
		
		// showSeg();
	  // updateSegName();
  }

  function loadSegment() {
  	var sgs = document.getElementById("segment").innerHTML.split("!");
  	var segArr = [];
  	var segs = [];

  	for (var i = 0; i < sgs.length; i++) {
  		var mk = sgs[i].split(",");
  		if (mk.length < 2) {
  			break;
  		}
  		var isIn = false;
  		for (var j = 0; j < segs.length; j++) {
  			if (segs[j] == Number(mk[0])) {
  				isIn = true;
  			}
  		}
  		if (!isIn) {
  			segs.push(Number(mk[0]));
  		}
  		segArr.push(Number(mk[0])+","+mk[1]);
  		// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"("+mk+")";
  	}

  	// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"HHHH:"+segs.length;
  	for (var i = 0; i < segs.length; i++) {
  	 	// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"HHHH:"+segs.length;
  		var tempMarkers = [];
  		for (var j = 0; j < segArr.length; j++) {
  			var segMark = segArr[j].split(",");
  			if (Number(segMark[0]) == segs[i]) {
  				tempMarkers.push(Number(segMark[1]));
  			}
  		}
  		segMarker.push(tempMarkers);
  		segment.push(Number(segs[i]));
  	}
  	loadSegName();
  }

  function loadSegName() {
  	var gns = document.getElementById("segN").innerHTML.split("!");
  	for (var i = 0; i < segment.length; i++) {
  		for (var j = 0; j < gns.length; j++) {
	  		var mk = gns[j].split(",");
	  		if (mk.length < 2) {
	  			break;
	  		}
	  		if (Number(mk[0])==Number(segment[i])) {
	  			allSegNames.push(mk[1]);
	  			allDis.push(Number(mk[3]));
	  			allPointNums[i] = mk[2];
	  		}
	  	}
  	}
  }

  function maxTitle() {
  	var maxT = 0;
  	for (var i = 0; i < allMarkers.length; i++) {
  		var mks = allMarkers[i];
  		for (var j = 0; j < mks.length; j++) {
  			if(Number(mks[j].getTitle())>maxT) {
	  			maxT = Number(mks[j].getTitle());
	  		}
  		}
  	}
  	for (var i = 0; i < markers.length; i++) {
  		maxT = Math.max(Number(markers[i].getTitle()), maxT);
  	}
  	return maxT;
  }

  function loadMarker() {
  	var location;
  	var lls = document.getElementById("marker").innerHTML.split("!");

  	for (var i = 0; i < segMarker.length; i++) {
  		var s_id = segment[i];
  		var tempMarkers = [];
  		var tempMarkerInf = [];

  		for (var j = 0; j < segMarker[i].length; j++) {
  		 	var m_id = segMarker[i][j];
  		 	for (var k = 0; k < lls.length-1; k++) {
		  		// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"EEEE: "+lls[k];
		  		var ll = lls[k].split(",");
		  		if (Number(ll[0]) == Number(m_id)) {
			  		var latLng = new google.maps.LatLng(ll[1], ll[2]);
			  		markerTitle = Number(ll[0]).toString();
			  		var marker = addMarker0(latLng);
			  		tempMarkers.push(marker);
			  		tempMarkerInf.push([ll[3], ll[4], ll[5]]);
			  	}
		  	}
  		}
  		allMarkers.push(tempMarkers);
  		allMarkerInfs.push(tempMarkerInf);
  	}
  }

  function addMarker0(location) {
	  var marker = new google.maps.Marker({
	    position: location,
	    map: map,
	    title: markerTitle,
	    draggable: true
	  });

	  // document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+marker.getTitle()+"WW,WW"+"\n";  	
  		
	  // markers.push(marker);

	  // if (markers.length >= 2) {
	  // 	var latLng0 = markers[markers.length-2].position;
  	// 	var latLng1 = markers[markers.length-1].position;
	  // 	addLine(latLng0, latLng1);
	  // 	linePoints.push([markers[markers.length-2].getTitle(),markers[markers.length-1].getTitle()]);
	  // }

	  google.maps.event.addListener(marker, 'click', function(event) {
	  	infowindow.close();
		  infowindow.setContent("Latitude: <input type='text' id='lat00' value='"+event.latLng.lat().toFixed(6)+"'><p>"+
		  	"</p>Longtitude: <input type='text' id='lng00' value='"+event.latLng.lng().toFixed(6)+"'><p>"+
		  	"</p>Mile Post: <input type='text' id='lng00' value='"+"'><p>"+
		  	"</p>Sensor Type: <input type='text' id='lng00' value='"+"'>"+
		  	"<button onClick='edit("+this.getTitle()+")'>Edit</button>");
		  infowindow.open(map, this);
		  // infowindow.
		  // document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"edit("+this.getTitle()+","+document.getElementById('lat00').value;
	  });

	  google.maps.event.addListener(marker, 'dragend', function(event) {
	  	updateLine(this.getTitle());
	  });
	  
	  google.maps.event.addListener(marker, 'rightclick', function(event) {
	  	this.setMap(null);
	  	updateMarkers();
	  	//document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+marker.position().toString();
	  });
	  return marker;
	}

	// function edit(t) {
	// 	var newP = new google.maps.LatLng(document.getElementById('lat00').value, document.getElementById('lng00').value);
	// 	var id = titleToId(t); 
	// 	markers[id].setOptions({
	// 		position:newP,
	// 	});

	// 	updateLine(t);
	// }

	// function updateLine(id) {
 //  	var ind = [];
 //  	var temp = [];
 //  	var st = -1;
 //  	var ed = -1;
  	
 //  	for (var i = 0; i < linePoints.length; i++) {
 //  		if (linePoints[i][0].toString() == id) {
 //  			polylines[i].setMap(null);
 //  			ed = linePoints[i][1];
 //  		} else if (linePoints[i][1].toString() == id) {
 //  			polylines[i].setMap(null);
 //  			st = linePoints[i][0];
 //  		} else {
 //  			temp.push(polylines[i]);
 //  			ind.push(linePoints[i]);
 //  		}
 //  	}
 //  	linePoints = ind;
 //  	polylines = temp;
 //  	var i0 = titleToId(id);
 //  	if (st!=-1) {
 //  		var i1 = titleToId(st);
 //  		addLine(markers[i1].position, markers[i0].position);
 //  		linePoints.push([st,id]);
 //  	}
 //  	if (ed!=-1) {
 //  		var i2 = titleToId(ed);
 //  		addLine(markers[i0].position, markers[i2].position);
 //  		linePoints.push([id,ed]);
 //  	}

 //  	// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"X:"+st+"R:"+id+"S:"+ed+linePoints.length;
 //  	// for (var i = 0; i < linePoints.length; i++) {
 //  	// 	document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"H:"+linePoints[i][0]+"J:"+linePoints[i][1];
 //  	// };
 //  }

	function loadLine() {
		var lls = document.getElementById("line").innerHTML.split("!");
		
		// for (var i = 0; i < allMarkers.length; i++) {
  // 		for (var j = 0; j < allMarkers[i].length; j++) {
  // 		 	document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+i+","+allMarkers[i].length+":"+allMarkers[i][j].getTitle()+"\n";
  // 		 }; //allMarkers[i]
  // 	};

		for (var i = 0; i < segMarker.length; i++) {
  		var s_id = segment[i];
  		var tempLinePoints = [];
  		markers = allMarkers[i];
  		// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"EEEE: "+i+","+allMarkers[i].length+segMarker.length;
  		if (markers.length < 2) {
  			allPolylines.push("");
  			allLinePoints.push("");
  			continue;
  		}
  		var polyline = new google.maps.Polyline({
				path: [],
				strokeColor: '#FF0000',
				strokeWeight: 10,
				editable: false,
			});
			linePoints = [];
			polylines = [];
  		// linePoints.push([markers[0].getTitle(), markers[1].getTitle()]);
  		// polyline.getPath().push(markers[0].position);

  		// for (var j = 0; j < markers.length; j++) {
  		//  	var m_id = segMarker[i][j];
  		var isSet = false;
  		// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"EEEE: "+ll+"x:"+polylines.length;
  		 	for (var k = 0; k < lls.length-1; k++) {
		  		// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"EEEE: "+lls[i];
		  		var ll = lls[k].split(",");
		  		var isIn = false;
		  		for (var j = 0; j < markers.length; j++) {
	  				if(Number(ll[0]) == Number(markers[j].getTitle())) {
	  					isIn = true;
	  					break;
	  					// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"FFFF: "+ll+"x:"+polylines.length;
	  				}
	  			}

	  			if (!isIn) {
	  				continue;
	  			}

		  		if (!isSet) {
		  			linePoints.push([Number(ll[0]), Number(ll[1])]);
  					// polyline.getPath().push(markers[0].position);
  					// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"FFFF: "+ll+"x:"+polylines.length+"OO";
  					isSet = true;
		  		}
		  		
		  		var latLng = new google.maps.LatLng(ll[2], ll[3]);
		  		if ((linePoints[linePoints.length-1][0]==Number(ll[0]))&&(linePoints[linePoints.length-1][1]==Number(ll[1]))) {
		  			polyline.getPath().push(latLng);
		  		} else {
		  			polyline.setMap(map);
		  			polylines.push(polyline);
		  			// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"FFFF: "+ll+"x:"+polylines.length+linePoints[linePoints.length-1][0]+linePoints[linePoints.length-1][1];

		  			linePoints.push([Number(ll[0]), Number(ll[1])]);
		  			// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"EEEE: "+ll[0];
		  			// polyline = [];
		  			polyline = new google.maps.Polyline({
							path: [],
							strokeColor: '#FF0000',
							strokeWeight: 10,
							editable: false,
						});
						polyline.getPath().push(latLng);
		  		}
		  	}
				polylines.push(polyline);
				polyline.setMap(map);
				// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"FFFF: "+ll+"x:"+polylines.length;
				for (var m = 0; m < polylines.length; m++) {
					google.maps.event.addListener(polylines[m],'click', function(e) {
				  document.getElementById("pic").style.display="block";
				  this.setEditable(true);
				  var lid = getLineId();
				  this.setEditable(false);
				  // document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"i:"+id+"s:"+linePoints.length+polylines.length;
				  LP = allLinePoints[lid[0]];
				  id = lid[1];
				  document.getElementById("start").value = LP[id][0];
				  document.getElementById("end").value = LP[id][1];
				  showSegName(lid[0]);
				  showDis(lid[0]);
				  showMarkerInf(lid[0]);
				  // document.getElementById("showId").innerHTML = "<h3>From: </h3>"+LP[id][0]+" <h3>To: </h3>"+LP[id][1];
				  show();
				});
			}
			allPolylines.push(polylines);
			allLinePoints.push(linePoints);
		}
	}

  function addMarker(location) {
	  var marker = new google.maps.Marker({
	    position: location,
	    map: map,
	    title: markerTitle,
	    draggable: true
	  });
	  markers.push(marker);

	  if (markers.length >= 2) {
	  	var latLng0 = markers[markers.length-2].position;
  		var latLng1 = markers[markers.length-1].position;
	  	addLine(latLng0, latLng1);
	  	linePoints.push([markers[markers.length-2].getTitle(),markers[markers.length-1].getTitle()]);
	  }

	  google.maps.event.addListener(marker, 'click', function(event) {
	  	infowindow.close();
		  infowindow.setContent("Latitude: <input type='text' id='lat00' value='"+event.latLng.lat().toFixed(6)+"'><p>"+
		  	"</p>Longtitude: <input type='text' id='lng00' value='"+event.latLng.lng().toFixed(6)+"'><p>"+
		  	"</p>Mile Post: <input type='text' id='lng00' value='"+"'><p>"+
		  	"</p>Sensor Type: <input type='text' id='lng00' value='"+"'>"+
		  	"<button onClick='edit("+this.getTitle()+")'>Edit</button>");
		  infowindow.open(map, this);
	  });

	  google.maps.event.addListener(marker, 'dragend', function(event) {
	  	updateLine(this.getTitle());
	  });
	  
	  google.maps.event.addListener(marker, 'rightclick', function(event) {
	  	this.setMap(null);
	  	updateMarkers();
	  	// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+marker.position().toString();
	  });

	  var tempInf = [1, null, null];
	  markerInf.push(tempInf);
	  addMarkerInf(markerTitle, tempInf);
	}

	// function updateMarkers() {
	// 	// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"LLLLLL: "+markers.length;
	// 	var index = [];
	// 	var tempMarkerInf = [];
	// 	var ind = 0;
	// 	for (var i = 0; i < markers.length; i++) {
	// 		if(markers[i].getMap() != null) {
	// 			index.push(markers[i]);
	// 			tempMarkerInf.push(markerInf[i]);
	// 		} else {
	// 			// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"NN: "+markers[i].getTitle();
	// 			deleteLine(markers[i].getTitle());
	// 		}
	// 	}	
	// 	markers = index;
	// 	markerInf = tempMarkerInf;
	// 	updateMarkerInf();
	// 	// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"OOOOO: "+markers.length;
	// }

	// function clearMarkers() {
 //  	for (var i = markers.length - 1; i >= 0; i--) {
 //  		markers[i].setMap(null);
 //  	}
 //  	markers = [];
 //  	// mid = 0;
  	
 //  	for (var i = 0; i < polylines.length; i++) {
 //  		polylines[i].setMap(null);
 //  	}
 //  	polylines = [];
 //  	linePoints = [];
 //  }

  // function saveMarkers() {
  // 	// for (var i = 0; i < markerInf.length; i++) {
  // 	// 	document.getElementById("inf").innerHTML = "ss:"+document.getElementById("inf").innerHTML+markerInf[i]+"oo";
  // 	// };
  // 	var num = markers.length;
  // 	var latLng = '';
  // 	for (var i = 0; i < markers.length; i++) {
  // 		latLng = latLng+markers[i].getTitle()+','+markers[i].position.lat()+','+markers[i].position.lng()+'!';
  // 	}
  // 	if (window.XMLHttpRequest) {
  //       // code for IE7+, Firefox, Chrome, Opera, Safari
  //     xmlhttp = new XMLHttpRequest();
  //   } else {
  //       // code for IE6, IE5
  //     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  //   }
  //   xmlhttp.onreadystatechange = function() {
  //     if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
  //       document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"IIIIII"+xmlhttp.responseText;
  //       // alert("success");
  //     }
  //   }
    
  //   updateMarkerInf();
  //   var message = "";
  // 	for (var i = 0; i < markerInf.length; i++) {
  // 		var inf = markerInf[i];
  // 		message = message+markers[i].getTitle()+','+inf[0]+','+inf[1]+','+inf[2]+";";
  // 	}

  //   xmlhttp.open("POST","saveMarker.php?"+$.now(),true);
  //   xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  //   xmlhttp.send("num="+num+"&lat="+latLng+"&segment="+segment[current]+"&markerInf="+message+"&segName="+allSegNames[current]+"&dis="+distance);
  //   saveLine();
  // }

  function addMarkerInf(title, inf) {
  	var tableEle = document.getElementById("segPoint");
  	var mes = "<tr><td>"+title+"</td><td>"+inf[0]+"</td><td>"+inf[1]+"</td><td>"+inf[2]+"</td></tr>"
  	tableEle.innerHTML = tableEle.innerHTML+mes;
  }

  // function addLine(latLng0, latLng1) {
  // 	if (markers.length < 2) {
  // 		return;
  // 	} else {  		
  // 		var request = {
		// 	  origin:latLng0,
		// 	  destination:latLng1,
		// 	  travelMode: google.maps.TravelMode.DRIVING
		//   	};
		// 	var polyline = new google.maps.Polyline({
		// 		path: [],
		// 		strokeColor: '#FF0000',
		// 		strokeWeight: 10,
		// 		editable: false,
		// 		map: map,
		// 	});

	 //  	directionsService.route(request, function(response, status) {
		// 	  if (status == google.maps.DirectionsStatus.OK) {
		// 	  	//directionsDisplay.setDirections(response);
		// 			var legs = response.routes[0].legs;
		// 		  for (i=0;i<legs.length;i++) {
		// 			  var steps = legs[i].steps;
		//         for (j=0;j<steps.length;j++) {
		//           var nextSegment = steps[j].path;
				
		// 					for (k=0;k<nextSegment.length;k++) {
		// 	            polyline.getPath().push(nextSegment[k]);              
		// 					}
		// 			  }
		// 			}
		// 			polyline.setMap(map);
		// 			polylines.push(polyline);
		// 			estDis();
		// 			// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"DDD:"+polylines.length+"EEE";
					
		// 			google.maps.event.addListener(polyline,'click', function(e) {
		// 			  document.getElementById("pic").style.display="block";
		// 			  // this.setEditable(true);
		// 			  // var lid = getLineId();
		// 			  // this.setEditable(false);
		// 			  //document.getElementById("test").innerHTML = document.getElementById("test").innerHTML+"i:"+id+"s:"+linePoints.length;
		// 			  // document.getElementById("start").value = linePoints[id][0];
		// 			  // document.getElementById("end").value = linePoints[id][1];
		// 			  document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"GGGGGGGG";
		// 			  // LP = allLinePoints[lid[0]];
		// 			  // id = lid[1];
		// 			  // document.getElementById("showId").innerHTML = "<h3>From: </h3>"+LP[id][0]+" <h3>To: </h3>"+LP[id][1];
		// 			  // show();
		// 			});
		// 	  }
		// 	  else {
		// 	  	document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"GGGGGGGG";
		// 	  }
		//   });
  // 	}
  // }

  function getLineId() {
  	//document.getElementById("test").innerHTML = document.getElementById("test").innerHTML+"X:"+polylines.length;
  	for (var i = 0; i < allPolylines.length; i++) {
  		polylines = allPolylines[i];
  		for (var j = 0; j < polylines.length; j++) {
  			if(polylines[j].getEditable() == true) {
  				// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+allSegNames[i]+"III";
  				return [i,j];
  			}
  		}
  	}
  	// for (var i = polylines.length - 1; i >= 0; i--) {
  	// 	if(polylines[i].getEditable() == true)
  	// 		return i;
  	// }
  	return -1;
  }

  // function deleteLine(id) {
  // 	var ind = [];
  // 	var temp = [];
  // 	var st = -1;
  // 	var ed = -1;
  // 	// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"R:"+id+" "+linePoints.length;
  // 	for (var i = 0; i < linePoints.length; i++) {
  // 		if (linePoints[i][0].toString() == id ) {
  // 			polylines[i].setMap(null);
  // 			ed = linePoints[i][1];
  // 		} else if (linePoints[i][1].toString() == id) {
  // 			polylines[i].setMap(null);
  // 			st = linePoints[i][0];
  // 		} else {
  // 			temp.push(polylines[i]);
  // 			ind.push(linePoints[i]);
  // 		}
  // 	}
  // 	linePoints = ind;
  // 	polylines = temp;
  // 	if ((st!=-1)&&(ed!=-1)) {
  // 		var i0 = titleToId(st);
  // 		var i1 = titleToId(ed);
  // 		addLine(markers[i0].position, markers[i1].position);
  // 		linePoints.push([st,ed]);
  // 	}
  // }

  function titleToId(title) {
  	for (var i = markers.length - 1; i >= 0; i--) {
  		if(markers[i].getTitle()==title)
  			return i;
  	}
  }

  // function saveLine() {
  // 	var num = polylines.length;
  // 	var pathVar = '';
  // 	for (var i = 0; i < polylines.length; i++) {
  // 		pathVar = pathVar+linePoints[i][0]+','+linePoints[i][1]+',';

  // 		var paths = polylines[i].getPath();
  // 		// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+pathVar+num+paths;
  // 		paths.forEach(function(p, index) {
  // 			// p.forEach(function(pi, ind) {
  // 				// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+p+index;
  // 			// })
  // 			pathVar = pathVar+p.lat()+'?'+p.lng()+']';
  // 		});
  // 		pathVar = pathVar+'!';
  // 	}
  // 	if (window.XMLHttpRequest) {
  //       // code for IE7+, Firefox, Chrome, Opera, Safari
  //     xmlhttp = new XMLHttpRequest();
  //   } else {
  //       // code for IE6, IE5
  //     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  //   }
  //   xmlhttp.onreadystatechange = function() {
  //     if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
  //       // document.getElementById("inf").innerHTML = xmlhttp.responseText;
  //       alert("success");
  //     }
  //   }
  //   // document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+pathVar;
  //   // window.location.assign("saveMarker.php?num="+num+"&lat="+latLng);
  //   xmlhttp.open("POST","savePath.php?"+$.now(),true);
  //   xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  //   xmlhttp.send("num="+num+"&line="+pathVar);
  // }

  google.maps.event.addDomListener(window, 'load', initialize);  

  // function add() {
  // 	var lat = document.getElementById("latInput").value;
  // 	var lng = document.getElementById("lngInput").value;
  // 	var latLng = new google.maps.LatLng(lat, lng);
  // 	markerTitle = (Number(maxTitle())+1).toString();
  // 	addMarker(latLng);
  // }

  function show() {
  	if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
     		var pic = document.getElementById('showPic');
     		// alert(xmlhttp.responseText);
    		pic.innerHTML = xmlhttp.responseText; //"<img src=\'"+ xmlhttp.responseText +"\' width=\"80px\" height=\"100px\"/>";
      }
    }
    xmlhttp.open("GET","showViewImage.php?start="+document.getElementById("start").value+"&end="+document.getElementById("end").value+"&"+$.now(), true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send();  	
  }

  function showBig(src) {
  	var mes = "<img src=\'"+ src +"\' width=\"80px\" height=\"100px\"/>";
  	alert(mes);
  }

  function setStatus(status) {
  	for (var i = 0; i < polylines.length; i++) {
  		polylines[i].setVisible(status);
  	}
  	for (var i = 0; i < markers.length; i++) {
  		markers[i].setVisible(status);
  	}
  }

  function next() {
  	// for (var i = 0; i < polylines.length; i++) {
  	// 	polylines[i].setOptions({strokeColor:"#666"});
  	// }
  	// setStatus(false);
  	// allPolylines[current] = polylines;
  	// allMarkers[current] = markers;
  	// allLinePoints[current] = linePoints;
  	var maxN = allPolylines.length;
  	if (maxN==0) {
  		return;
  	}
  	var newId = (current+1)%maxN;
  	changeCurrent(newId);
  	// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+current;
  	// markers = allMarkers[current];
  	// polylines = allPolylines[current];
  	// linePoints = allLinePoints[current];
  	// setStatus(true);
  	// showSeg();
  }

  function maxSeg() {
  	var maxT = 0;
  	for (var i = 0; i < segment.length; i++) {
  		maxT = Math.max(segment[i], maxT);
  	}
  	return maxT;
  }

  // function newLine() {
  // 	if (current < allPolylines.length) {
  // 		allPolylines[current] = polylines;
  // 		allMarkers[current] = markers;
  // 		allLinePoints[current] = linePoints;
  // 		allMarkerInfs[current] = markerInf;
  // 		allDis[current] = distance;
  // 		setStatus(false);
  // 		current = allPolylines.length;
  // 		segment.push(maxSeg()+1);
  // 	} else {
  // 		allPolylines.push(polylines);
  // 		allMarkers.push(markers);
  // 		allLinePoints.push(linePoints);
  // 		allMarkerInfs.push(markerInf);
  // 		allDis.push(distance);
  // 		setStatus(false);
  // 		current++;
  // 		segment.push(maxSeg()+1);
  // 	}
  // 	// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"Seg:"+segment[current];
  // 	polylines = [];
  // 	markers = [];
  // 	linePoints = [];
  // 	markerInf = [];
  // 	distance = 0;
  // 	showDis();
  // 	showMarkerInf();
  // 	showSeg();
  // }

  function delMarkers() {
  	polylines=[];
  	markers=[];
  	linePoints=[];
  	var segId = segment[current];
  	for (var i = 0; i < markers.length; i++) {
  		latLng = latLng+markers[i].getTitle()+','+markers[i].position.lat()+','+markers[i].position.lng()+'!';
  	}
  	if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        document.getElementById("inf").innerHTML = xmlhttp.responseText;
        location.reload(); 
        //window.location.assign(window.location.href);
        // alert(xmlhttp.responseText);
      }
    }
    xmlhttp.open("POST","delMarker.php?"+$.now(),true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("seg="+segId);
  }

  function showSeg() {
  	var segId = document.getElementById('segs');
		segId.innerHTML = "Segments:\n";
		var content = "";
		var mmmaker = [];
		for (var i = 0; i < allMarkers.length; i++) {
			mmmaker = allMarkers[i];
			content = content+"<p><a href='#' onclick='changeCurrent("+i+")'>";
			for (var j = 0; j < mmmaker.length-1; j++) {
				content = content + mmmaker[j].getTitle()+"->";
			};
			if (mmmaker.length != 0) {
				content = content+mmmaker[j].getTitle()+"</a></p>";
			}
		}
		segId.innerHTML = segId.innerHTML+content;
  }

  function changeCurrent(id) {
  	setStatus(false);
  	allPolylines[current] = polylines;
  	allMarkers[current] = markers;
  	allLinePoints[current] = linePoints;
  	allMarkerInfs[current] = markerInf;
  	allDis[current] = distance;
  	var maxN = allPolylines.length;
  	current = (id)%maxN;

  	markers = allMarkers[current];
  	polylines = allPolylines[current];
  	linePoints = allLinePoints[current];
  	markerInf = allMarkerInfs[current];
  	distance = allDis[current];
  	setStatus(true);
  	showSeg();
  	showMarkerInf();
  	showDis();
  	updateSegName();
  	map.setCenter(markers[0].getPosition());
  }

  function showMarkerInf(id) {
  	var tableEle = document.getElementById("segPoint");
  	// tableEle.style.display="block";
  	var mes = "<tr><td>Point</td><td>Detector Name</td><td>Mile Post</td><td>Road Name</td></tr>";
  	tableEle.innerHTML = mes;
  	var Tmarkers = allMarkers[id];
  	var TmarkerInf = allMarkerInfs[id];
  	for (var i = 0; i < markers.length; i++) {
  		addMarkerInf(Tmarkers[i].getTitle(), TmarkerInf[i]);
  	}
  }

  function updateMarkerInf() {
  	var num = markerInf.length;
  	var tempMarkerInf = [];
  	for (var i = 0; i < num; i++) {
  		var dn = document.getElementById("dn"+markers[i].getTitle()).value;
  		var mp = document.getElementById("mp"+markers[i].getTitle()).value;
  		var rn = document.getElementById("rn"+markers[i].getTitle()).value;
  		tempMarkerInf.push([dn, mp, rn]);
  		// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+tempMarkerInf[i];
  	}
  	markerInf = tempMarkerInf;
  	showMarkerInf();
  }

  function saveMarkerInf() {
  	var message = "";
  	for (var i = 0; i < markerInf.length; i++) {
  		var inf = markerInf[i];
  		message = message+markers[i].getTitle()+','+inf[0]+','+inf[1]+','+inf[2]+";";
  	}
  	if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        // document.getElementById("inf").innerHTML = xmlhttp.responseText;
        alert("success");
      }
    }
    xmlhttp.open("POST","saveMarkerInf.php?"+$.now(),true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("markerInf="+message+"&segment="+segment[current]+"&segName="+allSegNames[current]+"&dis="+distance);
  }

  function segNameChange(newName) {
  	allSegNames[current] = newName;
  }

  function showSegName(id) {
  	document.getElementById('segName').innerHTML = "Current segment name: <b>"+allSegNames[id]+"</b>";
  }

  // function updateDis() {
  //   distance = document.getElementById('disInput').value;
  //   document.getElementById('disDisplay').innerHTML = distance;
  // }

  // function estDis() {
  // 	var dis = 0;
  // 	for (var i = 0; i < polylines.length; i++) {
  // 		var paths = polylines[i].getPath();
  // 		var plat;
  // 		var plng;
  // 		var sLatLng;
  // 		var set = 0;
  // 		paths.forEach(function(p, index) {
  // 			// p.forEach(function(pi, ind) {
  // 				// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+p+index;
  // 			// })
  // 			if (set == 0) {
  // 				plat = p.lat();
  // 				plng = p.lng();
  // 				sLatLng = new google.maps.LatLng(p.lat(), p.lng());
  // 				set = 1;
  // 			} else {
  // 				dis = dis + google.maps.geometry.spherical.computeDistanceBetween(p, sLatLng);
  // 				// dis = dis+ Math.sqrt(Math.pow((p.lat()-plat),2)+Math.pow((p.lng()-plng),2));
  // 			}
  // 		})
  // 	}
  // 	distance = dis;
  //   document.getElementById('disDisplay').innerHTML = dis;
  // }

  function showDis(id) {
    document.getElementById('disDisplay').innerHTML = "Current segment's distance: <b>"+allDis[id]+"</b>";
  }

  function showSegNum() {
  	document.getElementById("GI").innerHTML = "There are <b>"+segment.length+"</b> segment(s).";
  }
  
</script>


<div style="width:1450px">
	<div style="width:800px; float:left;margin-left=100px">
	<div id="map-canvas"></div>
	</div>
	<div style="float:left; margin-left:100px">
		<div style="float:left; margin-left:150px"><h3>General Information</h3></div>
		<p></p>
		&nbsp;
		<div id="GI"></div>
		
		<div id="inf"></div>

		
		
		<div id = "segName"> </div>
		<div id="disDisplay"></div>
		<div id="segs">
		</div>

		<table id="segPoint" border="2" align="center" cellspacing="0" bordercolor="#0066FF">
		<!-- <tr><td>Point</td><td>Detector Name</td><td>Mile Post</td><td>Road Name</td></tr> -->
		</table>
		
		<div id="showId" style="float:left">
		</div>
		<div id="pic" style="display:none; margin-top:20px">
			<!--<h4> Upload </h4> -->
			<div id="showPic" style="width:550px">
				<!-- <table width="550px">
					<
				</table> -->
			</div>
			<input id = "start" type="text" name="start" style="display:none" value="">
		  <input id = "end" type="text" name="end" style="display:none" value="">
		</div>
	</div>

<div id="segment" style="display:none">
	<?php
		$query = "SELECT seg_id, blue_id FROM bluetooth order by seg_id";
		if ($stmt = $conn->prepare($query)) {
			/* execute statement */
	    $stmt->execute();

	     // bind result variables 
	    $stmt->bind_result($s_ids, $b_ids);

	    /* fetch values */
	    while ($stmt->fetch()) {
	      printf ("%s,%s!", $s_ids, $b_ids);
	    }
		}
	?>
</div>
<div id="segN" style="display:none">
	<?php
		$query = "SELECT seg_id, seg_name, seg_num, seg_dis FROM segment order by seg_id";
		if ($stmt = $conn->prepare($query)) {
			/* execute statement */
	    $stmt->execute();

	     // bind result variables 
	    $stmt->bind_result($s_ids, $b_ids, $s_nums, $s_dis);

	    /* fetch values */
	    while ($stmt->fetch()) {
	      printf ("%s,%s,%s,%s!", $s_ids, $b_ids, $s_nums, $s_dis);
	    }
		}
	?>
</div>
<div id="marker" style="display:none">
<?php
	$query = "SELECT blue_id, lat, lon, dn, mp, rn FROM bluetooth";
	if ($stmt = $conn->prepare($query)) {
		/* execute statement */
    $stmt->execute();

     // bind result variables 
    $stmt->bind_result($b_ids, $lats, $lngs, $dns, $mps, $rns);

    /* fetch values */
    while ($stmt->fetch()) {
      printf ("%d,%s,%s,%d,%s,%s!", $b_ids, $lats, $lngs, $dns, $mps, $rns);
    }
	}
?>
</div>
<div id="line" style="display:none">
	<?php
		$query = "SELECT start_id, end_id, lat, lng FROM route_path";
		if ($stmt = $conn->prepare($query)) {
			/* execute statement */
	    $stmt->execute();

	     // bind result variables 
	    $stmt->bind_result($s_ids, $e_ids, $lats, $lngs);

	    /* fetch values */
	    while ($stmt->fetch()) {
	      printf ("%d,%d,%s,%s!", $s_ids, $e_ids, $lats, $lngs);
	    }
		}
	?>
</div>
</body>
</html>

