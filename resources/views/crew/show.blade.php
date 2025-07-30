@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 dark:bg-gray-400 py-10 px-4">
    <div class="max-w-5xl mx-auto bg-gradient-to-br from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 text-gray-900 dark:text-white shadow-2xl rounded-3xl p-10 transition-all duration-300 transform hover:scale-[1.005]">

        {{-- Page Header --}}
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800 dark:text-white">Crew Member Details</h2>
            <div class="space-x-2">
                <a href="{{ route('crews.edit', $crew) }}"
                   class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-md transition">Edit</a>
                <a href="{{ route('crews.index') }}"
                   class="inline-block px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded-lg hover:bg-gray-400 dark:hover:bg-gray-600 shadow-md transition">Back</a>
            </div>
        </div>

        {{-- Profile Section --}}
        <div class="flex flex-col md:flex-row gap-10 items-start">
            {{-- Profile Photo --}}
            <div class="w-full md:w-1/3 flex justify-center">
                @if ($crew->photo)
                    <img src="{{ asset('storage/' . $crew->photo) }}" alt="Profile Photo"
                         class="w-48 h-48 rounded-full object-cover border-4 border-gray-300 dark:border-gray-700 shadow-xl">
                @else
                    <img src="{{ asset('images/crew-bg.jpg') }}" alt="Default Photo"
                         class="w-48 h-48 rounded-full object-cover border-4 border-gray-300 dark:border-gray-700 shadow-xl">
                @endif
            </div>

            {{-- Crew Info --}}
            <div class="w-full md:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-6 text-base">
                <div class="space-y-2">
                    <p><span class="font-semibold">Full Name:</span> {{ $crew->first_name }} {{ $crew->last_name }}</p>
                    <p><span class="font-semibold">Role:</span> {{ $crew->role }}</p>
                    <p><span class="font-semibold">Nationality:</span> {{ $crew->nationality }}</p>
                    <p><span class="font-semibold">Ship:</span> {{ $crew->ship->name ?? 'N/A' }}</p>
                </div>
                <div class="space-y-2">
                    <p><span class="font-semibold">Phone:</span> {{ $crew->phone_number }}</p>
                    <p>
                        <span class="font-semibold">Status:</span>
                        @if ($crew->is_active)
                            <span class="text-green-500 font-semibold">Active</span>
                        @else
                            <span class="text-red-500 font-semibold">Inactive</span>
                        @endif
                    </p>
                    <p><span class="font-semibold">Created:</span> {{ $crew->created_at->format('d M Y, H:i') }}</p>
                    <p><span class="font-semibold">Updated:</span> {{ $crew->updated_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
