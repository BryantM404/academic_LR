@extends('layouts.index')

@section('content')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h2 class="font-weight-bold">Edit Users</h2>
                  </div>
              </div>
            </div>
          </div>
          
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title">Memodifikasi Data User Aplikasi Fufu</h2>
                <p class="card-description">
                  Catatan: Username diisi dengan Nomor Induk Kependudukan (bagi Kaprodi atau TU) <br>
                  atau Nomor Registrasi Peserta (bagi mahasiswa)
                </p>
                <form method="POST" action="{{ route('userUpdate', [$users->id]) }}" class="forms-sample" >
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Name" required value="{{ $users->username }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required autofocus value="{{ $users->password }}">
                    </div>
                    <div class="form-group">
                        <label class="">Role</label>
                        <select name="role_id" class="form-control" required readonly>
      
                          @foreach($roles as $role)
                            @if($role->nama != "Superadmin")
                              @if($role->id == $users->role_id)
                                <option value="{{ $role->id }}" selected readonly>{{ $role->nama }}</option>
                              @endif
                            @endif
                          @endforeach
                        </select>
                    </div>

                    <input type="submit" value="Submit" class="btn btn-primary mr-2">
                    <a href="{{ route('userList') }}" class="btn btn-light">Kembali</a>

                </form>
              </div>
            </div>
          </div>
      </div>
@endsection

@section('ExtraCSS')

@endsection

@section('ExtraJS')

@endsection   