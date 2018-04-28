<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_pertandingan extends Model
{
    protected $table = 'tb_pertandingans';
    protected $fillable = array('jadwal_id', 'keterangan', 'pemenang_id', 'foto');

    public function jadwal(){
        return $this->belongsTo('App\tb_jadwal', 'jadwal_id');
    }
}
