@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-fixed bg-cover bg-center bg-no-repeat"
     style="background-image: url('/images/ship-bg.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-30 backdrop-blur-sm"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 py-10 text-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">🚢 Ship Management</h1>
            <a href="{{ route('ships.create') }}"
               class="bg-green-600 text-white px-5 py-2 rounded-lg shadow hover:bg-green-700 transition">
               + Add Ship
            </a>
        </div>

        {{-- Filter Bar --}}
        <form method="GET"
              class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4 bg-white/10 dark:bg-gray-900/30 p-4 rounded-2xl shadow">
            <select name="status"
                    class="rounded-lg px-4 py-2 bg-white/30 dark:bg-gray-700/40 shadow-inner text-gray-900 dark:text-white">
                <option value="">All Statuses</option>
                <option value="active">Active</option>
                <option value="under maintenance">Under Maintenance</option>
                <option value="decommissioned">Decommissioned</option>
            </select>

            <select name="type"
                    class="rounded-lg px-4 py-2 bg-white/30 dark:bg-gray-700/40 shadow-inner text-gray-900 dark:text-white">
                <option value="">All Types</option>
                <option value="cargo ship">Cargo Ship</option>
                <option value="passenger ship">Passenger Ship</option>
                <option value="military ship">Military Ship</option>
                <option value="icebreaker">Icebreaker</option>
                <option value="fishing vessel">Fishing Vessel</option>
                <option value="barge ship">Barge Ship</option>
            </select>

            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                Filter
            </button>

            <a href="{{ route('ships.index') }}"
               class="text-sm text-gray-300 hover:underline self-center text-right">
                Clear Filters
            </a>
        </form>

        {{-- Ship List --}}
        <div class="bg-white/20 dark:bg-gray-800/30 backdrop-blur-md rounded-xl p-4 shadow-xl overflow-x-auto">
            <table class="w-full table-auto text-sm">
                <thead>
                    <tr class="text-left text-gray-200 border-b border-white/10">
                        <th class="p-2">Name</th>
                        <th class="p-2">Registration #</th>
                        <th class="p-2">Type</th>
                        <th class="p-2">Capacity (T)</th>
                        <th class="p-2">Status</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ships as $ship)
                        <tr class="border-b border-white/10 hover:bg-white/10 dark:hover:bg-gray-700/20 transition">
                            <td class="p-2 font-semibold">{{ $ship->name }}</td>
                            <td class="p-2">{{ $ship->registration_number }}</td>
                            <td class="p-2 capitalize">{{ $ship->type }}</td>
                            <td class="p-2">{{ $ship->capacity_in_tonnes }}</td>
                            <td class="p-2">
                                <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold
                                    @if($ship->status == 'active') bg-green-500 text-white
                                    @elseif($ship->status == 'under maintenance') bg-yellow-500 text-white
                                    @else bg-red-500 text-white @endif">
                                    {{ $ship->status }}
                                </span>
                            </td>
                            <td class="p-2 space-x-2">
                                <a href="{{ route('ships.edit', $ship->id) }}"
                                   class="text-blue-300 hover:underline">Edit</a>

                                @if($ship->is_active)
                                <form action="{{ route('ships.destroy', $ship->id) }}" method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Decommission this ship?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-400 hover:underline">Deactivate</button>
                                </form>
                                @else
                                <span class="text-xs italic text-red-400">Decommissioned</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-4 text-gray-300">
                                No ships found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $ships->links() }}
        </div>
    </div>
</div>
@endsection
