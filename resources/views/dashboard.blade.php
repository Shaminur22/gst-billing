@extends('layout.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col text-center">
            <h2 class="page-title font-weight-bold text-uppercase text-gradient mb-1">Business Dashboard</h2>
            <p class="text-muted">Real-time insights into revenue and sales</p>
        </div>
    </div>

    <!-- Statistic Cards -->
    <div class="row">
        <!-- Total Revenue -->
        <div class="col-md-4 mb-4">
            <div class="card shadow gradient-card gradient-revenue hover-effect">
                <div class="card-body text-center text-white">
                    <h6 class="text-uppercase">Total Revenue</h6>
                    <h2 class="fw-bold mb-0">৳ {{ number_format($totalRevenue, 2) }}</h2>
                    <i class="fe-dollar-sign display-4 opacity-75 mt-2"></i>
                </div>
            </div>
        </div>

        <!-- Today's Sales -->
        <div class="col-md-4 mb-4">
            <div class="card shadow gradient-card gradient-sales hover-effect">
                <div class="card-body text-center text-white">
                    <h6 class="text-uppercase">Today's Sales</h6>
                    <h2 class="fw-bold mb-0">{{ $todaysSales }}</h2>
                    <i class="fe-shopping-cart display-4 opacity-75 mt-2"></i>
                </div>
            </div>
        </div>

        <!-- Monthly Revenue -->
        <div class="col-md-4 mb-4">
            <div class="card shadow gradient-card gradient-month hover-effect">
                <div class="card-body text-center text-white">
                    <h6 class="text-uppercase">This Month's Revenue</h6>
                    <h2 class="fw-bold mb-0">৳ {{ number_format($monthlySales, 2) }}</h2>
                    <i class="fe-bar-chart-2 display-4 opacity-75 mt-2"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row">
        <!-- Line Chart -->
        <div class="col-md-8">
            <div class="card shadow border-0 gradient-card-chart hover-effect">
                <div class="card-body">
                    <h5 class="text-gradient mb-3">Sales Overview (Monthly)</h5>
                    <canvas id="salesChart" height="120"></canvas>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-md-4">
            <div class="card shadow border-0 gradient-card-chart hover-effect">
                <div class="card-body">
                    <h5 class="text-gradient mb-3">Revenue Distribution</h5>
                    <canvas id="pieChart" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS (keep same gradient styles as before) -->
<style>
    .gradient-card {
        border-radius: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .gradient-revenue,
    .gradient-sales,
    .gradient-month {
        background: linear-gradient(135deg, #00eaff 0%, #009dff 100%);
    }
    .gradient-card-chart {
        border-radius: 15px;
        border: 2px solid transparent;
        background: linear-gradient(white, white) padding-box,
                    linear-gradient(90deg, #00eaff, #009dff) border-box;
    }
    .text-gradient {
        background: linear-gradient(to right, #00eaff, #009dff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .hover-effect:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0, 157, 255, 0.5);
        cursor: pointer;
    }
</style>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Line Chart Data
    const ctx = document.getElementById('salesChart').getContext('2d');
    const chartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const chartData = @json($monthlyData);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Revenue',
                data: chartData,
                borderColor: '#009dff',
                backgroundColor: 'rgba(0,157,255,0.2)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#00eaff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: true } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Pie Chart Data
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    const pieData = {
        labels: ['Today', 'This Month', 'Total'],
        datasets: [{
            data: [{{ $todaysSales }}, {{ $monthlySales }}, {{ $totalRevenue }}],
            backgroundColor: ['#00eaff', '#009dff', '#66b3ff'],
            borderWidth: 1
        }]
    };

    new Chart(pieCtx, {
        type: 'pie',
        data: pieData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: '#333' }
                }
            }
        }
    });
</script>
@endsection
