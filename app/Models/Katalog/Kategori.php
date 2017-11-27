<?php

namespace App\Models\Katalog;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
  protected $table = 'kategoris';
  protected $primarykey = 'id';
  public $timestamp=true;
}
