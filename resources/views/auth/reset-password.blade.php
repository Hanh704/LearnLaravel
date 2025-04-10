@extends('layouts.auth')

@section('title', 'Đặt lại mật khẩu')

@section('content')
<div class="auth-card">
    <div class="auth-header">
        <h2 class="auth-title">Đặt lại mật khẩu</h2>
        <p class="auth-subtitle">Tạo mật khẩu mới cho tài khoản của bạn</p>
    </div>
    
    <div class="auth-body">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            
            <input type="hidden" name="token" value="{{ $token }}">
            
            <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com" value="{{ $email ?? old('email') }}" required autofocus>
                <label for="email">Địa chỉ Email</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Mật khẩu mới" required>
                <label for="password">Mật khẩu mới</label>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-floating mb-4">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Xác nhận mật khẩu" required>
                <label for="password_confirmation">Xác nhận mật khẩu</label>
            </div>
            
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-key me-2"></i> Đặt lại mật khẩu
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
