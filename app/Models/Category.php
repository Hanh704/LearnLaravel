<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    use HasFactory;

    // MOdel muốn theo tác với bảng nào thì sẽ quy định ở biến table

    protected $table = 'categories';

    // Fillable cho phép điền dữ liệu vào các cột tương ứng
    protected $fillable = [
        'ten_danh_muc',
        'trang_thai',
    ];
}
