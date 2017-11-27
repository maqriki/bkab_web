<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductMedia extends Model
{
  protected $table = 'product_media';
  protected $primarykey = 'id';
  public $timestamp=true;
}
