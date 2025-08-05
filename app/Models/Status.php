<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //use HasFactory;
    
    //const created_at = null;
    
    //const updated_at = null;
    
    public $timestamps = false;
    
    //protected $connection ='mysql1';
    
    protected $table = 'assetstatus';

    //protected $guarded = ['id'];
    
    protected $fillable = ['assetcode','status','alasan','userid','foto','company'];
}
