<?php

namespace App\Models\Cart;

use Illuminate\Database\Eloquent\Model;

class MainCart extends Model
{
	public $resumeCart=null;
  public $totalQty=0;
  public $totalPrice=0;
  public $totalTicketing=0;
  public $totalPaket=0;

  public function __construct($oldCart)
	{
		if ($oldCart) {
			$this->resumeCart = $oldCart->resumeCart;
			$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
			$this->totalTicketing = $oldCart->totalTicketing;
			$this->totalPaket = $oldCart->totalPaket;
		}
	}

	public function add($uid, $type, $price)
	{
		$this->totalQty++;
		$this->totalPrice+=$price;

		if ($type=='paket-wisata') {
			$this->totalPaket++;
		}else if ($type=='ticketing') {
			$this->totalTicketing++;
		}

		$this->resumeCart=['totalQty'=>$this->totalQty, 'totalPrice'=>$this->totalPrice, 'totalPaket'=>$this->totalPaket, 'totalTicketing'=>$this->totalTicketing];

	}

}
