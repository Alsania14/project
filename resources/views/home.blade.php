<?php
    $use = Auth::user()->id;

    $database =DB::select('SELECT tb_universitas.`nama_universitas`,tb_fakultas.`nama_fakultas`,tb_prodis.`nama_prodi`,tb_users.`semester`,tb_users.`study_hrs` FROM tb_users INNER JOIN tb_universitas ON tb_universitas.`id` = tb_users.`id_universitas` INNER JOIN tb_fakultas ON tb_fakultas.`id` = tb_users.`id_fakultas` INNER JOIN tb_prodis ON tb_prodis.`id` = tb_users.`id_prodi` WHERE tb_users.`id` = ?',array($use));

    $data = $database[0];

    $setpengajar =DB::select('SELECT tb_users.nama,tb_pengajars.nama_pa,tb_pengajars.id_member,tb_pengajars.id FROM tb_users INNER JOIN tb_pengajars ON tb_pengajars.id_member = tb_users.id WHERE tb_users.id != ?',array($use));


    $hasilpengajar=$setpengajar;
?>
<!DOCTYPE html>
<html>
<head>
    <title>KATHINK</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/default.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/home/home.css') }}">

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=3.0">

        <script type="text/javascript">
        var status ="open";
        var tab ="close";
        function show(){
            if (status == "open"){
            document.getElementById("logonih").src="kathink_logo_white.png";
            document.getElementById("side").style.left="0px";
            document.getElementById("tombol").className="laser";
            document.getElementById("ling").className="holycircle";
            document.getElementById("strip").className="strip2";
            document.getElementById("strip2").className="strip2";
            document.getElementById("strip3").className="strip2";
            status = "close";
            }
         else {
            document.getElementById("logonih").src="kathink_logo_black.png";
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

        function tableopen(){
            if (tab == "open"){
                document.getElementById("jstab")
            }
        }
        var glbl_kating = "kosong";
        var user ={{ Auth::user()->id }};
        function klik(id){
            glbl_kating = id;
            var xhttp = new XMLHttpRequest();
            
            xhttp.onreadystatechange = function(){
                console.log(this.readyState);
             if (this.readyState == 4 && this.status == 200){
               document.getElementById("cht").style.top="260px";
               document.getElementById("chatpanel").innerHTML=this.responseText;
                var kakak = id;
             }
            }
            xhttp.open("GET","chat.php?id="+id+"&member="+user,true);
            xhttp.send();
            }
            var val ="open";

        function widefk() {

            if (val == "open"){
            document.getElementById("pan").style.width="100%";
            val = "close";
            }else{
            document.getElementById("pan").style.width="1200px"; 
            val = "open";
            };
        }

        function klikaku(val){
        
        
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
                        if (this.readyState == 4 && this.status == 200){
                            document.getElementById("obrolan").innerHTML=this.responseText;
                            setTimeout(function(){
                            klikaku(glbl_kating);
                            }, 1000);
                        }
                    }
                    xhttp.open("GET","load.php?user="+user+"&kak="+val,true);
                    xhttp.send();
                }


        
        function chatclose(){
            glbl_kating ="kosong";
            
            document.getElementById("cht").style.top="-9560px";
        }
        
        function postchat(){
            var the_text = document.getElementById("textan").value;
            
            var chatsender = new XMLHttpRequest();
            chatsender.onreadystatechange = function(){
                
                if (this.readyState == 4 && this.status == 200){
                    document.getElementById("textan").value="";
                    setTimeout(function(){
                        document.getElementById("obrolan").scrollTop = document.getElementById("obrolan").scrollHeight;
                    },1000);
                    
                }
            }
            chatsender.open("POST","send.php?chat="+the_text+"&user="+user+"&kating="+glbl_kating);
            chatsender.send();
        }
        
        function hide(hide){
            document.getElementById(hide).value="";
        }
               
        function pemesanan(id){
                var ajaxpesan = new XMLHttpRequest();
                console.log(id);
                ajaxpesan.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        console.log(this.readyState);
                        if (this.responseText == "approved"){
                            console.log("approved "+id);
                            getdatapengajar(id);
                            document.getElementById("orderpanel").style.display="block";
                            document.getElementById("orderprofil").style.display="block";
                            document.getElementById("buttonjs").style.display="block";
                            document.getElementById("formjs").style.display="block";
                            document.getElementById("tablejs").style.display="block";
                            document.getElementById("id_pemesanan").value=id;
                            document.getElementById("panelpemesanan").style.top="300px";
                            
                            
                        }else{
                            console.log(id);
                            document.getElementById("orderpanel").style.display="none";
                            document.getElementById("orderprofil").style.display="none";
                            document.getElementById("buttonjs").style.display="none";
                            document.getElementById("formjs").style.display="none";
                            document.getElementById("tablejs").style.display="none";
                            document.getElementById("panelpemesanan").innerHTML+=this.responseText;
                            document.getElementById("panelpemesanan").style.top="300px";
                        }
                    }    
                }
                ajaxpesan.open("GET","pesan?user="+user+"&pengajar="+id);
                ajaxpesan.send();
        }

        function tutuporder(){
            document.getElementById("panelpemesanan").style.top="-3300px";
        }

        function getdatapengajar(idnya){
            var getdata = new XMLHttpRequest();

            getdata.onreadystatechange=function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById("orderpanel").innerHTML=this.responseText;
                    console.log("sukses");
                }
            }
            getdata.open("GET","pengajar?id="+idnya,true);
            getdata.send();
        }


        var laststatus = "closed";
        function bukak(){
            console.log("bukak");
            if (laststatus == "closed"){
                document.getElementById("id_paneljadwal").style.width="100%";
                laststatus = "open";
            }else if (laststatus == "open"){
                console.log("open");
                document.getElementById("id_paneljadwal").style.width="1200px";
                laststatus="closed";
            }

            var dataschedule = new XMLHttpRequest();
            dataschedule.onreadystatechange = function(){
                console.log("masuk");
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById("fill").innerHTML=this.responseText;
                }
            }
            dataschedule.open("GET","schedule?id="+user,true);
            dataschedule.send();
        }
        
        function drag(id,status){
            console.log("drag");
            var ajaxdetail = new XMLHttpRequest();
            ajaxdetail.onreadystatechange =function(){
                console.log("ajaxdetail");
                if(this.readyState == 4 && this.status == 200){
                    var data =JSON.parse(ajaxdetail.responseText);
                    document.getElementById("lokasidetail").value=data.lokasi;
                    document.getElementById("tanggalwaktudetail").value=data.tanggal+" "+data.waktu;
                    document.getElementById("pesanpemesan").innerHTML=data.catatan_pemesan;
                    document.getElementById("pesanpengajar").innerHTML=data.catatan_pengajar;
                    document.getElementById("tomboledit").href="editpemesan/"+id+"/edit";
                    document.getElementById("tombolreject").href="reject/"+id;
                    document.getElementById("tomboldone").href="done/"+id;     
                }
            }
            ajaxdetail.open("GET","ajaxschedule?id_user="+user+"&id_pertemuan="+id+"&status="+status,true);
                ajaxdetail.send();

            
            if(status == "pending"){
                document.getElementById("logojs").innerHTML="&#8987;";
                document.getElementById("statusjs").innerHTML="PENDING";
            }else if(status == "approved"){
                document.getElementById("logojs").innerHTML="&#128516;";
                document.getElementById("statusjs").innerHTML="APPROVED";
            }else if(status == "reject"){
                document.getElementById("logojs").innerHTML="&#10060;";
                document.getElementById("statusjs").innerHTML="REJECT";
            }else if(status == "done"){
                document.getElementById("logojs").innerHTML="&#127942;";
                document.getElementById("statusjs").innerHTML="DONE";
            }

            document.getElementById("paneldetailjs").style.top="300px";
        }

        function dragclose(){
            document.getElementById("paneldetailjs").style.top="-2000px";
        }

        var statusthink ="open";
        function openthink(){
            var ajaxthinker = new XMLHttpRequest;
            ajaxthinker.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById("fillthinker").innerHTML=this.responseText;
                }
            }
            ajaxthinker.open("GET","kathinkpanel?id="+user);
            ajaxthinker.send();

            if(statusthink == "open"){
                document.getElementById("thinkerpanel").style.width="100%";
                statusthink="close";
            }else if(statusthink == "close"){
                document.getElementById("thinkerpanel").style.width="1200px";
                statusthink="open";
            }
        }

        var emotklik ="open";
        function emotjs(){
            if(emotklik == "open"){
                document.getElementById("emotpanel").style.width="2250px";
                document.getElementById("emotpanel").style.height="1500px";
                emotklik="close";
            }else if(emotklik == "close"){
                document.getElementById("emotpanel").style.width="0px";
                document.getElementById("emotpanel").style.height="0px";
                emotklik="open";
            }
        }

        function tempel(emot){
            console.log(emot);
            document.getElementById("textan").value+=emot;
        }


    </script>


</head>
<body onload="show(),klikaku(glbl_kating)">

    <div class="navtop">
        <img src="kathink_logo_white.png" id="logonih">
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
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="">
        <input class="logout" type="submit" value="logout" >
        @csrf
        </form>
        <a class="first" href="#" style="right: 450px;">University Info</a>
        <a class="first" href="#" style="right: 180px;">Contact</a>
    </div>
    
    <div class="chatroom" id="cht">
    <img src="xsimbol.png" alt="" style="position:absolute;top:0px;height:120px;width:120px;z-index:10;cursor:pointer;" onclick="chatclose()">

    <div class="showemot" id="emotpanel">
        <span style="cursor:pointer;">
        <span onclick="tempel(this.innerHTML)">&#128512;</span>
        <span onclick="tempel(this.innerHTML)">&#128513;</span>
        <span onclick="tempel(this.innerHTML)">&#128514;</span>
        <span onclick="tempel(this.innerHTML)">&#128515;</span>
        <span onclick="tempel(this.innerHTML)">&#128516;</span>
        <span onclick="tempel(this.innerHTML)">&#128517;</span>
        <span onclick="tempel(this.innerHTML)">&#128518;</span>
        <span onclick="tempel(this.innerHTML)">&#128519;</span>
        <span onclick="tempel(this.innerHTML)">&#128520;</span>
        <span onclick="tempel(this.innerHTML)">&#128521;</span>
        <span onclick="tempel(this.innerHTML)">&#128522;</span>
        <span onclick="tempel(this.innerHTML)">&#128523;</span>
        <span onclick="tempel(this.innerHTML)">&#128524;</span>
        <span onclick="tempel(this.innerHTML)">&#128525;</span>

        <span onclick="tempel(this.innerHTML)">&#128526;</span>
        <span onclick="tempel(this.innerHTML)">&#128527;</span>
        <span onclick="tempel(this.innerHTML)">&#128528;</span>
        <span onclick="tempel(this.innerHTML)">&#128529;</span>
        <span onclick="tempel(this.innerHTML)">&#128530;</span>
        <span onclick="tempel(this.innerHTML)">&#128531;</span>
        <span onclick="tempel(this.innerHTML)">&#128532;</span>
        <span onclick="tempel(this.innerHTML)">&#128533;</span>
        <span onclick="tempel(this.innerHTML)">&#128534;</span>
        <span onclick="tempel(this.innerHTML)">&#128535;</span>
        <span onclick="tempel(this.innerHTML)">&#128536;</span>
        <span onclick="tempel(this.innerHTML)">&#128537;</span>
        <span onclick="tempel(this.innerHTML)">&#128538;</span>
        <span onclick="tempel(this.innerHTML)">&#128539;</span>

        <span onclick="tempel(this.innerHTML)">&#128540;</span>
        <span onclick="tempel(this.innerHTML)">&#128541;</span>
        <span onclick="tempel(this.innerHTML)">&#128542;</span>
        <span onclick="tempel(this.innerHTML)">&#128543;</span>
        <span onclick="tempel(this.innerHTML)">&#128545;</span>
        <span onclick="tempel(this.innerHTML)">&#128546;</span>
        <span onclick="tempel(this.innerHTML)">&#128547;</span>
        <span onclick="tempel(this.innerHTML)">&#128548;</span>
        <span onclick="tempel(this.innerHTML)">&#128549;</span>
        <span onclick="tempel(this.innerHTML)">&#128550;</span>
        <span onclick="tempel(this.innerHTML)">&#128551;</span>
        <span onclick="tempel(this.innerHTML)">&#128552;</span>
        <span onclick="tempel(this.innerHTML)">&#128553;</span>
        <span onclick="tempel(this.innerHTML)">&#128554;</span>

        <span onclick="tempel(this.innerHTML)">&#128555;</span>
        <span onclick="tempel(this.innerHTML)">&#128556;</span>
        <span onclick="tempel(this.innerHTML)">&#128557;</span>
        <span onclick="tempel(this.innerHTML)">&#128558;</span>
        <span onclick="tempel(this.innerHTML)">&#128559;</span>
        <span onclick="tempel(this.innerHTML)">&#128560;</span>
        <span onclick="tempel(this.innerHTML)">&#128561;</span>
        <span onclick="tempel(this.innerHTML)">&#128562;</span>
        <span onclick="tempel(this.innerHTML)">&#128563;</span>
        <span onclick="tempel(this.innerHTML)">&#128564;</span>
        <span onclick="tempel(this.innerHTML)">&#128565;</span>
        <span onclick="tempel(this.innerHTML)">&#128566;</span>
        <span onclick="tempel(this.innerHTML)">&#128567;</span>
        <span onclick="tempel(this.innerHTML)">&#128568;</span>

        <span onclick="tempel(this.innerHTML)">&#128569;</span>
        <span onclick="tempel(this.innerHTML)">&#128570;</span>
        <span onclick="tempel(this.innerHTML)">&#128571;</span>
        <span onclick="tempel(this.innerHTML)">&#128572;</span>
        <span onclick="tempel(this.innerHTML)">&#128573;</span>
        <span onclick="tempel(this.innerHTML)">&#128574;</span>
        <span onclick="tempel(this.innerHTML)">&#128575;</span>
        <span onclick="tempel(this.innerHTML)">&#128576;</span>
        <span onclick="tempel(this.innerHTML)">&#128577;</span>
        <span onclick="tempel(this.innerHTML)">&#128578;</span>
        <span onclick="tempel(this.innerHTML)">&#128579;</span>
        <span onclick="tempel(this.innerHTML)">&#128580;</span>
        <span onclick="tempel(this.innerHTML)">&#128581;</span>
        <span onclick="tempel(this.innerHTML)">&#128582;</span>

        
        </span>
    </div>
    <div class="emot" onclick="emotjs()">&#128516;</div>
            <input type="text" id="textan" value="" style="right:220px;border-radius:15px;padding-left: 10px;" maxlength="200">
            <input type="submit" style="width:200px;background-color:#9ae3ae;cursor:pointer;border-radius:15px;font-size:40pt;" onclick="postchat()" value="SEND" id="senddude">
        <table class="side" id="chatpanel">
        </table>
        
        <div class="panelchatroom" id="obrolan">
        </div>
    </div>

    <script>
        var inputana = document.getElementById("textan");
        inputana.addEventListener("keyup", function(event){
            if(event.keyCode == 13){
                event.preventDefault();
                document.getElementById("senddude").click();
                document.getelementById("")
            }
        });
    </script>

    <div class="container">
        <div class="back">
            <img src="back2.png" style="width: 100%;height: 100%;">
            <img class="profil" src="{{ Auth::user()->foto }}">
            <label>{{ Auth::user()->username }}</label>
        </div>

        <table>
            <tr>
                <td colspan="2" style="text-align: center;padding: 10px;background-color: #1a1919;">STUDENT CLIPBOARD</td>
            </tr>
            <th>Nama</th>
            <td>{{ Auth::user()->nama }}</td>
            </tr>
            <tr>
            <th>Universitas</th>
            <td><?php echo $data->nama_universitas;?></td>
            </tr>
            <tr>
            <th>Fakultas</th>
            <td><?php echo $data->nama_fakultas; ?></td>
            </tr>
            <tr>
                <th>Program Studi</th>
                <td>{{ $data->nama_prodi }}</td>
            </tr>
            <tr>
                <th>Semester</th>
                <td>{{ $data->semester }}</td>
            </tr>
            <tr>
                <th>Hours of Study</th>
                <td>{{ $data->study_hrs }}</td>
            </tr>
        </table>

        <div class="panel" id="pan" onclick="widefk()">
            <h1 id="he">Find kathink.</h1>
            <div class="cov" id="pic">
            <img src="findkathink.jpg">
            </div>
            <p id="par">Perlu layanan kathink ? cari Tinker di universitas mu, dan dalami materi perkuliahan bersamanya.</p>
            <table>
                <tr>
                    <th>Tinker.</th>
                    <th>Pembimbing Akadmik.</th>
                    <th>Aktifitas.</th>
                </tr>
        

                <?php 
                    foreach ($hasilpengajar as $datapengajar) {
                        echo "<tr>";
                        echo "<td>".$datapengajar->nama."</td>";
                        echo "<td>".$datapengajar->nama_pa."</td>";
                        echo "<td><button onclick=\"klik(".$datapengajar->id_member.")\">chat</button><button onclick=\"pemesanan(".$datapengajar->id.")\" style=\"width:200px;\" >Pemesanan</button></td>";
                        echo "</tr>";
                    }

                 ?>

                
            </table>
        </div>
        
        <div class="paneljadwal" id="id_paneljadwal" onclick="bukak()">
            <img src="imagejadwal3.jpg" alt="">
            <h1>Schedule.</h1>
            <p>Sudah pesan layanan kathink belum ? jika sudah cek jadwal mu disini ya.</p>
            <table id="fill">
            </table>
        </div>
        
        <!-- PANEL THINKER -->
        <div class="paneljadwal" style="top:4100px;left:0px;" id="thinkerpanel" onclick="openthink()">
        <h1 style="font-size:50pt;">Thinker Schedule.</h1>
        <p>Hai Thinker, kamu dapat melihat semua log pemesanan layanan mu disini ya !</p>
            <img src="cool2.jpg">
            <table id="fillthinker">
                    
            </table>
        </div>

        <!-- akhir container -->
    </div>


    <div class="test" id="tester">&#127942;	&#8987;</div>

    <?php
    $userpoin = Auth::user()->poin;
    $harga = 20000;
    $total = $userpoin - $harga;
    ?>
    
    <div class="pemesanan" id="panelpemesanan">
    
    <img src="xsimbol.png" style="position:absolute;top:0px;left:50px;width:120px;height:120px;cursor:pointer;z-index:5;" onclick="tutuporder()">
        <form action="/order/store" method="POST" id="formjs">
        {{ csrf_field() }}
        <input type="hidden" name="id_usernya" value="{{ Auth::user()->id }}">
        <input type="hidden" name="pengajar" id="id_pemesanan" value="">
        <label for="lokasi" style="top:100px;">Lokasi.</label>
        <input type="text"style="top:100px;" id="lokasi" name="lokasi">

        <label for="tanggal" style="top:300px;">Tanggal & waktu</label>
        <input type="text" style="top:300px;width:500px;" id="tanggal" value="&quot;yyyy-mm-dd&quot;" onclick="hide(this.id)" name="tanggal">

        <input type="time" style="top:300px; left:2600px;width:500px;" name="time">
        
        <?php
        if($total <= 0){
            echo "<button style=\"position:absolute;top:1500px;left:2200px;width:300px;height:100px;font-size:50pt;cursor: not-allowed;opacity:.5;font-family:Times New Roman;\" id=\"buttonjs\" disabled>PESAN</button>";
        }else{
            echo "<input type=\"submit\" style=\"position:absolute;top:1500px;left:2200px;width:300px;height:100px;font-size:50pt;cursor: pointer;opacity:1;\" id=\"buttonjs\"  value=\"PESAN\">";
        }?>
        
        <label for="catatan" style="top:500px;">Catatan Pemesan.</label>
        <input type="text" maxlength="100" style="top:500px;" name="catatan_pemesan">

        </form>

        <div class="spanduk" id="orderprofil">PICK THINKER.</div>
        <div class="setdata" id="orderpanel">
            
        </div>

        <span id="tablejs">
        <table class="biaya" >
            <tr>
                <th style="width:400px;background-color:#83d699;color:black;">Poin.</th>
                <td style="text-align:right;padding-right:30px;">{{ Auth::user()->poin }}</td>
            </tr>
            <tr>
                <th style="width:400px;background-color:#70ba83;color:black;">Biaya.</th>
                <td style="text-align:right;padding-right:30px;">20000</td>
            </tr>

            <tr>
                <th style="width:400px;background-color:#458756;color:black;">Balance.</th>
                <td style="text-align:right;padding-right:30px;">
                {{ $total }}
                </td>
            </tr>
        </table>
        </span>
    </div>

    <div class="paneldetail" id="paneldetailjs">
    <img src="xsimbol.png" style="position:absolute;top:0px;left:50px;width:120px;height:120px;cursor:pointer;z-index:5;" onclick="dragclose()">
        <div class="panelstatus">
            <div class="kotakatas">DETAIL PERTEMUAN.</div>
            <div class="kotakstatus" id="logojs"></div>
            <div class="kotakatas" style="top:1350px;width:600px;left:50%;transform:translateX(-50%);border-radius:25px;padding-top:5px;" id="statusjs">PENDING</div>
        </div>
        <label class="detaillokasi" style="top: 100px;">Lokasi.</label>
        <input type="text" class="detailinput" readonly style="cursor:default;top: 100px;" id="lokasidetail">

        <label class="detaillokasi" style="top:250px;right:800px;">Tgl & Waktu.</label>
        <input type="text" class="detailinput" readonly style="cursor:default;top:400px;text-align:center;" id="tanggalwaktudetail">

        <label class="detaillokasi" style="top:550px;font-size:40pt;">Catatan Pemesan</label>

        <div class="detailinfo" id="pesanpemesan">Belum Ada Pesan.</div>

        <label class="detaillokasi" style="top:550px;font-size:40pt;right:100px;">Catatan Thinker</label>

        <div class="detailinfo" style="right:50px;" id="pesanpengajar">Belum ada pesan</div>

        <a id="tomboledit" href=""><button class="buttondetail" style="bottom:100px;right:650px;cursor:pointer;">EDIT</button></a>

        <a href="" id="tomboldone">
        <button class="buttondetail" style="bottom:100px;right:900px;cursor:pointer;">DONE</button></a>

        <a href="" id="tombolreject">
        <button class="buttondetail" style="bottom:100px;right:1200px;cursor:pointer;">REJECT</button></a>
        
    </div>


    
</body>
</html>