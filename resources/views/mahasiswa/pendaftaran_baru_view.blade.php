@extends('layout.admin')

@section('title', 'Pendaftaran AYE Baru')

@section('breadcrumb')
    <span class="breadcrumb">Pendaftaran</span>
    <span class="breadcrumb-separator">/</span>
    <span class="breadcrumb-current">Pendaftaran AYE</span>
@endsection

@section('styles_page')
    <link rel="stylesheet" href="{{ asset('aset/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('aset/table.css') }}">
@endsection

@section('content')
    
    <div class="page-header">
        <h1 class="page-title">Pendaftaran AYE Baru</h1>
        <p class="page-subtitle">Tahun {{ $tahun }}</p>
    </div>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Pendaftaran AYE Baru</h2>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="nama_bisnis">Nama Bisnis</label>
                <div class="input-wrapper">
                    <input type="text" form="pendaftaran_form" value="{{ $pendaftaran[0]->nama_bisnis ?? '' }}" readonly>
                </div>
            </div>

            <div class="form-group">
                <label for="select_single">Bidang Bisnis </label>
                <select id="select_single" style="color:black" disabled>
                    @foreach($bidangbisnis as $bidang)
                        <option value="{{ $bidang->idbidang_bisnis }}" @if(isset($pendaftaran[0]) && $pendaftaran[0]->idbidang_bisnis == $bidang->idbidang_bisnis) selected @endif>{{ $bidang->nama_bidang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="select_single">Status Bisnis Saat Ini </label>
                <select id="select_single" style="color:black" disabled>
                    <option value="1" @if(isset($pendaftaran[0]) && $pendaftaran[0]->status_bisnis == 1) selected @endif>Ide Bisnis</option>
                    <option value="2" @if(isset($pendaftaran[0]) && $pendaftaran[0]->status_bisnis == 2) selected @endif>Sudah Berjalan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="link_sosial_media">Link Sosial Media/E-Commerce </label>
                <div class="input-wrapper">
                    <input type="text"  value="{{ $pendaftaran[0]->link_sosmed ?? '' }}" readonly>
                </div>
            </div>

            

            <div class="form-group">
                <label for="link_sosial_media">Status Usulan </label>
                <div class="input-wrapper">
                    @if($pendaftaran[0]->status_pengajuan == 1)
                        <input type="text"  value="Draft" readonly>
                    @elseif($pendaftaran[0]->status_pengajuan == 2)
                        {{-- <span style="color:rgb(30, 0, 255);">Menunggu Validasi Ketua</span> --}}
                        <input style="color:rgb(30, 0, 255);" type="text"  value="Menunggu Validasi Ketua" readonly>
                    @elseif($pendaftaran[0]->status_pengajuan == 3)
                        <input style="color:rgb(0, 170, 255);" type="text"  value="Diajukan" readonly>
                    @elseif($pendaftaran[0]->status_pengajuan == 4)
                        <input style="color:green;" type="text"  value="Lolos" readonly>
                    @elseif($pendaftaran[0]->status_pengajuan == 5)
                        <input style="color:red;" type="text"  value="Tidak Lolos" readonly>
                    @elseif($pendaftaran[0]->status_pengajuan == 6)
                        <input style="color:rgb(255, 0, 212);" type="text"  value="Dibatalkan" readonly>
                    @else
                        Unknown
                    @endif
                    
                </div>
            </div>

            
            
        </div>
    </div>

    <div class="card" id="anggota_card" @if(session('success') || count($anggota) > 0) @else style="display:none" @endif>
        <div class="card-header">
            <h2 class="card-title">Anggota</h2>
        </div>
        <div class="card-body">
                        
            <div class="table-container" style="margin-top: 20px">
                <table class="table-striped" id="anggota_table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Fakultas</th>
                            <th>Jenjang</th>
                            <th>Program Studi</th>
                            <th>Peran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($anggota as $a)
                            <tr id="anggota_{{ $a->idanggota }}">
                                <td>{{ $a->nama }}</td>
                                <td>{{ $a->nim }}</td>
                                <td>{{ $a->nama_fakultas }}</td>
                                <td>{{ $a->nama_jenjang }}</td>
                                <td>{{ $a->nama_program_studi }}</td>
                                <td>{{ $a->tipe_anggota == 1 ? 'Ketua' : 'Anggota' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>

    <div class="card" id="file_upload_card" @if(session('success') || count($anggota) > 0) @else style="display:none" @endif>
        <div class="card-header">
            <h2 class="card-title">📁 File Upload </h2>
        </div>
        <div class="card-body">
            {{-- <div class="form-row">
                <div class="form-group">
                    <label>BMC (Business Model Canvas)</label>
                    <div class="file-upload">
                        <input type="file" name="document_bmc" accept=".pdf">
                        <div class="file-upload-icon">📄</div>
                        <div class="file-upload-text">Drag & drop atau klik untuk upload</div>
                        <div class="file-upload-hint">PDF (Max 5MB)</div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Proposal</label>
                    <div class="file-upload">
                        <input type="file" name="document_proposal" accept=".pdf">
                        <div class="file-upload-icon">📄</div>
                        <div class="file-upload-text">Drag & drop atau klik untuk upload</div>
                        <div class="file-upload-hint">PDF (Max 5MB)</div>
                    </div>
                </div>
            </div> --}}

            <table> 
                
                <tr>
                    <td><label>Proposal</label></td>
                    @if(count($file_proposal) == 0)
                    <td>
                        <input type="file" name="document_proposal" id="iddoc_proposal" form="pendaftaran_form" accept=".pdf">
                    </td>
                    @else
                    <td>
                        <a href="{{ route('file.get', ['id' => Crypt::encrypt($file_proposal[0]->idfile)]) }}" target="_blank">Lihat Proposal</a>
                        
                    </td>
                    @endif
                </tr>
                <tr>
                    <td><label>BMC</label></td>
                    @if(count($file_bmc) == 0)
                    <td>
                        <input type="file" name="document_bmc" id="iddoc_bmc" form="pendaftaran_form" accept=".pdf">
                    </td>
                    @else
                    <td>
                        <a href="{{ route('file.get', ['id' => Crypt::encrypt($file_bmc[0]->idfile)]) }}" target="_blank">Lihat BMC</a>
                        
                    </td>
                    @endif
                </tr>
            </table>
        </div>
    </div>

    @if(in_array($pendaftaran[0]->status_pengajuan, [3,6]))
    <div class="card"  @if(session('success') || count($anggota) > 0) @else style="display:none" @endif>
        <div class="card-body" id="buttons_card">
            <div class="btn-group-right" >
                    <button type="button" class="btn btn-primary" onclick="submit_pendaftaran_form(1)">Ubah jadi Draft</button>
            </div>
        </div>
    </div>

    <form id="pendaftaran_form" method="POST" action="{{ route('mahasiswa.update_status_pendaftaran') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="idusulan_bisnis" value="{{ $pendaftaran[0]->idusulan_bisnis }}">
        <input type="hidden" name="status_pengajuan" id="input_status_pengajuan">
        
    </form>


    @endif

    


    

@endsection

@section('scripts')
    <script>
        @if(in_array($pendaftaran[0]->status_pengajuan, [3,6]))
        function submit_pendaftaran_form(status) {

            document.getElementById('input_status_pengajuan').value = status;

            if(status > 0){
                $('#buttons_card').html('Proses...');
            }            
            
            document.getElementById('pendaftaran_form').submit();
        }

        @endif

    </script>
    
@endsection