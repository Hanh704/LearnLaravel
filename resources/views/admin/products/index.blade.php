@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Quản lý Sản phẩm</h2>
                    <a href="{{ route('admin.products.create') }}">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                            <i class="bi bi-plus-circle me-2"></i>Thêm sản phẩm mới
                        </button>
                    </a>
                </div>
            </div>
        </div>
        @if (session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
            
        @endif
        <!-- Cards Overview -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Tổng sản phẩm</h5>
                            <h2 class="mb-0">156</h2>
                        </div>
                        <i class="bi bi-box fs-1"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Còn hàng</h5>
                            <h2 class="mb-0">122</h2>
                        </div>
                        <i class="bi bi-check-circle fs-1"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Sắp hết hàng</h5>
                            <h2 class="mb-0">15</h2>
                        </div>
                        <i class="bi bi-exclamation-triangle fs-1"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Hết hàng</h5>
                            <h2 class="mb-0">19</h2>
                        </div>
                        <i class="bi bi-x-circle fs-1"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Controls -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <select class="form-select">
                                    <option selected>Danh mục</option>
                                    <option>Điện thoại</option>
                                    <option>Laptop</option>
                                    <option>Máy tính bảng</option>
                                    <option>Phụ kiện</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <select class="form-select">
                                    <option selected>Trạng thái</option>
                                    <option>Còn hàng</option>
                                    <option>Sắp hết hàng</option>
                                    <option>Hết hàng</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <select class="form-select">
                                    <option selected>Sắp xếp theo</option>
                                    <option>Tên A-Z</option>
                                    <option>Tên Z-A</option>
                                    <option>Giá tăng dần</option>
                                    <option>Giá giảm dần</option>
                                    <option>Mới nhất</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <button class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-funnel me-2"></i>Lọc
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="row">

            <div class="col-md-12">
                <!-- Form tìm kiếm -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-search"></i> Tìm kiếm sản phẩm</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.products.index') }}">
                            <div class="row g-3">
                                <!-- Mã sản phẩm -->
                                <div class="col-md-3">
                                    <input type="text" name="ma_san_pham" class="form-control"
                                        placeholder="Nhập mã sản phẩm" value="{{ request('ma_san_pham') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="danh_muc_san_pham" class="form-control"
                                        placeholder="Nhập tên danh mục sản phẩm" value="{{ request('ma_san_pham') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="ten_san_pham" class="form-control"
                                        placeholder="Nhập tên sản phẩm" value="{{ request('ten_san_pham') }}">
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select" name="trang_thai">
                                        <option value="2">Trạng thái</option>
                                        <option value="1">Còn hàng</option>
                                        <option value="0">Hết hàng</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="gia_ban_dau" class="form-control"
                                        placeholder="Nhập giá bắt đầu" value="{{ request('ma_san_pham') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="gia_ket_thuc" class="form-control"
                                        placeholder="Nhập giá kết thúc" value="{{ request('ma_san_pham') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" name="ngay_bat_dau" class="form-control"
                                        value="{{ request('ngay_bat_dau') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" name="ngay_ket_thuc" class="form-control"
                                        value="{{ request('ngay_ket_thuc') }}">
                                </div>
                                <!-- Nút tìm kiếm & Làm mới -->
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100 me-1">
                                        <i class="fas fa-search"></i> Tìm kiếm
                                    </button>
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary w-100 ms-1">
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
                                        <th scope="col">Mã sản phẩm</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Danh mục</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Tồn kho</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Ngày nhập</th>
                                        <th scope="col" width="150">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                        <tr>
                                            <td><input class="form-check-input" type="checkbox"></td>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->ma_san_pham }}</td>
                                            <td>{{ $item->ten_san_pham }}</td>
                                            <td>
                                                {{ $item->categories->ten_danh_muc }}
                                            </td>
                                            <td>
                                                @if ($item->image)
                                                    <img src="{{asset('storage/'.$item->image)}}" alt="{{$item->ten_san_pham}}">
                                                @endif
                                            </td>
                                            <td>{{ $item->gia }}</td>
                                            <td>{{ $item->so_luong }}</td>
                                            <td>
                                                @if ($item->so_luong >= 1)
                                                    <span class="badge bg-success">CÒN HÀNG</span>
                                            </td>
                                        @else
                                            <span class="badge bg-danger">HẾT HÀNG</span></td>
                                    @endif
                                    </td>
                                    <td>{{ $item->ngay_nhap }}</td>
                                    <td>

                                        <a href="{{ route('admin.products.edit', ['id' => $item->id]) }}">
                                            <button class="btn btn-sm btn-outline-primary me-1"><i
                                                    class="bi bi-pencil"></i></button>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', ['id' => $item->id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger me-1"><i
                                                class="bi bi-trash"></i></button>
                                        </form>
                                        <a href="{{ route('admin.products.show', ['id' => $item->id]) }}"><button
                                                class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></button></a>
                                    </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        {{-- <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Trước</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Tiếp</a>
                            </li>
                        </ul>
                    </nav> --}}
                        <div class="d-flex justify-content-end-mt-3">
                            {{ $products->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">Danh sách sản phẩm đã xóa</h5>
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
                                        <th scope="col">Mã sản phẩm</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Danh mục</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Tồn kho</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Ngày nhập</th>
                                        <th scope="col" width="150">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productDeletes as $item)
                                        <tr>
                                            <td><input class="form-check-input" type="checkbox"></td>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->ma_san_pham }}</td>
                                            <td>{{ $item->ten_san_pham }}</td>
                                            <td>
                                                {{ $item->categories->ten_danh_muc }}
                                            </td>
                                            <td>
                                                @if ($item->image)
                                                    <img src="{{asset('storage/'.$item->image)}}" alt="{{$item->ten_san_pham}}">
                                                @endif
                                            </td>
                                            <td>{{ $item->gia }}</td>
                                            <td>{{ $item->so_luong }}</td>
                                            <td>
                                                @if ($item->trang_thai == 1)
                                                    <span class="badge bg-success">Còn hàng</span>
                                            </td>
                                        @else
                                            <span class="badge bg-danger">Hết hàng</span></td>
                                    @endif
                                    </td>
                                    <td>{{ $item->ngay_nhap }}</td>
                                    <td>

                                        {{-- <a title="Khôi phục" href="{{ route('admin.products.edit', ['id' => $item->id]) }}">
                                            <button class="btn btn-sm btn-outline-primary me-1"><i class="fa-solid fa-arrow-rotate-left"></i></button>
                                        </a> --}}
                                        <form action="{{ route('admin.products.restore', ['id' => $item->id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn khôi phục sản phẩm này không?')" class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-primary me-1"><i class="fa-solid fa-arrow-rotate-left"></i></button>
                                        </form>
                                        <form action="{{ route('admin.products.deletePermanently', ['id' => $item->id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không? Sẽ vĩnh viễn không khôi phục được !')" class="d-inline">
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
                        {{-- <div class="d-flex justify-content-end-mt-3">
                            {{ $productDeletes->links('pagination::bootstrap-4') }}
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
