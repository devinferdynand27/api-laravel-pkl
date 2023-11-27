<?php
namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;
use App\Models\Tb_absensi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class TbAbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $absensi = Tb_absensi::orderBy('created_at', 'desc')->get();
         $format_tanggal = $absensi->map(function ($item) {
            return [
                'id' => $item->id,
                'id_hari' => $item->id_hari,
                'foto' => $item->foto,
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
            'message' => 'Data absensi Ditampilkan',
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
            'id_user' => 'required',
            'foto' => 'required',
        ]);
        if ($validated->fails()) {
            return response()->json($validated->errors(), 400);
        }

        $userAttendance = Tb_absensi::where('id_user', $request->id_user)
        ->whereDate('created_at', Carbon::today())
        ->first();
        if ($userAttendance) {
            $absensi = "Tidak bisa absen kembali.";
            $filePath = 'Tidak Bisa Absen';
        } else {
            $imageData = $request->input('foto');
            $decodedImage = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
            $filename = Str::uuid() . '.png';
            // Use the storage folder instead of public_path
            $directory = storage_path('app/public/images');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0775, true);
            }
            
            $filePath = $directory . '/' . $filename;
            file_put_contents($filePath, $decodedImage);
            $absensi = new Tb_absensi();
            $absensi->foto = $filename;
            $absensi->id_hari = $request->id_hari;
            $absensi->id_user = $request->id_user;
            $absensi->save();
        }
      
        return response()->json(
            [
                'file_path' => 'Image uploaded successfully', 'file_path' => $filePath,
                'message' =>  $absensi,
            ]
        );

        

       
    }

    public function showImage($filename)
    {
        $path = 'public/images/' . $filename;

        if (Storage::disk('local')->exists($path)) {
            $file = Storage::disk('local')->get($path);
            $type = Storage::disk('local')->mimeType($path);

            return response($file, 200)->header('Content-Type', $type);
        } else {
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_absensi  $tb_absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_absensi $tb_absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_absensi  $tb_absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_absensi $tb_absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_absensi  $tb_absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_absensi $tb_absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_absensi  $tb_absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_absensi $tb_absensi)
    {
        //
    }
}
