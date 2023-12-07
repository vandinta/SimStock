<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class BarangController extends Controller
{
    public function index()
    {
        $no = 1;
        $barang = Barang::all();
        return view('barang.index', compact('no', 'barang'));
    }

    public function show(Request $request, $id)
    {
        $barang = Barang::where('id', $id)->first();
        return view('barang.show', compact('barang'));
    }

    public function create()
    {
        return view('barang.tambah');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'kodebrg' => 'required|unique:tbl_barang|max:10',
                'namabrg' => 'required|max:100',
                'satuan' => 'required|max:10',
                'hargabeli' => 'required|numeric',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $barang = Barang::create([
            'kodebrg' => $request->kodebrg,
            'namabrg' => $request->namabrg,
            'satuan' => $request->satuan,
            'hargabeli' => $request->hargabeli,
        ]);

        if ($barang) {
            Session::flash('berhasil', 'Berhasil Menambah Barang');
            return redirect()->route('barang.index');
        }
        Session::flash('gagal', 'Gagal Menambah Barang');
        return redirect()->back();
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'namabrg' => 'required|max:100',
                'satuan' => 'required|max:10',
                'hargabeli' => 'required|numeric',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $barang->update($request->all());

        if ($barang) {
            Session::flash('berhasil', 'Berhasil Mengubah Barang');
            return redirect()->route('barang.index');
        }

        Session::flash('gagal', 'Gagal Mengubah Barang');
        return redirect()->back();
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();

        if ($barang) {
            Session::flash('berhasil', 'Berhasil Menghapus Barang');
            return redirect()->route('barang.index');
        }

        Session::flash('gagal', 'Gagal Menghapus Barang');
        return redirect()->back();
    }
}
