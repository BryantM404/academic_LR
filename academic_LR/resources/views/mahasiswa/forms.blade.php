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
                      <a class="mdi mdi-keyboard-backspace icon-md" href="{{ route('mahasiswaForm') }}"></a>
                    </div>
                    <div class="col">
                      @if($jenisSurat == 1)
                        <h3 class="font-weight-bold">Form Surat Keterangan Mahasiswa Aktif</h3>
                      @elseif($jenisSurat == 2)
                        <h3 class="font-weight-bold">Form Surat Pengantar Tugas Mata Kuliah</h3>
                      @elseif($jenisSurat == 3)
                        <h3 class="font-weight-bold">Form Surat Keterangan Lulus</h3>
                      @elseif($jenisSurat == 4)
                        <h3 class="font-weight-bold">Form Surat Laporan Hasil Studi</h3>
                      @endif
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
                  <form class="forms-sample" method="POST" action="{{ route('formsStore') }}">
                    @csrf
                    <div class="form-group">
                        <label for="nrp">NRP</label>
                        <input type="text" class="form-control" id="nrp" name="nrp" placeholder="NRP" readonly value="{{ Auth::user()->userMahasiswa->nrp }}">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" readonly value="{{ Auth::user()->userMahasiswa->nama }}">
                    </div>

                    @if($jenisSurat == 1)
                      <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" readonly value="{{ Auth::user()->userMahasiswa->alamat }}">
                      </div>
                      <div class="form-group">
                          <label for="semester">Semester</label>
                          <input type="text" class="form-control" id="semester" name="semester" placeholder="Semester" required>
                      </div>
                    @else
                      <input type="hidden" name="alamat" value="">
                      <input type="hidden" name="semester" value="">
                    @endif

                    @if($jenisSurat == 2)
                      <div class="form-group">
                        <label for="kodeMK">Kode Mata Kuliah</label>
                        <input type="text" class="form-control" id="kodeMK" name="kodeMK" placeholder="Kode Mata Kuliah">
                      </div>
                      <div class="form-group">
                        <label for="namaMK">Nama Mata Kuliah</label>
                        <input type="text" class="form-control" id="namaMK" name="namaMK" placeholder="Nama Mata Kuliah">
                      </div>
                    @else
                      <input type="hidden" name="kodeMK" value="">
                      <input type="hidden" name="namaMK" value="">
                    @endif


                    @if($jenisSurat == 1 || $jenisSurat == 2 || $jenisSurat == 4)
                    <div class="form-group">
                        <label for="tujuan">Keperluan Pengajuan</label>
                        <textarea class="form-control" id="tujuan" name="tujuan" rows="4" placeholder="Keperluan Pengajuan" required></textarea>
                      </div>
                    @elseif($jenisSurat == 3)
                      <input type="hidden" name="tujuan" value="">
                    @endif
                    
                    @if($jenisSurat == 1)
                      <input type="hidden" name="jenisSurat_id" value="1">
                    @elseif($jenisSurat == 2)
                      <input type="hidden" name="jenisSurat_id" value="2">
                    @elseif($jenisSurat == 3)
                      <input type="hidden" name="jenisSurat_id" value="3">
                    @elseif($jenisSurat == 4)
                      <input type="hidden" name="jenisSurat_id" value="4">
                    @endif

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                  </form>                
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