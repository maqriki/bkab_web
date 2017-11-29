<?php

namespace App\Http\Controllers\Visitor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Ticketing\Cart;

use App\Models\Order\UserOrder;
use App\Models\Order\UserOrderPaket;
use App\Models\Order\UserOrderTicket;

use App\Models\Cart\MainCart;
use App\Models\Cart\PaketCart;
use App\Models\Cart\TicketingCart;

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
use DB;

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

  public function newCheckout()
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
    // $resume=['cart'=>$cart, 'tiket'=>$tiket, 'paket'=>$paket];
    // dd($resume);

    return view('visitor.cart.new-checkout')
            ->with('cart', $cart->resumeCart)
            ->with('tiket', $tiket->items)
            ->with('paket', $paket->pakets)
            ->with('totalQtyTiket', $tiket->totalQty)
            ->with('totalPriceTiket', $tiket->totalPrice)
            ->with('totalPriceTiket', $paket->ttlPaketPrice);
  }

  public function newSubmitCart(Request $request)
  {
    $currentKey=0;
    $cpk=0;

    $idCurrent=UserOrder::orderBy('id', 'DESC')->first();
    $idNow = $idCurrent->id+1;
    $idOrderNow='ORD'.$idNow;


    $oldCart= Session::get('cart');
    $cart= new MainCart($oldCart);

    $oldCartTiket= Session::get('tiket');
    $tiket= new TicketingCart($oldCartTiket);

    $oldCartPaket= Session::get('paket');
    $paket= new PaketCart($oldCartPaket);

    // $resume=['cart'=>$cart, 'tiket'=>$tiket, 'paket'=>$paket];
    // dd($resume);
    // Save to Cart Table
      $order = new UserOrder();
      $order->user_id=Auth::user()->id;
      $order->order_id=$idOrderNow;
      $order->ttl_item_all=$cart->totalQty;
      $order->ttl_tiket_item=$cart->totalTicketing;
      $order->ttl_tiket_person=$tiket->totalTicket;
      $order->ttl_tiket_tagihan=$tiket->totalPrice;
      $order->ttl_paket_item=$cart->totalPaket;
      $order->ttl_paket_person=$paket->ttlPaketPerson;
      $order->ttl_paket_tagihan=$paket->ttlPaketPrice;
      $order->ttl_tagihan=$cart->totalPrice;
      $order->payment_method=$request['paymentMethod'];
      $order->save();

    if ($cart->totalTicketing>0) {
      foreach ($tiket->items as $tikets) {
        $detail = new UserOrderTicket();
        $detail->order_id = $idOrderNow;
        $detail->order_uid = 'TK'.$currentKey.$idOrderNow;
        $detail->user_id=Auth::user()->id;
        $detail->uot_id_lokasi=$tikets['lokasi_id'];
        $detail->uot_nama_lokasi=$tikets['item']['lokasi_name'];
        $detail->uot_tiket_dewasa=$tikets['dewasa'];
        $detail->uot_retrib_dewasa=$tikets['hargaDewasa'];
        $detail->uot_ttl_retrib_dewasa=$tikets['hargaDewasa'] * $tikets['dewasa'];
        $detail->uot_tiket_anak=$tikets['anak'];
        $detail->uot_retrib_anak=$tikets['hargaAnak'];
        $detail->uot_ttl_retrib_anak=$tikets['hargaAnak'] * $tikets['anak'];
        $detail->uot_total_retribusi=$tikets['tPrice'];
        $detail->uot_status_payment=1;
        $detail->uot_status_order='Tiket Order';
        $detail->save();
        $currentKey++;
      }
    }

    if ($cart->totalPaket>0) {
      foreach ($paket->pakets as $pak) {
        $paketOrder = new UserOrderPaket();
        $paketOrder->order_id = $idOrderNow;
        $paketOrder->order_uid = 'PK'.$cpk.$idOrderNow;
        $paketOrder->user_id=Auth::user()->id;
        $paketOrder->uop_id_paket=$pak['paket']['pw_id'];
        $paketOrder->uop_nama_paket=$pak['paket']['pw_name'];
        $paketOrder->uop_paket_person=$pak['person'];
        $paketOrder->uop_price_idr_person=$pak['price'];
        $paketOrder->uop_tprice_idr_person=$pak['totalPrice'];
        $paketOrder->uop_status_kunjungan=0;
        $paketOrder->save();
        $cpk++;

        $lok= DB::table('paket_wisatas')
              ->join('paket_wisata_lokasis', 'paket_wisatas.pw_id', '=', 'paket_wisata_lokasis.pw_id')
              ->join('lokasi_wisata', 'paket_wisata_lokasis.lokasi_id', '=', 'lokasi_wisata.lokasi_id')
              ->join('ticketing_hargas', 'paket_wisata_lokasis.lokasi_id', '=', 'ticketing_hargas.lokasi_id')
              ->select('ticketing_hargas.*')
              ->where('paket_wisata_lokasis.pw_id', '=', $pak['paket']['pw_id'])
              ->get();

        foreach ($lok as $key=>$lokasi) {
          $paketTicket = new UserOrderTicket();
          $paketTicket->order_id = $idOrderNow;
          $paketTicket->order_uid = 'PT'.$currentKey.$idOrderNow;
          $paketTicket->user_id=Auth::user()->id;
          $paketTicket->uot_id_lokasi         =$lokasi->lokasi_id;
          $paketTicket->uot_nama_lokasi       =$lokasi->nama_lokasi;
          $paketTicket->uot_tiket_dewasa      =$pak['person'];
          $paketTicket->uot_retrib_dewasa     =$lokasi->harga_dewasa;
          $paketTicket->uot_ttl_retrib_dewasa =$pak['person'] * $lokasi->harga_dewasa;
          $paketTicket->uot_total_retribusi   =$pak['person'] * $lokasi->harga_dewasa;
          $paketTicket->uot_status_payment    =1;
          $paketTicket->uot_status_order      ='Paket Order';
          $paketTicket->save();
          $currentKey++;
        }        

        // echo "string";
      }
    }
      
    return redirect()->to('visit');


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

    // $order = TicketOrder::where('user_id', '=', $user->id)->get();
    $order = UserOrder::where('user_id', '=', $user->id)->get();

    return view('visitor.profile.index')
          ->with('order', $order)
          ->with('user', $user);
  }

  public function detailOrder($id)
  {

    $user = Auth::user();
    $paketWisata=null;
    $tiket=null;
    $order= UserOrder::where('order_id', '=', $id)->first();
    // if ($order->ttl_tiket_item!=0) {
    //   # code...
    // }
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
