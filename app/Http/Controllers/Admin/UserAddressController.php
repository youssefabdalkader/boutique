<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\user_address;
use App\Models\Country;
use App\Models\Governorate;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserAddressController extends Controller
{
    /**
     * Display a listing of user addresses.
     */
    public function index(Request $request)
    {
        $query = user_address::with([
            'user',
            'country',
            'governorate',
            'city',
        ]);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('address_title', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('address2', 'like', "%{$search}%")
                    ->orWhere('zip_code', 'like', "%{$search}%")
                    ->orWhere('po_box', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                            ->orWhere('user_name', 'like', "%{$search}%");
                    });
            });
        }

        // Country filter
        if ($request->filled('country_id')) {
            $query->where('country_id', $request->country_id);
        }

        // Governorate filter
        if ($request->filled('governorate_id')) {
            $query->where('governorate_id', $request->governorate_id);
        }

        // City filter
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        // Default address filter
        if ($request->filled('default_address')) {
            $query->where(
                'default_address',
                $request->default_address
            );
        }

        // Sorting
        $allowedSorts = [
            'id',
            'address_title',
            'zip_code',
            'default_address',
            'created_at',
        ];

        $sortBy = in_array($request->sort_by, $allowedSorts)
            ? $request->sort_by
            : 'id';

        $direction = $request->direction === 'asc'
            ? 'asc'
            : 'desc';

        $query->orderBy($sortBy, $direction);

        // Pagination
        $limit = in_array((int) $request->limit, [10, 25, 50, 100])
            ? (int) $request->limit
            : 10;

        $addresses = $query
            ->paginate($limit)
            ->withQueryString();

        $countries = Country::orderBy('name')->get();

        $governorates = Governorate::with('country')
            ->orderBy('name')
            ->get();

        $cities = City::with('governorate')
            ->orderBy('name')
            ->get();

        return view('admin.user_addresses.index', compact(
            'addresses',
            'countries',
            'governorates',
            'cities'
        ));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        $users = User::orderBy('first_name')->get();

        $countries = Country::where('status', true)
            ->orderBy('name')
            ->get();

        return view('admin.user_addresses.create', compact(
            'users',
            'countries'
        ));
    }

    /**
     * Store address.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => [
                'required',
                'exists:users,id',
            ],

            'address_title' => [
                'required',
                'string',
                'max:255',
            ],

            'default_address' => [
                'nullable',
                'boolean',
            ],

            'address' => [
                'nullable',
                'string',
                'max:255',
            ],

            'address2' => [
                'nullable',
                'string',
                'max:255',
            ],

            'zip_code' => [
                'nullable',
                'string',
                'max:50',
            ],

            'po_box' => [
                'nullable',
                'string',
                'max:50',
            ],

            'country_id' => [
                'required',
                'exists:countries,id',
            ],

            'governorate_id' => [
                'required',
                Rule::exists('governorates', 'id')
                    ->where(function ($query) use ($request) {
                        $query->where('country_id', $request->country_id);
                    }),
            ],

            'city_id' => [
                'required',
                Rule::exists('cities', 'id')
                    ->where(function ($query) use ($request) {
                        $query->where(
                            'governorate_id',
                            $request->governorate_id
                        );
                    }),
            ],
        ]);

        /*
         * If this address is default,
         * remove default from other addresses of the same user.
         */
        if ($request->boolean('default_address')) {
            user_address::where('user_id', $request->user_id)
                ->update([
                    'default_address' => false,
                ]);
        }

        user_address::create([
            'user_id' => $validated['user_id'],
            'address_title' => $validated['address_title'],
            'default_address' => $request->boolean('default_address'),
            'address' => $validated['address'] ?? null,
            'address2' => $validated['address2'] ?? null,
            'zip_code' => $validated['zip_code'] ?? null,
            'po_box' => $validated['po_box'] ?? null,
            'country_id' => $validated['country_id'],
            'governorate_id' => $validated['governorate_id'],
            'city_id' => $validated['city_id'],
        ]);

        return redirect()
            ->route('admin.user-address.index')
            ->with('success', 'User address created successfully.');
    }

    /**
     * Display address.
     */
    public function show(user_address $user_address)
    {
        $user_address->load([
            'user',
            'country',
            'governorate',
            'city',
        ]);

        return view(
            'admin.user_addresses.show',
            compact('user_address')
        );
    }

    /**
     * Show edit form.
     */
    public function edit(user_address $user_address)
    {
        $user_address->load([
            'user',
            'country',
            'governorate',
            'city',
        ]);

        $users = User::orderBy('first_name')->get();

        $countries = Country::where('status', true)
            ->orderBy('name')
            ->get();

        /*
         * Load governorates belonging to selected country.
         */
        $governorates = Governorate::where(
            'country_id',
            $user_address->country_id
        )
            ->where('status', true)
            ->orderBy('name')
            ->get();

        /*
         * Load cities belonging to selected governorate.
         */
        $cities = City::where(
            'governorate_id',
            $user_address->governorate_id
        )
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view('admin.user_addresses.edit', compact(
            'user_address',
            'users',
            'countries',
            'governorates',
            'cities'
        ));
    }

    /**
     * Update address.
     */
    public function update(
        Request $request,
        user_address $user_address
    ) {
        $validated = $request->validate([
            'user_id' => [
                'required',
                'exists:users,id',
            ],

            'address_title' => [
                'required',
                'string',
                'max:255',
            ],

            'default_address' => [
                'nullable',
                'boolean',
            ],

            'address' => [
                'nullable',
                'string',
                'max:255',
            ],

            'address2' => [
                'nullable',
                'string',
                'max:255',
            ],

            'zip_code' => [
                'nullable',
                'string',
                'max:50',
            ],

            'po_box' => [
                'nullable',
                'string',
                'max:50',
            ],

            'country_id' => [
                'required',
                'exists:countries,id',
            ],

            'governorate_id' => [
                'required',
                Rule::exists('governorates', 'id')
                    ->where(function ($query) use ($request) {
                        $query->where(
                            'country_id',
                            $request->country_id
                        );
                    }),
            ],

            'city_id' => [
                'required',
                Rule::exists('cities', 'id')
                    ->where(function ($query) use ($request) {
                        $query->where(
                            'governorate_id',
                            $request->governorate_id
                        );
                    }),
            ],
        ]);

        if ($request->boolean('default_address')) {
            user_address::where('user_id', $request->user_id)
                ->where('id', '!=', $user_address->id)
                ->update([
                    'default_address' => false,
                ]);
        }

        $user_address->update([
            'user_id' => $validated['user_id'],
            'address_title' => $validated['address_title'],
            'default_address' => $request->boolean('default_address'),
            'address' => $validated['address'] ?? null,
            'address2' => $validated['address2'] ?? null,
            'zip_code' => $validated['zip_code'] ?? null,
            'po_box' => $validated['po_box'] ?? null,
            'country_id' => $validated['country_id'],
            'governorate_id' => $validated['governorate_id'],
            'city_id' => $validated['city_id'],
        ]);

        return redirect()
            ->route('admin.user-address.index')
            ->with('success', 'User address updated successfully.');
    }

    /**
     * Delete address.
     */
    public function destroy(user_address $user_address)
    {
        $user_address->delete();

        return redirect()
            ->route('admin.user-address.index')
            ->with('success', 'User address deleted successfully.');
    }

    /**
     * Get governorates by country.
     */
    public function getGovernorates($countryId)
    {
        $governorates = Governorate::where('country_id', $countryId)
            ->where('status', true)
            ->orderBy('name')
            ->get([
                'id',
                'name',
            ]);

        return response()->json($governorates);
    }

    /**
     * Get cities by governorate.
     */
    public function getCities($governorateId)
    {
        $cities = City::where(
            'governorate_id',
            $governorateId
        )
            ->where('status', true)
            ->orderBy('name')
            ->get([
                'id',
                'name',
            ]);

        return response()->json($cities);
    }
}
