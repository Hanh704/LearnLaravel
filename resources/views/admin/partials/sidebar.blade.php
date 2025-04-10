<nav id="sidebar" class="bg-dark text-white">
    <div class="sidebar-header">
        <h3>Admin Panel</h3>
    </div>

    <ul class="list-unstyled components">
        <li class="active">
            <a href="#"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
        </li>
        <li>
            <a href="#productSubmenu" data-bs-toggle="collapse" aria-expanded="true"><i
                    class="bi bi-box me-2"></i> Sản phẩm</a>
            <ul class="collapse list-unstyled show" id="productSubmenu">
                <li>
                    <a href="{{route('admin.products.index')}}" ><i class="bi bi-list-ul me-2"></i> Danh sách sản phẩm</a>
                </li>
                {{-- <li>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addProductModal"><i
                            class="bi bi-plus-circle me-2"></i> Thêm sản phẩm</a>
                </li> --}}
                <li>
                    <a href="{{route('admin.categories.index')}}"><i class="bi bi-tag me-2"></i> Danh mục</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="bi bi-cart me-2"></i> Đơn hàng</a>
        </li>
        <li>
            <a href="{{route('admin.customers.index')}}"><i class="bi bi-people me-2"></i> Khách hàng</a>
        </li>
        <li>
            <a href="{{route('admin.banners.index')}}"><i class="fa-solid fa-layer-group me-2"></i> Banners</a>
        </li>
        <li>
            <a href="{{route('admin.posts.index')}}"><i class="fa-solid fa-pen-to-square  me-2"></i> Posts</a>
        </li>
        <li>
            <a href="{{route('admin.reviews.index')}}"><i class="fa-solid fa-thumbs-up me-2"></i> Reviews</a>
        </li>
        <li>
            <a href="#"><i class="bi bi-bar-chart me-2"></i> Báo cáo</a>
        </li>
        <li>
            <a href="#"><i class="bi bi-gear me-2"></i> Cài đặt</a>
        </li>
        <li>
            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                @csrf
                <a href="javascript:void(0)" onclick="document.getElementById('logout-form').submit();">
                    {{-- <i class="bi bi-gear me-2"></i> --}}
                    <i class=" fa-solid fa-right-from-bracket me-2"></i> Đăng xuất
                </a>
            </form>
        </li>
    </ul>
</nav>