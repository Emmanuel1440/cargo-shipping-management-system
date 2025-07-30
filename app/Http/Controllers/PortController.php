<?php

namespace App\Http\Controllers;

use App\Models\Port;
use Illuminate\Http\Request;

class PortController extends Controller
{
    public function index(Request $request)
{
    $query = Port::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where('name', 'ILIKE', "%{$search}%")
              ->orWhere('code', 'ILIKE', "%{$search}%")
              ->orWhere('country', 'ILIKE', "%{$search}%");
    }

    $ports = $query->orderBy('name')->paginate(10);

    return view('ports.index', compact('ports'));
}
 
public function toggleStatus(Port $port)
{
    $port->status = $port->status === 'active' ? 'inactive' : 'active';
    $port->save();

    return redirect()->route('ports.index')->with('success', 'Port status updated successfully.');
}

    public function create()
    {
        return view('ports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:ports,code',
            'location' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'status' => 'required|in:active,inactive',
        ]);

        Port::create($request->all());

        return redirect()->route('ports.index')->with('success', 'Port registered successfully!');
    }

    public function show(Port $port)
    {
        return view('ports.show', compact('port'));
    }

    public function edit(Port $port)
    {
        return view('ports.edit', compact('port'));
    }

    public function update(Request $request, Port $port)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:ports,code,' . $port->id,
            'location' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'status' => 'required|in:active,inactive',
        ]);

        $port->update($request->all());

        return redirect()->route('ports.index')->with('success', 'Port updated successfully!');
    }

    public function destroy(Port $port)
    {
        $port->delete();
        return redirect()->route('ports.index')->with('success', 'Port deleted.');
    }
}
