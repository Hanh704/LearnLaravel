@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Chỉnh Sửa Danh Mục</h2>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.categories.update', $categories->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="productName" class="form-label">Tên danh mục <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('ten_danh_muc') is-invalid @enderror"
                                id="productName" name="ten_danh_muc" value="{{ old('ten_danh_muc', $categories->ten_danh_muc) }}">
                            @error('ten_danh_muc')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="category" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                            <select class="form-select" id="category" name="trang_thai">
                                <option>Trạng thái</option>
                                <option value="1" {{old('trang_thai', $categories->trang_thai) == 1 ? 'selected' : ''}}>ON</option>
                                <option value="0" {{old('trang_thai', $categories->trang_thai) == 0 ? 'selected' : ''}}>OFF</option>
                            </select>
                            @error('trang_thai')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.categories.index') }}"><button type="button"
                                class="btn btn-outline-secondary me-md-2">Trở về</button></a>
                        <button type="submit" class="btn btn-primary">Cập nhật danh mục</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
