<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;


class MahasiswaController extends Controller
{
    public function index() {
        $menu = 'pendaftaran';
        $submenu = 'semua_pendaftaran';

        $pendaftaran = DB::table('usulan_bisnis as ub')
                            ->join('anggota as a', 'a.idusulan_bisnis', '=', 'ub.idusulan_bisnis')
                            ->join('mahasiswa as mhs', 'mhs.idmahasiswa', '=', 'a.idmahasiswa')
                            ->join('bidang_bisnis as bb', 'bb.idbidang_bisnis', '=', 'ub.idbidang_bisnis')
                            ->select('ub.idusulan_bisnis', 'ub.nama_bisnis', 'ub.tahun', 'ub.status_pengajuan', 'ub.status_bisnis', 'bb.nama_bidang')
                            ->where('mhs.idusers', session('userdata')['idusers'])
                            ->groupBy('ub.idusulan_bisnis', 'ub.nama_bisnis', 'ub.tahun', 'ub.status_pengajuan', 'ub.status_bisnis', 'bb.nama_bidang')
                            ->orderBy('ub.idusulan_bisnis', 'asc')
                            ->get();

        if(count($pendaftaran) > 0){
            $idusulan_bisnis = $pendaftaran->pluck('idusulan_bisnis')->toArray();

            $anggota_q = DB::table('anggota as a')
                            ->join('usulan_bisnis as ub', 'ub.idusulan_bisnis', '=', 'a.idusulan_bisnis')
                            ->join('mahasiswa as mhs', 'mhs.idmahasiswa', '=', 'a.idmahasiswa')
                            ->join('users as u', 'u.idusers', '=', 'mhs.idusers')
                            ->select('a.idanggota', 'a.tipe_anggota', 'mhs.idfakultas', 'mhs.idprogram_studi','u.nama_user as nama', 'u.nipniknim as nim', 'a.idusulan_bisnis')
                            ->whereIn('a.idusulan_bisnis', $idusulan_bisnis)
                            ->where('a.is_deleted', 'false')
                            ->get();

            $anggota = [];

            foreach($anggota_q as $a){
                if(!array_key_exists($a->idusulan_bisnis, $anggota)){
                    $anggota[$a->idusulan_bisnis] = [];
                }                
                
                $anggota[$a->idusulan_bisnis][] = [
                    'idanggota' => $a->idanggota,
                    'tipe_anggota' => $a->tipe_anggota,
                    'idfakultas' => $a->idfakultas,
                    'idprogram_studi' => $a->idprogram_studi,
                    'nama' => $a->nama,
                    'nim' => $a->nim,
                ];
            }
        }
        else{
            $anggota = [];
        }

        // dd($pendaftaran, $anggota);

        return view('mahasiswa.index', compact('menu', 'submenu', 'pendaftaran', 'anggota'));
    }

    public function pendaftaran_baru_new() {
        $menu = 'pendaftaran';
        $submenu = 'pendaftaran_baru';

        date_default_timezone_set('Asia/Jakarta');
        $tahun = date('Y');

        $bidangbisnis = DB::table('bidang_bisnis')->get();

        $pendaftaran = [];

        $anggota = [];

        $file_proposal = [];
        $file_bmc = [];

        return view('mahasiswa.pendaftaran_baru', compact('menu', 'submenu', 'tahun', 'bidangbisnis', 'pendaftaran', 'anggota', 'file_proposal', 'file_bmc'));
    }

    public function pendaftaran_baru_view($idusulan_bisnis){
        $menu = 'pendaftaran';
        $submenu = 'pendaftaran_baru';

        date_default_timezone_set('Asia/Jakarta');
        $tahun = date('Y');

        $idusulan_bisnis = Crypt::decrypt($idusulan_bisnis);

        // dd(session('userdata'));

        $pendaftaran = DB::table('usulan_bisnis as ub')
                            ->join('anggota as a', 'a.idusulan_bisnis', '=', 'ub.idusulan_bisnis')
                            ->join('mahasiswa as mhs', 'mhs.idmahasiswa', '=', 'a.idmahasiswa')
                            ->select('ub.*')
                            ->where('ub.idusulan_bisnis', $idusulan_bisnis)
                            ->where('mhs.idusers', session('userdata')['idusers'])
                            ->get();

        $anggota = [];

        if(count($pendaftaran) > 0){
            $anggota = DB::table('anggota as a')
                            ->join('usulan_bisnis as ub', 'ub.idusulan_bisnis', '=', 'a.idusulan_bisnis')
                            ->join('mahasiswa as mhs', 'mhs.idmahasiswa', '=', 'a.idmahasiswa')
                            ->join('users as u', 'u.idusers', '=', 'mhs.idusers')
                            ->select('a.idanggota', 'a.tipe_anggota', 'mhs.idfakultas', 'mhs.idprogram_studi','u.nama_user as nama', 'u.nipniknim as nim', 
                                    'mhs.nama_program_studi', 'mhs.nama_fakultas', 'mhs.nama_jenjang')
                            ->where('a.idusulan_bisnis', $idusulan_bisnis)
                            ->where('a.is_deleted', 'false')
                            ->get();
        }

        // dd($anggota, $pendaftaran);
        // dd(count($anggota));

        $file = DB::table('file')
                    ->where('idusulan_bisnis', $idusulan_bisnis)
                    ->get();

        $file_proposal = [];
        $file_bmc = [];

        foreach($file as $f){
            if($f->tipe_file == 1){
                $file_proposal[] = $f;
            }
            else if($f->tipe_file == 2){
                $file_bmc[] = $f;
            }
        }
        
        $bidangbisnis = DB::table('bidang_bisnis')->get();

        return view('mahasiswa.pendaftaran_baru_view', compact('menu', 'submenu', 'pendaftaran', 'tahun', 'bidangbisnis', 'anggota', 'file_proposal', 'file_bmc'));
    }

    public function pendaftaran_baru($idusulan_bisnis) {
        $menu = 'pendaftaran';
        $submenu = 'pendaftaran_baru';

        date_default_timezone_set('Asia/Jakarta');
        $tahun = date('Y');

        $idusulan_bisnis = Crypt::decrypt($idusulan_bisnis);

        // dd(session('userdata'));

        $pendaftaran = DB::table('usulan_bisnis as ub')
                            ->join('anggota as a', 'a.idusulan_bisnis', '=', 'ub.idusulan_bisnis')
                            ->join('mahasiswa as mhs', 'mhs.idmahasiswa', '=', 'a.idmahasiswa')
                            ->select('ub.*')
                            ->where('ub.idusulan_bisnis', $idusulan_bisnis)
                            ->where('mhs.idusers', session('userdata')['idusers'])
                            ->get();

        $anggota = [];

        if(count($pendaftaran) > 0){
            $anggota = DB::table('anggota as a')
                            ->join('usulan_bisnis as ub', 'ub.idusulan_bisnis', '=', 'a.idusulan_bisnis')
                            ->join('mahasiswa as mhs', 'mhs.idmahasiswa', '=', 'a.idmahasiswa')
                            ->join('users as u', 'u.idusers', '=', 'mhs.idusers')
                            ->select('a.idanggota', 'a.tipe_anggota', 'mhs.idfakultas', 
                                    'mhs.idprogram_studi','u.nama_user as nama', 'mhs.nama_program_studi', 'mhs.nama_fakultas',
                                    'mhs.nama_jenjang', 'u.nipniknim as nim')
                            ->where('a.idusulan_bisnis', $idusulan_bisnis)
                            ->where('a.is_deleted', 'false')
                            ->get();
        }

        // dd($anggota, $pendaftaran);
        // dd(count($anggota));

        $file = DB::table('file')
                    ->where('idusulan_bisnis', $idusulan_bisnis)
                    ->get();

        $file_proposal = [];
        $file_bmc = [];

        foreach($file as $f){
            if($f->tipe_file == 1){
                $file_proposal[] = $f;
            }
            else if($f->tipe_file == 2){
                $file_bmc[] = $f;
            }
        }
        
        $bidangbisnis = DB::table('bidang_bisnis')->get();

        return view('mahasiswa.pendaftaran_baru', compact('menu', 'submenu', 'pendaftaran', 'tahun', 'bidangbisnis', 'anggota', 'file_proposal', 'file_bmc'));
    }

    public function pendaftaran_baru_nama_bisnis(Request $request) {
        // dd($request->all());
        $validator = \Validator::make($request->all(), [
            'nama_bisnis' => 'required|string|max:255',
            'bidang_bisnis' => 'required|integer',
            'status_bisnis' => 'required|integer',
            'link_sosmed' => 'required|url|max:500',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->messages(); // Mendapatkan semua error dalam bentuk array

            $text = '';
            foreach($errors as $field => $messages) {
                foreach($messages as $message) {
                    $text .= $message . ' ';
                }
            }

            return redirect()->back()->with('error', $text)->withInput();
        }

        // dd($request->all());

        $arr_insert = [
            'nama_bisnis' => $request->nama_bisnis,
            'idbidang_bisnis' => $request->bidang_bisnis,
            'status_bisnis' => $request->status_bisnis,
            'link_sosmed' => $request->link_sosmed,
            'tahun' => date('Y'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session('userdata')['idusers'],
            'status_pengajuan' => 1
        ];

        try {
            DB::beginTransaction();

            $idusulan_bisnis = DB::table('usulan_bisnis')->insertGetId($arr_insert, 'idusulan_bisnis');

            $arr_log = [
            'idusulan_bisnis' => $idusulan_bisnis,
            'status_pengajuan' => 1,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => session('userdata')['idusers'],
            ];

            $idmahasiswa = DB::table('mahasiswa')->where('idusers', session('userdata')['idusers'])->value('idmahasiswa');

            $arr_anggota = [
            'idusulan_bisnis' => $idusulan_bisnis,
            'idmahasiswa' => $idmahasiswa,
            'tipe_anggota' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => session('userdata')['idusers'],
            ];

            DB::table('log_status_usulan_bisnis')->insert($arr_log);
            DB::table('anggota')->insert($arr_anggota);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan pendaftaran: ' . $e->getMessage())->withInput();
        }



        // Add logic to save the business registration here
        // return redirect()->back()->with('success', 'Pendaftaran berhasil disimpan, lengkapi data lainnya');
        $idusulan_bisnis_encrypt = Crypt::encrypt($idusulan_bisnis);
        return redirect()->route('mahasiswa.pendaftaran_baru_edit', ['idusulan_bisnis' => $idusulan_bisnis_encrypt])->with('success', 'Pendaftaran berhasil disimpan, lengkapi data lainnya');
    }

    public function cari_mahasiswa(Request $request) {
        $nim = $request->nim;

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://apicybercampus.unair.ac.id/api/auth/login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('LoginForm[username]' => $request->nim,'LoginForm[password]' => env('PASS_API_UACC')),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        
        $data_hasil = json_decode($response, true);
        
        if($data_hasil['status'] == 'success'){
            if($data_hasil['data']['join_table'] != 3){
                return response()->json([
                    'code' => 403,
                    'status' => 'error',
                    'message' => 'Bukan Mahasiswa!'
                 ]);
             }

            $data_mhs = DB::table('fdw.mahasiswa_aktif')
                            ->where('nim_mhs', $request->nim)
                            ->get();

            if(count($data_mhs) == 0){
                return response()->json([
                    'code' => 404,
                    'status' => 'error',
                    'message' => 'Data mahasiswa aktif tidak ditemukan.'
                 ]);
            }


            return response()->json([
                'code' => 200,
                'status' => 'success',
                'data' => [
                    'nama' => $data_hasil['data']['name'],
                    'nim' => $data_hasil['data']['username'],
                    'idfakultas' => $data_hasil['data']['fakultas'],
                    'nama_jenjang' => $data_mhs[0]->nm_jenjang,
                    'nama_fakultas' => $data_mhs[0]->nm_fakultas,
                    'idprogram_studi' => $data_hasil['data']['mahasiswa']['ID_PROGRAM_STUDI'],
                    'nama_program_studi' => $data_mhs[0]->nm_program_studi,
                    'idmahasiswa' => $data_hasil['data']['mahasiswa']['ID_MHS'],
                    'idusers' => $data_hasil['data']['id'],
                    'join_table' => $data_hasil['data']['join_table'],
                ]
             ]);
        }
        else{
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Mahasiswa tidak ditemukan'
             ]);
        }
    }

    public function tambahkan_anggota(Request $request) {
        // dd($request->all());
        $validator = \Validator::make($request->all(), [
            'nim' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'idfakultas' => 'required|integer',
            'idprogram_studi' => 'required|integer',
            'idmahasiswa' => 'required|numeric',
            'idusulan_bisnis' => 'required|integer',
            'idusers' => 'required|integer',
            'peran' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->messages(); // Mendapatkan semua error dalam bentuk array

            $text = '';
            foreach($errors as $field => $messages) {
                foreach($messages as $message) {
                    $text .= $message . ' ';
                }
            }

            return response()->json([
                'code' => 422,
                'status' => 'error',
                'message' => $text
             ]);
        }

        $cek = DB::table('users')
                    ->join('users_role', 'users.idusers', '=', 'users_role.idusers')
                    ->join('mahasiswa', 'mahasiswa.idusers', '=', 'users.idusers')
                    ->where('nipniknim', $request->nim)
                    ->select('users.*', 'users_role.idrole as idrole', 'mahasiswa.nama_program_studi', 'mahasiswa.nama_fakultas', 'mahasiswa.nama_jenjang')
                    ->get();

        $array_helper = [];

        if(count($cek) == 0){

            $data_mhs = DB::table('fdw.mahasiswa_aktif')
                            ->where('nim_mhs', $request->nim)
                            ->get();

            $array_helper['nama_program_studi'] = $data_mhs[0]->nm_program_studi;
            $array_helper['nama_fakultas'] = $data_mhs[0]->nm_fakultas;
            $array_helper['nama_jenjang'] = $data_mhs[0]->nm_jenjang;

            $arr_insert_user = [
                'idusers' => $request->idusers,
                'nipniknim' => $request->nim,
                'nama_user' => $request->nama,
                'join_table' => $request->join_table,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $arr_insert_mhs = [
                'idmahasiswa' => $request->idmahasiswa,
                'idusers' => $request->idusers,
                'nama_program_studi' => $data_mhs[0]->nm_program_studi,
                'nama_fakultas' => $data_mhs[0]->nm_fakultas,
                'nama_jenjang' => $data_mhs[0]->nm_jenjang,
                'idprogram_studi' => $request->idprogram_studi,
                'idfakultas' => $request->idfakultas,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $arr_insert_role = [
                'idusers' => $request->idusers,
                'idrole' => $request->join_table,
                'status' => 'true',
                'created_at' => date('Y-m-d H:i:s'),
            ];

            try {
                DB::beginTransaction();

                DB::table('users')->insert($arr_insert_user);
                DB::table('mahasiswa')->insert($arr_insert_mhs);
                DB::table('users_role')->insert($arr_insert_role);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'code' => 500,
                    'status' => 'error',
                    'message' => 'Gagal menambahkan anggota: ' . $e->getMessage()
                 ]);
            }

            
        }
        else{
            $array_helper['nama_program_studi'] = $cek[0]->nama_program_studi;
            $array_helper['nama_fakultas'] = $cek[0]->nama_fakultas;
            $array_helper['nama_jenjang'] = $cek[0]->nama_jenjang;
        }

        $iduser = $request->idusers;
        $idusulan_bisnis = $request->idusulan_bisnis;        

        try {
            DB::beginTransaction();
            $arr_anggota = [
                'idusulan_bisnis' => $request->idusulan_bisnis,
                'idmahasiswa' => $request->idmahasiswa,
                'tipe_anggota' => $request->peran,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => session('userdata')['idusers'],
            ];

            $idanggota = DB::table('anggota')->insertGetId($arr_anggota, 'idanggota');

            DB::commit();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Anggota berhasil ditambahkan',
                'data' => [
                    'nama' => $request->nama,
                    'nim' => $request->nim,
                    'idfakultas' => $request->idfakultas,
                    'idprogram_studi' => $request->idprogram_studi,
                    'idmahasiswa' => $request->idmahasiswa,
                    'idusers' => $request->idusers,
                    'join_table' => $request->join_table,
                    'nama_program_studi' => $array_helper['nama_program_studi'],
                    'nama_fakultas' => $array_helper['nama_fakultas'],
                    'nama_jenjang' => $array_helper['nama_jenjang'],
                    'idanggota' => $idanggota,
                ]
             ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => 'Gagal menambahkan anggota: ' . $e->getMessage()
             ]);
        }
    }

    public function set_ketua(Request $request) {
        // dd($request->all());
        $validator = \Validator::make($request->all(), [
            'idanggota' => 'required|integer',
            'idusulan_bisnis' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->messages(); // Mendapatkan semua error dalam bentuk array

            $text = '';
            foreach($errors as $field => $messages) {
                foreach($messages as $message) {
                    $text .= $message . ' ';
                }
            }

            return response()->json([
                'code' => 422,
                'status' => 'error',
                'message' => $text
             ]);
        }

        try {
            DB::beginTransaction();

            DB::table('anggota')
                ->where('idusulan_bisnis', $request->idusulan_bisnis)
                ->update(['tipe_anggota' => 2]);

            DB::table('anggota')
                ->where('idanggota', $request->idanggota)
                ->update(['tipe_anggota' => 1]);

            DB::commit();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Ketua berhasil diubah',
             ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => 'Gagal mengubah ketua: ' . $e->getMessage()
             ]);
        }
    }

    public function hapus_anggota(Request $request) {
        // dd($request->all());
        $validator = \Validator::make($request->all(), [
            'idanggota' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->messages(); // Mendapatkan semua error dalam bentuk array

            $text = '';
            foreach($errors as $field => $messages) {
                foreach($messages as $message) {
                    $text .= $message . ' ';
                }
            }

            return response()->json([
                'code' => 422,
                'status' => 'error',
                'message' => $text
             ]);
        }

        try {
            DB::beginTransaction();

            DB::table('anggota')
                ->where('idanggota', $request->idanggota)
                ->update(['is_deleted' => 'true']);

            DB::commit();

            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Anggota berhasil dihapus',
             ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => 'Gagal menghapus anggota: ' . $e->getMessage()
             ]);
        }
    }

    public function update_pendaftaran(Request $request) {
        // dd($request->all());
        $validator = \Validator::make($request->all(), [
            'idusulan_bisnis' => 'required|integer',
            'nama_bisnis' => 'required|string|max:255',
            'bidang_bisnis' => 'required|integer',
            'status_bisnis' => 'required|integer',
            'link_sosmed' => 'required|url|max:500',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->messages(); // Mendapatkan semua error dalam bentuk array

            $text = '';
            foreach($errors as $field => $messages) {
                foreach($messages as $message) {
                    $text .= $message . ' ';
                }
            }

            return redirect()->back()->with('error', $text);
        }

        // dd($request->all());

        date_default_timezone_set('Asia/Jakarta');
        $ts = date('Y-m-d H:i:s');
        $today = date('Y-m-d');


        $arr_update = [
            'nama_bisnis' => $request->nama_bisnis,
            'idbidang_bisnis' => $request->bidang_bisnis,
            'status_bisnis' => $request->status_bisnis,
            'link_sosmed' => $request->link_sosmed,
            'status_pengajuan' => $request->status_pengajuan,
        ];

        $arr_log = [
            'idusulan_bisnis' => $request->idusulan_bisnis,
            'status_pengajuan' => $request->status_pengajuan,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => session('userdata')['idusers'],
        ];

        try {
            DB::beginTransaction();

            DB::table('usulan_bisnis')
                ->where('idusulan_bisnis', $request->idusulan_bisnis)
                ->update($arr_update);

            DB::table('log_status_usulan_bisnis')->insert($arr_log);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan pendaftaran: ' . $e->getMessage());
        }

        if ($request->hasFile('document_proposal') != null) {
            $file = $request->file('document_proposal');

            if ($file->getSize() > 5 * 1024 * 1024) {
                return redirect()->back()->with('error', 'Ukuran file Proposal tidak boleh lebih dari 5 MB');
            }
            
            $filename = \Illuminate\Support\Str::uuid() . '.' . $file->getClientOriginalExtension();

            if(!Storage::disk('local')->exists('private/upload/'.$today)){
                if(!Storage::disk('local')->makeDirectory('private/upload/' . $today)){
                    return redirect()->back()->with('error', 'Gagal membuat direktori penyimpanan');
                }
            }
            $filePath = 'private/upload/'.$today.'/' . $filename;

            try {
                Storage::disk('local')->put($filePath, file_get_contents($file));

                DB::table('file')->insert([
                    'idusulan_bisnis' => $request->idusulan_bisnis,
                    'nama_file' => 'proposal',
                    'path_file' => $filePath,
                    'created_by' => session('userdata')['idusers'],
                    'created_at' => $ts,
                    'tipe_file' => '1',
                ]);
            } catch (\Exception $e) {
                Storage::delete($filePath);

                return redirect()->back()->with('error', 'Proses simpan file Proposal gagal: ' . $e->getMessage());
            }
        }

        if ($request->hasFile('document_bmc') != null) {
            $file = $request->file('document_bmc');

            if ($file->getSize() > 5 * 1024 * 1024) {
                return redirect()->back()->with('error', 'Ukuran file BMC tidak boleh lebih dari 5 MB');
            }
            
            $filename = \Illuminate\Support\Str::uuid() . '.' . $file->getClientOriginalExtension();

            if(!Storage::disk('local')->exists('private/upload/'.$today)){
                if(!Storage::disk('local')->makeDirectory('private/upload/' . $today)){
                    return redirect()->back()->with('error', 'Gagal membuat direktori penyimpanan');
                }
            }
            $filePath = 'private/upload/'.$today.'/' . $filename;

            try {
                Storage::disk('local')->put($filePath, file_get_contents($file));

                DB::table('file')->insert([
                    'idusulan_bisnis' => $request->idusulan_bisnis,
                    'nama_file' => 'bmc',
                    'path_file' => $filePath,
                    'created_by' => session('userdata')['idusers'],
                    'created_at' => $ts,
                    'tipe_file' => '2',
                ]);
            } catch (\Exception $e) {
                Storage::delete($filePath);

                return redirect()->back()->with('error', 'Proses simpan file BMC gagal: ' . $e->getMessage());
            }
        }

        if($request->status_pengajuan == 3){
            return redirect()->route('mahasiswa.index')->with('success', 'Pendaftaran berhasil diajukan');
        }

        return redirect()->back()->with('success', 'Pendaftaran berhasil diperbarui');
    }

    public function view_form(Request $request) {
        $usulan_bisnis = DB::table('usulan_bisnis')
                            ->where('idusulan_bisnis', $request->idusulan_bisnis)
                            ->first();

        // dd($usulan_bisnis);

        if($usulan_bisnis) {
            if($usulan_bisnis->status_pengajuan == 1){
                return redirect()->route('mahasiswa.pendaftaran_baru_edit', ['idusulan_bisnis' => Crypt::encrypt($request->idusulan_bisnis)]);
            }
            else if($usulan_bisnis->status_pengajuan == 3){
                return redirect()->route('mahasiswa.pendaftaran_baru_view', ['idusulan_bisnis' => Crypt::encrypt($request->idusulan_bisnis)]);
            }
        } else {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Usulan bisnis tidak ditemukan'
             ]);
        }
        

    }

}
