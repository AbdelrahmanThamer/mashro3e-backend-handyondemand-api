<?php
/*
  Authors : initappz (Rahul Jograna)
  Website : https://initappz.com/
  App Name : Handy Service Full App Flutter
  This App Template Source code is licensed as per the
  terms found in the Website https://initappz.com/license
  Copyright and Good Faith Purchasers © 2022-present initappz.
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $table = 'commission';

    public $timestamps = true; //by default timestamp false

    protected $fillable = ['freelancer_id','rate','status','extra_field'];

    protected $hidden = [
        'updated_at', 'created_at',
    ];
}
