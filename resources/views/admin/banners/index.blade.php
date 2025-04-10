@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Quản lý Banner</h2>
                    <a href="{{ route('admin.banners.create') }}">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                            <i class="bi bi-plus-circle me-2"></i>Thêm Banner
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
                        <form method="GET" action="{{ route('admin.banners.index') }}">
                            <div class="row g-3">
                                <!-- Mã sản phẩm -->
                                <div class="col-md-3">
                                    <input type="text" name="ten_danh_muc" class="form-control"
                                        placeholder="Nhập URL" value="{{ request('ten_danh_muc') }}">
                                </div>

                                <!-- Nút tìm kiếm & Làm mới -->
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100 me-1">
                                        <i class="fas fa-search"></i> Tìm kiếm
                                    </button>
                                    <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary w-100 ms-1">
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
                                        <th scope="col">URL</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col" width="150">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners as $value)
                                        <tr>
                                            <td><input class="form-check-input" type="checkbox"></td>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->url }}</td>
                                            <td>
                                                @if ($value->image)
                                                <img src="{{asset('storage/'.$value->image)}}" alt="{{$value->image}}">
                                            @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.banners.edit', ['id' => $value->id]) }}">
                                                    <button class="btn btn-sm btn-outline-primary me-1"><i
                                                            class="bi bi-pencil"></i></button>
                                                </a>

                                                <form action="{{ route('admin.banners.destroy', ['id' => $value->id]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger me-1"><i
                                                            class="bi bi-trash"></i></button>
                                                </form>
                                                {{-- <a href="{{ route('admin.banners.show', ['id' => $value->id]) }}"><button
                                                        class="btn btn-sm btn-outline-info"><i
                                                            class="bi bi-eye"></i></button></a> --}}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end-mt-3">
                            {{ $banners->links('pagination::bootstrap-4') }}
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
                                        <th scope="col">URL</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col" width="150">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bannerDeletes as $value)
                                        <tr>
                                            <td><input class="form-check-input" type="checkbox"></td>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->url }}</td>
                                            <td>
                                                @if ($value->image)
                                                <img src="{{asset('storage/'.$value->image)}}" alt="{{$value->image}}">
                                            @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.banners.restore', ['id' => $value->id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn khôi phục sản phẩm này không?')" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-sm btn-outline-primary me-1"><i class="fa-solid fa-arrow-rotate-left"></i></button>
                                                </form>
                                                <form action="{{ route('admin.banners.deletePermanently', ['id' => $value->id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không? Sẽ vĩnh viễn không khôi phục được !')" class="d-inline">
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
