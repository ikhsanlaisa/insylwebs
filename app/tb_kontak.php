<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_kontak extends Model
{
    protected $table = 'tb_kontaks';
    protected $fillable = array('nama', 'no_tlpn', 'foto');
}
