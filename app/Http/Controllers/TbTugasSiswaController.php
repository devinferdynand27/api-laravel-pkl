<?php

namespace App\Http\Controllers;

use App\Models\Tb_tugas_siswa;
use App\Models\User;
use App\Models\Tb_pengumpulan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class TbTugasSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tugas = Tb_tugas_siswa::with('hari', 'kelas', 'mapel')->get();
        $format_tanggal = $tugas->map(function ($item) {
            return [
                'id' => $item->id,
                'id_hari' => $item->id_hari,
                'id_kelas' => $item->id_kelas,
                'id_mapel' => $item->id_mapel,
                'hari' => $item->hari->hari,
                'tugas' => $item->tugas,
                'kelas' => $item->kelas->kelas,
                'mapel' => $item->mapel->mapel,
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
        $validated = Validator::make($request->all(), [
            'id_hari' => 'required',
            'id_kelas' => 'required',
            'id_mapel' => 'required',
            'tugas' => 'required',
        ]);
        if ($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }
        $tugas = new Tb_tugas_siswa();
        $tugas->id_hari = $request->id_hari;
        $tugas->id_kelas = $request->id_kelas;
        $tugas->id_mapel = $request->id_mapel;
        $tugas->tugas = $request->tugas;
        $tugas->save();

        $user = User::where('id_kelas', $request->id_kelas)->get();
        foreach ($user as $item) {
            $pengumpulan = new Tb_pengumpulan();
            $pengumpulan->id_tugas = $tugas->id;
            $pengumpulan->id_user = $item->id;
            $pengumpulan->status = 0;
            $pengumpulan->save();
        }
        $respon = [
            'success' => true,
            'data' => $tugas,
            'message' => 'Tugas siswa telah ditambahkan sesuai banyak user',
        ];

        return response()->json($respon, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_tugas_siswa  $tb_tugas_siswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tugasshow = Tb_tugas_siswa::findOrFail($id);
        $format = [
            'id' => $tugasshow->id,
            'id_hari' => $tugasshow->id_hari,
            'id_kelas' => $tugasshow->id_kelas,
            'id_mapel' => $tugasshow->id_mapel,
            'hari' => $tugasshow->hari->hari,
            'tugas' => $tugasshow->Tugas,
            'kelas' => $tugasshow->kelas->kelas,
            'mapel' => $tugasshow->mapel->mapel,
            'created_at' => Carbon::parse($tugasshow->created_at)->format(
                'Y-m-d H:i:s'
            ),
            'updated_at' => Carbon::parse($tugasshow->updated_at)->format(
                'Y-m-d H:i:s'
            ),
        ];
        $respon = [
            'success' => true,
            'data' => $format,
            'message' => 'Data mapel Di edit',
        ];

        return response()->json($respon, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_tugas_siswa  $tb_tugas_siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_tugas_siswa $tb_tugas_siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_tugas_siswa  $tb_tugas_siswa
     * @return \Illuminate\Http\Response
     */
    public function update(
        Request $request,
        Tb_tugas_siswa $tb_tugas_siswa,
        $id
    ) {
        $validated = Validator::make($request->all(), [
            'id_hari' => 'required',
            'id_kelas' => 'required',
            'id_mapel' => 'required',
            'tugas' => 'required',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        $tugas = Tb_tugas_siswa::findOrFail($id);
        $tugas->tugas = $request->tugas;
        $tugas->id_hari = $request->id_hari;
        $tugas->id_kelas = $request->id_kelas;
        $tugas->id_mapel = $request->id_mapel;
        $tugas->deskripsi = $request->deskripsi;
        $tugas->save();

        $respon = [
            'success' => true,
            'data' => $tugas,
            'message' => 'Data mapel Di edit',
        ];

        return response()->json($respon, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_tugas_siswa  $tb_tugas_siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_tugas_siswa $tb_tugas_siswa, $id)
    {
        $tugas = Tb_tugas_siswa::findOrFail($id);
        $pengumpulan = Tb_pengumpulan::where('id_tugas', $tugas->id)->get();
        foreach ($pengumpulan as $item) {
            $item->delete();
        }
        $tugas->delete();
        $respon = [
            'success' => true,
            'message' => 'Data tugas Di Hapus',
        ];

        return response()->json($respon, 200);
    }
}
