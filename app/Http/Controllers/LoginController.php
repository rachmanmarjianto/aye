<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request) {
        // dd($request->all());
        // if ($validator = \Validator::make($request->all(), [
        //     'username' => 'required|numeric',
        //     'password' => 'required|string|max:255',
        // ])->fails()) {
        //     return back()->with('status', [
        //         'status' => 'danger',
        //         'message' => 'Data tidak valid. Silakan periksa kembali input Anda.'
        //     ]);
        // }

        $validator = \Validator::make($request->all(), [
            'username' => 'required|numeric',
            'password' => 'required|string|max:255',
            'captcha' => 'required|captcha',
        ]);

        if ($validator->fails()) {
            // return redirect()->back()->withErrors($validator)->withInput();
            $errors = $validator->errors()->messages(); // Mendapatkan semua error dalam bentuk array
            $errorCodes = $validator->failed(); // Mendapatkan kode validasi yang gagal

            // dd($errors, $errorCodes);

            if(isset($errors['captcha'])){
                return redirect()->back()->with('status', [
                        'status' => 'danger',
                        'message' => 'Captcha tidak sesuai. Silakan coba lagi.'
                    ]);
            }
            else{
                return redirect()->back()->with('status', [
                        'status' => 'danger',
                        'message' => 'NIP/NIM atau Password salah'
                    ]);
            }
        }

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
        CURLOPT_POSTFIELDS => array('LoginForm[username]' => $request->username,'LoginForm[password]' => $request->password),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        
        $data_hasil = json_decode($response, true);

        if($data_hasil['status'] == 'success'){

            date_default_timezone_set('Asia/Jakarta');
            $ts = date('Y-m-d H:i:s'); // Menampilkan waktu Jakarta

            $cek = DB::table('users')
                        ->join('users_role', 'users.idusers', '=', 'users_role.idusers')
                        ->where('nipniknim', $data_hasil['data']['username'])
                        ->select('users.*', 'users_role.idrole as idrole')
                        ->get();
            
            if(count($cek) == 0 && $data_hasil['data']['join_table'] != 3){
                return back()->with('status', [
                    'status' => 'danger',
                    'message' => 'Anda tidak memiliki akses ke aplikasi ini.'
                ]);
            }

            if(count($cek) == 0){
                $arr_insert = [
                    'idusers' => $data_hasil['data']['id'],
                    'nipniknim' => $data_hasil['data']['username'],
                    'nama_user' => $data_hasil['data']['name'],
                    'join_table' => $data_hasil['data']['join_table'],
                    'created_at' => $ts,
                ];

                $arr_insert_mhs = [
                    'idmahasiswa' => $data_hasil['data']['mahasiswa']['ID_MHS'],
                    'idusers' => $data_hasil['data']['id'],
                    'idprogram_studi' => $data_hasil['data']['mahasiswa']['ID_PROGRAM_STUDI'],
                    'idfakultas' => $data_hasil['data']['fakultas'],
                    'created_at' => $ts,
                ];

                $arr_role = [
                    'idusers' => $data_hasil['data']['id'],
                    'idrole' => $data_hasil['data']['join_table'],
                    'status' => 'true',
                    'created_at' => $ts,
                ];

                
                    try {
                        DB::beginTransaction();
                        
                        DB::table('users')->insert($arr_insert);
                        DB::table('mahasiswa')->insert($arr_insert_mhs);
                        DB::table('users_role')->insert($arr_role);
                        
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollBack();
                        return back()->with('status', [
                            'status' => 'danger',
                            'message' => 'Terjadi kesalahan saat membuat akun. Silakan coba lagi.'
                        ]);
                    }

                $datauser = array(
                    'idusers' => $data_hasil['data']['id'],
                    'nipniknim' => $data_hasil['data']['username'],
                    'nama_user' => $data_hasil['data']['name'],
                    'join_table' => $data_hasil['data']['join_table'],
                    'idprogram_studi' => $data_hasil['data']['mahasiswa']['ID_PROGRAM_STUDI'],
                    'idfakultas' => $data_hasil['data']['fakultas'],
                    'idrole' => $data_hasil['data']['join_table']
                );

            }
            else{

                // dd($cek);
                if($cek[0]->join_table == 3){
                    $info_tambah = DB::table('mahasiswa')
                                    ->where('idusers', $cek[0]->idusers)
                                    ->first();

                    $idprogram_studi = $info_tambah->idprogram_studi;
                    $idfakultas = $info_tambah->idfakultas;
                }
                else{
                    $idprogram_studi = null;
                    $idfakultas = null;
                }

                $datauser = array(
                        'idusers' => $cek[0]->idusers,
                        'nipniknim' => $cek[0]->nipniknim,
                        'nama_user' => $cek[0]->nama_user,
                        'join_table' => $cek[0]->join_table,
                        'idprogram_studi' => $idprogram_studi,
                        'idfakultas' => $idfakultas,
                        'idrole' => $cek[0]->idrole
                    );
            }

            Session::put('userdata', $datauser);

            // $genericUser = new \Illuminate\Auth\GenericUser([
            //     'id' => $datauser['idusers'],
            //     'nimnip' => $datauser['nimnip']
            // ]);

            // Auth::login($genericUser);

            // dd(session('userdata'));

            if($datauser['idrole'] == 3){
                return redirect()->route('mahasiswa.index');
            }
            else{
                return redirect()->route('admin.index');
            }
            
        }
        else{
            return back()->with('status', [
                'status' => 'danger',
                'message' => 'NIP/NIM atau Password salah'
            ]);
        }
    }

    public function logout() {
        // Custom logout logic can be added here if needed
        Session::flush(); // Hapus semua data session
        return redirect()->route('login')->with('status', [
            'status' => 'success',
            'message' => 'Anda berhasil logout.'
        ]);
    }
}
