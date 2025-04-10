@extends('layouts.client')

@section('title', 'Liên Hệ')

@section('styles')
<style>
    .contact-container {
        margin-top: 50px;
        margin-bottom: 50px;
    }
    .contact-info {
        padding: 20px;
        border-radius: 5px;
    }
    .map-responsive {
        overflow: hidden;
        padding-bottom: 56.25%;
        position: relative;
        height: 0;
    }
    .map-responsive iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }
</style>
@endsection

@section('content')
<div class="container contact-container">
    <div class="row">
        <!-- Form Liên Hệ -->
        <div class="col-md-6">
            <h1>Liên Hệ Với Chúng Tôi</h1>
            <p>
                Nếu bạn có bất kỳ câu hỏi hay góp ý nào, vui lòng điền thông tin dưới đây.
                Chúng tôi sẽ phản hồi sớm nhất có thể!
            </p>

            <!-- Hiển thị thông báo thành công nếu có -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('client.contact.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Họ và Tên</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nhập họ và tên" required value="{{ old('name') }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Nhập địa chỉ email" required value="{{ old('email') }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Nhập số điện thoại" value="{{ old('phone') }}">
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="message" class="form-label">Nội dung</label>
                    <textarea name="message" id="message" rows="5" class="form-control" placeholder="Nhập nội dung tin nhắn" required>{{ old('message') }}</textarea>
                    @error('message')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Gửi tin nhắn</button>
            </form>
        </div>

        <!-- Thông tin liên hệ và bản đồ -->
        <div class="col-md-6">
            <h2>Thông Tin Liên Hệ</h2>
            <div class="contact-info">
                <p><strong>Địa chỉ:</strong> 123 Đường ABC, Phường XYZ, Quận 1, TP. Hồ Chí Minh</p>
                <p><strong>Điện thoại:</strong> <a href="tel:0123456789">0123 456 789</a></p>
                <p><strong>Email:</strong> <a href="mailto:contact@example.com">contact@example.com</a></p>
                <p><strong>Giờ làm việc:</strong> Thứ 2 - Thứ 6: 08:00 - 17:00</p>
            </div>

            <div class="mt-4">
                <h2>Bản Đồ</h2>
                <div class="map-responsive">
                    <!-- Nhúng Google Map, thay đổi link theo vị trí thực tế của doanh nghiệp nếu cần -->
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.956396871837!2d106.66017211533394!3d10.762622292323029!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ed5c0012f4d%3A0x5dd6e468bd5a3b14!2zVHLGsOG7nW5nIENow6FuaCwgUGjGsOG7nW5nIMSQ4bqhbyBD4buRIENow6FuaCBNaW5oLCDDoCBDIHThu4_Ng!5e0!3m2!1svi!2s!4v1634182576543!5m2!1svi!2s" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection