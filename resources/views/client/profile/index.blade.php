@extends('layouts.client')

@section('title', 'Thông Tin Tài Khoản')

@section('styles')
<style>
    .profile-container {
        margin-top: 30px;
        margin-bottom: 50px;
    }
    
    .profile-sidebar {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
        padding: 20px;
    }
    
    .profile-sidebar .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin: 0 auto 15px;
        overflow: hidden;
        border: 5px solid #f8f9fa;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }
    
    .profile-sidebar .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .profile-sidebar .profile-name {
        text-align: center;
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .profile-sidebar .profile-email {
        text-align: center;
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 20px;
    }
    
    .profile-sidebar .nav-pills .nav-link {
        color: #495057;
        border-radius: 5px;
        padding: 12px 15px;
        margin-bottom: 8px;
        transition: all 0.3s;
    }
    
    .profile-sidebar .nav-pills .nav-link:hover {
        background-color: #f8f9fa;
    }
    
    .profile-sidebar .nav-pills .nav-link.active {
        background-color: #007bff;
        color: white;
    }
    
    .profile-sidebar .nav-pills .nav-link i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }
    
    .profile-main {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
        padding: 30px;
    }
    
    .profile-main .nav-tabs {
        border-bottom: 1px solid #dee2e6;
        margin-bottom: 25px;
    }
    
    .profile-main .nav-tabs .nav-link {
        border: none;
        color: #6c757d;
        font-weight: 500;
        padding: 10px 15px;
        margin-right: 10px;
        position: relative;
    }
    
    .profile-main .nav-tabs .nav-link:hover {
        color: #007bff;
    }
    
    .profile-main .nav-tabs .nav-link.active {
        color: #007bff;
        background: transparent;
        border: none;
    }
    
    .profile-main .nav-tabs .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #007bff;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
    }
    
    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    
    .btn-save {
        padding: 10px 25px;
        font-weight: 500;
    }
    
    .order-card {
        border: 1px solid #eee;
        border-radius: 8px;
        margin-bottom: 15px;
        transition: all 0.3s;
    }
    
    .order-card:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transform: translateY(-3px);
    }
    
    .order-card .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #eee;
        padding: 15px;
    }
    
    .order-card .badge {
        font-size: 0.8rem;
        padding: 5px 10px;
    }
    
    .profile-stats {
        display: flex;
        justify-content: space-between;
        margin-bottom: 25px;
    }
    
    .stat-card {
        flex: 1;
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        text-align: center;
        margin: 0 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }
    
    .stat-card:first-child {
        margin-left: 0;
    }
    
    .stat-card:last-child {
        margin-right: 0;
    }
    
    .stat-card .stat-value {
        font-size: 1.8rem;
        font-weight: 600;
        color: #007bff;
        margin-bottom: 5px;
    }
    
    .stat-card .stat-label {
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .tab-pane {
        display: none;
    }
    
    .tab-pane.active {
        display: block;
    }
    
    .avatar-upload {
        position: relative;
        margin: 0 auto;
        width: 120px;
    }
    
    .avatar-upload .avatar-edit {
        position: absolute;
        right: 5px;
        bottom: 5px;
        z-index: 1;
    }
    
    .avatar-upload .avatar-edit input {
        display: none;
    }
    
    .avatar-upload .avatar-edit label {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #007bff;
        border: 1px solid transparent;
        color: white;
        cursor: pointer;
        font-size: 16px;
    }
    
    .form-group label {
        font-weight: 500;
        margin-bottom: 8px;
    }
    
    .address-card {
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        position: relative;
    }
    
    .address-card.default {
        border-color: #007bff;
        background-color: rgba(0, 123, 255, 0.05);
    }
    
    .address-card .address-actions {
        position: absolute;
        top: 15px;
        right: 15px;
    }
    
    .address-card .default-badge {
        position: absolute;
        top: -10px;
        left: 20px;
        background: #007bff;
        color: white;
        font-size: 0.7rem;
        padding: 3px 10px;
        border-radius: 15px;
    }
</style>
@endsection

@section('content')
<div class="container profile-container">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 mb-4">
            <div class="profile-sidebar">
                <div class="avatar-upload">
                    <div class="profile-avatar">
                        <img src="{{'storage/'. $user->avatar ?? asset('images/default-avatar.png') }}" alt="{{ $user->name }}">
                    </div>
                    <div class="avatar-edit">
                        <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload"><i class="fas fa-camera"></i></label>
                    </div>
                </div>
                <h5 class="profile-name">{{ $user->name }}</h5>
                <p class="profile-email">{{ $user->email }}</p>
                
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="account-tab" data-bs-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
                        <i class="fas fa-user"></i> Thông tin tài khoản
                    </a>
                    <a class="nav-link" id="orders-tab" data-bs-toggle="pill" href="#orders" role="tab" aria-controls="orders" aria-selected="false">
                        <i class="fas fa-shopping-bag"></i> Đơn hàng của tôi
                    </a>
                    <a class="nav-link" id="address-tab" data-bs-toggle="pill" href="#address" role="tab" aria-controls="address" aria-selected="false">
                        <i class="fas fa-map-marker-alt"></i> Địa chỉ giao hàng
                    </a>
                    <a class="nav-link" id="wishlist-tab" data-bs-toggle="pill" href="#wishlist" role="tab" aria-controls="wishlist" aria-selected="false">
                        <i class="fas fa-heart"></i> Sản phẩm yêu thích
                    </a>
                    <a class="nav-link" id="password-tab" data-bs-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
                        <i class="fas fa-lock"></i> Đổi mật khẩu
                    </a>
                </div>
                
                <hr class="my-4">
                
                <form action="{{ route('logout') }}" method="POST" class="d-grid">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="profile-main">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <div class="tab-content" id="v-pills-tabContent">
                    <!-- Thông tin tài khoản -->
                    <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                        <h4 class="mb-4">Thông tin tài khoản</h4>
                        
                        <div class="profile-stats">
                            <div class="stat-card">
                                <div class="stat-value">{{ $user->orders_count ?? 0 }}</div>
                                <div class="stat-label">Đơn hàng</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-value">{{ $user->reviews_count ?? 0 }}</div>
                                <div class="stat-label">Đánh giá</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-value">{{ $user->wishlist_count ?? 0 }}</div>
                                <div class="stat-label">Yêu thích</div>
                            </div>
                        </div>
                        
                        <form method="POST" action="{{ route('client.profile.update') }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Họ và tên</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->phone) }}" autocomplete="tel">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="birthday" class="form-label">Ngày sinh</label>
                                    <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday', $user->birthday ? date('Y-m-d', strtotime($user->birthday)) : '') }}">
                                    @error('birthday')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label d-block">Giới tính</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ (old('gender', $user->gender) == 'male') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="male">Nam</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ (old('gender', $user->gender) == 'female') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="female">Nữ</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="other" value="other" {{ (old('gender', $user->gender) == 'other') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="other">Khác</label>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <button type="submit" class="btn btn-primary btn-save">
                                    <i class="fas fa-save me-2"></i> Lưu thay đổi
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Đơn hàng của tôi -->
                    <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                        <h4 class="mb-4">Đơn hàng của tôi</h4>
                        
                        @if(isset($orders) && count($orders) > 0)
                            @foreach($orders as $order)
                                <div class="order-card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-0">Đơn hàng #{{ $order->order_number }}</h6>
                                            <small class="text-muted">Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                        <div>
                                            @php
                                                $statusClass = '';
                                                switch($order->status) {
                                                    case 'pending':
                                                        $statusClass = 'bg-warning';
                                                        $statusText = 'Chờ xác nhận';
                                                        break;
                                                    case 'processing':
                                                        $statusClass = 'bg-info';
                                                        $statusText = 'Đang xử lý';
                                                        break;
                                                    case 'shipping':
                                                        $statusClass = 'bg-primary';
                                                        $statusText = 'Đang giao hàng';
                                                        break;
                                                    case 'completed':
                                                        $statusClass = 'bg-success';
                                                        $statusText = 'Hoàn thành';
                                                        break;
                                                    case 'cancelled':
                                                        $statusClass = 'bg-danger';
                                                        $statusText = 'Đã hủy';
                                                        break;
                                                    default:
                                                        $statusClass = 'bg-secondary';
                                                        $statusText = 'Không xác định';
                                                }
                                            @endphp
                                            <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="mb-1"><strong>Địa chỉ:</strong> {{ $order->address }}</p>
                                                <p class="mb-1"><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
                                                <p><strong>Phương thức thanh toán:</strong> {{ $order->payment_method }}</p>
                                            </div>
                                            <div class="col-md-4 text-md-end">
                                                <p class="mb-1"><strong>Tổng tiền:</strong> {{ number_format($order->total) }}đ</p>
                                                <a href="{{ route('client.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary mt-2">
                                                    <i class="fas fa-eye me-1"></i> Xem chi tiết
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            <div class="d-flex justify-content-center mt-4">
                                {{ $orders->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                                <h5>Bạn chưa có đơn hàng nào</h5>
                                <p class="text-muted">Hãy khám phá các sản phẩm của chúng tôi và đặt hàng ngay!</p>
                                <a href="{{ route('client.products.index') }}" class="btn btn-primary mt-3">
                                    <i class="fas fa-shopping-cart me-2"></i> Mua sắm ngay
                                </a>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Địa chỉ giao hàng -->
                    <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0">Địa chỉ giao hàng</h4>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                                <i class="fas fa-plus me-2"></i> Thêm địa chỉ mới
                            </button>
                        </div>
                        
                        @if(isset($addresses) && count($addresses) > 0)
                            @foreach($addresses as $address)
                                <div class="address-card {{ $address->is_default ? 'default' : '' }}">
                                    @if($address->is_default)
                                        <div class="default-badge">Mặc định</div>
                                    @endif
                                    
                                    <div class="address-actions">
                                        <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#editAddressModal{{ $address->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        @if(!$address->is_default)
                                            <form action="{{ route('client.addresses.destroy', $address->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc muốn xóa địa chỉ này?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    
                                    <h5 class="mb-2">{{ $address->receiver_name }}</h5>
                                    <p class="mb-1"><strong>Địa chỉ:</strong> {{ $address->address }}</p>
                                    <p class="mb-1"><strong>Số điện thoại:</strong> {{ $address->phone }}</p>
                                    
                                    @if(!$address->is_default)
                                        <form action="{{ route('client.addresses.set-default', $address->id) }}" method="POST" class="mt-3">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-check me-1"></i> Đặt làm mặc định
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                
                                <!-- Edit Address Modal -->
                                <div class="modal fade" id="editAddressModal{{ $address->id }}" tabindex="-1" aria-labelledby="editAddressModalLabel{{ $address->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editAddressModalLabel{{ $address->id }}">Chỉnh sửa địa chỉ</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('client.addresses.update', $address->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="receiver_name{{ $address->id }}" class="form-label">Tên người nhận</label>
                                                        <input type="text" class="form-control" id="receiver_name{{ $address->id }}" name="receiver_name" value="{{ $address->receiver_name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="phone{{ $address->id }}" class="form-label">Số điện thoại</label>
                                                        <input type="text" class="form-control" id="phone{{ $address->id }}" name="phone" value="{{ $address->phone }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="address{{ $address->id }}" class="form-label">Địa chỉ</label>
                                                        <textarea class="form-control" id="address{{ $address->id }}" name="address" rows="3" required>{{ $address->address }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-map-marker-alt fa-3x text-muted mb-3"></i>
                                <h5>Bạn chưa có địa chỉ giao hàng nào</h5>
                                <p class="text-muted">Thêm địa chỉ để thuận tiện cho việc đặt hàng</p>
                                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                                    <i class="fas fa-plus me-2"></i> Thêm địa chỉ mới
                                </button>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Sản phẩm yêu thích -->
                    <div class="tab-pane fade" id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">
                        <h4 class="mb-4">Sản phẩm yêu thích</h4>
                        
                        @if(isset($wishlist) && count($wishlist) > 0)
                            <div class="row">
                                @foreach($wishlist as $item)
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100">
                                            <div class="position-relative">
                                                <img src="{{ asset($item->product->image) }}" class="card-img-top" alt="{{ $item->product->ten_san_pham }}" style="height: 200px; object-fit: cover;">
                                                <form action="{{ route('client.wishlist.remove', $item->id) }}" method="POST" class="position-absolute" style="top: 10px; right: 10px;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger rounded-circle" title="Xóa khỏi danh sách yêu thích">
                                                        <i class="fas fa-heart-broken"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title">{{ $item->product->ten_san_pham }}</h5>
                                                <div class="mt-auto">
                                                    <p class="card-text text-primary fw-bold">{{ number_format($item->product->gia) }}đ</p>
                                                    <div class="d-grid gap-2">
                                                        <a href="{{ route('client.products.show', $item->product->id) }}" class="btn btn-outline-primary">
                                                            <i class="fas fa-eye me-1"></i> Xem chi tiết
                                                        </a>
                                                        <button class="btn btn-primary add-to-cart" data-product-id="{{ $item->product->id }}">
                                                            <i class="fas fa-cart-plus me-1"></i> Thêm vào giỏ
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="d-flex justify-content-center mt-4">
                                {{ $wishlist->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-heart fa-3x text-muted mb-3"></i>
                                <h5>Danh sách yêu thích trống</h5>
                                <p class="text-muted">Bạn chưa thêm sản phẩm nào vào danh sách yêu thích</p>
                                <a href="{{ route('client.products.index') }}" class="btn btn-primary mt-3">
                                    <i class="fas fa-shopping-cart me-2"></i> Khám phá sản phẩm
                                </a>
                            </div>
                        @endif
                    </div>
                    
                                   <!-- Đổi mật khẩu -->
                                   <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                                    <h4 class="mb-4">Đổi mật khẩu</h4>
                                    {{-- {{ route('client.profile.change-password') }} --}}
                                    <form method="POST" action="">
                                        @csrf
                                        
                                        <div class="mb-3">
                                            <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                                            <div class="input-group">
                                                <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>
                                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="current_password">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                @error('current_password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Mật khẩu mới</label>
                                            <div class="input-group">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-text">Mật khẩu phải có ít nhất 8 ký tự và bao gồm chữ hoa, chữ thường và số.</div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                                            <div class="input-group">
                                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password_confirmation">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                            <button type="submit" class="btn btn-primary btn-save">
                                                <i class="fas fa-key me-2"></i> Cập nhật mật khẩu
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal thêm địa chỉ mới -->
            <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addAddressModalLabel">Thêm địa chỉ mới</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        {{-- client.addresses.store --}}
                        <form action="" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="receiver_name" class="form-label">Tên người nhận</label>
                                    <input type="text" class="form-control" id="receiver_name" name="receiver_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Địa chỉ</label>
                                    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="is_default" name="is_default">
                                    <label class="form-check-label" for="is_default">Đặt làm địa chỉ mặc định</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary">Thêm địa chỉ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endsection
            
            @section('scripts')
            <script>
                // Xử lý hiển thị/ẩn mật khẩu
                document.addEventListener('DOMContentLoaded', function() {
                    const toggleButtons = document.querySelectorAll('.toggle-password');
                    
                    toggleButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            const targetId = this.getAttribute('data-target');
                            const inputField = document.getElementById(targetId);
                            
                            if (inputField.type === 'password') {
                                inputField.type = 'text';
                                this.innerHTML = '<i class="fas fa-eye-slash"></i>';
                            } else {
                                inputField.type = 'password';
                                this.innerHTML = '<i class="fas fa-eye"></i>';
                            }
                        });
                    });
                    
                    // Xử lý upload avatar
                    const imageUpload = document.getElementById('imageUpload');
                    if (imageUpload) {
                        imageUpload.addEventListener('change', function() {
                            if (this.files && this.files[0]) {
                                const formData = new FormData();
                                formData.append('avatar', this.files[0]);
                                formData.append('_token', '{{ csrf_token() }}');
                                fetch('', {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Cập nhật ảnh hiển thị
                                        document.querySelector('.profile-avatar img').src = data.avatar_url;
                                        
                                        // Hiển thị thông báo thành công
                                        const alertHtml = `
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                ${data.message}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        `;
                                        document.querySelector('.profile-main').insertAdjacentHTML('afterbegin', alertHtml);
                                    } else {
                                        // Hiển thị thông báo lỗi
                                        const alertHtml = `
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                ${data.message}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        `;
                                        document.querySelector('.profile-main').insertAdjacentHTML('afterbegin', alertHtml);
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                            }
                        });
                    }
                    
                    // Xử lý thêm vào giỏ hàng từ danh sách yêu thích
                    const addToCartButtons = document.querySelectorAll('.add-to-cart');
                    
                    addToCartButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            const productId = this.getAttribute('data-product-id');
                            fetch('', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    product_id: productId,
                                    quantity: 1
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Cập nhật số lượng giỏ hàng ở header (nếu có)
                                    if (document.getElementById('cart-count')) {
                                        document.getElementById('cart-count').textContent = data.cart_count;
                                    }
                                    
                                    // Hiển thị thông báo
                                    const toastHtml = `
                                        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
                                            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="toast-header">
                                                    <strong class="me-auto">Thông báo</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                                </div>
                                                <div class="toast-body">
                                                    ${data.message}
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                    document.body.insertAdjacentHTML('beforeend', toastHtml);
                                    
                                    // Tự động ẩn toast sau 3 giây
                                    setTimeout(() => {
                                        const toast = document.querySelector('.toast');
                                        if (toast) {
                                            const bsToast = new bootstrap.Toast(toast);
                                            bsToast.hide();
                                        }
                                    }, 3000);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                        });
                    });
                    
                    // Xử lý active tab từ URL hash
                    const hash = window.location.hash;
                    if (hash) {
                        const tabId = hash.substring(1);
                        const tabElement = document.querySelector(`#${tabId}-tab`);
                        
                        if (tabElement) {
                            const tab = new bootstrap.Tab(tabElement);
                            tab.show();
                        }
                    }
                    
                    // Cập nhật URL khi chuyển tab
                    const tabEls = document.querySelectorAll('a[data-bs-toggle="pill"]');
                    
                    tabEls.forEach(tabEl => {
                        tabEl.addEventListener('shown.bs.tab', function (event) {
                            const id = event.target.getAttribute('href').substring(1);
                            window.history.replaceState(null, null, `#${id}`);
                        });
                    });
                });
            </script>
            @endsection