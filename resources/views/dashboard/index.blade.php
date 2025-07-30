@extends('layouts.app')

@section('content')
<div class="min-h-screen flex bg-cover bg-center" style="background-image: url('/images/background.jpg')">
    <main class="flex-1 bg-black/50 p-6 text-white overflow-y-auto backdrop-blur">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold">📊 Dashboard Overview</h1>
            <p class="text-sm text-gray-300">Quick insights into your operations.</p>
        </div>

        <!-- Functional Block 1: Dashboard Metrics -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-indigo-600/90 text-white rounded-xl p-4 shadow-lg">
                <h3 class="text-sm">Total Ships</h3>
                <p class="text-2xl font-bold mt-2">{{ $totalShips }}</p>
            </div>
            <div class="bg-teal-600/90 text-white rounded-xl p-4 shadow-lg">
                <h3 class="text-sm">Total Ports</h3>
                <p class="text-2xl font-bold mt-2">{{ $totalPorts }}</p>
            </div>
            <div class="bg-yellow-600/90 text-white rounded-xl p-4 shadow-lg">
                <h3 class="text-sm">Total Cargo</h3>
                <p class="text-2xl font-bold mt-2">{{ $totalCargo }}</p>
            </div>
            <div class="bg-pink-600/90 text-white rounded-xl p-4 shadow-lg">
                <h3 class="text-sm">Total Shipments</h3>
                <p class="text-2xl font-bold mt-2">{{ $totalShipments }}</p>
            </div>
        </div>

        <!-- Functional Block 2: Shipment Chart Trends -->
        <div class="bg-white/10 rounded-xl p-6 mt-6 shadow-xl">
            <h2 class="text-lg text-white mb-4 font-semibold">📊 Shipments Over Time</h2>
            <canvas id="shipmentTrendChart"></canvas>
        </div>

        <!-- Optional Notifications -->
        <!-- Notifications (Dynamic) -->
<!-- Notifications (Auto-refresh enabled) -->
<div id="notification-area" class="mt-10 p-6 rounded-2xl shadow-xl bg-white/10 backdrop-blur">
    @include('dashboard.partials.notifications')
</div>


    </main>
</div>

@push('scripts')
<script>
function loadNotifications() {
    fetch('{{ route("dashboard.notifications") }}')
        .then(res => res.text())
        .then(html => {
            document.getElementById('notification-area').innerHTML = html;
        });
}

// Load every 30 seconds
setInterval(loadNotifications, 30000);
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('shipmentTrendChart');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($chartLabels),
        datasets: [{
            label: 'Shipments',
            data: @json($chartData),
            fill: false,
            borderColor: '#4f46e5',
            tension: 0.3
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { labels: { color: '#fff' } }
        },
        scales: {
            x: {
                ticks: { color: '#fff' },
                grid: { color: 'rgba(255,255,255,0.1)' }
            },
            y: {
                beginAtZero: true,
                ticks: { color: '#fff' },
                grid: { color: 'rgba(255,255,255,0.1)' }
            }
        }
    }
});
</script>
@endpush
@endsection
