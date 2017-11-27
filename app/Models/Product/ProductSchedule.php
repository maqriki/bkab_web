<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductSchedule extends Model
{
  protected $table = 'product_schedules';
  protected $primarykey = 'id';
  public $timestamp=true;
}
