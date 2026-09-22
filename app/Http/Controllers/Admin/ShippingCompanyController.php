<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\ShippingCompany;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ShippingCompanyController extends Controller
{
    /**
     * Display a listing of shipping companies.
     */
    public function index(Request $request)
    {
        $query = ShippingCompany::with('countries');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by fast
        if ($request->filled('fast')) {
            $query->where('fast', $request->fast);
        }

        // Sorting
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');

        $allowedSorts = [
            'id',
            'name',
            'code',
            'cost',
            'fast',
            'status',
            'created_at',
        ];

        if (! in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }

        if (! in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc';
        }

        $query->orderBy($sort, $direction);

        // Pagination
        $perPage = $request->get('limit', 10);

        if (! in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }

        $shippingCompanies = $query->paginate($perPage)
            ->withQueryString();

        return view(
            'admin.shipping-companies.index',
            compact('shippingCompanies')
        );
    }

    /**
     * Show create form.
     */
    public function create()
    {
        $countries = Country::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.shipping-companies.create',
            compact('countries')
        );
    }

    /**
     * Store a new shipping company.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'code' => [
                'required',
                'string',
                'max:255',
                'unique:shipping_companies,code',
            ],

            'description' => [
                'required',
                'string',
                'max:255',
                'unique:shipping_companies,description',
            ],

            'cost' => [
                'required',
                'integer',
                'min:0',
            ],

            'fast' => [
                'required',
                'boolean',
            ],

            'status' => [
                'required',
                'boolean',
            ],

            'countries' => [
                'required',
                'array',
                'min:1',
            ],

            'countries.*' => [
                'exists:countries,id',
            ],
        ]);

        $shippingCompany = ShippingCompany::create([
            'name' => $validated['name'],
            'code' => $validated['code'],
            'description' => $validated['description'],
            'cost' => $validated['cost'],
            'fast' => $validated['fast'],
            'status' => $validated['status'],
        ]);

        // Attach countries
        $shippingCompany->countries()->sync(
            $validated['countries']
        );

        return redirect()
            ->route('admin.shipping-company.index')
            ->with('success', 'Shipping company created successfully.');
    }

    /**
     * Display shipping company details.
     */
    public function show(ShippingCompany $shippingCompany)
    {
        $shippingCompany->load('countries');

        return view(
            'admin.shipping-companies.show',
            compact('shippingCompany')
        );
    }

    /**
     * Show edit form.
     */
    public function edit(ShippingCompany $shippingCompany)
    {
        $countries = Country::where('status', true)
            ->orderBy('name')
            ->get();

        $shippingCompany->load('countries');

        return view(
            'admin.shipping-companies.edit',
            compact(
                'shippingCompany',
                'countries'
            )
        );
    }

    /**
     * Update shipping company.
     */
    public function update(
        Request $request,
        ShippingCompany $shippingCompany
    ) {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique(
                    'shipping_companies',
                    'code'
                )->ignore($shippingCompany->id),
            ],

            'description' => [
                'required',
                'string',
                'max:255',
                Rule::unique(
                    'shipping_companies',
                    'description'
                )->ignore($shippingCompany->id),
            ],

            'cost' => [
                'required',
                'integer',
                'min:0',
            ],

            'fast' => [
                'required',
                'boolean',
            ],

            'status' => [
                'required',
                'boolean',
            ],

            'countries' => [
                'required',
                'array',
                'min:1',
            ],

            'countries.*' => [
                'exists:countries,id',
            ],
        ]);

        $shippingCompany->update([
            'name' => $validated['name'],
            'code' => $validated['code'],
            'description' => $validated['description'],
            'cost' => $validated['cost'],
            'fast' => $validated['fast'],
            'status' => $validated['status'],
        ]);

        // Update countries
        $shippingCompany->countries()->sync(
            $validated['countries']
        );

        return redirect()
            ->route('admin.shipping-company.index')
            ->with('success', 'Shipping company updated successfully.');
    }

    /**
     * Delete shipping company.
     */
    public function destroy(ShippingCompany $shippingCompany)
    {
        $shippingCompany->delete();

        return redirect()
            ->route('admin.shipping-company.index')
            ->with('success', 'Shipping company deleted successfully.');
    }
}
