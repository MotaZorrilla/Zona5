<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Treasury;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TreasuryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $treasuryRecords = Treasury::with(['user', 'lodge'])
            ->orderBy('transaction_date', 'desc')
            ->paginate(10);

        // Calcular resumen financiero
        $totalIncome = Treasury::where('type', 'income')->sum('amount');
        $totalExpense = Treasury::where('type', 'expense')->sum('amount');
        
        $summary = [
            'total_balance' => (float)$totalIncome - (float)$totalExpense,
            'monthly_income' => Treasury::where('type', 'income')
                ->whereMonth('transaction_date', now()->month)
                ->whereYear('transaction_date', now()->year)
                ->sum('amount'),
            'monthly_expense' => Treasury::where('type', 'expense')
                ->whereMonth('transaction_date', now()->month)
                ->whereYear('transaction_date', now()->year)
                ->sum('amount'),
        ];

        return view('admin.treasury.index', compact('treasuryRecords', 'summary'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lodges = \App\Models\Lodge::all();
        $type = request('type', 'income'); // Por defecto, tipo ingreso
        
        return view('admin.treasury.create', compact('lodges', 'type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0.01',
            'category' => 'required|string|max:100',
            'transaction_date' => 'required|date',
            'reference' => 'nullable|string|max:100',
            'status' => 'nullable|in:completed,pending,approved,rejected',
            'lodge_id' => 'nullable|exists:lodges,id',
            'notes' => 'nullable|string',
        ]);

        $treasury = new Treasury();
        $treasury->fill($request->all());
        $treasury->user_id = Auth::id();
        $treasury->save();

        return redirect()->route('admin.treasury.index')
            ->with('success', 'Movimiento registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Treasury $treasury)
    {
        $treasury->load(['user', 'lodge']);
        return view('admin.treasury.show', compact('treasury'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Treasury $treasury)
    {
        $treasury->load('lodge');
        $lodges = \App\Models\Lodge::all();
        
        return view('admin.treasury.edit', compact('treasury', 'lodges'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Treasury $treasury)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0.01',
            'category' => 'required|string|max:100',
            'transaction_date' => 'required|date',
            'reference' => 'nullable|string|max:100',
            'status' => 'nullable|in:completed,pending,approved,rejected',
            'lodge_id' => 'nullable|exists:lodges,id',
            'notes' => 'nullable|string',
        ]);

        $treasury->fill($request->all());
        $treasury->save();

        return redirect()->route('admin.treasury.index')
            ->with('success', 'Movimiento actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Treasury $treasury)
    {
        $treasury->delete();

        return redirect()->route('admin.treasury.index')
            ->with('success', 'Movimiento eliminado exitosamente.');
    }

    /**
     * Get treasury summary data for dashboard
     */
    public function summary()
    {
        $summary = [
            'total_balance' => $this->calculateTotalBalance(),
            'monthly_income' => $this->calculateMonthlyIncome(),
            'monthly_expense' => $this->calculateMonthlyExpense(),
            'recent_transactions' => Treasury::with(['user', 'lodge'])
                ->orderBy('transaction_date', 'desc')
                ->limit(5)
                ->get(),
        ];

        return response()->json($summary);
    }

    /**
     * Calculate total balance
     */
    private function calculateTotalBalance()
    {
        $totalIncome = Treasury::where('type', 'income')->sum('amount');
        $totalExpense = Treasury::where('type', 'expense')->sum('amount');
        return (float)$totalIncome - (float)$totalExpense;
    }

    /**
     * Calculate monthly income
     */
    private function calculateMonthlyIncome()
    {
        return Treasury::where('type', 'income')
            ->whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('amount');
    }

    /**
     * Calculate monthly expense
     */
    private function calculateMonthlyExpense()
    {
        return Treasury::where('type', 'expense')
            ->whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('amount');
    }
}
