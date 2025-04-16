<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="">
          <img src="{{ asset ('images/Lettly (1).svg') }}" style="width: auto; height: 45px;" alt="logo"/>
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" style="max-height: 410px; overflow-y: auto;" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifikasi</p>
              @php($ada = false)

              @if(Auth::user()->role_id == 2)
              
                @foreach ($pengajuans as $pengajuan)
                  {{-- Menghitung Selisih Hari --}}
                  @php(date_default_timezone_set('Asia/Jakarta'))
                  @php($selisih = (new DateTime($pengajuan->tanggalPengajuan))->diff(new DateTime('today')))

                  @if($pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userKaprodi->prodi_id && $pengajuan->statusPengajuan_id == 1 && $selisih->days < 30)
                    @php($ada = true)
                    <a class="dropdown-item preview-item" href="{{ route('pengajuanListKaprodi') }}">
                      <div class="preview-item-content">
                        <div class="row">
                          <div class="col-9">
                            <h6 class="preview-subject fw-bold">Pengajuan Baru</h6>
                          </div>
                          <div class="col text-end" style="margin-top:-5px">
                            <p class="font-weight-light small-text mb-0 text-muted">
                              @if($selisih->days == 0)
                                Hari ini
                              @else
                                @php(print $selisih->days . " hari yang lalu")
                              @endif
                            </p>
                          </div>
                        </div>
                        <p>
                          Anda telah menerima pengajuan baru dari <span class="fw-semibold">{{ $pengajuan->pengajuanMahasiswa->nrp }} - {{ $pengajuan->pengajuanMahasiswa->nama }}</span>
                          untuk  <span class="fw-semibold">{{ $pengajuan->pengajuanJenisSurat->nama }}</span>
                        </p>
                        
                      </div>
                    </a>
                    <hr class="dropdown-divider">
                  @endif
                @endforeach
              
              @elseif(Auth::user()->role_id == 3)
                @foreach($pengajuans as $pengajuan)
                  @if($pengajuan->pengajuanMahasiswa->prodi_id == Auth::user()->userTataUsaha->prodi_id)
                    @php($ada = true)
                    @if($pengajuan->statusPengajuan_id == 2)
                      <a class="dropdown-item preview-item">
                        {{-- <div class="preview-thumbnail">
                          <div class="preview-icon bg-success">
                            <i class="ti-info-alt mx-0"></i>
                          </div>
                        </div> --}}
                        <div class="preview-item-content">
                          <h6 class="preview-subject fw-bold">Buat Surat</h6>
                          <p>
                            Pengajuan <span class="fw-semibold">{{ $pengajuan->pengajuanJenisSurat->nama }}</span> oleh 
                            <span class="fw-semibold">{{ $pengajuan->pengajuanMahasiswa->nrp }} - {{ $pengajuan->pengajuanMahasiswa->nama }}</span>
                            telah <span class="text-success">disetujui</span> oleh Kaprodi, silahkan buat suratnya.
                          </p>
                        </div>
                      </a>
                      <hr class="dropdown-divider">
                    @elseif($pengajuan->statusPengajuan_id == 3)
                      <a class="dropdown-item preview-item">
                        {{-- <div class="preview-thumbnail">
                          <div class="preview-icon bg-success">
                            <i class="ti-info-alt mx-0"></i>
                          </div>
                        </div> --}}
                        <div class="preview-item-content">
                          <h6 class="preview-subject fw-bold">Beri Alasan</h6>
                          <p>
                            Pengajuan <span class="fw-semibold">{{ $pengajuan->pengajuanJenisSurat->nama }}</span> oleh 
                            <span class="fw-semibold">{{ $pengajuan->pengajuanMahasiswa->nrp }} - {{ $pengajuan->pengajuanMahasiswa->nama }}</span>
                            telah <span class="text-danger">ditolak</span> oleh Kaprodi, silahkan kirim alasannya.
                          </p>
                        </div>
                      </a>
                      <hr class="dropdown-divider">
                    @endif
                  @endif
                @endforeach

              @elseif(Auth::user()->role_id == 4)

                {{-- @foreach($pengajuans as $pengajuan)
                  @if($pengajuan->mahasiswa_nrp == Auth::user()->userMahasiswa->id)
                      @php($ada = true)
                  @endif
                @endforeach --}}
                      
                @foreach($pengajuans as $pengajuan)
                  @if($pengajuan->mahasiswa_nrp == Auth::user()->userMahasiswa->id)
                    @php($ada = true)
                    @if($pengajuan->statusPengajuan_id == 2)
                      <a class="dropdown-item preview-item" href="{{ route('pengajuanList') }}">
                        <div class="preview-item-content">
                          <h6 class="preview-subject fw-bold">Pengajuan Diterima</h6>
                          <p>
                            Pengajuan <span class="fw-semibold">{{ $pengajuan->pengajuanJenisSurat->nama }}</span> anda
                            telah <span class="text-success">disetujui</span> oleh Kaprodi.
                          </p>
                        </div>
                      </a>
                      <hr class="dropdown-divider">
                      @elseif($pengajuan->statusPengajuan_id == 3)
                        <a class="dropdown-item preview-item" href="{{ route('pengajuanList') }}">
                          <div class="preview-item-content">
                            <h6 class="preview-subject fw-bold">Pengajuan Ditolak</h6>
                            <p>
                              Pengajuan <span class="fw-semibold">{{ $pengajuan->pengajuanJenisSurat->nama }}</span> anda
                              telah <span class="text-danger">ditolak</span> oleh Kaprodi.
                            </p>
                          </div>
                        </a>
                        <hr class="dropdown-divider">
                      @elseif($pengajuan->statusPengajuan_id == 4 && $pengajuan->keterangan == null)
                        <a class="dropdown-item preview-item" href="{{ route('pengajuanList') }}">
                          <div class="preview-item-content">
                            <h6 class="preview-subject fw-bold">Pengajuan Selesai</h6>
                            <p>
                              Pengajuan <span class="fw-semibold">{{ $pengajuan->pengajuanJenisSurat->nama }}</span> anda
                              telah <span class="text-info">selesai</span>, silahkan unduh surat anda.
                            </p>
                          </div>
                        </a>
                        <hr class="dropdown-divider">
                      @elseif($pengajuan->statusPengajuan_id == 4 && $pengajuan->keterangan != null)
                        <a class="dropdown-item preview-item" href="{{ route('pengajuanList') }}">
                          <div class="preview-item-content">
                            <h6 class="preview-subject fw-bold">Pengajuan Selesai</h6>
                            <p>
                              Pengajuan <span class="fw-semibold">{{ $pengajuan->pengajuanJenisSurat->nama }}</span> anda
                              telah <span class="text-info">selesai</span>, silahkan cek pengajuannya.
                            </p>
                          </div>
                        </a>
                        <hr class="dropdown-divider">
                    @endif
                  @endif
                @endforeach
                
              @endif
                
              @if($ada == false)
                  <a class="dropdown-item preview-item">
                    <div class="preview-item-content">
                      <h6 class="preview-subject fw-bold">Tidak Ada notifikasi</h6>
                      <p>
                        Tidak ada notifikasi baru saat ini.
                      </p>
                    </div>
                  </a>
                  <hr class="dropdown-divider">
              @endif

            
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{ asset('images/profile.png') }}" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="dropdown-item" type="submit">
                  <i class="ti-power-off text-primary"></i>
                  Logout
                </button>
              </form>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="icon-ellipsis"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>