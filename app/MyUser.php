<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyUser extends Model
{
    //
    protected $fillable=["name","email","type","password","logged"];
}
