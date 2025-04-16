@extends('layouts.index')

@section('content')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">List Program Studi</h3>
                  {{-- <h6 class="font-weight-normal mb-0">Halaman superadmin untuk bla bla bla <span class="text-primary">3 unread alerts!</span></h6> --}}
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <!-- Table  -->
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-10">
                      <h4 class="card-title">List Program Studi</h4>
                    </div>
                    <div class="col">
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-hover" >
                      <thead>
                        <tr>
                          <th>
                            No
                          </th>
                          <th>
                            Nama Program Studi
                          </th>
                          <th>
                            Action
                          </th>
              
                        </tr>
                      </thead>
                      <tbody>
                        @php($no = 1)
                        @php($ada = false)

                        @foreach($prodis as $prodi)
                            @if($prodi->id != null)
                                @php($ada = true)
                            @endif
                        @endforeach
                        
                        @foreach($prodis as $prodi)
                        @if($ada == true)
                            <tr>
                            <td>
                                {{ $no++ }}
                            </td>
                            <td>
                                {{ $prodi->nama}}
                            </td>
                            <td>
                            <div class="container d-flex flex-wrap gap-2">                                
                                <a class="btn btn-inverse-warning btn-fw btn-sm btn-rounded d-inline-flex align-items-center" href="{{ route('prodiEdit', [$prodi->id]) }}">
                                    <i class="mdi mdi-eraser icon-sm me-1"></i> <span class="fw-semibold">Edit</span>
                                </a>
                                <a class="btn btn-inverse-danger btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#deleteProdi">
                                    <i class="mdi mdi-close-circle icon-sm me-1"></i> <span class="fw-semibold">Delete</span>
                                </a>
                                {{-- Modal Delete --}}
                                <div class="modal fade" id="deleteProdi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Program Studi</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        Apakah anda yakin ingin menghapus program studi ini?
                                      </div>
                                      <div class="modal-footer">
                                        <form  method="POST" action="{{ route('prodiDelete', [$prodi->id]) }}">
                                          @csrf
                                          @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Ya</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                      </div>
                                    </div>
                                  </div>
                                </div> 
                            </div>
                            </td>
                            </tr>
                        @endif
                        @endforeach
                        

                        @if($ada == false)
                          <tr>
                            <td colspan="5" class="text-center py-4">Belum ada surat yang diajukan</td>
                          </tr>
                        @endif
                      </tbody>
                    </table>
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
