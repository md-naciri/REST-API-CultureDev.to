<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'content',
        'user_id',
        'category_id'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'article_tags');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
