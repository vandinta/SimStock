<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Barang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class StockController extends Controller
{
    public function index()
    {
        $no = 1;
        $stock = Stock::join('tbl_barang', 'tbl_stock.kodebrg', '=', 'tbl_barang.kodebrg')->select('tbl_stock.*', 'tbl_barang.namabrg')->get();
        return view('stock.index', compact('no', 'stock'));
    }

    public function show(Request $request, $id)
    {
        $stock = Stock::join('tbl_barang', 'tbl_stock.kodebrg', '=', 'tbl_barang.kodebrg')->where('tbl_stock.id', $id)->select('tbl_stock.*', 'tbl_barang.namabrg')->first();
        return view('stock.show', compact('stock'));
    }

    public function create()
    {
        $barang = Barang::all();
        return view('stock.tambah', compact('barang'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'kodebrg' => 'required|max:10',
                'qtybeli' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $stock = Stock::create([
            'kodebrg' => $request->kodebrg,
            'qtybeli' => $request->qtybeli,
        ]);

        if ($stock) {
            Session::flash('berhasil', 'Berhasil Menambah Stock');
            return redirect()->route('stock.index');
        }
        Session::flash('gagal', 'Gagal Menambah Stock');
        return redirect()->back();
    }

    public function edit(Stock $stock)
    {
        $barang = Barang::all();
        return view('stock.edit', compact('stock', 'barang'));
    }

    public function update(Request $request, Stock $stock)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'kodebrg' => 'required|max:10',
                'qtybeli' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $stock->update($request->all());

        if ($stock) {
            Session::flash('berhasil', 'Berhasil Mengubah Stock');
            return redirect()->route('stock.index');
        }

        Session::flash('gagal', 'Gagal Mengubah Stock');
        return redirect()->back();
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();

        if ($stock) {
            Session::flash('berhasil', 'Berhasil Menghapus Stock');
            return redirect()->route('stock.index');
        }

        Session::flash('gagal', 'Gagal Menghapus Stock');
        return redirect()->back();
    }
}
