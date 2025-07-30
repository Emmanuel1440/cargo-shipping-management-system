@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-fixed bg-cover bg-center" style="background-image: url('/images/create1.jpg')">
    <div class="absolute inset-0 bg-black/40"></div>

    <div class="relative max-w-7xl mx-auto px-4 py-12">
        <div class="bg-gray+10/50 backdrop-blur-lg border border-white/10 shadow-2xl rounded-2xl p-8 ring-1 ring-white/10">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-white">👥 Clients</h1>
                <a href="{{ route('clients.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                    ➕ Add Client
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 p-3 text-sm text-green-200 bg-green-800/60 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-white">
                    <thead>
                        <tr class="bg-gray-800/70 text-left">
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">First Name</th>
                            <th class="px-4 py-2">Last Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Phone</th>
                            <th class="px-4 py-2">Address</th>
                            <th class="px-4 py-2">Active</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clients as $client)
                            <tr class="border-b border-white/10 hover:bg-gray-800/50">
                                <td class="px-4 py-2">{{ $client->id }}</td>
                                <td class="px-4 py-2">{{ $client->first_name }}</td>
                                <td class="px-4 py-2">{{ $client->last_name }}</td>
                                <td class="px-4 py-2">{{ $client->email_address ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $client->phone_number ?? '-' }}</td>
                                <td class="px-4 py-2">{{ Str::limit($client->address, 30) }}</td>
                                <td class="px-4 py-2">
                                    <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold {{ $client->is_active ? 'bg-green-600 text-white' : 'bg-red-600 text-white' }}">
                                        {{ $client->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('clients.show', $client) }}" class="text-blue-300 hover:underline">View</a>
                                    <a href="{{ route('clients.edit', $client) }}" class="text-yellow-300 hover:underline">Edit</a>
                                    <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-4 text-center text-gray-400">No clients found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $clients->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
