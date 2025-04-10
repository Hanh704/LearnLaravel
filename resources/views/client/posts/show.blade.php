@extends('layouts.client')

@section('title', $post->title)

@section('styles')
<style>
    .post-header {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        padding: 3rem 0;
        margin-bottom: 3rem;
        position: relative;
    }
    
    .post-header::after {
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
    
    .post-header .container {
        position: relative;
        z-index: 1;
    }
    
    .post-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .post-meta {
        color: rgba(255,255,255,0.8);
        margin-bottom: 0;
    }
    
    .post-meta i {
        margin-right: 0.25rem;
    }
    
    .post-meta span {
        margin-right: 1rem;
    }
    
    .post-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #333;
    }
    
    .post-content img {
        max-width: 100%;
        height: auto;
        margin: 1.5rem 0;
        border-radius: 0.5rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .post-content h2,
    .post-content h3 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }
    
    .post-content p {
        margin-bottom: 1.5rem;
    }
    
    .post-content blockquote {
        padding: 1rem 1.5rem;
        margin: 1.5rem 0;
        background-color: #f8f9fa;
        border-left: 4px solid #007bff;
        font-style: italic;
    }
    
    .post-image {
        width: 100%;
        height: auto;
        max-height: 500px;
        object-fit: cover;
        border-radius: 0.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .social-share {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #eee;
    }
    
    .social-share a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 0.5rem;
        color: white;
        transition: all 0.3s ease;
    }
    
    .social-share a:hover {
        transform: translateY(-3px);
    }
    
    .social-share .facebook {
        background-color: #3b5998;
    }
    
    .social-share .twitter {
        background-color: #1da1f2;
    }
    
    .social-share .linkedin {
        background-color: #0077b5;
    }
    
    .social-share .pinterest {
        background-color: #bd081c;
    }
    
    .related-posts {
        margin-top: 4rem;
        padding-top: 2rem;
        border-top: 1px solid #eee;
    }
    
    .related-post-card {
        transition: all 0.3s ease;
        height: 100%;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .related-post-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .related-post-image {
        height: 150px;
        object-fit: cover;
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
    }
    
    .related-post-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        height: 50px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
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
    
    @media (max-width: 767.98px) {
        .post-header {
            padding: 2rem 0;
        }
        
        .post-title {
            font-size: 1.75rem;
        }
    }
</style>
@endsection

@section('content')
<!-- Post Header -->
<header class="post-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('client.posts.index') }}">Bài viết</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
                    </ol>
                </nav>
                <h1 class="post-title">{{ $post->title }}</h1>
                <p class="post-meta">
                    <span><i class="far fa-calendar-alt"></i> {{ $post->created_at->format('d/m/Y') }}</span>
                    @if($post->category)
                    <span><i class="far fa-folder"></i> {{ $post->category->name }}</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Post Image -->
            @if($post->image)
            <img src="{{ asset('storage/'.$post->image) }}" class="post-image" alt="{{ $post->title }}">
            @endif

            <!-- Post Content -->
            <div class="post-content">
                {!! $post->content !!}
            </div>

            <!-- Social Share -->
            <div class="social-share">
                <h5>Chia sẻ bài viết:</h5>
                <div class="d-flex">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" class="twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($post->title) }}" target="_blank" class="linkedin">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(request()->url()) }}&media={{ urlencode(asset($post->image)) }}&description={{ urlencode($post->title) }}" target="_blank" class="pinterest">
                        <i class="fab fa-pinterest-p"></i>
                    </a>
                </div>
            </div>

            <!-- Related Posts -->
            @if($relatedPosts->count() > 0)
            <div class="related-posts">
                <h3 class="mb-4">Bài viết liên quan</h3>
                <div class="row">
                    @foreach($relatedPosts as $relatedPost)
                    <div class="col-md-6 mb-4">
                        <div class="card related-post-card h-100">
                            <a href="{{ route('client.posts.show', $relatedPost->slug) }}">
                                <img src="{{ asset('storage/'.$relatedPost->image ?: 'images/default-post.jpg') }}" class="related-post-image card-img-top" alt="{{ $relatedPost->title }}">
                            </a>
                            <div class="card-body">
                                <h5 class="related-post-title">
                                    <a href="{{ route('client.posts.show', $relatedPost->slug) }}" class="text-decoration-none text-dark">
                                        {{ $relatedPost->title }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted small">
                                    <i class="far fa-calendar-alt me-1"></i> {{ $relatedPost->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Xử lý hình ảnh trong nội dung
        const contentImages = document.querySelectorAll('.post-content img');
        contentImages.forEach(img => {
            img.classList.add('img-fluid');
            
            // Tạo lightbox đơn giản nếu muốn
            img.addEventListener('click', function() {
                const src = this.getAttribute('src');
                // Implement lightbox here if needed
            });
        });
    });
</script>
@endsection