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
            <h4 class="card-title">Tambah Data Pembelian</h4>
            <div class="ml-auto">
            </div>
            <a href="{{ route('pembelian.index') }}" type="button" class="btn btn-primary btn-round ml-2">kembali</a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 col-lg-12">
              <form action="{{ route('pembelian.store') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="kodespl">Nama Suplier</label>
                  <select class="form-control" id="kodespl" name="kodespl" autofocus>
                    <option value="">Pilih Nama Suplier</option>
                    @foreach ($suplier as $sp)
                    <option value="<?= $sp['kodespl'] ?>"><?= $sp['namaspl'] ?></option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="kodebrg">Nama Barang</label>
                  <select class="form-control" id="kodebrg" name="kodebrg" onchange="Hitung(this);" autofocus>
                    <option value="">Pilih Nama Barang</option>
                    @foreach ($barang as $br)
                    <option data-harga="<?= $br['hargabeli'] ?>" value="<?= $br['kodebrg'] ?>"><?= $br['namabrg'] ?></option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="hargabeli">Harga Satuan</label>
                  <input type="text" class="form-control" id="hargabeli" name="hargabeli" placeholder="Harga Satuan" value="{{ old('hargabeli') }}" readonly>
                </div>
                <div class="form-group">
                  <label for="qty">Jumlah Beli</label>
                  <input type="number" class="form-control" id="qty" name="qty" placeholder="Jumlah Beli" onchange="Hitung(this);" value="{{ old('qty') }}" autofocus>
                </div>
                <div class="form-group">
                  <label for="total">Harga</label>
                  <input type="number" class="form-control" id="total" name="total" placeholder="Total Harga" value="{{ old('total') }}" readonly>
                </div>
                <div class="form-group">
                  <label for="diskon">Diskon</label>
                  <input type="number" class="form-control" id="diskon" name="diskon" placeholder="Diskon" onchange="Hitung(this);" value="{{ old('diskon') }}" autofocus>
                </div>
                <div class="form-group">
                  <label for="diskonrp">Potongan Harga</label>
                  <input type="number" class="form-control" id="diskonrp" name="diskonrp" placeholder="Potongan Harga" value="{{ old('diskonrp') }}" readonly>
                </div>
                <div class="form-group">
                  <label for="totalrp">Total Harga</label>
                  <input type="number" class="form-control" id="totalrp" name="totalrp" placeholder="Total Harga" value="{{ old('totalrp') }}" readonly>
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

@section('content_js')
<script>
  function Hitung(v) {
    var harga = $('#kodebrg option:selected').data('harga');
    var jumlah = $("#qty").val();
    var diskon = $("#diskon").val();

    var total = jumlah * harga;
    var diskonrp = total * diskon/100;
    var totalharga = total - diskonrp;

    $('#hargabeli').val(harga);
    $('#total').val(total);
    $('#diskonrp').val(diskonrp);
    $('#totalrp').val(totalharga);
  }
</script>
@endsection