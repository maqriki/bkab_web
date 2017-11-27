<?php

namespace App\Models\Katalog;

use Illuminate\Database\Eloquent\Model;

class PaketWisataExclude extends Model
{
  protected $table = 'paket_wisata_excludes';
  protected $primarykey = 'id';
  public $timestamp=true;
}
