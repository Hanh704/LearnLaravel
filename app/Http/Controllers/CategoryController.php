<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request){
        $query = Category::query();
        $query->orderBy('id', 'desc');
        if($request->filled('ten_danh_muc')){
            $query->where('ten_danh_muc', 'like', '%' . $request->ten_danh_muc . '%')->paginate(10);
        }
        $cate = Category::all();
        if ($request->has('trang_thai') && $request->trang_thai !== '2') {
            $query->whereIn('trang_thai', [$request->trang_thai]);
        }
        $categories = $query->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create(){
        return view('admin.categories.create');
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'ten_danh_muc' => 'required|max:255|unique:categories',
            'trang_thai' => 'required|boolean',
        ], [
            'required' => ':attribute không được để trống',
            'max' => ':attribute không được vượt quá :max ký tự',
            'unique' => ':attribute đã tồn tại',
            'boolean' => ':attribute phải là true hoặc false',
        ], [
            'ten_danh_muc' => 'Tên danh mục',
            'trang_thai' => 'Trạng thái',
        ]);
        Category::create($validateData);
        return redirect()->route('admin.categories.index')->with('success','Thêm mới danh mục thành công');
    }

    public function edit($id){
        $categories = Category::query()->findOrFail($id);
        return view('admin.categories.edit', compact('categories')); 
    }

    public function update(Request $request, $id){
        $categories = Category::findOrFail($id);
        $validateData = $request->validate([
            'ten_danh_muc' => 'required|max:255|unique:categories,ten_danh_muc,'.$id,
            'trang_thai' => 'required|boolean',
        ], [
            'required' => ':attribute không được để trống',
            'max' => ':attribute không được vượt quá :max ký tự',
            'unique' => ':attribute đã tồn tại',
            'boolean' => ':attribute phải là true hoặc false',
        ], [
            'ten_danh_muc' => 'Tên danh mục',
            'trang_thai' => 'Trạng thái',
        ]);
        $categories->update($validateData);
        return redirect()->route('admin.categories.index')->with('success','Cập nhật danh mục thành công');
    }
}
