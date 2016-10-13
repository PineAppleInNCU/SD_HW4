<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Main_discussion extends Model
{
    protected $table='main_discussion';
    protected $fillable=['username','title','subject','content','academy','hide_name'];
    //
}
