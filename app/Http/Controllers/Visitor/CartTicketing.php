<?php

namespace App\Http\Controllers\Visitor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Katalog\LokasiWisata;
use App\Models\Katalog\LokasiFasilitas;
use App\Models\Katalog\LokasiMedia;

use App\Models\Ticketing\Cart;

use App\Models\Ticketing\Ticket;
use App\Models\Ticketing\TicketOrdered;
use App\Models\Ticketing\TicketingHarga;
use App\Models\Ticketing\TicketingKendaraan;

use Carbon\Carbon;
use DateTime;
use Session;

class CartTicketing extends Controller
{

  public function addToCart(Request $request, $id, $currentPage)
  {
  	$anak = $request['anak'];
    $item_cart_id=uniqid();
    $item = LokasiWisata::where('lokasi_id', '=', $id)->first();
    $harga = TicketingHarga::where('lokasi_id', '=', $id)->first();
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    if (empty($anak)) {
    	$anak=0;
    }

    $cart->add($item_cart_id, $item, $harga, $request['dewasa'], $anak, $request['date']);

    $request->session()->put('cart', $cart);
    // dd($request->session()->get('cart'));
    return redirect()->to('/lokasi/view/'.$currentPage.'/'.$item->product_slug);
  }

  public function deleteItemCart()
  {
    Session::forget('cart');
    return redirect()->to('/visit');
  }

  public function shoppingCart()
  {
  	if (!Session::has('cart')) {
      return view('visitor.cart.empty-cart');
    }

    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);

    return view('visitor.cart.shopping-cart')
              ->with('cart', $cart->items)
              ->with('totalQty', $cart->totalQty)
              ->with('totalPrice', $cart->totalPrice);
  }

}
