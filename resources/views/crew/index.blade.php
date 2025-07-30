@extends('layouts.app')

@section('header', 'Crew Members')

@section('content')
<div class="relative min-h-screen bg-gray-100 dark:bg-gray-900 flex flex-col">

    {{-- Background Image --}}
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/crew-bg.jpg') }}" alt="Crew Background"
             class="w-full h-full object-cover">
    </div>

    {{-- Content Container --}}
    <div class="relative z-10 p-6 w-full max-w-7xl mx-auto bg-white/90 dark:bg-gray-800/90 rounded-xl shadow-md">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Crew Members</h1>
            <a href="{{ route('crews.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                + Add Crew
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @php
            function sortLink($label, $column, $currentSort, $currentOrder) {
                $nextOrder = ($currentSort === $column && $currentOrder === 'asc') ? 'desc' : 'asc';
                $arrow = $currentSort === $column ? ($currentOrder === 'asc' ? '↑' : '↓') : '';
                $url = request()->fullUrlWithQuery(['sort_by' => $column, 'sort_order' => $nextOrder]);
                return "<a href='{$url}' class='hover:underline font-semibold text-blue-700 dark:text-blue-400'>{$label} {$arrow}</a>";
            }
        @endphp

        {{-- Search Form --}}
        <div class="flex justify-between items-center mb-4">
            <form method="GET" action="{{ route('crews.index') }}" class="flex gap-2">
                <input
                    type="text"
                    name="search"
                    placeholder="Search name, role, nationality..."
                    value="{{ request('search') }}"
                    class="border border-gray-300 bg-white text-gray-800 dark:bg-gray-700 dark:text-white dark:border-gray-600 rounded px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">Search</button>
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 shadow-sm rounded">
                <thead class="bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-gray-100 font-semibold">
                    <tr>
                        <th class="px-4 py-3 text-left">{!! sortLink('Ship', 'ship_name', $sortBy, $sortOrder) !!}</th>
                        <th class="px-4 py-3 text-left">{!! sortLink('Name', 'full_name', $sortBy, $sortOrder) !!}</th>
                        <th class="px-4 py-3 text-left">{!! sortLink('Role', 'role', $sortBy, $sortOrder) !!}</th>
                        <th class="px-4 py-3 text-left">{!! sortLink('Nationality', 'nationality', $sortBy, $sortOrder) !!}</th>
                        <th class="px-4 py-3 text-left">{!! sortLink('Status', 'is_active', $sortBy, $sortOrder) !!}</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($crews as $crew)
                        <tr class="border-t border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800">
                            <td class="px-4 py-2">{{ $crew->ship->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $crew->first_name }} {{ $crew->last_name }}</td>
                            <td class="px-4 py-2">{{ $crew->role }}</td>
                            <td class="px-4 py-2">{{ $crew->nationality }}</td>
                            <td class="px-4 py-2">
                                @if ($crew->is_active)
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-200">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-200">
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-2 space-x-2 text-right">
                                <a href="{{ route('crews.show', $crew) }}" class="text-indigo-600 hover:underline">View</a>
                                <a href="{{ route('crews.edit', $crew) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">Edit</a>
                                <form action="{{ route('crews.destroy', $crew) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" class="text-red-600 dark:text-red-400 hover:underline text-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">No crew members found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>{{-- Pagination Links --}}
<div class="mt-6 text-center">
    {{ $crews->links('pagination::tailwind') }}
</div>

        </div>

    </div> {{-- end z-10 container --}}
</div>
@endsection
