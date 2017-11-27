<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductExclude extends Model
{
  protected $table = 'product_excludes';
  protected $primarykey = 'id';
  public $timestamp=true;
}
