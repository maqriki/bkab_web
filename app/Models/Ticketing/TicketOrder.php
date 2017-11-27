<?php

namespace App\Models\Ticketing;

use Illuminate\Database\Eloquent\Model;

class TicketOrder extends Model
{
  protected $table = 'ticket_orders';
  protected $primarykey = 'id';
  public $timestamp=true;
}
