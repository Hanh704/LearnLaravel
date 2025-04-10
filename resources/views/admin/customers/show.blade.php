@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Chi tiết sản phẩm {{ $product->ten_san_pham }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Thông tin cơ bản</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Mã sản phẩm:</div>
                        <div class="col-md-9">{{ $product->ma_san_pham }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Tên sản phẩm:</div>
                        <div class="col-md-9">{{ $product->ten_san_pham }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Danh mục:</div>
                        <div class="col-md-9">{{ $product->categories->ten_danh_muc }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Giá:</div>
                        <div class="col-md-9">{{ $product->gia }} ₫</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Giá khuyến mãi:</div>
                        <div class="col-md-9">
                            @if(isset($product->gia_khuyen_mai))
                            {{$product->gia_khuyen_mai}}
                            @else
                            <p>Không có</p>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Tồn kho:</div>
                        <div class="col-md-9">
                            <span class="badge bg-success">{{ $product->so_luong }} sản phẩm</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Trạng thái:</div>
                        <div class="col-md-9">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="statusSwitch" checked>
                                <label class="form-check-label" for="statusSwitch">Đang hoạt động</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Mô tả sản phẩm</h5>
                </div>
                <div class="card-body">
                    <p>{{ $product->mota }}</p>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
