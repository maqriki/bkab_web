<?php

namespace App\Http\Controllers\Visitor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Katalog\PaketWisata;
use App\Models\Katalog\PaketWisataFasilitas;
use App\Models\Katalog\PaketWisataMedia;
use App\Models\Katalog\PaketWisataExclude;
use App\Models\Katalog\PaketWisataItenarary;
use App\Models\Katalog\PaketWisataLokasi;

use App\Models\Cart\MainCart;
use App\Models\Cart\PaketCart;
use App\Models\Cart\TicketingCart;

use App\Models\Ticketing\Ticket;
use App\Models\Ticketing\TicketOrdered;
use App\Models\Ticketing\TicketingHarga;
use App\Models\Ticketing\TicketingKendaraan;

use App\Models\Katalog\LokasiWisata;
use App\Models\Katalog\LokasiFasilitas;
use App\Models\Katalog\LokasiMedia;

use App\Models\Ticketing\UserTicketing;
use App\Models\Ticketing\TicketOrder;
use App\Models\Ticketing\TicketDetailOrder;

use Carbon\Carbon;
use DateTime;
use Session;

class CartController extends Controller
{
	/* $cp : Current Page */
	public function removeS()
	{
		Session::forget('cart');
		Session::forget('paket');
		Session::forget('tiket');
    return redirect()->to('/visit');
	}

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

  	return redirect()->to('/paket-wisata/view/'.$cp);
  }

  public function ticketAddToCart(Request $request, $id, $cp)
  {
  	$anak = $request['anak'];
    $uid=md5(uniqid().Carbon::now().uniqid('paket').bcrypt('paket-wisata'));
    $item = LokasiWisata::where('lokasi_id', '=', $id)->first();
    $harga = TicketingHarga::where('lokasi_id', '=', $id)->first();
    if (empty($anak)) {$anak=0;}
    $price = ($anak * $harga->harga_anak)+($request['dewasa'] * $harga->harga_dewasa);

  	$oldCart = Session::has('cart') ? Session::get('cart'):null;
  	$cart= new MainCart($oldCart);

  	$oldCartTiket = Session::has('tiket') ? Session::get('tiket'):null;
  	$tiket= new TicketingCart($oldCartTiket);

  	$cart->add($uid, 'ticketing', $price);
  	$request->session()->put('cart', $cart);

  	$tiket->add($uid, $item, $harga, $request['dewasa'], $anak, $request['date']);
  	$request->session()->put('tiket', $tiket);

  	return redirect()->to('/lokasi/view/'.$cp.'/'.$item->product_slug);
  }

  public function shoppingCart()
  {
  	if (!Session::has('cart')) {
      return view('visitor.cart.empty-cart');
    }

    $oldCart= Session::get('cart');
    $cart= new MainCart($oldCart);

    $oldCartTiket= Session::get('tiket');
    $tiket= new TicketingCart($oldCartTiket);

    $oldCartPaket= Session::get('paket');
    $paket= new PaketCart($oldCartPaket);
    $resume=['cart'=>$cart, 'tiket'=>$tiket, 'paket'=>$paket];
    dd($resume);

    return view('visitor.cart.new-shopping-cart')
    				->with('cart', $cart->resumeCart)
            ->with('tiket', $tiket->items)
            ->with('paket', $paket->pakets)
            ->with('totalQtyTiket', $tiket->totalQty)
            ->with('totalPriceTiket', $tiket->totalPrice)
            ->with('totalPriceTiket', $paket->ttlPaketPrice);

  }

}
