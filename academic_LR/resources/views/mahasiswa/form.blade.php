@extends('layouts.index')

@section('content')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Form Pengajuan Surat</h3>
                  <h6 class="font-weight-normal mb-0"><span class="text-primary">Silahkan pilih jenis surat yang ingin diajukan!</span></h6>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="col-md">
                    <form method="POST" action="{{ route('mahasiswaForms') }}">
                      @csrf
                      <div class="form-group row">
                        <label>Jenis Surat</label>
                        <select class="form-control" name="jenisSurat_id">
                          @foreach($jenisSurats as $jenisSurat)
                            <option value="{{ $jenisSurat->id }}">{{ $jenisSurat->nama }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                  </div>
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