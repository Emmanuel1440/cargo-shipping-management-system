{{-- resources/views/cargos/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-fixed bg-cover bg-center" style="background-image: url('/images/ed.jpg')">
    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative max-w-3xl mx-auto px-4 py-16">
        <div class="bg-gray-900/80 backdrop-blur-lg p-6 rounded-2xl shadow-xl">
            <h1 class="text-white text-xl font-semibold mb-6">➕ Add New Cargo</h1>
            @if($errors->any())
    <div class="bg-red-600 text-white p-3 rounded-lg mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <form action="{{ route('cargos.store') }}" method="POST" class="space-y-4">
                @csrf

                

                <div>
    <label for="type" class="block text-sm text-white">Cargo Type</label>
    <select name="type" id="type"
        class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white shadow-inner"
        required>
        <option value="" disabled {{ old('cargo_type') ? '' : 'selected' }}>-- Select Cargo Type --</option>
        <option value="perishable" {{ old('cargo_type') == 'perishable' ? 'selected' : '' }}>Perishable</option>
        <option value="dangerous" {{ old('cargo_type') == 'dangerous' ? 'selected' : '' }}>Dangerous</option>
        <option value="container" {{ old('type') == 'container' ? 'selected' : '' }}>Container</option>
        <option value="bulk" {{ old('type') == 'bulk' ? 'selected' : '' }}>Bulk</option>
        <option value="liquid" {{ old('type') == 'liquid' ? 'selected' : '' }}>Liquid</option>
        <option value="general" {{ old('cargo_type', 'general') == 'general' ? 'selected' : '' }}>General</option>
        <option value="other" {{ old('cargo_type') == 'other' ? 'selected' : '' }}>Other</option>
    </select>
</div>

                <div>
                    <label for="description" class="block text-sm text-white">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white shadow-inner">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label for="weight" class="block text-sm text-white">Weight (kg)</label>
                    <input type="number" step="0.01" name="weight" id="weight" value="{{ old('weight') }}"
                        class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white shadow-inner">
                </div>

                <div>
    <label for="client_id" class="block text-sm font-medium text-white">Client</label>
    <select name="client_id" id="client_id"
            class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white shadow-inner focus:outline-none">
        <option value="">-- Select Client --</option>
        @foreach ($clients as $client)
            <option value="{{ $client->id }}" {{ old('client_id', $cargo->client_id ?? '') == $client->id ? 'selected' : '' }}>
                {{ $client->first_name }} {{ $client->last_name }}
            </option>
        @endforeach
    </select>
</div>


                <div>
                    <label for="origin_port" class="block text-sm text-white">Origin Port</label>
                    <select name="origin_port" id="origin_port"
                        class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white">
                        @foreach($ports as $port)
                            <option value="{{ $port->id }}" {{ old('origin_port') == $port->id ? 'selected' : '' }}>
                                {{ $port->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="destination_port" class="block text-sm text-white">Destination Port</label>
                    <select name="destination_port" id="destination_port"
                        class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white">
                        @foreach($ports as $port)
                            <option value="{{ $port->id }}" {{ old('destination_port') == $port->id ? 'selected' : '' }}>
                                {{ $port->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-sm text-white">Status</label>
                    <select name="status" id="status"
                        class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white">
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in transit" {{ old('status') == 'in transit' ? 'selected' : '' }}>In Transit</option>
                        <option value="delivered" {{ old('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-2 pt-4">
                    <a href="{{ route('cargos.index') }}"
                        class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg">Cancel</a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
