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
                      <h3 class="font-weight-bold">Edit Program Studi</h3>
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
                  <form class="forms-sample" method="POST" action="{{ route('prodiUpdate', [$prodi->id]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="{{ $prodi->nama }}">
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Simpan Data Program Stuid</button>
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