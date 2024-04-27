<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Theme extends Model
{
    use HasFactory;
    protected $fillable = [
    'title',
    ];
    public function pictures()   
    {
        return $this->hasMany(Picture::class);  
    }
}
