<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class FilestorageController extends Controller
{
    public function get_file($id){
        $idfile = Crypt::decrypt($id);
        $file = DB::table('file')
                    ->where('idfile', $idfile)
                    ->first();

        // dd($file);

        if($file){
            $file_path = $file->path_file;
            if(Storage::exists($file_path)){
                return Storage::response($file_path, $file->nama_file);
            }
        }
    }

    public function hapus_file($id){
        $idfile = Crypt::decrypt($id);
        $file = DB::table('file')
                    ->where('idfile', $idfile)
                    ->first();

        if($file){
            $file_path = $file->path_file;
            if(Storage::exists($file_path)){
                Storage::delete($file_path);
            }

            DB::table('file')
                ->where('idfile', $idfile)
                ->delete();

            return redirect()->back()->with('success', 'File berhasil dihapus');
        }
        else{
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }
    }
}
