<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        '_at',
        'user_id',
        'article_id'
    ];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function articles()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}