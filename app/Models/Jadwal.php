<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    
    public $timestamps = false;
    
    protected $table = 'jadwalmaintenance';
    
    protected $fillable = ['assetcode','datejadwal','userid','alasan','company','foto'];
    
}
