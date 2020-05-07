<?php 	
		$id_member_pengajar=$_GET['id'];
		$id_pengguna =$_GET['member'];

		$konek = mysqli_connect("localhost","root","","db_kathink_v3");
		$queryfoto ="SELECT tb_users.username,tb_users.semester,tb_users.study_hrs,tb_pengajars.poin,tb_prodis.nama_prodi,tb_users.foto,tb_pengajars.deskripsi,tb_pengajars.nama_pa,tb_pengajars.rating  FROM tb_users INNER JOIN tb_pengajars ON tb_pengajars.`id_member` = tb_users.`id` INNER JOIN tb_prodis ON tb_prodis.`id` =tb_users.`id_prodi` WHERE tb_users.id = '$id_member_pengajar' limit 0,1";
		$eksepengajar=mysqli_query($konek,$queryfoto);
		$idenpengajar =mysqli_fetch_assoc($eksepengajar);

		$quer ="SELECT * FROM tb_chats WHERE tb_chats.id_member1 ='$id_member_pengajar' AND tb_chats.id_member2 ='$id_pengguna' OR tb_chats.id_member1 ='$id_pengguna' AND tb_chats.id_member2 ='$id_member_pengajar'";
		$exe =mysqli_query($konek,$quer);

		if($idenpengajar['rating'] == 0){
			$tropi = "Belum ada Trophy";
		}elseif($idenpengajar['rating'] == 1){
			$tropi = "	&#127942;";
		}elseif($idenpengajar['rating'] == 2){
			$tropi = "&#127942;&#127942;";
		}elseif($idenpengajar['rating'] == 3){
			$tropi ="&#127942;&#127942;&#127942;";
		}elseif($idenpengajar['rating'] == 4){
			$tropi ="	&#127942;	&#127942;	&#127942;	&#127942;";
		}else{
			$tropi = "	&#127942;	&#127942;	&#127942;	&#127942;	&#127942;";
		}

		if (mysqli_num_rows($exe) == 0){
			$tambah ="insert into tb_chats(id_member1,id_member2) value ('$id_pengguna','$id_member_pengajar')";
			$ekse =mysqli_query($konek,$tambah);
			$id_chat=mysqli_query($konek,"select tb_chats.id from tb_chats where tb_chats.id_member1 ='$id_pengguna' and tb_chats.id_member2 ='$id_member_pengajar' or tb_chats.id_member1='$id_member_pengajar' and tb_chats.id_member2 ='$id_pengguna'");
			if($ekse){
				while ($the_id=mysqli_fetch_assoc($id_chat)) {
					echo "<th>TINKER PROFIL.</th>"."<div>YOUR CHAT ID:".$the_id['id']."</div>"."<tr><img src=\"".$idenpengajar['foto']."\" class=\"fotopengajar\"></tr>"."<div class=\"warna\">".$idenpengajar['username']."</div>"."<div class=\"warna2\">".$idenpengajar['nama_prodi']."</div>"."<div class=\"warna3\">".$tropi."</div>"."<div class=\"warna4\">".$idenpengajar['deskripsi']."</div>";
				}
			}else{
				echo "error puk";
			}
		}else{
			$id_chat=mysqli_query($konek,"select tb_chats.id from tb_chats where tb_chats.id_member1 ='$id_pengguna' and tb_chats.id_member2 ='$id_member_pengajar' or tb_chats.id_member1='$id_member_pengajar' and tb_chats.id_member2 ='$id_pengguna'");
			while($the_id=mysqli_fetch_assoc($id_chat)){
					echo "<th>TINKER PROFIL.</th>"."<div>YOUR CHAT ID:".$the_id['id']."</div>"."<tr><img src=\"".$idenpengajar['foto']."\" class=\"fotopengajar\"></tr>"."<div class=\"warna\">".$idenpengajar['username']."</div>"."<div class=\"warna2\">".$idenpengajar['nama_prodi']."</div>"."<div class=\"warna3\">".$tropi."</div>"."<div class=\"warna4\">".$idenpengajar['deskripsi']."</div>";
		};
		}
 ?>