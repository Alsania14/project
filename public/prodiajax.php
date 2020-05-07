<?php
	$value=$_GET['v'];
	$konekin=mysqli_connect("localhost","root","","db_kathink_v3");
	$quer="select tb_prodis.id,tb_prodis.nama_prodi from tb_prodis where tb_prodis.id_fakultas ='$value'";

	if ($quer === FALSE){
		die(mysqli_error());
	}

	$ekse =mysqli_query($konekin,$quer);
		echo "<option>pilih program studi</option>";
	while($hasil=mysqli_fetch_array($ekse)){
		echo "<option value=\"".$hasil[0]."\">".$hasil[1]."</option>";
	}

 ?>