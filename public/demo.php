<?php 
	$value =$_GET['q'];
	$konek = mysqli_connect("localhost","root","","db_kathink_v3");
	$fak ="select tb_fakultas.id,tb_fakultas.nama_fakultas from tb_fakultas where tb_fakultas.id_universitas ='$value'";

	$data =mysqli_query($konek,$fak);


	if ($fak === FALSE){
		die(mysql_error());
	}
	echo "<option>pilih fakultas</option>";
	while($info=mysqli_fetch_array($data)){
	echo "<option value=\"".$info[0]."\">".$info[1]."</option>";
	}
 ?>	