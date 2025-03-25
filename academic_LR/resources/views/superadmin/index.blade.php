@extends('layouts.index')

@section('content')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome, Superadmin</h3>
                  <h6 class="font-weight-normal mb-0">Halaman superadmin untuk bla bla bla <span class="text-primary">3 unread alerts!</span></h6>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <!-- Table  -->
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Users List</h4>
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
                            {{ $user->userRole->role_id}} {{ $user->userRole->nama }}
                          </td>
                          <td>
                            <div class="row">
                              <div class="col-3">
                                <button type="button" class="btn btn-inverse-warning btn-fw btn-sm d-flex align-items-center btn-rounded">
                                  <i class="mdi mdi-pencil icon-sm"></i> <span class="px-1">edit</span>
                                </button>
                              </div>
                              <div class="col=3">
                                <button type="button" class="btn btn-inverse-danger btn-fw btn-sm d-flex align-items-center btn-rounded"  data-bs-toggle="modal" data-bs-target="#deleteUser">
                                  <i class="mdi mdi-eraser icon-sm"></i> <span class="px-1">delete</span>
                                </button>
                              </div>
                            </div>
          
                            <div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    ...
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                  </div>
                                </div>
                              </div>
                            </div>

                            
                
                            {{-- <div class="col-sm-6 col-md-4 col-lg-3 ">
                              

                            </div> --}}
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

@endsection   