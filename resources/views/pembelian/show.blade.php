@extends('layouts.template')

@section('content')
<div class="page-inner">
  <div class="page-header">
    <h4 class="page-title">Data Pembelian</h4>
    <ul class="breadcrumbs">
      <li class="nav-item">
        <a href="{{ route('pembelian.index') }}">Data Pembelian</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <h4 class="card-title">Detail Pembelian</h4>
            <div class="ml-auto">
            </div>
            <a href="{{ route('pembelian.index') }}" type="button" class="btn btn-primary btn-round ml-2">Kembali</a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <h3 style="margin-left: 20px;">Header Pembelian</h3>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>No Transaksi :</strong>
                {{ $pembelian->notransaksi }}
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Kode Suplier :</strong>
                {{ $pembelian->kodespl }}
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Nama Suplier :</strong>
                {{ $pembelian->namaspl }}
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Tanggal Transaksi :</strong>
                {{ $pembelian->tgl_beli }}
              </div>
            </div>
            <h3 style="margin-top: 15px; margin-left: 20px;">Detail Pembelian</h3>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Kode Barang :</strong>
                {{ $pembelian->kodebrg }}
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Nama Barang :</strong>
                {{ $pembelian->namabrg }}
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>QTY :</strong>
                {{ $pembelian->qty }}
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Diskon :</strong>
                {{ $pembelian->diskon }} %
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Diskon Rp :</strong>
                Rp. {{ $pembelian->diskonrp }} ,-
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Total Rp :</strong>
                Rp. {{ $pembelian->totalrp }} ,-
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection