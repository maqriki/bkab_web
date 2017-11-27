<?php

namespace App\Models\Ticketing;

use Illuminate\Database\Eloquent\Model;

class TicketOrdered extends Model
{
  protected $table = 'ticket_ordered';
  protected $primarykey = 'id';
  public $timestamp=true;
}
