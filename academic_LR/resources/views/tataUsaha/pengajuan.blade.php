@extends('layouts.index')

@section('content')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row d-flex">
                <div class="col-10 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Data Pengajuan Surat</h3>
                </div>
                <div class="col text-end">
                  <div class="btn-group">
                    <button class="btn btn-primary btn-md dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Filter Surat
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ route('pengajuanListTU') }}">Semua Surat</a></li>
                      <li><a class="dropdown-item" href="{{ route('pengajuanFilter1') }}">Surat Keterangan Mahasiswa Aktif</a></li>
                      <li><a class="dropdown-item" href="{{ route('pengajuanFilter2') }}">Surat Pengantar Tugas Mata Kuliah</a></li>
                      <li><a class="dropdown-item" href="{{ route('pengajuanFilter3') }}">Surat Keterangan Lulus</a></li>
                      <li><a class="dropdown-item" href="{{ route('pengajuanFilter4') }}">Surat Laporan Hasil Studi</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- Status In Progress --}}
          <div class="col">
        </div>

        {{-- Status Accepted --}}
        <div class="row">
          <!-- Table  -->
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-10">
                    <h4 class="card-title">List Pengajuan Accepted</h4>
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
                          NRP
                        </th>
                        <th>
                          Nama
                        </th>
                        <th>
                          Jenis Surat
                        </th>
                        <th>
                          Tanggal Pengajuan
                        </th>
                        <th>
                          Status Pengajuan
                        </th>
                        <th>
                          Action
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @php($no = 1)
                      @php($ada = false)

                      {{-- Semua Surat --}}
                      @if($filtered != null)
                        @foreach($pengajuans as $pengajuan)
                          @if($pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 2 && $pengajuan->jenisSurat_id == $filtered)
                            @php($ada = true)
                          @endif
                        @endforeach
                        
                        @foreach($pengajuans as $pengajuan)
                          @if($ada == true && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 2 && $pengajuan->jenisSurat_id == $filtered)
                            <tr>
                              <td style="width: 2%">
                                {{ $no++ }}
                              </td>
                              <td style="width: 3%">
                                {{ $pengajuan->pengajuanMahasiswa->nrp}}
                              </td>
                              <td style="width: 15%">
                                {{ $pengajuan->pengajuanMahasiswa->nama}}
                              </td>
                              <td style="width: 23%">
                                {{ $pengajuan->pengajuanJenisSurat->nama}}
                              </td>
                              <td style="width: 3%">
                                {{ $pengajuan->tanggalPengajuan}}
                              </td>
                              <td style="width: 2%"> 
                                @if($pengajuan->pengajuanStatusPengajuan->id == 1)
                                  <span class="text-warning fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                @elseif($pengajuan->pengajuanStatusPengajuan->id == 2)
                                  <span class="text-success fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                @elseif($pengajuan->pengajuanStatusPengajuan->id == 3)  
                                  <span class="text-danger fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                @elseif($pengajuan->pengajuanStatusPengajuan->id == 4)
                                  <span class="text-info fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                @endif
                              </td>
                              <td style="width: 52%">  
                                <div class="container d-flex flex-wrap gap-2">
                                  <a class="btn btn-inverse-info btn-fw btn-sm btn-rounded d-inline-flex align-items-center" href="{{ route('pengajuanDetailTU', [$pengajuan->id]) }}">
                                      <i class="mdi mdi-file-document icon-sm me-1"></i> <span class="fw-semibold">Lihat Detail</span>
                                  </a>
                                  <a class="btn btn-inverse-primary btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#responsLetter{{ $pengajuan->id }}">
                                      <i class="mdi mdi-check-circle icon-sm me-1"></i> <span class="fw-semibold">Respons</span>
                                  </a>
                                  {{-- Modal Respons --}}
                                  <div class="modal fade" id="responsLetter{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Respons Pengajuan Surat</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="{{ route('responsStore', [$pengajuan->id]) }}" enctype="multipart/form-data">
                                          @csrf
                                          <div class="modal-body">
                                            <div class="mb-3">
                                              <h6>Input file/keterangan respons untuk mahasiswa</h6>
                                            </div>
                                              <div class="form-group">
                                                <label for="dokumen">File</label>
                                                <input type="file" class="form-control" name="dokumen" id="dokumen" accept="application/pdf"/>
                                              </div>
                                              <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <textarea class="form-control" name="keterangan" id="keterangan" rows="4" maxlength="250" placeholder="Tulis keterangan di sini..."></textarea>
                                              </div>
                                            </div>
                                          <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Kembali</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div> 
                                    
                                </div>
                              </td>
                            </tr> 
                          @endif
                        @endforeach
                      
                        @else
                          @foreach($pengajuans as $pengajuan)
                            @if($pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 2)
                              @php($ada = true)
                            @endif
                          @endforeach
                          
                          @foreach($pengajuans as $pengajuan)
                            @if($ada == true && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 2)
                              <tr>
                                <td style="width: 2%">
                                  {{ $no++ }}
                                </td>
                                <td style="width: 3%">
                                  {{ $pengajuan->pengajuanMahasiswa->nrp}}
                                </td>
                                <td style="width: 15%">
                                  {{ $pengajuan->pengajuanMahasiswa->nama}}
                                </td>
                                <td style="width: 23%">
                                  {{ $pengajuan->pengajuanJenisSurat->nama}}
                                </td>
                                <td style="width: 3%">
                                  {{ $pengajuan->tanggalPengajuan}}
                                </td>
                                <td style="width: 2%"> 
                                  @if($pengajuan->pengajuanStatusPengajuan->id == 1)
                                    <span class="text-warning fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                  @elseif($pengajuan->pengajuanStatusPengajuan->id == 2)
                                    <span class="text-success fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                  @elseif($pengajuan->pengajuanStatusPengajuan->id == 3)  
                                    <span class="text-danger fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                  @elseif($pengajuan->pengajuanStatusPengajuan->id == 4)
                                    <span class="text-info fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                  @endif
                                </td>
                                <td style="width: 52%">                         
                                  <div class="container d-flex flex-wrap gap-2">
                                    <a class="btn btn-inverse-info btn-fw btn-sm btn-rounded d-inline-flex align-items-center" href="{{ route('pengajuanDetailTU', [$pengajuan->id]) }}">
                                        <i class="mdi mdi-file-document icon-sm me-1"></i> <span class="fw-semibold">Lihat Detail</span>
                                    </a>
                                    <a class="btn btn-inverse-primary btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#responsLetter{{ $pengajuan->id }}">
                                        <i class="mdi mdi-check-circle icon-sm me-1"></i> <span class="fw-semibold">Respons</span>
                                    </a>
                                    {{-- Modal Respons --}}
                                    <div class="modal fade" id="responsLetter{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Respons Pengajuan Surat</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <form method="POST" action="{{ route('responsStore', [$pengajuan->id]) }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                              <div class="mb-3">
                                                <h6>Input file/keterangan respons untuk mahasiswa</h6>
                                              </div>
                                                <div class="form-group">
                                                  <label for="dokumen">File</label>
                                                  <input type="file" class="form-control" name="dokumen" id="dokumen" accept="application/pdf"/>
                                                </div>
                                                <div class="form-group">
                                                  <label for="keterangan">Keterangan</label>
                                                  <textarea class="form-control" name="keterangan" id="keterangan" rows="4" maxlength="250" placeholder="Tulis keterangan di sini..."></textarea>
                                                </div>
                                              </div>
                                            <div class="modal-footer">
                                              <button type="submit" class="btn btn-primary">Submit</button>
                                              <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Kembali</button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div> 
                                  </div>
                                </td>
                              </tr> 
                            @endif
                          @endforeach
                       @endif

                        @if($ada == false)
                        <tr>
                          <td colspan="7" class="text-center py-4">Belum ada surat yang diajukan</td>
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


        {{-- Status Rejected --}}
        <div class="row">
          <!-- Table  -->
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-10">
                    <h4 class="card-title">List Pengajuan Rejected</h4>
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
                          NRP
                        </th>
                        <th>
                          Nama
                        </th>
                        <th>
                          Jenis Surat
                        </th>
                        <th>
                          Tanggal Pengajuan
                        </th>
                        <th>
                          Status Pengajuan
                        </th>
                        <th>
                          Action
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @php($no = 1)
                      @php($ada = false)

                      {{-- Semua Surat --}}
                      @if($filtered != null)
                        @foreach($pengajuans as $pengajuan)
                          @if($pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 3 && $pengajuan->jenisSurat_id == $filtered)
                            @php($ada = true)
                          @endif
                        @endforeach
                        
                        @foreach($pengajuans as $pengajuan)
                          @if($ada == true && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 3 && $pengajuan->jenisSurat_id == $filtered)
                            <tr>
                              <td style="width: 2%">
                                {{ $no++ }}
                              </td>
                              <td style="width: 3%">
                                {{ $pengajuan->pengajuanMahasiswa->nrp}}
                              </td>
                              <td style="width: 15%">
                                {{ $pengajuan->pengajuanMahasiswa->nama}}
                              </td>
                              <td style="width: 23%">
                                {{ $pengajuan->pengajuanJenisSurat->nama}}
                              </td>
                              <td style="width: 3%">
                                {{ $pengajuan->tanggalPengajuan}}
                              </td>
                              <td style="width: 2%"> 
                                @if($pengajuan->pengajuanStatusPengajuan->id == 1)
                                  <span class="text-warning fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                @elseif($pengajuan->pengajuanStatusPengajuan->id == 2)
                                  <span class="text-success fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                @elseif($pengajuan->pengajuanStatusPengajuan->id == 3)  
                                  <span class="text-danger fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                @elseif($pengajuan->pengajuanStatusPengajuan->id == 4)
                                  <span class="text-info fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                @endif
                              </td>
                              <td style="width: 52%">                          
                                <div class="container d-flex flex-wrap gap-2">
                                  <a class="btn btn-inverse-info btn-fw btn-sm btn-rounded d-inline-flex align-items-center" href="{{ route('pengajuanDetailTU', [$pengajuan->id]) }}">
                                      <i class="mdi mdi-file-document icon-sm me-1"></i> <span class="fw-semibold">Lihat Detail</span>
                                  </a>
                                  <a class="btn btn-inverse-primary btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#responsLetter{{ $pengajuan->id }}">
                                      <i class="mdi mdi-check-circle icon-sm me-1"></i> <span class="fw-semibold">Respons</span>
                                  </a>
                                  
                                  {{-- Modal Respons --}}
                                  <div class="modal fade" id="responsLetter{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Respons Pengajuan Surat</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="{{ route('responsStore', [$pengajuan->id]) }}" enctype="multipart/form-data">
                                          @csrf
                                          <div class="modal-body">
                                            <div class="mb-3">
                                              <h6>Input file/keterangan respons untuk mahasiswa</h6>
                                            </div>
                                              <div class="form-group">
                                                <label for="dokumen">File</label>
                                                <input type="file" class="form-control" name="dokumen" id="dokumen" accept="application/pdf"/>
                                              </div>
                                              <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <textarea class="form-control" name="keterangan" id="keterangan" rows="4" maxlength="250" placeholder="Tulis keterangan di sini..."></textarea>
                                              </div>
                                            </div>
                                          <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Kembali</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div> 
                                    
                                </div>
                              </td>
                            </tr> 
                          @endif
                        @endforeach
                      
                        @else
                          @foreach($pengajuans as $pengajuan)
                            @if($pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 3)
                              @php($ada = true)
                            @endif
                          @endforeach
                          
                          @foreach($pengajuans as $pengajuan)
                            @if($ada == true && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 3)
                              <tr>
                                <td style="width: 2%">
                                  {{ $no++ }}
                                </td>
                                <td style="width: 3%">
                                  {{ $pengajuan->pengajuanMahasiswa->nrp}}
                                </td>
                                <td style="width: 15%">
                                  {{ $pengajuan->pengajuanMahasiswa->nama}}
                                </td>
                                <td style="width: 23%">
                                  {{ $pengajuan->pengajuanJenisSurat->nama}}
                                </td>
                                <td style="width: 3%">
                                  {{ $pengajuan->tanggalPengajuan}}
                                </td>
                                <td style="width: 2%"> 
                                  @if($pengajuan->pengajuanStatusPengajuan->id == 1)
                                    <span class="text-warning fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                  @elseif($pengajuan->pengajuanStatusPengajuan->id == 2)
                                    <span class="text-success fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                  @elseif($pengajuan->pengajuanStatusPengajuan->id == 3)  
                                    <span class="text-danger fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                  @elseif($pengajuan->pengajuanStatusPengajuan->id == 4)
                                    <span class="text-info fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                  @endif
                                </td>
                                <td style="width: 52%">                           
                                  <div class="container d-flex flex-wrap gap-2">
                                    <a class="btn btn-inverse-info btn-fw btn-sm btn-rounded d-inline-flex align-items-center" href="{{ route('pengajuanDetailTU', [$pengajuan->id]) }}">
                                        <i class="mdi mdi-file-document icon-sm me-1"></i> <span class="fw-semibold">Lihat Detail</span>
                                    </a>
                                    <a class="btn btn-inverse-primary btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#responsLetter{{ $pengajuan->id }}">
                                        <i class="mdi mdi-check-circle icon-sm me-1"></i> <span class="fw-semibold">Respons</span>
                                    </a>
                                    {{-- Modal Respons --}}
                                    <div class="modal fade" id="responsLetter{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Respons Pengajuan Surat</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <form method="POST" action="{{ route('responsStore', [$pengajuan->id]) }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                              <div class="mb-3">
                                                <h6>Input file/keterangan respons untuk mahasiswa</h6>
                                              </div>
                                                <div class="form-group">
                                                  <label for="dokumen">File</label>
                                                  <input type="file" class="form-control" name="dokumen" id="dokumen" accept="application/pdf"/>
                                                </div>
                                                <div class="form-group">
                                                  <label for="keterangan">Keterangan</label>
                                                  <textarea class="form-control" name="keterangan" id="keterangan" rows="4" maxlength="250" placeholder="Tulis keterangan di sini..."></textarea>
                                                </div>
                                              </div>
                                            <div class="modal-footer">
                                              <button type="submit" class="btn btn-primary">Submit</button>
                                              <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Kembali</button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div> 
                                  
                                
                                  </div>
                                </td>
                              </tr> 
                            @endif
                          @endforeach
                        @endif

                        @if($ada == false)
                        <tr>
                          <td colspan="7" class="text-center py-4">Belum ada surat yang diajukan</td>
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


        {{-- Status Finished --}}
        <div class="row">
          <!-- Table  -->
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-10">
                    <h4 class="card-title">List Pengajuan Finished</h4>
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
                          NRP
                        </th>
                        <th>
                          Nama
                        </th>
                        <th>
                          Jenis Surat
                        </th>
                        <th>
                          Tanggal Pengajuan
                        </th>
                        <th>
                          Status Pengajuan
                        </th>
                        <th>
                          Action
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @php($no = 1)
                      @php($ada = false)

                      {{-- Semua Surat --}}
                      @if($filtered != null)
                        @foreach($pengajuans as $pengajuan)
                          @if($pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 4 && $pengajuan->jenisSurat_id == $filtered)
                            @php($ada = true)
                          @endif
                        @endforeach
                        
                        @foreach($pengajuans as $pengajuan)
                          @if($ada == true && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 4 && $pengajuan->jenisSurat_id == $filtered)
                            <tr>
                              <td style="width: 2%">
                                {{ $no++ }}
                              </td>
                              <td style="width: 3%">
                                {{ $pengajuan->pengajuanMahasiswa->nrp}}
                              </td>
                              <td style="width: 15%">
                                {{ $pengajuan->pengajuanMahasiswa->nama}}
                              </td>
                              <td style="width: 23%">
                                {{ $pengajuan->pengajuanJenisSurat->nama}}
                              </td>
                              <td style="width: 3%">
                                {{ $pengajuan->tanggalPengajuan}}
                              </td>
                              <td style="width: 2%"> 
                                @if($pengajuan->pengajuanStatusPengajuan->id == 1)
                                  <span class="text-warning fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                @elseif($pengajuan->pengajuanStatusPengajuan->id == 2)
                                  <span class="text-success fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                @elseif($pengajuan->pengajuanStatusPengajuan->id == 3)  
                                  <span class="text-danger fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                @elseif($pengajuan->pengajuanStatusPengajuan->id == 4)
                                  <span class="text-info fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                @endif
                              </td>
                              <td style="width: 52%">                           
                                <div class="container d-flex flex-wrap gap-2">
                                  <a class="btn btn-inverse-info btn-fw btn-sm btn-rounded d-inline-flex align-items-center" href="{{ route('pengajuanDetailTU', [$pengajuan->id]) }}">
                                      <i class="mdi mdi-file-document icon-sm me-1"></i> <span class="fw-semibold">Lihat Detail</span>
                                  </a>
                                  <a class="btn btn-inverse-primary btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#responsLetter{{ $pengajuan->id }}">
                                      <i class="mdi mdi-check-circle icon-sm me-1"></i> <span class="fw-semibold">Respons</span>
                                  </a>
                                  {{-- Modal Respons --}}
                                  <div class="modal fade" id="responsLetter{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Respons Pengajuan Surat</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="{{ route('responsStore', [$pengajuan->id]) }}" enctype="multipart/form-data">
                                          @csrf
                                          <div class="modal-body">
                                            <div class="mb-3">
                                              <h6>Input file/keterangan respons untuk mahasiswa</h6>
                                            </div>
                                              <div class="form-group">
                                                <label for="dokumen">File</label>
                                                <input type="file" class="form-control" name="dokumen" id="dokumen" accept="application/pdf"/>
                                              </div>
                                              <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <textarea class="form-control" name="keterangan" id="keterangan" rows="4" maxlength="250" placeholder="Tulis keterangan di sini..."></textarea>
                                              </div>
                                            </div>
                                          <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Kembali</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div> 
                                    
                                </div>
                              </td>
                            </tr> 
                          @endif
                        @endforeach
                      
                      @else
                          @foreach($pengajuans as $pengajuan)
                            @if($pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 4)
                              @php($ada = true)
                            @endif
                          @endforeach
                          
                          @foreach($pengajuans as $pengajuan)
                            @if($ada == true && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 4)
                              <tr>
                                <td style="width: 2%">
                                  {{ $no++ }}
                                </td>
                                <td style="width: 3%">
                                  {{ $pengajuan->pengajuanMahasiswa->nrp}}
                                </td>
                                <td style="width: 15%">
                                  {{ $pengajuan->pengajuanMahasiswa->nama}}
                                </td>
                                <td style="width: 23%">
                                  {{ $pengajuan->pengajuanJenisSurat->nama}}
                                </td>
                                <td style="width: 3%">
                                  {{ $pengajuan->tanggalPengajuan}}
                                </td>
                                <td style="width: 2%"> 
                                  @if($pengajuan->pengajuanStatusPengajuan->id == 1)
                                    <span class="text-warning fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                  @elseif($pengajuan->pengajuanStatusPengajuan->id == 2)
                                    <span class="text-success fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                  @elseif($pengajuan->pengajuanStatusPengajuan->id == 3)  
                                    <span class="text-danger fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                  @elseif($pengajuan->pengajuanStatusPengajuan->id == 4)
                                    <span class="text-info fw-bold">{{ $pengajuan->pengajuanStatusPengajuan->nama}} </span>
                                  @endif
                                </td>
                                <td style="width: 52%">                           
                                  <div class="container d-flex flex-wrap gap-2">
                                    <a class="btn btn-inverse-info btn-fw btn-sm btn-rounded d-inline-flex align-items-center" href="{{ route('pengajuanDetailTU', [$pengajuan->id]) }}">
                                        <i class="mdi mdi-file-document icon-sm me-1"></i> <span class="fw-semibold">Lihat Detail</span>
                                    </a>
                                    <a class="btn btn-inverse-primary btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#responsLetter{{ $pengajuan->id }}">
                                        <i class="mdi mdi-check-circle icon-sm me-1"></i> <span class="fw-semibold">Respons</span>
                                    </a>
                                    {{-- Modal Respons --}}
                                    <div class="modal fade" id="responsLetter{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Respons Pengajuan Surat</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <form method="POST" action="{{ route('responsStore', [$pengajuan->id]) }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                              <div class="mb-3">
                                                <h6>Input file/keterangan respons untuk mahasiswa</h6>
                                              </div>
                                                <div class="form-group">
                                                  <label for="dokumen">File</label>
                                                  <input type="file" class="form-control" name="dokumen" id="dokumen" accept="application/pdf"/>
                                                </div>
                                                <div class="form-group">
                                                  <label for="keterangan">Keterangan</label>
                                                  <textarea class="form-control" name="keterangan" id="keterangan" rows="4" maxlength="250" placeholder="Tulis keterangan di sini..."></textarea>
                                                </div>
                                              </div>
                                            <div class="modal-footer">
                                              <button type="submit" class="btn btn-primary">Submit</button>
                                              <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Kembali</button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div> 
                                  
                                
                                  </div>
                                </td>
                              </tr> 
                            @endif
                          @endforeach
                        @endif

                        @if($ada == false)
                        <tr>
                          <td colspan="7" class="text-center py-4">Belum ada surat yang diajukan</td>
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
