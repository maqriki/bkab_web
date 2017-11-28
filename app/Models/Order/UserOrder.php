<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
  protected $table = 'user_orders';
  protected $primarykey = 'id';
  public $timestamp=true;
}
