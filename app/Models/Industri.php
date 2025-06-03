<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industri extends Model
{
    protected $guarded =[];

    public function pkl()
    {
        return $this->hasMany(Pkl::class);
    }
}
