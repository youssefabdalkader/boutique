<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    public function index()
    {
        // get all governorates
        $governorates = Governorate::with('country')->withCount('cities')->paginate(10);
        return view('admin.governorates.index', compact('governorates'));
    }

    public function create()
    {
        // get all countries
        $countries = \App\Models\Country::all();
        return view('admin.governorates.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        Governorate::create($request->all());

        return redirect()->route('admin.governorate.index')
            ->with('success', 'Governorate created successfully.');
    }

    public function edit(string $id)
    {
        $governorate = Governorate::findOrFail($id);
        // get all countries
        $countries = \App\Models\Country::all();
        return view('admin.governorates.edit', compact('governorate', 'countries'));
    }

    public function update(Request $request, string $id)
    {
        $governorate = Governorate::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        $governorate->update($request->all());

        return redirect()->route('admin.governorate.index')
            ->with('success', 'Governorate updated successfully.');
    }

    public function destroy(string $id)
    {
        $governorate = Governorate::findOrFail($id);
        $governorate->delete();

        return redirect()->route('admin.governorate.index')
            ->with('success', 'Governorate deleted successfully.');
    }
}
