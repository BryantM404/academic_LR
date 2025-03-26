@extends('layouts.index')

@section('content')
  <div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Student's Profile</h3>
        <ul class="breadcrumbs mb-3">
          <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
          <li class="separator"><i class="icon-arrow-right"></i></li>
          <li class="nav-item">Master</li>
          <li class="separator"><i class="icon-arrow-right"></i></li>
          <li class="nav-item"><a href="{{ route('mahasiswaList') }}">Student</a></li>
        </ul>
      </div>
      @error('err_msg')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body d-flex">
              <div class="col-md-4 d-flex align-items-center justify-content-center">
                <div class="text-center">
                  <div class="avatar avatar-xxl">
                    <img src="{{ asset('assets/img/mhs/'.$mahasiswa->profile_picture) }}" alt="..." class="avatar-img rounded-circle">
                  </div>
                  <h3>{{ $mahasiswa->nrp }}</h3>
                  <p><b>{{ $mahasiswa->name }}</b></p>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <div class="input-icon">
                    <span class="input-icon-addon"><i class="far fa-envelope"></i></span>
                    <input type="text" class="form-control" value="{{ $mahasiswa->email }}" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-icon">
                    <span class="input-icon-addon"><i class="fas fa-mobile-alt"></i></span>
                    <input type="text" class="form-control" value="{{ $mahasiswa->phone }}" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-icon">
                    <span class="input-icon-addon"><i class="fas fa-address-card"></i></span>
                    <textarea class="form-control" rows="2" readonly>{{ $mahasiswa->address }}</textarea>
                  </div>
                </div>
              </div>
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