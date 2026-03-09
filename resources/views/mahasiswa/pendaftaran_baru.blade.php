@extends('layout.admin')

@section('title', 'Pendaftaran AYE Baru')

@section('breadcrumb')
    <span class="breadcrumb">Pendaftaran</span>
    <span class="breadcrumb-separator">/</span>
    <span class="breadcrumb-current">Pendaftaran AYE Baru</span>
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
                <label for="nama_bisnis">Nama Bisnis <span class="required">*</span></label>
                <div class="input-wrapper">
                    <input type="text" id="nama_bisnis" name="nama_bisnis" form="pendaftaran_form" value="{{ $pendaftaran[0]->nama_bisnis ?? '' }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="select_single">Bidang Bisnis <span class="required">*</span></label>
                <select id="select_single" name="bidang_bisnis" form="pendaftaran_form" required>
                    @foreach($bidangbisnis as $bidang)
                        <option value="{{ $bidang->idbidang_bisnis }}" @if(isset($pendaftaran[0]) && $pendaftaran[0]->idbidang_bisnis == $bidang->idbidang_bisnis) selected @endif>{{ $bidang->nama_bidang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="select_single">Status Bisnis Saat Ini <span class="required">*</span></label>
                <select id="select_single" name="status_bisnis" form="pendaftaran_form" required>
                    <option value="1" @if(isset($pendaftaran[0]) && $pendaftaran[0]->status_bisnis == 1) selected @endif>Ide Bisnis</option>
                    <option value="2" @if(isset($pendaftaran[0]) && $pendaftaran[0]->status_bisnis == 2) selected @endif>Sudah Berjalan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="link_sosial_media">Link Sosial Media/E-Commerce <span class="required">*</span></label>
                <div class="input-wrapper">
                    <input type="text" id="link_sosial_media" name="link_sosmed" form="pendaftaran_form" value="{{ $pendaftaran[0]->link_sosmed ?? '' }}" required>
                </div>
            </div>

            @if(count($pendaftaran) > 0)
                
            @else
                <div class="form-group" style="text-align:right" id="btn_simpan">
                    <button type="submit" class="btn btn-primary" onclick="submit_pendaftaran_form(0)">Simpan</button>
                </div>
            @endif
            
        </div>
    </div>

    <div class="card" id="anggota_card" @if(session('success') || count($anggota) > 0) @else style="display:none" @endif>
        <div class="card-header">
            <h2 class="card-title">Anggota</h2>
        </div>
        <div class="card-body">
            <div class="form-row">                
                <div class="form-group">
                    <label for="nim_anggota">NIM Anggota <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <input type="text" id="nim_anggota" name="nim_anggota" required>
                    </div>
                </div>
            
                <div class="btn-group" style="margin-top: 10px; margin-bottom: 10px;" id="btn_cari_anggota">
                    <button type="submit" class="btn btn-primary" onclick="cariMahasiswa()">Cari Mahasiswa</button>
                </div>       
                <div class="btn-group" style="margin-top: 10px; margin-bottom: 10px; display:none" id="btn_cari_anggota_loader" >
                    <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...
                    </button>
                </div>                  
            </div>       
            <div class="form-row">  
                <div class="form-group">
                    <label for="nama_anggota">Nama Anggota <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <input type="text" id="nama_anggota" name="nama_anggota" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fakultas">Fakultas <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <input type="text" id="fakultas" name="fakultas" readonly>
                    </div>
                </div>
            </div>
            <div class="form-row">  
                <div class="form-group">
                    <label for="program_studi">Program Studi <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <input type="text" id="program_studi" name="program_studi" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="select_peran_anggota">Peran <span class="required">*</span></label>
                    <select id="select_peran_anggota" name="peran" required>
                        <option value="2">Anggota</option>
                        <option value="1">Ketua</option>
                    </select>
                </div>
                <input type="hidden" id="nim_anggota_hidden" name="nim_anggota_mhs">
                <input type="hidden" id="idmhs" name="idmahasiswa">
                <input type="hidden" id="idusulan_bisnis" name="idusulan_bisnis" value="{{ $pendaftaran[0]->idusulan_bisnis ?? '' }}">
                <input type="hidden" id="idusers_anggota_hidden" name="idusers">
                <input type="hidden" id="idjointable" name="join_table">
                <input type="hidden" id="idprogram_studi" name="idprogram_studi">
                <input type="hidden" id="idfakultas" name="idfakultas">
            </div>

            
            <div class="btn-group-right"  id="btn_tambahkan_anggota" @if(count($anggota) >= 3) style="margin-top:0px; display:none" @else style="margin-top:0px" @endif>
                <button type="submit" class="btn btn-primary" onclick="tambahkananggota()">Tambahkan Anggota</button>
            </div>
            <div class="btn-group-right" style="margin-top:0px; display:none" id="btn_tambahkan_anggota_loader">
                <button class="btn btn-primary" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...
                </button>
            </div>
            
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
                            <th>Aksi</th>
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
                                <td id="btn_anggota_{{ $a->idanggota }}">
                                    <button type="button" class="btn btn-danger" onclick="hapus({{ $a->idanggota }})">Hapus</button>
                                    <button type="button" class="btn btn-success" onclick="setKetua({{ $a->idanggota }})">Set Ketua</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>

    <div class="card" id="file_upload_card" @if(session('success') || count($anggota) > 0) @else style="display:none" @endif>
        <div class="card-header">
            <h2 class="card-title">📁 File Upload <small style="color:red">*max 5MB</small></h2>
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
                    <td colspan="2"><label>Template Proposal : <a href="https://bit.ly/TemplateProposalAYE2026" target="_blank">Download</a></label></td>
                    
                </tr>
                
                <tr>
                    <td><label>Proposal</label></td>
                    @if(count($file_proposal) == 0)
                    <td>
                        <input type="file" name="document_proposal" id="iddoc_proposal" form="pendaftaran_form" accept=".pdf">
                    </td>
                    @else
                    <td>
                        <a href="{{ route('file.get', ['id' => Crypt::encrypt($file_proposal[0]->idfile)]) }}" target="_blank">Lihat Proposal</a>
                        <a href="{{ route('file.hapus', ['id' => Crypt::encrypt($file_proposal[0]->idfile)]) }}" style="color:red; margin-left:10px" onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin menghapus file ini?')) { window.location.href = this.href; }">Hapus</a>
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
                        <a href="{{ route('file.hapus', ['id' => Crypt::encrypt($file_bmc[0]->idfile)]) }}" style="color:red; margin-left:10px" onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin menghapus file ini?')) { window.location.href = this.href; }">Hapus</a>
                    </td>
                    @endif
                </tr>
            </table>
        </div>
    </div>

    <div class="card"  @if(session('success') || count($anggota) > 0) @else style="display:none" @endif>
        <div class="card-body" id="buttons_card">
            <div class="btn-group-right" style="margin-top:0px; display:flex; gap:10px; justify-content: space-between;">
                <button type="button" class="btn btn-danger" onclick="submit_pendaftaran_form(6)">Batalkan</button>
                <div style="display:flex; gap:10px;">
                    <button type="button" class="btn btn-outline" onclick="submit_pendaftaran_form(1)">Simpan Draft</button>
                    <button type="submit" class="btn btn-primary" onclick="submit_pendaftaran_form(3)">Ajukan</button>
                </div>
            </div>
        </div>
    </div>

    @if(count($pendaftaran) > 0)
        <form id="pendaftaran_form" method="POST" action="{{ route('mahasiswa.update_pendaftaran') }}" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="idusulan_bisnis" value="{{ $pendaftaran[0]->idusulan_bisnis }}">
            <input type="hidden" name="status_pengajuan" id="input_status_pengajuan">
            
        </form>

    @else
        <form id="pendaftaran_form" method="POST" action="{{ route('mahasiswa.pendaftaran_baru_nama_bisnis') }}" enctype="multipart/form-data">
            @csrf
            <!-- Form fields here -->
        </form>
    @endif


    

@endsection

@section('scripts')
    
    <script>
        // Custom JavaScript
        var fileproposal = {{ count($file_proposal) }};
        var filebmc = {{ count($file_bmc) }};

        function submit_pendaftaran_form(status) {
            
            
            form = $('#pendaftaran_form');

            if(!form[0].checkValidity()) {
                form[0].reportValidity();
                return;
            }

            if(status > 0){
                $('#input_status_pengajuan').val(status);
            }
                

            if(status == 3){
                let peranValues = [];
                $('#anggota_table tbody tr').each(function() {
                    let peran = $(this).find('td:nth-child(6)').text();
                    peranValues.push(peran);
                });
                
                if(!peranValues.includes('Ketua')) {
                    alert('Pastikan ada anggota dengan peran Ketua sebelum mengajukan pendaftaran');
                    return;
                }

                if(fileproposal == 0){
                    var jumlah_fileprop = $('#iddoc_proposal').val() ? 1 : 0;
                    console.log(jumlah_fileprop);
                    if(jumlah_fileprop == 0){
                        $('#iddoc_proposal').focus();
                        alert('Pastikan file Proposal sudah diupload sebelum mengajukan pendaftaran');
                        return;
                    }
                }

                if(filebmc == 0){
                    var jumlah_filebmc = $('#iddoc_bmc').val() ? 1 : 0;
                    console.log(jumlah_filebmc);
                    if(jumlah_filebmc == 0){
                        $('#iddoc_bmc').focus();
                        alert('Pastikan file BMC sudah diupload sebelum mengajukan pendaftaran');
                        return;
                    }
                }
            }

            if(status > 0){
                $('#buttons_card').html('Proses...');
            }

            if(status == 0){
                divbtnsimpan = $('#btn_simpan');
                divbtnsimpan.html('Proses...');
            }
            else{
                divbtnsimpan = $('#btn_update_simpan');
                divbtnsimpan.html('Proses...');
            }
            
            
            document.getElementById('pendaftaran_form').submit();
        }

        function cariMahasiswa(){

            nim = $('#nim_anggota').val();

            if(nim.length < 9){
                alert('NIM harus minimal 9 karakter');
                return;
            }
            
            $('#btn_cari_anggota').hide();
            $('#btn_cari_anggota_loader').show();

            $.ajax({
                url: "{{ route('mahasiswa.cari_mahasiswa') }}",
                method: 'POST',
                data: {
                    nim: nim,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#btn_cari_anggota').show();
                    $('#btn_cari_anggota_loader').hide();

                    $('#nim_anggota').val('');

                    console.log(response);

                    if(response.code == 404){
                        alert('Mahasiswa tidak ditemukan');
                        return;
                    }

                    $('#nim_anggota_hidden').val(nim);
                    $('#nama_anggota').val(response.data.nama);
                    $('#fakultas').val(response.data.nama_fakultas);
                    $('#program_studi').val(response.data.nama_jenjang + ' ' + response.data.nama_program_studi);
                    $('#idmhs').val(response.data.idmahasiswa);
                    $('#idusers_anggota_hidden').val(response.data.idusers);
                    $('#idjointable').val(response.data.join_table);
                    $('#idprogram_studi').val(response.data.idprogram_studi);
                    $('#idfakultas').val(response.data.idfakultas);
                    
                    
                },
                error: function() {
                    $('#btn_cari_anggota').show();
                    $('#btn_cari_anggota_loader').hide();
                    alert('Terjadi kesalahan saat mencari mahasiswa');
                }
            });
        }

        function tambahkananggota(){
            if($('#nim_anggota_hidden').val() == ''){
                alert('Cari mahasiswa terlebih dahulu');
                return;
            }

            let allNim = [];
            $('#anggota_table tbody tr').each(function() {
                let nim = $(this).find('td:nth-child(2)').text();
                allNim.push(nim);
            });

            if(allNim.includes($('#nim_anggota_hidden').val())) {
                alert('Mahasiswa sudah ada dalam tim');
                return;
            }

            

            $('#btn_tambahkan_anggota').hide();
            $('#btn_tambahkan_anggota_loader').show();

            formData = {
                nim: $('#nim_anggota_hidden').val(),
                nama: $('#nama_anggota').val(),
                join_table: $('#idjointable').val(),   
                idfakultas: $('#idfakultas').val(),
                idprogram_studi: $('#idprogram_studi').val(),
                idmahasiswa: $('#idmhs').val(),
                idusulan_bisnis: $('#idusulan_bisnis').val(),
                idusers: $('#idusers_anggota_hidden').val(),
                peran: $('#select_peran_anggota').val(),
                _token: '{{ csrf_token() }}'
            };

            $.ajax({
                url: "{{ route('mahasiswa.tambahkan_anggota') }}",
                method: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);                    

                    

                    if(response.code == 200){
                        // Tambahkan anggota ke tabel
                        $('#anggota_card').show();
                        $('#file_upload_card').show();
                        $('#buttons_card').show();

                        newRow = `<tr id="anggota_${response.data.idanggota}">
                                        <td>${response.data.nama}</td>
                                        <td>${response.data.nim}</td>
                                        <td>${response.data.nama_fakultas}</td>
                                        <td>${response.data.nama_jenjang}</td>
                                        <td>${response.data.nama_program_studi}</td>
                                        <td>${response.data.tipe_anggota == 1 ? 'Ketua' : 'Anggota'}</td>
                                        <td id="btn_anggota_${response.data.idanggota}">
                                            <button type="button" class="btn btn-danger" onclick="hapus(${response.data.idanggota})">Hapus</button>
                                            <button type="button" class="btn btn-success" onclick="setKetua(${response.data.idanggota})">Set Ketua</button>
                                        </td>
                                    </tr>`;

                        $('#anggota_table tbody').append(newRow);

                        // Reset form
                        $('#nim_anggota_hidden').val('');
                        $('#nama_anggota').val('');
                        $('#fakultas').val('');
                        $('#program_studi').val('');
                        $('#idmhs').val('');
                        $('#idusers_anggota_hidden').val('');
                        $('#idjointable').val('');
                        $('#idprogram_studi').val('');
                        $('#idfakultas').val('');
                        $('#idjointable').val('');

                        let rowCount = document.querySelectorAll('#anggota_table tbody tr').length;
                        if(rowCount >= 3){
                            $('#btn_tambahkan_anggota_loader').hide();
                        }
                        else{
                            $('#btn_tambahkan_anggota').show();
                            $('#btn_tambahkan_anggota_loader').hide();
                        }
                    }
                    else{
                        $('#btn_tambahkan_anggota').show();
                        $('#btn_tambahkan_anggota_loader').hide();
                        alert('Gagal menambahkan anggota: ' + response.message);
                    }
                },
                error: function(xhr) {
                    $('#btn_tambahkan_anggota').show();
                    $('#btn_tambahkan_anggota_loader').hide();
                    let response = xhr.responseJSON;
                    alert('Terjadi kesalahan saat menambahkan anggota: ' + (response ? response.message : ''));
                }
            });
        }

        function setKetua(idanggota){
            nimanggota = $(`#anggota_${idanggota} td:nth-child(2)`).text();
            btnanggota = $(`#btn_anggota_${idanggota}`);
            btnanggota.html('Proses...');

            $.ajax({
                url: "{{ route('mahasiswa.set_ketua') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    idanggota: idanggota,
                    idusulan_bisnis: $('#idusulan_bisnis').val()
                },
                success: function(response) {
                    console.log(response);

                    btnanggota.html(`
                        <button type="button" class="btn btn-danger" onclick="hapus(${idanggota})">Hapus</button>
                        <button type="button" class="btn btn-success" onclick="setKetua(${idanggota})">Set Ketua</button>
                    `);

                    if(response.code == 200){
                        // Update tampilan peran anggota
                        $(`#anggota_table tbody tr`).each(function() {
                            let nim = $(this).find('td:nth-child(2)').text();
                            if(nim === nimanggota){
                                $(this).find('td:nth-child(5)').text('Ketua');
                            }
                            else{
                                $(this).find('td:nth-child(5)').text('Anggota');
                            }
                        });
                    }
                    else{
                        alert('Gagal set ketua: ' + response.message);
                    }
                },
                error: function(xhr) {
                    btnanggota.html(`
                        <button type="button" class="btn btn-danger" onclick="hapus(${idanggota})">Hapus</button>
                        <button type="button" class="btn btn-success" onclick="setKetua(${idanggota})">Set Ketua</button>
                    `);

                    let response = xhr.responseJSON;
                    alert('Terjadi kesalahan saat set ketua: ' + (response ? response.message : ''));
                }
            });

        }

        function hapus(idanggota){

            btnanggota = $(`#btn_anggota_${idanggota}`);
            btnanggota.html('Proses...');

            idrow = $(`#anggota_${idanggota}`);
            console.log(idanggota);

            $.ajax({
                url: "{{ route('mahasiswa.hapus_anggota') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    idanggota: idanggota
                },
                success: function(response) {
                    console.log(response);

                    if(response.code == 200){
                        $(`#anggota_${idanggota}`).remove();

                        let rowCount = document.querySelectorAll('#anggota_table tbody tr').length;
                        if(rowCount < 3){
                            $('#btn_tambahkan_anggota').show();
                            $('#btn_tambahkan_anggota_loader').hide();
                        }

                        idrow.remove();


                    }
                    else{
                        alert('Gagal menghapus anggota: ' + response.message);
                    }
                },
                error: function(xhr) {
                    btnanggota.html(`
                        <button type="button" class="btn btn-danger" onclick="hapus(${idanggota})">Hapus</button>
                        <button type="button" class="btn btn-success" onclick="setKetua(${idanggota})">Set Ketua</button>
                    `);

                    let response = xhr.responseJSON;
                    alert('Terjadi kesalahan saat menghapus anggota: ' + (response ? response.message : ''));
                }
            });
        }


        //#### modal ###################
        // Modal Functions
        // function openExtraLargeModal() {
        //     document.getElementById('extraLargeModal').classList.add('active');
        //     document.body.style.overflow = 'hidden';
        // }

        // function closeExtraLargeModal() {
        //     document.getElementById('extraLargeModal').classList.remove('active');
        //     document.body.style.overflow = 'auto';
        // }

        // // Close modal when clicking on overlay
        // document.getElementById('extraLargeModal').addEventListener('click', function(e) {
        //     if (e.target === this) {
        //         closeExtraLargeModal();
        //     }
        // });

        // // Close modal with Escape key
        // document.addEventListener('keydown', function(e) {
        //     if (e.key === 'Escape' && document.getElementById('extraLargeModal').classList.contains('active')) {
        //         closeExtraLargeModal();
        //     }
        // });

        //##############################
    </script>
@endsection