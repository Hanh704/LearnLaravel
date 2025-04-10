@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Quản lý Danh mục</h2>
                    <a href="{{ route('admin.categories.create') }}">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                            <i class="bi bi-plus-circle me-2"></i>Thêm danh mục mới
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
                        <h5 class="mb-0"><i class="fas fa-search"></i> Tìm kiếm danh mục</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.categories.index') }}">
                            <div class="row g-3">
                                <!-- Mã sản phẩm -->
                                <div class="col-md-3">
                                    <input type="text" name="ten_danh_muc" class="form-control"
                                        placeholder="Nhập tên danh mục" value="{{ request('ten_danh_muc') }}">
                                </div>

                                <div class="col-md-3">
                                    <select class="form-select" name="trang_thai">
                                        <option value="2">Trạng thái</option>
                                        <option value="1">ON</option>
                                        <option value="0">OFF</option>
                                    </select>
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
                                        <th scope="col">Tên danh mục</th>
                                        <th scope="col">Trạng thái</th>

                                        <th scope="col" width="150">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td><input class="form-check-input" type="checkbox"></td>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->ten_danh_muc }}</td>
                                            <td>
                                                @if ($category->trang_thai == 1)
                                                    <span class="badge bg-success">ON</span>
                                            </td>
                                        @else
                                            <span class="badge bg-danger">OFF</span></td>
                                    @endif
                                    <td>
                                    <a href="{{ route('admin.categories.edit', ['id' => $category->id]) }}">
                                        <button class="btn btn-sm btn-outline-primary me-1"><i
                                                class="bi bi-pencil"></i></button>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', ['id' => $category->id]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger me-1"><i
                                                class="bi bi-trash"></i></button>
                                    </form>
                                    <a href="{{ route('admin.categories.show', ['id' => $category->id]) }}"><button
                                            class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></button></a>
                                    </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end-mt-3">
                            {{ $categories->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
