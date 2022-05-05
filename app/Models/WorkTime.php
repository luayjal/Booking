<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkTime extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','days','from','to','status'];

    public function shop(){
        return $this->belongsTo(User::class,'user_id');
    }
}
