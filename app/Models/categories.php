<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    use HasFactory;

    protected $fillable= 
    [
        'name'
    ];
    public function products()
    {
        return $this->hasMany('App\Models\products','categories_id','id');
    }
    public function videos()
    {
        return $this->hasMany('App\Models\videos','categories_id','id');
    }
}
