<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;
use App\Models\Cargo;
use App\Models\Client;
use App\Models\Ship;
use App\Models\Port;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Chart Data: Total cargo weight per departure date
        $grouped = Shipment::join('cargos', 'shipments.cargo_id', '=', 'cargos.id')
            ->selectRaw("DATE(shipments.departure_date) as day, SUM(cargos.weight) as total")
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $chartLabels = $grouped->pluck('day');
        $chartData = $grouped->pluck('total');

        // Dashboard Metrics
        $totalShips = Ship::count();
        $totalPorts = Port::count();
        $totalCargo = Cargo::count();
        $totalShipments = Shipment::count();

        // Notifications
        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();
        $weekEnd = Carbon::now()->endOfWeek();

        $deliveriesToday = Shipment::whereDate('arrival_date', $today)->count();
        $shipmentsThisWeek = Shipment::whereBetween('arrival_date', [$weekStart, $weekEnd])->count();
        $inactiveClients = Client::where('is_active', false)->count();

        return view('dashboard.index', compact(
            'chartLabels',
            'chartData',
            'totalShips',
            'totalPorts',
            'totalCargo',
            'totalShipments',
            'deliveriesToday',
            'shipmentsThisWeek',
            'inactiveClients'
        ));
    }
    public function notifications()
{
    $today = \Carbon\Carbon::today();
    $weekStart = \Carbon\Carbon::now()->startOfWeek();
    $weekEnd = \Carbon\Carbon::now()->endOfWeek();

    $deliveriesToday = Shipment::whereDate('arrival_date', $today)->count();
    $shipmentsThisWeek = Shipment::whereBetween('arrival_date', [$weekStart, $weekEnd])->count();
    $inactiveClients = Client::where('is_active', false)->count();

    return view('dashboard.partials.notifications', compact(
        'deliveriesToday', 'shipmentsThisWeek', 'inactiveClients'
    ));
}

}
