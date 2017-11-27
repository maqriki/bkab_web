<?php

namespace App\Models\Ticketing;

use Illuminate\Database\Eloquent\Model;

class TicketDetailOrder extends Model
{
  protected $table = 'ticket_detail_orders';
  protected $primarykey = 'id';
  public $timestamp=true;
}
