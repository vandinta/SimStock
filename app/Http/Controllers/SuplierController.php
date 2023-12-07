<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suplier;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class SuplierController extends Controller
{
    public function index()
    {
        $no = 1;
        $suplier = Suplier::all();
        return view('suplier.index', compact('no', 'suplier'));
    }

    public function show(Request $request, $id)
    {
        $suplier = Suplier::where('id', $id)->first();
        return view('suplier.show', compact('suplier'));
    }

    public function create()
    {
        return view('suplier.tambah');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'kodespl' => 'required|unique:tbl_suplier|max:10',
                'namaspl' => 'required|max:100',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $suplier = Suplier::create([
            'kodespl' => $request->kodespl,
            'namaspl' => $request->namaspl
        ]);

        if ($suplier) {
            Session::flash('berhasil', 'Berhasil Menambah Suplier');
            return redirect()->route('suplier.index');
        }
        Session::flash('gagal', 'Gagal Menambah Suplier');
        return redirect()->back();
    }

    public function edit(Suplier $suplier)
    {
        return view('suplier.edit', compact('suplier'));
    }

    public function update(Request $request, Suplier $suplier)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'namaspl' => 'required|max:100',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $suplier->update($request->all());

        if ($suplier) {
            Session::flash('berhasil', 'Berhasil Mengubah Suplier');
            return redirect()->route('suplier.index');
        }

        Session::flash('gagal', 'Gagal Mengubah Suplier');
        return redirect()->back();
    }

    public function destroy(Suplier $suplier)
    {
        $suplier->delete();

        if ($suplier) {
            Session::flash('berhasil', 'Berhasil Menghapus Suplier');
            return redirect()->route('suplier.index');
        }

        Session::flash('gagal', 'Gagal Menghapus Suplier');
        return redirect()->back();
    }
}
