<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::with('governorate.country')->paginate(10);
        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        $governorates = \App\Models\Governorate::all();
        return view('admin.cities.create', compact('governorates'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'governorate_id' => 'required',
        ]);
        City::create($request->all());
        return redirect()->route('admin.city.index')->with('success', 'City created successfully');
    }

    public function edit(City $city)
    {
        $governorates = \App\Models\Governorate::all();
        return view('admin.cities.edit', compact('city', 'governorates'));
    }

    public function update(Request $request, string $id)
    {
        $city = City::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'governorate_id' => 'required',
        ]);
        $city->update($request->all());
        return redirect()->route('admin.city.index')->with('success', 'City updated successfully');
    }

    public function destroy(string $id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return redirect()->route('admin.city.index')->with('success', 'City deleted successfully');
    }
}
