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
      <div class="card">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <h4 class="card-title">Detail Hutang</h4>
            <div class="ml-auto">
            </div>
            <a href="{{ route('hutang.index') }}" type="button" class="btn btn-primary btn-round ml-2">Kembali</a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>No Transaksi :</strong>
                {{ $hutang->notransaksi }}
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Kode Suplier :</strong>
                {{ $hutang->kodespl }}
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Nama Suplier :</strong>
                {{ $hutang->namaspl }}
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Tanggal Beli :</strong>
                {{ $hutang->tglbeli }}
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Total Hutang :</strong>
                {{ $hutang->totalhutang }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection