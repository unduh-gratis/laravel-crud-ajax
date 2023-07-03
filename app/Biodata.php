<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    protected $table = "biodatas";
    protected $guarded = [];
    protected $casts = [
        'hobi' => 'array'
    ];
}
