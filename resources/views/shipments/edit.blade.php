@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-fixed bg-cover bg-center" style="background-image: url('/images/ship-bg.jpg')">
    <div class="absolute inset-0 bg-black/70"></div>

    <div class="relative max-w-4xl mx-auto px-6 py-14">
        <div class="bg-gray-900/90 backdrop-blur-lg border border-white/10 shadow-2xl rounded-3xl p-10 ring-1 ring-white/10">
            <h1 class="text-2xl font-bold mb-6 text-white">✏️ Edit Shipment</h1>

            @if($errors->any())
                <div class="mb-4 text-sm text-red-400">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('shipments.update', $shipment->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="cargo_id" class="block text-sm font-medium text-white">Cargo</label>
                    <select name="cargo_id" id="cargo_id" required
                        class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white">
                        <option value="">-- Select Cargo --</option>
                        @foreach($cargos as $cargo)
                            <option value="{{ $cargo->id }}" {{ $shipment->cargo_id == $cargo->id ? 'selected' : '' }}>
                                {{ $cargo->type }} - {{ $cargo->description }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="ship_id" class="block text-sm font-medium text-white">Ship</label>
                    <select name="ship_id" id="ship_id" required
                        class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white">
                        <option value="">-- Select Ship --</option>
                        @foreach($ships as $ship)
                            <option value="{{ $ship->id }}"
                                data-type="{{ $ship->type }}"
                                {{ $shipment->ship_id == $ship->id ? 'selected' : '' }}>
                                {{ $ship->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="ship_type" class="block text-sm font-medium text-white">Ship Type</label>
                    <select name="ship_type" id="ship_type" readonly
                        class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-700 text-white shadow-inner cursor-not-allowed">
                        <option value="">-- Auto-filled Ship Type --</option>
                        <option value="cargo ship" {{ $shipment->ship_type == 'cargo ship' ? 'selected' : '' }}>Cargo Ship</option>
                        <option value="container" {{ $shipment->ship_type == 'container' ? 'selected' : '' }}>Container</option>
                        <option value="military ship" {{ $shipment->ship_type == 'military ship' ? 'selected' : '' }}>Military Ship</option>
                        <option value="passenger ship" {{ $shipment->ship_type == 'passenger ship' ? 'selected' : '' }}>Passenger Ship</option>
                        <option value="other" {{ $shipment->ship_type == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div>
                    <label for="departure_date" class="block text-sm font-medium text-white">Departure Date</label>
                    <input type="date" name="departure_date" id="departure_date"
                        value="{{ old('departure_date', $shipment->departure_date) }}"
                        class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white">
                </div>

                <div>
                    <label for="arrival_date" class="block text-sm font-medium text-white">Arrival Date</label>
                    <input type="date" name="arrival_date" id="arrival_date"
                        value="{{ old('arrival_date', $shipment->arrival_date) }}"
                        class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white">
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-white">Status</label>
                    <select name="status" id="status"
                        class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white">
                        @foreach(['scheduled', 'in transit', 'delivered', 'pending','cancelled'] as $status)
                            <option value="{{ $status }}" {{ $shipment->status == $status ? 'selected' : '' }}>
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
                        class="bg-yellow-600 text-white px-6 py-2 rounded-lg hover:bg-yellow-700 transition shadow">
                        💾 Update Shipment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Add this inside your layout or at bottom of the view --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const shipSelect = document.getElementById('ship_id');
        const typeSelect = document.getElementById('ship_type');

        function updateShipType() {
            const selected = shipSelect.options[shipSelect.selectedIndex];
            const type = selected.getAttribute('data-type');
            if (type) {
                [...typeSelect.options].forEach(option => {
                    option.selected = option.value.toLowerCase() === type.toLowerCase();
                });
            }
        }

        shipSelect.addEventListener('change', updateShipType);
        updateShipType(); // trigger once on load to fill initial value
    });
</script>
@endpush
@endsection
