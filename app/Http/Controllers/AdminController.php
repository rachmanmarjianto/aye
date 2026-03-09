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
                            ->select('a.idanggota', 'a.tipe_anggota', 'mhs.idfakultas', 'mhs.idprogram_studi','u.nama_user as nama', 'u.nipniknim as nim', 
                                    'a.idusulan_bisnis', 'mhs.nama_program_studi', 'mhs.nama_fakultas', 'mhs.nama_jenjang')
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
                    'nama_program_studi' => $a->nama_program_studi,
                    'nama_fakultas' => $a->nama_fakultas,
                    'nama_jenjang' => $a->nama_jenjang,
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
            // if($usulan_bisnis->status_pengajuan == 1){
            //     return redirect()->route('admin.pendaftaran_baru_edit', ['idusulan_bisnis' => Crypt::encrypt($request->idusulan_bisnis)]);
            // }
            // else if($usulan_bisnis->status_pengajuan == 3){
                return redirect()->route('admin.pendaftaran_baru_view', ['idusulan_bisnis' => Crypt::encrypt($request->idusulan_bisnis)]);
            // }
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

        return view('admin.pendaftaran_baru_view', compact('menu', 'submenu', 'pendaftaran', 'tahun', 'bidangbisnis', 'anggota', 'file_proposal', 'file_bmc'));
    }

    public function bidang_bisnis(){
        $menu = 'master';
        $submenu = 'bidang_bisnis';

        $bidangbisnis = DB::table('bidang_bisnis')->where('status', 1)->get();

        return view('admin.bidang_bisnis', compact('menu', 'submenu', 'bidangbisnis'));
    }

    public function bidang_bisnis_tambah(){
        $menu = 'master';
        $submenu = 'bidang_bisnis';

        return view('admin.tambah_bidang_bisnis', compact('menu', 'submenu'));
    }

    public function bidang_bisnis_tambah_submit(Request $request){

        // dd($request->all());
        $request->validate([
            'nama_bidang' => 'required',
        ]);

        $juml_bidang = DB::table('bidang_bisnis')
                        ->count();

        DB::table('bidang_bisnis')->insert([
            'idbidang_bisnis' => $juml_bidang + 1,
            'nama_bidang' => $request->nama_bidang,
            'status' => 1,
        ]);

        return redirect()->route('admin.master.bidang_bisnis')->with('success', 'Bidang bisnis berhasil ditambahkan');
    }

    public function bidang_bisnis_edit($id){
        $menu = 'master';
        $submenu = 'bidang_bisnis';

        $idbidang_bisnis = Crypt::decrypt($id);

        $bidangbisnis = DB::table('bidang_bisnis')
                            ->where('idbidang_bisnis', $idbidang_bisnis)
                            ->first();

        if(!$bidangbisnis){
            return redirect()->route('admin.master.bidang_bisnis')->with('error', 'Bidang bisnis tidak ditemukan');
        }

        return view('admin.edit_bidang_bisnis', compact('menu', 'submenu', 'bidangbisnis'));
    }

    public function bidang_bisnis_edit_submit(Request $request){
        // dd($request->all());
        $request->validate([
            'idbidang_bisnis' => 'required',
            'nama_bidang' => 'required',
        ]);

        try {
            DB::table('bidang_bisnis')
            ->where('idbidang_bisnis', $request->idbidang_bisnis)
            ->update([
                'nama_bidang' => $request->nama_bidang,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.master.bidang_bisnis')->with('error', 'Gagal mengupdate bidang bisnis');
        }

        return redirect()->route('admin.master.bidang_bisnis')->with('success', 'Bidang bisnis berhasil diupdate');
    }

    public function bidang_bisnis_hapus($id){
        $idbidang_bisnis = Crypt::decrypt($id);

        try {
            DB::table('bidang_bisnis')
                ->where('idbidang_bisnis', $idbidang_bisnis)
                ->update(['status' => 0]);
        } catch (\Exception $e) {
            return redirect()->route('admin.master.bidang_bisnis')->with('error', 'Gagal menghapus bidang bisnis');
        }

        return redirect()->route('admin.master.bidang_bisnis')->with('success', 'Bidang bisnis berhasil dihapus');
    }

    public function update_status_pendaftaran(Request $request){
        // dd($request->all());

        $request->validate([
            'idusulan_bisnis' => 'required',
            'status_pengajuan' => 'required|in:4,5',
        ]);

        $cekstatus = DB::table('usulan_bisnis')
                        ->where('idusulan_bisnis', $request->idusulan_bisnis)
                        ->value('status_pengajuan');

        if($cekstatus != 3){
            return redirect()->back()->with('error', 'Gagal memperbarui status bisnis: Mahasiswa merubah status ajuan!');
        }


        date_default_timezone_set('Asia/Jakarta');

        try {
            DB::beginTransaction();
            DB::table('usulan_bisnis')
                ->where('idusulan_bisnis', $request->idusulan_bisnis)
                ->update(['status_pengajuan' => $request->status_pengajuan]);

            DB::table('log_status_usulan_bisnis')
                ->insert([
                    'idusulan_bisnis' => $request->idusulan_bisnis,
                    'status_pengajuan' => $request->status_pengajuan,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => session('userdata')['idusers'],
                ]);

            DB::commit();

            return redirect()->route('admin.index')->with('success', 'Status usulan bisnis berhasil diperbaru');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Gagal memperbarui status bisnis: ' . $e->getMessage());
        }

        
    }
}
