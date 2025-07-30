<?php

namespace App\Http\Controllers;

use App\Models\Ship;
use Illuminate\Http\Request;

class ShipController extends Controller
{
    public function index(Request $request)
{
    $query = Ship::query()->where('is_active', true);

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    $ships = $query->latest()->paginate(9); // 9 per page for 3-column layout

    return view('ships.index', compact('ships'));
}


    public function create()
    {
        return view('ships.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255|unique:ships',
            'capacity_in_tonnes' => 'nullable|numeric|min:0',
            'type' => 'required|in:cargo ship,passenger ship,military ship,icebreaker,fishing vessel,container,other',
            'status' => 'required|in:active,under maintenance,decommissioned',
        ]);

        Ship::create($validated);

        return redirect()->route('ships.index')->with('success', 'Ship created successfully.');
    }

    public function show(Ship $ship)
    {
        return view('ships.show', compact('ship'));
    }

    public function edit(Ship $ship)
    {
        return view('ships.edit', compact('ship'));
    }

    public function update(Request $request, Ship $ship)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255|unique:ships,registration_number,' . $ship->id,
            'capacity_in_tonnes' => 'nullable|numeric|min:0',
            'type' => 'required|in:cargo ship,passenger ship,military ship,icebreaker,fishing vessel,barge ship',
            'status' => 'required|in:active,under maintenance,decommissioned',
        ]);

        $ship->update($validated);

        return redirect()->route('ships.index')->with('success', 'Ship updated successfully.');
    }

    public function destroy(Ship $ship)
    {
        $ship->is_active = !$ship->is_active;
        $ship->save();

        return redirect()->route('ships.index')->with('success', 'Ship status updated.');
    }
}
