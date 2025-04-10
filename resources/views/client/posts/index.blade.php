@extends('layouts.client')

@section('title', 'Danh sách bài viết')

@section('styles')
<style>
    /* Styling cho trang danh sách bài viết */
    .post-card {
        transition: all 0.3s ease;
        height: 100%;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .post-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .post-image {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
    }
    
    .post-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
        line-height: 1.4;
        height: 56px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    
    .post-meta {
        color: #6c757d;
        font-size: 0.875rem;
        margin-bottom: 0.75rem;
    }
    
    .post-excerpt {
        color: #6c757d;
        margin-bottom: 1rem;
        height: 72px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }
    
    .post-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
        border-top: 1px solid rgba(0,0,0,0.05);
        padding-top: 1rem;
    }
    
    .post-category {
        background-color: #f8f9fa;
        color: #6c757d;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    
    .page-header {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        padding: 3rem 0;
        margin-bottom: 3rem;
        position: relative;
    }
    
    .page-header::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('/images/pattern.png');
        opacity: 0.1;
        z-index: 0;
    }
    
    .page-header .container {
        position: relative;
        z-index: 1;
    }
    
    .breadcrumb {
        background-color: transparent;
        padding: 0;
        margin-bottom: 0;
    }
    
    .breadcrumb-item a {
        color: rgba(255,255,255,0.8);
    }
    
    .breadcrumb-item.active {
        color: white;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255,255,255,0.5);
    }
    
    .search-form {
        position: relative;
        margin-bottom: 2rem;
    }
    
    .search-form .form-control {
        padding-right: 45px;
        border-radius: 50px;
        height: 50px;
    }
    
    .search-form .btn {
        position: absolute;
        right: 5px;
        top: 5px;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    @media (max-width: 767.98px) {
        .page-header {
            padding: 2rem 0;
        }
        
        .post-image {
            height: 180px;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<header class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-4 fw-bold mb-2">Bài Viết & Tin Tức</h1>
                <p class="lead mb-0">Cập nhật những thông tin mới nhất về thời trang và xu hướng</p>
            </div>
            <div class="col-md-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-md-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Bài viết</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <!-- Search Form -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('client.posts.index') }}" method="GET" class="search-form">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Tìm kiếm bài viết..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Posts Grid -->
    <div class="row">
        @forelse($posts as $post)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card post-card h-100">
                <a href="{{ route('client.posts.show', $post->slug) }}">
                    <img src="{{ asset('storage/'.$post->image ?: 'images/default-post.jpg') }}" class="post-image card-img-top" alt="{{ $post->title }}">
                </a>
                <div class="card-body d-flex flex-column">
                    <h2 class="post-title">
                        <a href="{{ route('client.posts.show', $post->slug) }}" class="text-decoration-none">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <div class="post-meta">
                        <i class="far fa-calendar-alt me-1"></i> {{ $post->created_at->format('d/m/Y') }}
                    </div>
                    <p class="post-excerpt">{{ Str::limit(strip_tags($post->content), 150) }}</p>
                    <div class="post-footer">
                        <span class="post-category">
                            {{ $post->category->name ?? 'Chưa phân loại' }}
                        </span>
                        <a href="{{ route('client.posts.show', $post->slug) }}" class="btn btn-sm btn-outline-primary">
                            Đọc tiếp <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="py-5">
                <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                <h3>Không tìm thấy bài viết nào</h3>
                <p class="text-muted">Hiện chưa có bài viết nào hoặc không tìm thấy bài viết phù hợp với yêu cầu của bạn.</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4 mb-5">
        {{ $posts->withQueryString()->links() }}
    </div>

    <!-- Featured Categories -->
    <div class="row mt-5">
        <div class="col-12">
            <h2 class="text-center mb-4">Danh Mục Nổi Bật</h2>
            <div class="row justify-content-center">
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card text-center post-card">
                        <div class="card-body">
                            <i class="fas fa-tshirt fa-3x text-primary mb-3"></i>
                            <h5>Thời Trang</h5>
                            <p class="text-muted">Khám phá xu hướng thời trang mới nhất</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">Xem thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card text-center post-card">
                        <div class="card-body">
                            <i class="fas fa-gift fa-3x text-primary mb-3"></i>
                            <h5>Khuyến Mãi</h5>
                            <p class="text-muted">Ưu đãi hấp dẫn dành cho bạn</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">Xem thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card text-center post-card">
                        <div class="card-body">
                            <i class="fas fa-question-circle fa-3x text-primary mb-3"></i>
                            <h5>Hướng Dẫn</h5>
                            <p class="text-muted">Các hướng dẫn và tips hữu ích</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">Xem thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card text-center post-card">
                        <div class="card-body">
                            <i class="fas fa-newspaper fa-3x text-primary mb-3"></i>
                            <h5>Tin Tức</h5>
                            <p class="text-muted">Cập nhật tin tức mới nhất</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">Xem thêm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Xử lý animation hoặc tương tác nếu cần
        const postCards = document.querySelectorAll('.post-card');
        
        postCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(-5px)';
            });
        });
    });
</script>
@endsection