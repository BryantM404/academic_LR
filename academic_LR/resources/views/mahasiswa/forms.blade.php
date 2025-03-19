@extends('layouts.index')

@section('content')
<div class="main-panel">
  @if($jenisSurat == 1)
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Form Surat Keterangan Mahasiswa Aktif</h3>
                  {{-- <h6 class="font-weight-normal mb-0"><span class="text-primary">Silahkan pilih jenis surat yang ingin diajukan!</span></h6> --}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  {{-- <h4 class="card-title">Basic form elements</h4>
                  <p class="card-description">
                    Basic form elements
                  </p> --}}
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="nrp">NRP</label>
                      <input type="text" class="form-control" id="nrp" placeholder="NRP">
                    </div>
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" class="form-control" id="nama" placeholder="Nama">
                    </div>
                    <div class="form-group">
                      <label for="alamat">Alamat</label>
                      <input type="text" class="form-control" id="alamat" placeholder="Alamat">
                    </div>
                    <div class="form-group">
                      <label for="semester">Semester</label>
                      <input type="text" class="form-control" id="semester" placeholder="Semester">
                    </div>
                    <div class="form-group">
                      <label for="tujuan">Keperluan Pengajuan</label>
                      <textarea class="form-control" id="tujuan" rows="4" placeholder="Keperluan Pengajuan"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
  @endif
  
  @if($jenisSurat == 2)
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Form Surat Pengantar Tugas Mata Kuliah</h3>
                  {{-- <h6 class="font-weight-normal mb-0"><span class="text-primary">Silahkan pilih jenis surat yang ingin diajukan!</span></h6> --}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  {{-- <h4 class="card-title">Basic form elements</h4>
                  <p class="card-description">
                    Basic form elements
                  </p> --}}
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="nrp">NRP</label>
                      <input type="text" class="form-control" id="nrp" placeholder="NRP">
                    </div>
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" class="form-control" id="nama" placeholder="Nama">
                    </div>
                    <div class="form-group">
                      <label for="kodeMK">Kode Mata Kuliah</label>
                      <input type="text" class="form-control" id="kodeMK" placeholder="Kode Mata Kuliah">
                    </div>
                    <div class="form-group">
                      <label for="namaMK">Nama Mata Kuliah</label>
                      <input type="text" class="form-control" id="namaMK" placeholder="Nama Mata Kuliah">
                    </div>
                    <div class="form-group">
                      <label for="tujuan">Keperluan Pengajuan</label>
                      <textarea class="form-control" id="tujuan" rows="4" placeholder="Keperluan Pengajuan"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
  @endif

  @if($jenisSurat == 3)
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Form Surat Keterangan Lulus</h3>
                  {{-- <h6 class="font-weight-normal mb-0"><span class="text-primary">Silahkan pilih jenis surat yang ingin diajukan!</span></h6> --}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  {{-- <h4 class="card-title">Basic form elements</h4>
                  <p class="card-description">
                    Basic form elements
                  </p> --}}
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="nrp">NRP</label>
                      <input type="text" class="form-control" id="nrp" placeholder="NRP">
                    </div>
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" class="form-control" id="nama" placeholder="Nama">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
  @endif
  
  @if($jenisSurat == 4)
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Form Surat Laporan Hasil Studi</h3>
                  {{-- <h6 class="font-weight-normal mb-0"><span class="text-primary">Silahkan pilih jenis surat yang ingin diajukan!</span></h6> --}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  {{-- <h4 class="card-title">Basic form elements</h4>
                  <p class="card-description">
                    Basic form elements
                  </p> --}}
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="nrp">NRP</label>
                      <input type="text" class="form-control" id="nrp" placeholder="NRP">
                    </div>
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" class="form-control" id="nama" placeholder="Nama">
                    </div>
                    <div class="form-group">
                      <label for="tujuan">Keperluan Pengajuan</label>
                      <textarea class="form-control" id="tujuan" rows="4" placeholder="Keperluan Pengajuan"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
  @endif
  

@endsection

@section('ExtraCSS')

@endsection

@section('ExtraJS')

@endsection