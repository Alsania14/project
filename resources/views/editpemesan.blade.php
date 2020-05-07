<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/editpemesan/editpemesanan.css') }}">
    <title>Document</title>
</head>
<body>
<!-- AWAL CONTAINER -->
<div class="container">
    <div class="spanduk">EDIT PEMESANAN.</div>

    <form id="confirmationForm" action="{{ url('editpemesan/'.$data) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT')}}

    <label >LOKASI.</label>
    <input type=text value="{{ $pertemuan->lokasi }}" name="lokasi">

    <label style="top:1000px;font-size:70pt;">TANGGAL PERTEMUAN</label>
    <input style="top:1200px;" type=text value="{{ $pertemuan->tanggal_pertemuan }}" name="tanggal_pertemuan">
    
    <label style="top:1500px;font-size:70pt;x">WAKTU PERTEMUAN</label>
    <input style="top:1700px;" type="text" value="{{ $pertemuan->waktu_pertemuan }}" name="waktu_pertemuan">

    <label style="top:2000px;font-size:70pt;">CATATAN PEMESAN</label>

    <input type="submit" value="SUBMIT" style="width:600px;height:200px;top:3300px;padding:0px;left:2100px;">

    </form>

    <textarea form="confirmationForm" name="catatan_pemesan">{{ $pertemuan->catatan_pemesan }}</textarea>

    <a href="/home"><button>CANCEL</button></a>

</div>
<!-- AKHIR CONTAINER -->
</body>
</html>