@extends('layouts.client')

@section('title', $product->ten_san_pham)

@section('styles')
    <style>
        .product-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .product-thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .product-thumbnail.active {
            border-color: #007bff;
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #dc3545;
        }

        .product-price-original {
            text-decoration: line-through;
            color: #6c757d;
            font-size: 1.2rem;
        }

        .quantity-control {
            display: flex;
            align-items: center;
        }

        .quantity-btn {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            cursor: pointer;
        }

        .quantity-input {
            width: 60px;
            text-align: center;
            border-left: 0;
            border-right: 0;
        }

        .review-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .star-rating .fas,
        .star-rating .far {
            color: #ffc107;
        }

        .nav-tabs .nav-link.active {
            font-weight: bold;
            border-bottom: 3px solid #007bff;
        }

        .rating-input {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .rating-input input {
            display: none;
        }

        .rating-input label {
            cursor: pointer;
            font-size: 1.5rem;
            padding: 0 0.1rem;
            color: #ffc107;
        }

        .rating-input label:hover,
        .rating-input label:hover~label,
        .rating-input input:checked~label {
            color: #ffc107;
        }

        .rating-input label:hover i,
        .rating-input label:hover~label i,
        .rating-input input:checked~label i {
            content: "\f005";
            font-weight: 900;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang Chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('client.products.index') }}">Sản Phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->ten_san_pham }}</li>
            </ol>
        </nav>

        <div class="row mb-5">
            <!-- Ảnh sản phẩm -->
            <div class="col-md-5 mb-4">
                <div class="card border-0">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top product-image" id="mainImage"
                        alt="{{ $product->ten_san_pham }}">

                    @if (isset($product->gallery) && is_array($product->gallery) && count($product->gallery) > 0)
                        <div class="d-flex mt-3 overflow-auto">
                            <!-- Ảnh gallery: ảnh chính luôn được hiển thị đầu tiên -->
                            <img src="{{ asset($product->image) }}" class="product-thumbnail me-2 active"
                                onclick="changeImage(this.src)" alt="{{ $product->ten_san_pham }}">
                            @foreach ($product->gallery as $image)
                                <img src="{{ asset($image) }}" class="product-thumbnail me-2"
                                    onclick="changeImage(this.src)" alt="{{ $product->ten_san_pham }}">
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="col-md-7">
                <h1 class="mb-3">{{ $product->ten_san_pham }}</h1>
                <div class="mb-3">
                    <div class="d-flex align-items-center">
                        <div class="star-rating me-2">
                            @php
                                $avgRating = $product->reviews->avg('rating') ?? 0;
                                $roundedRating = round($avgRating);
                            @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $roundedRating)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="text-muted">({{ $product->reviews->count() }} đánh giá)</span>
                        @if ($product->ma_san_pham)
                            <span class="ms-3 text-muted">Mã: {{ $product->ma_san_pham }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3">
                    @if ($product->gia_khuyen_mai && $product->gia_khuyen_mai < $product->gia)
                        <span class="product-price">{{ number_format($product->gia_khuyen_mai) }}đ</span>
                        <span class="product-price-original ms-2">{{ number_format($product->gia) }}đ</span>
                        <span
                            class="badge bg-danger ms-2">-{{ round((($product->gia - $product->gia_khuyen_mai) / $product->gia) * 100) }}%</span>
                    @else
                        <span class="product-price">{{ number_format($product->gia) }}đ</span>
                    @endif
                </div>

                <div class="mb-3">
                    <p class="text-muted">{{ $product->mota }}</p>
                </div>

                <!-- Chọn số lượng và trạng thái hàng hóa -->
                <div class="mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Số lượng</label>
                            <div class="quantity-control">
                                <button type="button" class="quantity-btn" id="decreaseBtn">-</button>
                                <input type="number" class="form-control quantity-input" id="quantity" name="quantity"
                                    value="1" min="1" max="{{ $product->so_luong }}">
                                <button type="button" class="quantity-btn" id="increaseBtn">+</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tình trạng</label>
                            <div>
                                @if ($product->so_luong > 0)
                                    <span class="badge bg-success">Còn hàng</span>
                                @else
                                    <span class="badge bg-secondary">Hết hàng</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Các hành động -->
                <div class="d-grid gap-2 d-md-flex">
                    <button class="btn btn-primary flex-grow-1" id="addToCartBtn"
                        {{ $product->so_luong <= 0 ? 'disabled' : '' }}>
                        <i class="fas fa-cart-plus me-2"></i> Thêm vào giỏ hàng
                    </button>
                    <button class="btn btn-outline-primary flex-grow-1">
                        <i class="fas fa-heart me-2"></i> Thêm vào yêu thích
                    </button>
                </div>

                <hr class="my-4">

                <!-- Chia sẻ sản phẩm -->
                <div>
                    <h5>Chia sẻ sản phẩm:</h5>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-outline-primary">
                            <i class="fab fa-facebook"></i> Facebook
                        </a>
                        <a href="#" class="btn btn-outline-info">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="#" class="btn btn-outline-danger">
                            <i class="fab fa-pinterest"></i> Pinterest
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Phần đánh giá sản phẩm -->
        <!-- Phần đánh giá sản phẩm -->
        <div class="row">
            <div class="col-12">
                <h4>Đánh giá sản phẩm</h4>
                <hr>

                @auth
                    <!-- Form đánh giá sản phẩm -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Viết đánh giá của bạn</h5>
                            <form action="{{ route('client.reviews.store', $product->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Đánh giá của bạn</label>
                                    <div class="rating-input mb-2">
                                        <div class="star-rating">
                                            @for ($i = 5; $i >= 1; $i--)
                                                <input type="radio" id="star{{ $i }}" name="rating"
                                                    value="{{ $i }}" required>
                                                <label for="star{{ $i }}"><i class="far fa-star"></i></label>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Nội dung đánh giá</label>
                                    <textarea class="form-control" id="comment" name="content" rows="3" required minlength="10"></textarea>
                                    <div class="form-text">Tối thiểu 10 ký tự</div>
                                </div>
                                <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i> Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để viết
                        đánh giá cho sản phẩm này.
                    </div>
                @endauth

                <!-- Danh sách đánh giá -->
                @auth
                    @if ($reviews->count() > 0)
                        @foreach ($reviews as $review)
                            <div class="d-flex mb-3">
                                <img src="{{ asset('images/default-avatar.png') }}" alt="Avatar"
                                    class="review-avatar me-3">
                                <div>
                                    <div class="d-flex align-items-center">
                                        <strong>{{ $review->user->name ?? 'Anonymous' }}</strong>
                                        <div class="ms-3 star-rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="mb-1">{{ $review->comment }}</p>
                                    <small class="text-muted">{{ $review->created_at->format('d/m/Y') }}</small>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-3">
                            <p class="text-muted">Chưa có đánh giá nào cho sản phẩm này.</p>
                        </div>
                    @endif
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i> Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để xem
                        đánh giá sản phẩm.
                    </div>
                @endauth
            </div>
        </div>
<!-- Sản phẩm liên quan -->
<div class="row mt-5">
    <h4>Sản phẩm liên quan</h4>
    <hr>
    @if ($relatedProducts->count() > 0)
        <div class="row">
            @foreach ($relatedProducts as $relatedProduct)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $relatedProduct->image) }}" class="card-img-top" alt="{{ $relatedProduct->ten_san_pham }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $relatedProduct->ten_san_pham }}</h5>
                            <p class="card-text">{{ number_format($relatedProduct->gia) }}đ</p>
                            <a href="{{ route('client.products.show', $relatedProduct->id) }}" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Không có sản phẩm liên quan.</p>
    @endif
</div>
    </div>
@endsection

@section('scripts')
    <script>
        // Hàm thay đổi ảnh chính khi click vào thumbnail
        function changeImage(src) {
            document.getElementById('mainImage').src = src;
            // Cập nhật lớp active cho thumbnail
            document.querySelectorAll('.product-thumbnail').forEach(function(img) {
                img.classList.remove('active');
                if (img.src === src) {
                    img.classList.add('active');
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('quantity');
            const decreaseBtn = document.getElementById('decreaseBtn');
            const increaseBtn = document.getElementById('increaseBtn');

            // Giảm số lượng
            decreaseBtn.addEventListener('click', function() {
                let currentVal = parseInt(quantityInput.value);
                if (currentVal > 1) {
                    quantityInput.value = currentVal - 1;
                }
            });

            // Tăng số lượng (không vượt quá số hàng tồn kho)
            increaseBtn.addEventListener('click', function() {
                let currentVal = parseInt(quantityInput.value);
                if (currentVal < parseInt(quantityInput.getAttribute('max'))) {
                    quantityInput.value = currentVal + 1;
                }
            });

            // Xử lý thêm sản phẩm vào giỏ hàng
            document.getElementById('addToCartBtn').addEventListener('click', function() {
                let quantity = quantityInput.value;
                fetch('/cart/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            product_id: {{ $product->id }},
                            quantity: quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Cập nhật số lượng sản phẩm trên giỏ hàng nếu có
                            const cartBadge = document.querySelector('.cart-badge');
                            if (cartBadge) {
                                cartBadge.textContent = data.cartCount;
                            }
                            alert('Đã thêm sản phẩm vào giỏ hàng!');
                        } else {
                            alert(data.message || 'Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng.');
                    });
            });
        });
    </script>

@endsection
