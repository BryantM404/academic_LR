@extends('layouts.index')

@section('content')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <div class="row d-flex flex-row align-items-center">
                    <div class="col-1" style="margin-right: -2rem">
                      <a class="mdi mdi-keyboard-backspace icon-md" href="{{ route('pengajuanList') }}"></a>
                    </div>
                    <div class="col">
                      <h3 class="font-weight-bold">Detail Pengajuan</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nrp">NRP</label>
                        <input type="text" class="form-control" id="nrp" name="nrp" placeholder="NRP" readonly value="{{ $mahasiswa->nrp }}">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" readonly value="{{ $mahasiswa->nama }}">
                    </div>

                    @if($pengajuan->jenisSurat_id == 1)
                        <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" readonly value="{{ $mahasiswa->alamat }}">
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <input type="text" class="form-control" id="semester" name="semester" placeholder="Semester" readonly value="{{ $pengajuanDetail->semester }}">
                        </div>
                    @else
                        <input type="hidden" name="alamat" value="">
                        <input type="hidden" name="semester" value="">
                    @endif

                    @if($pengajuan->jenisSurat_id == 2)
                        <div class="form-group">
                        <label for="kodeMK">Kode Mata Kuliah</label>
                        <input type="text" class="form-control" id="kodeMK" name="kodeMK" placeholder="Kode Mata Kuliah" readonly value="{{ $pengajuanDetail->kodeMK }}">
                        </div>
                        <div class="form-group">
                        <label for="namaMK">Nama Mata Kuliah</label>
                        <input type="text" class="form-control" id="namaMK" name="namaMK" placeholder="Nama Mata Kuliah" readonly value="{{ $pengajuanDetail->namaMK }}">
                        </div>
                    @else
                        <input type="hidden" name="kodeMK" value="">
                        <input type="hidden" name="namaMK" value="">
                    @endif


                    @if($pengajuan->jenisSurat_id == 1 || $pengajuan->jenisSurat_id == 2 || $pengajuan->jenisSurat_id == 4)
                    <div class="form-group">
                        <label for="tujuan">Keperluan Pengajuan</label>
                        <textarea class="form-control" id="tujuan" name="tujuan" rows="4" placeholder="Keperluan Pengajuan" readonly required >{{$pengajuanDetail->tujuan}}</textarea>
                        </div>
                    @elseif($pengajuan->jenisSurat_id == 3)
                        <input type="hidden" name="tujuan" value="">
                    @endif
                    
                    @if($pengajuan->jenisSurat_id == 1)
                        <input type="hidden" name="jenisSurat_id" value="1">
                    @elseif($pengajuan->jenisSurat_id == 2)
                        <input type="hidden" name="jenisSurat_id" value="2">
                    @elseif($pengajuan->jenisSurat_id == 3)
                        <input type="hidden" name="jenisSurat_id" value="3">
                    @elseif($pengajuan->jenisSurat_id == 4)
                        <input type="hidden" name="jenisSurat_id" value="4">
                    @endif           
                </div>
              </div>
            </div>
          </div>
      </div>

@endsection

@section('ExtraCSS')

@endsection

@section('ExtraJS')

@endsection