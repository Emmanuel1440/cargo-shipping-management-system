@extends('layouts.app')

@section('header', 'Edit Crew Member')

@section('content')
<div class="relative min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900">

    {{-- Background Image --}}
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/crew-bg.jpg') }}" alt="Edit Crew Background"
             class="w-full h-full object-cover" />
    </div>

    {{-- Form Content --}}
    <div class="relative z-10 w-full max-w-2xl bg-white dark:bg-gray-800 text-gray-800 dark:text-white p-8 rounded shadow-md">
        <h2 class="text-2xl font-semibold mb-6 text-center text-gray-900 dark:text-white">Edit Crew Member</h2>

        <form action="{{ route('crews.update', $crew) }}" method="POST" class="space-y-4">
            @csrf @method('PUT')

            <div>
                <label class="block">First Name</label>
                <input name="first_name" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600"
                       value="{{ old('first_name', $crew->first_name) }}">
                @error('first_name') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label class="block">Last Name</label>
                <input name="last_name" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600"
                       value="{{ old('last_name', $crew->last_name) }}">
                @error('last_name') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label class="block">Phone Number</label>
                <input name="phone_number" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600"
                       value="{{ old('phone_number', $crew->phone_number) }}">
                @error('phone_number') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label class="block">Nationality</label>
                <input name="nationality" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600"
                       value="{{ old('nationality', $crew->nationality) }}">
                @error('nationality') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label class="block">Ship</label>
                <select name="ship_id" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600">
                    @foreach ($ships as $id => $name)
                        <option value="{{ $id }}" {{ $crew->ship_id == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                @error('ship_id') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label class="block">Role</label>
                <select name="role" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600">
                    @foreach (['Captain', 'Engineer', 'Deckhand', 'Cook', 'Navigator'] as $role)
                        <option value="{{ $role }}" {{ $crew->role == $role ? 'selected' : '' }}>{{ $role }}</option>
                    @endforeach
                </select>
                @error('role') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label class="block">Active</label>
                <select name="is_active" class="w-full p-2 border rounded dark:bg-gray-700 dark:border-gray-600">
                    <option value="1" {{ $crew->is_active ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$crew->is_active ? 'selected' : '' }}>No</option>
                </select>
                @error('is_active') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>

            <div class="flex justify-between items-center mt-4">
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                <a href="{{ route('crews.index') }}" class="text-blue-600 dark:text-blue-300 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
