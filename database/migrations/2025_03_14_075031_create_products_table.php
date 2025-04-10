<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Mỗi 1 file migration dùng để thao tác 1 công việc với CSDL
    // Trong file migration luôn có 2 hàm UP và DOWN
    // Hàm UP thực hiện công việc mới mà ta muốn chỉnh sửa
    // Hàm DOWN thực hiện các công việc người lại với hàm UP
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // Xét độ dài và quy định giá trị không trùng nhau
            $table->string('ma_san_pham', 20)->unique();
            $table->string('ten_san_pham');
            $table->decimal('gia',10,2);
            $table->decimal('gia_khuyen_mai',10,2)->nullable();
            $table->unsignedInteger('so_luong');
            $table->date('ngay_nhap');
            $table->text('mota')->nullable();
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
