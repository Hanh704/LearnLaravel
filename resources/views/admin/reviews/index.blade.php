@extends('layouts.admin')
@section('title', 'Quản lý Reviews')
@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Quản lý Reviews</h2>
                    <a href="{{ route('admin.reviews.create') }}">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                            <i class="bi bi-plus-circle me-2"></i>Thêm review
                        </button>
                    </a>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Products Table -->
        <div class="row">

            <div class="col-md-12">
                <!-- Form tìm kiếm -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-search"></i> Tìm kiếm </h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.reviews.index') }}">
                            <div class="row g-3">
                                <!-- Mã sản phẩm -->
                                <div class="col-md-3">
                                    <input type="text" name="ten_danh_muc" class="form-control"
                                        placeholder="Nhập tên người dùng" value="{{ request('ten_danh_muc') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="ten_danh_muc" class="form-control"
                                        placeholder="Nhập tên sản phẩm" value="{{ request('ten_danh_muc') }}">
                                </div>

                                <!-- Nút tìm kiếm & Làm mới -->
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100 me-1">
                                        <i class="fas fa-search"></i> Tìm kiếm
                                    </button>
                                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary w-100 ms-1">
                                        <i class="fas fa-sync"></i> Làm mới
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" width="50">
                                            <input class="form-check-input" type="checkbox">
                                        </th>
                                        <th scope="col" width="70">ID</th>
                                        <th scope="col">Người dùng</th>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">Nội dung</th>
                                        <th scope="col">Đánh giá</th>
                                        <th scope="col" width="150">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reviews as $value)
                                        <tr>
                                            <td><input class="form-check-input" type="checkbox"></td>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->user_id}}</td>
                                            <td>{{ $value->product_id}}</td>
                                            <td>{{ $value->content}}</td>
                                            <td>{{ $value->rating}}</td>
                                            <td>
                                                <a href="{{ route('admin.reviews.edit', ['id' => $value->id]) }}">
                                                    <button class="btn btn-sm btn-outline-primary me-1"><i
                                                            class="bi bi-pencil"></i></button>
                                                </a>

                                                <form action="{{ route('admin.reviews.destroy', ['id' => $value->id]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger me-1"><i
                                                            class="bi bi-trash"></i></button>
                                                </form>
                                                {{-- <a href="{{ route('admin.reviews.show', ['id' => $value->id]) }}"><button
                                                        class="btn btn-sm btn-outline-info"><i
                                                            class="bi bi-eye"></i></button></a> --}}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end-mt-3">
                            {{ $reviews->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">Reviews đã xóa</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" width="50">
                                            <input class="form-check-input" type="checkbox">
                                        </th>
                                        <th scope="col" width="70">ID</th>
                                        <th scope="col">Người dùng</th>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">Nội dung</th>
                                        <th scope="col">Đánh giá</th>
                                        <th scope="col" width="150">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reviewsDeletes as $value)
                                        <tr>
                                            <td><input class="form-check-input" type="checkbox"></td>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->user_id}}</td>
                                            <td>{{ $value->product_id}}</td>
                                            <td>{{ $value->content}}</td>
                                            <td>{{ $value->rating}}</td>
                                            <td>
                                                <form action="{{ route('admin.reviews.restore', ['id' => $value->id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn khôi phục sản phẩm này không?')" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-sm btn-outline-primary me-1"><i class="fa-solid fa-arrow-rotate-left"></i></button>
                                                </form>
                                                <form action="{{ route('admin.reviews.deletePermanently', ['id' => $value->id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không? Sẽ vĩnh viễn không khôi phục được !')" class="d-inline">
                                                    @csrf
                                                    <button title="Xóa vĩnh viễn" class="btn btn-sm btn-outline-danger me-1"><i
                                                        class="bi bi-trash"></i></button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end-mt-3">
                            {{ $reviews->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
