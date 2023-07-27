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
        'score',
        'episodes',
        'source'
    ];

    //..eager loading 
    protected $with = ['studio', 'statu'];

    //..define the relationship with Studio
    public function studio(){
        return $this->belongsTo(Studio::class);
    }

    //..define the relationship with Studio
    public function statu(){
        return $this->belongsTo(Status::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}