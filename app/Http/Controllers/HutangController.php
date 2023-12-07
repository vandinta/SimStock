<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Hutang;
use App\Models\Suplier;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class HutangController extends Controller
{
    public function index()
    {
        $no = 1;
        $hutang = Hutang::join('tbl_suplier', 'tbl_hutang.kodespl', '=', 'tbl_suplier.kodespl')->select('tbl_hutang.*', 'tbl_suplier.namaspl')->get();
        return view('hutang.index', compact('no', 'hutang'));
    }

    public function show(Request $request, $id)
    {
        $hutang = Hutang::join('tbl_suplier', 'tbl_hutang.kodespl', '=', 'tbl_suplier.kodespl')->where('tbl_hutang.id', $id)->select('tbl_hutang.*', 'tbl_suplier.namaspl')->first();

        $tgl = Carbon::parse($hutang['tglbeli']);
        $formattedDate = $tgl->format('d F Y');

        $hutang['tglbeli'] = $formattedDate;
        return view('hutang.show', compact('hutang'));
    }

    public function create()
    {
        $suplier = Suplier::all();
        return view('hutang.tambah', compact('suplier'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'notransaksi' => 'required',
                'kodespl' => 'required',
                'tglbeli' => 'required',
                'totalhutang' => 'required|numeric',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $hutang = Hutang::create([
            'notransaksi' => $request->notransaksi,
            'kodespl' => $request->kodespl,
            'tglbeli' => $request->tglbeli,
            'totalhutang' => $request->totalhutang,
        ]);

        if ($hutang) {
            Session::flash('berhasil', 'Berhasil Menambah Hutang');
            return redirect()->route('hutang.index');
        }
        Session::flash('gagal', 'Gagal Menambah Hutang');
        return redirect()->back();
    }

    public function edit(Hutang $hutang)
    {
        $suplier = Suplier::all();
        return view('hutang.edit', compact('hutang', 'suplier'));
    }

    public function update(Request $request, hutang $hutang)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'notransaksi' => 'required',
                'kodespl' => 'required',
                'tglbeli' => 'required',
                'totalhutang' => 'required|numeric',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $hutang->update($request->all());

        if ($hutang) {
            Session::flash('berhasil', 'Berhasil Mengubah Hutang');
            return redirect()->route('hutang.index');
        }

        Session::flash('gagal', 'Gagal Mengubah Hutang');
        return redirect()->back();
    }

    public function destroy(Hutang $hutang)
    {
        $hutang->delete();

        if ($hutang) {
            Session::flash('berhasil', 'Berhasil Menghapus Hutang');
            return redirect()->route('hutang.index');
        }

        Session::flash('gagal', 'Gagal Menghapus Hutang');
        return redirect()->back();
    }
}
