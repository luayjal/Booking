<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','category_id','lat','lng','location','logo'];
    protected $appends = ['logo_path'];

    public function getLogoPathAttribute()
    {
        if ($this->logo) {
           return asset($this->logo);
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    
}
