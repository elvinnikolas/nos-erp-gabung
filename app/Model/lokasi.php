<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class lokasi extends Model
{
    protected $table = 'lokasis';
    protected $primaryKey = 'KodeLokasi';
    public $incrementing = false;
    protected $fillable = ['KodeLokasi', 'NamaLokasi', 'Tipe'];

    public function penjualan()
    {
        return $this->hasMany('App\Penjualan');
    }
}
