@extends('layouts.auth')

@section('title', 'Đăng nhập')

@section('content')
<div class="auth-card">
    <div class="auth-header">
        <h2 class="auth-title">Đăng nhập</h2>
        <p class="auth-subtitle">Đăng nhập để truy cập tài khoản của bạn</p>
    </div>
    
    <div class="auth-body">
        @if(session('status'))
            <div class="alert alert-success mb-3">
                {{ session('status') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger mb-3">
                {{ session('error') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                <label for="email">Địa chỉ Email</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Mật khẩu" required>
                <label for="password">Mật khẩu</label>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Ghi nhớ đăng nhập
                    </label>
                </div>
                
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-decoration-none">
                        Quên mật khẩu?
                    </a>
                @endif
            </div>
            
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-sign-in-alt me-2"></i> Đăng nhập
                </button>
            </div>
        </form>
        
        <div class="auth-divider">
            <span>HOẶC</span>
        </div>
        
        <div class="d-grid gap-2">
            <a href="#" class="btn social-btn btn-google">
                <i class="fab fa-google"></i> Đăng nhập với Google
            </a>
            <a href="#" class="btn social-btn btn-facebook">
                <i class="fab fa-facebook-f"></i> Đăng nhập với Facebook
            </a>
        </div>
    </div>
    
    <div class="auth-footer">
        <p class="mb-0">Chưa có tài khoản? <a href="{{ route('register') }}" class="text-decoration-none fw-bold">Đăng ký ngay</a></p>
    </div>
</div>
@endsection
