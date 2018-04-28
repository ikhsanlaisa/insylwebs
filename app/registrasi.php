<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class registrasi extends Model
{
    protected $table = 'registrasis';
    protected $fillable = array('profil_id', 'olahraga_id');

    public function profil(){
        return $this->belongsTo('App\User', 'profil_id');
    }

    public function cb_olahraga(){
        return $this->belongsTo('App\cb_olahraga', 'olahraga_id');
    }
}
