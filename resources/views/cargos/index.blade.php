@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-fixed bg-cover bg-center" style="background-image: url('/images/ed.jpg')">
    <div class="absolute inset-0 bg-black/70"></div>

    <div class="relative max-w-6xl mx-auto px-6 py-14">
        <div class="bg-white/10 backdrop-blur-md shadow-2xl rounded-3xl p-10 ring-1 ring-white/10 border border-white/10">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-white">📦 All Cargos</h1>
                <a href="{{ route('cargos.create') }}"
                   class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg transition shadow">
                    ＋ Add Cargo
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-700 text-white rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-white">
                    <thead class="bg-gray-800/80 text-left uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Clients</th>
                            <th class="px-4 py-3">Cargo Type</th>
                            <th class="px-4 py-3">Weight (kg)</th>
                            <td class="px-4 py-3">Description</td>
                            <th class="px-4 py-3">Origin</th>
                            <th class="px-4 py-3">Destination</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-black/40">
                        @forelse($cargos as $cargo)
                            <tr class="border-t border-white/10 hover:bg-white/5 transition">
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3">{{ $cargo->client ? $cargo->client->first_name . ' ' . $cargo->client->last_name : 'Unknown' }}
                                </td>
                                <td class="px-4 py-3">{{ $cargo->type }}</td>
                                <td class="px-4 py-3">{{ $cargo->weight }}</td>
                                <td class="px-4 py-3">{{ $cargo->description}}  </td>
                                <td class="px-4 py-3">{{ $cargo->origin?->name ?? 'N/A' }}</td>
                                <td class="px-4 py-3">{{ $cargo->destination?->name ?? 'N/A' }}</td>
                                <td class="px-4 py-3">
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                   {{ $cargo->status == 'delivered' ? 'bg-green-700' : 
                                   ($cargo->status == 'in transit' ? 'bg-yellow-500' : 
                                   ($cargo->status == 'pending' ? 'bg-red-600' : 'bg-grey-600')) }}">
                                     {{ ucfirst($cargo->status) }}
                                </span>

                                </td>
                                <td class="px-4 py-3 flex gap-2">
                                    <a href="{{ route('cargos.edit', $cargo->id) }}"
                                       class="text-blue-300 hover:underline text-sm">Edit</a>
                                       <a href="{{ route('cargos.show', $cargo->id) }}"
                                         class="inline-block text-blue-400 hover:text-blue-600 underline mr-2 transition">
                         View
                          </a>

                                    <form action="{{ route('cargos.destroy', $cargo->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:underline text-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-6 text-gray-300">No cargos found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table><div class="mt-4">
    {{ $cargos->links() }}
</div>

            </div>
        </div>
    </div>
</div>
@endsection
