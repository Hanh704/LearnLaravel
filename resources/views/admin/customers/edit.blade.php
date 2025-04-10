@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Thêm Mới Thành Viên</h2>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.customers.update', $customers->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="productName" class="form-label">Họ và Tên<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="productName" name="name" value="{{ old('name', $customers->name) }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="productCode" class="form-label">Email<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email', $customers->email) }}">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        
                        <div class="col-md-4">
                            <label for="regularPrice" class="form-label">Số điện thoại<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone', $customers->phone) }}">
                            </div>
                            @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <div class="col-md-4">
                                <label for="importDate" class="form-label">Ngày sinh <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="importDate" name="birthday" value="{{ old('birthday', $customers->birthday) }}">
                                @error('birthday')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="fullDescription" class="form-label">Địa chỉ</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="5">{{ old('address', $customers->address) }}</textarea>
                            @error('address')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="productImages" class="form-label">Hình ảnh sản phẩm <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" type="file" name="avatar" multiple accept="image/*">
                            <div class="form-text">Có thể chọn nhiều hình ảnh. Kích thước tối đa: 2MB mỗi ảnh.</div>
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                      
                    </div>


                    <hr class="my-4">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.customers.index') }}"><button type="button"
                                class="btn btn-outline-secondary me-md-2">Trở về</button></a>
                        <button type="submit" class="btn btn-primary">Thêm thành viên</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
