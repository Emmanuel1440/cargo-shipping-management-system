<?php
namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Cargo;
use App\Models\Ship;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $shipments = Shipment::with(['ship', 'cargo'])
            ->when($search, function ($query, $search) {
                $query->where('status', 'ilike', "%{$search}%")
                    ->orWhereHas('ship', function ($q) use ($search) {
                        $q->where('name', 'ilike', "%{$search}%");
                    })
                    ->orWhereHas('cargo', function ($q) use ($search) {
                        $q->where('type', 'ilike', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10);
    
        return view('shipments.index', compact('shipments', 'search'));
    }
    

    public function create()
    {
        $cargos = Cargo::all();
        $ships = Ship::all();
        return view('shipments.create', compact('cargos', 'ships'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cargo_id' => 'required|exists:cargos,id',
            'ship_id' => 'required|exists:ships,id',
            'departure_date' => 'required|date',
            'arrival_date' => 'nullable|date|after_or_equal:departure_date',
            'status' => 'required|string|in:scheduled,in transit,delivered,cancelled,pending',
        ]);

        Shipment::create($validated);
        return redirect()->route('shipments.index')->with('success', 'Shipment created successfully.');
    }

    public function show(Shipment $shipment)
    {
        return view('shipments.show', compact('shipment'));
    }

    public function edit(Shipment $shipment)
    {
        $cargos = Cargo::all();
        $ships = Ship::all();
        return view('shipments.edit', compact('shipment', 'cargos', 'ships'));
    }

    public function update(Request $request, Shipment $shipment)
    {
        $validated = $request->validate([
            'cargo_id' => 'required|exists:cargos,id',
            'ship_id' => 'required|exists:ships,id',
            'departure_date' => 'required|date',
            'arrival_date' => 'nullable|date|after_or_equal:departure_date',
            'status' => 'required|string|in:scheduled,in transit,delivered,pending,cancelled',
        ]);

        $shipment->update($validated);
        return redirect()->route('shipments.index')->with('success', 'Shipment updated successfully.');
    }

    public function destroy(Shipment $shipment)
    {
        $shipment->delete();
        return redirect()->route('shipments.index')->with('success', 'Shipment deleted successfully.');
    }
}
