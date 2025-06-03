<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pkl extends Model
{
    protected $guarded = [];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    public function industri()
    {
        return $this->belongsTo(Industri::class);
    }
    public function getTanggalMulaiAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y H:i');
    }
}
