<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::withCount(['endCustomers', 'valueRecords'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:partners,email',
            'document' => 'required|string|unique:partners,document',
            'is_active' => 'boolean',
        ]);

        // Gerar token de API único
        $validated['api_token'] = Str::random(60);

        $partner = Partner::create($validated);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Parceiro criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        $partner->load(['endCustomers', 'valueRecords']);
        return view('admin.partners.show', compact('partner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:partners,email,' . $partner->id,
            'document' => 'required|string|unique:partners,document,' . $partner->id,
            'is_active' => 'boolean',
        ]);

        $partner->update($validated);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Parceiro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Parceiro excluído com sucesso!');
    }

    /**
     * Regenerate API token for the partner.
     */
    public function regenerateToken(Partner $partner)
    {
        $partner->update([
            'api_token' => Str::random(60)
        ]);

        return back()->with('success', 'Token de API regenerado com sucesso!');
    }
}
