<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\S_masuk;
use Illuminate\Http\Request;

class SMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return S_masuk::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'no_surat'  => 'required|string|max:191|unique:s_masuks',
            'judul' => 'required|string|max:191',
            'dari'  => 'required|string|max:191',
            'tgl_surat'  => 'required'
        ]);



        return S_masuk::create([
            'no_surat' => $request['no_surat'],
            'judul' => $request['judul'],
            'dari' => $request['dari'],
            'keterangan' => $request['keterangan'],
            'tgl_surat' => $request['tgl_surat'],
            'softfile' => $request['softfile'],
        ]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $s_masuk = S_masuk::findOrFail($id);
        $this->validate($request, [
            'no_surat'  => 'required|string|max:191|unique:s_masuks,no_surat,' . $s_masuk->id,
            'judul' => 'required|string|max:191',
            'dari'  => 'required|string|max:191',
            'tgl_surat'  => 'required'
        ]);
        $s_masuk->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $s_masuk = S_masuk::findOrFail($id);
        $s_masuk->delete();
    }
}
