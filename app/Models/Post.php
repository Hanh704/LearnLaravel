<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'content',
        'slug',
        'image',
    ];
    // Tạo mối quan hệ với bảng product {1-N}

     public function posts(){
        return $this->hasMany(Post::class,'user_id');
    }

    // Tạo mối quan hẹ với bảng Categories
    public function customers(){
        return $this->belongsTo(Customer::class,'id');
    }
}
