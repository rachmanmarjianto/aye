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
                            <tr @if($p->status_pengajuan == 1) style="background-color: #edc2c3; cursor:pointer"  @elseif($p->status_pengajuan == 3) style="background-color: #c2edda;; cursor:pointer" @endif onclick="viewPendaftaranDetail({{ $p->idusulan_bisnis }})">
                                <td>{{ $p->tahun }}</td>
                                <td>{{ $p->nama_bisnis }}</td>
                                <td>{{ $p->nama_bidang }}</td>
                                <td>{{ $p->status_bisnis == 1 ? 'Ide Bisnis' : 'Sudah Berjalan' }}</td>
                                <td>
                                    @if($p->status_pengajuan == 1)
                                        Draft
                                    @elseif($p->status_pengajuan == 2)
                                        Menunggu Validasi Ketua
                                    @elseif($p->status_pengajuan == 3)
                                        Diajukan
                                    @else
                                        Unknown
                                    @endif
                                </td>
                                <td>
                                    <ul>
                                        @foreach($anggota[$p->idusulan_bisnis] as $a)
                                            <li>{{ $a['nama'] }} ({{ $a['nim'] }}) @if($a['tipe_anggota'] == 1) - Ketua @endif</li>
                                        @endforeach
                                    </ul>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <form id="pendaftaran_form" method="POST" action="{{ route('admin.view_form') }}">
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