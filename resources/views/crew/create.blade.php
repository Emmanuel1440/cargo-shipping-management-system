@extends('layouts.app')

@section('header', 'Create Crew Member')

@section('content')
<div class="relative min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 overflow-hidden">

{{-- Clear Background Image --}}
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/crew-bg.jpg') }}" alt="Crew Background"
             class="w-full h-full object-cover">
    </div>


    {{-- Form Card --}}
    <div class="relative z-10 w-full max-w-3xl p-6 bg-white/80 dark:bg-gray-800/80 backdrop-blur rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Create Crew Member</h2>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded dark:bg-red-200">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('crews.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 dark:text-gray-200">First Name</label>
                <input name="first_name" class="w-full mt-1 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-200">Last Name</label>
                <input name="last_name" class="w-full mt-1 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-200">Phone Number</label>
                <input name="phone_number" class="w-full mt-1 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-200">Nationality</label>
                <input name="nationality" class="w-full mt-1 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-200">Ship</label>
                <select name="ship_id" class="w-full mt-1 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    @foreach ($ships as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-200">Role</label>
                <select name="role" class="w-full mt-1 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    @foreach (['Captain', 'Engineer', 'Deckhand', 'Cook', 'Navigator'] as $role)
                        <option value="{{ $role }}">{{ $role }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 dark:text-gray-200">Active</label>
                <select name="is_active" class="w-full mt-1 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="mt-6">
                <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Create</button>
                <a href="{{ route('crews.index') }}" class="ml-4 text-gray-600 dark:text-gray-300 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
