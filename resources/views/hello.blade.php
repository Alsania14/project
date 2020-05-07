<!DOCTYPE html>
<html>
<head>
	<title>Kathink</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style640.css') }}" media="(min-width: 2300px)">

	<meta name="csrf-token" content="{{ csrf_token() }}">

		<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/stylekecil.css') }}" media="(max-width: 2300px)">

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

<script type="text/javascript">
		var x = 100;	

		window.onscroll = function slider() {
		var a = window.scrollY;
		if (a > 100 && a < 900) {
			b = a/330;
			a = a/10;
			c = a+120;
		document.getElementById("img2").style.top=600+a+"px";
		document.getElementById("img3").style.top=600+b+"px";
		document.getElementById("img1").style.top=(600-c)+"px";
		console.log(a);
	    }else {
	    	document.getElementById("img2").style.top=500+"px";
	    	document.getElementById("img3").style.top=500+"px";
	    	document.getElementById("img1").style.top=500+"px";
		console.log(a);
	    }
	    if (a > 1900 && a < 4800) {
	    	document.getElementById("par1").style.top="3475px"
	    	document.getElementById("bigimg1").style.left=-600+x+"px";
	    	if (x < 580){
	    	x+=15;
	    	}
	    	console.log(a);
	    } else {
	    	document.getElementById("bigimg1").style.left="-900px";
	    	x=10;
	    }
	}

	var lokasi = 2;
	function ctrlkanan(){
		lokasi+=1;

		if(lokasi > 3){
			lokasi = 1;
		}

		if(lokasi == 1){
			document.getElementById("ic3").style.left="20%";
			document.getElementById("ic1").style.left="50%";
			document.getElementById("ic2").style.left="80%";

			document.getElementById("ic2").style.top="4800px";
			document.getElementById("ic3").style.top="4800px";
			document.getElementById("ic1").style.top="5300px";
		}else if(lokasi == 2){
			document.getElementById("ic1").style.left="20%";
			document.getElementById("ic2").style.left="50%";
			document.getElementById("ic3").style.left="80%";

			document.getElementById("ic1").style.top="4800px";
			document.getElementById("ic3").style.top="4800px";
			document.getElementById("ic2").style.top="5300px";

		}else if(lokasi == 3){
			document.getElementById("ic2").style.left="20%";
			document.getElementById("ic3").style.left="50%";
			document.getElementById("ic1").style.left="80%";

			document.getElementById("ic2").style.top="4800px";
			document.getElementById("ic1").style.top="4800px";
			document.getElementById("ic3").style.top="5300px";
		}

		
	}

	function ctrlkiri(){
		lokasi-=1;

		if(lokasi < 1){
			lokasi = 3;
		}

		if(lokasi == 1){
			document.getElementById("ic3").style.left="20%";
			document.getElementById("ic1").style.left="50%";
			document.getElementById("ic2").style.left="80%";

			document.getElementById("ic2").style.top="4800px";
			document.getElementById("ic3").style.top="4800px";
			document.getElementById("ic1").style.top="5300px";
		}else if(lokasi == 2){
			document.getElementById("ic1").style.left="20%";
			document.getElementById("ic2").style.left="50%";
			document.getElementById("ic3").style.left="80%";

			document.getElementById("ic1").style.top="4800px";
			document.getElementById("ic3").style.top="4800px";
			document.getElementById("ic2").style.top="5300px";

		}else if(lokasi == 3){
			document.getElementById("ic2").style.left="20%";
			document.getElementById("ic3").style.left="50%";
			document.getElementById("ic1").style.left="80%";

			document.getElementById("ic2").style.top="4800px";
			document.getElementById("ic1").style.top="4800px";
			document.getElementById("ic3").style.top="5300px";
		}
	}
		
</script>

	<img src="background.jpg" style="width: 100%;height: 1400px; top: 10px;z-index: -10;box-shadow: 0px 0px 122px black;filter: grayscale(100%);">
	<font class="kathink">KATHINK</font>
	<font class="kathink2">KATHINK</font>
	
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
		<a class="first" href="{{ url('register') }}" style="right: 1100px;">Registration</a>
		<a class="first" href="{{ url('login') }}" style="right: 900px;">Login</a>
		<a class="first" href="#" style="right: 450px;">University Info</a>
		<a class="first" href="#" style="right: 180px;">Contact</a>


		<a class="kecil" href="#" style="left:100px;top: 200px;">Registration</a>
		<a class="kecil" href="#" style="left:100px;top: 300px;">Login</a>
		<a class="kecil" href="#" style="left:100px;top:400px;">University Info</a>
		<a class="kecil" href="#" style="left:100px;top: 500px;">Contact</a>

	</div>
	<img src="cool1.jpg" style="right: 200px;top: 500px;box-shadow: 0px 0px 80px 0px black;z-index: -1;" id="img3">
	<img src="cool2.jpg" style="right: 700px;top: 500px;box-shadow: 0px 0px 80px 0px black;z-index: -1;" id="img2">
	<img src="cool5.jpg" style="right: 1200px;top: 500px;box-shadow: 0px 0px 80px 0px black;z-index: -1;" id="img1">


	<div class="spanduk"><img src="new orang.png" id="bigimg1" style="	left: -900px;">
	<div class="sidetext" >EDUCATION</div>
	</div>

	<video autoplay muted loop id="myVideo" width="100%" style="position: absolute;top: 1500px;box-shadow: 0px 0px 122px black;">
  	<source src="KATHINK.mp4" type="video/mp4">
  	Your browser does not support the video tag.
	</video>

	<h1 style="top: 2520px;">ABOUT KATHINK</h1>
	<p style="top: 3500px;" id="par1"> KATHINK merupakan sebuah layanan edukasi berbasis website untuk membantu teman - teman mahasiswa yang memerlukan bantuan les privat, tenaga pengajar KATHINK merupakan kakak tingkat pada sebuah PROGRAM STUDI, yang sudah diseleksi dengan beberapa persyaratan dan ketentuan KATHINK. AYO mulai dalami materi perkuliahan mu danjadilah bagian dari KATHINK</p>

	<h2 id="info" style="top: 4300px;">MORE INFO</h2>

	<img src="icon join.png" class="icon" style="left: 20%;" id="ic1">
	<img src="icon find.png" class="icon" style="left: 50%; top: 5300px;" id="ic2">
	<img src="icon wallet.png" class="icon" style="left: 80%;" id="ic3">

	<div class="segitiga" style="border-right: 100px solid black;left: 40%;" onclick="ctrlkiri()"></div>
	<div class="segitiga" style="border-left: 100px solid black;left: 60%" onclick="ctrlkanan()"></div>

	<p class="infop" id="infop1">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exe</p>

</body>
</html>