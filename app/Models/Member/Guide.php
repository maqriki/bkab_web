<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
  protected $table = 'user_guide';
  protected $primarykey = 'id';
  public $timestamp=true;
}
