@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-fixed bg-cover bg-center" style="background-image: url('/images/ed.jpg')">
    <div class="absolute inset-0 bg-black/70"></div>

    <div class="relative max-w-3xl mx-auto px-4 py-12">
        <div class="bg-gray-900/90 backdrop-blur-md border border-white/10 shadow-2xl rounded-2xl p-8 ring-1 ring-white/10">

            <h2 class="text-2xl font-bold text-white mb-6">👤 Client Details</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-white text-sm">
                <div>
                    <p class="text-gray-400">First Name</p>
                    <p class="font-semibold">{{ $client->first_name }}</p>
                </div>

                <div>
                    <p class="text-gray-400">Last Name</p>
                    <p class="font-semibold">{{ $client->last_name }}</p>
                </div>

                <div>
                    <p class="text-gray-400">Email Address</p>
                    <p class="font-semibold">{{ $client->email_address ?? '—' }}</p>
                </div>

                <div>
                    <p class="text-gray-400">Phone Number</p>
                    <p class="font-semibold">{{ $client->phone_number ?? '—' }}</p>
                </div>

                <div class="md:col-span-2">
                    <p class="text-gray-400">Address</p>
                    <p class="font-semibold">{{ $client->address ?? '—' }}</p>
                </div>

                <div>
                    <p class="text-gray-400">Status</p>
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-medium 
                        {{ $client->is_active ? 'bg-green-700 text-white' : 'bg-red-700 text-white' }}">
                        {{ $client->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>

                <div>
                    <p class="text-gray-400">Created</p>
                    <p class="font-semibold">{{ $client->created_at->format('d M Y, h:i A') }}</p>
                </div>
            </div>

            <div class="mt-8">
                <a href="{{ route('clients.index') }}"
                    class="inline-block text-white hover:underline text-sm">
                    ← Back to Clients
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
