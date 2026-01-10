<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favourite extends Model
{
   public $guarded=[];

    use HasFactory;
    public function blog(){
        return $this->belongsTo(blog::class);
     }
     public function user(){
        return $this->belongsTo(User::class);
     }
}
