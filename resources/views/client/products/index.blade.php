@extends('layouts.client')

@section('title', 'Danh sách sản phẩm')

@section('styles')
    <style>
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

        .product-image {
            height: 450px;
            object-fit: cover;
        }

        .product-price {
            font-weight: bold;
            color: #dc3545;
        }

        .product-price-original {
            text-decoration: line-through;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .filter-card {
            position: sticky;
            top: 20px;
        }

        .badge-sale {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 1;
        }

        @media (max-width: 767.98px) {
            .filter-card {
                position: static;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb" class="mt-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
            </ol>
        </nav>

        <h1 class="mb-4">Danh sách sản phẩm</h1>

        <div class="row">
            <!-- Sidebar - Filters -->
            <div class="col-lg-3 mb-4">
                <div class="card shadow-sm filter-card">
                    <div class="card-body">
                        <form action="{{ route('client.products.index') }}" method="GET" id="filterForm">
                            <!-- Search Filter -->
    <div class="mb-4">
        <h5 class="d-flex justify-content-between align-items-center">
            <span>Tìm kiếm</span>
            <i class="fas fa-search"></i>
        </h5>
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Tên sản phẩm..." name="search" value="{{ request('search') }}">
            <button class="btn btn-outline-primary" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

                            <!-- Phần Categories Filter -->
                            <div class="mb-4">
                                <h5 class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                                    data-bs-target="#categoryCollapse">
                                    <span>Danh mục</span>
                                    <i class="fas fa-chevron-down"></i>
                                </h5>
                                <div class="collapse show" id="categoryCollapse">
                                    <div class="mt-2">
                                        @foreach ($categories as $category)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="category"
                                                    id="category{{ $category->id }}" value="{{ $category->id }}"
                                                    {{ request('category') == $category->id ? 'checked' : '' }}>
                                                <label class="form-check-label" for="category{{ $category->id }}">
                                                    {{ $category->ten_danh_muc }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- Price Range Filter -->
                            <div class="mb-4">
                                <h5 class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                                    data-bs-target="#priceCollapse">
                                    <span>Khoảng giá</span>
                                    <i class="fas fa-chevron-down"></i>
                                </h5>
                                <div class="collapse show" id="priceCollapse">
                                    <div class="mt-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="min_price" class="form-label">Từ:</label>
                                                <input type="number" class="form-control" id="min_price" name="min_price"
                                                    value="{{ request('min_price') }}" placeholder="0đ">
                                            </div>
                                            <div class="col-6">
                                                <label for="max_price" class="form-label">Đến:</label>
                                                <input type="number" class="form-control" id="max_price" name="max_price"
                                                    value="{{ request('max_price') }}" placeholder="5,000,000đ">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sort Filter -->
                            <div class="mb-4">
                                <h5 class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                                    data-bs-target="#sortCollapse">
                                    <span>Sắp xếp</span>
                                    <i class="fas fa-chevron-down"></i>
                                </h5>
                                <div class="collapse show" id="sortCollapse">
                                    <div class="mt-2">
                                        <select class="form-select" name="sort" id="sort">
                                            <option value="">Mặc định</option>
                                            <option value="price_asc"
                                                {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá: Thấp đến cao
                                            </option>
                                            <option value="price_desc"
                                                {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá: Cao đến thấp
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Filter Actions -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Áp dụng</button>
                                <a href="{{ route('client.products.index') }}" class="btn btn-outline-secondary">Đặt
                                    lại</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Main Content - Products -->
            <div class="col-lg-9">
                <!-- Sort and View Options -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <span>Hiển thị {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} của
                            {{ $products->total() }} sản phẩm</span>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-secondary active" id="gridView">
                            <i class="fas fa-th-large"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" id="listView">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>

                <!-- Active Filters -->
                @if (request('search') || request('category') || request('min_price') || request('max_price') || request('sort'))
                    <div class="mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Bộ lọc đang áp dụng:</h5>
                                <div class="d-flex flex-wrap gap-2">
                                    @if (request('search'))
                                        <span class="badge bg-primary">Tìm kiếm: {{ request('search') }} <a
                                                href="{{ route('client.products.index', array_merge(request()->except('search'), ['page' => 1])) }}"
                                                class="text-white ms-1"><i class="fas fa-times"></i></a></span>
                                    @endif

                                    @if (request('category'))
                                        @php
                                            $categoryName =
                                                $categories->where('id', request('category'))->first()->name ?? '';
                                        @endphp
                                        <span class="badge bg-primary">Danh mục: {{ $categoryName }} <a
                                                href="{{ route('client.products.index', array_merge(request()->except('category'), ['page' => 1])) }}"
                                                class="text-white ms-1"><i class="fas fa-times"></i></a></span>
                                    @endif

                                    @if (request('min_price') || request('max_price'))
                                        <span class="badge bg-primary">
                                            Giá:
                                            {{ request('min_price') ? number_format(request('min_price')) . 'đ' : '0đ' }}
                                            -
                                            {{ request('max_price') ? number_format(request('max_price')) . 'đ' : 'Không giới hạn' }}
                                            <a href="{{ route('client.products.index', array_merge(request()->except(['min_price', 'max_price']), ['page' => 1])) }}"
                                                class="text-white ms-1"><i class="fas fa-times"></i></a>
                                        </span>
                                    @endif

                                    @if (request('sort'))
                                        <span class="badge bg-primary">
                                            Sắp xếp:
                                            @if (request('sort') == 'price_asc')
                                                Giá: Thấp đến cao
                                            @elseif(request('sort') == 'price_desc')
                                                Giá: Cao đến thấp
                                            @endif
                                            <a href="{{ route('client.products.index', array_merge(request()->except('sort'), ['page' => 1])) }}"
                                                class="text-white ms-1"><i class="fas fa-times"></i></a>
                                        </span>
                                    @endif

                                    <a href="{{ route('client.products.index') }}" class="badge bg-danger">Xóa tất cả <i
                                            class="fas fa-times"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Products Grid -->
                <div class="row" id="productsGrid">
                    @forelse($products as $product)
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card product-card shadow-sm h-100">
                                @if ($product->gia_khuyen_mai && $product->gia_khuyen_mai < $product->gia)
                                    <div class="badge-sale">
                                        <span class="badge bg-danger">
                                            -{{ round((($product->gia - $product->gia_khuyen_mai) / $product->gia) * 100) }}%
                                        </span>
                                    </div>
                                @endif

                                <a href="{{ route('client.products.show', $product->id) }}">
                                    <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top product-image"
                                        alt="{{ $product->ten_san_pham }}">
                                </a>

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title product-title">
                                        <a href="{{ route('client.products.show', $product->id) }}"
                                            class="text-decoration-none text-dark">
                                            {{ $product->ten_san_pham }}
                                        </a>
                                    </h5>

                                    <div class="mt-auto">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="me-auto">
                                                @if ($product->gia_khuyen_mai && $product->gia_khuyen_mai < $product->gia)
                                                    <span
                                                        class="product-price">{{ number_format($product->gia_khuyen_mai) }}đ</span>
                                                    <span
                                                        class="product-price-original ms-2">{{ number_format($product->gia) }}đ</span>
                                                @else
                                                    <span class="product-price">{{ number_format($product->gia) }}đ</span>
                                                @endif
                                            </div>

                                            @if ($product->so_luong > 0)
                                                <span class="badge bg-success">Còn hàng</span>
                                            @else
                                                <span class="badge bg-secondary">Hết hàng</span>
                                            @endif
                                        </div>

                                        <div class="d-grid gap-2">
                                            <a href="{{ route('client.products.show', $product->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye me-1"></i> Chi tiết
                                            </a>
                                            <button class="btn btn-sm btn-primary add-to-cart"
                                                data-product-id="{{ $product->id }}"
                                                {{ $product->so_luong <= 0 ? 'disabled' : '' }}>
                                                <i class="fas fa-cart-plus me-1"></i> Thêm vào giỏ
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                <i class="fas fa-info-circle me-2"></i> Không tìm thấy sản phẩm nào phù hợp với bộ lọc.
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Products List (Hidden by default) -->
                <div class="d-none" id="productsList">
                    @forelse($products as $product)
                        <div class="card mb-3 product-card shadow-sm">
                            <div class="row g-0">
                                <div class="col-md-3 position-relative">
                                    @if ($product->gia_khuyen_mai && $product->gia_khuyen_mai < $product->gia)
                                        <div class="badge-sale">
                                            <span class="badge bg-danger">
                                                -{{ round((($product->gia - $product->gia_khuyen_mai) / $product->gia) * 100) }}%
                                            </span>
                                        </div>
                                    @endif
                                    <a href="{{ route('client.products.show', $product->id) }}">
                                        <img src="{{ asset('storage/'.$product->image) }}"
                                            class="img-fluid rounded-start h-100 w-100 product-image"
                                            alt="{{ $product->ten_san_pham }}" style="object-fit: cover;">
                                    </a>
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body h-100 d-flex flex-column">
                                        <h5 class="card-title">
                                            <a href="{{ route('client.products.show', $product->id) }}"
                                                class="text-decoration-none text-dark">
                                                {{ $product->ten_san_pham }}
                                            </a>
                                        </h5>
                                        <p class="card-text">{{ Str::limit($product->mota, 150) }}</p>

                                        <div class="mt-auto">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="me-auto">
                                                    @if ($product->gia_khuyen_mai && $product->gia_khuyen_mai < $product->gia)
                                                        <span
                                                            class="product-price">{{ number_format($product->gia_khuyen_mai) }}đ</span>
                                                        <span
                                                            class="product-price-original ms-2">{{ number_format($product->gia) }}đ</span>
                                                    @else
                                                        <span
                                                            class="product-price">{{ number_format($product->gia) }}đ</span>
                                                    @endif
                                                </div>

                                                @if ($product->so_luong > 0)
                                                    <span class="badge bg-success">Còn hàng</span>
                                                @else
                                                    <span class="badge bg-secondary">Hết hàng</span>
                                                @endif
                                            </div>

                                            <div class="d-flex gap-2">
                                                <a href="{{ route('client.products.show', $product->id) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye me-1"></i> Chi tiết
                                                </a>
                                                <button class="btn btn-sm btn-primary add-to-cart"
                                                    data-product-id="{{ $product->id }}"
                                                    {{ $product->so_luong <= 0 ? 'disabled' : '' }}>
                                                    <i class="fas fa-cart-plus me-1"></i> Thêm vào giỏ
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle me-2"></i> Không tìm thấy sản phẩm nào phù hợp với bộ lọc.
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle between grid and list view
            document.getElementById('gridView').addEventListener('click', function() {
                this.classList.add('active');
                document.getElementById('listView').classList.remove('active');
                document.getElementById('productsGrid').classList.remove('d-none');
                document.getElementById('productsList').classList.add('d-none');
            });

            document.getElementById('listView').addEventListener('click', function() {
                this.classList.add('active');
                document.getElementById('gridView').classList.remove('active');
                document.getElementById('productsList').classList.remove('d-none');
                document.getElementById('productsGrid').classList.add('d-none');
            });

            // Auto-submit form when sort changes
            document.getElementById('sort').addEventListener('change', function() {
                document.getElementById('filterForm').submit();
            });

            // Add to cart functionality
            const addToCartButtons = document.querySelectorAll('.add-to-cart');
            addToCartButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    // Thêm logic thêm vào giỏ hàng ở đây
                    alert('Đã thêm sản phẩm vào giỏ hàng!');
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Tự động submit form khi thay đổi radio button danh mục
    document.querySelectorAll('input[name="category"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    });
    
    // Auto-submit form khi thay đổi sort
    document.getElementById('sort').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });
    
    // Tìm kiếm realtime (tùy chọn)
    let searchTimeout;
    document.querySelector('input[name="search"]').addEventListener('keyup', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            if (this.value.length >= 2 || this.value.length === 0) {
                document.getElementById('filterForm').submit();
            }
        }, 500);
    });
});
    </script>
@endsection
