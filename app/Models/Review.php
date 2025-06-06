<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'reviews';
    protected $fillable = [
        'user_id',
        'product_id',
        'content',
        'rating',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Lấy sản phẩm được đánh giá
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
