@extends('layouts.app')

@section('content')
<div class="min-h-screen p-6 text-white bg-black/50 backdrop-blur">
    <h2 class="text-3xl font-bold mb-6">🔔 Notification History</h2>

    <div class="bg-white/10 p-6 rounded-xl space-y-3">
        @forelse(auth()->user()->notifications as $note)
            <div class="border-b border-white/10 pb-3">
                <div class="text-sm">{{ $note->data['message'] ?? 'No message found' }}</div>
                <div class="text-xs text-gray-400">{{ $note->created_at->diffForHumans() }}</div>
            </div>
        @empty
            <p class="text-gray-400">No notifications yet.</p>
        @endforelse
    </div>
</div>
@endsection
