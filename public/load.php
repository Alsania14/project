<?php
    $user=$_GET['user'];
    $kating=$_GET['kak'];

    $konek =mysqli_connect("localhost","root","","db_kathink_v3");
    $query="SELECT tb_chats.id FROM tb_chats WHERE tb_chats.id_member1='$user' AND tb_chats.id_member2 ='$kating' OR tb_chats.id_member1='$kating' AND tb_chats.id_member2='$user' LIMIT 0,1";
    $exe =mysqli_query($konek,$query);
    $hasil = mysqli_fetch_assoc($exe);
    $the_id =$hasil['id'];
    $getchat="SELECT tb_detail_chats.`id_chater`,tb_detail_chats.`chat` FROM tb_detail_chats INNER JOIN tb_chats ON tb_chats.`id` = tb_detail_chats.`id_chats` WHERE tb_detail_chats.id_chats ='$the_id'";

    $pickchat=mysqli_query($konek,$getchat);
    
    
        while ($chatnya=mysqli_fetch_assoc($pickchat)){
            if ($chatnya['id_chater'] == $user){
                echo "<div class=\"baloon\" style=\"right : -1100px;\">".$chatnya['chat']."</div>";
            }elseif($chatnya['id_chater'] == $kating){
                echo "<div class=\"baloon\" style=\"right : 0px;\">".$chatnya['chat']."</div>";
            }
        }

    ?>