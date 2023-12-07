@extends('layouts.template')

@section('content')
<div class="page-inner">
  <div class="page-header">
    <h4 class="page-title">Data Barang</h4>
    <ul class="breadcrumbs">
      <li class="nav-item">
        <a href="{{ route('barang.index') }}">Data Barang</a>
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
            <h4 class="card-title">Tambah Data Barang</h4>
            <div class="ml-auto">
            </div>
            <a href="{{ route('barang.index') }}" type="button" class="btn btn-primary btn-round ml-2">kembali</a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 col-lg-12">
              <form action="{{ route('barang.store') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="kodebrg">Kode Barang</label>
                  <input type="text" class="form-control" id="kodebrg" name="kodebrg" placeholder="Kode Barang" value="{{ old('kodebrg') }}" autofocus>
                </div>
                <div class="form-group">
                  <label for="namabrg">Nama Barang</label>
                  <input type="text" class="form-control" id="namabrg" name="namabrg" placeholder="Nama Barang" value="{{ old('namabrg') }}" autofocus>
                </div>
                <div class="form-group">
                  <label for="satuan">Satuan</label>
                  <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan" value="{{ old('satuan') }}" autofocus>
                </div>
                <div class="form-group">
                  <label for="hargabeli">Harga Beli</label>
                  <input type="number" class="form-control" id="hargabeli" name="hargabeli" placeholder="Harga Barang" value="{{ old('hargabeli') }}" autofocus>
                </div>
                <button type="submit" class="btn btn-outline-success float-right">Tambah</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection