<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Picture extends Model
{
    use SoftDeletes;
    use HasFactory;
    public function getPaginateByLimit(int $limit_count = 5)
    {
        // created_atで降順に並べたあと、limitで件数制限をかける
        return $this::with('theme')->orderBy('created_at', 'DESC')->paginate($limit_count);
    }
    
    public function getOrderByLikes(int $limit_count = 5)
    {
        return $this::withCount('likes')->orderBy('likes_count', 'DESC')->paginate($limit_count);
    }
    
    // public function getComments(int $limit_count = 10)
    //   {
    //     // created_atで降順に並べたあと、limitで件数制限をかける
    //     return $this->comments()->with('comment')->orderBy('created_at', 'DESC')->paginate($limit_count);
    //   }
    
    protected $fillable = [
        'title',
        'path',
        'theme_id'
    ];
    
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class,'picture_id');
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class,'picture_id');
    }
    
    /**
     * リプライにいいねがついているか判定
     * 
     * @return bool true:Likeがついている false:Likeがついていない
     */
    public function is_liked_by_auth_user()
    {
        $id = Auth::id();
        
        $likers = array();
        foreach($this->likes as $like){
            array_push($likers, $like->user_id);
        }
        
        if (in_array($id,$likers)){
            return true;
        }else{
            return false;
        }
    }
}
