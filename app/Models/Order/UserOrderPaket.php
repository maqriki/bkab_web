<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class UserOrderPaket extends Model
{
  protected $table = 'user_order_pakets';
  protected $primarykey = 'id';
  public $timestamp=true;
}
