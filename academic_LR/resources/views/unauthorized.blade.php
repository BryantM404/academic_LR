@extends('layouts.index')

@section('content')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Error 401 - Unauthorized</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p>You are unauthorized to access this page!</p>
                  <a href="{{ route('dashboard') }}" class="Status">Back to Dashboard</a>
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