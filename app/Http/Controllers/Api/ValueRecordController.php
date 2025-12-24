<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ValueRecord;
use App\Models\EndCustomer;
use Illuminate\Http\Request;

class ValueRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $partner = $request->user();
        
        $records = ValueRecord::with('endCustomer')
            ->where('partner_id', $partner->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function($record) {
                return [
                    'uuid' => $record->uuid,
                    'customer' => [
                        'uuid' => $record->endCustomer->uuid,
                        'name' => $record->endCustomer->name,
                        'document' => $record->endCustomer->document,
                    ],
                    'total_amount' => $record->total_amount,
                    'transaction_type' => $record->transaction_type,
                    'installments' => $record->installments,
                    'installment_amount' => $record->installment_amount,
                    'description' => $record->description,
                    'created_at' => $record->created_at,
                    'updated_at' => $record->updated_at,
                ];
            });

        return response()->json($records);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $partner = $request->user();

        $validated = $request->validate([
            'end_customer_uuid' => 'required|string',
            'total_amount' => 'required|numeric|min:0',
            'transaction_type' => 'required|in:credit,debit',
            'installments' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        // Busca o cliente pelo UUID
        $customer = EndCustomer::where('uuid', $validated['end_customer_uuid'])
            ->where('partner_id', $partner->id)
            ->firstOrFail();

        $validated['partner_id'] = $partner->id;
        $validated['end_customer_id'] = $customer->id;
        $validated['installment_amount'] = $validated['total_amount'] / $validated['installments'];
        
        unset($validated['end_customer_uuid']);

        $record = ValueRecord::create($validated);
        $record->load('endCustomer');

        return response()->json([
            'uuid' => $record->uuid,
            'customer' => [
                'uuid' => $record->endCustomer->uuid,
                'name' => $record->endCustomer->name,
            ],
            'total_amount' => $record->total_amount,
            'transaction_type' => $record->transaction_type,
            'installments' => $record->installments,
            'installment_amount' => $record->installment_amount,
            'description' => $record->description,
            'created_at' => $record->created_at,
            'updated_at' => $record->updated_at,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $uuid)
    {
        $partner = $request->user();

        $record = ValueRecord::with('endCustomer')
            ->where('partner_id', $partner->id)
            ->where('uuid', $uuid)
            ->firstOrFail();

        return response()->json([
            'uuid' => $record->uuid,
            'customer' => [
                'uuid' => $record->endCustomer->uuid,
                'name' => $record->endCustomer->name,
                'document' => $record->endCustomer->document,
            ],
            'total_amount' => $record->total_amount,
            'transaction_type' => $record->transaction_type,
            'installments' => $record->installments,
            'installment_amount' => $record->installment_amount,
            'description' => $record->description,
            'created_at' => $record->created_at,
            'updated_at' => $record->updated_at,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $partner = $request->user();

        $record = ValueRecord::where('partner_id', $partner->id)
            ->where('uuid', $uuid)
            ->firstOrFail();

        $validated = $request->validate([
            'end_customer_uuid' => 'required|string',
            'total_amount' => 'required|numeric|min:0',
            'transaction_type' => 'required|in:credit,debit',
            'installments' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        // Busca o cliente pelo UUID
        $customer = EndCustomer::where('uuid', $validated['end_customer_uuid'])
            ->where('partner_id', $partner->id)
            ->firstOrFail();

        $validated['end_customer_id'] = $customer->id;
        $validated['installment_amount'] = $validated['total_amount'] / $validated['installments'];
        
        unset($validated['end_customer_uuid']);

        $record->update($validated);
        $record->load('endCustomer');

        return response()->json([
            'uuid' => $record->uuid,
            'customer' => [
                'uuid' => $record->endCustomer->uuid,
                'name' => $record->endCustomer->name,
            ],
            'total_amount' => $record->total_amount,
            'transaction_type' => $record->transaction_type,
            'installments' => $record->installments,
            'installment_amount' => $record->installment_amount,
            'description' => $record->description,
            'created_at' => $record->created_at,
            'updated_at' => $record->updated_at,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $uuid)
    {
        $partner = $request->user();

        $record = ValueRecord::where('partner_id', $partner->id)
            ->where('uuid', $uuid)
            ->firstOrFail();

        $record->delete();

        return response()->json([
            'message' => 'Registro excluído com sucesso.'
        ], 200);
    }
}

