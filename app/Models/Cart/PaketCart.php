<?php

namespace App\Models\Cart;

use Illuminate\Database\Eloquent\Model;

class PaketCart extends Model
{
  public $pakets = null;
  public $ttlPaket = 0;
  public $ttlPaketPrice=0;
  public $ttlPaketPerson=0;

  public function __construct($oldCartPaket)
	{
		if ($oldCartPaket) {
			$this->pakets = $oldCartPaket->pakets;
			$this->ttlPaket = $oldCartPaket->ttlPaket;
			$this->ttlPaketPrice = $oldCartPaket->ttlPaketPrice;
			$this->ttlPaketPerson = $oldCartPaket->ttlPaketPerson;
		}
	}

	public function add($uid, $paket, $person, $date)
	{
		$currentPrice = $person * $paket->pw_price_idr;
		$storedPaket=['id_session' =>$uid, 'pw_id'=>$paket->pw_id, 'person'=>$person, 'price'=>$paket->pw_price_idr, 'totalPrice'=>$currentPrice, 'paket'=>$paket, 'date'=>$date];

		$this->pakets[$uid]= $storedPaket;
		$this->ttlPaket++;
		$this->ttlPaketPrice+=$currentPrice;
		$this->ttlPaketPerson+=$person;
	}
}
