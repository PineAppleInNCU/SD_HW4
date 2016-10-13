<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    //
    protected $table = 'guest';
    protected $fillable = ['username','guestTime','content'];
}
