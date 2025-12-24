<?php

namespace App\Http\Controllers;

use App\Models\EndCustomer;
use App\Models\Partner;
use Illuminate\Http\Request;

class EndCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $endCustomers = EndCustomer::with('partner')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.end-customers.index', compact('endCustomers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $partners = Partner::where('is_active', true)->get();
        return view('admin.end-customers.create', compact('partners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'partner_id' => 'required|exists:partners,id',
            'name' => 'required|string|max:255',
            'document' => 'required|string|unique:end_customers,document',
        ]);

        $endCustomer = EndCustomer::create($validated);

        return redirect()->route('admin.end-customers.index')
            ->with('success', 'Cliente final criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(EndCustomer $endCustomer)
    {
        $endCustomer->load(['partner', 'valueRecords']);
        return view('admin.end-customers.show', compact('endCustomer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EndCustomer $endCustomer)
    {
        $partners = Partner::where('is_active', true)->get();
        return view('admin.end-customers.edit', compact('endCustomer', 'partners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EndCustomer $endCustomer)
    {
        $validated = $request->validate([
            'partner_id' => 'required|exists:partners,id',
            'name' => 'required|string|max:255',
            'document' => 'required|string|unique:end_customers,document,' . $endCustomer->id,
        ]);

        $endCustomer->update($validated);

        return redirect()->route('admin.end-customers.index')
            ->with('success', 'Cliente final atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EndCustomer $endCustomer)
    {
        $endCustomer->delete();

        return redirect()->route('admin.end-customers.index')
            ->with('success', 'Cliente final excluído com sucesso!');
    }
}
