<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductInclude extends Model
{
  protected $table = 'product_includes';
  protected $primarykey = 'id';
  public $timestamp=true;
}
