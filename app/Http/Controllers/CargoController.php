<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Client;
use App\Models\Port;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cargos = Cargo::with(['client', 'origin', 'destination'])->paginate(10);

        return view('cargos.index', compact('cargos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show($id)
{
    $cargo = Cargo::with(['client', 'origin', 'destination'])->findOrFail($id);
    return view('cargos.show', compact('cargo'));
}

    public function create()
    {
        $clients = Client::all();
        $ports = Port::all();
        return view('cargos.create', compact('clients', 'ports'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
           
            'type' => 'required|string|in:container,bulk,liquid,general,refrigerated',
            'description' => 'nullable|string',
            'weight' => 'required|numeric',
            'origin_port' => 'required|integer|exists:ports,id',
            'destination_port' => 'required|integer|exists:ports,id',
            'status' => 'required|string|in:pending,in transit,delivered',
            'client_id' => 'required|integer|exists:clients,id',
        ]);

        Cargo::create($request->all());

        return redirect()->route('cargos.index')->with('success', 'Cargo created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cargo = Cargo::findOrFail($id);
        $clients = Client::all();
        $ports = Port::all();

        return view('cargos.edit', compact('cargo', 'clients', 'ports'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string',
            'weight' => 'required|numeric',
            'type' => 'required|string',
            'client_id' => 'required|exists:clients,id',
            'origin_port' => 'required|exists:ports,id',
            'destination_port' => 'required|exists:ports,id',
            'status' => 'required|in:in transit,delivered,pending',
        ]);

        $cargo = Cargo::findOrFail($id);
        $cargo->update($request->all());

        return redirect()->route('cargos.index')->with('success', 'Cargo updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cargo = Cargo::findOrFail($id);
        $cargo->delete();

        return redirect()->route('cargos.index')->with('success', 'Cargo deleted successfully.');
    }
}
