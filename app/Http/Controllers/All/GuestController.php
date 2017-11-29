<?php

namespace App\Http\Controllers\All;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Lokasi Wisata
  use App\Models\Katalog\LokasiWisata;
  use App\Models\Katalog\LokasiFasilitas;
  use App\Models\Katalog\LokasiMedia;

// Paket Wisata
  use App\Models\Katalog\PaketWisata;
  use App\Models\Katalog\PaketWisataFasilitas;
  use App\Models\Katalog\PaketWisataMedia;
  use App\Models\Katalog\PaketWisataExclude;
  use App\Models\Katalog\PaketWisataItenarary;
  use App\Models\Katalog\PaketWisataLokasi;

// Ticketing Cart
  use App\Models\Ticketing\Ticket;
  use App\Models\Ticketing\TicketOrdered;
  use App\Models\Ticketing\TicketingHarga;
  use App\Models\Ticketing\TicketingKendaraan;

// Cart
  use App\Models\Cart\MainCart;
  use App\Models\Cart\PaketCart;
  use App\Models\Cart\TicketingCart;

use Carbon\Carbon;
use DateTime;
use Session;
use DB;

class GuestController extends Controller
{
	public function removeCart()
	{
		Session::forget('cart');
		Session::forget('paket');
		Session::forget('tiket');
    return redirect()->to('/');
	}

  // Page
    public function index()
    {
      $lokasi = LokasiWisata::where('lokasi_status', '=', 1)->get();
      $paket = PaketWisata::all();
      return view('guest.index')
              ->with('paket', $paket)
              ->with('lokasi', $lokasi);
    }

  // Lokasi Wisata
    public function Wisata()
    {
      $lokasi = LokasiWisata::where('lokasi_status', '=', 1)->where('lokasi_type', '=', 'Location')->get();
      return view('guest.wisata.index')
              ->with('lokasi', $lokasi);
    }
    public function viewWisata($slug)
    {
      $lokasi = LokasiWisata::where('lokasi_slug', '=', $slug)->first();
      $fasilitas = LokasiFasilitas::where('lokasi_id', '=', $lokasi->lokasi_id)->get();
      $harga = TicketingHarga::where('lokasi_id', '=', $lokasi->lokasi_id)->first();
      return view('guest.wisata.view')
              ->with('harga', $harga)
              ->with('fasilitas', $fasilitas)
              ->with('lokasi', $lokasi);
    }

  // Event Wisata
    public function event()
    {
      $lokasi = LokasiWisata::where('lokasi_status', '=', 1)->where('lokasi_type', '=', 'Special Event')->get();
      return view('guest.event.index')
              ->with('lokasi', $lokasi);
    }
    public function viewEvent($slug)
    {
      $lokasi = LokasiWisata::where('lokasi_slug', '=', $slug)->first();
      $fasilitas = LokasiFasilitas::where('lokasi_id', '=', $lokasi->lokasi_id)->get();
      $harga = TicketingHarga::where('lokasi_id', '=', $lokasi->lokasi_id)->first();
      return view('guest.event.view')
              ->with('harga', $harga)
              ->with('fasilitas', $fasilitas)
              ->with('lokasi', $lokasi);
    }

  // Paket Wisata
    public function paketWisata()
    {
      $paket = PaketWisata::all();
      return view('guest.paket-wisata.index')
              ->with('paket', $paket);
    }
    public function viewPaketWisata($slug)
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

      return view('guest.paket-wisata.view')
              ->with('pw', $pw)
              ->with('pwi', $pwi)
              ->with('pwl', $pwl)
              ->with('pwi', $pwi)
              ->with('pwe', $pwe)
              ->with('pwf', $pwf);
    }

  // Cart Ticketing
    public function ticketAddToCart(Request $request, $id)
    {
      $position="";
      $anak = $request['anak'];
      $uid=md5(uniqid().Carbon::now().uniqid('paket').bcrypt('paket-wisata'));
      $item = LokasiWisata::where('lokasi_id', '=', $id)->first();
      $harga = TicketingHarga::where('lokasi_id', '=', $id)->first();
      if (empty($anak)) {$anak=0;}
      $price = ($anak * $harga->harga_anak)+($request['dewasa'] * $harga->harga_dewasa);

      if ($item->lokasi_type=='Location') {$position='wisata';}
      elseif($item->lokasi_type=='Special Event'){$position='event';}

      $oldCart = Session::has('cart') ? Session::get('cart'):null;
      $cart= new MainCart($oldCart);

      $oldCartTiket = Session::has('tiket') ? Session::get('tiket'):null;
      $tiket= new TicketingCart($oldCartTiket);

      $cart->add($uid, 'ticketing', $price);
      $request->session()->put('cart', $cart);

      $tiket->add($uid, $item, $harga, $request['dewasa'], $anak, $request['date']);
      $request->session()->put('tiket', $tiket);

      return redirect()->to('/'.$position.'/'.$item->lokasi_slug);
    }

  // Cart Paket
    public function paketAddToCart(Request $request, $id, $cp)
    {
      $person= $request['person'];
      $date= $request['date'];
      $uid=md5(uniqid().Carbon::now().uniqid('paket').bcrypt('paket-wisata'));
      $pw=PaketWisata::where('pw_id', '=', $id)->first();
      $price=$request['person']*$request['price'];

      $oldCart = Session::has('cart') ? Session::get('cart'):null;
      $cart= new MainCart($oldCart);

      $oldCartPaket = Session::has('paket') ? Session::get('paket'):null;
      $paket= new PaketCart($oldCartPaket);

      $cart->add($uid, 'paket-wisata', $price);
      $request->session()->put('cart', $cart);

      $paket->add($uid, $pw, $person, $date);
      $request->session()->put('paket', $paket);

      return redirect()->to('/paket/'.$cp);
    }

  // Shopping Cart
    public function shoppingCart()
    {
      if (!Session::has('cart')) {return view('visitor.cart.empty-cart');}

      $oldCart= Session::get('cart');
      $cart= new MainCart($oldCart);

      $oldCartTiket= Session::get('tiket');
      $tiket= new TicketingCart($oldCartTiket);

      $oldCartPaket= Session::get('paket');
      $paket= new PaketCart($oldCartPaket);
      $resume=['cart'=>$cart, 'tiket'=>$tiket, 'paket'=>$paket];
      // dd($resume);

      return view('guest.cart.shopping-cart')
              ->with('cart', $cart->resumeCart)
              ->with('tiket', $tiket->items)
              ->with('paket', $paket->pakets)
              ->with('totalQtyTiket', $tiket->totalQty)
              ->with('totalPriceTiket', $tiket->totalPrice)
              ->with('totalPriceTiket', $paket->ttlPaketPrice);
    }

}
