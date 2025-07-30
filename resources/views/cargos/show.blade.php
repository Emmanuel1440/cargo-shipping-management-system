@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-cover bg-center py-12 px-4" style="background-image: url('/images/bg.jpg');">
    <div class="max-w-3xl mx-auto bg-white/10 backdrop-blur-md rounded-2xl shadow-xl text-white p-8 space-y-6">
        <h1 class="text-2xl font-bold mb-6">Cargo Details</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="font-semibold">Type:</h2>
                <p class="text-white/90">{{ $cargo->type }}</p>
            </div>

            <div>
                <h2 class="font-semibold">Weight:</h2>
                <p class="text-white/90">{{ $cargo->weight }} kg</p>
            </div>

            <div class="md:col-span-2">
                <h2 class="font-semibold">Description:</h2>
                <p class="text-white/90">{{ $cargo->description ?? 'N/A' }}</p>
            </div>

            <div>
                <h2 class="font-semibold">OriginPort:</h2>
                <p class="text-white/90">{{ $cargo->origin?->name ?? 'N/A' }}</p>
            </div>

            <div>
                <h2 class="font-semibold">Destination Port:</h2>
                <p class="text-white/90">{{ $cargo->destination?->name ?? 'N/A' }}</p>
            </div>

            <div>
                <h2 class="font-semibold">Status:</h2>
                <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full
                    {{ $cargo->status == 'delivered' ? 'bg-green-700' : ($cargo->status == 'in transit' ? 'bg-yellow-600' : 'bg-gray-600') }}">
                    {{ ucfirst($cargo->status) }}
                </span>
            </div>

            <div>
                <h2 class="font-semibold">Client:</h2>
                <p class="text-white/90">
                    {{ $cargo->client ? $cargo->client->first_name . ' ' . $cargo->client->last_name : 'Unknown' }}
                </p>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('cargos.index') }}"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl transition">
                ← Back to List
            </a>
        </div>
    </div>
</div>
@endsection
