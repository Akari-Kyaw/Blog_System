<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    use HasFactory;
    public $guarded=[];

    public function blogs(){
        return $this->belongsToMany(tag::class);
    }
}
