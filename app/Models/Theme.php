<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
