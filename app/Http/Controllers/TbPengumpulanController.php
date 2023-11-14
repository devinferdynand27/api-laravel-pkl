<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Tb_pengumpulan;
use App\Models\Tb_tugas_siswa;
use Illuminate\Http\Request;

class TbPengumpulanController extends Controller
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

    public function pengumpulan_tugas(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'isi_tugas' => 'required',
        ]);
        if ($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }
        $id_user = $request->id_user;
        $pengerjaan = Tb_pengumpulan::findOrFail($id);
        $pengerjaan->isi_tugas = $request->isi_tugas;
        $pengerjaan->status = 1;
        $pengerjaan->save();
        
        $respon = [
            'success' => true,
            'data' => $pengerjaan,
            'message' => 'Data Hari Ditampilkan',
        ];
        return response()->json($respon, 200);
    }

    public function indexpengumpulan()
    {
        $pengumpulan = Tb_pengumpulan::with('tugas')->get();
        $format_tanggal = $pengumpulan->map(function ($item) {
            return [
                'id' => $item->id,
                'id_tugas' => $item->id_tugas,
                'id_user' => $item->id_user,
                'mata_pelajaran' => $item->tugas->mapel->mapel,
                'nama_tugas' => $item->tugas->nama_tugas,
                'kelas' => $item->tugas->kelas->kelas,
                'hari' => $item->tugas->hari->hari,
                'deskripsi_tugas' => $item->tugas->deskripsi,
                'status' => $item->status,
                'created_at' => Carbon::parse($item->created_at)->format(
                    'Y-m-d H:i:s'
                ),
                'updated_at' => Carbon::parse($item->updated_at)->format(
                    'Y-m-d H:i:s'
                ),
            ];
        });

        $respon = [
            'meta' => [
                'code' => 200,
                'success' => true,
                'message' => 'Data Tugas Ditampilkan',
            ],
            'data' => $format_tanggal,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_pengumpulan  $tb_pengumpulan
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_pengumpulan $tb_pengumpulan, $id)
    {
        $detailtugas = Tb_pengumpulan::findOrFail($id);
        $format_tanggal = [
            
                'id' => $detailtugas->id,
                'id_tugas' => $detailtugas->id_tugas,
                'id_user' => $detailtugas->id_user,
                'mata_pelajaran' => $detailtugas->tugas->mapel->mapel,
                'nama_tugas' => $detailtugas->tugas->nama_tugas,
                'kelas' => $detailtugas->tugas->kelas->kelas,
                'hari' => $detailtugas->tugas->hari->hari,
                'deskripsi_tugas' => $detailtugas->tugas->deskripsi,
                'status' => $detailtugas->status,
                'created_at' => Carbon::parse($detailtugas->created_at)->format(
                    'Y-m-d H:i:s'
                ),
                'updated_at' => Carbon::parse($detailtugas->updated_at)->format(
                    'Y-m-d H:i:s'
                ),
        ];
           $respon = [
            'meta' => [
                'code' => 200,
                'success' => true,
                'message' => 'Data Tugas Ditampilkan',
            ],
            'data' => $format_tanggal,
        ];

        return response()->json($respon, 200);
    }


    public function filter_pengerjaan(Request $request){
        $filter_status = $request->filter_status;
        $pengumpulan = Tb_pengumpulan::with('tugas')->where('status',$filter_status)->get();
        $filter = $pengumpulan->map(function ($item) {
            return [
                'id' => $item->id,
                'id_tugas' => $item->id_tugas,
                'id_user' => $item->id_user,
                'mata_pelajaran' => $item->tugas->mapel->mapel,
                'nama_tugas' => $item->tugas->nama_tugas,
                'kelas' => $item->tugas->kelas->kelas,
                'hari' => $item->tugas->hari->hari,
                'deskripsi_tugas' => $item->tugas->deskripsi,
                'status' => $item->status,
                'created_at' => Carbon::parse($item->created_at)->format(
                    'Y-m-d H:i:s'
                ),
                'updated_at' => Carbon::parse($item->updated_at)->format(
                    'Y-m-d H:i:s'
                ),
            ];
        });
        
        $respon = [
            'meta' => [
                'code' => 200,
                'success' => true,
                'message' => 'Fiter Pengerjaan ',
            ],
            'data' => $filter
        ];

        return response()->json($respon, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_pengumpulan  $tb_pengumpulan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_pengumpulan $tb_pengumpulan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_pengumpulan  $tb_pengumpulan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_pengumpulan $tb_pengumpulan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_pengumpulan  $tb_pengumpulan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_pengumpulan $tb_pengumpulan)
    {
        //
    }
}
