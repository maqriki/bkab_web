<?php

namespace App\Models\Katalog;

use Illuminate\Database\Eloquent\Model;

class PaketWisata extends Model
{
  protected $table = 'paket_wisatas';
  protected $primarykey = 'id';
  public $timestamp=true;
}
