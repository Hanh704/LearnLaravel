@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Thêm Mới Sản phẩm</h2>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="productName" class="form-label">Tên sản phẩm <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('ten_san_pham') is-invalid @enderror"
                                id="productName" name="ten_san_pham" value="{{ old('ten_san_pham') }}">
                            @error('ten_san_pham')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="productCode" class="form-label">Mã sản phẩm <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('ma_san_pham') is-invalid @enderror"
                                name="ma_san_pham" value="{{ old('ma_san_pham') }}">
                            @error('ma_san_pham')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="category" class="form-label">Danh mục <span class="text-danger">*</span></label>
                            <select class="form-select" id="category" name="category_id">
                                @foreach ($categories as $cate)
                                    <option value="{{ $cate->id }}">{{ $cate->ten_danh_muc }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="regularPrice" class="form-label">Giá bán <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('gia') is-invalid @enderror"
                                    name="gia">

                                <span class="input-group-text">VNĐ</span>
                            </div>
                            @error('gia')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="salePrice" class="form-label">Giá khuyến mãi</label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('gia_khuyen_mai') is-invalid @enderror"
                                    name="gia_khuyen_mai" value="{{ old('gia_khuyen_mai') }}">
                                <span class="input-group-text">VNĐ</span>
                            </div>
                            @error('gia_khuyen_mai')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="fullDescription" class="form-label">Mô tả</label>
                        <textarea class="form-control @error('mota') is-invalid @enderror" name="mota" rows="5">value="{{ old('mota') }}"</textarea>
                        @error('mota')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="productImages" class="form-label">Hình ảnh sản phẩm <span
                                class="text-danger">*</span></label>
                        <input class="form-control" type="file" name="image" multiple accept="image/*">
                        <div class="form-text">Có thể chọn nhiều hình ảnh. Kích thước tối đa: 2MB mỗi ảnh.</div>
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="row mb-3 mt-4" id="imagePreviewContainer">
                        <!-- Image previews will be displayed here -->
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="stockQuantity" class="form-label">Số lượng trong kho</label>
                            <input type="number" class="form-control" name="so_luong" value="{{ old('so_luong') }}">
                            @error('so_luong')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="importDate" class="form-label">Ngày nhập <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="importDate" name="ngay_nhap" value="{{ old('ngay_nhap') }}">
                            @error('ngay_nhap')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="category" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                            <select class="form-select" id="category" name="trang_thai">
                                <option>Trạng thái</option>
                                <option value="1">ON</option>
                                <option value="0">OFF</option>
                            </select>
                            @error('trang_thai')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="statusActive" value="active" checked>
                        <label class="form-check-label" for="statusActive">
                            Kích hoạt
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="statusDraft" value="draft">
                        <label class="form-check-label" for="statusDraft">
                            Bản nháp
                        </label>
                    </div>
                </div>
            </div> --}}
                    <hr class="my-4">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.products.index') }}"><button type="button"
                                class="btn btn-outline-secondary me-md-2">Trở về</button></a>
                        <button type="submit" class="btn btn-primary">Thêm mới sản phẩm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
