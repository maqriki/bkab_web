<?php

namespace App\Models\Ticketing;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;
	public $totalTicket = 0;

	public function __construct($oldCart)
	{
		if ($oldCart) {
			$this->items = $oldCart->items;
			$this->item_id = $oldCart->item_id;
			$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
			$this->totalTicket = $oldCart->totalTicket;
		}
	}
	
	public function add( $id, $item, $harga, $dewasa, $anak, $date){

		$tTicket = $dewasa + $anak;
		$tPrice=($dewasa * $harga->harga_dewasa) + ($anak * $harga->harga_anak);

		$storedItem = ['id_session'=>$id, 'lokasi_id' => $item->lokasi_id, 'dewasa' => $dewasa, 'anak' => $anak, 'hargaDewasa' => $harga->harga_dewasa, 'hargaAnak' => $harga->harga_anak, 'jumlahP' => $tTicket, 'tPrice'=> $tPrice, 'item' => $item, 'date' => $date];

		$this->items[$id] = $storedItem;
		$this->totalQty++;
		$this->totalPrice += $tPrice;
		$this->totalTicket += $tTicket;
	}

}
