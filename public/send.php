<?php
    $chat =$_GET['chat'];
    $user =$_GET['user'];
    $kating=$_GET['kating'];

    $konek=mysqli_connect("localhost","root","","db_kathink_v3");
    $query ="SELECT tb_chats.id FROM tb_chats WHERE tb_chats.`id_member1` = '$user' AND tb_chats.`id_member2` = '$kating' OR tb_chats.`id_member1` = '$kating' AND tb_chats.`id_member2` ='$user' limit 0,1";
    $ekse=mysqli_query($konek,$query);
    $hasil = mysqli_fetch_assoc($ekse);
    $find=$hasil['id'];
    $cekdetail =mysqli_query($konek,"SELECT * FROM tb_detail_chats INNER JOIN tb_chats ON tb_chats.id = tb_detail_chats.id_chats WHERE tb_chats.id = '$find';");
    $banyak = mysqli_num_rows($cekdetail);


        $insert ="INSERT INTO tb_detail_chats(id_chats,id_chater,chat) VALUE ('$find','$user','$chat')";

        $ekseinputchat=mysqli_query($konek,$insert);

        if ($ekseinputchat){
            echo $chat.$user.$kating.$hasil['id'].$banyak;
        }
 

   