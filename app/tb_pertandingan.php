<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_pertandingan extends Model
{
    protected $table = 'tb_pertandingans';
    protected $fillable = array('jadwal_id', 'keterangan', 'tim1', 'tim2', 'cabor', 'score', 'lokasi');

    public function jadwal(){
        return $this->belongsTo('App\tb_jadwal', 'jadwal_id');
    }

    public function tim1(){
        return $this->belongsTo('App\tb_kelas', 'jadwal_id');
    }

    public function tim2(){
        return $this->belongsTo('App\tb_kelas', 'jadwal_id');
    }

    public function cabor(){
        return $this->belongsTo('App\cb_olahraga', 'cabor');
    }
}
