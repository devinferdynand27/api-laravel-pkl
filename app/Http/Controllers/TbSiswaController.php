<?php

namespace App\Http\Controllers;

use App\Models\Tb_siswa;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TbSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function index()
    {
        $user = User::where('roles', 'siswa')->get();
        $respon = [
            'success' => true,
            'data' => $user,
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
            'name' => 'required',
            'id_kelas' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }
        $siswa = new User();
        $siswa->name = $request->name;
        $siswa->id_kelas = $request->id_kelas;
        $siswa->roles = 'siswa';
        $siswa->email = $request->email;
        $siswa->password = Hash::make($request->password);
        $siswa->save();
        $respon = [
            'success' => true,
            'data' => $siswa,
            'message' => 'Data Berhasil Di Tambah',
        ];

        return response()->json($respon, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_siswa  $tb_siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_siswa $tb_siswa, $id)
    {
        $siswa = User::findOrFail($id);
        $respon = [
            'success' => true,
            'data' => $siswa,
        ];
        return response()->json($respon, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_siswa  $tb_siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_siswa $tb_siswa, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_siswa  $tb_siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_siswa $tb_siswa, $id)
    {
        $validated = Validator::make(request()->all(), [
            'name' => 'required',
            'id_kelas' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }
        $siswa = User::findOrFail($id);
        $siswa->name = $request->name;
        $siswa->id_kelas = $request->id_kelas;
        $siswa->roles = 'siswa';
        $siswa->email = $request->email;
        $siswa->password = Hash::make($request->password);
        $siswa->save();
        $respon = [
            'success' => true,
            'data' => $siswa,
            'message' => 'Data Berhasil Di Tambah',
        ];

        return response()->json($respon, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_siswa  $tb_siswa
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Tb_siswa $tb_siswa ,$id)
    // {
    //     $siswa = Tb_siswa::findOrFail($id);
    //     $siswa->delete();
    //     $respon = [
    //         'success' => true,
    //         'message' => 'Siswa Berhasil Siswa'
    //     ];
    //     return response()->json($respon,200);
    // }
    public function delete(Tb_siswa $tb_siswa, $id)
    {
        $siswa = User::findOrFail($id);
        $siswa->delete();
        $respon = [
            'success' => true,
            'message' => 'Siswa Berhasil DiHapus',
        ];
        return response()->json($respon, 200);
    }
}
