<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Hàm lấy ra danh sách sản phẩm
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
        return view('admin.products.index', compact('products', 'productDeletes'));
    }
    public function show($id)
    {
        $product = Product::with('categories')->findOrFail($id);
        return view('admin.products.show', compact('product'));
        // Hiển thị dữ liệu ra màn hình chi tiết sản phẩm
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
        // Hiển thị dữ liệu ra màn hình chi tiết sản phẩm
    }

    public function store(Request $request)
    {
        // Lấy dữ liệu gửi từ From
        // $product = new Product();
        // $product->ma_san_pham = $request->ma_san_pham;
        // $product->ten_san_pham = $request->ten_san_pham;
        // $product->category_id = $request->category_id;
        // $product->gia = $request->gia;
        // $product->gia_khuyen_mai = $request->gia_khuyen_mai;
        // $product->so_luong = $request->so_luong;
        // $product->ngay_nhap = $request->ngay_nhap;
        // $product->mota = $request->mota;
        // $product->trang_thai = $request->trang_thai;
        // if($request->hasFile('image')){
        //     $imagePath = $request->file('image')->store('images/products','public');
        //     $product->image = $imagePath;
        // }
        // // Thêm dữ liệu
        // $product->save();
        // return redirect()->route('admin.products.index');

        // Validation
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
        Product::create($validateData);
        return redirect()->route('admin.products.index');
    }

    public function edit($id)
    {
        $product = Product::with('categories')->findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
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
        return redirect()->route('admin.products.index');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công');
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->find($id);
        $product->restore();
        return redirect()->route('admin.products.index')->with('success', 'Khôi phục sản phẩm thành công');
    }

    public function deletePermanently($id)
    {
        $product = Product::findOrFail($id);
        // Xóa ảnh cũ
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product = Product::withTrashed()->find($id);
        $product->forceDelete();
        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công');
    }
}
