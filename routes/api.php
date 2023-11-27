<?php
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\TbSiswaController;
    use App\Http\Controllers\TbTabunganController;
    use App\Http\Controllers\TbKelasController;
    use App\Http\Controllers\TbMapelController;
    use App\Http\Controllers\TbHariController;
    use App\Http\Controllers\TbPengumpulanController;
    use App\Http\Controllers\TbTugasSiswaController;
    use App\Http\Controllers\TbAbsensiController;
    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */

    Route::group(['middleware' => 'api', 'prefix' => 'auth'], function (
        $router
    ) {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });

    // Route::apiResource('siswa',TbSiswaController::class);

    Route::post('siswa/add', [TbSiswaController::class, 'store']);
    Route::get('siswa/show/{id}', [TbSiswaController::class, 'show']);
    Route::post('siswa/edit/{id}', [TbSiswaController::class, 'update']);
    Route::post('siswa/delete/{id}', [TbSiswaController::class, 'delete']);
    Route::get('/user-siswa', [TbSiswaController::class, 'index']);

    // Route::apiResource('tabungan',TbTabunganController::class);

    Route::get('tabungan', [TbTabunganController::class, 'index']);
    Route::post('tabungan/add', [TbTabunganController::class, 'store']);
    Route::get('/detail/tabungan/siswa/{id}', [
        TbTabunganController::class,
        'detailtabunagnsiswaid',
    ]);
    Route::get('/detail/tabungan/{id}', [
        TbTabunganController::class,
        'detail',
    ]);
    Route::put('tabungan/siswa/pengambilan/{id}', [
        TbTabunganController::class,
        'pengambilantabungan',
    ]);
    Route::delete('/tabungan/delete/{id}', [
        TbTabunganController::class,
        'destroy',
    ]);

    // route kelas
    Route::get('kelas', [TbKelasController::class, 'index']);
    Route::post('kelas/add', [TbKelasController::class, 'store']);
    Route::post('kelas/edit/{id}', [TbKelasController::class, 'update']);
    Route::post('kelas/delete/{id}', [TbKelasController::class, 'destroy']);

    // route mapel
    Route::get('mapel', [TbMapelController::class, 'index']);
    Route::get('mapel/show/{id}', [TbMapelController::class, 'show']);
    Route::post('mapel/add', [TbMapelController::class, 'store']);
    Route::post('mapel/edit/{id}', [TbMapelController::class, 'update']);
    Route::post('mapel/delete/{id}', [TbMapelController::class, 'destroy']);

    // hari
    Route::get('hari', [TbHariController::class, 'index']);
    Route::get('hari/show/{id}', [TbHariController::class, 'show']);
    Route::post('hari/add', [TbHariController::class, 'store']);
    Route::post('hari/edit/{id}', [TbHariController::class, 'update']);
    Route::post('hari/delete/{id}', [TbHariController::class, 'destroy']);

    // tugas siswa
    Route::get('tugas-siswa', [TbTugasSiswaController::class, 'index']);
    Route::get('tugas-siswa/show/{id}', [
        TbTugasSiswaController::class,
        'show',
    ]);
    Route::post('tugas-siswa/add', [TbTugasSiswaController::class, 'store']);
    Route::post('tugas-siswa/edit/{id}', [
        TbTugasSiswaController::class,
        'update',
    ]);
    Route::post('tugas-siswa/delete/{id}', [
        TbTugasSiswaController::class,
        'destroy',
    ]);

    //user
    Route::get('/user/tugas-pengumpulan', [
        TbPengumpulanController::class,
        'indexpengumpulan',
    ]);
      Route::get('/user/tugas/detail/{id}', [
        TbPengumpulanController::class,
        'show',
    ]);
      Route::post('/user/pengerjaan-tugas/add/{id}', [
        TbPengumpulanController::class,
        'pengumpulan_tugas',
    ]);

    Route::post('/user/tugas-pengumpulan/filter-status-pengerjaan', [
        TbPengumpulanController::class,
        'filter_pengerjaan',
    ]);

    Route::post('/user/absensi', [
        TbAbsensiController::class,
        'store',
    ]);
    Route::get('/user/absensi/get', [
        TbAbsensiController::class,
        'index',
    ]);

    Route::get('/images/{filename}', [
        TbAbsensiController::class,
        'showImage',
    ]);



