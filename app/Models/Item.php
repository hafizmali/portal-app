<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'url' , 'descriptions' , 'technology'];

    public function itemDetails()
    {
        return $this->hasMany('App\Models\ItemDetails');
    }
}
