@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-fixed bg-cover bg-center" style="background-image: url('/images/ed.jpg')">
    <div class="absolute inset-0 bg-black/70 z-0"></div>

    <div class="relative z-10 max-w-3xl mx-auto px-6 py-14">
        <div class="bg-gray-900/90 backdrop-blur-lg border border-white/10 shadow-2xl rounded-3xl p-10 ring-1 ring-white/10">
            <h1 class="text-2xl font-bold mb-6 text-white">✏️ Edit Cargo</h1>

            @if($errors->any())
                <div class="mb-4 text-sm text-red-400">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('cargos.update', $cargo->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
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
                    <label for="description" class="block text-sm font-medium text-white">Description</label>
                    <textarea name="description" id="description" rows="3"
                              class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white shadow-inner focus:outline-none">{{ old('description', $cargo->description) }}</textarea>
                </div>

                <div>
                    <label for="weight" class="block text-sm font-medium text-white">Weight (kg)</label>
                    <input type="number" name="weight" id="weight" step="0.01"
                           value="{{ old('weight', $cargo->weight) }}"
                           class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white shadow-inner focus:outline-none">
                </div>

                <div>
                    <label for="origin_port" class="block text-sm font-medium text-white">Origin Port</label>
                    <select name="origin_port" id="origin_port"
                            class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white">
                        @foreach($ports as $port)
                            <option value="{{ $port->id }}" {{ old('origin_port', $cargo->origin_port) == $port->id ? 'selected' : '' }}>
                                {{ $port->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="destination_port" class="block text-sm font-medium text-white">Destination Port</label>
                    <select name="destination_port" id="destination_port"
                            class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white">
                        @foreach($ports as $port)
                            <option value="{{ $port->id }}" {{ old('destination_port', $cargo->destination_port) == $port->id ? 'selected' : '' }}>
                                {{ $port->name }}
                            </option>
                        @endforeach
                    </select>
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
                    <label for="status" class="block text-sm font-medium text-white">Status</label>
                    <select name="status" id="status"
                            class="w-full mt-1 px-4 py-2 rounded-xl bg-gray-800/80 text-white shadow-inner focus:outline-none">
                        @foreach(['pending', 'in transit', 'delivered'] as $status)
                            <option value="{{ $status }}" {{ old('status', $cargo->status) == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="pt-6 flex justify-between items-center">
                    <a href="{{ route('cargos.index') }}"
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
