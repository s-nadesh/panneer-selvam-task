<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id','name','price','quantity','description'];

    public function productimage(){
        return $this->hasOne(ProductImage::class);
    }

}
