<!DOCTYPE html>
<html>
<head>
	<title>KATHINK</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/default.css') }}">

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/suksesregister/sukses.css') }}">

		<script type="text/javascript">
		var status ="open";
		
		function show(){
			if (status == "open"){
			document.getElementById("side").style.left="0px";
			document.getElementById("tombol").className="laser";
			document.getElementById("ling").className="holycircle";
			document.getElementById("strip").className="strip2";
			document.getElementById("strip2").className="strip2";
			document.getElementById("strip3").className="strip2";
			status = "close";
			}
		 else {
			document.getElementById("side").style
			.left="-9200px";
			document.getElementById("tombol").className="text";
			document.getElementById("ling").className="circle";
			document.getElementById("strip").className="strip";
			document.getElementById("strip2").className="strip";
			document.getElementById("strip3").className="strip";
			status="open";
		}
	}

	</script>

</head>

<body onload="show()">
	<div class="navtop">
		<font class="text" onclick="show()" id="tombol">KATHINK</font>
		<span onclick="show()" style="cursor: pointer;">
		<div class="circle" id="ling"></div>
		<div class="strip" style="top: 60px;left: 560px;" id="strip"></div>
		<div class="strip" style="top: 80px;left: 555px;" id="strip2"></div>
		<div class="strip" style="top: 100px;left: 550px" id="strip3"></div>
		</span>
	</div>

	<div class="sidenav" id="side">
		<a class="first" href="/register" style="right: 1100px;">Registration</a>
		<a class="first" href="#" style="right: 900px;">Login</a>
		<a class="first" href="#" style="right: 450px;">University Info</a>
		<a class="first" href="#" style="right: 180px;">Contact</a>
	</div>

	<div class="container"></div>
	<div class="kathink">SUKSES</div>
	<div class="kathink2">SUKSES</div>

	<img src="suksesimg.png">

</body>
</html>