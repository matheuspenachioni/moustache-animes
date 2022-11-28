<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'synopsis',
        'episodes',
        'source'
    ];

    //..eager loading 
    protected $with = ['studio'];

    //..define the relationship with Studio
    public function studio(){
        return $this->belongsTo(Studio::class);
    }

}