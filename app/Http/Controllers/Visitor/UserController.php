<?php

namespace App\Http\Controllers\Visitor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Ticketing\Cart;

use App\Models\Ticketing\Ticket;
use App\Models\Ticketing\TicketOrdered;
use App\Models\Ticketing\TicketOrder;
use App\Models\Ticketing\TicketDetailOrder;
use App\Models\Ticketing\TicketingHarga;
use App\Models\Ticketing\TicketingKendaraan;

use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use DateTime;
use Session;

class UserController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function checkout()
  {
  	if (!Session::has('cart')) {
      return view('visitor.cart.empty-cart');
    }

    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);

    return view('visitor.cart.checkout')
              ->with('cart', $cart->items)
              ->with('totalQty', $cart->totalQty)
              ->with('totalTicket', $cart->totalTicket)
              ->with('totalPrice', $cart->totalPrice);
  }

  public function submitCart(Request $request)
  {
  	$idCurrent = TicketOrder::orderBy('id', 'DESC')->first();
  	$idNow = $idCurrent->id+1;
  	$idOrderNow ='ORD'.$idNow;

    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);

  	$order = new TicketOrder();
  	$order->order_id = $idOrderNow;
  	$order->user_id = Auth::user()->id;
  	$order->order_qty = $cart->totalQty;
  	$order->total_ticket = $cart->totalTicket;
  	$order->total_payment = $cart->totalPrice;
  	$order->payment_method = $request['paymentMethod'];
  	$order->status_payment = 0;
  	$order->save();

  	foreach ($cart->items as $kart) {
  		$detail = new TicketDetailOrder();
  		$detail->order_id = $idOrderNow;
  		$detail->user_id=Auth::user()->id;
  		$detail->lokasi_id=$kart['lokasi_id'];
  		$detail->lokasi_nama=$kart['item']['lokasi_name'];
  		$detail->tiket_dewasa=$kart['dewasa'];
  		$detail->tiket_anak=$kart['anak'];
  		$detail->retrib_dewasa=$kart['hargaDewasa'] * $kart['dewasa'];
  		$detail->retrib_anak=$kart['hargaAnak'] * $kart['anak'];
  		$detail->total_retrib=$kart['tPrice'];
  		$detail->status_payment=1;
  		$detail->save();
  	}

  	Session::forget('cart');
    return redirect()->to('/visit');

  }

  public function userProfile()
  {
    $user = Auth::user();

    $order = TicketOrder::where('user_id', '=', $user->id)->get();

    return view('visitor.profile.index')
          ->with('order', $order)
          ->with('user', $user);
  }

  public function detailOrder($id)
  {

    $user = Auth::user();
    $other = TicketOrder::where('user_id', '=', $user->id)->get();
    $order = TicketOrder::where('user_id', '=', $user->id)->where('order_id', '=', $id)->first();
    $detailOrd = TicketDetailOrder::where('order_id', '=', $id)->where('user_id', '=', $user->id)->get();
    return view('visitor.profile.order.detail')
              ->with('other', $other)
              ->with('order', $order)
              ->with('detailOrd', $detailOrd);
  }

  public function konfPay($id)
  {
    $user = Auth::user();
    $order = TicketOrder::where('user_id', '=', $user->id)->where('order_id', '=', $id)->first();
    $detailOrd = TicketDetailOrder::where('order_id', '=', $id)->where('user_id', '=', $user->id)->get();
    return view('visitor.profile.order.conf-payment')
              ->with('order', $order)
              ->with('detailOrd', $detailOrd);
  }

  public function konfPayPost($id)
  {
    $user = Auth::user();
    $order = TicketOrder::where('user_id', '=', $user->id)->where('order_id', '=', $id)->first();
    $detailOrd = TicketDetailOrder::where('order_id', '=', $id)->where('user_id', '=', $user->id)->get();

    $order->status_payment=2;
    $order->update();

    foreach ($detailOrd as $do) {
      $do->status_payment=2;
      $do->update();
    }
      
    return redirect()->to('/user/profile');

  }

}
