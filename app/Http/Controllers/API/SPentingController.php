<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\S_penting;
use Illuminate\Http\Request;

class SPentingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return S_penting::latest()->paginate(10);
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
            'no_surat'  => 'required|string|max:191|unique:s_pentings',
            'judul' => 'required|string|max:191',
            'jenis'  => 'required|string|max:191',
            'tgl_surat'  => 'required'
        ]);



        return S_penting::create([
            'no_surat' => $request['no_surat'],
            'judul' => $request['judul'],
            'jenis' => $request['jenis'],
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
        $s_penting = S_penting::findOrFail($id);
        $this->validate($request, [
            'no_surat'  => 'required|string|max:191|unique:s_pentings,no_surat,' . $s_penting->id,
            'judul' => 'required|string|max:191',
            'jenis'  => 'required|string|max:191',
            'tgl_surat'  => 'required'
        ]);
        $s_penting->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $s_penting = S_penting::findOrFail($id);
        $s_penting->delete();
    }
}
