<?php

namespace App\Models\Ticketing;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
  protected $table = 'tickets';
  protected $primarykey = 'id';
  public $timestamp=true;
}
