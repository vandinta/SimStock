@extends('layouts.template')

@section('content')
<div class="page-inner">
  <div class="page-header">
    <h4 class="page-title">Data Suplier</h4>
    <ul class="breadcrumbs">
      <li class="nav-item">
        <a href="{{ route('suplier.index') }}">Data Suplier</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      @if ($message = Session::get('berhasil'))
      <div class="alert alert-success" role="alert">
        <p>{{ $message }}</p>
      </div>
      @endif
      @if ($message = Session::get('gagal'))
      <div class="alert alert-danger" role="alert">
        <p>{{ $message }}</p>
      </div>
      @endif
      @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <div class="card">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <h4 class="card-title">Ubah Data Suplier</h4>
            <div class="ml-auto">
            </div>
            <a href="{{ route('suplier.index') }}" type="button" class="btn btn-primary btn-round ml-2"> kembali</a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 col-lg-12">
              <form action="{{ route('suplier.update', $suplier->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="kodespl">Kode Suplier</label>
                  <input type="text" class="form-control" id="kodespl" name="kodespl" placeholder="Kode Suplier" value="{{ $suplier->kodespl }}" readonly>
                </div>
                <div class="form-group">
                  <label for="namaspl">Nama Suplier</label>
                  <input type="text" class="form-control" id="namaspl" name="namaspl" placeholder="Nama Suplier" value="{{ $suplier->namaspl }}" autofocus>
                </div>
                <button type="submit" class="btn btn-outline-success float-right">Ubah</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection