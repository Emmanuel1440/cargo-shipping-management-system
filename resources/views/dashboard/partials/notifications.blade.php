<h2 class="text-xl font-bold mb-4 text-white">🔔 Notifications</h2>
<ul class="space-y-4">

    <!-- Delivery Today -->
    <li class="flex items-center gap-3 p-4 rounded-xl 
        {{ $deliveriesToday > 0 ? 'bg-yellow-500/10 text-yellow-200' : 'bg-green-500/10 text-green-200' }}">
        <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z"></path>
        </svg>
        <span class="text-sm">
            {{ $deliveriesToday > 0 
                ? "$deliveriesToday shipment(s) arriving today." 
                : "No pending deliveries today." }}
        </span>
    </li>

    <!-- This Week -->
    <li class="flex items-center gap-3 p-4 rounded-xl bg-blue-500/10 text-blue-200">
        <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
            </path>
        </svg>
        <span class="text-sm">
            {{ $shipmentsThisWeek }} shipment(s) expected to arrive this week.
        </span>
    </li>

    <!-- Client Activity -->
    <li class="flex items-center gap-3 p-4 rounded-xl 
        {{ $inactiveClients > 0 ? 'bg-red-500/10 text-red-200' : 'bg-green-500/10 text-green-200' }}">
        <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M5.121 17.804A11.955 11.955 0 0112 15c2.28 0 4.385.64 6.121 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z">
            </path>
        </svg>
        <span class="text-sm">
            {{ $inactiveClients > 0 
                ? "$inactiveClients client(s) inactive." 
                : "All clients are currently active." }}
        </span>
    </li>
</ul>
