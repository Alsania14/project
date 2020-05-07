<?php

namespace App\Http\Controllers;

use App\tb_user;
use App\tb_fakultas;
use App\tb_universitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class TbUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    return view('hello');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ch = curl_init("http://dev.farizdotid.com/api/daerahindonesia/provinsi");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $result= curl_exec($ch);
        curl_close($ch);
        $universitas = tb_universitas::all();
        $provinsi = json_decode($result)->semuaprovinsi;
        return view('/register', compact('universitas', 'provinsi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $validator = Validator::make(request()->all(),[
        
        'nama'=>'required|max:30',
        'tempat_lahir'=>'required|max:30',
        'alamat'=>'required|max:50',
        'semester'=>'required|digits_between:0,8|numeric',
        'jenis_kelamin'=>'required',
        'universitas'=>'required',
        'fakultas'=>'required',
        'prodi'=>'required',
        'tanggal_var'=>'required',
        'bulan_var'=>'required',
        'tahun_var'=>'required',
        'username'=>'required|max:30|unique:tb_users,username',
        'password'=>'required_with:password|same:password|min:5',
        'file_foto'=>'nullable|max:700'
    ],

    [   'nama.required'=>'Masukkan Nama Lengkap Anda',
        'nama.max'=>'Nama Melebihi 30 character',
        'tempat_lahir.required'=>'Masukkan Tempat Lahir',
        'tempat_lahir.max'=>'Tempat Lahir Melebihi 30 Character',
        'alamat.required'=>'Masukkan Alamat Anda',
        'alamat.max'=>'Alamat Melebihi 50 Character',
        'semester.required'=>'Masukkan Status Semester Anda Saat Ini',
        'semester.digits_between'=>'Semester Harus Bernilai Diantara 0-8',
        'semester.numeric'=>'Masukkan Character Numeric',
        'jenis_kelamin.required'=>'Masukkan Jenis Kelamin Anda',
        'universitas.required'=>'Pilih Universitas Anda',
        'fakultas.required'=>'Pilih Fakultas Anda',
        'prodi.required'=>'Pilih Program Studi Anda',
        'tanggal_var.required'=>'Pilih Tanggal Kelahiran Anda',
        'bulan_var.required'=>'Pilih Bulan Kelahiran Anda',
        'tahun_var.required'=>'Pilih Tahun Kelahiran Anda',
        'username.required'=>'Masukkan Username',
        'username.max'=>'Username Melebihi 30 Character',
        'username.unique'=>'Username Telah digunakan',
        'password.required_with'=>'Masukkan Password',
        'password.same'=>'Password Tidak Valid',
        'password.min'=>'Password Kurang Panjang',
        'file_foto.size'=>'ukuran foto terlalu besar, maks 700kb',
        'file_foto.nullable'=>'ya null'
    ]);

   
        if ($validator->fails()){
            
            return redirect()->back()->withErrors($validator->errors());

        }else{
            if (is_null($request->file('file_foto'))) {
            $nama = "assets\foto_users\blank.jpg";
                }else{
                $file = $request->file('file_foto');
                $tujuan = 'assets\foto_users\\';
                $file->move($tujuan,$file->getClientOriginalName());
                $nama =$tujuan.$file->getClientOriginalName();
                }

            $tanggal=$request->tahun_var."-".$request->bulan_var."-".$request->tanggal_var;
            
            $simpan = new tb_user;
            $simpan->id_universitas = $request->universitas;
            $simpan->id_fakultas = $request->fakultas;
            $simpan->id_prodi = $request->prodi;
            $simpan->nama = $request->nama;
            $simpan->username = $request->username;
            $simpan->password = Hash::make($request->password);
            $simpan->tempat_lahir = $request->tempat_lahir;
            $simpan->tanggal_lahir = $tanggal;
            $simpan->jenis_kelamin = $request->jenis_kelamin;
            $simpan->alamat = $request->alamat;
            $simpan->semester = $request->semester;
            $simpan->foto =$nama;
            $simpan->save();
            
            return redirect('/suksesregister');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tb_user  $tb_user
     * @return \Illuminate\Http\Response
     */
    public function show(tb_user $tb_user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tb_user  $tb_user
     * @return \Illuminate\Http\Response
     */
    public function edit(tb_user $tb_user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tb_user  $tb_user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tb_user $tb_user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tb_user  $tb_user
     * @return \Illuminate\Http\Response
     */
    public function destroy(tb_user $tb_user)
    {
        //
    }
}
