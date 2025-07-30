@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('/images/crt1.jpg'); /* place your image in public/images/ */
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
    }
</style>

<div class="max-w-3xl mx-auto px-6 py-16">
    <div class="bg-white/10 dark:bg-gray-900/40 backdrop-blur-2xl border border-white/10 shadow-2xl rounded-3xl p-10 ring-1 ring-white/10">
        <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-white drop-shadow">🚢 Register New Ship</h1>

        @if($errors->any())
            <div class="mb-4 text-sm text-red-500 bg-white/30 dark:bg-red-900/30 p-3 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ships.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium">Ship Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="w-full mt-1 px-4 py-2 rounded-xl bg-white/40 dark:bg-gray-800/50 text-gray-900 dark:text-white shadow-inner focus:outline-none">
            </div>

            <div>
                <label for="registration_number" class="block text-sm font-medium">Registration Number</label>
                <input type="text" name="registration_number" id="registration_number" value="{{ old('registration_number') }}"
                       class="w-full mt-1 px-4 py-2 rounded-xl bg-white/40 dark:bg-gray-800/50 text-gray-900 dark:text-white shadow-inner focus:outline-none">
            </div>

            <div>
                <label for="capacity_in_tonnes" class="block text-sm font-medium">Capacity (tonnes)</label>
                <input type="number" name="capacity_in_tonnes" id="capacity_in_tonnes" value="{{ old('capacity_in_tonnes') }}"
                       step="0.01"
                       class="w-full mt-1 px-4 py-2 rounded-xl bg-white/40 dark:bg-gray-800/50 text-gray-900 dark:text-white shadow-inner focus:outline-none">
            </div>

            <div>
                <label for="type" class="block text-sm font-medium">Ship Type</label>
                <select name="type" id="type"
                        class="w-full mt-1 px-4 py-2 rounded-xl bg-white/40 dark:bg-gray-800/50 text-gray-900 dark:text-white shadow-inner focus:outline-none">
                    <option value="">Select Type</option>
                    @foreach(['cargo ship', 'passenger ship', 'military ship', 'icebreaker', 'fishing vessel', 'container','other'] as $type)
                        <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium">Status</label>
                <select name="status" id="status"
                        class="w-full mt-1 px-4 py-2 rounded-xl bg-white/40 dark:bg-gray-800/50 text-gray-900 dark:text-white shadow-inner focus:outline-none">
                    <option value="">Select Status</option>
                    @foreach(['active', 'under maintenance', 'decommissioned'] as $status)
                        <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="pt-6 flex justify-between items-center">
                <a href="{{ route('ships.index') }}" class="text-sm text-blue-200 hover:underline">← Back to List</a>

                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition shadow-md hover:shadow-lg">
                    🚀 Save Ship
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
