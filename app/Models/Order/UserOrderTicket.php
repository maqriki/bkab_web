<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class UserOrderTicket extends Model
{
  protected $table = 'user_order_tickets';
  protected $primarykey = 'id';
  public $timestamp=true;
}
