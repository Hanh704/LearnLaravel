<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Tên Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/client.css') }}">
    @yield('styles')
</head>


<body>
    <header>
        <!-- Top Bar -->
        <div class="top-bar py-2">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Số điện thoại và Email liên hệ -->
                    <div class="col-md-6 d-none d-md-block">
                        <div class="top-bar-contact">
                            <span class="me-3">
                                <i class="fas fa-phone-alt me-1"></i> 03.56789.087
                            </span>
                            <span>
                                <i class="fas fa-envelope me-1"></i> sttchat123@gmail.com
                            </span>
                        </div>
                    </div>
                    <!-- Link Theo dõi đơn hàng, Cửa hàng -->
                    <div class="col-md-6 text-end ">
                        <div class="top-bar-links">
                            <a href="#" class="me-3">
                                <i class="fas fa-truck me-1"></i>Theo dõi đơn hàng
                            </a>
                            <a href="#" class="me-3">
                                <i class="fas fa-map-marker-alt me-1"></i>Hệ thống cửa hàng
                            </a>
                            <a href="#" class="me-3">
                                <i class="fas fa-user-friends me-1"></i>Hỗ trợ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Top Bar -->
    
        <!-- Main Navbar -->
        <nav class="main-navbar navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" height="40">
                </a>
    
                <!-- Nút toggle Mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>
    
                <!-- Menu Chính -->
                <div class="collapse navbar-collapse" id="mainNav">
                    <!-- Menu trái -->
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('client.products.index') }}">Sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('client.posts.index') }}">Bài viết</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('client.contact') }}">Liên hệ</a>
                        </li>
                    </ul>
    
                    <!-- Menu phải (icon, tài khoản) -->
                    <ul class="navbar-nav align-items-center">
                        <!-- Giỏ Hàng -->
                        <li class="nav-item me-2">
                            <a class="nav-link position-relative" href="#">
                                <i class="fas fa-shopping-bag fa-lg"></i>
                                <span class="cart-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    0
                                </span>
                            </a>
                        </li>
    
                        <!-- Đăng nhập/Đăng ký hoặc Tài Khoản -->
                        @guest
                            <li class="nav-item me-2">
                                <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                            </li>
                            <li class="nav-item me-2">
                                <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle fa-lg me-1"></i>
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('client.profile') }}">
                                            <i class="fas fa-user me-2"></i>Tài khoản
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /Main Navbar -->
    </header>
    

    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <!-- Logo và thông tin chính -->
            <div class="row mb-4">
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <a href="{{ route('home') }}" class="d-inline-block mb-3">
                        <img src="{{ asset('images/logo-white.png') }}" alt="Logo" height="40">
                    </a>
                    <p class="mb-3">VeeWear – Phong cách thời trang hiện đại
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-icon me-2" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon me-2" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon me-2" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-icon me-2" aria-label="Google">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon" aria-label="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Danh mục liên kết -->
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-3">Danh mục nổi bật</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#" class="text-white text-decoration-none">
                                <i class="fas fa-angle-right me-2"></i>Áo thun
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-white text-decoration-none">
                                <i class="fas fa-angle-right me-2"></i>Áo khoác
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-white text-decoration-none">
                                <i class="fas fa-angle-right me-2"></i>Quần jeans
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-white text-decoration-none">
                                <i class="fas fa-angle-right me-2"></i>Phụ kiện thời trang
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Thể loại blog -->
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-3">Hỗ trợ khách hàng
                    </h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#" class="text-white text-decoration-none">
                                <i class="fas fa-angle-right me-2"></i>Tin tức
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-white text-decoration-none">
                                <i class="fas fa-angle-right me-2"></i>Hướng dẫn
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Dịch vụ khác -->
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-3">Website đối tác</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#" class="text-white text-decoration-none">
                                <i class="fas fa-angle-right me-2"></i>SMM1S.COM
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-white text-decoration-none">
                                <i class="fas fa-angle-right me-2"></i>SIEUSTORE.COM
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Thông tin liên hệ -->
                <div class="col-lg-2 col-md-6">
                    <h5 class="text-uppercase mb-3">Kết nối với chúng tôi
                    </h5>
                    <div class="contact-info">
                        <div class="d-flex mb-3">
                            <div class="contact-icon me-3">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <p class="m-0">Phone</p>
                                <a href="tel:0978364572" class="text-white text-decoration-none">03.56789.087</a>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="contact-icon me-3">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <p class="m-0">Email</p>
                                <a href="mailto:sttchat123@gmail.com"
                                    class="text-white text-decoration-none">sttchat123@gmail.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Đường kẻ ngăn cách -->
            <hr class="my-3 bg-secondary">

            <!-- Copyright và các liên kết chính sách -->
            <div class="row align-items-center">
                <div class="col-md-6 text-md-start text-center mb-2 mb-md-0">
                    <p class="mb-0">Copyright 2024, All Rights Reserved | Software By VeeWear</p>
                </div>
                <div class="col-md-6 text-md-end text-center">
                    <a href="#" class="text-white text-decoration-none me-3">Chính sách bảo mật</a>
                    <a href="#" class="text-white text-decoration-none">Điều khoản & Điều kiện</a>
                </div>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/client.js') }}"></script>
    @yield('scripts')
    @section('styles')
        <style>
            /* Footer styling - Enhanced version */
            footer {
                background-color: #0c0c0c !important;
                position: relative;
                overflow: hidden;
                box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.1);
            }

            footer::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 3px;
                background: linear-gradient(90deg, #007bff, #00c6ff, #0072ff);
            }

            footer .container {
                position: relative;
                z-index: 1;
            }

            footer h5 {
                font-size: 1.1rem;
                font-weight: 700;
                position: relative;
                padding-bottom: 15px;
                margin-bottom: 20px;
                color: #ffffff;
                letter-spacing: 0.5px;
                text-transform: uppercase;
            }

            footer h5:after {
                content: '';
                position: absolute;
                left: 0;
                bottom: 0;
                width: 40px;
                height: 3px;
                background: linear-gradient(90deg, #007bff, #00c6ff);
                border-radius: 2px;
            }

            footer p {
                font-size: 0.95rem;
                color: #b0b0b0;
                line-height: 1.6;
            }

            .social-links {
                display: flex;
                margin-top: 20px;
            }

            .social-icon {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 38px;
                height: 38px;
                border-radius: 50%;
                background-color: rgba(255, 255, 255, 0.08);
                color: #e0e0e0;
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                margin-right: 12px;
                font-size: 0.9rem;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .social-icon:hover {
                background-color: #007bff;
                color: white;
                transform: translateY(-5px) scale(1.1);
                box-shadow: 0 6px 12px rgba(0, 123, 255, 0.3);
            }

            footer ul {
                padding-left: 5px;
            }

            footer ul li {
                margin-bottom: 12px;
                position: relative;
            }

            footer ul li a {
                font-size: 0.95rem;
                color: #b0b0b0 !important;
                transition: all 0.3s ease;
                display: inline-block;
                position: relative;
                padding-left: 18px;
            }

            footer ul li a .fas {
                position: absolute;
                left: 0;
                top: 50%;
                transform: translateY(-50%);
                font-size: 0.8rem;
                color: #007bff;
                transition: all 0.3s ease;
            }

            footer ul li a:hover {
                color: #ffffff !important;
                padding-left: 22px;
            }

            footer ul li a:hover .fas {
                left: 4px;
                color: #00c6ff;
            }

            .contact-info {
                margin-top: 15px;
            }

            .contact-info .d-flex {
                margin-bottom: 20px;
            }

            .contact-icon {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 45px;
                height: 45px;
                border-radius: 50%;
                background: linear-gradient(145deg, #0a0a0a, #1e1e1e);
                color: #007bff;
                box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2),
                    -5px -5px 10px rgba(30, 30, 30, 0.1);
                transition: all 0.3s ease;
            }

            .contact-info .d-flex:hover .contact-icon {
                background: linear-gradient(145deg, #007bff, #0056b3);
                color: white;
                transform: scale(1.1);
            }

            .contact-info p {
                margin: 0;
                font-size: 0.8rem;
                color: #888;
                font-weight: 500;
            }

            .contact-info a {
                font-size: 0.95rem;
                color: #e0e0e0 !important;
                font-weight: 500;
                transition: all 0.3s ease;
            }

            .contact-info a:hover {
                color: #007bff !important;
                letter-spacing: 0.5px;
            }

            footer hr {
                height: 1px;
                background-color: rgba(255, 255, 255, 0.1);
                border: none;
                margin: 25px 0;
                opacity: 1;
            }

            footer .row.align-items-center {
                padding: 10px 0;
            }

            footer .row.align-items-center p {
                font-size: 0.85rem;
                color: #888;
                margin: 0;
            }

            footer .row.align-items-center a {
                font-size: 0.85rem;
                color: #b0b0b0 !important;
                transition: all 0.3s ease;
                margin-left: 15px;
                position: relative;
            }

            footer .row.align-items-center a:after {
                content: '';
                position: absolute;
                bottom: -3px;
                left: 0;
                width: 0;
                height: 1px;
                background-color: #007bff;
                transition: all 0.3s ease;
            }

            footer .row.align-items-center a:hover {
                color: #ffffff !important;
            }

            footer .row.align-items-center a:hover:after {
                width: 100%;
            }

            /* Responsive adjustments */
            @media (max-width: 991.98px) {
                footer .col-lg-2 {
                    flex: 0 0 auto;
                    width: 50%;
                }
            }

            @media (max-width: 767.98px) {
                footer h5 {
                    margin-top: 30px;
                    font-size: 1rem;
                }

                footer .col-lg-4 {
                    text-align: center;
                }

                footer h5:after {
                    left: 50%;
                    transform: translateX(-50%);
                }

                .social-links {
                    justify-content: center;
                }

                footer ul li a {
                    text-align: center;
                    display: block;
                    padding-left: 0;
                }

                footer ul li a .fas {
                    position: static;
                    margin-right: 5px;
                    transform: none;
                }

                footer ul li a:hover {
                    padding-left: 0;
                }

                .contact-info {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                }
            }

            /* Subtle background pattern */
            footer::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image:
                    radial-gradient(rgba(255, 255, 255, 0.03) 2px, transparent 2px);
                background-size: 30px 30px;
                opacity: 0.2;
                pointer-events: none;
            }
            /* ========== Top Bar ========== */
.top-bar {
    background-color: #f8f8f8;
    border-bottom: 1px solid #ececec;
    font-size: 0.9rem;
}

.top-bar-contact span {
    color: #777;
    margin-right: 15px;
}

.top-bar-links a {
    color: #777;
    font-weight: 500;
    transition: color 0.3s;
    font-size: 0.85rem;
}

.top-bar-links a:hover {
    color: #007bff;
    text-decoration: none;
}

/* ========== Main Navbar ========== */
.main-navbar {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.navbar-brand img {
    max-height: 40px;
    transition: transform 0.3s;
}

.navbar-brand img:hover {
    transform: scale(1.05);
}

.nav-link {
    color: #444 !important;
    font-weight: 500;
    transition: color 0.3s;
}


.nav-link:hover {
    color: #007bff !important;
}

.navbar-toggler {
    border: none;
}

/* Giỏ hàng - biểu tượng + badge */
.nav-link .cart-count {
    font-size: 0.7rem;
    padding: 3px 5px;
}

/* Sticky Header (tuỳ chọn - khi cuộn trang) */
.sticky-header {
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    z-index: 999;
    animation: slideDown 0.4s ease-in-out;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

@keyframes slideDown {
    from {
        transform: translateY(-100%);
    }
    to {
        transform: translateY(0);
    }
}

        </style>
    @endsection

</body>

</html>
