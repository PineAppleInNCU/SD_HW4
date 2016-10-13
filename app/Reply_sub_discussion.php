<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply_sub_discussion extends Model
{
    protected $table='reply_sub_discussion';
    protected $fillable=['username','content','sub_discussion_id'];
    //
}
