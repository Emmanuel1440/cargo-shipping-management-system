@php
    $types = ['cargo ship', 'passenger ship', 'military ship', 'icebreaker', 'fishing vessel', 'container','other'];
    $statuses = ['active', 'under maintenance', 'decommissioned'];
@endphp

<div>
    <label>Name</label>
    <input type="text" name="name" value="{{ old('name', $ship->name) }}" required class="w-full border p-2">
</div>

<div>
    <label>Registration Number</label>
    <input type="text" name="registration_number" value="{{ old('registration_number', $ship->registration_number) }}" required class="w-full border p-2">
</div>

<div>
    <label>Capacity (Tonnes)</label>
    <input type="number" step="0.01" name="capacity_in_tonnes" value="{{ old('capacity_in_tonnes', $ship->capacity_in_tonnes) }}" class="w-full border p-2">
</div>

<div>
    <label>Type</label>
    <select name="type" class="w-full border p-2">
        @foreach($types as $type)
            <option value="{{ $type }}" @selected(old('type', $ship->type) == $type)>{{ ucfirst($type) }}</option>
        @endforeach
    </select>
</div>

<div>
    <label>Status</label>
    <select name="status" class="w-full border p-2">
        @foreach($statuses as $status)
            <option value="{{ $status }}" @selected(old('status', $ship->status) == $status)>{{ ucfirst($status) }}</option>
        @endforeach
    </select>
</div>
