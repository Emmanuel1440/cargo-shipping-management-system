<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <title>RouteXpress</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    spacing: {
                        '1.5': '0.375rem',
                    }
                }
            }
        };
    </script>

    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font Awesome (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body class="bg-gray-900 text-white font-sans overflow-hidden">

<div x-data="{ sidebarOpen: true }" class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside 
        x-show="sidebarOpen"
        class="fixed top-0 left-0 h-full w-64 bg-gray-800/90 backdrop-blur-xl p-4 space-y-6 shadow-xl z-40 transition-transform duration-300 transform"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    >
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold">🚢 RouteXpress</h2>
            <button @click="sidebarOpen = false">
                <i class="fas fa-chevron-left"></i>
            </button>
        </div>
        <nav class="space-y-2 mt-4">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-xl bg-indigo-700 font-semibold">📊 Dashboard</a>
            <a href="{{ route('clients.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-600">👥 Clients</a>
            <a href="{{ route('ships.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-600">🛳️ Ships</a>
            <a href="{{ route('cargos.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-600">📦 Cargos</a>
            <a href="{{ route('crews.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-600"> 👥Crews</a>
            <a href="{{ route('ports.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-600">⚓ Ports</a>
            <a href="{{ route('shipments.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-600">📦 Shipments</a>
            <a href="{{ route('reports.shipments') }}" class="block px-4 py-2 rounded hover:bg-indigo-600">📈 Reports</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col" :class="sidebarOpen ? 'md:ml-64' : 'ml-0'">
        <!-- Top bar with toggle button -->
        <header class="bg-gray-800/70 p-4 flex items-center justify-between">
            <button @click="sidebarOpen = !sidebarOpen" class="text-white text-xl">
                <i :class="sidebarOpen ? 'fas fa-bars-staggered' : 'fas fa-bars'"></i>
            </button>
            <span class="font-bold text-lg">RouteXpress</span>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto bg-[url('/images/bg-ship.jpg')] bg-cover bg-center p-6">
            <div class="bg-black/60 backdrop-blur-lg rounded-2xl p-6">
                {{-- Flash Message --}}
                @if (session('success'))
                    <div class="bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100 px-4 py-2 mb-4 rounded-md shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Page Content --}}
                @yield('content')
            </div>
        </main>
    </div>
</div>

@stack('scripts')

</body>
</html>
