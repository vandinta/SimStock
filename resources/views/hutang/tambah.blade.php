@extends('layouts.template')

@section('content')
<div class="page-inner">
  <div class="page-header">
    <h4 class="page-title">Data Produk</h4>
    <ul class="breadcrumbs">
      <li class="nav-item">
        <a href="{{ route('product.index') }}">Data ProduK</a>
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
            <h4 class="card-title">Tambah Data Produk</h4>
            <div class="ml-auto">
            </div>
            <a href="{{ route('product.index') }}" type="button" class="btn btn-primary btn-round ml-2">kembali</a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 col-lg-12">
              <form action="{{ route('product.store') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="product_name">Nama Produk</label>
                  <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Nama Produk" value="{{ old('product_name') }}" autofocus>
                </div>
                <div class="form-group">
                  <label for="category">Kategori Produk</label>
                  <select class="form-control" id="category_id" name="category_id" autofocus>
                    <option value=""></option>
                    @foreach ($category as $ct)
                    <option value="<?= $ct['id'] ?>"><?= $ct['category'] ?></option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="price">Harga Produk</label>
                  <input type="number" class="form-control" id="price" name="price" placeholder="Harga Produk" value="{{ old('price') }}" autofocus>
                </div>
                <div class="form-group">
                  <label for="description">Deskripsi Produk</label>
                  <input type="text" class="form-control" id="description" name="description" placeholder="Deskripsi Produk" value="{{ old('description') }}" autofocus>
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