<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    //use HasFactory;
    
    //const created_at = null;
    
    //const updated_at = null;
    
    public $timestamps = false;
    
    //protected $connection ='mysql1';
    
    protected $table = 'asset';

    //protected $guarded = ['id'];
    
    protected $fillable = ['name','merk','category','owner','condition','dateacquired','currentvalue','foto','userid','company','lokasi'];
}
