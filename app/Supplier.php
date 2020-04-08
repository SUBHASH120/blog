<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = ['suppliername', 'contactname','address', 'city','postalcode', 'country', 'phone'];
}


