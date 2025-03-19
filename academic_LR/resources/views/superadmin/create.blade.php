@extends('layouts.index')

@section('content')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h2 class="font-weight-bold">Create Users</h2>
                  <h4 class="font-weight-normal mb-0">Halaman superadmin untuk bla bla bla <span class="text-primary">3 unread alerts!</span></h4>
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
                    <div class="form-group">
                        <label class="">Role</label>
                        <select name="role_id" class="form-control" required>
                          <option value="" @readonly(true)>-- Pilih Role --</option>
                          @foreach($roles as $role)
                            @if($role->nama != "Superadmin")
                              <option value="{{ $role->id }}">{{ $role->nama }}</option>
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