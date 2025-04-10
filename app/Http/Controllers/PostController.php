<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(){
        $query = Post::with('customers');
        $query->orderby('id', 'desc');
        $posts = $query->paginate(10);
        $postsDeletes = Post::onlyTrashed()->get();
        return view('admin.posts.index', compact('posts', 'postsDeletes'));
    }

    public function create(){
        $users = Customer::all();
        return view('admin.posts.create', compact('users'));
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'slug' => 'required|unique:posts',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Thêm validation cho ảnh
        ], [
            'required' => ':attribute không được để trống',
            'image' => ':attribute phải là hình ảnh',
            'mimes' => ':attribute phải có định dạng: jpeg, png, jpg, gif',
            'max' => ':attribute không được vượt quá 2MB',
        ], [
            'title' => 'Tiêu đề',
            'content' => 'Nội dung',
            'slug' => 'Slug',
            'image' => 'Ảnh bìa',
        ]);
       
        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/posts', 'public');
            $validateData['image'] = $imagePath;
        }
        
        Post::create($validateData);
        return redirect()->route('admin.posts.index')->with('success', 'Tạo bài viết thành công');
    }

    public function edit($id, Request $request){
        $post = Post::findOrFail($id);
        $users = Customer::all();
        return view('admin.posts.edit', compact('post', 'users'));
    }

    public function update(Request $request, $id){
        $post = Post::findOrFail($id);
        $validateData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Thêm validation cho ảnh
        ], [
            'required' => ':attribute không được để trống',
            'image' => ':attribute phải là hình ảnh',
            'mimes' => ':attribute phải có định dạng: jpeg, png, jpg, gif',
            'max' => ':attribute không được vượt quá 2MB',
        ], [
            'title' => 'Tiêu đề',
            'content' => 'Nội dung',
            'slug' => 'Slug',
            'image' => 'Ảnh bìa',
        ]);
        
        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            
            // Upload ảnh mới
            $imagePath = $request->file('image')->store('images/posts', 'public');
            $validateData['image'] = $imagePath;
        }
        
        $post->update($validateData);
        return redirect()->route('admin.posts.index')->with('success', 'Cập nhật bài viết thành công');
    }


    public function destroy($id){
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Xóa thành công');
    }
    public function restore($id){
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('admin.posts.index')->with('success', 'Khôi phục thành công');
    }
    public function deletePermanently($id){
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();
        return redirect()->route('admin.posts.index')->with('success', 'Xóa vĩnh viễn thành công');
    }
}
