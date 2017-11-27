<?php

namespace App\Models\Katalog;

use Illuminate\Database\Eloquent\Model;

class LokasiWisata extends Model
{
  protected $table = 'lokasi_wisata';
  protected $primarykey = 'id';
  public $timestamp=true;
}
