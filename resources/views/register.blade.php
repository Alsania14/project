<!DOCTYPE html>
<html>
<head>
	<title>Kathink</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/default.css') }}" media="(min-width: 2300px)">

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/registrasi/cssregistrasi50.css') }}" media="(min-width: 2300px)">

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=3.0">

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
		function ajax(str) {
			var xhttp= new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200){
					document.getElementById("win").innerHTML=this.responseText;
				}
			}
			xhttp.open("GET","ajax?q="+str,true);
			xhttp.send();
		}

		function ajax2(str2){
			var ambil = new XMLHttpRequest();
			ambil.onreadystatechange = function(){
				if(this.readyState==4 && this.status == 200){
					document.getElementById("prod").innerHTML=this.responseText;
				}
			}
			ambil.open("GET","prodiajax.php?v="+str2,true);
			ambil.send();
		}
</script>
	
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

	</div>

<div class="container">
	<h1>Buat Akun</h1>

	<form action="{{ url('/posregister') }}" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}
		{{method_field('POST')}}

		<label style="top: 350px;">Nama</label>
		<input type="text" name="nama" style="top: 360px;" id="jsnama">

		<label style="top: 450px;">Tempat Lahir</label>
		<input type="text" name="tempat_lahir" style="top: 460px;" id="jstempat_lahir">

		<label style="top: 550px;">Alamat</label>
		<input type="text" name="alamat" style="top: 560px;" id="jsalamat">

		<label style="left:600px;top: 550px;">Provinsi</label>
		<select style="left:900px;top: 560px;">
			@foreach($provinsi as $daerah)
				<option>{{ $daerah->nama }}</option>
			@endforeach
		</select>

		<label style="top: 650px;">Semester</label>
		<input type="text" name="semester" style="top: 660px;" id="jssemester">

		<label style="top: 750px;right: 290px;">Jenis Kelamin</label>
		<input class="radio" type="radio" name="jenis_kelamin" value="laki" style="top: 860px;">
		<input class="radio" type="radio" name="jenis_kelamin" value="perempuan" style="top: 980px;">
		<label style="top: 860px;right: 355px;">Laki - laki</label>
		<label style="top: 960px;right: 300px;">Perempuan</label>

		<label style="top: 1150px;">Universitas</label>
		<select name="universitas" style="top:1150px;" onchange="ajax(this.value)" id="jsuniversitas">
			<option value="">pilih salah satu universitas</option>
			@foreach($universitas as $univ)
			<option value="{{ $univ->id }}">{{ $univ->nama_universitas}}</option>
			@endforeach
		</select>

		<label style="top: 1250px;">Fakultas</label>
		<select name="fakultas" style="top:1250px;"id="win" onchange="ajax2(this.value)">
			<option value="">
			</option>
		</select>

		<label style="top:1350px;" >Program Studi</label>
		<select name="prodi" style="top: 1350px;" id="prod">
			<option value=""></option>
		</select>

		<label style="top:1450px;right: 310px;">Tanggal Lahir</label>
		<select class="tanggal" name="tanggal_var" id="jstanggal">
			<option value="">pilih tanggal</option>
			<?php
				for($i = 1;$i<=31;$i++){
					echo "<option value=\"".$i."\">".$i."</option>";
				}
			 ?>
		</select>

		<select class="bulan" name="bulan_var" id="jsbulan">
			<option value="">pilih bulan</option>
			<?php
				$bulan=array("jan","feb","mar","apr","mei","jun","jul","agu","sep","okt","nov","des");
				for($j=0;$j<=11;$j++){
					echo "<option value=\"".$j."\">".$bulan[$j]."</option>";
				}
			 ?>
		</select>

		<select class="tahun" name="tahun_var" id="jstahun">
			<option value="">pilih tahun</option>
			<?php 
				for($k=1980;$k<=2005;$k++){
					echo "<option value=\"".$k."\">".$k."</option>";
				};
			 ?>
		</select>

		<label style="top: 1660px;">Username</label>
		<input type="text" name="username" style="top:1660px;" id="jsusername">

		<label style="top: 1760px;">Password</label>
		<input type="Password" name="password" style="top: 1760px;" id="jspassword">

		<label style="top: 1860px;">Confirm Password</label>
		<input type="Password" name="password_confirmation" style="top:1860px;" id="jspassword2">

		<label style="top: 1960px;">Masukkan Foto</label>
		<input type="file" name="file_foto" style="top:1970px; ">

		<input type="submit" name="SUBMIT" style="top: 2060px;height: 70px;">

	</form>


	<ul<?php if(empty($errors->first())){}else {
			echo " style=\"border :5px solid red;background-color: #ffd9d6;\"";
		};

	 ?> >

		<?php 
		if ($errors->first('nama') !== ""){
			echo "<li class=\"warning\">".$errors->first('nama')."<li>";
		}

		if ($errors->first('tempat_lahir') !== ""){
			echo "<li class=\"warning\">".$errors->first('tempat_lahir')."<li>";
		}

		if ($errors->first('alamat') !== ""){
			echo "<li class=\"warning\">".$errors->first('alamat')."<li>";
		}

		if ($errors->first('semester') !== ""){
			echo "<li class=\"warning\">".$errors->first('semester')."<li>";
		}

		if ($errors->first('universitas') !== ""){
			echo "<li class=\"warning\">".$errors->first('universitas')."<li>";
		}

		if ($errors->first('fakultas') !== ""){
			echo "<li class=\"warning\">".$errors->first('fakultas')."<li>";
		}

		if ($errors->first('prodi') !== ""){
			echo "<li class=\"warning\">".$errors->first('prodi')."<li>";
		}

		if ($errors->first('tanggal_var') !== ""){
			echo "<li class=\"warning\">".$errors->first('tanggal_var')."<li>";
		}

		if ($errors->first('bulan_var') !== ""){
			echo "<li class=\"warning\">".$errors->first('bulan_var')."<li>";
		}

		if ($errors->first('tahun_var') !== ""){
			echo "<li class=\"warning\">".$errors->first('tahun_var')."<li>";
		}

		if ($errors->first('username') !== ""){
			echo "<li class=\"warning\">".$errors->first('username')."<li>";
		}

		if ($errors->first('password') !== ""){
			echo "<li class=\"warning\">".$errors->first('password')."<li>";
		}


?>

	</ul>

<?php 
	if ($errors->first('nama') !== "") {
?>
		<script type="text/javascript">
			document.getElementById("jsnama").style.border="7px solid #ff2e00";
		</script>
<?php 
}
 ?>

<?php if ($errors->first('tempat_lahir') !== ""){
?>
		<script type="text/javascript">
			document.getElementById("jstempat_lahir").style.border="7px solid #ff2e00";
		</script>
<?php  
	}
?>

<?php if ($errors->first('alamat') !== ""){
?>
		<script type="text/javascript">
			document.getElementById("jsalamat").style.border="7px solid #ff2e00";
		</script>
<?php  
	}
?>

<?php if ($errors->first('semester') !== ""){
?>
		<script type="text/javascript">
			document.getElementById("jssemester").style.border="7px solid #ff2e00";
		</script>
<?php  
	}
?>

<?php if ($errors->first('universitas') !== ""){
?>
		<script type="text/javascript">
			document.getElementById("jsuniversitas").style.border="7px solid #ff2e00";
		</script>
<?php  
	}
?>

<?php if ($errors->first('fakultas') !== ""){
?>
		<script type="text/javascript">
			document.getElementById("win").style.border="7px solid #ff2e00";
		</script>
<?php  
	}
?>

<?php if ($errors->first('prodi') !== ""){
?>
		<script type="text/javascript">
			document.getElementById("prod").style.border="7px solid #ff2e00";
		</script>
<?php  
	}
?>

<?php if ($errors->first('tanggal_var') !== ""){
?>
		<script type="text/javascript">
			document.getElementById("jstanggal").style.border="7px solid #ff2e00";
		</script>
<?php  
	}
?>

<?php if ($errors->first('bulan_var') !== ""){
?>
		<script type="text/javascript">
			document.getElementById("jsbulan").style.border="7px solid #ff2e00";
		</script>
<?php  
	}
?>

<?php if ($errors->first('tahun_var') !== ""){
?>
		<script type="text/javascript">
			document.getElementById("jstahun").style.border="7px solid #ff2e00";
		</script>
<?php  
	}
?>

<?php if ($errors->first('username') !== ""){
?>
		<script type="text/javascript">
			document.getElementById("jsusername").style.border="7px solid #ff2e00";
		</script>
<?php  
	}
?>

<?php if ($errors->first('password') !== ""){
?>
		<script type="text/javascript">
			document.getElementById("jspassword").style.border="7px solid #ff2e00";
			document.getElementById("jspassword2").style.border="7px solid #ff2e00";
		</script>
<?php  
	}
?>

</div>

</body>
</html>