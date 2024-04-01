<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Picture extends Model
{
    use SoftDeletes;
    use HasFactory;
    public function getPaginateByLimit(int $limit_count = 20)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this::with('theme')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    protected $fillable = [
        'title',
        'path',
        'theme_id'
    ];
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
}
