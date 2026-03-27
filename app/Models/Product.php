<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $fillable=['name','price','stock','vendor_id','image'];
    
    public function vendor(){ 
        return $this->belongsTo(Vendor::class); 
    }
    public function getImageUrlAttribute()
    {
        return $this->image 
            ? Storage::url($this->image) 
            : 'https://via.placeholder.com/300?text=No+Image';
    }

}
