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

use DB;

class VisitorController extends Controller
{

  public function index()
  {
    $lokasi = LokasiWisata::where('lokasi_status', '=', 1)->get();
    return view('visitor.index')
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
