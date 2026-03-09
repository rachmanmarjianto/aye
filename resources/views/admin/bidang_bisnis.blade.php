@extends('layout.admin')


@section('title', 'Master - Bidang Bisnis')

@section('breadcrumb')
    <span class="breadcrumb">Master</span>
    <span class="breadcrumb-separator">/</span>
    <span class="breadcrumb-current">Bidang Bisnis</span>
@endsection

@section('styles_page')
    <link rel="stylesheet" href="{{ asset('aset/table.css') }}">
   <link rel="stylesheet" href="{{ asset('aset/layout.css') }}">
    
@endsection

@section('content')
    <div class="page-header">
        <h1 class="page-title">Master</h1>
        <p class="page-subtitle">Bidang Bisnis</p>
    </div>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">List Bidang Bisnis</h2>
            
             <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('admin.master.bidang_bisnis.tambah') }}'">Tambah Bidang Bisnis</button>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="table-striped" id="tablediajukan">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Bidang Bisnis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bidangbisnis as $p)
                            <tr>
                                <td>{{ $p->idbidang_bisnis }}</td>
                                <td>{{ $p->nama_bidang }}</td>
                                <td id="btn_anggota_{{ $p->idbidang_bisnis }}">
                                    <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('admin.master.bidang_bisnis.hapus', ['id' => Crypt::encrypt($p->idbidang_bisnis)]) }}'">Hapus</button>
                                    <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('admin.master.bidang_bisnis.edit', ['id' => Crypt::encrypt($p->idbidang_bisnis)]) }}'">Edit</button>
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
        
    </script>
@endsection