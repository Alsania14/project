<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/editpemesan/editpemesanan.css') }}">

    <script>
        var tot;
        function tropi(tot){
            document.getElementById("nilai").innerHTML=tot;

            if(tot == 1){
                document.getElementById("nilai").style.backgroundColor="#DA2E26";
                document.getElementById("rating").value=1;
            }else if(tot == 2){
                document.getElementById("nilai").style.backgroundColor="#D2681B";
                document.getElementById("rating").value=2;
            }else if(tot == 3){
                document.getElementById("nilai").style.backgroundColor="#D86715B";
                document.getElementById("rating").value=3;
            }else if(tot == 4){
                document.getElementById("nilai").style.backgroundColor="#ED9C10";
                document.getElementById("rating").value=4;
            }else if(tot == 5){
                document.getElementById("nilai").style.backgroundColor="#EDD210";
                document.getElementById("rating").value=5;
            }
        }
    </script>


    <title>Document</title>
</head>
<body>
<!-- AWAL CONTAINER -->
<div class="container">
    <div class="spanduk">SELESAI BIMBINGAN.</div>
        <div class="tropi">
            <span onclick="tropi(1)">&#127942;  </span>
            <span onclick="tropi(2)">&#127942;  </span>
            <span onclick="tropi(3)">&#127942;  </span>
            <span onclick="tropi(4)">&#127942;  </span>
            <span onclick="tropi(5)">&#127942;  </span>
        </div>
        
    <div class="boxnilai" id="nilai">1</div>
    <form action="{{ url('done/'.$don->id) }}" method="POST" id="confirmationForm">
        {{ csrf_field() }}
        <input type="hidden" id="rating" name="rating" value="1">
        <input type="submit" style="top:2800px;" value="SUBMIT">
    </form>

    <textarea form="confirmationForm" name="commen" placeholder="Beri Komentar Layanan" style="top:1700px;"></textarea>

    <a href="/home"><button style="width:2200px;left:400px;">CANCEL</button></a>

</div>
<!-- AKHIR CONTAINER -->
</body>
</html>