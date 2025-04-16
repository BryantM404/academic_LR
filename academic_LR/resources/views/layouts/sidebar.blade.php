<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          {{-- Supeadmin Sidebar --}}
          @if(Auth::user()->role_id == 1)
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="mdi mdi-account-outline menu-icon"></i>
                <span class="menu-title">Manage User</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ route('userList') }}">List User</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('userCreate') }}">Add User</a></li>
                </ul>
              </div>
            </li>

          {{-- Kaprodi Sidebar --}}
          @elseif(Auth::user()->role_id == 2)
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="mdi mdi-email-outline menu-icon"></i>
                <span class="menu-title mt-1">Pengajuan Surat</span>
                <i class="menu-arrow mt-1"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ route('pengajuanListKaprodi') }}">List Pengajuan</a></li>
                </ul>
              </div>
            </li>

          {{-- Tata Usaha Sidebar --}}
          @elseif(Auth::user()->role_id == 3)

          
          {{-- Mahasiswa Sidebar --}}
          @elseif(Auth::user()->role_id == 4)
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="mdi mdi-email-outline menu-icon"></i>
                <span class="menu-title mt-1">Surat</span>
                <i class="menu-arrow mt-1"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ route('mahasiswaForm') }}">Pengajuan Surat</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('pengajuanList') }}">Histori Pengajuan</a></li>
                </ul>
              </div>
            </li>
          @endif


          
        </ul>
      </nav>