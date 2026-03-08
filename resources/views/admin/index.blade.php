@extends('layout.admin')


@section('title', 'List Pendaftaran')

@section('breadcrumb')
    <span class="breadcrumb">Pendaftaran</span>
    <span class="breadcrumb-separator">/</span>
    <span class="breadcrumb-current">Program AYE yang diikuti</span>
@endsection

@section('styles_page')
    <link rel="stylesheet" href="{{ asset('aset/table.css') }}">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <style>
        .dt-buttons {
            margin-bottom: 15px;
        }
        .dt-button {
            background: linear-gradient(135deg, #8b5cf6, #6366f1) !important;
            color: white !important;
            border: none !important;
            padding: 8px 16px !important;
            border-radius: 6px !important;
            font-weight: 600 !important;
            cursor: pointer !important;
            transition: all 0.2s ease !important;
            box-shadow: 0 2px 8px rgba(139, 92, 246, 0.3) !important;
        }
        .dt-button:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.4) !important;
        }
        .dt-button.buttons-excel {
            background: linear-gradient(135deg, #10b981, #059669) !important;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3) !important;
        }
        .dt-button.buttons-excel:hover {
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4) !important;
        }
    </style>
@endsection

@section('content')
    <div class="page-header">
        <h1 class="page-title">List Pendaftaran</h1>
        <p class="page-subtitle">Program AYE yang diikuti</p>
    </div>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">List Program AYE yang Telah Diajukan</h2>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="table-striped" id="tablediajukan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Nama Bisnis</th>
                            <th>Bidang</th>
                            <th>Status Bisnis</th>
                            <th>Status Pengajuan</th>
                            <th>Anggota</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach($pendaftaran as $p)
                            @if($p->status_pengajuan == 3)
                            <tr @if($p->status_pengajuan == 1) style="background-color: #edc2c3; cursor:pointer"  @elseif($p->status_pengajuan == 3) style="background-color: #c2edda;; cursor:pointer" @endif onclick="viewPendaftaranDetail({{ $p->idusulan_bisnis }})">
                                <td>{{ $no++ }}</td>
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
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">List Program AYE yang masih Draft</h2>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="table-striped" id="tabledraft">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Nama Bisnis</th>
                            <th>Bidang</th>
                            <th>Status Bisnis</th>
                            <th>Status Pengajuan</th>
                            <th>Anggota</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach($pendaftaran as $p)
                            @if($p->status_pengajuan == 1)
                            <tr @if($p->status_pengajuan == 1) style="background-color: #edc2c3; cursor:pointer"  @elseif($p->status_pengajuan == 3) style="background-color: #c2edda;; cursor:pointer" @endif onclick="viewPendaftaranDetail({{ $p->idusulan_bisnis }})">
                                <td>{{ $no++ }}</td>
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
                            @endif
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
    <!-- DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.0/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.0/vfs_fonts.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTables untuk tabel diajukan
            $('#tablediajukan').DataTable({
                paging: true,
                pageLength: 10,
                lengthChange: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
                },
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '📊 Export Excel',
                        filename: 'Program_AYE_Diajukan_' + new Date().toISOString().split('T')[0],
                        title: 'List Program AYE yang Telah Diajukan'
                    },
                    {
                        extend: 'print',
                        text: '🖨️ Print'
                    }
                ]
            });

            // Initialize DataTables untuk tabel draft
            $('#tabledraft').DataTable({
                paging: true,
                pageLength: 10,
                lengthChange: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
                },
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '📊 Export Excel',
                        filename: 'Program_AYE_Draft_' + new Date().toISOString().split('T')[0],
                        title: 'List Program AYE yang masih Draft'
                    },
                    {
                        extend: 'print',
                        text: '🖨️ Print'
                    }
                ]
            });
        });

        function viewPendaftaranDetail(idusulan_bisnis){
            $('#form_idusulan_bisnis').val(idusulan_bisnis);
            $('#pendaftaran_form').submit();
        }
    </script>
@endsection