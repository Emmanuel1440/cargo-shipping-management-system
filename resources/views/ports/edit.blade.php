@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-fixed bg-cover bg-center" style="background-image: url('/images/port-create-bg.jpg')">
    <div class="absolute inset-0 bg-black/70"></div>

    <div class="relative max-w-3xl mx-auto px-6 py-14">
        <div class="bg-gray-900/80 backdrop-blur-2xl border border-white/10 shadow-2xl rounded-3xl p-10 ring-1 ring-white/10">
            <h1 class="text-2xl font-bold mb-6 text-white">✏️ Edit Port</h1>

            @if($errors->any())
                <div class="mb-4 text-sm text-red-400">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('ports.update', $port->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-medium text-white">Port Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $port->name) }}"
                           class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white placeholder-gray-300 shadow-inner focus:outline-none">
                </div>

                <div>
                    <label for="code" class="block text-sm font-medium text-white">Port Code</label>
                    <input type="text" name="code" id="code" value="{{ old('code', $port->code) }}"
                           class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white shadow-inner focus:outline-none">
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-white">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location', $port->location) }}"
                           class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white shadow-inner focus:outline-none">
                </div>

                <div>
                    <label for="country" class="block text-sm font-medium text-white">Country</label>
                    <input type="text" name="country" id="country" value="{{ old('country', $port->country) }}"
                           class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white shadow-inner focus:outline-none">
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-white">Status</label>
                    <select name="status" id="status"
                            class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white shadow-inner focus:outline-none">
                        @foreach(['active', 'inactive'] as $status)
                            <option value="{{ $status }}" {{ old('status', $port->status) == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="pt-6 flex justify-between items-center">
                    <a href="{{ route('ports.index') }}"
                       class="text-sm text-blue-300 hover:underline">
                        ← Cancel / Back
                    </a>

                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition shadow">
                        💾 Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
