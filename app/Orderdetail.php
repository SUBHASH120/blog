<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    protected $table = 'orderdetails';

    protected $fillable = ['orderid', 'productid', 'quantity'];
}
