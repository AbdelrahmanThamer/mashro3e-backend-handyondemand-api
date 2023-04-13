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

class ProductOrders extends Model
{
    protected $table = 'products_orders';

    public $timestamps = true; //by default timestamp false

    protected $fillable = ['uid','freelancer_id','driver_id','date_time','paid_method','order_to','orders','notes','address',
    'assignee','total','tax','grand_total','discount','delivery_charge','wallet_used','wallet_price',
    'extra','pay_key','coupon_code','status','payStatus','extra_field'];

    protected $hidden = [
        'updated_at', 'created_at',
    ];

    protected $casts = [
        'wallet_used' => 'integer',
        'payStatus' => 'integer'
    ];
}
