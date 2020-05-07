<?php

namespace App\Http\Controllers;

use App\tb_pertemuan;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

class TbPertemuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = new tb_pertemuan;
        $input->id_pemesan = $request->id_usernya;
        $input->id_pengajar = $request->pengajar;
        $input->lokasi = $request->lokasi;
        $input->tanggal_pertemuan = $request->tanggal;
        $input->waktu_pertemuan = $request->time;
        $input->catatan_pemesan = $request->catatan_pemesan;
        $input->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tb_pertemuan  $tb_pertemuan
     * @return \Illuminate\Http\Response
     */
    public function show(tb_pertemuan $tb_pertemuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tb_pertemuan  $tb_pertemuan
     * @return \Illuminate\Http\Response
     */
    public function edit($idnya)
    {
    $data = $idnya;
    $pertemuan =tb_pertemuan::find($idnya);
    return view("editpemesan",compact('pertemuan','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tb_pertemuan  $tb_pertemuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$data)
    {
        $new =tb_pertemuan::find($data);
        $new->lokasi = $request->lokasi;
        $new->tanggal_pertemuan = $request->tanggal_pertemuan;
        $new->waktu_pertemuan = $request->waktu_pertemuan;
        $new->catatan_pemesan =  $request->catatan_pemesan;
        $new->save();

        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tb_pertemuan  $tb_pertemuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(tb_pertemuan $tb_pertemuan)
    {
        //
    }

    public function done($id){
        $don = tb_pertemuan::find($id);

        return view('done',compact('don'));
    }

    public function selesai(Request $request,$id){

        $done = tb_pertemuan::find($id);
        $done->status = "done";
        $done->komentar = $request->commen;
        $done->rating = $request->rating;
        $done->save();

        return redirect('/home');
    }

    public function reject($id){
        $rej = tb_pertemuan::find($id);
        $rej->status = "reject";
        $rej->save();

        return "sukses".$id;

        return "woke";
    }

    public function aprov($id){
        $apr = tb_pertemuan::find($id);
        $apr->status = "approved";
        $apr->save();

        return redirect('/home');
    }
}
