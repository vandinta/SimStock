<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pembelian;
use App\Models\Detailpembelian;
use App\Models\Suplier;
use App\Models\Barang;
use App\Models\Stock;
use App\Models\Hutang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class PembelianController extends Controller
{
    public function index()
    {
        $no = 1;
        $pembelian = Pembelian::join('tbl_suplier', 'tbl_hbeli.kodespl', '=', 'tbl_suplier.kodespl')->select('tbl_hbeli.*', 'tbl_suplier.namaspl')->get();
        return view('pembelian.index', compact('no', 'pembelian'));
    }

    public function show(Request $request, $id)
    {
        $pembelian = Pembelian::join('tbl_dbeli', 'tbl_hbeli.notransaksi', '=', 'tbl_dbeli.notransaksi')->join('tbl_suplier', 'tbl_hbeli.kodespl', '=', 'tbl_suplier.kodespl')->join('tbl_barang', 'tbl_dbeli.kodebrg', '=', 'tbl_barang.kodebrg')->where('tbl_hbeli.id', $id)->select('tbl_hbeli.kodespl', 'tbl_hbeli.tgl_beli', 'tbl_suplier.namaspl', 'tbl_barang.namabrg', 'tbl_dbeli.*')->first();

        $tgl = Carbon::parse($pembelian['tgl_beli']);
        $formattedDate = $tgl->format('d F Y');

        $pembelian['tgl_beli'] = $formattedDate;
        return view('pembelian.show', compact('pembelian'));
    }

    public function createPembelian()
    {
        $year = date('Y');
        $month = date('m');

        $pembelianTerakhir = Pembelian::where('notransaksi', 'like', "B$year$month%")->orderBy('id', 'desc')->first();

        $nomorterakhir = $pembelianTerakhir ? substr($pembelianTerakhir->notransaksi, -3) : 0;

        $nomorselanjutnya = str_pad($nomorterakhir + 1, 3, '0', STR_PAD_LEFT);

        $notransaksi = "B$year$month$nomorselanjutnya";

        return $notransaksi;
    }

    public function create()
    {
        $suplier = Suplier::all();
        $barang = Barang::all();
        return view('pembelian.tambah', compact('suplier', 'barang'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'kodespl' => 'required|max:10',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $notransaksi = $this->createPembelian();
        $tgl = Carbon::now();

        $pembelian = Pembelian::create([
            'notransaksi' => $notransaksi,
            'kodespl' => $request->kodespl,
            'tgl_beli' => $tgl,
        ]);
        
        $detailpembelian = DetailPembelian::create([
            'notransaksi' => $notransaksi,
            'kodebrg' => $request->kodebrg,
            'hargabeli' => $request->hargabeli,
            'qty' => $request->qty,
            'diskon' => $request->diskon,
            'diskonrp' => $request->diskonrp,
            'totalrp' => $request->totalrp,
        ]);

        $jumlahstock = Stock::where('kodebrg', $request->kodebrg)->first();

        $nilaiqty = $jumlahstock['qtybeli'] - $request->qty;

        $updatestock = Stock::where('kodebrg', $request->kodebrg)->update([
            'qtybeli' => $nilaiqty,
        ]);
        
        $hutang = Hutang::create([
            'notransaksi' => $notransaksi,
            'kodespl' => $request->kodespl,
            'tglbeli' => $tgl,
            'totalhutang' => $request->totalrp,
        ]);

        if ($pembelian && $detailpembelian && $updatestock && $hutang) {
            Session::flash('berhasil', 'Berhasil Menambah Pembelian');
            return redirect()->route('pembelian.index');
        }
        Session::flash('gagal', 'Gagal Menambah Pembelian');
        return redirect()->back();
    }

    public function edit(Pembelian $pembelian)
    {
        $suplier = Suplier::all();
        $barang = Barang::all();
        $id = $pembelian['notransaksi'];
        $dbeli = DetailPembelian::where('notransaksi', $id)->first();
        $dbeli['totalhargasatuan'] = $dbeli['qty'] * $dbeli['hargabeli'];
        return view('pembelian.edit', compact('pembelian', 'suplier', 'barang', 'dbeli'));
    }

    public function update(Request $request, Pembelian $pembelian)
    {
        $idpem = $pembelian['id'];

        $validator = Validator::make(
            $request->all(),
            [
                'kodespl' => 'required|max:10',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $pembelian = Pembelian::where('id', $idpem)->update([
            'kodespl' => $request->kodespl,
        ]);

        $jumlahstock = Stock::where('kodebrg', $request->kodebrg)->first();
        
        $kodebrglama = $request->kodebrglama;
        $qtylama = $request->qtylama;
        
        if ($kodebrglama == $request->kodebrg) {
            $selisih = $qtylama - $request->qty;
            
            if ($qtylama > $request->qty) {
                $nilaiqty = $jumlahstock['qtybeli'] + abs($selisih);
            } else {
                $nilaiqty = $jumlahstock['qtybeli'] - abs($selisih);
            }
            
            $updatestock = Stock::where('kodebrg', $request->kodebrg)->update([
                'qtybeli' => $nilaiqty,
            ]);
        } else {
            $jumlahstocklama = Stock::where('kodebrg', $kodebrglama)->first();
            $nilaiqtykembali = $jumlahstocklama['qtybeli'] + $qtylama;
            $updatestocklama = Stock::where('kodebrg', $kodebrglama)->update([
                'qtybeli' => $nilaiqtykembali,
            ]);
            
            $nilaiqty = $jumlahstock['qtybeli'] - $request->qty;
            $updatestock = Stock::where('kodebrg', $request->kodebrg)->update([
                'qtybeli' => $nilaiqty,
            ]);
        }
        
        $detailpembelian = DetailPembelian::where('notransaksi', $request->notransaksi)->update([
            'kodebrg' => $request->kodebrg,
            'hargabeli' => $request->hargabeli,
            'qty' => $request->qty,
            'diskon' => $request->diskon,
            'diskonrp' => $request->diskonrp,
            'totalrp' => $request->totalrp,
        ]);

        $hutang = Hutang::where('notransaksi', $request->notransaksi)->update([
            'kodespl' => $request->kodespl,
            'totalhutang' => $request->totalrp,
        ]);

        if ($pembelian && $detailpembelian && $updatestock && $hutang) {
            Session::flash('berhasil', 'Berhasil Mengubah pembelian');
            return redirect()->route('pembelian.index');
        }

        Session::flash('gagal', 'Gagal Mengubah pembelian');
        return redirect()->back();
    }

    public function destroy(pembelian $pembelian)
    {
        $pembelian->delete();

        if ($pembelian) {
            Session::flash('berhasil', 'Berhasil Menghapus pembelian');
            return redirect()->route('pembelian.index');
        }

        Session::flash('gagal', 'Gagal Menghapus pembelian');
        return redirect()->back();
    }
}
