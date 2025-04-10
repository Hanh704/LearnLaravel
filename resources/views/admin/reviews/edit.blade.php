@extends('layouts.admin')
@section('title', 'Thêm Review')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Thêm Mới Review</h2>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.reviews.update', $review->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="productName" class="form-label">Rating<span class="text-danger">*</span></label>
                            <select class="form-select" id="category" name="rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                            </select>
                            @error('rating')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="regularPrice" class="form-label">Người dùng<span
                                    class="text-danger">*</span></label>
                            <select class="form-select" id="category" name="user_id">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="regularPrice" class="form-label">Sản phẩm<span class="text-danger">*</span></label>
                            <select class="form-select" id="category" name="product_id">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->ten_san_pham }}</option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="mb-3">
                            <label for="fullDescription" class="form-label">Nội dung</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="5">{{old('content', $review->content)}}</textarea>
                            @error('content')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.reviews.index') }}"><button type="button"
                                class="btn btn-outline-secondary me-md-2">Trở về</button></a>
                        <button type="submit" class="btn btn-primary">Thêm Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
