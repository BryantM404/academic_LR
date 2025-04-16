@extends('layouts.index')

@section('content')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Histori Pengajuan Surat</h3>
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
                      <h4 class="card-title">List Pengajuan</h4>
                    </div>
                    <div class="col">
                      <div class="btn-group">
                        <button class="btn btn-primary btn-md dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Filter Surat
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{ route('pengajuanList') }}">Semua Surat</a></li>
                          <li><a class="dropdown-item" href="{{ route('pengajuanFilter1') }}">Surat Keterangan Mahasiswa Aktif</a></li>
                          <li><a class="dropdown-item" href="{{ route('pengajuanFilter2') }}">Surat Pengantar Tugas Mata Kuliah</a></li>
                          <li><a class="dropdown-item" href="{{ route('pengajuanFilter3') }}">Surat Keterangan Lulus</a></li>
                          <li><a class="dropdown-item" href="{{ route('pengajuanFilter4') }}">Surat Laporan Hasil Studi</a></li>
                        </ul>
                      </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-hover" >
                      <thead>
                        <tr>
                          <th>
                            No
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

                        {{-- Filtered Surat --}}
                        @if($filtered != null)
                          @foreach($pengajuans as $pengajuan)
                            @if($pengajuan->mahasiswa_nrp == Auth::user()->userMahasiswa->id && $pengajuan->jenisSurat_id == $filtered)
                              @php($ada = true)
                            @endif
                          @endforeach
                          
                          @foreach($pengajuans as $pengajuan)
                            @if($ada == true && $pengajuan->mahasiswa_nrp == Auth::user()->userMahasiswa->id && $pengajuan->jenisSurat_id == $filtered)
                              <tr>
                                <td>
                                  {{ $no++ }}
                                </td>
                                <td>
                                  {{ $pengajuan->pengajuanJenisSurat->nama}}
                                </td>
                                <td>
                                  {{ $pengajuan->tanggalPengajuan}}
                                </td>
                                <td>
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
                                <td>
                                  <div class="container d-flex flex-wrap gap-2">
                                    <a class="btn btn-inverse-info btn-fw btn-sm btn-rounded d-inline-flex align-items-center" href="{{ route('pengajuanDetail', [$pengajuan->id]) }}">
                                        <i class="mdi mdi-file-document icon-sm me-1"></i> <span class="fw-semibold">Lihat Detail</span>
                                    </a>
                                    @if($pengajuan->pengajuanStatusPengajuan->id == 1)
                                      <a class="btn btn-inverse-warning btn-fw btn-sm btn-rounded d-inline-flex align-items-center" href="{{ route('pengajuanEdit', [$pengajuan->id]) }}">
                                          <i class="mdi mdi-eraser icon-sm me-1"></i> <span class="fw-semibold">Edit</span>
                                      </a>
                                      <a class="btn btn-inverse-danger btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#deleteUser">
                                          <i class="mdi mdi-close-circle icon-sm me-1"></i> <span class="fw-semibold">Batalkan</span>
                                      </a>
                                      {{-- Modal Delete --}}
                                      <div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel">Tolak</h1>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              Apakah anda yakin ingin menolak pengajuan surat ini?
                                            </div>
                                            <div class="modal-footer">
                                              <form  method="POST" action="{{ route('pengajuanDelete', [$pengajuan->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                  <button type="submit" class="btn btn-danger">Ya</button>
                                              </form>
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div> 
                                    @elseif($pengajuan->pengajuanStatusPengajuan->id == 4)
                                      <a class="btn btn-inverse-primary btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#responsMhs{{ $pengajuan->id }}">
                                        <i class="mdi mdi-file-document icon-sm me-1"></i> <span class="fw-semibold">Lihat Respon</span>
                                      </a>
                                      <div class="modal fade" id="responsMhs{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    @endif
                                  </div>
                                </td>
                              </tr>
                            @endif
                          @endforeach
                        @else
                          @foreach($pengajuans as $pengajuan)
                            @if($pengajuan->mahasiswa_nrp == Auth::user()->userMahasiswa->id)
                              @php($ada = true)
                            @endif
                          @endforeach
                      
                          @foreach($pengajuans as $pengajuan)
                            @if($ada == true && $pengajuan->mahasiswa_nrp == Auth::user()->userMahasiswa->id)
                              <tr>
                                <td>
                                  {{ $no++ }}
                                </td>
                                <td>
                                  {{ $pengajuan->pengajuanJenisSurat->nama}}
                                </td>
                                <td>
                                  {{ $pengajuan->tanggalPengajuan}}
                                </td>
                                <td>
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
                                <td>
                                  <div class="container d-flex flex-wrap gap-2">
                                    <a class="btn btn-inverse-info btn-fw btn-sm btn-rounded d-inline-flex align-items-center" href="{{ route('pengajuanDetail', [$pengajuan->id]) }}">
                                        <i class="mdi mdi-file-document icon-sm me-1"></i> <span class="fw-semibold">Lihat Detail</span>
                                    </a>
                                    @if($pengajuan->pengajuanStatusPengajuan->id == 1)
                                      <a class="btn btn-inverse-warning btn-fw btn-sm btn-rounded d-inline-flex align-items-center" href="{{ route('pengajuanEdit', [$pengajuan->id]) }}">
                                          <i class="mdi mdi-eraser icon-sm me-1"></i> <span class="fw-semibold">Edit</span>
                                      </a>
                                      <a class="btn btn-inverse-danger btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#deleteUser">
                                          <i class="mdi mdi-close-circle icon-sm me-1"></i> <span class="fw-semibold">Batalkan</span>
                                      </a>
                                      {{-- Modal Delete --}}
                                      <div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel">Tolak</h1>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              Apakah anda yakin ingin menolak pengajuan surat ini?
                                            </div>
                                            <div class="modal-footer">
                                              <form  method="POST" action="{{ route('pengajuanDelete', [$pengajuan->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                  <button type="submit" class="btn btn-danger">Ya</button>
                                              </form>
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div> 
                                    @elseif($pengajuan->pengajuanStatusPengajuan->id == 4)
                                      <a class="btn btn-inverse-primary btn-fw btn-sm btn-rounded d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#responsMhs{{ $pengajuan->id }}">
                                        <i class="mdi mdi-clipboard-account icon-sm me-1"></i> <span class="fw-semibold">Lihat Respon</span>
                                      </a>
                                      <div class="modal fade" id="responsMhs{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-4" id="exampleModalLabel">Respons Pengajuan Surat</h1>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                              <div class="modal-body bg-light">
                                  
                                                  {{-- File PDF --}}
                                                <div class="mb-3">
                                                  <h5 class="fw-semibold mb-3">File Dokumen: </h5>
                                                  @if ($pengajuan->dokumen)
                                                    <div class="mb-3">
                                                      <embed src="{{ asset('storage/uploads/' . $pengajuan->dokumen) }}" type="application/pdf" width="100%" height="400px"/>
                                                    </div>
                                                    <div class="mb-3 text-center">
                                                      <a href="{{ asset('storage/uploads/' . $pengajuan->dokumen) }}" class="btn btn-outline-primary" download>
                                                        <i class="bi bi-download"></i> Download Dokumen
                                                      </a>
                                                    </div>
                                                @else
                                                  <p class="text-muted fst-italic">Tidak ada dokumen yang dilampirkan.</p>
                                                @endif
                                                </div>
                                                @if ($pengajuan->keterangan)
                                                  <div class="bg-white p-3 rounded-3 shadow-sm">
                                                    <h6 class="fw-semibold">Keterangan:</h6>
                                                    <p class="mb-0 text-secondary">{{ $pengajuan->keterangan }}</p>
                                                  </div>
                                                @endif
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Kembali</button>
                                              </div>
                                            
                                          </div>
                                        </div>
                                      </div> 
                                    @endif
                                    {{-- Modal Respons --}}
                                    
                                  </div>
                                </td>
                              </tr>
                            @endif
                          @endforeach
                        @endif

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




                                  {{-- <div class="col-3">
                                    <a type="button" class="btn btn-inverse-warning btn-fw btn-sm d-flex align-items-center justify-center btn-rounded" href="{{ route('pengajuanDetail', [$pengajuan->id]) }}">
                                      <i class="mdi mdi-file-document icon-sm"></i>
                                      <span><span class="mdi mdi-file-document icon-sm"></span>Lihat Detail</span>
                                    </a>
                                  </div> --}}
                                  {{-- <div class="col-3">
                                    <a type="button" class="btn btn-inverse-warning btn-fw btn-sm d-flex align-items-center btn-rounded" href="{{ route('pengajuanEdit', [$pengajuan->id]) }}">
                                      <i class="mdi mdi-pencil icon-sm"></i> <span>edit</span>
                                    </a>
                                  </div> --}}