<?php

namespace App\Models\Ticketing;

use Illuminate\Database\Eloquent\Model;

class TicketingHarga extends Model
{
  protected $table = 'ticketing_hargas';
  protected $primarykey = 'id';
  public $timestamp=true;
}
