@extends('layout.admin')


@section('title', 'Master - Bidang Bisnis')

@section('breadcrumb')
    <span class="breadcrumb">Master</span>
    <span class="breadcrumb-separator">/</span>
    <span class="breadcrumb">Bidang Bisnis</span>
    <span class="breadcrumb-separator">/</span>
    <span class="breadcrumb-current">Tambah</span>
@endsection

@section('styles_page')
   <link rel="stylesheet" href="{{ asset('aset/layout.css') }}">
    
@endsection

@section('content')
    <div class="page-header">
        <h1 class="page-title">Master</h1>
        <p class="page-subtitle">Bidang Bisnis</p>
    </div>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Tambah Bidang Bisnis</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.master.bidang_bisnis.tambah.submit') }}">
                @csrf
                <div class="form-group">
                    <label for="nama_bidang">Nama Bidang Bisnis</label>
                    <input type="text" class="form-control" id="nama_bidang" name="nama_bidang" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    

    <script>
        
    </script>
@endsection