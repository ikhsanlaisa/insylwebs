<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cb_olahraga extends Model
{
    protected $table = 'cb_olahragas';
    protected $fillable = array('cabang_olahraga', 'pj');

    public function tb_regis(){
        return $this->hasMany('App\registrasi', 'olahraga_id');
    }

    public function jadwal(){
        return $this->hasMany('App\tb_jadwal', 'olahraga_id');
    }
}
