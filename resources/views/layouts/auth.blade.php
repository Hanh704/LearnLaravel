<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Hệ thống xác thực')</title>
    
    <!-- Bootstrap CSS từ CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .auth-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
        }
        
        .auth-card {
            width: 100%;
            max-width: 450px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }
        
        .auth-header {
            background-color: #4e73df;
            color: white;
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid #4668ce;
        }
        
        .auth-title {
            margin: 0;
            font-size: 1.75rem;
            font-weight: 600;
        }
        
        .auth-subtitle {
            margin-top: 0.5rem;
            opacity: 0.8;
        }
        
        .auth-body {
            padding: 2rem;
        }
        
        .auth-footer {
            text-align: center;
            padding: 1rem;
            background-color: #f8f9fa;
            border-top: 1px solid #e3e6f0;
        }
        
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: #4e73df;
        }
        
        .form-control:focus {
            border-color: #bac8f3;
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }
        
        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
        }
        
        .btn-primary:hover {
            background-color: #4668ce;
            border-color: #4668ce;
        }
        
        .auth-divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
        }
        
        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e3e6f0;
        }
        
        .auth-divider span {
            padding: 0 1rem;
            color: #6c757d;
            font-size: 0.875rem;
        }
        
        .social-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0.5rem 1rem;
            font-weight: 500;
        }
        
        .social-btn i {
            margin-right: 0.5rem;
            font-size: 1.25rem;
        }
        
        .btn-google {
            background-color: #ea4335;
            border-color: #ea4335;
            color: white;
        }
        
        .btn-facebook {
            background-color: #3b5998;
            border-color: #3b5998;
            color: white;
        }
        
        .btn-google:hover, .btn-facebook:hover {
            opacity: 0.9;
            color: white;
        }
        
        .main-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #e3e6f0;
            padding: 1.5rem 0;
            color: #6c757d;
            text-align: center;
        }
        
        .logo {
            height: 50px;
            margin-bottom: 1rem;
        }
        
        .invalid-feedback {
            font-size: 80%;
        }
        
        @media (max-width: 576px) {
            .auth-card {
                border-radius: 0;
                box-shadow: none;
            }
            
            .auth-container {
                padding: 0;
            }
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="https://via.placeholder.com/150x50?text=Your+Logo" alt="Logo" height="40">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Liên hệ</a>
                    </li>
                    @if(auth()->check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="">Hồ sơ</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Đăng xuất
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="auth-container">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Tên Công Ty. Đã đăng ký bản quyền.</p>
        </div>
    </footer>

    <!-- Bootstrap JS từ CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
</body>
</html>
