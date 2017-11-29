<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class MemberProfile extends Model
{
  protected $table = 'member_profiles';
  protected $primarykey = 'id';
  public $timestamp=true;
}
