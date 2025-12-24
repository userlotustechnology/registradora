<?php

namespace App\Http\Controllers;

use App\Models\ValueRecord;
use App\Models\Partner;
use App\Models\EndCustomer;
use Illuminate\Http\Request;

class ValueRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ValueRecord::with(['partner', 'endCustomer']);

        // Filtros
        if ($request->filled('partner_id')) {
            $query->where('partner_id', $request->partner_id);
        }
        
        if ($request->filled('transaction_type')) {
            $query->where('transaction_type', $request->transaction_type);
        }

        $valueRecords = $query->orderBy('created_at', 'desc')->paginate(15);
        $partners = Partner::where('is_active', true)->get();
            
        return view('admin.value-records.index', compact('valueRecords', 'partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $partners = Partner::where('is_active', true)->get();
        $endCustomers = EndCustomer::with('partner')->get();
        
        return view('admin.value-records.create', compact('partners', 'endCustomers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'partner_id' => 'required|exists:partners,id',
            'end_customer_id' => 'required|exists:end_customers,id',
            'total_amount' => 'required|numeric|min:0',
            'transaction_type' => 'required|in:credit,debit',
            'installments' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        // Calcular valor da parcela
        $validated['installment_amount'] = $validated['total_amount'] / $validated['installments'];

        $valueRecord = ValueRecord::create($validated);

        return redirect()->route('admin.value-records.index')
            ->with('success', 'Registro de valor criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ValueRecord $valueRecord)
    {
        $valueRecord->load(['partner', 'endCustomer']);
        return view('admin.value-records.show', compact('valueRecord'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ValueRecord $valueRecord)
    {
        $partners = Partner::where('is_active', true)->get();
        $endCustomers = EndCustomer::with('partner')->get();
        
        return view('admin.value-records.edit', compact('valueRecord', 'partners', 'endCustomers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ValueRecord $valueRecord)
    {
        $validated = $request->validate([
            'partner_id' => 'required|exists:partners,id',
            'end_customer_id' => 'required|exists:end_customers,id',
            'total_amount' => 'required|numeric|min:0',
            'transaction_type' => 'required|in:credit,debit',
            'installments' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        // Calcular valor da parcela
        $validated['installment_amount'] = $validated['total_amount'] / $validated['installments'];

        $valueRecord->update($validated);

        return redirect()->route('admin.value-records.index')
            ->with('success', 'Registro de valor atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ValueRecord $valueRecord)
    {
        $valueRecord->delete();

        return redirect()->route('admin.value-records.index')
            ->with('success', 'Registro de valor excluído com sucesso!');
    }
}
