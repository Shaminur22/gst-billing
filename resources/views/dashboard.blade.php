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

    <!-- Sales Chart -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow border-0 gradient-card-chart hover-effect">
                <div class="card-body">
                    <h5 class="text-gradient mb-3">Sales Overview (Monthly)</h5>
                    <canvas id="salesChart" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- About Project (Interactive Cards) -->
    <div class="row mt-4">
        <div class="col-md-12">
            <h4 class="text-gradient mb-3">About This Project</h4>
        </div>

        <!-- Card 1 -->
        <div class="col-md-4 mb-3">
            <div class="card about-card hover-effect clickable" data-target="#info1">
                <div class="card-body text-center">
                    <h5 class="fw-bold">Manage Clients</h5>
                    <p class="text-muted mb-0">Click to learn more</p>
                </div>
            </div>
            <div id="info1" class="about-details collapse">
                <div class="card card-body mt-2 shadow-sm">
                    Keep track of client information, categorize them and view their billing history.
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-4 mb-3">
            <div class="card about-card hover-effect clickable" data-target="#info2">
                <div class="card-body text-center">
                    <h5 class="fw-bold">Real-Time Insights</h5>
                    <p class="text-muted mb-0">Click to learn more</p>
                </div>
            </div>
            <div id="info2" class="about-details collapse">
                <div class="card card-body mt-2 shadow-sm">
                    Get real-time updates on daily, monthly, and total revenues with visual analytics and charts.
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-4 mb-3">
            <div class="card about-card hover-effect clickable" data-target="#info3">
                <div class="card-body text-center">
                    <h5 class="fw-bold">Custom Reports</h5>
                    <p class="text-muted mb-0">Click to learn more</p>
                </div>
            </div>
            <div id="info3" class="about-details collapse">
                <div class="card card-body mt-2 shadow-sm">
                    Generate and download detailed billing reports with filtering options for improved business insights.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    /* Gradient styles */
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
    /* Hover lift effect */
    .hover-effect:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0, 157, 255, 0.5);
        cursor: pointer;
    }
    /* About cards */
    .about-card {
        border-radius: 10px;
        background: #fff;
        border: 2px solid #e6f7ff;
        transition: 0.3s ease;
    }
    .about-card:hover {
        border-color: #009dff;
    }
    .about-details {
        display: none;
    }
    .about-details.show {
        display: block;
        animation: fadeIn 0.3s ease;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<!-- Script for toggle -->
<script>
    document.querySelectorAll('.clickable').forEach(card => {
        card.addEventListener('click', () => {
            const target = document.querySelector(card.dataset.target);
            target.classList.toggle('show');
        });
    });
</script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
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
</script>
@endsection
