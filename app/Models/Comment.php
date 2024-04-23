<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    use HasFactory;
    
    protected $fillable = ['picture_id','user_id','body'];
    
    public function getPaginateByLimit(int $limit_count = 10)
      {
        // created_atで降順に並べたあと、limitで件数制限をかける
        return $this->with('picture')->orderBy('created_at', 'DESC')->paginate($limit_count);
      }
    public function picture()
      {
        return $this->belongsTo(Picture::class);
      }
    
    public function user()
      {
        return $this->belongsTo(User::class);
      }
    public function replies()   
        {
            return $this->hasMany(Reply::class);  
        }
}
