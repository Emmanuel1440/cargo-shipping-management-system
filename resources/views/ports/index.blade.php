@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-fixed bg-cover bg-center" style="background-image: url('/images/port-create-bg.jpg')">
    <div class="absolute inset-0 bg-black/70"></div>

    <div class="relative max-w-6xl mx-auto px-4 py-16">
        <div class="bg-gray-900/80 backdrop-blur-xl shadow-2xl border border-white/10 rounded-3xl p-8 ring-1 ring-white/10">
            
            <div class="flex flex-col md:flex-row items-center justify-between mb-6 gap-4">
                <h1 class="text-2xl font-bold text-white">🌍 Ports</h1>

                <form action="{{ route('ports.index') }}" method="GET" class="w-full md:w-1/2">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="🔍 Search by name, code, or country..."
                           class="w-full px-4 py-2 rounded-xl bg-gray-800/70 text-white placeholder-gray-300 focus:outline-none focus:ring focus:ring-blue-500">
                </form>

                <a href="{{ route('ports.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    ➕ Add Port
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-600/80 text-white rounded shadow">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-white">
                    <thead>
                        <tr class="text-left border-b border-white/10">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Code</th>
                            <th class="px-4 py-3">Location</th>
                            <th class="px-4 py-3">Country</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ports as $port)
                            <tr class="border-b border-white/10 hover:bg-white/10 transition">
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">{{ $port->name }}</td>
                                <td class="px-4 py-2">{{ $port->code }}</td>
                                <td class="px-4 py-2">{{ $port->location }}</td>
                                <td class="px-4 py-2">{{ $port->country }}</td>
                                <td class="px-4 py-2">
                                    <form action="{{ route('ports.toggleStatus', $port->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="px-3 py-1 text-xs rounded-full font-semibold transition
                                            {{ $port->status === 'active' ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }}">
                                            {{ ucfirst($port->status) }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-4 py-2 text-right space-x-2">
                                    <a href="{{ route('ports.edit', $port->id) }}"
                                       class="text-blue-400 hover:underline">✏️ Edit</a>

                                    <form action="{{ route('ports.destroy', $port->id) }}" method="POST" class="inline-block"
                                          onsubmit="return confirm('Are you sure you want to delete this port?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:underline">🗑️ Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-center text-gray-300">No ports found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $ports->appends(request()->query())->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</div>
@endsection
