@extends('layouts.auth')

@section('title', 'Đăng ký')

@section('content')
<div class="auth-card">
    <div class="auth-header">
        <h2 class="auth-title">Đăng ký tài khoản</h2>
        <p class="auth-subtitle">Tạo tài khoản mới chỉ trong vài phút</p>
    </div>
   
    <div class="auth-body">
        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Họ và tên" value="{{ old('name') }}" required autofocus>
                <label for="name">Họ và tên</label>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required>
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
            
            <div class="form-floating mb-4">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Xác nhận mật khẩu" required>
                <label for="password_confirmation">Xác nhận mật khẩu</label>
            </div>
            
            {{-- <div class="form-check mb-4">
                <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" name="terms" id="terms" required>
                <label class="form-check-label" for="terms">
                    Tôi đồng ý với <a href="#" class="text-decoration-none">Điều khoản dịch vụ</a> và <a href="#" class="text-decoration-none">Chính sách bảo mật</a>
                </label>
                @error('terms')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div> --}}
            
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-user-plus me-2"></i> Đăng ký
                </button>
            </div>
        </form>
        
        <div class="auth-divider">
            <span>HOẶC</span>
        </div>
        
        <div class="d-grid gap-2">
            <a href="#" class="btn social-btn btn-google">
                <i class="fab fa-google"></i> Đăng ký với Google
            </a>
            <a href="#" class="btn social-btn btn-facebook">
                <i class="fab fa-facebook-f"></i> Đăng ký với Facebook
            </a>
        </div>
    </div>
    
    <div class="auth-footer">
        <p class="mb-0">Đã có tài khoản? <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Đăng nhập</a></p>
    </div>
</div>
@endsection
