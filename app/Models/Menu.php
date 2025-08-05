<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //use HasFactory;
    
    //const created_at = null;
    
    //const updated_at = null;
    
    public $timestamps = false;
    
    protected $connection ='mysql1';
    
    protected $table = 'tb_m_product_menu';

    //protected $guarded = ['id'];
    
    protected $fillable = ['DISPLAYEDTEXT','PARENTMENUID','ISPRODUCT'];
}
