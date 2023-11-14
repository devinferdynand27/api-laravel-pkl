<?php

namespace App\Http\Controllers;

use App\Models\Tb_kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class TbKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Tb_kelas::all();

        $format_tanggal = $kelas->map(function ($item) {
            return [
                'id' => $item->id,
                'kelas' => $item->kelas,
                'created_at' => Carbon::parse($item->created_at)->format(
                    'Y-m-d H:i:s'
                ),
                'updated_at' => Carbon::parse($item->updated_at)->format(
                    'Y-m-d H:i:s'
                ),
            ];
        });

        $respon = [
            'success' => true,
            'data' => $format_tanggal,
            'message' => 'Data Kelas Ditampilkan',
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
        $validated = Validator::make($request->all(), [
            'kelas' => 'required|unique:tb_kelas,kelas',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        $kelas = new Tb_kelas();
        $kelas->kelas = $request->kelas;
        $kelas->save();
        $respon = [
            'success' => true,
            'data' => $kelas,
            'message' => 'Data Kelas Ditambahkan',
        ];

        return response()->json($respon, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_kelas  $tb_kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_kelas $tb_kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_kelas  $tb_kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_kelas $tb_kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_kelas  $tb_kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_kelas $tb_kelas, $id)
    {
        $validated = Validator::make($request->all(), [
            'kelas' => 'required|unique:tb_kelas,kelas',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        $kelas = Tb_kelas::findOrFail($id);
        $kelas->kelas = $request->kelas;
        $kelas->save();
        $respon = [
            'success' => true,
            'data' => $kelas,
            'message' => 'Data Kelas Ditambahkan',
        ];

        return response()->json($respon, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_kelas  $tb_kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_kelas $tb_kelas, $id)
    {
        $kelas = Tb_kelas::findOrFail($id);
        $kelas->delete();
        $respon = [
            'success' => true,
            'data' => $kelas,
            'message' => 'Data Kelas Di Hapus',
        ];

        return response()->json($respon, 200);
    }
}
