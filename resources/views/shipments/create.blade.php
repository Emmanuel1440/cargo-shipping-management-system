@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-fixed bg-cover bg-center" style="background-image: url('/images/ship-bg.jpg')">
    <div class="absolute inset-0 bg-black/70"></div>

    <div class="relative max-w-4xl mx-auto px-6 py-14">
        <div class="bg-gray-900/90 backdrop-blur-lg border border-white/10 shadow-2xl rounded-3xl p-10 ring-1 ring-white/10">
            <h1 class="text-2xl font-bold mb-6 text-white">📦 Create Shipment</h1>

            @if($errors->any())
                <div class="mb-4 text-sm text-red-400">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php
                $shipTypeMap = [];
                foreach ($ships as $ship) {
                    $shipTypeMap[$ship->id] = $ship->type;
                }
            @endphp

            <form action="{{ route('shipments.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="cargo_id" class="block text-sm font-medium text-white">Cargo</label>
                    <select name="cargo_id" id="cargo_id" required
                        class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white shadow-inner focus:outline-none">
                        <option value="">-- Select Cargo --</option>
                        @foreach($cargos as $cargo)
                            <option value="{{ $cargo->id }}">{{ $cargo->type }} - {{ $cargo->description }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="ship_id" class="block text-sm font-medium text-white">Ship</label>
                    <select name="ship_id" id="ship_id" required
                        onchange="updateShipType()"
                        class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white shadow-inner focus:outline-none">
                        <option value="">-- Select Ship --</option>
                        @foreach($ships as $ship)
                            <option value="{{ $ship->id }}">{{ $ship->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="ship_type" class="block text-sm font-medium text-white">Ship Type</label>
                    <select name="ship_type" id="ship_type" required disabled
                        class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white shadow-inner focus:outline-none">
                        <option value="">-- Select Ship Type --</option>
                        <option value="cargo ship">Cargo Ship</option>
                        <option value="container">Container</option>
                        <option value="military ship">Military Ship</option>
                        <option value="passenger ship">Passenger Ship</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div>
                    <label for="departure_date" class="block text-sm font-medium text-white">Departure Date</label>
                    <input type="date" name="departure_date" id="departure_date" required
                           value="{{ old('departure_date') }}"
                           class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white focus:outline-none">
                </div>

                <div>
                    <label for="arrival_date" class="block text-sm font-medium text-white">Arrival Date</label>
                    <input type="date" name="arrival_date" id="arrival_date"
                           value="{{ old('arrival_date') }}"
                           class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white focus:outline-none">
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-white">Status</label>
                    <select name="status" id="status"
                        class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white focus:outline-none">
                        @foreach(['scheduled', 'in transit', 'delivered', 'pending','cancelled'] as $status)
                            <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="pt-6 flex justify-between items-center">
                    <a href="{{ route('shipments.index') }}" class="text-sm text-blue-300 hover:underline">
                        ← Cancel / Back
                    </a>

                    <button type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition shadow">
                        ➕ Create Shipment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Add JavaScript below --}}
<script>
    const shipTypeMap = @json($shipTypeMap);

    function updateShipType() {
        const shipId = document.getElementById('ship_id').value;
        const type = shipTypeMap[shipId] || '';
        const shipTypeSelect = document.getElementById('ship_type');

        // Enable the field to set it, then disable it again
        shipTypeSelect.disabled = false;

        [...shipTypeSelect.options].forEach(option => {
            option.selected = (option.value.toLowerCase() === type.toLowerCase());
        });

        shipTypeSelect.disabled = true;
    }
</script>
@endsection
