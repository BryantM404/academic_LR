@extends('layouts.index')

@section('content')

<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  @if(Auth::user()->userRole->id == 1)
                    <h3 class="font-weight-bold">Welcome <span class="text-primary">{{ Auth::user()->username }}</span></h3>
                  @elseif(Auth::user()->userRole->id == 2)
                    <h3 class="font-weight-bold">Welcome <span class="text-primary">{{ Auth::user()->userKaprodi->nama }}</span></h3>
                  @elseif(Auth::user()->userRole->id == 3)
                    <h3 class="font-weight-bold">Welcome <span class="text-primary">{{ Auth::user()->userTataUsaha->nama }}</span></h3>
                  @elseif(Auth::user()->userRole->id == 4)
                    <h3 class="font-weight-bold">Welcome <span class="text-primary">{{ Auth::user()->userMahasiswa->nama }}</span></h3>
                  @endif
                  <h6 class="font-weight-normal mb-0">You are logged in as <span class="text-primary">{{ Auth::user()->userRole->nama }}</span></h6>
                </div>
              </div>
            </div>
          </div>

          @if (Auth::user()->userRole->id == 1)
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="row">
                  <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <p class="card-title">Data User berdasarkan Role</p>
                        <div class="charts-data ">
                          @foreach ($roles as $role)
                            @php
                              // Hitung jumlah user per role
                              $userCount = $role->roleUser->count(); // Menggunakan eager loading untuk menghitung
                            @endphp
                            <div class="mt-3">
                              <p class="mb-1">{{ $role->nama }}</p>
                            
                              <div class="d-flex justify-content-between align-items-center">
                                  <div class="progress progress-md flex-grow-1 mr-4">
                                    <div class="progress-bar bg-info " role="progressbar" 
                                        style="width: {{ ($userCount / $roles->max(function($r) { return $r->roleUser->count(); })) * 100 }}%" 
                                        aria-valuenow="{{ ($userCount / $roles->max(function($r) { return $r->roleUser->count(); })) * 100 }}" 
                                        aria-valuemin="0" 
                                        aria-valuemax="100">
                                    </div>
                                  </div>
                                <p class="mb-0">{{ $userCount }}</p>
                              </div>
                            </div>
                          @endforeach
                        </div>  
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- 
            @if(Auth::user()->userRole->id == 2)
              @php($no = 0)
              @foreach($pengajuans as $pengajuan)
                @if($pengajuan->statusPengajuan_id == 1 && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id)
                  @php($no++)
                @endif
              </div> --}}
          @elseif(Auth::user()->userRole->id == 2 || Auth::user()->userRole->id == 3)
            <div class="row">
              @if(Auth::user()->userRole->id == 2)
                @php($noSurat = 0)
                @php($no = 0)
                @foreach($pengajuans as $pengajuan)
                  @if($pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id)
                  @php($noSurat++)
                    @if($pengajuan->statusPengajuan_id == 1)
                      @php($no++)
                    @endif
                  @endif
                @endforeach
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Anda memiliki</p>
                      <p class="fs-30 mb-2"><span class="text-warning fw-bold">{{ $no }}</span></p>
                      <p>pengajuan yang <span class="text-warning">belum diselesaikan</span></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Terdapat total</p>
                      <p class="fs-30 mb-2"><span class="text-warning fw-bold">{{ $noSurat }}</span></p>
                      <p>pengajuan yang sudah diajukan </p>
                    </div>
                  </div>
                </div>
              @elseif(Auth::user()->userRole->id == 3)
                @php($noSurat = 0)
                @php($noAccepted = 0)
                @php($noRejected = 0)
                @foreach($pengajuans as $pengajuan)
                  @if($pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id)
                  @php($noSurat++)
                    @if($pengajuan->statusPengajuan_id == 2)
                      @php($noAccepted++)
                    @elseif($pengajuan->statusPengajuan_id == 3)
                      @php($noRejected++)
                    @endif
                  @endif
                @endforeach
                <div class="col-md-4 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Anda memiliki</p>
                      <p class="fs-30 mb-2"><span class="text-warning fw-bold">{{ $noAccepted }}</span></p>
                      <p>surat yang <span class="text-warning">belum dibuat</span></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 mb-4 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Anda memiliki</p>
                      <p class="fs-30 mb-2"><span class="text-warning fw-bold">{{ $noRejected }}</span></p>
                      <p>pengajuan yang <span class="text-warning">belum mendapat alasan</span></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Terdapat total</p>
                      <p class="fs-30 mb-2"><span class="text-warning fw-bold">{{ $noSurat }}</span></p>
                      <p>pengajuan yang sudah diajukan </p>
                    </div>
                  </div>
                </div>
              @endif
            <div class="row">
              {{-- By Status --}}
              <div class="col grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <p class="card-title">Total Surat - <span class="text-primary">By Status</span></p>
                    <div class="charts-data">
                      @if(Auth::user()->userRole->id == 2)
                        {{-- In Progress --}}
                        <div class="mt-3">
                          <p class="mb-0">In Progress</p>
                          @php($nostatus1 = 0)
                          @php($nostatustotal1 = 0)
                          @foreach($pengajuans as $pengajuan)
                            @php($nostatustotal1++)
                            @if($pengajuan->statusPengajuan_id == 1 && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id)
                              @php($nostatus1++)
                            @endif
                          @endforeach
                            @php($widthstatus1 = $nostatus1 * 100 / $nostatustotal1)
                            <div class="d-flex justify-content-between align-items-center">
                              <div class="progress progress-md flex-grow-1 mr-4">
                                <div class="progress-bar bg-inf0" role="progressbar" style="width: {{ $widthstatus1 }}%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <p class="mb-0">
                                {{ $nostatus1 }}
                              </p>
                            </div>
                          </div>
                          {{-- Accepted --}}
                          <div class="mt-3">
                            <p class="mb-0">Accepted</p>
                              @php($nostatus2 = 0)
                              @php($nostatustotal2 = 0)
                              @foreach($pengajuans as $pengajuan)
                                @php($nostatustotal2++)
                                @if($pengajuan->statusPengajuan_id == 2 && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id)
                                  @php($nostatus2++)
                                @endif
                              @endforeach
                            @php($widthstatus2 = $nostatus2 * 100 / $nostatustotal2)
                            <div class="d-flex justify-content-between align-items-center">
                              <div class="progress progress-md flex-grow-1 mr-4">
                                <div class="progress-bar bg-inf0" role="progressbar" style="width: {{ $widthstatus2 }}%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <p class="mb-0">
                                {{ $nostatus2 }}
                              </p>
                            </div>
                          </div>
                          {{-- Rejected --}}
                          <div class="mt-3">
                            <p class="mb-0">Rejected</p>
                              @php($nostatus3 = 0)
                              @php($nostatustotal3 = 0)
                              @foreach($pengajuans as $pengajuan)
                                @php($nostatustotal3++)
                                @if($pengajuan->statusPengajuan_id == 3 && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id)
                                  @php($nostatus3++)
                                @endif
                              @endforeach
                            @php($widthstatus3 = $nostatus3 * 100 / $nostatustotal3)
                            <div class="d-flex justify-content-between align-items-center">
                              <div class="progress progress-md flex-grow-1 mr-4">
                                <div class="progress-bar bg-inf0" role="progressbar" style="width: {{ $widthstatus3 }}%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <p class="mb-0">
                                {{ $nostatus3 }}
                              </p>
                            </div>
                          </div>
                          {{-- Finished --}}
                          <div class="mt-3">
                            <p class="mb-0">Finished</p>
                              @php($nostatus4 = 0)
                              @php($nostatustotal4 = 0)
                              @foreach($pengajuans as $pengajuan)
                                @php($nostatustotal4++)
                                @if($pengajuan->statusPengajuan_id == 4 && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id)
                                  @php($nostatus4++)
                                @endif
                              @endforeach
                            @php($widthstatus4 = $nostatus4 * 100 / $nostatustotal4)
                            <div class="d-flex justify-content-between align-items-center">
                              <div class="progress progress-md flex-grow-1 mr-4">
                                <div class="progress-bar bg-inf0" role="progressbar" style="width: {{ $widthstatus4 }}%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <p class="mb-0">
                                {{ $nostatus4 }}
                              </p>
                            </div>
                          </div>
                      @elseif(Auth::user()->userRole->id == 3)
                          {{-- In Progress --}}
                        <div class="mt-3">
                          <p class="mb-0">In Progress</p>
                          @php($nostatus1 = 0)
                          @php($nostatustotal1 = 0)
                          @foreach($pengajuans as $pengajuan)
                            @php($nostatustotal1++)
                            @if($pengajuan->statusPengajuan_id == 1 && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id)
                              @php($nostatus1++)
                            @endif
                          @endforeach
                            @php($widthstatus1 = $nostatus1 * 100 / $nostatustotal1)
                            <div class="d-flex justify-content-between align-items-center">
                              <div class="progress progress-md flex-grow-1 mr-4">
                                <div class="progress-bar bg-inf0" role="progressbar" style="width: {{ $widthstatus1 }}%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <p class="mb-0">
                                {{ $nostatus1 }}
                              </p>
                            </div>
                          </div>
                          {{-- Accepted --}}
                          <div class="mt-3">
                            <p class="mb-0">Accepted</p>
                              @php($nostatus2 = 0)
                              @php($nostatustotal2 = 0)
                              @foreach($pengajuans as $pengajuan)
                                @php($nostatustotal2++)
                                @if($pengajuan->statusPengajuan_id == 2 && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id)
                                  @php($nostatus2++)
                                @endif
                              @endforeach
                            @php($widthstatus2 = $nostatus2 * 100 / $nostatustotal2)
                            <div class="d-flex justify-content-between align-items-center">
                              <div class="progress progress-md flex-grow-1 mr-4">
                                <div class="progress-bar bg-inf0" role="progressbar" style="width: {{ $widthstatus2 }}%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <p class="mb-0">
                                {{ $nostatus2 }}
                              </p>
                            </div>
                          </div>
                          {{-- Rejected --}}
                          <div class="mt-3">
                            <p class="mb-0">Rejected</p>
                              @php($nostatus3 = 0)
                              @php($nostatustotal3 = 0)
                              @foreach($pengajuans as $pengajuan)
                                @php($nostatustotal3++)
                                @if($pengajuan->statusPengajuan_id == 3 && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id)
                                  @php($nostatus3++)
                                @endif
                              @endforeach
                            @php($widthstatus3 = $nostatus3 * 100 / $nostatustotal3)
                            <div class="d-flex justify-content-between align-items-center">
                              <div class="progress progress-md flex-grow-1 mr-4">
                                <div class="progress-bar bg-inf0" role="progressbar" style="width: {{ $widthstatus3 }}%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <p class="mb-0">
                                {{ $nostatus3 }}
                              </p>
                            </div>
                          </div>
                          {{-- Finished --}}
                          <div class="mt-3">
                            <p class="mb-0">Finished</p>
                              @php($nostatus4 = 0)
                              @php($nostatustotal4 = 0)
                              @foreach($pengajuans as $pengajuan)
                                @php($nostatustotal4++)
                                @if($pengajuan->statusPengajuan_id == 4 && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id)
                                  @php($nostatus4++)
                                @endif
                              @endforeach
                            @php($widthstatus4 = $nostatus4 * 100 / $nostatustotal4)
                            <div class="d-flex justify-content-between align-items-center">
                              <div class="progress progress-md flex-grow-1 mr-4">
                                <div class="progress-bar bg-inf0" role="progressbar" style="width: {{ $widthstatus4 }}%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <p class="mb-0">
                                {{ $nostatus4 }}
                              </p>
                            </div>
                          </div>
                      @endif
                    </div>  
                  </div>
                </div>
              </div>
              {{-- By Jenis --}}
              <div class="col grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <p class="card-title">Total Surat - <span class="text-primary">By Jenis</span></p>
                    <div class="charts-data">
                      @if(Auth::user()->userRole->id == 2)
                        {{-- In Progress --}}
                        <div class="mt-3">
                          <p class="mb-0">Surat Keterangan Mahasiswa Aktif</p>
                            @php($nojenis1 = 0)
                            @php($nojenistotal1 = 0)
                            @foreach($pengajuans as $pengajuan)
                              @php($nojenistotal1++)
                              @if($pengajuan->jenisSurat_id == 1 && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id)
                                @php($nojenis1++)
                              @endif
                            @endforeach
                          @php($widthjenis1 = $nojenis1 * 100 / $nojenistotal1)
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-inf0" role="progressbar" style="width: {{ $widthjenis1 }}%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">
                              {{ $nojenis1 }}
                            </p>
                          </div>
                        </div>
                        {{-- Accepted --}}
                        <div class="mt-3">
                          <p class="mb-0">Surat Pengantar Tugas Mata Kuliah</p>
                            @php($nojenis2 = 0)
                            @php($nojenistotal2 = 0)
                            @foreach($pengajuans as $pengajuan)
                              @php($nojenistotal2++)
                              @if($pengajuan->jenisSurat_id == 2 && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id)
                                @php($nojenis2++)
                              @endif
                            @endforeach
                          @php($widthjenis2 = $nojenis2 * 100 / $nojenistotal2)
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-inf0" role="progressbar" style="width: {{ $widthjenis2 }}%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">
                              {{ $nojenis2 }}
                            </p>
                          </div>
                        </div>
                        {{-- Rejected --}}
                        <div class="mt-3">
                          <p class="mb-0">Surat Keterangan Lulus</p>
                            @php($nojenis3 = 0)
                            @php($nojenistotal3 = 0)
                            @foreach($pengajuans as $pengajuan)
                              @php($nojenistotal3++)
                              @if($pengajuan->jenisSurat_id == 3 && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id)
                                @php($nojenis3++)
                              @endif
                            @endforeach
                          @php($widthjenis3 = $nojenis3 * 100 / $nojenistotal3)
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-inf0" role="progressbar" style="width: {{ $widthjenis3 }}%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">
                              {{ $nojenis3 }}
                            </p>
                          </div>
                        </div>
                        {{-- Finished --}}
                        <div class="mt-3">
                          <p class="mb-0">Surat Laporan Hasil Studi</p>
                            @php($nojenis4 = 0)
                            @php($nojenistotal4 = 0)
                            @foreach($pengajuans as $pengajuan)
                              @php($nojenistotal4++)
                              @if($pengajuan->jenisSurat_id == 4 && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id)
                                @php($nojenis4++)
                              @endif
                            @endforeach
                          @php($widthjenis4 = $nojenis4 * 100 / $nojenistotal4)
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-inf0" role="progressbar" style="width: {{ $widthjenis4 }}%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">
                              {{ $nojenis4 }}
                            </p>
                          </div>
                        </div>
                      @elseif(Auth::user()->userRole->id == 3)
                          {{-- In Progress --}}
                        <div class="mt-3">
                          <p class="mb-0">Surat Keterangan Mahasiswa Aktif</p>
                            @php($nojenis1 = 0)
                            @php($nojenistotal1 = 0)
                            @foreach($pengajuans as $pengajuan)
                              @php($nojenistotal1++)
                              @if($pengajuan->jenisSurat_id == 1 && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id)
                                @php($nojenis1++)
                              @endif
                            @endforeach
                          @php($widthjenis1 = $nojenis1 * 100 / $nojenistotal1)
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-inf0" role="progressbar" style="width: {{ $widthjenis1 }}%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">
                              {{ $nojenis1 }}
                            </p>
                          </div>
                        </div>
                        {{-- Accepted --}}
                        <div class="mt-3">
                          <p class="mb-0">Surat Pengantar Tugas Mata Kuliah</p>
                            @php($nojenis2 = 0)
                            @php($nojenistotal2 = 0)
                            @foreach($pengajuans as $pengajuan)
                              @php($nojenistotal2++)
                              @if($pengajuan->jenisSurat_id == 2 && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id)
                                @php($nojenis2++)
                              @endif
                            @endforeach
                          @php($widthjenis2 = $nojenis2 * 100 / $nojenistotal2)
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-inf0" role="progressbar" style="width: {{ $widthjenis2 }}%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">
                              {{ $nojenis2 }}
                            </p>
                          </div>
                        </div>
                        {{-- Rejected --}}
                        <div class="mt-3">
                          <p class="mb-0">Surat Keterangan Lulus</p>
                            @php($nojenis3 = 0)
                            @php($nojenistotal3 = 0)
                            @foreach($pengajuans as $pengajuan)
                              @php($nojenistotal3++)
                              @if($pengajuan->jenisSurat_id == 3 && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id)
                                @php($nojenis3++)
                              @endif
                            @endforeach
                          @php($widthjenis3 = $nojenis3 * 100 / $nojenistotal3)
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-inf0" role="progressbar" style="width: {{ $widthjenis3 }}%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">
                              {{ $nojenis3 }}
                            </p>
                          </div>
                        </div>
                        {{-- Finished --}}
                        <div class="mt-3">
                          <p class="mb-0">Surat Laporan Hasil Studi</p>
                            @php($nojenis4 = 0)
                            @php($nojenistotal4 = 0)
                            @foreach($pengajuans as $pengajuan)
                              @php($nojenistotal4++)
                              @if($pengajuan->jenisSurat_id == 4 && $pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id)
                                @php($nojenis4++)
                              @endif
                            @endforeach
                          @php($widthjenis4 = $nojenis4 * 100 / $nojenistotal4)
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-inf0" role="progressbar" style="width: {{ $widthjenis4 }}%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">
                              {{ $nojenis4 }}
                            </p>
                          </div>
                        </div>
                      @endif
                    </div>  
                  </div>
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