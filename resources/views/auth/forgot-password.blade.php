@extends('layouts.auth')

@section('title', 'Quên mật khẩu')

@section('content')
<div class="auth-card">
    <div class="auth-header">
        <h2 class="auth-title">Quên mật khẩu?</h2>
        <p class="auth-subtitle">Nhập email để đặt lại mật khẩu của bạn</p>
    </div>
    
    <div class="auth-body">
        @if(session('status'))
            <div class="alert alert-success mb-3">
                {{ session('status') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            
            <div class="form-floating mb-4">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                <label for="email">Địa chỉ Email</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-paper-plane me-2"></i> Gửi liên kết đặt lại mật khẩu
                </button>
            </div>
        </form>
    </div>
    
    <div class="auth-footer">
        <p class="mb-0"><a href="{{ route('login') }}" class="text-decoration-none"><i class="fas fa-arrow-left me-1"></i> Quay lại đăng nhập</a></p>
    </div>
</div>
@endsection
