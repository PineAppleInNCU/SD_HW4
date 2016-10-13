<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub_discussion extends Model
{
    protected $table='sub_discussion';
    protected $fillable=['username','content','main_discussion_id'];
    //
}
