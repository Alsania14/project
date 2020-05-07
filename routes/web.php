<?php
use Illuminate\Support\Facades\DB;
use App\tb_fakultas;
use App\tb_user;
use App\tb_pengajar;
use App\tb_pertemuan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function() {
	return view('contact');
});

Auth::routes();
Route::resource('kathink','TbUserController');
Route::get('/register','TbUserController@create');
Route::post('/posregister','TbUserController@store');


Route::middleware('auth')->group(function () {
Route::POST('/order/store','TbPertemuanController@store');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/suksesregister', function() {
	return view('/suksesregister');
});
Route::resource('editpemesan','TbPertemuanController');
Route::get('reject/{idnya}','TbPertemuanController@reject');
Route::get('done/{id}','TbPertemuanController@done');
Route::post('done/{id}','TbPertemuanController@selesai');
Route::get('aprov/{id}','TbPertemuanController@aprov');
});


// AJAX START FROM HERE !!!!!!!!!!!!!!!!!! ===================
Route::get('ajax', function(){
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
});

Route::get('pesan',function(){
	$user=tb_user::find($_GET['user']);
	$pengajarnya =tb_pengajar::find($_GET['pengajar']);
	$status=DB::select('SELECT * FROM tb_pertemuans WHERE tb_pertemuans.id_pemesan = ? AND (tb_pertemuans.status = ? OR tb_pertemuans.status = ?)',array($user->id,'pending','approved'));

	if ($status == []){
		echo "approved";
	}else{
		echo "<img src=\"logo_ada_layanan.png\" id=\"gambarlock\">"."<img src=\"xsimbol.png\" class=\"silangan\" style=\"position:absolute;top:0px;left:50px;width:120px;height:120px;cursor:pointer;\" onclick=\"tutuporder()\">"."<p style=\"position:absolute;top:1200px;left:50%;transform:translateX(-50%);font-size:53pt;\" id=\"plock\">Anda tidak dapat melakukan pemesanan lebih dari satu kali</p>";
	}
	
});

Route::get('pengajar',function(){
	$idpengajar = $_GET['id'];
	$si_pengajar = tb_pengajar::find($idpengajar);
	$data_pengajar =DB::select('SELECT * FROM tb_users INNER JOIN tb_pengajars ON tb_pengajars.id_member = tb_users.id INNER JOIN tb_prodis ON tb_prodis.`id` = tb_users.`id_prodi` WHERE tb_pengajars.id = ?',array($si_pengajar->id));
	
	echo "<div class=\"warna\" id=\"namapengajar\">".$data_pengajar[0]->username."</div>"."<img src=\"".$data_pengajar[0]->foto."\" class=\"fotopengajar\">"."<div class=\"warna2\">".$data_pengajar[0]->nama_prodi."</div>";
});

Route::get('schedule',function(){
	$id_user = $_GET['id'];
	$schedule =DB::select('SELECT tb_pertemuans.*,tb_users.`nama`,tb_users.`id` AS id_user_pengajar,tb_pengajars.`id` AS id_pengajar,tb_users.username,tb_pertemuans.status FROM tb_pertemuans INNER JOIN tb_pengajars ON tb_pengajars.`id` = tb_pertemuans.`id_pengajar` INNER JOIN tb_users ON tb_users.`id` = tb_pengajars.`id_member` WHERE tb_pertemuans.`id_pemesan` = ?',array($id_user));
		echo "<tr>";
		echo "<th>Thinker.</th>";
		echo "<th>Status</th>";
		echo "<th>Aktifitas</th>";
		echo "</tr>";
	foreach ($schedule as $key) {
		echo "<tr>";
		echo "<td style=\"text-transform:uppercase;\">".$key->username."</td>";

		if($key->status == "pending"){
			echo "<td style=\"background-color:#f5d63d;border-radius:15px;color:black;font-size:40pt;text-transform:uppercase;\">".$key->status."</td>";
		}elseif($key->status == "approved"){
			echo "<td style=\"background-color:#86b574;border-radius:15px;color:black;font-size:40pt;text-transform:uppercase;\">".$key->status."</td>";
		}elseif($key->status == "done"){
			echo "<td style=\"background-color:#7d8dc9;border-radius:15px;color:black;font-size:40pt;text-transform:uppercase;\">".$key->status."</td>";
		}elseif($key->status =="reject"){
			echo "<td style=\"background-color:#a12f34;border-radius:15px;color:black;font-size:40pt;text-transform:uppercase;\">".$key->status."</td>";
		}

		echo "<td><button  style=\"width:200px;height:50px;font-size:30pt;font-family:Times New Roman;cursor:pointer;\" onclick=\"drag(".$key->id.",&quot;".$key->status."&quot;)\">Detail<button></td>";
		echo "</tr>";
	}
	
});

Route::get('ajaxschedule',function(){
	$id_user=$_GET['id_user'];
	$id_pertemuan=$_GET['id_pertemuan'];
	$status=$_GET['status'];

	$tabel=DB::select('SELECT tb_pertemuans.`id_pemesan`,tb_pertemuans.`lokasi`,tb_pertemuans.`catatan_pemesan`,tb_pertemuans.`catatan_pengajar`,tb_pertemuans.tanggal_pertemuan,tb_pertemuans.waktu_pertemuan FROM tb_pertemuans WHERE tb_pertemuans.`id_pemesan` = ? AND tb_pertemuans.id = ?',array($id_user,$id_pertemuan));

	class datadetail{
		//
	}

	$datadetail = new datadetail();

	$datadetail->lokasi = $tabel[0]->lokasi;
	$datadetail->tanggal = $tabel[0]->tanggal_pertemuan;
	$datadetail->waktu = $tabel[0]->waktu_pertemuan;
	$datadetail->catatan_pemesan = $tabel[0]->catatan_pemesan;
	$datadetail->catatan_pengajar = $tabel[0]->catatan_pengajar;

	echo json_encode($datadetail);
});

Route::get('kathinkpanel',function(){
	$user = $_GET['id'];

	$idpengajarnya =DB::select('SELECT tb_pengajars.*,tb_users.nama FROM tb_pengajars INNER JOIN tb_users ON tb_users.`id` = tb_pengajars.`id_member` WHERE tb_pengajars.`id_member` = ?',array($user));

	$tabel =DB::select('SELECT tb_pertemuans.*,tb_users.username FROM tb_pertemuans INNER JOIN tb_users ON tb_users.`id` = tb_pertemuans.`id_pemesan` WHERE tb_pertemuans.`id_pengajar` = ?',array($idpengajarnya[0]->id));
	
	if(isset($tabel)){
		echo "<tr>";
		echo "<th>Nama Pemesan</th>";
		echo "<th>Status</th>";
		echo "<th>Aksi</th>";

		foreach ($tabel as $key) {
			echo "<tr>";
			echo "<td>".$key->username."</td>";
			
			if($key->status == "pending"){
				echo "<td style=\"background-color:#f5d63d;border-radius:15px;color:black;font-size:40pt;text-transform:uppercase;\">".$key->status."</td>";

				echo "<td><a href=\"aprov/".$key->id."\"> <button  style=\"width:200px;height:50px;font-size:30pt;font-family:Times New Roman;cursor:pointer;\">Approve<button></td></a>";
			}elseif($key->status == "approved"){
				echo "<td style=\"background-color:#86b574;border-radius:15px;color:black;font-size:40pt;text-transform:uppercase;\">".$key->status."</td>";

				echo "<td><button  style=\"width:200px;height:50px;font-size:30pt;font-family:Times New Roman;cursor:pointer;opacity:.5;\" >Approve<button></td>";
			}elseif($key->status == "done"){
				echo "<td style=\"background-color:#7d8dc9;border-radius:15px;color:black;font-size:40pt;text-transform:uppercase;\">".$key->status."</td>";

				echo "<td><button  style=\"width:200px;height:50px;font-size:30pt;font-family:Times New Roman;cursor:pointer;opacity:.5;\">Approve<button></td>";
			}elseif($key->status =="reject"){
				echo "<td style=\"background-color:#a12f34;border-radius:15px;color:black;font-size:40pt;text-transform:uppercase;\">".$key->status."</td>";

				echo "<td><button  style=\"width:200px;height:50px;font-size:30pt;font-family:Times New Roman;cursor:pointer;opacity:.5;\">Approve<button></td>";
			}


			echo "</tr>";
		}
	}

});
	

