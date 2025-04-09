@extends('layouts.index')

@section('content')
<div class="main-panel">
    @if ($roleData->id == 2)
        <div class="content-wrapper">
            <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h2 class="font-weight-bold">Update User</h2>
                        <h4 class="font-weight-normal mb-0"><span class="text-primary">Kepala Program Studi</span></h4>
                    </div>
                </div>
            </div>
            </div>
            
            <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <form method="POST" action="{{ route('kaprodiEditStore', ['user' => $user->id]) }}" class="forms-sample" >
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="ex: John Doe" required autofocus value="{{ $user->userKaprodi->nama }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="ex: johndoe1@gmail.com" required value="{{ $user->userKaprodi->email }}">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="ex: Sukabumi Street" required value="{{ $user->userKaprodi->alamat }}">
                    </div>
                    <div class="form-group">
                        <label for="noTelp">No Telepon</label>
                        <input type="text" class="form-control" name="noTelp" id="noTelp" placeholder="0813xxxxxxxx" required value="{{ $user->userKaprodi->noTelp }}">
                    </div>
                    <div class="form-group">
                        <label for="tanggalLahir">Tanggal lahir</label>
                        <input type="date" class="form-control" name="tanggalLahir" id="tanggalLahir" required value="{{ $user->userKaprodi->tanggalLahir }}">
                    </div>
                    <div class="form-group">
                        <label for="prodi_id" class="">Program Studi</label>
                        <select name="prodi_id" class="form-control" required>
                          <option value="" readonly>-- Pilih Program Studi --</option>
                          @foreach($prodis as $prodi)
                            <option value="{{ $prodi->id }}" 
                                {{ $user->userKaprodi->prodi_id == $prodi->id ? 'selected' : '' }}>
                                {{ $prodi->nama }}
                            </option>                            
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{ $user->id }}">
                    </div>
                    
                    <input type="submit" value="Submit" class="btn btn-primary mr-2">

                </form>
                </div>
            </div>
        </div>
    
    @elseif ($roleData->id == 3)
        <div class="content-wrapper">
            <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h2 class="font-weight-bold">Update User</h2>
                    <h4 class="font-weight-normal mb-0"><span class="text-primary">Admin Tata Usaha</span></h4>
                </div>
                </div>
            </div>
            </div>
            
            <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('tataUsahaEditStore', ['user' => $user->id]) }}" class="forms-sample" >
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="ex: John Doe" required autofocus value="{{ $user->userTataUsaha->nama }}">
                        </div>
                        <div class="form-group">
                            <label for="prodi_id" class="">Program Studi</label>
                            <select name="prodi_id" class="form-control" required>
                              <option value="" readonly>-- Pilih Program Studi --</option>
                              @foreach($prodis as $prodi)
                                @if($prodi->id == $user->userTataUsaha->prodi_id)
                                    <option value="{{ $prodi->id }}" 
                                        {{ $user->userTataUsaha->prodi_id == $prodi->id ? 'selected' : '' }}>
                                        {{ $prodi->nama }}
                                    </option>   
                                @endif                                
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{ $user->id }}">
                        </div>
    
                        <input type="submit" value="Submit" class="btn btn-primary mr-2">
    
                    </form>
                </div>
                
            </div>
        </div>

    @elseif ($roleData->id == 4)
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h2 class="font-weight-bold">Update User</h2>
                        <h4 class="font-weight-normal mb-0"><span class="text-primary">Mahasiswa</span></h4>
                    </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('mahasiswaEditStore', ['user' => $user->id]) }}" class="forms-sample" >
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nrp">NRP</label>
                                <input type="text" class="form-control" name="nrp" id="nrp" placeholder="ex: 2372066" required  value="{{ $user->userMahasiswa->nrp }}">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="ex: John Doe" required value="{{ $user->userMahasiswa->nama }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="ex: johndoe1@gmail.com" required value="{{ $user->userMahasiswa->email }}">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="ex: Sukabumi Street" required value="{{ $user->userMahasiswa->alamat }}">
                            </div>
                            <div class="form-group">
                                <label for="noTelp">No Telepon</label>
                                <input type="text" class="form-control" name="noTelp" id="noTelp" placeholder="0813xxxxxxxx" required value="{{ $user->userMahasiswa->noTelp }}">
                            </div>
                            <div class="form-group">
                                <label for="tanggalLahir">Tanggal lahir</label>
                                <input type="date" class="form-control" name="tanggalLahir" id="tanggalLahir" required value="{{ $user->userMahasiswa->tanggalLahir }}">
                            </div>
                            <div class="form-group">
                                <label for="prodi_id" class="">Program Studi</label>
                                <select name="prodi_id" class="form-control" required>
                                <option value="" readonly>-- Pilih Program Studi --</option>
                                @foreach($prodis as $prodi)
                                    <option value="{{ $prodi->id }}" 
                                        {{ $user->userMahasiswa->prodi_id == $prodi->id ? 'selected' : '' }}>
                                        {{ $prodi->nama }}
                                    </option>                 
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{ $user->id }}">
                            </div>
                            
                            <input type="submit" value="Submit" class="btn btn-primary mr-2">
                
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