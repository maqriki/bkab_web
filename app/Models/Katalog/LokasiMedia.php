<?php

namespace App\Models\Katalog;

use Illuminate\Database\Eloquent\Model;

class LokasiMedia extends Model
{
  protected $table = 'lokasi_media';
  protected $primarykey = 'id';
  public $timestamp=true;
}
