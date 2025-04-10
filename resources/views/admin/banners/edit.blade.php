@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Chỉnh sửa Banner {{$banner->id}}</h2>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.banners.update', $banner->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="productName" class="form-label">URL<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('url') is-invalid @enderror"
                                id="productName" name="url" value="{{ old('url', $banner->url) }}">
                            @error('url')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="productImages" class="form-label">Hình ảnh sản phẩm <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" type="file" name="image" multiple accept="image/*">
                            <div class="form-text">Có thể chọn nhiều hình ảnh. Kích thước tối đa: 2MB mỗi ảnh.</div>
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.banners.index') }}"><button type="button"
                                class="btn btn-outline-secondary me-md-2">Trở về</button></a>
                        <button type="submit" class="btn btn-primary">Sửa banner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
