@extends('layouts.admin')
@section('title', 'Thêm Bài viết')

@section('styles')
    <!-- Thêm CSS cho CKEditor nếu cần -->
    <style>
        /* Tùy chỉnh chiều cao của CKEditor */
        .ck-editor__editable {
            min-height: 300px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Thêm Mới Bài viết</h2>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="title" class="form-label">Tiêu đề<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ old('title') }}">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="slug" class="form-label">Slug<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                name="slug" value="{{ old('slug') }}">
                            @error('slug')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="image">Ảnh bìa</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                            name="image">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="content" class="form-label">Nội dung<span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="editor" name="content" rows="5">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <hr class="my-4">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary me-md-2">Trở về</a>
                        <button type="submit" class="btn btn-primary">Thêm bài viết</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- CKEditor 5 - Phiên bản Classic Editor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Script tạo slug
            const titleInput = document.getElementById('title');
            const slugInput = document.getElementById('slug');

            if (titleInput && slugInput) {
                // Tự động tạo slug khi nhập tiêu đề
                titleInput.addEventListener('keyup', function() {
                    slugInput.value = createSlug(titleInput.value);
                });

                // Tự động tạo slug khi paste nội dung vào tiêu đề
                titleInput.addEventListener('paste', function() {
                    setTimeout(function() {
                        slugInput.value = createSlug(titleInput.value);
                    }, 100);
                });

                // Hàm tạo slug
                function createSlug(text) {
                    // Đổi chữ hoa thành chữ thường
                    let slug = text.toLowerCase();

                    // Đổi ký tự có dấu thành không dấu
                    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                    slug = slug.replace(/đ/gi, 'd');

                    // Xóa các ký tự đặt biệt
                    slug = slug.replace(
                        /\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');

                    // Đổi khoảng trắng thành ký tự gạch ngang
                    slug = slug.replace(/ /gi, "-");

                    // Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                    slug = slug.replace(/\-\-\-\-\-/gi, '-');
                    slug = slug.replace(/\-\-\-\-/gi, '-');
                    slug = slug.replace(/\-\-\-/gi, '-');
                    slug = slug.replace(/\-\-/gi, '-');

                    // Xóa các ký tự gạch ngang ở đầu và cuối
                    slug = '@' + slug + '@';
                    slug = slug.replace(/\@\-|\-\@|\@/gi, '');

                    return slug;
                }
            }

            // Khởi tạo CKEditor
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    toolbar: [
                        'heading', '|',
                        'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'imageUpload',
                        'blockQuote',
                        'insertTable',
                        'mediaEmbed',
                        'undo', 'redo'
                    ],
                    image: {
                        toolbar: [
                            'imageStyle:inline',
                            'imageStyle:block',
                            'imageStyle:side',
                            '|',
                            'toggleImageCaption',
                            'imageTextAlternative'
                        ]
                    },
                    table: {
                        contentToolbar: [
                            'tableColumn',
                            'tableRow',
                            'mergeTableCells'
                        ]
                    },

                })
                .then(editor => {
                    console.log('CKEditor initialized successfully');
                })
                .catch(error => {
                    console.error('Error initializing CKEditor:', error);
                });
        });
    </script>
@endsection
