<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Mostrar formulário de login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Processar login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O email deve ter um formato válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            return redirect()->intended('/dashboard');
        }

        return redirect()->back()
            ->withErrors(['email' => 'As credenciais fornecidas não conferem com nossos registros.'])
            ->withInput($request->except('password'));
    }

    /**
     * Mostrar formulário de registro
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Processar registro
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O email deve ter um formato válido.',
            'email.unique' => 'Este email já está sendo usado.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'password.confirmed' => 'A confirmação da senha não confere.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'is_active' => true,
        ]);

        Auth::login($user);

        return redirect('/dashboard')->with('success', 'Conta criada com sucesso!');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Você foi desconectado com sucesso.');
    }

    /**
     * Dashboard
     */
    public function dashboard()
    {
        // Busca dados reais do sistema
        $totalPartners = \App\Models\Partner::count();
        $totalCustomers = \App\Models\EndCustomer::count();
        $totalTransactions = \App\Models\ValueRecord::count();
        
        // Novos clientes no mês atual
        $newCustomersMonth = \App\Models\EndCustomer::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        // Total de saldos
        $totalAvailableBalance = \App\Models\EndCustomer::sum('available_balance');
        $totalCreditBalance = \App\Models\EndCustomer::sum('credit_balance');
        $totalBalance = $totalAvailableBalance + $totalCreditBalance;
        
        // Transações do mês
        $transactionsMonth = \App\Models\ValueRecord::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        // Total de créditos e débitos do mês
        $creditsMonth = \App\Models\ValueRecord::where('transaction_type', 'credit')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_amount');
            
        $debitsMonth = \App\Models\ValueRecord::where('transaction_type', 'debit')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_amount');
        
        // Liberações pendentes de cartão de crédito
        $pendingReleases = \App\Models\CreditCardRelease::where('processed', false)
            ->count();
            
        $pendingReleasesAmount = \App\Models\CreditCardRelease::where('processed', false)
            ->sum('amount');
        
        // Transações recentes
        $recentTransactions = \App\Models\ValueRecord::with(['endCustomer', 'partner'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        // Top clientes por saldo total
        $topCustomers = \App\Models\EndCustomer::selectRaw('*, (available_balance + credit_balance) as total_balance')
            ->orderByDesc('total_balance')
            ->limit(5)
            ->get();
        
        // Créditos por tipo de pagamento no mês
        $creditsByPaymentType = \App\Models\ValueRecord::where('transaction_type', 'credit')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->selectRaw('payment_type, SUM(total_amount) as total')
            ->groupBy('payment_type')
            ->get()
            ->pluck('total', 'payment_type')
            ->toArray();
        
        $stats = [
            'total_partners' => $totalPartners,
            'total_customers' => $totalCustomers,
            'total_transactions' => $totalTransactions,
            'new_customers_month' => $newCustomersMonth,
            'total_available_balance' => $totalAvailableBalance,
            'total_credit_balance' => $totalCreditBalance,
            'total_balance' => $totalBalance,
            'transactions_month' => $transactionsMonth,
            'credits_month' => $creditsMonth,
            'debits_month' => $debitsMonth,
            'pending_releases' => $pendingReleases,
            'pending_releases_amount' => $pendingReleasesAmount,
            'credits_by_payment_type' => $creditsByPaymentType,
        ];

        return view('dashboard', compact('stats', 'recentTransactions', 'topCustomers'));
    }
}