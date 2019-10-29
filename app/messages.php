<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    protected $fillable = [
         'message'
    ];

    protected $table = 'messages_s';

    public function user(){
        return $this->belongsTo(User::class);
    }
}
 