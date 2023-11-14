<?php

namespace App\Http\Controllers;

use App\Models\Tb_tabungan;
use App\Models\Tb_siswa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TbTabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Tb_tabungan::with('siswa')->get();
        $respon = [
            'success' => true,
            'data' => $siswa,
            'message' => 'Data tabungan Ditampilkan',
        ];

        return response()->json($respon, 200);
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
        $validated = Validator::make(request()->all(), [
            'id_siswa' => 'required',
            'uang_masuk' => 'required',
            // 'total_tabungan' => 'required',
        ]);
        if ($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        $tabungan = new Tb_tabungan();
        $tabungan->id_siswa = $request->id_siswa;
        $tabungan->uang_masuk = $request->uang_masuk;
        $tabungan->uang_keluar = $request->uang_keluar;
        $tabungan->save();
        $respon = [
            'success' => true,
            'data' => $tabungan,
            'message' => 'Data Berhasil Di Tambah',
        ];

        return response()->json($respon, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_tabungan  $tb_tabungan
     * @return \Illuminate\Http\Response
     */
    public function detailtabunagnsiswaid(Tb_tabungan $tb_tabungan, $id)
    {
        $tabungan = Tb_tabungan::findOrFail($id);
        $id_siswa = $tabungan->id_siswa;
        $tabunganid = Tb_tabungan::where('id_siswa', $id_siswa)->get();
        $respon = [
            'success' => true,
            'message' => 'succes menampilkan data berdasarkan id',
            'data' => $tabunganid,
        ];
        return response()->json($respon, 200);
    }

    public function detail(Tb_tabungan $tb_tabungan, $id)
    {
        $tabungan = Tb_tabungan::findOrFail($id);
        $respon = [
            'success' => true,
            'message' => 'succes menampilkan data berdasarkan id',
            'data' => $tabungan,
        ];
        return response()->json($respon, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_tabungan  $tb_tabungan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_tabungan $tb_tabungan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_tabungan  $tb_tabungan
     * @return \Illuminate\Http\Response
     */
    public function pengambilantabungan(
        Request $request,
        Tb_tabungan $tb_tabungan,
        $id
    ) {
        $validated = Validator::make(request()->all(), [
            // 'id_siswa' => 'required',
            'uang_keluar' => 'required',
        ]);
        if ($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }
        $tabungan = Tb_tabungan::findOrFail($id);
        $tabungan->uang_keluar = $request->uang_keluar;
        $tabungan->save();
        $respon = [
            'success' => true,
            'data' => $tabungan,
            'message' => 'Pengurangan tabungan berhasil',
        ];

        return response()->json($respon, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_tabungan  $tb_tabungan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_tabungan $tb_tabungan, $id)
    {
        $tabungan = Tb_tabungan::findOrFail($id);
        $tabungan->delete();
        $respon = [
            'success' => true,
            'message' => 'Tabungan Berhasil Di Hapus',
        ];

        return response()->json($respon, 200);
    }
}
