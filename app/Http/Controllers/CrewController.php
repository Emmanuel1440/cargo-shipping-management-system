<?php

namespace App\Http\Controllers;

use App\Models\Crew;
use App\Models\Ship;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCrewRequest;
use App\Http\Requests\UpdateCrewRequest;

class CrewController extends Controller
{
    
public function index(Request $request)
{
    $sortBy = $request->input('sort_by', 'created_at');
    $sortOrder = $request->input('sort_order', 'desc');
    $search = $request->input('search');

    $query = Crew::with('ship');

    // Handle search
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('first_name', 'ilike', "%$search%")
              ->orWhere('last_name', 'ilike', "%$search%")
              ->orWhere('role', 'ilike', "%$search%")
              ->orWhere('nationality', 'ilike', "%$search%");
        });
    }

    // Handle sorting
    if ($sortBy === 'full_name') {
        $query->orderByRaw("LOWER(first_name || ' ' || last_name) $sortOrder");
    } elseif ($sortBy === 'ship_name') {
        $query->join('ships', 'crews.ship_id', '=', 'ships.id')
              ->orderBy('ships.name', $sortOrder)
              ->select('crews.*');
    } else {
        $query->orderBy($sortBy, $sortOrder);
    }

    $crews = $query->paginate(10)->appends($request->query());

    return view('crew.index', compact('crews', 'sortBy', 'sortOrder', 'search'));
}


    public function create()
    {
        $ships = Ship::pluck('name', 'id'); // Efficient
        return view('crew.create', compact('ships'));
    }

    public function store(StoreCrewRequest $request)
    {
        if ($request->role === 'Captain') {
            $existingCaptain = Crew::where('ship_id', $request->ship_id)
                ->where('role', 'Captain')->first();
    
            if ($existingCaptain) {
                return back()->withErrors(['role' => 'This ship already has a Captain.'])->withInput();
            }
        }
    
        $data = $request->validated();
    
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('crew_photos', 'public');
        }
    
        Crew::create($data);
    
        return redirect()->route('crews.index')->with('success', 'Crew member added.');
    }
    
    public function show(Crew $crew)
    {
        return view('crew.show', compact('crew'));
    }

    public function edit(Crew $crew)
    {
        $ships = Ship::pluck('name', 'id');
        return view('crew.edit', compact('crew', 'ships'));
    }

    public function update(UpdateCrewRequest $request, Crew $crew)
    {
        if (
            $request->role === 'Captain' &&
            $crew->role !== 'Captain'
        ) {
            $existingCaptain = Crew::where('ship_id', $request->ship_id)
                ->where('role', 'Captain')->where('id', '!=', $crew->id)->first();

            if ($existingCaptain) {
                return back()->withErrors(['role' => 'This ship already has a Captain.']);
            }
        }

        $crew->update($request->validated());
        return redirect()->route('crews.index')->with('success', 'Crew member updated.');
    }

    public function destroy(Crew $crew)
    {
        $crew->delete();
        return redirect()->route('crews.index')->with('success', 'Crew member removed.');
    }
}
