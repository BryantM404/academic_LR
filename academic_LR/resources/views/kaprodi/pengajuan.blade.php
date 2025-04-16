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
                      <li><a class="dropdown-item" href="{{ route('pengajuanListKaprodi') }}">Semua Surat</a></li>
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
          <div class="row">
            <!-- Table  -->
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h4 class="card-title">List Pengajuan - <span class="text-warning">In Progress</span></h4>
                    </div>
                    <div class="col">
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-hover" >
                      <thead>
                        <tr>
                          <th>
                            Non
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
                          @foreach($progress as $pengajuan)
                            @if($pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 1 && $pengajuan->jenisSurat_id == $filtered)
                              @php($ada = true)
                            @endif
                          @endforeach
                          
                          @foreach($progress as $pengajuan)
                            @if($ada == true && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 1 && $pengajuan->jenisSurat_id == $filtered)
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
                                    <a class="btn btn-inverse-info btn-fw btn-sm btn-rounded d-inline-flex align-items-center" href="{{ route('pengajuanDetailKaprodi', [$pengajuan->id]) }}">
                                        <i class="mdi mdi-file-document icon-sm me-1"></i> <span class="fw-semibold">Lihat Detail</span>
                                    </a>
                                    <a class="btn btn-inverse-success btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#acceptLetter{{ $pengajuan->id }}">
                                        <i class="mdi mdi-check-circle icon-sm me-1"></i> <span class="fw-semibold">Setujui</span>
                                    </a>
                                    {{-- Modal Accepted --}}
                                    <div class="modal fade" id="acceptLetter{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Setujui Pengajuan Surat</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            Apakah anda yakin ingin menyetujui pengajuan surat ini?
                                          </div>
                                          <div class="modal-footer">
                                            <form  method="POST" action="{{ route('pengajuanAccepted', [$pengajuan->id]) }}">
                                              @csrf
                                                <button type="submit" class="btn btn-danger">Ya</button>
                                            </form>
                                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tidak</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div> 
                                    <a class="btn btn-inverse-danger btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#rejectLetter{{ $pengajuan->id }}">
                                        <i class="mdi mdi-close-circle icon-sm me-1"></i> <span class="fw-semibold">Tolak</span>
                                    </a>
                                    {{-- Modal Rejected --}}
                                    <div class="modal fade" id="rejectLetter{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tolak Pengajuan Surat</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            Apakah anda yakin ingin menolak pengajuan surat ini?
                                            <div class="row p-1">
                                              <p class="fw-semibold">Alasan penolakan: </p>
                                              <form method="POST" action="{{ route('pengajuanRejected', [$pengajuan->id]) }}">
                                                <textarea name="keterangan" id="keterangan" cols="57" rows="8" style="border: 1px solid grey;" placeholder="Tidak memenuhi kriteria" required></textarea>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                              @csrf
                                                <button type="submit" class="btn btn-danger">Ya</button>
                                              </form>
                                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tidak</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>      
                                  </div>
                                </td>
                              </tr> 
                            @endif
                          @endforeach
                        
                        @else
                          @foreach($progress as $pengajuan)
                              @if($pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 1)
                                @php($ada = true)
                              @endif
                            @endforeach
                            
                            @foreach($progress as $pengajuan)
                              @if($ada == true && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 1)
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
                                      <a class="btn btn-inverse-info btn-fw btn-sm btn-rounded d-inline-flex align-items-center" href="{{ route('pengajuanDetailKaprodi', [$pengajuan->id]) }}">
                                          <i class="mdi mdi-file-document icon-sm me-1"></i> <span class="fw-semibold">Lihat Detail</span>
                                      </a>
                                      <a class="btn btn-inverse-success btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#acceptLetter{{ $pengajuan->id }}">
                                          <i class="mdi mdi-check-circle icon-sm me-1"></i> <span class="fw-semibold">Setujui</span>
                                      </a>
                                      {{-- Modal Accepted --}}
                                      <div class="modal fade" id="acceptLetter{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel">Setujui Pengajuan Surat</h1>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              Apakah anda yakin ingin menyetujui pengajuan surat ini? 
                                            </div>
                                            <div class="modal-footer">
                                              <form  method="POST" action="{{ route('pengajuanAccepted', [$pengajuan->id]) }}">
                                                @csrf
                                                  <button type="submit" class="btn btn-danger">Ya</button>
                                              </form>
                                              <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tidak</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div> 
                                      <a class="btn btn-inverse-danger btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#rejectLetter{{ $pengajuan->id }}">
                                          <i class="mdi mdi-close-circle icon-sm me-1"></i> <span class="fw-semibold">Tolak</span>
                                      </a>
                                      {{-- Modal Rejected --}}
                                      <div class="modal fade" id="rejectLetter{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel">Tolak Pengajuan Surat</h1>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              Apakah anda yakin ingin menolak pengajuan surat ini?
                                              <div class="row p-1">
                                                <p class="fw-semibold">Alasan penolakan: </p>
                                                <form method="POST" action="{{ route('pengajuanRejected', [$pengajuan->id]) }}">
                                                  <textarea name="keterangan" id="keterangan" cols="57" rows="8" style="border: 1px solid grey;" placeholder="Tidak memenuhi kriteria"></textarea>
                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                                @csrf
                                                  <button type="submit" class="btn btn-danger">Ya</button>
                                                </form>
                                              <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tidak</button>
                                            </div>
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
                  @if($ada == true)
                    <div class="container-fluid pt-3">
                      {{ $progress->appends(request()->except('progressTable'))->links('pagination::bootstrap-5') }}
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- Status Accepted --}}
        <div class="row">
          <!-- Table  -->
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-10">
                    <h4 class="card-title">List Pengajuan - <span class="text-success">Accepted</span></h4>
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
                        @foreach($accepted as $pengajuan)
                          @if($pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 2 && $pengajuan->jenisSurat_id == $filtered)
                            @php($ada = true)
                          @endif
                        @endforeach
                        
                        @foreach($accepted as $pengajuan)
                          @if($ada == true && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 2 && $pengajuan->jenisSurat_id == $filtered)
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
                                  <a class="btn btn-inverse-info btn-fw btn-sm btn-rounded d-inline-flex align-items-center" href="{{ route('pengajuanDetailKaprodi', [$pengajuan->id]) }}">
                                      <i class="mdi mdi-file-document icon-sm me-1"></i> <span class="fw-semibold">Lihat Detail</span>
                                  </a>
                                  <a class="btn btn-inverse-danger btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#rejectLetter{{ $pengajuan->id }}">
                                      <i class="mdi mdi-close-circle icon-sm me-1"></i> <span class="fw-semibold">Tolak</span>
                                  </a>
                                  {{-- Modal Rejected --}}
                                  <div class="modal fade" id="rejectLetter{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Tolak Pengajuan Surat</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          Apakah anda yakin ingin menolak pengajuan surat ini?
                                          <div class="row p-1">
                                            <p class="fw-semibold">Alasan penolakan: </p>
                                            <form method="POST" action="{{ route('pengajuanRejected', [$pengajuan->id]) }}">
                                              <textarea name="keterangan" id="keterangan" cols="57" rows="8" style="border: 1px solid grey;" placeholder="Tidak memenuhi kriteria"></textarea>
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                            @csrf
                                              <button type="submit" class="btn btn-danger">Ya</button>
                                            </form>
                                          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tidak</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>      
                                </div>
                              </td>
                            </tr> 
                          @endif
                        @endforeach
                      
                        @else
                          @foreach($accepted as $pengajuan)
                            @if($pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 2)
                              @php($ada = true)
                            @endif
                          @endforeach
                          
                          @foreach($accepted as $pengajuan)
                            @if($ada == true && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 2)
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
                                    <a class="btn btn-inverse-info btn-fw btn-sm btn-rounded d-inline-flex align-items-center" href="{{ route('pengajuanDetailKaprodi', [$pengajuan->id]) }}">
                                        <i class="mdi mdi-file-document icon-sm me-1"></i> <span class="fw-semibold">Lihat Detail</span>
                                    </a>
                                    <a class="btn btn-inverse-danger btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#rejectLetter{{ $pengajuan->id }}">
                                        <i class="mdi mdi-close-circle icon-sm me-1"></i> <span class="fw-semibold">Tolak</span>
                                    </a>
                                    {{-- Modal Rejected --}}
                                    <div class="modal fade" id="rejectLetter{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tolak Pengajuan Surat</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            Apakah anda yakin ingin menolak pengajuan surat ini?
                                            <div class="row p-1">
                                              <p class="fw-semibold">Alasan penolakan: </p>
                                              <form method="POST" action="{{ route('pengajuanRejected', [$pengajuan->id]) }}">
                                                <textarea name="keterangan" id="keterangan" cols="57" rows="8" style="border: 1px solid grey;" placeholder="Tidak memenuhi kriteria"></textarea>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                              @csrf
                                                <button type="submit" class="btn btn-danger">Ya</button>
                                              </form>
                                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tidak</button>
                                          </div>
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
                  @if($ada == true)
                    <div class="container-fluid pt-3">
                      {{ $accepted->appends(request()->except('acceptedTable'))->links('pagination::bootstrap-5') }}
                    </div>
                  @endif
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
                    <h4 class="card-title">List Pengajuan - <span class="text-danger">Rejected</span></h4>
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
                        @foreach($rejected as $pengajuan)
                          @if($pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 3 && $pengajuan->jenisSurat_id == $filtered)
                            @php($ada = true)
                          @endif
                        @endforeach
                        
                        @foreach($rejected as $pengajuan)
                          @if($ada == true && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 3 && $pengajuan->jenisSurat_id == $filtered)
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
                                  <a class="btn btn-inverse-info btn-fw btn-sm btn-rounded d-inline-flex align-items-center" href="{{ route('pengajuanDetailKaprodi', [$pengajuan->id]) }}">
                                      <i class="mdi mdi-file-document icon-sm me-1"></i> <span class="fw-semibold">Lihat Detail</span>
                                  </a>
                                  <a class="btn btn-inverse-success btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#acceptLetter{{ $pengajuan->id }}">
                                      <i class="mdi mdi-check-circle icon-sm me-1"></i> <span class="fw-semibold">Setujui</span>
                                  </a>
                                  {{-- Modal Accepted --}}
                                  <div class="modal fade" id="acceptLetter{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Setujui Pengajuan Surat</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          Apakah anda yakin ingin menyetujui pengajuan surat ini?
                                        </div>
                                        <div class="modal-footer">
                                          <form  method="POST" action="{{ route('pengajuanAccepted', [$pengajuan->id]) }}">
                                            @csrf
                                              <button type="submit" class="btn btn-danger">Ya</button>
                                          </form>
                                          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tidak</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>      
                                </div>
                              </td>
                            </tr> 
                          @endif
                        @endforeach
                      
                        @else
                          @foreach($rejected as $pengajuan)
                            @if($pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 3)
                              @php($ada = true)
                            @endif
                          @endforeach
                          
                          @foreach($rejected as $pengajuan)
                            @if($ada == true && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 3)
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
                                    <a class="btn btn-inverse-info btn-fw btn-sm btn-rounded d-inline-flex align-items-center" href="{{ route('pengajuanDetailKaprodi', [$pengajuan->id]) }}">
                                        <i class="mdi mdi-file-document icon-sm me-1"></i> <span class="fw-semibold">Lihat Detail</span>
                                    </a>
                                    <a class="btn btn-inverse-success btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#acceptLetter{{ $pengajuan->id }}">
                                        <i class="mdi mdi-check-circle icon-sm me-1"></i> <span class="fw-semibold">Setujui</span>
                                    </a>
                                    {{-- Modal Accepted --}}
                                    <div class="modal fade" id="acceptLetter{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Setujui Pengajuan Surat</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            Apakah anda yakin ingin menyetujui pengajuan surat ini? 
                                          </div>
                                          <div class="modal-footer">
                                            <form  method="POST" action="{{ route('pengajuanAccepted', [$pengajuan->id]) }}">
                                              @csrf
                                                <button type="submit" class="btn btn-danger">Ya</button>
                                            </form>
                                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tidak</button>
                                          </div>
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
                  @if($ada == true)
                    <div class="container-fluid pt-3">
                      {{ $rejected->appends(request()->except('rejectedTable'))->links('pagination::bootstrap-5') }}
                    </div>
                  @endif
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
                    <h4 class="card-title">List Pengajuan - <span class="text-info">Finished</span></h4>
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
                        @foreach($finished as $pengajuan)
                          @if($pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 4 && $pengajuan->jenisSurat_id == $filtered)
                            @php($ada = true)
                          @endif
                        @endforeach
                        
                        @foreach($finished as $pengajuan)
                          @if($ada == true && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 4 && $pengajuan->jenisSurat_id == $filtered)
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
                                  <a class="btn btn-inverse-info btn-fw btn-sm btn-rounded d-inline-flex align-items-center" href="{{ route('pengajuanDetailKaprodi', [$pengajuan->id]) }}">
                                      <i class="mdi mdi-file-document icon-sm me-1"></i> <span class="fw-semibold">Lihat Detail</span>
                                  </a>
                                  <a class="btn btn-inverse-success btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#acceptLetter{{ $pengajuan->id }}">
                                      <i class="mdi mdi-check-circle icon-sm me-1"></i> <span class="fw-semibold">Setujui</span>
                                  </a>
                                  {{-- Modal Accepted --}}
                                  <div class="modal fade" id="acceptLetter{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Setujui Pengajuan Surat</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          Apakah anda yakin ingin menyetujui pengajuan surat ini?
                                        </div>
                                        <div class="modal-footer">
                                          <form  method="POST" action="{{ route('pengajuanAccepted', [$pengajuan->id]) }}">
                                            @csrf
                                              <button type="submit" class="btn btn-danger">Ya</button>
                                          </form>
                                          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tidak</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div> 
                                  <a class="btn btn-inverse-danger btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#rejectLetter{{ $pengajuan->id }}">
                                      <i class="mdi mdi-close-circle icon-sm me-1"></i> <span class="fw-semibold">Tolak</span>
                                  </a>
                                  {{-- Modal Rejected --}}
                                  <div class="modal fade" id="rejectLetter{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Tolak Pengajuan Surat</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          Apakah anda yakin ingin menolak pengajuan surat ini?
                                        </div>
                                        <div class="modal-footer">
                                          <form  method="POST" action="{{ route('pengajuanRejected', [$pengajuan->id]) }}">
                                            @csrf
                                              <button type="submit" class="btn btn-danger">Ya</button>
                                          </form>
                                          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tidak</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>      
                                </div>
                              </td>
                            </tr> 
                          @endif
                        @endforeach
                      
                      @else
                          @foreach($finished as $pengajuan)
                            @if($pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 4)
                              @php($ada = true)
                            @endif
                          @endforeach
                          
                          @foreach($finished as $pengajuan)
                            @if($ada == true && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id && $pengajuan->pengajuanStatusPengajuan->id == 4)
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
                                    <a class="btn btn-inverse-info btn-fw btn-sm btn-rounded d-inline-flex align-items-center" href="{{ route('pengajuanDetailKaprodi', [$pengajuan->id]) }}">
                                        <i class="mdi mdi-file-document icon-sm me-1"></i> <span class="fw-semibold">Lihat Detail</span>
                                    </a>
                                    <a class="btn btn-inverse-success btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#acceptLetter{{ $pengajuan->id }}">
                                        <i class="mdi mdi-check-circle icon-sm me-1"></i> <span class="fw-semibold">Setujui</span>
                                    </a>
                                    {{-- Modal Accepted --}}
                                    <div class="modal fade" id="acceptLetter{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Setujui Pengajuan Surat</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            Apakah anda yakin ingin menyetujui pengajuan surat ini? 
                                          </div>
                                          <div class="modal-footer">
                                            <form  method="POST" action="{{ route('pengajuanAccepted', [$pengajuan->id]) }}">
                                              @csrf
                                                <button type="submit" class="btn btn-danger">Ya</button>
                                            </form>
                                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tidak</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div> 
                                    <a class="btn btn-inverse-danger btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#rejectLetter{{ $pengajuan->id }}">
                                        <i class="mdi mdi-close-circle icon-sm me-1"></i> <span class="fw-semibold">Tolak</span>
                                    </a>
                                    {{-- Modal Rejected --}}
                                    <div class="modal fade" id="rejectLetter{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tolak Pengajuan Surat</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            Apakah anda yakin ingin menolak pengajuan surat ini?
                                          </div>
                                          <div class="modal-footer">
                                            <form  method="POST" action="{{ route('pengajuanRejected', [$pengajuan->id]) }}">
                                              @csrf
                                                <button type="submit" class="btn btn-danger">Ya</button>
                                            </form>
                                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tidak</button>
                                          </div>
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
                  @if($ada == true)
                    <div class="container-fluid pt-3">
                      {{ $finished->appends(request()->except('finishedTable'))->links('pagination::bootstrap-5') }}
                    </div>
                  @endif
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
