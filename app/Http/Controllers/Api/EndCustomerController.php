<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EndCustomer;
use Illuminate\Http\Request;

class EndCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $partner = $request->user();
        
        $customers = EndCustomer::where('partner_id', $partner->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function($customer) {
                return [
                    'uuid' => $customer->uuid,
                    'name' => $customer->name,
                    'document' => $customer->document,
                    'created_at' => $customer->created_at,
                    'updated_at' => $customer->updated_at,
                ];
            });

        return response()->json($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $partner = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'document' => 'required|string|unique:end_customers,document',
        ]);

        $validated['partner_id'] = $partner->id;

        $customer = EndCustomer::create($validated);

        // Retorna com UUID na resposta
        return response()->json([
            'uuid' => $customer->uuid,
            'name' => $customer->name,
            'document' => $customer->document,
            'created_at' => $customer->created_at,
            'updated_at' => $customer->updated_at,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $uuid)
    {
        $partner = $request->user();

        $customer = EndCustomer::where('partner_id', $partner->id)
            ->where('uuid', $uuid)
            ->firstOrFail();

        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $partner = $request->user();

        $customer = EndCustomer::where('partner_id', $partner->id)
            ->where('uuid', $uuid)
            ->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'document' => 'required|string|unique:end_customers,document,' . $customer->id,
        ]);

        $customer->update($validated);

        return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $uuid)
    {
        $partner = $request->user();

        $customer = EndCustomer::where('partner_id', $partner->id)
            ->where('uuid', $uuid)
            ->firstOrFail();

        $customer->delete();

        return response()->json([
            'message' => 'Cliente excluído com sucesso.'
        ], 200);
    }
}
