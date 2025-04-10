@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Quản lý khách hàng</h2>
                    <a href="{{ route('admin.customers.create') }}">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                            <i class="bi bi-plus-circle me-2"></i>Thêm khách hàng
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
                        <h5 class="mb-0"><i class="fas fa-search"></i> Tìm kiếm khách hàng</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.customers.index') }}">
                            <div class="row g-3">
                                <!-- Mã sản phẩm -->
                                <div class="col-md-3">
                                    <input type="text" name="ho_va_ten" class="form-control"
                                        placeholder="Nhập tên khách hàng" value="{{ request('ho_va_ten') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="email" class="form-control"
                                        placeholder="Nhập Email" value="{{ request('email') }}">
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
                                        <th scope="col">Họ & tên</th>
                                        <th scope="col">Avatar</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Số điện thoại</th>
                                        <th scope="col">Địa chỉ</th>
                                        <th scope="col">Ngày sinh</th>
                                        <th scope="col" width="150">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $value)
                                        <tr>
                                            <td><input class="form-check-input" type="checkbox"></td>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>
                                                @if ($value->avatar)
                                                <img src="{{asset('storage/'.$value->avatar)}}" alt="{{$value->name}}">
                                            @endif
                                            </td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->phone }}</td>
                                            <td>{{ $value->address }}</td>
                                            <td><input type="date" value="{{ $value->birthday }}"></td>
                                            <td>
                                                <a href="{{ route('admin.customers.edit', ['id' => $value->id]) }}">
                                                    <button class="btn btn-sm btn-outline-primary me-1"><i
                                                            class="bi bi-pencil"></i></button>
                                                </a>

                                                <form action="{{ route('admin.customers.destroy', ['id' => $value->id]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa khách hàng này không?')"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger me-1"><i
                                                            class="bi bi-trash"></i></button>
                                                </form>
                                                <a href="{{ route('admin.customers.show', ['id' => $value->id]) }}"><button
                                                        class="btn btn-sm btn-outline-info"><i
                                                            class="bi bi-eye"></i></button></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end-mt-3">
                            {{ $customers->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
