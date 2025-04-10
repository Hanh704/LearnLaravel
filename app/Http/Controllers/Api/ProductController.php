<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with('categories');
        $query->orderby('id', 'desc');

        if ($request->filled('ma_san_pham')) {
            $query->where('ma_san_pham', 'like', '%' . $request->ma_san_pham . '%');
        }
        if ($request->filled('ten_san_pham')) {
            $query->where('ten_san_pham', 'like', '%' . $request->ten_san_pham . '%');
        }
        if ($request->filled('gia_ban_dau') && $request->filled('gia_ket_thuc')) {
            $query->whereBetween('gia', [$request->gia_ban_dau, $request->gia_ket_thuc]);
        }
        if ($request->has('ngay_bat_dau') && $request->ngay_bat_dau != '') {
            $query->whereDate('ngay_nhap', '>=', $request->ngay_bat_dau);
        }
        if ($request->has('ngay_ket_thuc') && $request->ngay_ket_thuc != '') {
            $query->whereDate('ngay_nhap', '<=', $request->ngay_ket_thuc);
        }
        if ($request->has('trang_thai') && $request->trang_thai !== '2') {
            $query->whereIn('trang_thai', [$request->trang_thai]);
        }
        $products = $query->paginate(10);
        $productDeletes = Product::onlyTrashed()->get();
        // return response()->json($products, 200);
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'ma_san_pham' => 'required|string|max:20|unique:products',
            'ten_san_pham' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gia' => 'required|numeric|max:999999999',
            'gia_khuyen_mai' => 'nullable|numeric|lt:gia',
            'so_luong' => 'required|integer|min:1',
            'ngay_nhap' => 'required|date',
            'mota' => 'nullable|string',
            'trang_thai' => 'required|boolean',
        ], [
            'required' => ':attribute không được để trống',
            'max' => ':attribute không được vượt quá :max ký tự',
            'unique' => ':attribute đã tồn tại',
            'image' => ':attribute không đúng định dạng',
            'mimes' => ':attribute không đúng định dạng',
            'max' => ':attribute không được vượt quá :max ký tự',
            'numeric' => ':attribute phải là số',
            'lt' => ':attribute phải nhỏ hơn :lt',
            'integer' => ':attribute phải là số nguyên',
            'min' => ':attribute phải lớn hơn :min',
            'date' => ':attribute phải là ngày',
            'boolean' => ':attribute phải là true hoặc false',
            'interger' => ':attribute phải là số nguyên',
            'exists' => ':attribute không hợp lệ',
        ], [
            'ma_san_pham' => 'Mã sản phẩm',
            'ten_san_pham' => 'Tên sản phẩm',
            'category_id' => 'Danh mục',
            'image' => 'Ảnh',
            'gia' => 'Giá',
            'gia_khuyen_mai' => 'Giá khuyến mãi',
            'so_luong' => 'Số lượng',
            'ngay_nhap' => 'Ngày nhập',
            'mota' => 'Mô tả',
            'trang_thai' => 'Trạng thái',
        ]);

        // Xử lý ảnh
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/products', 'public');
            $validateData['image'] = $imagePath;
        }
        // Thêm mới
        $product = Product::create($validateData);
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('categories')->findOrFail($id);
        return response()->json([
            'message' => 'Lấy sản phẩm thành công',
            'status' => 200,
            'data' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $validateData = $request->validate([
            'ma_san_pham' => 'required|string|max:20|unique:products,ma_san_pham,' . $id,
            'ten_san_pham' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gia' => 'required|numeric|max:999999999',
            'gia_khuyen_mai' => 'nullable|numeric|lt:gia',
            'so_luong' => 'required|integer|min:1',
            'ngay_nhap' => 'required|date',
            'mota' => 'nullable|string',
            'trang_thai' => 'required|boolean',
        ], [
            'required' => ':attribute không được để trống',
            'max' => ':attribute không được vượt quá :max ký tự',
            'unique' => ':attribute đã tồn tại',
            'image' => ':attribute không đúng định dạng',
            'mimes' => ':attribute không đúng định dạng',
            'max' => ':attribute không được vượt quá :max ký tự',
            'numeric' => ':attribute phải là số',
            'lt' => ':attribute phải nhỏ hơn :lt',
            'integer' => ':attribute phải là số nguyên',
            'min' => ':attribute phải lớn hơn :min',
            'date' => ':attribute phải là ngày',
            'boolean' => ':attribute phải là true hoặc false',
            'interger' => ':attribute phải là số nguyên',
            'exists' => ':attribute không hợp lệ',
        ], [
            'ma_san_pham' => 'Mã sản phẩm',
            'ten_san_pham' => 'Tên sản phẩm',
            'category_id' => 'Danh mục',
            'image' => 'Ảnh',
            'gia' => 'Giá',
            'gia_khuyen_mai' => 'Giá khuyến mãi',
            'so_luong' => 'Số lượng',
            'ngay_nhap' => 'Ngày nhập',
            'mota' => 'Mô tả',
            'trang_thai' => 'Trạng thái',
        ]);
        // Xử lý ảnh
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/products', 'public');
            $validateData['image'] = $imagePath;
            // Xóa ảnh cũ
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
        }
        // Thêm mới
        $product->update($validateData);
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        // Xóa ảnh cũ
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return response()->json(['messeage', 'Xóa sản phẩm thành công']);
    }

    public function restore(){

    }
}
