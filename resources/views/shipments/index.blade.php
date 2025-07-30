@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-fixed bg-cover bg-center" style="background-image: url('/images/ship-bg.jpg')">
    <div class="absolute inset-0 bg-black/40"></div> <!-- less blur/darkness -->

    <div class="relative max-w-7xl mx-auto px-6 py-14">
        <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-3xl shadow-xl p-8 ring-1 ring-white/20">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-white">📦 Shipments</h1>
                <a href="{{ route('shipments.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition">
                    ➕ Add Shipment
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 text-green-400 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-white">
                    <thead class="bg-white/10 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-4 py-3 text-left">#</th>
                            <th class="px-4 py-3 text-left">Cargo</th>
                            <th class="px-4 py-3 text-left">Ship</th>
                            <th class="px-4 py-3 text-left">Ship Type</th>
                            <th class="px-4 py-3 text-left">Departure</th>
                            <th class="px-4 py-3 text-left">Arrival</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <form method="GET" action="{{ route('shipments.index') }}" class="mb-4 flex items-center gap-2">
    <input type="text" name="search" value="{{ $search }}" placeholder="Search by status, ship, or cargo"
        class="rounded-lg px-4 py-2 border bg-white/30 text-white placeholder-white/70 focus:outline-none" />
    <button type="submit"
        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">Search</button>
</form>

                    <tbody class="divide-y divide-white/10">
                        @foreach($shipments as $shipment)
                            <tr>
                                <td class="px-4 py-2">{{ $shipment->id }}</td>
                                <td class="px-4 py-2">
                                    {{ $shipment->cargo->description ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $shipment->ship->name ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $shipment->ship->type ?? 'N/A'}}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $shipment->departure_date }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $shipment->arrival_date }}
                                </td>
                                <td class="px-4 py-2">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                                        @if($shipment->status == 'completed') bg-green-600
                                        @elseif($shipment->status == 'in transit') bg-yellow-600
                                        @elseif($shipment->status == 'cancelled') bg-red-600
                                        @else bg-blue-600
                                        @endif text-white">
                                        {{ ucfirst($shipment->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('shipments.show', $shipment->id) }}"
                                       class="text-blue-300 hover:underline text-sm">Show</a>
                                    <a href="{{ route('shipments.edit', $shipment->id) }}"
                                       class="text-yellow-300 hover:underline text-sm">Edit</a>
                                    <form action="{{ route('shipments.destroy', $shipment->id) }}"
                                          method="POST" class="inline-block"
                                          onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:underline text-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @if($shipments->isEmpty())
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-center text-white/70">No shipments found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table><div class="mt-4">
    {{ $shipments->withQueryString()->links() }}
</div>

            </div>
        </div>
    </div>
</div>
@endsection
