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
                    'available_balance' => $customer->available_balance,
                    'credit_balance' => $customer->credit_balance,
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
            'available_balance' => $customer->available_balance,
            'credit_balance' => $customer->credit_balance,
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

    /**
     * Get customer balance (credits - debits).
     */
    public function balance(Request $request, $uuid)
    {
        $partner = $request->user();

        $customer = EndCustomer::where('partner_id', $partner->id)
            ->where('uuid', $uuid)
            ->firstOrFail();

        // Calcular total de créditos e débitos para estatísticas
        $totalCredits = $customer->valueRecords()
            ->where('transaction_type', 'credit')
            ->sum('total_amount');

        $totalDebits = $customer->valueRecords()
            ->where('transaction_type', 'debit')
            ->sum('total_amount');

        // Calcular totais por tipo de pagamento
        $pixBoletoCredits = $customer->valueRecords()
            ->where('transaction_type', 'credit')
            ->whereIn('payment_type', ['pix', 'boleto'])
            ->sum('total_amount');

        $creditCardCredits = $customer->valueRecords()
            ->where('transaction_type', 'credit')
            ->where('payment_type', 'cartao_credito')
            ->sum('total_amount');

        return response()->json([
            'customer' => [
                'uuid' => $customer->uuid,
                'name' => $customer->name,
                'document' => $customer->document,
            ],
            'balances' => [
                'available_balance' => number_format($customer->available_balance, 2, '.', ''),
                'credit_balance' => number_format($customer->credit_balance, 2, '.', ''),
                'total_balance' => number_format($customer->available_balance + $customer->credit_balance, 2, '.', ''),
            ],
            'breakdown' => [
                'pix_boleto_credits' => number_format($pixBoletoCredits, 2, '.', ''),
                'credit_card_credits' => number_format($creditCardCredits, 2, '.', ''),
                'total_credits' => number_format($totalCredits, 2, '.', ''),
                'total_debits' => number_format($totalDebits, 2, '.', ''),
            ],
            'transactions_count' => $customer->valueRecords()->count(),
        ]);
    }
