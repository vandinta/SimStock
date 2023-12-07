@extends('layouts.template')

@section('content')
<div class="page-inner">
  <div class="page-header">
    <h4 class="page-title">Data Stock</h4>
    <ul class="breadcrumbs">
      <li class="nav-item">
        <a href="{{ route('stock.index') }}">Data Stock</a>
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
            <h4 class="card-title">Tambah Data Stock</h4>
            <div class="ml-auto">
            </div>
            <a href="{{ route('stock.index') }}" type="button" class="btn btn-primary btn-round ml-2">kembali</a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 col-lg-12">
              <form action="{{ route('stock.store') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="kodebrg">Nama Barang</label>
                  <select class="form-control" id="kodebrg" name="kodebrg" autofocus>
                    <option value="">Pilih Nama Barang</option>
                    @foreach ($barang as $br)
                    <option value="<?= $br['kodebrg'] ?>"><?= $br['namabrg'] ?></option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="qtybeli">Jumlah Beli</label>
                  <input type="number" class="form-control" id="qtybeli" name="qtybeli" placeholder="Jumlah Beli" value="{{ old('qtybeli') }}" autofocus>
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