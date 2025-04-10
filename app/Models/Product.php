<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'ma_san_pham',
        'ten_san_pham',
        'category_id',
        'image',
        'gia',
        'gia_khuyen_mai',
        'so_luong',
        'ngay_nhap',
        'mota',
        'trang_thai'
    ];
    // Tạo mối quan hệ với bảng product {1-N}

    public function products(){
        return $this->hasMany(Product::class,'category_id');
    }

    // Tạo mối quan hẹ với bảng Categories

    public function categories(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function reviews()
{
    return $this->hasMany(Review::class, 'product_id'); // Kiểm tra lại tên foreign key nếu cần
}

}
