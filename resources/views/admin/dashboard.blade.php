@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid p-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <p class="mb-4">Tổng quan về hoạt động của cửa hàng</p>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Doanh thu (Tháng)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">40,000,000 VNĐ</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-currency-dollar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Đơn hàng (Tháng)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">215</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Khách hàng mới</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">48</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Đơn hàng chờ xử lý</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-clock-history fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tổng quan doanh thu</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Tùy chọn:</div>
                            <a class="dropdown-item" href="#">Theo ngày</a>
                            <a class="dropdown-item" href="#">Theo tuần</a>
                            <a class="dropdown-item" href="#">Theo tháng</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Xuất báo cáo</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="revenueChart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Phân bổ danh mục</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Tùy chọn:</div>
                            <a class="dropdown-item" href="#">Theo doanh thu</a>
                            <a class="dropdown-item" href="#">Theo số lượng sản phẩm</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Xuất báo cáo</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-pie">
                        <canvas id="categoryChart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders and Top Products Row -->
    <div class="row">
        <!-- Recent Orders -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Đơn hàng gần đây</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Khách hàng</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#ORD-2023-1001</td>
                                    <td>Nguyễn Văn A</td>
                                    <td>03/04/2023</td>
                                    <td>1,200,000 VNĐ</td>
                                    <td><span class="badge bg-warning">Đang xử lý</span></td>
                                    <td><a href="#" class="btn btn-sm btn-primary">Chi tiết</a></td>
                                </tr>
                                <tr>
                                    <td>#ORD-2023-1000</td>
                                    <td>Trần Thị B</td>
                                    <td>02/04/2023</td>
                                    <td>850,000 VNĐ</td>
                                    <td><span class="badge bg-success">Hoàn thành</span></td>
                                    <td><a href="#" class="btn btn-sm btn-primary">Chi tiết</a></td>
                                </tr>
                                <tr>
                                    <td>#ORD-2023-0999</td>
                                    <td>Lê Văn C</td>
                                    <td>01/04/2023</td>
                                    <td>2,450,000 VNĐ</td>
                                    <td><span class="badge bg-info">Đang giao</span></td>
                                    <td><a href="#" class="btn btn-sm btn-primary">Chi tiết</a></td>
                                </tr>
                                <tr>
                                    <td>#ORD-2023-0998</td>
                                    <td>Phạm Thị D</td>
                                    <td>01/04/2023</td>
                                    <td>1,750,000 VNĐ</td>
                                    <td><span class="badge bg-success">Hoàn thành</span></td>
                                    <td><a href="#" class="btn btn-sm btn-primary">Chi tiết</a></td>
                                </tr>
                                <tr>
                                    <td>#ORD-2023-0997</td>
                                    <td>Hoàng Văn E</td>
                                    <td>31/03/2023</td>
                                    <td>920,000 VNĐ</td>
                                    <td><span class="badge bg-danger">Đã hủy</span></td>
                                    <td><a href="#" class="btn btn-sm btn-primary">Chi tiết</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="#" class="btn btn-primary">Xem tất cả đơn hàng</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Products -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sản phẩm bán chạy</h6>
                </div>
                <div class="card-body">
                    <div class="product-item d-flex align-items-center mb-3">
                        <img src="https://via.placeholder.com/50" class="rounded me-3" alt="Product">
                        <div class="product-info flex-grow-1">
                            <h6 class="mb-0">Áo thun nam cao cấp</h6>
                            <div class="small text-muted">Đã bán: 152 | Doanh thu: 15.2M VNĐ</div>
                        </div>
                        <div class="badge bg-success">Top 1</div>
                    </div>
                    <div class="product-item d-flex align-items-center mb-3">
                        <img src="https://via.placeholder.com/50" class="rounded me-3" alt="Product">
                        <div class="product-info flex-grow-1">
                            <h6 class="mb-0">Quần jean nữ skinny</h6>
                            <div class="small text-muted">Đã bán: 128 | Doanh thu: 12.8M VNĐ</div>
                        </div>
                        <div class="badge bg-success">Top 2</div>
                    </div>
                    <div class="product-item d-flex align-items-center mb-3">
                        <img src="https://via.placeholder.com/50" class="rounded me-3" alt="Product">
                        <div class="product-info flex-grow-1">
                            <h6 class="mb-0">Áo khoác denim unisex</h6>
                            <div class="small text-muted">Đã bán: 96 | Doanh thu: 19.2M VNĐ</div>
                        </div>
                        <div class="badge bg-success">Top 3</div>
                    </div>
                    <div class="product-item d-flex align-items-center mb-3">
                        <img src="https://via.placeholder.com/50" class="rounded me-3" alt="Product">
                        <div class="product-info flex-grow-1">
                            <h6 class="mb-0">Giày thể thao nam</h6>
                            <div class="small text-muted">Đã bán: 89 | Doanh thu: 17.8M VNĐ</div>
                        </div>
                        <div class="badge bg-success">Top 4</div>
                    </div>
                    <div class="product-item d-flex align-items-center">
                        <img src="https://via.placeholder.com/50" class="rounded me-3" alt="Product">
                        <div class="product-info flex-grow-1">
                            <h6 class="mb-0">Túi xách nữ thời trang</h6>
                            <div class="small text-muted">Đã bán: 75 | Doanh thu: 15.0M VNĐ</div>
                        </div>
                        <div class="badge bg-success">Top 5</div>
                    </div>
                    <div class="text-center mt-3">
                        <a href="#" class="btn btn-primary">Xem tất cả sản phẩm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            datasets: [{
                label: 'Doanh thu (triệu VNĐ)',
                data: [25, 30, 35, 40, 38, 42, 45, 50, 55, 60, 58, 65],
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                borderColor: 'rgba(78, 115, 223, 1)',
                pointRadius: 3,
                pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                pointBorderColor: 'rgba(78, 115, 223, 1)',
                pointHoverRadius: 5,
                pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                pointHitRadius: 10,
                pointBorderWidth: 2,
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Category Chart
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    const categoryChart = new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: ['Áo', 'Quần', 'Giày dép', 'Phụ kiện', 'Túi xách'],
            datasets: [{
                data: [35, 25, 20, 10, 10],
                backgroundColor: [
                    '#4e73df',
                    '#1cc88a',
                    '#36b9cc',
                    '#f6c23e',
                    '#e74a3b'
                ],
                hoverBackgroundColor: [
                    '#2e59d9',
                    '#17a673',
                    '#2c9faf',
                    '#dda20a',
                    '#be2617'
                ],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            cutout: '70%'
        }
    });
</script>
@endsection