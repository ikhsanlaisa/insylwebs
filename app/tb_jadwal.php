<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_jadwal extends Model
{
    protected $table = 'tb_jadwals';
    protected $fillable = array('tim1', 'tim2', 'lokasi', 'date_time', 'olahraga_id');

    public function kelas(){
        return $this->belongsTo('App\tb_kelas', 'tim1');
    }

    public function kelas1(){
        return $this->belongsTo('App\tb_kelas', 'tim2');
    }

    public function cb_olahraga(){
        return $this->belongsTo('App\cb_olahraga', 'olahraga_id');
    }

    public function pertandingan(){
        return $this->hasMany('App\tb_pertandingan', 'jadwal_id');
    }
}
