@extends('layouts.index')

@section('content')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome, Superadmin</h3>
                  <h6 class="font-weight-normal mb-0">Apa yang ingin Anda lakukan hari ini?</h6>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="{{ asset('images/dashboard/people.svg') }}" alt="people">
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
                      </div>
                      <div class="ml-2">
                        <h4 class="location font-weight-normal">Bangalore</h4>
                        <h6 class="font-weight-normal">India</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <form action="{{ route('searchSA') }}" method="get" class="mb-3 col-lg-12 grid-margin stretch-card" >
              <div class="input-group rounded-4 overflow-hidden ">
                <span class="input-group-text bg-white rounded-start-4">
                  <i class="bi bi-search text-muted"></i>
                </span>
                <input 
                  type="text" 
                  class="form-control border-start-0" 
                  name="search" 
                  placeholder="Search username, etc." 
                  value="{{ $search ?? '' }}"
                >
                <button class="btn btn-primary" type="submit">Cari</button>
              </div>
            </form>

            <!-- Table  -->
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between col-md-12">
                    <h3 class="">Users List</h3>
                    <div class="justify-content-between d-flex">
                      <a class="btn btn-primary btn-rounded btn-fw d-flex align-items-center " href="{{ route('userCreate') }}">
                         Insert User
                      </a>
                      {{-- <button type="button" class="btn btn-primary btn-rounded btn-fw" href="{{ route('userCreate') }}">Insert User</button> --}}
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-hover" >
                      <thead>
                        <tr>
      
                          <th>
                            NO
                          </th>
                          <th>
                            USERNAME
                          </th>
                          <th>
                            NAME
                          </th>
                          <th>
                            ROLE
                          </th>
                          <th>
                            ACTION
                          </th>
              
                        </tr>
                      </thead>
                      <tbody>
                        @php($no = 1)
                        @foreach($users as $user)
                        
                        <tr>
                          <td>
                            {{ $no++ }}
                          </td>
                          <td>
                            {{ $user->username}}
                          </td>
                          <td>
                            {{ $user->userKaprodi->nama ?? $user->userTataUsaha->nama ?? $user->userMahasiswa->nama ?? '-' }}
                          </td>
                          <td>
                            {{ $user->userRole->role_id}} {{ $user->userRole->nama }}
                          </td>
                          <td>
                            <div class="row g-0">
                              <div class="col">
                                <button type="button" 
                                        class="btn btn-inverse-info btn-fw btn-sm d-flex align-items-center btn-rounded"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#detailUser-{{ $user->id }}"
                                      >
                                  <i class="mdi mdi-information-outline icon-sm"></i> <span class="px-1">detail</span>
                                </button>
                              </div>
                              <div class="col form-button-action">
                                <button 
                                title="Edit"
                                class="btn btn-inverse-warning btn-fw btn-sm d-flex align-items-center btn-rounded edit-data"
                                data-bs-toggle="tooltip"
                                data-original-title="Edit"
                                data-url="{{ route('userEdit', [$user->id]) }}">
                                  <i class="mdi mdi-pencil icon-sm"></i> <span class="px-1">edit</span>
                                </button>
                              </div>
                              
                              <div class="col">
                                <button 
                                  type="button" 
                                  class="btn btn-inverse-danger btn-fw btn-sm d-flex align-items-center btn-rounded" 
                                  data-bs-toggle="modal" 
                                  data-bs-target="#deleteUserModal-{{ $user->id }}">
                                    <i class="mdi mdi-eraser icon-sm"></i> <span class="px-1">delete</span>
                                  </button>
                              </div>

                            </div>
                            <div class="modal fade" id="deleteUserModal-{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <strong><h3 class="modal-title " id="exampleModalLabel">Delete</h3></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <p class="">Are you sure want to delete this user?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <form method="post" action="{{ route('userDelete', [$user->id]) }}">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-primary btn-danger">Yes</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                
                                  </div>
                                </div>
                              </div>
                            </div>

                            
                            <div class="modal fade" id="detailUser-{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content rounded-4 shadow">
                                  <div class="modal-header bg-primary rounded-top-4 text-white">
                                    <h4 class="modal-title" id="detailUserLabel-{{ $user->id }}">
                                      <i class="bi bi-person me-2"></i> Detail Pengguna {{ $user->username }}
                                    </h4>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    @if ($user->userRole->id == 2)
                                      @if ($user->userKaprodi)
                                        <ul class="list-group list-group-flush">
                                          <li class="list-group-item"><strong>Nama:</strong> {{ $user->userKaprodi->nama }}</li>
                                          <li class="list-group-item"><strong>Email:</strong> {{ $user->userKaprodi->email }}</li>
                                          <li class="list-group-item"><strong>Alamat:</strong> {{ $user->userKaprodi->alamat }}</li>
                                          <li class="list-group-item"><strong>No Telepon:</strong> {{ $user->userKaprodi->noTelp }}</li>
                                          <li class="list-group-item"><strong>Tanggal Lahir:</strong> {{ $user->userKaprodi->tanggalLahir }}</li>
                                          <li class="list-group-item"><strong>Program Studi:</strong> {{ $user->userKaprodi->kaprodiProdi->nama ?? '-' }}</li>
                                        </ul>
                                      @endif
                                      

                                    @elseif ($user->userRole->id == 3)
                                      @if ($user->userTataUsaha)
                                        <ul class="list-group list-group-flush">
                                          <li class="list-group-item"><strong>Nama:</strong> {{ $user->userTataUsaha->nama }}</li>
                                          <li class="list-group-item"><strong>Program Studi:</strong> {{ $user->userTataUsaha->tataUsahaProdi->nama ?? '-' }}</li>
                                        </ul>
                                      @endif
                                    

                                    @elseif ($user->userRole->id == 4)
                                      @if ($user->userMahasiswa)
                                        <ul class="list-group list-group-flush">
                                          <li class="list-group-item"><strong>NRP:</strong> {{ $user->userMahasiswa->nrp }}</li>
                                          <li class="list-group-item"><strong>Nama:</strong> {{ $user->userMahasiswa->nama }}</li>
                                          <li class="list-group-item"><strong>Email:</strong> {{ $user->userMahasiswa->email }}</li>
                                          <li class="list-group-item"><strong>Alamat:</strong> {{ $user->userMahasiswa->alamat }}</li>
                                          <li class="list-group-item"><strong>No Telepon:</strong> {{ $user->userMahasiswa->noTelp }}</li>
                                          <li class="list-group-item"><strong>Tanggal Lahir:</strong> {{ $user->userMahasiswa->tanggalLahir }}</li>
                                          <li class="list-group-item"><strong>Program Studi:</strong> {{ $user->userMahasiswa->mahasiswaProdi->nama ?? '-' }}</li>
                                        </ul>
                                      @else
                                        <div class="alert alert-warning">Data detail tidak tersedia untuk pengguna ini.</div>
                                      @endif

                                    @else
                                      <div class="alert alert-warning">Data detail tidak tersedia untuk pengguna ini.</div>
                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                        @endforeach
  
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
      </div>
@endsection

@section('ExtraCSS')

@endsection

@section('ExtraJS')
<script>
  $('.edit-data').click(function () {
        window.location.href = $(this).data('url');
    })
</script>
@endsection   