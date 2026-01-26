<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','email','image'];

    public function getImageAttribute(){
        if (!isset($this->attributes['image'])) {
            return null;
        }

        return $this->attributes['image']
            ? asset( $this->attributes['image'])
            : null;
    }
}
