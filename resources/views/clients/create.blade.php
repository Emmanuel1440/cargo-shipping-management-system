@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-fixed bg-cover bg-center" style="background-image: url('/images/ed.jpg')">
    <div class="absolute inset-0 bg-black/40"></div>

    <div class="relative max-w-3xl mx-auto px-4 py-12">
        <div class="bg-gray-900/90 backdrop-blur-md border border-white/10 shadow-2xl rounded-2xl p-8 ring-1 ring-white/10">

            <h2 class="text-2xl font-bold text-white mb-6">➕ Add New Client</h2>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-800/50 text-white rounded-xl">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>⚠️ {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('clients.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-white text-sm block mb-1">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}"
                            class="w-full px-4 py-2 rounded-xl bg-gray-800/80 text-white border border-white/10">
                    </div>

                    <div>
                        <label class="text-white text-sm block mb-1">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}"
                            class="w-full px-4 py-2 rounded-xl bg-gray-800/80 text-white border border-white/10">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-white text-sm block mb-1">Email Address</label>
                        <input type="email" name="email_address" value="{{ old('email_address') }}"
                            class="w-full px-4 py-2 rounded-xl bg-gray-800/80 text-white border border-white/10">
                    </div>

                    <div>
                        <label class="text-white text-sm block mb-1">Phone Number</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                            class="w-full px-4 py-2 rounded-xl bg-gray-800/80 text-white border border-white/10">
                    </div>
                </div>

                <div>
                    <label class="text-white text-sm block mb-1">Address</label>
                    <textarea name="address" rows="3"
                        class="w-full px-4 py-2 rounded-xl bg-gray-800/80 text-white border border-white/10">{{ old('address') }}</textarea>
                </div>

                <div>
                    <label class="text-white text-sm block mb-1">Status</label>
                    <select name="is_active"
                        class="w-full px-4 py-2 rounded-xl bg-gray-800/80 text-white border border-white/10">
                        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('clients.index') }}" class="text-white hover:underline">← Cancel</a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow">
                        ✅ Save Client
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
