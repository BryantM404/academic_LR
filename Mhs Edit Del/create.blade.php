@extends('layouts.index')

@section('content')
  <div class="container">
    <div class="page-inner">
      <div
          class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
      >
        <div>
          <h3 class="fw-bold mb-3">Manage Data Mahasiswa</h3>
          <h6 class="op-7 mb-2">Free Bootstrap 5 Admin Halaman 1</h6>
        </div>
      </div>
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Add Data Mahasiswa</h4>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <form method="POST" action="{{ route('mahasiswaStore') }}">
                        @csrf
                    <div class="form-group">
                        <label for="nrp">NRP</label>
                        <input type="text" class="form-control" name="nrp" id="nrp" placeholder="e.g. 202472001" required autofocus maxlength="9" />
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="e.g. John Doe" required />
                    </div>
                    <div class="form-group">
                        <label for="birth_date">Birth Date</label>
                        <input type="date" class="form-control" name="birth_date" id="birth_date" required />
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="e.g. johndoe@email.com" required />
                    </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="e.g. Surya Sumantri 65" required />
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="e.g. 081234567" required />
                        </div>
                        <div class="form-group">
                            <label for="dosenWali">Dosen Wali</label>
                            <select class="form-control" name="dosen_nik" id="dosen_nik">
                                @foreach($dosens as $dosen)
                                <option value="{{ $dosen->nik }}">{{ $dosen->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="card-action">
                        <input type="submit" class="btn btn-success">
                        <input type="reset" value="Cancel" class="btn btn-danger">
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
  </div>
@endsection

@section('ExtraCss')

@endsection

@section('ExtraJS')

@endsection
