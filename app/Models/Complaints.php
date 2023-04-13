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

class Complaints extends Model
{
    protected $table = 'complaints';

    public $timestamps = true; //by default timestamp false

    protected $fillable = ['uid','order_id','appointment_id','complaints_on','issue_with','driver_id','freelancer_id','product_id','reason_id','title','short_message','images','status','extra_field'];

    protected $hidden = [
        'updated_at', 'created_at',
    ];

    protected $casts = [
        'status' => 'integer',
        'issue_with' => 'integer',
    ];
}
