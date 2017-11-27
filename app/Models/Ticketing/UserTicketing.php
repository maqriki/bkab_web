<?php

namespace App\Models\Ticketing;

use Illuminate\Database\Eloquent\Model;

class UserTicketing extends Model
{
  protected $table = 'user_ticketing';
  protected $primarykey = 'id';
  public $timestamp=true;
}
