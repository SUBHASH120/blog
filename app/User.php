<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = ['firstname', 'lastname', 'email', 'password', 'mobile', 'address'];
}

