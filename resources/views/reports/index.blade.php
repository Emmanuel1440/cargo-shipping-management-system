@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-cover bg-center" style="background-image: url('/images/bg-ship.jpg')">
    <div class="bg-black/70 min-h-screen px-4 py-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white/10 backdrop-blur-md rounded-2xl shadow-lg p-6">
                <h1 class="text-2xl text-white font-bold mb-6">📦 Shipment Reports</h1>

                <!-- Filter Form -->
                <form method="GET" action="{{ route('reports.shipments') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6 text-white">
                    <div>
                        <label for="status" class="block text-sm">Shipment Status</label>
                        <select name="status" id="status" class="w-full mt-1 rounded-xl bg-gray-900/60 text-white border-none shadow-inner">
                            <option value="">All</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in transit" {{ request('status') == 'in transit' ? 'selected' : '' }}>In Transit</option>
                            <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        </select>
                    </div>

                    <div>
                        <label for="start_date" class="block text-sm">Start Date</label>
                        <input type="date" name="start_date" id="start_date"
                            value="{{ request('start_date') }}"
                            class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-900/60 text-white shadow-inner">
                    </div>

                    <div>
                        <label for="end_date" class="block text-sm">End Date</label>
                        <input type="date" name="end_date" id="end_date"
                            value="{{ request('end_date') }}"
                            class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-900/60 text-white shadow-inner">
                    </div>

                    <div>
                        <label for="port_id" class="block text-sm">Port</label>
                        <select name="port_id" id="port_id"
                            class="w-full mt-1 rounded-xl bg-gray-900/60 text-white border-none shadow-inner">
                            <option value="">All Ports</option>
                            @foreach($ports as $port)
                                <option value="{{ $port->id }}" {{ request('port_id') == $port->id ? 'selected' : '' }}>
                                    {{ $port->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-1 md:col-span-4">
                        <button type="submit"
                            class="mt-4 w-full md:w-auto px-6 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white transition duration-300">
                            Filter Results
                        </button>
                    </div>
                </form>

                <!-- Export Buttons -->
                <div class="flex flex-wrap justify-end gap-4 mb-4">
                    <a href="{{ request()->fullUrlWithQuery(['export' => 'csv']) }}"
                        class="bg-emerald-600 hover:bg-emerald-700 px-4 py-2 rounded-xl text-white font-medium transition duration-200">
                        📤 Export CSV
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['export' => 'pdf']) }}"
                        class="bg-rose-600 hover:bg-rose-700 px-4 py-2 rounded-xl text-white font-medium transition duration-200">
                        📄 Export PDF
                    </a>
                </div>

                <!-- Shipment Table -->
                <div class="overflow-x-auto bg-white/10 backdrop-blur-md rounded-xl shadow-md">
                    <table class="w-full table-auto text-sm text-left text-white">
                        <thead class="bg-indigo-700 text-white uppercase">
                            <tr>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Cargo Type</th>
                                <th class="px-4 py-3">Client</th>
                                <th class="px-4 py-3">Weight</th>
                                <th class="px-4 py-3">From</th>
                                <th class="px-4 py-3">To</th>
                                <th class="px-4 py-3">Ship</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Departure</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10">
                            @forelse($shipments as $shipment)
                            <tr class="hover:bg-white/10 transition duration-200">
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">{{ $shipment->cargo->type }}</td>
                                <td class="px-4 py-2">{{ $shipment->cargo->client->first_name }} {{ $shipment->cargo->client->last_name }}</td>
                                <td class="px-4 py-2">{{ $shipment->cargo->weight }} kg</td>
                                <td class="px-4 py-2">{{ $shipment->cargo->origin->name }}</td>
                                <td class="px-4 py-2">{{ $shipment->cargo->destination->name }}</td>
                                <td class="px-4 py-2">{{ $shipment->ship->name }}</td>
                                <td class="px-4 py-2">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                                        {{ $shipment->status == 'delivered' ? 'bg-green-600' : ($shipment->status == 'in transit' ? 'bg-yellow-600' : 'bg-red-600') }}">
                                        {{ ucfirst($shipment->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($shipment->departure_date)->format('d M Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="px-4 py-4 text-center text-white">No shipments found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-4 px-4 py-2">
                        {{ $shipments->withQueryString()->links('pagination::tailwind') }}
                    </div>
                </div>

                <!-- Line Chart -->
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-md p-4 mt-10">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">📊 Transactions Trend</h2>
                    <canvas id="transactionChart" height="120"></canvas>
                </div>

                <!-- Bar Chart -->
                <div class="mt-10">
                    <h2 class="text-xl font-bold text-white mb-4">📈 Shipment Status Summary</h2>
                    <canvas id="statusChart" height="100"></canvas>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Line Chart for Transactions
    const lineCtx = document.getElementById('transactionChart').getContext('2d');
    const transactionChart = new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Total Transactions',
                data: {!! json_encode($chartData) !!},
                borderColor: 'rgba(59, 130, 246, 1)',
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                tension: 0.3,
                fill: true,
                pointRadius: 4,
                pointBackgroundColor: 'rgba(59, 130, 246, 1)',
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: { ticks: { color: '#fff' }, grid: { color: 'rgba(255,255,255,0.1)' } },
                y: { beginAtZero: true, ticks: { color: '#fff' }, grid: { color: 'rgba(255,255,255,0.1)' } }
            },
            plugins: {
                legend: { labels: { color: '#fff' } }
            }
        }
    });

    // Bar Chart for Status Summary
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'bar',
        data: {
            labels: ['Pending', 'In Transit', 'Delivered'],
            datasets: [{
                label: 'Total Shipments',
                data: [
                    {{ \App\Models\Shipment::where('status', 'pending')->count() }},
                    {{ \App\Models\Shipment::where('status', 'in transit')->count() }},
                    {{ \App\Models\Shipment::where('status', 'delivered')->count() }},
                ],
                backgroundColor: ['#f97316', '#facc15', '#22c55e'],
                borderRadius: 10,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                x: { ticks: { color: '#fff' }, grid: { color: 'rgba(255,255,255,0.1)' } },
                y: { beginAtZero: true, ticks: { color: '#fff' }, grid: { color: 'rgba(255,255,255,0.1)' } }
            }
        }
    });
</script>
@endpush
