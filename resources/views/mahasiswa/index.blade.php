@extends('layout.admin')


@section('title', 'List Pendaftaran')

@section('breadcrumb')
    <span class="breadcrumb">Pendaftaran</span>
    <span class="breadcrumb-separator">/</span>
    <span class="breadcrumb-current">Program AYE yang diikuti</span>
@endsection

@section('styles_page')
    <link rel="stylesheet" href="{{ asset('aset/table.css') }}">
@endsection

@section('content')
    <div class="page-header">
        <h1 class="page-title">List Pendaftaran</h1>
        <p class="page-subtitle">Program AYE yang diikuti</p>
    </div>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">List Program AYE yang diikuti</h2>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="table-striped">
                    <thead>
                        <tr>
                            <th>Tahun</th>
                            <th>Nama Bisnis</th>
                            <th>Bidang</th>
                            <th>Status Bisnis</th>
                            <th>Status Pengajuan</th>
                            <th>Anggota</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendaftaran as $p)
                            <tr style="cursor:pointer" onclick="viewPendaftaranDetail({{ $p->idusulan_bisnis }})">
                                <td>{{ $p->tahun }}</td>
                                <td>{{ $p->nama_bisnis }}</td>
                                <td>{{ $p->nama_bidang }}</td>
                                <td>{{ $p->status_bisnis == 1 ? 'Ide Bisnis' : 'Sudah Berjalan' }}</td>
                                <td>
                                    @if($p->status_pengajuan == 1)
                                        <span style="color:black">Draft</span>
                                    @elseif($p->status_pengajuan == 2)
                                        <span style="color:rgb(30, 0, 255);">Menunggu Validasi Ketua</span>
                                    @elseif($p->status_pengajuan == 3)
                                        <span style="color:rgb(0, 170, 255);">Diajukan</span>
                                    @elseif($p->status_pengajuan == 4)
                                        <span style="color:green;">Lolos</span>
                                    @elseif($p->status_pengajuan == 5)
                                        <span style="color:red;">Tidak Lolos</span>
                                    @elseif($p->status_pengajuan == 6)
                                        <span style="color:rgb(255, 0, 212);">Dibatalkan</span>
                                    @else
                                        Unknown
                                    @endif
                                </td>
                                <td>
                                    <ul>
                                        @if(array_key_exists($p->idusulan_bisnis, $anggota))
                                            @foreach($anggota[$p->idusulan_bisnis] as $a)
                                                <li>{{ $a['nama'] }} ({{ $a['nim'] }}) @if($a['tipe_anggota'] == 1) - Ketua @endif</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <form id="pendaftaran_form" method="POST" action="{{ route('mahasiswa.view_form') }}">
        @csrf
        <input type="hidden" name="idusulan_bisnis" id="form_idusulan_bisnis">
    </form>
@endsection

@section('scripts')
    <script>
        function viewPendaftaranDetail(idusulan_bisnis){
            $('#form_idusulan_bisnis').val(idusulan_bisnis);
            $('#pendaftaran_form').submit();
        }
    </script>
@endsection