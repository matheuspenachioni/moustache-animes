<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    
    //..define the relationship with Anime
    public function animes(){
        return $this->hasMany(Anime::class);
    }

    protected $fillable = [
        'name',
        'color',
        'description'
    ];

}