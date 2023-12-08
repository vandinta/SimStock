@extends('layouts.template')

@section('content')
<div class="page-inner">
  <div class="page-header">
    <h4 class="page-title">Data Hutang</h4>
    <ul class="breadcrumbs">
      <li class="nav-item">
        <a href="{{ route('hutang.index') }}">Data Hutang</a>
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
            <h4 class="card-title">Tambah Data Hutang</h4>
            <div class="ml-auto">
            </div>
            <a href="{{ route('hutang.index') }}" type="button" class="btn btn-primary btn-round ml-2">kembali</a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 col-lg-12">
              <form action="{{ route('hutang.store') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="notransaksi">No Transaksi</label>
                  <select class="form-control" id="notransaksi" name="notransaksi" autofocus>
                    <option value=""> Pilih No Transaksi </option>
                    @foreach ($pembelian as $pb)
                    <option value="<?= $pb['notransaksi'] ?>"><?= $pb['notransaksi'] ?></option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="kodespl">Suplier</label>
                  <select class="form-control" id="kodespl" name="kodespl" autofocus>
                    <option value=""> Pilih Suplier </option>
                    @foreach ($suplier as $sp)
                    <option value="<?= $sp['kodespl'] ?>"><?= $sp['namaspl'] ?></option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="tglbeli">Tanggal Beli</label>
                  <input type="date" class="form-control" id="tglbeli" name="tglbeli" placeholder="Tanggal Beli" value="{{ old('tglbeli') }}" autofocus>
                </div>
                <div class="form-group">
                  <label for="totalhutang">Total Hutang</label>
                  <input type="number" class="form-control" id="totalhutang" name="totalhutang" placeholder="Total Hutang" value="{{ old('totalhutang') }}" autofocus>
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