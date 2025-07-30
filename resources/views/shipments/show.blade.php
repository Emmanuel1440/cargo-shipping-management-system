@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('/images/bg.jpg');">
    <div class="backdrop-blur-sm bg-black/40 min-h-screen flex items-center justify-center px-4">
        <div class="bg-white/10 border border-white/20 text-white rounded-2xl shadow-xl w-full max-w-3xl p-8">
            <h1 class="text-3xl font-bold mb-6">Shipment Details</h1>

            <div class="space-y-4 text-lg">
                <div>
                    <strong class="block text-sm text-white/70">Cargo:</strong>
                    {{ $shipment->cargo->description ?? 'N/A' }}
                </div>

                <div>
                    <strong class="block text-sm text-white/70">Ship:</strong>
                    {{ $shipment->ship->name ?? 'N/A' }}
                </div>

                <div>
                    <strong class="block text-sm text-white/70">Departure Date:</strong>
                    {{ \Carbon\Carbon::parse($shipment->departure_date)->format('F j, Y') }}
                </div>

                <div>
                    <strong class="block text-sm text-white/70">Arrival Date:</strong>
                    {{ \Carbon\Carbon::parse($shipment->arrival_date)->format('F j, Y') }}
                </div>

                <div>
                    <strong class="block text-sm text-white/70">Status:</strong>
                    <span class="inline-block px-2 py-1 rounded bg-blue-600/80 text-white text-sm">
                        {{ ucfirst($shipment->status) }}
                    </span>
                </div>
            </div>

            <div class="mt-8 flex justify-between">
                <a href="{{ route('shipments.index') }}"
                   class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600 transition">
                    Back to List
                </a>
                <a href="{{ route('shipments.edit', $shipment->id) }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500 transition">
                    Edit Shipment
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
