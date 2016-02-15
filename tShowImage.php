
<!doctype html>
<html>
<head>

</head>
<body>

<script>
  function show() {
    var xmlhttp;
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        // document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+xmlhttp.responseText;
    //     var image = new Image();
        // image.src = xmlhttp.responseText;
        // image.onload = function() {
        //     body.drawImage(image, 50, 50);
        // };
      //   var img = $('<img />', {src : xmlhttp.responseText});
        // img.appendTo('body');
       // var pic = document.getElementById('showPic');
       // pic.innerHTML = xmlhttp.responseText;
          // pic.style.background = "url('"+xmlhttp.responseText+"')";
          // var s = xmlhttp.responseText.replace(/\s+/g, '').toString();
          // document.getElementById('Img2').src = xmlhttp.responseText;//.concat(s);
          // createImg(s, "Img2");
          // return false;
        //document.getElementById("imgId").src= xmlhttp.responseText;
      }
    }
    // document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"latLng";
    //window.location.assign("saveMarker.php?num="+num+"&lat="+latLng);
    xmlhttp.open("POST","ttshow.php?"+$.now(),true);

    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send();   
    alert("HH");
     document.getElementById("inf").innerHTML = document.getElementById("inf").innerHTML+"YY";
  }

  // function createImg( path, nodeID ) { 

  //   var img = new Image(),
  //       isLoaded = false;

  //   img.onload = function() {

  //       document.getElementById( nodeID ).appendChild( img );

  //       isLoaded = true;

  //       alert(isLoaded);
  //   };

  //   img.src = path;
// };
  
</script>
XX
<div id="showPic" style="width:200px; height:300px">  </div>
<img id="Img2" style="width:200px; height:300px"/>
<input onClick="show();" type=button value="Show"> 
<div id="inf"></div>

</body>
</html>
