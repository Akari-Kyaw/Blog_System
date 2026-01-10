<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    // public $fillable=['name'];
    public $guarded=[];

    public function blogs(){
        return $this->hasMany(blog::class);
     }
}
