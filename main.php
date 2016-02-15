 <?php
	session_start();
	if(empty($_SESSION['login_user']))
	{
	header('Location: op-index.php');
	}
?>



<!DOCTYPE html>
<html lang="en">
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
	
	<body onload="loaded()">
	
	
	
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
		.optionDiv {
			 display:none;
			 outline:1px solid red;
			 height:30px;   
			}
			
		.gmap-control-container {
			margin: 10px;
		}
		.gmap-control {
			cursor: pointer;
			background-color: -moz-linear-gradient(center top , #FEFEFE, #F3F3F3);
			background-color: #FEFEFE;
			border: 1px solid #A9BBDF;
			border-radius: 2px;
			padding: 0 6px;
			line-height: 160%;
			font-size: 12px;
			font-family: Arial,sans-serif;
			box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.35);
			-webkit-user-select: none;
			-khtml-user-select: none;
			-moz-user-select: none;
			-o-user-select: none;
			user-select: none;
		}
		.gmap-control:hover {
			border: 1px solid #678AC7;
		}
		.gmap-control-active {
			background-color: -moz-linear-gradient(center top , #6D8ACC, #7B98D9);
			background-color: #6D8ACC;
			color: #fff;
			font-weight: bold;
			border: 2px solid #678AC7;
		}
		.gmap-control-legend {
			position: absolute;
			text-align: left;
			z-index: -1;
			top: 20px;
			right: 0;
			width: 150px;
			height: 80px;
			font-size: 10px;
			background: #FEFEFE;
			border: 1px solid #A9BBDF;
			padding: 10px;
			box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.35);
		}
		.gmap-control-legend ul {
			margin: 0;
			padding: 0;
			list-style-type: none;
		}
		.gmap-control-legend li {
			line-height: 160%;
		}
		

#floating-panel {
  position: absolute;
  top: 10px;
  left: 25%;
  z-index: 5;
  background-color: #fff;
  padding: 5px;
  border: 1px solid #999;
  text-align: center;
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}

#right-panel {
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}

#right-panel select, #right-panel input {
  font-size: 15px;
}

#right-panel select {
  width: 100%;
}

#right-panel i {
  font-size: 12px;
}

      #right-panel {
        height: 100%;
        float: right;
        width: 390px;
        overflow: auto;
      }

      #map {
        margin-right: 400px;
      }

      #floating-panel {
        background: #fff;
        padding: 5px;
        font-size: 14px;
        font-family: Arial;
        border: 1px solid #ccc;
        box-shadow: 0 2px 2px rgba(33, 33, 33, 0.4);
        display: none;
      }

	  /* Styled scrollbars */

.iScrollHorizontalScrollbar {
	position: absolute;
	z-index: 9999;
	height: 16px;
	left: 2px;
	right: 2px;
	bottom: 2px;
	overflow: scroll;
}

.iScrollHorizontalScrollbar.iScrollBothScrollbars {
	right: 18px;
}

.iScrollVerticalScrollbar {
	position: absolute;
	z-index: 9999;
	width: 16px;
	bottom: 2px;
	top: 2px;
	right: 2px;
	overflow: scroll;
}

.iScrollVerticalScrollbar.iScrollBothScrollbars {
	bottom: 18px;
}

.iScrollIndicator {
	position: absolute;
	background: #cc3f6e;
	border-width: 1px;
	border-style: solid;
	border-color: #666666 #666666 #666666 #666666;
	border-radius: 8px;
}

.iScrollHorizontalScrollbar .iScrollIndicator {
	height: 100%;
	background: -moz-linear-gradient(left,  #fbfbfb 0%, #fbfbfb 100%);
	background: -webkit-linear-gradient(left,  #fbfbfb 0%,#fbfbfb 100%);
	background: -o-linear-gradient(left,  #fbfbfb 0%,#fbfbfb 100%);
	background: -ms-linear-gradient(left,  #fbfbfb 0%,#fbfbfb 100%);
	background: linear-gradient(to right,  #fbfbfb 0%,#fbfbfb 100%);
}

.iScrollVerticalScrollbar .iScrollIndicator {
	width: 100%;
	background: -moz-linear-gradient(top, #e5e5e5 0%, #e5e5e5 100%);
	background: -webkit-linear-gradient(top,  #e5e5e5 0%,#e5e5e5 100%);
	background: -o-linear-gradient(top, #e5e5e5 0%,#e5e5e5 100%);
	background: -ms-linear-gradient(top, #e5e5e5 0%,#e5e5e5 100%);
	background: linear-gradient(to bottom,  #e5e5e5 0%,#e5e5e5 100%);
}



     
 #header {
	position: absolute;
	top: 0;	
	height: 45px;
	width: 260px;
	line-height: 45px;
	
	padding: 0;
	color: #eee;
	font-size: 20px;
	text-align: center;
	font-weight: bold;
}

#wrapper {
	position: absolute;
	z-index: 1;
	top: 45px;
	height:200px;
	width: 260px;
	
	overflow: hidden;
}

#scroller {
	position: absolute;
	z-index: 1;
	-webkit-tap-highlight-color: rgba(0,0,0,0);
	
	-webkit-transform: translateZ(0);
	-moz-transform: translateZ(0);
	-ms-transform: translateZ(0);
	-o-transform: translateZ(0);
	transform: translateZ(0);
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	-webkit-text-size-adjust: none;
	-moz-text-size-adjust: none;
	-ms-text-size-adjust: none;
	-o-text-size-adjust: none;
	text-size-adjust: none;
}

#scroller ul {
	list-style: none;
	padding: 0;
	margin: 0;
	width: 100%;
	text-align: left;
}

#scroller li {
	border-color: #666666 #666666 #666666 #666666;
	padding: 0 10px;
	height: 40px;
	line-height: 40px;
	border-bottom: 1px solid #ccc;
	border-top: 1px solid #fff;
	background-color: #e5e5e5;
	font-size: 16px;
}

a {
    
    cursor:pointer;
}

.controls div, .controls div input {
    float:left;    
    margin-right: 10px;
}

#executeLink {
	clear:both; 
	margin-top:20px;
}
	
	</style>
	
	<div id="floating-panel">
      <strong>Bluetooth:</strong>
      <select id="Bluetooth">
        <option value="RTMS">RTMS</option>
        <option value="Tube">Tube</option>
      </select>
    </div>
    
	
	
		<div class="container">	
			<!-- Codrops top bar -->
			<div class="codrops-top clearfix">
				<a href="index.php">
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
					<a class="current-demo" href="operate.php">Homepage</a>
					<a href="flow.php">flow</a>
					<a href="frequency.php">frequency</a>
					<a href="index4.html">Demo 4</a>

				</nav>				
			</header>
			
			<section class="main clearfix"; style="height:700px; display: table">					
				
				
				
						
				<div style="float:right; width:260px; display: table-cell;">
				<div id="header"><a href="operate.php">Choose workzone route</a></div>
				
				<div id="scroller" style="width:260px" >
					<ul id="routelist" data-role= "listview" style="list-style:none">
						<li id="route1"><a href="#" onclick='routeSelect("1");'><strong>  NJ 21</strong></a></li>
						<li id="route2"><a href="#" onclick='routeSelect("2");'><strong>  US 22</strong></a></li>
						<li id="route3"><a href="#" onclick='routeSelect("3");'><strong>  Route 18</strong></a></li>
						<li id="route4"><a href="#" onclick='routeSelect("4");'><strong>  US 1</strong></a></li>
						<li id="route5"><a href="#" onclick='routeSelect("5");'><strong>  Route 7</strong></a></li>
						<li id="route6"><a href="#" onclick='routeSelect("6");'><strong>  NJ 31</strong></a></li>
						
					</ul>
				</div>	
				</div>
				
				
				<script type="text/javascript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
				<script>				
				//$("#scroller ul").append('<li id="route7"><a href="#" onclick='+'routeSelect("6")'+'><strong>NJ 33</strong></a></li>');
				/*
				 $('#haha').click(function(){
					 
					 alert("hello");
				 });*/

				
				</script>
				
				
				<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&v=3&libraries=geometry"></script>
				
				<div style="float:left; height:100%; display: table-cell; margin-bottom:0px;">
					<div id="map-canvas"></div>
					<div style="margin-left:0px; margin-top:0px">
						<input onClick="clearMarkers();" type=button value="Clear"  size="10">
						<input onClick="saveMarkers();" type=button value="Save"  size="10">
						<!-- <input onClick="saveLine();" type=button value="SaveLine"> -->
						<!-- <input onClick="show();" type=button value="Show">  -->
						<!--<input onClick="next();" type=button value="NextLine"> -->
						<!--<input onClick="newLine();" type=button value="NewLine"> -->
						<!--<input onClick="delMarkers();" type=button value="DeleteLine"> -->
						<!--&nbsp;&nbsp;&nbsp;Latitude:<input type="text" id="latInput" size="10">-->
						<!--&nbsp;&nbsp;&nbsp;Longitude:<input type="text" id="lngInput" size="10">-->
						<!--&nbsp;&nbsp;<input onClick="add();" type=button value="Save"> -->
						
						</div>
					
				
					


<!-- Form Name -->
<legend><strong>Input WorkZone Information</strong></legend>
<label>Input Route Information</label>
<INPUT id="addroute" type="text" name="addroute" class="form-control" size="17" placeholder="Enter Route Name"/>
<INPUT id="routeLat" type="text" name="routeLat" class="form-control" size="17" placeholder="Enter Latitude"/>
<INPUT id="routeLon" type="text" name="routeLon" class="form-control" size="17" placeholder="Enter Longtitude"/>
<INPUT type="button" value="Add Route" onclick="addRoute()"/>


<form class="eb" action="" method="post" enctype="multipart/form-data" id="eb">
<fieldset>

<!-- Form Name -->
<legend>Input EB Sensor Information</legend>
	<input type="hidden" name="ebformID" value="ebform" />
	

	<INPUT type="button" value="Add Row" onclick="addRow('dataTable1')"/>

	<INPUT type="button" value="Delete Row" onclick="deleteRow('dataTable1')"/>
	
	<INPUT type="button" value="Submit" onClick="addMark('dataTable1');"/>

	<TABLE id="Table" width="660px" border="1">
	<TR>
			<TD width="4%"></TD>	
			<TD width="24%">Latitude</TD>
			<TD width="24%">Longtitude</TD>
			<TD width="24%">MilePost</TD>
			<TD width="24%">Type(b/B,r/R,t/T,c/C)</TD>							
	</TR>
	</TABLE>
	<TABLE id="dataTable1" width="660px" border="1">
		
		<TR>
			<TD width="4%"><INPUT type="checkbox" name="chk"/></TD>
			<TD width="24%"><INPUT id="latInput" type="text" name="eblat" size="17"/></TD>
			<TD width="24%"><INPUT id="lngInput" type="text" name="eblong" size="17"/></TD>
			<TD width="24%"><INPUT id="ebmp" type="text" name="ebmp" size="17"/></TD>
			<TD width="24%"><INPUT id="ebtype" type="text" name="ebtype" size="17"/></TD>
		</TR>
	</TABLE>
	
</fieldset>
</form>


<form class="wb" action="" method="post" enctype="multipart/form-data" id="wb">
<fieldset>

<!-- Form Name -->
<legend>Input WB Sensor Information</legend>
	
	

	<INPUT type="button" value="Add Row" onclick="addRow('dataTable2')"/>

	<INPUT type="button" value="Delete Row" onclick="deleteRow('dataTable2')"/>
	
	<INPUT type="button" value="Submit" onclick="addMark('dataTable2')"/>

	<TABLE id="Table" width="660px" border="1">
	<TR>
			<TD width="4%"></TD>	
			<TD width="24%">Latitude</TD>
			<TD width="24%">Longtitude</TD>
			<TD width="24%">MilePost</TD>
			<TD width="24%">Type(b/B,r/R,t/T,c/C)</TD>							
	</TR>
	</TABLE>
	<TABLE id="dataTable2" width="660px" border="1">
		
		<TR>
			<TD width="4%"><INPUT type="checkbox" name="chk"/></TD>
			<TD width="24%"><INPUT id="wblat" type="text" name="wblat" size="17"/></TD>
			<TD width="24%"><INPUT id="wblong" type="text" name="wblong" size="17"/></TD>
			<TD width="24%"><INPUT id="wbmp" type="text" name="wbmp" size="17"/></TD>
			<TD width="24%"><INPUT id="wbtype" type="text" name="wbtype" size="17"/></TD>
		</TR>
	</TABLE>
	
</fieldset>
</form>


<form class="nb" action="" method="post" enctype="multipart/form-data" id="nb">
<fieldset>

<!-- Form Name -->
<legend>Input NB Sensor Information</legend>
	

	<INPUT type="button" value="Add Row" onclick="addRow('dataTable3')"/>

	<INPUT type="button" value="Delete Row" onclick="deleteRow('dataTable3')"/>
	
	<INPUT type="button" value="Submit" onclick="addMark('dataTable3')"/>

	<TABLE id="Table" width="660px" border="1">
	<TR>
			<TD width="4%"></TD>	
			<TD width="24%">Latitude</TD>
			<TD width="24%">Longtitude</TD>
			<TD width="24%">MilePost</TD>
			<TD width="24%">Type(b/B,r/R,t/T,c/C)</TD>							
	</TR>
	</TABLE>
	<TABLE id="dataTable3" width="660px" border="1">
		
		<TR>
			<TD width="4%"><INPUT type="checkbox" name="chk"/></TD>
			<TD width="24%"><INPUT id="nblat" type="text" name="nblat" size="17"/></TD>
			<TD width="24%"><INPUT id="nblong" type="text" name="nblong" size="17"/></TD>
			<TD width="24%"><INPUT id="nbmp" type="text" name="nbmp" size="17"/></TD>
			<TD width="24%"><INPUT id="nbtype" type="text" name="nbtype" size="17"/></TD>
		</TR>
	</TABLE>
	
</fieldset>
</form>


<form class="sb" action="" method="post" enctype="multipart/form-data" id="sb">
<fieldset>

<!-- Form Name -->
<legend>Input SB Sensor Information</legend>
	
	
	
	<INPUT type="button" value="Add Row" onclick="addRow('dataTable4')"/>

	<INPUT type="button" value="Delete Row" onclick="deleteRow('dataTable4')"/>
	
	<INPUT type="button" value="Submit" onclick="addMark('dataTable4')"/>

	<TABLE id="Table" width="660px" border="1">
	<TR>
			<TD width="4%"></TD>	
			<TD width="24%">Latitude</TD>
			<TD width="24%">Longtitude</TD>
			<TD width="24%">MilePost</TD>
			<TD width="24%">Type(b/B,r/R,t/T,c/C)</TD>						
	</TR>
	</TABLE>
	<TABLE id="dataTable4" width="660px" border="1">
		
		<TR>
			<TD width="4%"><INPUT type="checkbox" name="chk"/></TD>
			<TD width="24%"><INPUT id="sblat" type="text" name="sblat" size="17"/></TD>
			<TD width="24%"><INPUT id="sblong" type="text" name="sblong" size="17"/></TD>
			<TD width="24%"><INPUT id="sbmp" type="text" name="sbmp" size="17"/></TD>
			<TD width="24%"><INPUT id="sbtype" type="text" name="sbtype" size="17"/></TD>
		</TR>
	</TABLE>
	
</fieldset>
</form>






					
					
					</div>
				</div>
				

				
				
				<div style="float:right; width:460px; display: table-cell; margin-right:300px;margin-bottom:0px;">	
				<div id="inf"></div>
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
	<!--			<div id="segs">
					<p>Segments:</p>
				</div>
				<div id="currentSeg" style="display:block; float:left; margin-bottom:5px">
					<div>
					Segment Name: <input id = "segName" type="text" name="" style="float:none" value="" size="10" onChange="segNameChange(this.value)">
					</div>
					<div>
						Distance: <div id="disDisplay"></div> meters
						<?php echo "<br/>" ?>
						<input onClick="estDis();" type=button value="Estimate">
						<input id="disInput" type="text" name="" style="float:none" value="" size="10">
						
						<input onClick="updateDis();" type=button value="Update">
						
					</div>
					<div>
					<table id="segPoint" border="2" align="left" cellspacing="0" bordercolor="#7e8c9c">
						<tr><td>Start MilePost</td><td>End MilePost</td><td>Route Name</td><td>Direction</td></tr>
					</table>
					</div> -->
					<div>
					<input onClick="updateMarkerInf();" type=button value="Update">
					<input onClick="saveMarkerInf();" type=button value="Save">
					</div>
				</div> 
				<div id="showId" style="float:left">
				</div>
				<div id="pic" style="display:none; float:right">
					<!--<h4> Upload </h4> -->
					<form class="dPic" action="deletePic.php" method="post" enctype="multipart/form-data" id="delPic">
					<div id="showPic" style="width:240px">
					</div>
					<input type="submit" value="Delete" style="float:right; margin-right:0px">
					</form>
					
					<form class="upload" action="upload.php" method="post" enctype="multipart/form-data" id="upPic">
					<table>
					  <tr><td><input id = "start" type="text" name="start" style="display:none" value=""></td></tr>
					  <tr><td><input id = "end" type="text" name="end" style="display:none" value=""></td></tr>
					  <tr><td><textarea form ="upPic" name="description" id="des" cols="30" rows="5" wrap="none" ></textarea></td></tr>
					  <tr><td><input type="file" name="fileToUpload"></td></tr>
					  <tr><td><input type="submit" value="Upload"></td></tr>
					</table>
					<div class="progress">
					<div class="bar"></div >
					<div class="percent">0%</div >        
					<div id="status"></div>         
						</div>
					</form>
					
					
					<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
					<script src="http://malsup.github.com/jquery.form.js"></script>
					<script>
					(function() {

					  var bar = $('.bar');
					  var percent = $('.percent');
					  var status = $('#status');

					  $('.upload').ajaxForm({
						contentType: false,
						processData: false,
						cache: false,
						beforeSend: function() {
						  status.empty();
						  var percentVal = '0%';
						  bar.width(percentVal);
						  percent.html(percentVal);
						},
						uploadProgress: function(event, position, total, percentComplete) {
						  var percentVal = percentComplete + '%';
						  bar.width(percentVal);
						  percent.html(percentVal);
						},
						success: function() {
						  var percentVal = '100%';
						  bar.width(percentVal);
						  percent.html(percentVal);
						  alert("Successful");
						},
						complete: function(xhr) {
						  // status.html(xhr.responseText);
						  // show();
						  //if (xhr.responseText !) {};          
									// tttt = xhr.responseText;
									// var dir = window.location.href;
									// var url = "http://"; // = dir+"/../"+tttt;
									// var ele = dir.split('/');
									// for (var i = 2; i < ele.length-1; i++) {
									// 	url = url.concat(ele[i]+"/");
									// }
									// var x = document.getElementById("status").innerHTML
									// url = url+x.substr(1);
									// url = url.replace(/\s+/g, '');
									// var d = new Date();
									// var n = d.getTime();
									// tttt = tttt.replace(/\s+/g, '');
									// for (var i = 0; i < xhr.length; i++) {
									// 	document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+xhr[i]+"?"+n;
									// };
									
									// document.getElementById("imgId").src = xhr.responseText;
									// var img = new Image();
									// img.onload = function(){
									//   var width = img.width;
									//   var height = img.height;
									// }
									// img.src = url;
									// $("#imgId").attr("src", url);
									var pic = document.getElementById("showPic");
									
									pic.innerHTML = xhr.responseText;
						}
					  });
					})();
					</script>
					<script>
					(function() {
						var x = 0;
					  $('.dPic').ajaxForm({
						contentType: false,
						processData: false,
						cache: false,
						beforeSend: function() {
						  x = 0;
						},
						uploadProgress: function(event, position, total, percentComplete) {
						  x = percentComplete + '%';
						},
						success: function() {
						  x = '100%';
						  alert("success");
						},
						complete: function(xhr) {
							var pic = document.getElementById("showPic");
							pic.innerHTML = xhr.responseText;
						}
					  });
					})();
				 </script>
				</div>
				</div>
					
				</div>
				
				

				
				
			</section>
		</div><!-- /container -->
		

		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.mit.js"></script>
		<script type="text/javascript" src="js/gmaps.js"></script>
		<script type="text/javascript" src="js/jquery.dropdownnew.js"></script>
		<script type="text/javascript" src="js/iscroll.js"></script>

		<script type="text/javascript">
		
		//$("#scroller ul").append('<li id="route7"><a href="#" onclick='routeSelect("7");'><strong>NJ 31</strong></a></li>');
			
			var myScroll;

			function loaded () {
				myScroll = new IScroll('#wrapper', { mouseWheel: true, click: true , scrollX: true, scrollbars: 'custom' });
			}

			document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
			
			
		//$("#scroller ul").append('<li id="route7"><a href="#" onclick='routeSelect("7");'><strong>NJ 31</strong></a></li>');

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
  

function Item(location, mp, typ) {
    this.location = location;
    this.mp = mp;
    this.typ = typ;
}


  var polylines = [];
  var linePoints = [];
  var markerInf = [];
  var distance;
  var mid;
  var map;
  var tttt;
  var titleMarker;
  var infowindow;
  //var infowindow;
  //var infowindow = null;
  
	//define a global markers array variable, to push and pop the marker overlays
	var markers;
	//define global marker popup variable
	var popup;
	
  
  
              
  var allowedZoomLevel = 8;
  
  var allowedMapBounds = new google.maps.LatLngBounds(  
		new google.maps.LatLng(38.916667, -75.583333),   
		new google.maps.LatLng(41.356389, -73.894167)
  );
////////////////


//////////////////
    function routeSelect(count){
					//Enabling new cartography and themes
                    google.maps.visualRefresh = true;
					var myLatlng ;
					directionsDisplay = new google.maps.DirectionsRenderer();
					switch(count){
						case "1": {
									map.setZoom(16);
									map.setCenter(new google.maps.LatLng(40.781852, -74.149177)); 
									//map.setZoom(map.getZoom() + 6);
									//map.setZoom(12);
									
									break;
									}
						case "2": {
									map.setZoom(16);
									map.setCenter(new google.maps.LatLng(40.697946, -74.250065)); 
									//map.setZoom(map.getZoom() + 6);
									//map.setZoom(12);
									break;
									}
						case "3": {
									map.setZoom(16);
									map.setCenter(new google.maps.LatLng(40.500133, -74.441875)); 
									//map.setZoom(map.getZoom() + 6);
									//map.setZoom(12);
									break;
									}
						case "4": {
									map.setZoom(16);
									map.setCenter(new google.maps.LatLng(40.299369, -74.676483)); 
									//map.setZoom(map.getZoom() + 6);
									//map.setZoom(12);
									break;
									}
						case "5": {
									map.setZoom(16);
									map.setCenter(new google.maps.LatLng(40.772569, -74.12805)); 
									//map.setZoom(map.getZoom() + 6);
									//map.setZoom(12);
									break;
									}
						case "6": {
									map.setZoom(16);
									map.setCenter(new google.maps.LatLng(40.524359, -74.85474)); 
									//map.setZoom(map.getZoom() + 6);
									//map.setZoom(12);
									break;
									}


						default: break;
						}
					//document.write(count);
                    //Setting starting options of map
                    
                    //Getting map DOM element
                    //var mapElement = document.getElementById("map-canvas");

                    //Creating a map with DOM element which is just obtained
                    //map = new google.maps.Map(mapElement, mapOptions);
					
					//map.setCenter(new google.maps.LatLng(40.797441, -74.251313));
	}

  
////////////////
	function initialize() {
  
				
					
					//Enabling new cartography and themes
                    google.maps.visualRefresh = true;

 /////////////
		current =  0;
  	// segment.push(maxSeg());
		var mapCanvas = document.getElementById('map-canvas');  //Getting map DOM element
		//var myLatlng = new google.maps.LatLng(40.465440, -74.85698);  //<!-- Latitude, Longitude -->
		var myLatlng = new google.maps.LatLng(40.070000, -74.558333);

		//var directionsService = new google.maps.DirectionsService;
		directionsDisplay = new google.maps.DirectionsRenderer();
		
		//Setting starting options of map
		var minZoomLevel = 8;  
		var mapOptions = {
		  	zoom: minZoomLevel,  
			center: myLatlng,  
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			streetViewControl: false,
			scaleControl: true,
			disableDoubleClickZoom: true,
			draggableCursor: 'move',
			//draggingCursor: 'pointer'
			//backgroundColor: '#ff0000'
			//noClear: true
			//mapTypeControl: false
		}

		directionsDisplay.setMap(map);
		//Creating a map with DOM element which is just obtained
		map = new google.maps.Map(mapCanvas, mapOptions);
		
		
		//var trafficLayer = new google.maps.TrafficLayer();
		//trafficLayer.setMap(map);
		
	    //Registering map events to trigger checkBounds() function
        google.maps.event.addListener(map, 'drag', checkBounds);
        google.maps.event.addListener(map, 'zoom_changed', checkBounds);
  
  
  
		infowindow = new google.maps.InfoWindow({
			//content: contentString,
			maxWidth: 260
		  });
				
////////////////////		
		var controlDiv = document.createElement('DIV');
			$(controlDiv).addClass('gmap-control-container')
						 .addClass('gmnoprint');
					  
			var controlUI = document.createElement('DIV');
			$(controlUI).addClass('gmap-control');
			$(controlUI).text('Traffic');
			$(controlDiv).append(controlUI);
					  
			var legend = '<ul>'
					   + '<li><span style="background-color: #30ac3e">&nbsp;&nbsp;</span><span style="color: #30ac3e"> &gt; 80 km per hour</span></li>'
					   + '<li><span style="background-color: #ffcf00">&nbsp;&nbsp;</span><span style="color: #ffcf00"> 40 - 80 km per hour</span></li>'
					   + '<li><span style="background-color: #ff0000">&nbsp;&nbsp;</span><span style="color: #ff0000"> &lt; 40 km per hour</span></li>'
					   + '<li><span style="background-color: #c0c0c0">&nbsp;&nbsp;</span><span style="color: #c0c0c0"> No data available</span></li>'
					   + '</ul>';
					  
			var controlLegend = document.createElement('DIV');
			$(controlLegend).addClass('gmap-control-legend');
			$(controlLegend).html(legend);
			$(controlLegend).hide();
			$(controlDiv).append(controlLegend);
					  
			// Set hover toggle event
			$(controlUI)
				.mouseenter(function() {
					$(controlLegend).show();
				})
				.mouseleave(function() {
					$(controlLegend).hide();
				});
					  
			var trafficLayer = new google.maps.TrafficLayer();
					  
			google.maps.event.addDomListener(controlUI, 'click', function() {
				if (typeof trafficLayer.getMap() == 'undefined' || trafficLayer.getMap() === null) {
					$(controlUI).addClass('gmap-control-active');
					trafficLayer.setMap(map);
				} else {
					trafficLayer.setMap(null);
					$(controlUI).removeClass('gmap-control-active');
				}
			});
					  
			map.controls[google.maps.ControlPosition.TOP_RIGHT].push(controlDiv);
	
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
	  	setStatus(false);
	  }
		
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
		
		showMarkerInf();
		showDis();

		
  	// for (var i = 0; i < markerInf.length; i++) {
  	// 	document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+markerInf[i]+"WW,WW"+"\n";  	
  	// 	// for (var j = 0; j < allLinePoints[i].length; j++) {
  	// 	//  	document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+allLinePoints[i][j][1]+"WW,WW"+allLinePoints[i][j][0]+"\n";
  	// 	//  }; //allMarkers[i]
  	// };
	
	
	
	
  
	
		
		google.maps.event.addListener(map, 'click', function(event) {
		
		var e = document.getElementById("ebtype");
		var typ = e.options[e.selectedIndex].value;
		var mp = document.getElementById("ebmp").value;
	
			markerTitle = (Number(maxTitle())+1).toString();
	    //MarkSensor(event.latLng, mp, typ);
		addMarker(event.latLng);
		//map.setCenter(google.maps.Marker.getPosition()); // xin
	  });
	  

	
	  
	  showSeg();
	  updateSegName();
	  
					//Defining control parameters
                    var controlDiv = document.createElement('div');
                    controlDiv.className = 'mapControl';
                    controlDiv.id = 'mapCoordinates';
                    controlDiv.innerHTML = 'Lat/Lng: 0.00 / 0.00';

                    //Creating a control and adding it to the map.
                    map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(controlDiv);

                    //Listening the map for mousemove event to show it in control.
                    google.maps.event.addListener(map, 'mousemove', function(e) {
                        var coordinateText = 'Lat/Lng: ' + e.latLng.lat().toFixed(6) + ' / ' + e.latLng.lng().toFixed(6);
                        controlDiv.innerHTML = coordinateText;
                    });
  }
//////////////////////////

	function checkBounds() {
                  if (map.getZoom() < allowedZoomLevel) map.setZoom(allowedZoomLevel);

                  if (allowedMapBounds) {
                      //Getting the allowed bounds.
                      var allowedNELng = allowedMapBounds.getNorthEast().lng();
                      var allowedNELat = allowedMapBounds.getNorthEast().lat();
                      var allowedSWLng = allowedMapBounds.getSouthWest().lng();
                      var allowedSWLat = allowedMapBounds.getSouthWest().lat();

                      //Getting the recent bounds of map.
                      var recentBounds = map.getBounds();
                      var recentNELng = recentBounds.getNorthEast().lng();
                      var recentNELat = recentBounds.getNorthEast().lat();
                      var recentSWLng = recentBounds.getSouthWest().lng();
                      var recentSWLat = recentBounds.getSouthWest().lat();

                      var recentCenter = map.getCenter();
                      var centerX = recentCenter.lng();
                      var centerY = recentCenter.lat();

                      var nCenterX = centerX;
                      var nCenterY = centerY;

                      //Comparing the allowed and recent values to keep map in bounds.
                      if (recentNELng > allowedNELng) centerX = centerX - (recentNELng - allowedNELng);
                      if (recentNELat > allowedNELat) centerY = centerY - (recentNELat - allowedNELat);
                      if (recentSWLng < allowedSWLng) centerX = centerX + (allowedSWLng - recentSWLng);
                      if (recentSWLat < allowedSWLat) centerY = centerY + (allowedSWLat - recentSWLat);

                      if (nCenterX != centerX || nCenterY != centerY) {
                          map.panTo(new google.maps.LatLng(centerY,centerX));
                      }
                      else {
                          return;
                      }
                  }
              }

  ///////////////
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
  		// segment.push(Number(mk[0]));
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
		//milepost:mp,
		//type:typ,
	    title: markerTitle,
	    draggable: true
	  });


		var infowindow = new google.maps.InfoWindow({
	  
		  maxWidth: 300,
		  //content:"Hello World!",
		  //content:"mp: <input type='text' value='"+mp+"'>"
		  content:"Geocode: <input type='text' size=20 value='"+marker.position+"'><p>"+
		  	"</p>Mile Post: <input type='text' value='"+marker.milepost+"'><p>"+
		  	"</p>Sensor Type: <input type='text'  value='"+marker.type+"'>"	
		});

	  google.maps.event.addListener(marker, 'click', function() {
	  infowindow.open(map,marker);
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

	function edit(t) {
		var newP = new google.maps.LatLng(document.getElementById('lat00').value, document.getElementById('lng00').value);
		var id = titleToId(t); 
		markers[id].setOptions({
			position:newP,
		});
		//var MP = document.getElementById('MP').value;
		//var sensor = document.getElementById('sensor').value;
		updateLine(t);
	}

	function updateLine(id) {
  	var ind = [];
  	var temp = [];
  	var st = -1;
  	var ed = -1;
  	
  	for (var i = 0; i < linePoints.length; i++) {
  		if (linePoints[i][0].toString() == id) {
  			polylines[i].setMap(null);
  			ed = linePoints[i][1];
  		} else if (linePoints[i][1].toString() == id) {
  			polylines[i].setMap(null);
  			st = linePoints[i][0];
  		} else {
  			temp.push(polylines[i]);
  			ind.push(linePoints[i]);
  		}
  	}
  	linePoints = ind;
  	polylines = temp;
  	var i0 = titleToId(id);
  	if (st!=-1) {
  		var i1 = titleToId(st);
  		addLine(markers[i1].position, markers[i0].position);
  		linePoints.push([st,id]);
  	}
  	if (ed!=-1) {
  		var i2 = titleToId(ed);
  		addLine(markers[i0].position, markers[i2].position);
  		linePoints.push([id,ed]);
  	}

  	// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"X:"+st+"R:"+id+"S:"+ed+linePoints.length;
  	// for (var i = 0; i < linePoints.length; i++) {
  	// 	document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"H:"+linePoints[i][0]+"J:"+linePoints[i][1];
  	// };
  }

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
				  var id = getLineId();
				  this.setEditable(false);
				  // document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"i:"+id+"s:"+linePoints.length+polylines.length;
				  document.getElementById("start").value = linePoints[id][0];
				  document.getElementById("end").value = linePoints[id][1];
				  document.getElementById("showId").innerHTML = "<strong>From   </strong>"+linePoints[id][0]+" <strong>To   </strong>"+linePoints[id][1];
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
		//var content="Lat: <input type='text' id='lat00' value='"+event.latLng.lat().toFixed(6)+"'><p>"+
		//  	"</p>Lng: <input type='text' id='lng00' value='"+event.latLng.lng().toFixed(6)+"'>";
		
		/////////
		
	
		
		var content="Latitude: <input type='text' id='lat00' value='"+event.latLng.lat().toFixed(6)+"'><p>"+
		  	"</p>Longtitude: <input type='text' id='lng00' value='"+event.latLng.lng().toFixed(6)+"'><p>"+
		  	"</p>Mile Post: <input type='text' id='lng00' value='"+"'><p>"+
		  	"</p>Sensor Type: <input type='text' id='lng00' value='"+"'>";

		
			
		  infowindow.setContent(content);
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

	var labelIndex = 0;	
	
	function markSensor(location, mp, typ){
	  var type;
	  if(typ=="b" || typ=="B") type="Bluetooth";
	  if(typ=="r" || typ=="R") type="RTMS";
	  if(typ=="t" || typ=="T") type="Tube Counter";
	  if(typ=="c" || typ=="C") type="Camera(time-lapse)";
	  
	  var marker = new google.maps.Marker({
	    position: location,
		label: typ.toUpperCase(),
		milepost:mp,
		type:type,
	    map: map,
	    title: markerTitle,
	    draggable: true
	  });
	  
	 
	  
	  
	  
	  var infowindow = new google.maps.InfoWindow({
	  
		  maxWidth: 300,
		  //content:"Hello World!",
		  //content:"mp: <input type='text' value='"+mp+"'>"
		  content:"Geocode: <input type='text' size=20 value='"+location+"'><p>"+
		  	"</p>Mile Post: <input type='text' value='"+mp+"'><p>"+
		  	"</p>Sensor Type: <input type='text'  value='"+type+"'>"	
	  });
	  
	  google.maps.event.addListener(marker, 'click', function() {
	  infowindow.open(map,marker);
	  });
	  
	  
	  if (marker.label=='B')	  markers.push(marker);

	  if (markers.length >= 2) {
	  	var latLng0 = markers[markers.length-2].position;
  		var latLng1 = markers[markers.length-1].position;
	  	addLine(latLng0, latLng1);
	  	linePoints.push([markers[markers.length-2].getTitle(),markers[markers.length-1].getTitle()]);
	  }

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

	function updateMarkers() {
		// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"LLLLLL: "+markers.length;
		var index = [];
		var tempMarkerInf = [];
		var ind = 0;
		for (var i = 0; i < markers.length; i++) {
			if(markers[i].getMap() != null) {
				index.push(markers[i]);
				tempMarkerInf.push(markerInf[i]);
			} else {
				// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"NN: "+markers[i].getTitle();
				deleteLine(markers[i].getTitle());
			}
		}	
		markers = index;
		markerInf = tempMarkerInf;
		updateMarkerInf();
		// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"OOOOO: "+markers.length;
	}

	function clearMarkers() {
  	for (var i = markers.length - 1; i >= 0; i--) {
  		markers[i].setMap(null);
  	}
  	markers = [];
  	// mid = 0;
  	
  	for (var i = 0; i < polylines.length; i++) {
  		polylines[i].setMap(null);
  	}
  	polylines = [];
  	linePoints = [];
  }

	function saveMarkers() {
  	// for (var i = 0; i < markerInf.length; i++) {
  	// 	document.getElementById("inf").innerHTML = "ss:"+document.getElementById("inf").innerHTML+markerInf[i]+"oo";
  	// };
  	var num = markers.length;
  	var latLng = '';
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
        document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"IIIIII"+xmlhttp.responseText;
        // alert("success");
      }
    }
    
    updateMarkerInf();
    var message = "";
  	for (var i = 0; i < markerInf.length; i++) {
  		var inf = markerInf[i];
  		message = message+markers[i].getTitle()+','+inf[0]+','+inf[1]+','+inf[2]+";";
  	}

    xmlhttp.open("POST","saveMarker.php?"+$.now(),true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("num="+num+"&lat="+latLng+"&segment="+segment[current]+"&markerInf="+message+"&segName="+allSegNames[current]+"&dis="+distance);
    saveLine();
  }

	function addMarkerInf(title, inf) {
  	var tableEle = document.getElementById("segPoint");
  	var mes = "<tr><td><input id = 'dn"+title+"' type=text size=12 value='"+inf[0]+"'></td><td><input id = 'mp"+title+"' type=text size=12 value='"+inf[1]+"'></td><td><input id = 'rn"+title+"' type=text size=12 value='"+inf[2]+"'></td><td><input id = 'dd"+title+"' type=text size=12 value='"+inf[3]+"'></td></tr>"
  	tableEle.innerHTML = tableEle.innerHTML+mes;
  }

	function addLine(latLng0, latLng1) {
  	if (markers.length < 2) {
  		return;
  	} else {  		
  		var request = {
			  origin:latLng0,
			  destination:latLng1,
			  travelMode: google.maps.TravelMode.DRIVING
		  	};
			var polyline = new google.maps.Polyline({
				path: [],
				strokeColor: '#FF0000',
				strokeWeight: 10,
				editable: false,
				map: map,
			});

	  	directionsService.route(request, function(response, status) {
			  if (status == google.maps.DirectionsStatus.OK) {
			  	//directionsDisplay.setDirections(response);
					var legs = response.routes[0].legs;
				  for (i=0;i<legs.length;i++) {
					  var steps = legs[i].steps;
		        for (j=0;j<steps.length;j++) {
		          var nextSegment = steps[j].path;
				
							for (k=0;k<nextSegment.length;k++) {
			            polyline.getPath().push(nextSegment[k]);              
							}
					  }
					}
					polyline.setMap(map);
					polylines.push(polyline);
					estDis();
					// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"DDD:"+polylines.length+"EEE";
					
					google.maps.event.addListener(polyline,'click', function(e) {
					  document.getElementById("pic").style.display="block";
					  this.setEditable(true);
					  var id = getLineId();
					  this.setEditable(false);
					  //document.getElementById("test").innerHTML = document.getElementById("test").innerHTML+"i:"+id+"s:"+linePoints.length;
					  document.getElementById("start").value = linePoints[id][0];
					  document.getElementById("end").value = linePoints[id][1];
					  document.getElementById("showId").innerHTML = "<strong>From   </strong>"+linePoints[id][0]+" <strong>To   </strong>"+linePoints[id][1];
					  show();
					});
			  }
			  else {
			  	document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"GGGGGGGG";
			  }
		  });
  	}
  }

	function getLineId() {
  	//document.getElementById("test").innerHTML = document.getElementById("test").innerHTML+"X:"+polylines.length;
  	for (var i = polylines.length - 1; i >= 0; i--) {
  		if(polylines[i].getEditable() == true)
  			return i;
  	}
  	return -1;
  }

	function deleteLine(id) {
  	var ind = [];
  	var temp = [];
  	var st = -1;
  	var ed = -1;
  	// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"R:"+id+" "+linePoints.length;
  	for (var i = 0; i < linePoints.length; i++) {
  		if (linePoints[i][0].toString() == id ) {
  			polylines[i].setMap(null);
  			ed = linePoints[i][1];
  		} else if (linePoints[i][1].toString() == id) {
  			polylines[i].setMap(null);
  			st = linePoints[i][0];
  		} else {
  			temp.push(polylines[i]);
  			ind.push(linePoints[i]);
  		}
  	}
  	linePoints = ind;
  	polylines = temp;
  	if ((st!=-1)&&(ed!=-1)) {
  		var i0 = titleToId(st);
  		var i1 = titleToId(ed);
  		addLine(markers[i0].position, markers[i1].position);
  		linePoints.push([st,ed]);
  	}
  }

	function titleToId(title) {
  	for (var i = markers.length - 1; i >= 0; i--) {
  		if(markers[i].getTitle()==title)
  			return i;
  	}
  }

	function saveLine() {
  	var num = polylines.length;
  	var pathVar = '';
  	for (var i = 0; i < polylines.length; i++) {
  		pathVar = pathVar+linePoints[i][0]+','+linePoints[i][1]+',';

  		var paths = polylines[i].getPath();
  		// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+pathVar+num+paths;
  		paths.forEach(function(p, index) {
  			// p.forEach(function(pi, ind) {
  				// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+p+index;
  			// })
  			pathVar = pathVar+p.lat()+'?'+p.lng()+']';
  		});
  		pathVar = pathVar+'!';
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
    // document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+pathVar;
    // window.location.assign("saveMarker.php?num="+num+"&lat="+latLng);
    xmlhttp.open("POST","savePath.php?"+$.now(),true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("num="+num+"&line="+pathVar+"&segment="+segment[current]);
  }

  google.maps.event.addDomListener(window, 'load', initialize);  

  function add() {
  	var lat = document.getElementById("latInput").value;
  	var lng = document.getElementById("lngInput").value;
  	var latLng = new google.maps.LatLng(lat, lng);
  	markerTitle = (Number(maxTitle())+1).toString();
	
						
  	addMarker(latLng);
	//MarkSensor(latLng, mp, typ);
	
  }
  
		function addRow(tableID){
			var table=document.getElementById(tableID);
			var rowCount=table.rows.length;
			var row=table.insertRow(rowCount);
			var colCount=table.rows[0].cells.length;
			for(var i=0;i<colCount;i++){
				var newcell=row.insertCell(i);
				newcell.innerHTML=table.rows[0].cells[i].innerHTML;
				//alert(newcell.childNodes[0].type);
				switch(newcell.childNodes[0].type)
				{
					case"text":
						newcell.childNodes[0].value=""; break;
					case"checkbox":
						newcell.childNodes[0].checked=false; break;
					//case"select-one":
					//default:
						//newcell.childNodes[0].selectedIndex=0;
						//newcell.childNodes[0].id="ebtype"+rowCount; 
						//newcell.childNodes[0].getElementsByTagName('select')[0]
						//alert(newcell.childNodes[0].id);
						 //break;
				}
			}
			
		}
		function routeInsert(){
			google.maps.visualRefresh = true;
			var myLatlng;
			directionsDisplay = new google.maps.DirectionsRenderer();
			var lat=document.getElementById("routeLat").value;
			var lon=document.getElementById("routeLon").value;
			//var LatLon = new google.maps.LatLng(lat, lon);
			
			map.setZoom(16);
			//map.setCenter(new google.maps.LatLng(40.781852, -74.149177)); 
			//map.setCenter(new google.maps.LatLng(40.697946, -74.250065)); 
			map.setCenter(new google.maps.LatLng(lat, lon)); 
			//map.setCenter(LatLon);
			
		}
		addRoute = function() {
			var routeName = document.getElementById("addroute").value;
			//var lat=document.getElementById("routeLat").value;
			//var lon=document.getElementById("routeLon").value;
			//var LatLon = new google.maps.LatLng(lat, lon);
			
			//$("#scroller ul").append('<li id="route7"><a href="#" onclick='+'routeSelect("6")'+'><strong>NJ 35</strong></a></li>');
			var ul = document.getElementById("routelist");	
			//ul.innerHTML += "<li>List Item!</li>";
	
	
			var li = document.createElement("li");
			var children = ul.children.length + 1;
			li.setAttribute("id", "route"+children);
			//li.appendChild(document.createTextNode("Route "+children));
			
			//li.appendChild(document.createTextNode(routeName));
			//li.innerHTML='<li><a href="#" onclick='+'routeInsert("LatLon")'+'><strong>'+routeName+'</strong></a></li>';
			li.innerHTML='<li><a href="#" onclick='+'routeInsert()'+'><strong>'+routeName+'</strong></a></li>';
			//li.innerHTML='<li id="route7"><a href="#" onclick='+'routeSelect("5")'+'><strong>NJ 111</strong></a></li>';
			
			ul.appendChild(li);

			//alert("hello");
			
		}
		
		function addMark(tableID){
			var table=document.getElementById(tableID);
			var rowCount=table.rows.length;
			var colCount=table.rows[0].cells.length;
			for (var i=0;i<rowCount;i++){
				//for (var j=0;j<colCount;j++){
					//if (table.rows[i].cells[4].childNodes[0].value == "bluetooth"){
						
						var lati = table.rows[i].cells[1].childNodes[0].value;
						var lngti = table.rows[i].cells[2].childNodes[0].value;
						var mp = table.rows[i].cells[3].childNodes[0].value;
						var typ = table.rows[i].cells[4].childNodes[0].value;
						
						var latLng = new google.maps.LatLng(lati, lngti);
						
						//var e = document.getElementById("ebtype"+i);						
						//var typ = e.options[e.selectedIndex].value;
												
						markerTitle = (Number(maxTitle())+1).toString();
						//alert(typ);
						//addMarker(latLng);
						markSensor(latLng, mp, typ);
						
				//}
			}
		}
		function deleteRow(tableID){
			try{
				var table=document.getElementById(tableID);
				var rowCount=table.rows.length;
				for(var i=0;i<rowCount;i++){
					var row=table.rows[i];
					var chkbox=row.cells[0].childNodes[0];
					if(null!=chkbox&&true==chkbox.checked){
						if(rowCount<=1){
							alert("Cannot delete all the rows.");break;
							}
						table.deleteRow(i);rowCount--;i--;
						clearMarkers();
						
					}
				}
			}catch(e){alert(e);}
			addMark(tableID);
			}

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
    		pic.innerHTML = xmlhttp.responseText;//"<img src=\'"+ xmlhttp.responseText +"\' width=\"80px\" height=\"100px\"/>";
					// pic.style.background = "url(\""+xmlhttp.responseText+"\")";
        // document.getElementById("imgId").src= "\""+xmlhttp.responseText+"\"";  <img id="imgId" width="100px" height="200px" /> 
      }
    }
    xmlhttp.open("GET","showImage.php?start="+document.getElementById("start").value+"&end="+document.getElementById("end").value+"&"+$.now(), true);
    xmlhttp.send();  	
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

  function newLine() {
  	if (current < allPolylines.length) {
  		allPolylines[current] = polylines;
  		allMarkers[current] = markers;
  		allLinePoints[current] = linePoints;
  		allMarkerInfs[current] = markerInf;
  		allDis[current] = distance;
  		setStatus(false);
  		current = allPolylines.length;
  		segment.push(maxSeg()+1);
  	} else {
  		allPolylines.push(polylines);
  		allMarkers.push(markers);
  		allLinePoints.push(linePoints);
  		allMarkerInfs.push(markerInf);
  		allDis.push(distance);
  		setStatus(false);
  		current++;
  		segment.push(maxSeg()+1);
  	}
  	// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"Seg:"+segment[current];
  	polylines = [];
  	markers = [];
  	linePoints = [];
  	markerInf = [];
  	distance = 0;
  	showDis();
  	showMarkerInf();
  	showSeg();
  }

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

  function showMarkerInf() {
  	var tableEle = document.getElementById("segPoint");
  	var mes = "<tr><td>Start MilePost</td><td>End MilePost</td><td>Route Name</td><td>Direction</td></tr>";
  	tableEle.innerHTML = mes;
  	for (var i = 0; i < markers.length; i++) {
  		addMarkerInf(markers[i].getTitle(), markerInf[i]);
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

  function updateSegName() {
  	document.getElementById('segName').value = allSegNames[current];
  }

  function updateDis() {
    distance = document.getElementById('disInput').value;
    document.getElementById('disDisplay').innerHTML = distance ;
  }

  function estDis() {
  	var dis = 0;
  	for (var i = 0; i < polylines.length; i++) {
  		var paths = polylines[i].getPath();
  		var plat;
  		var plng;
  		var sLatLng;
  		var set = 0;
  		paths.forEach(function(p, index) {
  			// p.forEach(function(pi, ind) {
  				// document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+p+index;
  			// })
  			if (set == 0) {
  				plat = p.lat();
  				plng = p.lng();
  				sLatLng = new google.maps.LatLng(p.lat(), p.lng());
  				set = 1;
  			} else {
  				dis = dis +  google.maps.geometry.spherical.computeDistanceBetween(p, sLatLng);
				//dis = dis * 0.000621371;
  				// dis = dis+ Math.sqrt(Math.pow((p.lat()-plat),2)+Math.pow((p.lng()-plng),2));
  			}
  		})
  	}
  	distance = dis;
    document.getElementById('disDisplay').innerHTML = dis ;
  }

  function showDis() {
    document.getElementById('disDisplay').innerHTML = distance ;
  }
  
</script>
		
		
		
</body>
</html>
