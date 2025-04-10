@extends('layouts.client')

@section('title', 'Trang chủ')

@section('content')
    <!-- Banner -->
    <div id="homeCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach ($banners as $key => $banner)
                <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="{{ $key }}"
                    class="{{ $key == 0 ? 'active' : '' }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @forelse($banners as $key => $banner)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <a href="{{ $banner->url }}" target="_blank" class="banner-link">
                        <img src="{{ asset('storage/' . $banner->image) }}" class="d-block w-100" alt="Banner">
                    </a>
                </div>
            @empty
                <!-- Banner mặc định nếu không có banner nào -->
                <div class="carousel-item active">
                    <a href="{{ route('client.products.index') }}" class="banner-link">
                        <img src="{{ asset('images/default-banner.jpg') }}" class="d-block w-100" alt="Banner mặc định">
                    </a>
                </div>
            @endforelse
        </div>

        @if (count($banners) > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        @endif
    </div>

    <!-- Sản phẩm mới nhất -->
    <section class="mb-5">
        <div class="container">
            <h2 class="text-center mb-4 position-relative">
                <span class="position-relative px-4 bg-white">Sản phẩm mới nhất</span>
                <div class="position-absolute"
                    style="height: 2px; background-color: #ddd; width: 100%; top: 50%; left: 0; z-index: -1;"></div>
            </h2>

            <div class="row">
                @foreach ($latestProducts as $product)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 product-card shadow-sm border-0 rounded">
                            <div class="position-relative overflow-hidden">
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                    alt="{{ $product->ten_san_pham }}" style="height: 200px; object-fit: cover;">

                                @if ($product->gia_khuyen_mai && $product->gia_khuyen_mai < $product->gia)
                                    <div
                                        class="position-absolute top-0 start-0 bg-danger text-white py-1 px-2 m-2 rounded-pill">
                                        -{{ round((($product->gia - $product->gia_khuyen_mai) / $product->gia) * 100) }}%
                                    </div>
                                @endif

                                <div class="product-overlay d-flex justify-content-center align-items-center">
                                    <a href="{{ route('client.products.show', $product->id) }}"
                                        class="btn btn-sm btn-light rounded-circle mx-1" title="Xem chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-light rounded-circle mx-1"
                                        title="Thêm vào giỏ hàng">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-light rounded-circle mx-1" title="Yêu thích">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="card-body p-3">
                                <div class="small text-muted mb-1">{{ $product->ma_san_pham }}</div>
                                <h5 class="card-title mb-2 product-title">
                                    <a href="{{ route('client.products.show', $product->id) }}"
                                        class="text-decoration-none text-dark">{{ $product->ten_san_pham }}</a>
                                </h5>

                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="product-price">
                                        @if ($product->gia_khuyen_mai)
                                            <span
                                                class="text-danger fw-bold">{{ number_format($product->gia_khuyen_mai) }}đ</span>
                                            <del class="small text-muted ms-2">{{ number_format($product->gia) }}đ</del>
                                        @else
                                            <span class="text-danger fw-bold">{{ number_format($product->gia) }}đ</span>
                                        @endif
                                    </div>

                                    @if ($product->so_luong > 0)
                                        <span class="badge bg-success">Còn hàng</span>
                                    @else
                                        <span class="badge bg-secondary">Hết hàng</span>
                                    @endif
                                </div>

                                <div class="product-rating mb-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= ($product->average_rating ?? 0))
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                    <span class="small text-muted ms-1">({{ $product->reviews_count ?? 0 }})</span>
                                </div>

                                <p class="card-text small text-muted mb-3">
                                    {{ Str::limit($product->mota, 80) }}
                                </p>
                            </div>

                            <div class="card-footer bg-white border-top-0 p-3">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('client.products.show', $product->id) }}"
                                        class="btn btn-outline-primary">
                                        <i class="fas fa-info-circle me-1"></i> Chi tiết
                                    </a>
                                    <button class="btn btn-primary">
                                        <i class="fas fa-cart-plus me-1"></i> Thêm vào giỏ
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('client.products.index') }}" class="btn btn-outline-primary px-4 py-2">
                    <i class="fas fa-th-list me-2"></i>Xem tất cả sản phẩm
                </a>
            </div>
        </div>
    </section>

    <!-- Bài viết mới nhất -->
    <section class="mb-5 bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4 position-relative">
                <span class="position-relative px-4 bg-light">Bài viết mới nhất</span>
                <div class="position-absolute"
                    style="height: 2px; background-color: #ddd; width: 100%; top: 50%; left: 0; z-index: -1;"></div>
            </h2>

            <div class="row">
                @foreach ($latestPosts as $post)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ asset('storage/'.$post->image) }}" class="card-img-top" alt="{{ $post->title }}"
                                style="height: 180px; object-fit: cover;">
                            <div class="card-body">
                                <div class="small text-muted mb-2">
                                    <i class="far fa-calendar-alt me-1"></i> {{ $post->created_at->format('d/m/Y') }}
                                </div>
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ Str::limit($post->excerpt, 100) }}</p>
                            </div>
                            <div class="card-footer bg-white border-top-0 text-end">
                                <a href="{{ route('client.posts.show', $post->slug) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-book-reader me-1"></i> Đọc thêm
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('client.posts.index') }}" class="btn btn-outline-primary px-4 py-2">
                    <i class="far fa-newspaper me-2"></i>Xem tất cả bài viết
                </a>
            </div>
        </div>
    </section>

    <!-- Đánh giá cao nhất -->
    <section class="mb-5">
        <div class="container">
            <h2 class="text-center mb-4 position-relative">
                <span class="position-relative px-4 bg-white">Đánh giá nổi bật</span>
                <div class="position-absolute"
                    style="height: 2px; background-color: #ddd; width: 100%; top: 50%; left: 0; z-index: -1;"></div>
            </h2>

            <div class="row">
                @foreach ($topReviews as $review)
                    @if ($review->product && $review->user)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0">
                                            <img src="https://via.placeholder.com/50" class="rounded-circle"
                                                alt="User Avatar">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="mb-1">{{ $review->user->name }}</h5>
                                            <div class="d-flex align-items-center">
                                                <div class="me-2">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $review->rating)
                                                            <i class="fas fa-star text-warning"></i>
                                                        @else
                                                            <i class="far fa-star text-warning"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <small
                                                    class="text-muted">{{ $review->created_at->format('d/m/Y') }}</small>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($review->product)
                                        <div class="d-flex align-items-center mb-3 p-2 bg-light rounded">
                                            <img src="{{ asset($review->product->image) }}"
                                                alt="{{ $review->product->ten_san_pham }}" class="img-thumbnail me-2"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                            <div>
                                                <h6 class="mb-1">
                                                    <a href="{{ route('client.products.show', $review->product->id) }}"
                                                        class="text-decoration-none text-dark">
                                                        {{ $review->product->ten_san_pham }}
                                                    </a>
                                                </h6>
                                                <div class="product-price small">
                                                    @if ($review->product->gia_khuyen_mai)
                                                        <span
                                                            class="text-danger">{{ number_format($review->product->gia_khuyen_mai) }}đ</span>
                                                        <del
                                                            class="text-muted ms-1">{{ number_format($review->product->gia) }}đ</del>
                                                    @else
                                                        <span
                                                            class="text-danger">{{ number_format($review->product->gia) }}đ</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="review-content">
                                        <p class="card-text mb-0">{{ $review->comment }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('styles')
    <style>
        /* Styles hiện tại cho sản phẩm - giữ nguyên */
        .product-card {
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .product-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.2);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .carousel-inner:hover {
            cursor: pointer;
        }

        .product-card:hover .product-overlay {
            opacity: 1;
        }

        .product-title {
            height: 48px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .review-content {
            position: relative;
            max-height: 80px;
            overflow: hidden;
        }

        /* Styles cập nhật cho banner */
        .carousel-item img {
            height: 500px;
            object-fit: cover;
        }

        /* Thêm cursor pointer cho banner */
        .banner-link {
            cursor: pointer;
            display: block;
        }

        /* Cập nhật style cho indicators */
        .carousel-indicators {
            bottom: 20px;
        }

        .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin: 0 5px;
            background-color: rgba(255, 255, 255, 0.5);
        }

        .carousel-indicators button.active {
            background-color: #fff;
        }
    </style>
@endsection

@section('scripts')
    <script>
        // Thêm FontAwesome nếu chưa có
        if (!document.querySelector('link[href*="fontawesome"]')) {
            const fontAwesome = document.createElement('link');
            fontAwesome.rel = 'stylesheet';
            fontAwesome.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css';
            document.head.appendChild(fontAwesome);
        }

        // Các script bổ sung có thể thêm ở đây
        document.addEventListener('DOMContentLoaded', function() {
            // Hiệu ứng hover cho sản phẩm
            const productCards = document.querySelectorAll('.product-card');
            productCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.querySelector('.product-overlay').style.opacity = '1';
                });
                card.addEventListener('mouseleave', function() {
                    this.querySelector('.product-overlay').style.opacity = '0';
                });
            });
        });
    </script>
@endsection
