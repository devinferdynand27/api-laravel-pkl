<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Tb_hari;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TbHariController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hari = Tb_hari::all();
        $format_tanggal = $hari->map(function ($item) {
            return [
                'id' => $item->id,
                'kelas' => $item->hari,
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
            'message' => 'Data Hari Ditampilkan',
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
            'hari' => 'required|unique:tb_haris,hari',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        $hari = new Tb_hari();
        $hari->hari = $request->hari;
        $hari->save();
        $respon = [
            'success' => true,
            'data' => $hari,
            'message' => 'Data hari Ditambahkan',
        ];

        return response()->json($respon, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_hari  $tb_hari
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_hari $tb_hari)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_hari  $tb_hari
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_hari $tb_hari)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_hari  $tb_hari
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_hari $tb_hari, $id)
    {
        $validated = Validator::make($request->all(), [
            'hari' => 'required|unique:tb_haris,hari',
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        $hari = Tb_hari::findOrFail($id);
        $hari->hari = $request->hari;
        $hari->save();
        $respon = [
            'success' => true,
            'data' => $hari,
            'message' => 'Data hari Ditambahkan',
        ];

        return response()->json($respon, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_hari  $tb_hari
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_hari $tb_hari, $id)
    {
        $hari = Tb_hari::findOrFail($id);
        $hari->delete();
        $respon = [
            'success' => true,
            'data' => $hari,
            'message' => 'Data hari Ditambahkan',
        ];

        return response()->json($respon, 200);

    }
}
