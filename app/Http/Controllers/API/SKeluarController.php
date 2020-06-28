<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\S_keluar;
use Illuminate\Http\Request;

class SKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return S_keluar::latest()->paginate(10);
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
            'no_surat'  => 'required|string|max:191|unique:s_keluars',
            'judul' => 'required|string|max:191',
            'tujuan'  => 'required|string|max:191',
            'tgl_surat'  => 'required'
        ]);



        return S_keluar::create([
            'no_surat' => $request['no_surat'],
            'judul' => $request['judul'],
            'tujuan' => $request['tujuan'],
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
        $s_keluar = S_keluar::findOrFail($id);
        $this->validate($request, [
            'no_surat'  => 'required|string|max:191|unique:s_keluars,no_surat,' . $s_keluar->id,
            'judul' => 'required|string|max:191',
            'tujuan'  => 'required|string|max:191',
            'tgl_surat'  => 'required'
        ]);
        $s_keluar->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $s_keluar = S_keluar::findOrFail($id);
        $s_keluar->delete();
    }
}
