<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index(){
        $query = Banner::query();
        $query->orderby('id', 'desc');
        $banners = $query->paginate(10);
        $bannerDeletes = Banner::onlyTrashed()->get();
        return view('admin.banners.index', compact('banners','bannerDeletes'));
    }

    public function create(){
       
        return view('admin.banners.create');
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'url' => 'required|url:http,https',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            'url' => ':attribute không hợp lệ',
        ], [
           
            'url' => 'Đường dẫn',
            'image' => 'Ảnh',
        ]);

        // Xử lý ảnh
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/banners', 'public');
            $validateData['image'] = $imagePath;
        };

        Banner::create($validateData);
        return redirect()->route('admin.banners.index')->with('success', 'Thêm banner thành công');
    }

    public function edit($id){
        $banner = Banner::findOrFail($id);
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, $id){
        $banner = Banner::findOrFail($id);
        $validateData = $request->validate([
            'url' => 'required|url:http,https',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            'url' => ':attribute không hợp lệ',
        ], [
           
            'url' => 'Đường dẫn',
            'image' => 'Ảnh',
        ]);

        // Xử lý ảnh
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/banners', 'public');
            $validateData['image'] = $imagePath;
            // Xóa ảnh cũ
            if($banner->image){   
                Storage::disk('public')->delete($banner->image);
            }
        };

        $banner->update($validateData);
        return redirect()->route('admin.banners.index')->with('success', 'Sửa banner thành công');
    }
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Xóa sản phẩm thành công');
    }
    public function restore($id)
    {
        $banner = Banner::onlyTrashed()->find($id);
        $banner->restore();
        return redirect()->route('admin.banners.index')->with('success', 'Khôi phục ảnh bìa thành công');
    }

    public function deletePermanently($id)
    {
        $banner = Banner::findOrFail($id);
        // Xóa ảnh cũ
        if ($banner->image) {
            Storage::disk('public')->delete($banner->image);
        }
        $banner = Banner::withTrashed()->find($id);
        $banner->forceDelete();
        return redirect()->route('admin.banners.index')->with('success', 'Xóa sản phẩm thành công');
    }
}
