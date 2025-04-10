<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(){
        $query = Review::query();
        $query->orderby('id', 'desc');
        $reviews = $query->paginate(10);
        $reviewsDeletes = Review::onlyTrashed()->get();
        return view('admin.reviews.index', compact('reviews','reviewsDeletes'));
    }

    public function create(){
        $users = Customer::all();
        $products = Product::all();
        return view('admin.reviews.create', compact('users', 'products'));
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:255',
        ]);

        Review::create($validateData);
        return redirect()->route('admin.reviews.index')->with('success', 'Thêm đánh giá thành công');
    }

    public function edit($id){
        $review = Review::findOrFail($id);
        $users = Customer::all();
        $products = Product::all();
        return view('admin.reviews.edit', compact('review', 'users', 'products'));
    }

    public function update(Request $request, $id){
        $validateData = $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:255',
        ]);

        $review = Review::findOrFail($id);
        $review->update($validateData);
        return redirect()->route('admin.reviews.index')->with('success', 'Cập nhật đánh giá thành công');
    }

    public function destroy($id){
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Xóa đánh giá thành công');
    }

    public function restore($id){
        $review = Review::withTrashed()->findOrFail($id);
        $review->restore();
        return redirect()->route('admin.reviews.index')->with('success', 'Khôi phục đánh giá thành công');
    }
    public function deletePermanently($id){
        $review = Review::withTrashed()->findOrFail($id);
        $review->forceDelete();
        return redirect()->route('admin.reviews.index')->with('success', 'Xóa vĩnh viễn đánh giá thành công');
    }
}
