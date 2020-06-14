<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'content', 'image', 'published_at', 'category_id'];
    protected $table = 'posts';

    public function category()
    {
       return $this->belongsTo(Category::class);
    }
}
