<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\tb_user;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa=tb_user::all();
        return response()->json($siswa, 200);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $simpan = new tb_user;
            if (is_null($request->file('file_foto'))) {
            	$nama = "assets\foto_users\blank.jpg";
            }else{
	            $file = $request->file('file_foto');
	            $tujuan = 'assets\foto_users\\';
	            $file->move($tujuan,$file->getClientOriginalName());
	            $nama =$tujuan.$file->getClientOriginalName();
            };
            $simpan->id_universitas = $request->universitas;
            $simpan->id_fakultas = $request->fakultas;
            $simpan->id_prodi = $request->prodi;
            $simpan->nama = $request->nama;
            $simpan->username = $request->username;
            $simpan->password = Hash::make($request->password);
            $simpan->tempat_lahir = $request->tempat_lahir;
            $simpan->tanggal_lahir = $request->tanggal_lahir;
            $simpan->jenis_kelamin = $request->jenis_kelamin;
            $simpan->alamat = $request->alamat;
            $simpan->semester = $request->semester;
            $simpan->save();

            return response()->json($simpan->id, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $upusr = tb_user::find($id);

        if (is_null($request->file('file_foto'))) {
            $nama = "assets\foto_users\blank.jpg";
                }else{
                $file = $request->file('file_foto');
                $tujuan = 'assets\foto_users\\';
                $file->move($tujuan,$file->getClientOriginalName());
                $nama =$tujuan.$file->getClientOriginalName();
                };

        $upusr->id_universitas = $request->id_universitas;
        $upusr->id_fakultas = $request->id_fakultas;
        $upusr->id_prodi = $request->id_prodi;
        $upusr->nama = $request->nama;
        $upusr->username = $request->username;
        $upusr->password = Hash::make($request->password);
        $upusr->tempat_lahir = $request->tempat_lahir;
        $upusr->tanggal_lahir = $request->tanggal_lahir;
        $upusr->jenis_kelamin = $request->jenis_kelamin;
        $upusr->alamat = $request->alamat;
        $upusr->semester = $request->semester;
        $upusr->save();

        return response()->json($upusr->id, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userdlt =tb_user::find($id);
        $userdlt->delete();

        return response()->json($userdlt, 200);
    }
}
