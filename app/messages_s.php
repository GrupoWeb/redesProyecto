<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class messages_s extends Model
{
     protected $fillable = [
         'message'
    ];

    protected $table = 'messages';
}
