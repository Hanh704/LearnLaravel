<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\Review;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    // Trang chủ
    public function home()
    {
        // Lấy banner
        $banners = Banner::where('trang_thai', 1)->get();

        // Lấy 8 sản phẩm mới nhất
        $latestProducts = Product::where('trang_thai', 1)
            ->latest()
            ->take(8)
            ->get();

        // Lấy 4 bài viết mới nhất
        $latestPosts = Post::latest()
            ->take(4)
            ->get();

        // Lấy 10 đánh giá mới nhất có điểm cao nhất
        $topReviews = Review::where('trang_thai', 1)
            ->orderBy('rating', 'desc')
            ->latest()
            ->take(10)
            ->with(['user', 'product'])
            ->get();

        return view('client.home', compact('banners', 'latestProducts', 'latestPosts', 'topReviews'));
    }

    // Danh sách sản phẩm
    // Sửa phương thức productIndex để sử dụng tên cột đúng
    public function productIndex(Request $request)
    {
        // Xây dựng truy vấn cơ bản
        $query = Product::where('trang_thai', 1);

        // Tìm kiếm theo tên
        if ($request->has('search')) {
            $query->where('ten_san_pham', 'like', '%' . $request->search . '%');
        }

        // Lọc theo danh mục
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Lọc theo khoảng giá
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('gia', '>=', $request->min_price);
        }

        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('gia', '<=', $request->max_price);
        }

        // Sắp xếp
        if ($request->has('sort')) {
            if ($request->sort == 'price_asc') {
                $query->orderBy('gia', 'asc');
            } elseif ($request->sort == 'price_desc') {
                $query->orderBy('gia', 'desc');
            }
        } else {
            $query->latest();
        }
        // Thực hiện phân trang
        $products = $query->paginate(10);

        $categories = Category::where('trang_thai', 1)->get();
        return view('client.products.index', compact('products', 'categories'));
    }


    // Chi tiết sản phẩm
    public function productShow($id)
    {
        // Lấy thông tin sản phẩm
        $product = Product::findOrFail($id);

        // Lấy 5 sản phẩm cùng danh mục
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('trang_thai', 1)
            ->take(5)
            ->get();

        // Lấy tất cả đánh giá của sản phẩm
        $reviews = $product->reviews()
            ->with('user')
            ->latest()
            ->get();
        // dd($reviews);
        return view('client.products.show', compact('product', 'relatedProducts', 'reviews'));
    }

    // Danh sách bài viết
    public function postIndex()
    {
        $posts = Post::latest()
            ->paginate(10);

        return view('client.posts.index', compact('posts'));
    }

    // Chi tiết bài viết
    public function postShow($slug)
    {
        $post = Post::where('slug', $slug)
            ->firstOrFail();

        // Lấy các bài viết liên quan
        $relatedPosts = Post::where('id', '!=', $post->id)
            ->latest()
            ->take(4)
            ->get();

        return view('client.posts.show', compact('post', 'relatedPosts'));
    }

    // Thêm đánh giá sản phẩm
    public function reviewStore(Request $request, $productId)
    {
        // Kiểm tra đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để đánh giá sản phẩm.');
        }
    
        $product = Product::findOrFail($productId);
    
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:10',  // Changed from 'comment' to 'content' to match form field
        ], [
            'rating.required' => 'Vui lòng chọn số sao đánh giá.',
            'rating.integer' => 'Đánh giá phải là số nguyên.',
            'rating.min' => 'Đánh giá phải từ 1 đến 5 sao.',
            'rating.max' => 'Đánh giá phải từ 1 đến 5 sao.',
            'content.required' => 'Vui lòng nhập nội dung đánh giá.',
            'content.min' => 'Nội dung đánh giá phải có ít nhất 10 ký tự.',
        ]);
    
        // Kiểm tra người dùng đã đánh giá sản phẩm này chưa
        $existingReview = Review::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();
    
        if ($existingReview) {
            // Cập nhật đánh giá hiện có
            $existingReview->update([
                'rating' => $request->rating,
                'content' => $request->content,  // Changed from 'comment' to 'content'
            ]);
    
            return redirect()->back()->with('success', 'Đánh giá của bạn đã được cập nhật!');
        }
    
        // Tạo đánh giá mới
        Review::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'content' => $request->content,  // Changed from 'comment' to 'content'
            // 'trang_thai' => 1,
        ]);
    
        return redirect()->back()->with('success', 'Cảm ơn bạn đã đánh giá sản phẩm!');
    }
    

    // Trang liên hệ
    public function contact()
    {
        return view('client.contact');
    }

    // Xử lý form liên hệ
    public function contactStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ], [
            'name.required' => 'Vui lòng nhập họ tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'message.required' => 'Vui lòng nhập nội dung liên hệ.',
        ]);

        $contactData = $request->only(['name', 'email', 'phone', 'message']);

        // Thêm user_id nếu người dùng đã đăng nhập
        if (auth()->check()) {
            $contactData['user_id'] = auth()->id();
        }

        // Lưu thông tin liên hệ
        $contact = Contact::create($contactData);

        // Gửi email thông báo (nếu cần)
        // Mail::to($request->email)->send(new ContactThankyou($contact));

        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ với chúng tôi. Chúng tôi sẽ phản hồi sớm nhất có thể!');
    }

    // Trang profile người dùng
    public function profile()
    {
        // Kiểm tra đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        return view('client.profile.index', compact('user'));
    }

    // Cập nhật thông tin profile
    public function profileUpdate(Request $request)
    {
        // Kiểm tra đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $user->update($request->only(['name', 'email', 'phone', 'address']));

        return redirect()->route('client.profile')->with('success', 'Thông tin tài khoản đã được cập nhật!');
    }
}
