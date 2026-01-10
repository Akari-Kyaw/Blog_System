<?php

namespace App\Models;

use CreateFavouritesTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    use HasFactory;
    public $guarded=[];

 public function category(){
    return $this->belongsTo(category::class);
 }

 public function tags(){
    return $this->belongsToMany(tag::class);
 }
 public function likes(){
   return $this->hasmany(like::class);
}
public function comments(){
   return $this->hasmany(Comment::class);
}
public function favourites(){
   return $this->hasmany(favourite::class);
}
public function user(){
   return $this->belongsTo(User::class);
}
}
