<?php

namespace App\Http\Controllers\Visitor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Katalog\LokasiWisata;
use App\Models\Katalog\LokasiFasilitas;
use App\Models\Katalog\LokasiMedia;

use App\Models\Ticketing\Ticket;
use App\Models\Ticketing\TicketOrdered;
use App\Models\Ticketing\TicketingHarga;
use App\Models\Ticketing\TicketingKendaraan;


use App\Models\Katalog\PaketWisata;
use App\Models\Katalog\PaketWisataFasilitas;
use App\Models\Katalog\PaketWisataMedia;
use App\Models\Katalog\PaketWisataExclude;
use App\Models\Katalog\PaketWisataItenarary;
use App\Models\Katalog\PaketWisataLokasi;

use DB;

class VisitorController extends Controller
{

  public function index()
  {
    $lokasi = LokasiWisata::where('lokasi_status', '=', 1)->get();
    $paket = PaketWisata::all();
    return view('visitor.index')
            ->with('paket', $paket)
            ->with('lokasi', $lokasi);
  }

  public function viewLok($slug)
  {
    $lokasi = LokasiWisata::where('lokasi_slug', '=', $slug)->first();
    $fasilitas = LokasiFasilitas::where('lokasi_id', '=', $lokasi->lokasi_id)->get();
    $harga = TicketingHarga::where('lokasi_id', '=', $lokasi->lokasi_id)->first();
    return view('visitor.lokasi.view')
            ->with('harga', $harga)
            ->with('fasilitas', $fasilitas)
            ->with('lokasi', $lokasi);
  }

  public function viewPaket($slug)
  {
    $pw = PaketWisata::where('pw_slug', '=', $slug)->first();
    $pwl = DB::table('paket_wisatas')
            ->join('paket_wisata_lokasis', 'paket_wisatas.pw_id', '=', 'paket_wisata_lokasis.pw_id')
            ->join('lokasi_wisata', 'paket_wisata_lokasis.lokasi_id', '=', 'lokasi_wisata.lokasi_id')
            ->select('lokasi_wisata.*')
            ->where('paket_wisata_lokasis.pw_id', '=', $pw->pw_id)
            ->get();
    $pwi = PaketWisataItenarary::where('pw_id', '=', $pw->pw_id)->get();
    $pwe = PaketWisataExclude::where('pw_id', '=', $pw->pw_id)->get();
    $pwf = PaketWisataFasilitas::where('pw_id', '=', $pw->pw_id)->get();


    // $harga = TicketingHarga::where('lokasi_id', '=', $lokasi->lokasi_id)->first();
    return view('visitor.paket.view')
            ->with('pw', $pw)
            ->with('pwi', $pwi)
            ->with('pwl', $pwl)
            ->with('pwi', $pwi)
            ->with('pwe', $pwe)
            ->with('pwf', $pwf);
  }

  public function create()
  {
      //
  }

  public function store(Request $request)
  {
      //
  }

  public function show($id)
  {
      //
  }

  public function edit($id)
  {
      //
  }

  public function update(Request $request, $id)
  {
      //
  }

  public function destroy($id)
  {
      //
  }
}
