<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;

use Illuminate\Http\Request;
use App\Models\Shipment;
use App\Models\Port;

class ReportController extends Controller
{
public function shipments(Request $request)
{
    $status = $request->input('status');
    $start = $request->input('start_date');
    $end = $request->input('end_date');
    $portId = $request->input('port_id');
    $export = $request->input('export');

    $query = Shipment::with(['cargo.client', 'cargo.origin', 'cargo.destination', 'ship']);

    if ($status) {
        $query->where('status', $status);
    }

    if ($start && $end) {
        $query->whereBetween('departure_date', [$start, $end]);
    }

    if ($portId) {
        $query->whereHas('cargo', function ($q) use ($portId) {
            $q->where('origin_port', $portId)
              ->orWhere('destination_port', $portId);
        });
    }

    // === Chart Data: Group by departure_date and sum weights ===
    $grouped = Shipment::selectRaw("DATE(shipments.departure_date) as day, SUM(cargos.weight) as total")

        ->join('cargos', 'shipments.cargo_id', '=', 'cargos.id')
        ->when($status, fn($q) => $q->where('shipments.status', $status))
        ->when($start && $end, fn($q) => $q->whereBetween('shipments.departure_date', [$start, $end]))
        ->when($portId, function ($q) use ($portId) {
            $q->where(function ($sub) use ($portId) {
                $sub->where('cargo.origin_port', $portId)
                    ->orWhere('cargo.destination_port', $portId);
            });
        })
        ->groupBy('day')
        ->orderBy('day')
        ->get();

    $chartLabels = $grouped->pluck('day');
    $chartData = $grouped->pluck('total');

    // === Export CSV ===
    if ($export === 'csv') {
        $csvData = $query->get()->map(function ($shipment) {
            return [
                'Cargo Type' => $shipment->cargo->type,
                'Client' => $shipment->cargo->client->first_name . ' ' . $shipment->cargo->client->last_name,
                'Weight' => $shipment->cargo->weight,
                'From' => $shipment->cargo->origin->name,
                'To' => $shipment->cargo->destination->name,
                'Ship' => $shipment->ship->name,
                'Status' => $shipment->status,
                'Departure' => $shipment->departure_date,
            ];
        });

        $filename = 'shipments_export_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($csvData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, array_keys($csvData->first()));
            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }

    // === Export PDF ===
    if ($export === 'pdf') {
        $data = $query->get();
        $pdf = Pdf::loadView('reports.exports.shipments_pdf', compact('data'));
        return $pdf->download('shipment_report.pdf');
    }

    // === Main page view ===
    $shipments = $query->latest()->paginate(10);
    $ports = Port::all();

    return view('reports.shipments', compact('shipments', 'ports', 'chartLabels', 'chartData'));
}
}