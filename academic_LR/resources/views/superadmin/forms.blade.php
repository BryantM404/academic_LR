@extends('layouts.index')

@section('content')
<div class="main-panel">
    @if ($roleData->id == 2)
        <div class="content-wrapper">
            <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Create Users</h3>
                        <h4 class="font-weight-normal mb-0"><span class="text-primary">Kepala Program Studi</span></h4>
                    </div>
                </div>
            </div>
            </div>
            
            <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <form method="POST" action="{{ route('kaprodiStore', [$roleData->id, $userData->id]) }}" class="forms-sample" >
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="ex: John Doe" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="ex: johndoe1@gmail.com" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="ex: Sukabumi Street" required>
                    </div>
                    <div class="form-group">
                        <label for="noTelp">No Telepon</label>
                        <input type="text" class="form-control" name="noTelp" id="noTelp" placeholder="0813xxxxxxxx" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggalLahir">Tanggal lahir</label>
                        <input type="date" class="form-control" name="tanggalLahir" id="tanggalLahir" required>
                    </div>
                    <div class="form-group">
                        <label for="prodi_id" class="">Program Studi</label>
                        <select name="prodi_id" class="form-control" required>
                          <option value="" @readonly(true) readonly>-- Pilih Program Studi --</option>
                          @foreach($prodis as $prodi)
                            
                              <option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
                            
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{ $userData->id }}">
                    </div>
                    
                    <input type="submit" value="Submit" class="btn btn-primary mr-2">

                </form>
                </div>
            </div>
        </div>
    @endif
    @if ($roleData->id == 3)
        <div class="content-wrapper">
            <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h2 class="font-weight-bold">Create Users</h2>
                    <h4 class="font-weight-normal mb-0">Kepala Program Studi<span class="text-primary">3 unread alerts!</span></h4>
                </div>
                </div>
            </div>
            </div>
            
            <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h2 class="card-title">Basic form elements</h2>
                <p class="card-description">
                    Basic form elements
                </p>
                <form method="POST" action="{{ route('userStore') }}" class="forms-sample" >
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Name" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    </div>
                    {{-- <pre>{{ print_r($roles) }}</pre> --}}
                    
                    <input type="submit" value="Submit" class="btn btn-primary mr-2">
                    <a href="{{ route('userList') }}" class="btn btn-light">Kembali</a>

                </form>
                </div>
            </div>
        </div>
    @endif
    @if ($roleData->id == 4)
        <div class="content-wrapper">
            <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h2 class="font-weight-bold">Create Users</h2>
                    <h4 class="font-weight-normal mb-0">Kepala Program Studi<span class="text-primary">3 unread alerts!</span></h4>
                </div>
                </div>
            </div>
            </div>
            
            <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h2 class="card-title">Basic form elements</h2>
                <p class="card-description">
                    Basic form elements
                </p>
                <form method="POST" action="{{ route('userStore') }}" class="forms-sample" >
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Name" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    </div>
                    {{-- <pre>{{ print_r($roles) }}</pre> --}}
                    
                    <input type="submit" value="Submit" class="btn btn-primary mr-2">
                    <a href="{{ route('userList') }}" class="btn btn-light">Kembali</a>

                </form>
                </div>
            </div>
        </div>
    @endif
        
      </div>
@endsection

@section('ExtraCSS')

@endsection

@section('ExtraJS')

@endsection   