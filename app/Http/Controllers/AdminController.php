<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
{
    public function index(){
        $menu = 'pendaftaran';
        $submenu = 'semua_pendaftaran';

        $pendaftaran = DB::table('usulan_bisnis as ub')
                            ->join('anggota as a', 'a.idusulan_bisnis', '=', 'ub.idusulan_bisnis')
                            ->join('mahasiswa as mhs', 'mhs.idmahasiswa', '=', 'a.idmahasiswa')
                            ->join('bidang_bisnis as bb', 'bb.idbidang_bisnis', '=', 'ub.idbidang_bisnis')
                            ->select('ub.idusulan_bisnis', 'ub.nama_bisnis', 'ub.tahun', 'ub.status_pengajuan', 'ub.status_bisnis', 'bb.nama_bidang')
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

        return view('admin.index', compact('menu', 'submenu', 'pendaftaran', 'anggota'));
    }

    public function view_form(Request $request) {
        $usulan_bisnis = DB::table('usulan_bisnis')
                            ->where('idusulan_bisnis', $request->idusulan_bisnis)
                            ->first();

        // dd($usulan_bisnis);

        if($usulan_bisnis) {
            if($usulan_bisnis->status_pengajuan == 1){
                return redirect()->route('admin.pendaftaran_baru_edit', ['idusulan_bisnis' => Crypt::encrypt($request->idusulan_bisnis)]);
            }
            else if($usulan_bisnis->status_pengajuan == 3){
                return redirect()->route('admin.pendaftaran_baru_view', ['idusulan_bisnis' => Crypt::encrypt($request->idusulan_bisnis)]);
            }
        } else {
            return response()->json([
                'code' => 404,
                'status' => 'error',
                'message' => 'Usulan bisnis tidak ditemukan'
             ]);
        }
        

    }

    public function pendaftaran_baru_view($idusulan_bisnis){
        $menu = 'pendaftaran';
        $submenu = 'semua_pendaftaran';

        date_default_timezone_set('Asia/Jakarta');
        $tahun = date('Y');

        $idusulan_bisnis = Crypt::decrypt($idusulan_bisnis);

        // dd(session('userdata'));

        $pendaftaran = DB::table('usulan_bisnis as ub')
                            ->join('anggota as a', 'a.idusulan_bisnis', '=', 'ub.idusulan_bisnis')
                            ->join('mahasiswa as mhs', 'mhs.idmahasiswa', '=', 'a.idmahasiswa')
                            ->select('ub.*')
                            ->where('ub.idusulan_bisnis', $idusulan_bisnis)
                            ->get();

        

        $anggota = [];

        if(count($pendaftaran) > 0){
            $anggota = DB::table('anggota as a')
                            ->join('usulan_bisnis as ub', 'ub.idusulan_bisnis', '=', 'a.idusulan_bisnis')
                            ->join('mahasiswa as mhs', 'mhs.idmahasiswa', '=', 'a.idmahasiswa')
                            ->join('users as u', 'u.idusers', '=', 'mhs.idusers')
                            ->select('a.idanggota', 'a.tipe_anggota', 'mhs.idfakultas', 'mhs.idprogram_studi','u.nama_user as nama', 'u.nipniknim as nim')
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

        return view('admin.pendaftaran_baru_view', compact('menu', 'submenu', 'pendaftaran', 'tahun', 'bidangbisnis', 'anggota', 'file_proposal', 'file_bmc'));
    }
}
