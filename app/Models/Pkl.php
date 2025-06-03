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

    protected static function booted()
    {
        static::creating(function ($pkl) {
            if($pkl->siswa){
                $pkl->siswa->update([
                    'status_pkl' => 'sudah', 
                ]);
            }
        });

        static::deleted(function ($pkl){
            if($pkl->siswa) {
                $pkl->siswa->update(
                    ['status_pkl' => 'belum']
                );
            } 
        });
    }
    public function getTanggalMulaiAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function getTanggalSelesaiAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }
}
