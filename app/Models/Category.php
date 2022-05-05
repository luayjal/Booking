<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory ,SoftDeletes;
    protected $fillable  = ['name_ar','name_en','image'];
    protected $appends  = ['image_path'];

    public function getImagePathAttribute()
    {
        if ($this->image) {
           return asset($this->image);
        }
    }

    public function shops(){
        return $this->hasMany(Shop::class,'category_id');
    }
}
