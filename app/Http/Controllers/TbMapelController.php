<?php

namespace App\Http\Controllers;

use App\Models\Tb_mapel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TbMapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapel = Tb_mapel::all();

        $format_tanggal = $mapel->map(function ($item) {
            return [
                'id' => $item->id,
                'mapel' => $item->mapel,
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
            'message' => 'Data siswa Ditampilkan',
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
            'mapel' => 'required|unique:tb_mapels,mapel',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        $mapel = new Tb_mapel();
        $mapel->mapel = $request->mapel;
        $mapel->save();
        $respon = [
            'success' => true,
            'data' => $mapel,
            'message' => 'Data mapel Ditambahkan',
        ];

        return response()->json($respon, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_mapel  $tb_mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_mapel $tb_mapel, $id)
    {
        $mapel = Tb_mapel::findOrFail($id);

        $respon = [
            'success' => true,
            'data' => [
                'id' => $mapel->id,
                'mapel' => $mapel->mapel,
                'created_at' => Carbon::parse($mapel->created_at)->format(
                    'Y-m-d H:i:s'
                ),
                'updated_at' => Carbon::parse($mapel->updated_at)->format(
                    'Y-m-d H:i:s'
                ),
            ],
            'message' => 'Melihat Data Sesuai Matapelajaran',
        ];

        return response()->json($respon, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_mapel  $tb_mapel
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_mapel $tb_mapel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_mapel  $tb_mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_mapel $tb_mapel, $id)
    {
        $validated = Validator::make($request->all(), [
            'mapel' => 'required|unique:tb_mapels,mapel',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        $mapel = Tb_mapel::findOrFail($id);
        $mapel->mapel = $request->mapel;
        $mapel->save();
        $respon = [
            'success' => true,
            'data' => $mapel,
            'message' => 'Data mapel Di edit',
        ];

        return response()->json($respon, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_mapel  $tb_mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_mapel $tb_mapel, $id)
    {
        $mapel = Tb_mapel::findOrFail($id);
        $mapel->delete();
        $respon = [
            'success' => true,
            'data' => $mapel,
            'message' => 'Data mapel diHpaus',
        ];
        return response()->json($respon, 200);
    }
}
