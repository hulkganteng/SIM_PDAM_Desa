<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateTagihanRequest;
use App\Models\Tagihan;
use App\Services\BillingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TagihanController extends Controller
{
    public function __construct(
        protected BillingService $billingService
    ) {}

    /**
     * Display a listing of bills with search/filter.
     */
    public function index(Request $request): View
    {
        $query = Tagihan::with('pelanggan');

        if ($search = $request->input('search')) {
            $query->whereHas('pelanggan', function ($q) use ($search) {
                $q->where('no_sambungan', 'LIKE', "%{$search}%")
                  ->orWhere('nama', 'LIKE', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($periode = $request->input('periode')) {
            $query->byPeriode($periode);
        }

        $tagihan = $query->latest()->paginate(15)->withQueryString();

        return view('tagihan.index', compact('tagihan'));
    }

    /**
     * Display the specified bill detail.
     */
    public function show(Tagihan $tagihan): View
    {
        $tagihan->load(['pelanggan', 'pencatatanMeter', 'pembayaran']);

        return view('tagihan.show', compact('tagihan'));
    }

    /**
     * Show the generate tagihan form.
     */
    public function showGenerate(): View
    {
        return view('tagihan.generate');
    }

    /**
     * Generate bills for a given period.
     */
    public function generate(GenerateTagihanRequest $request): RedirectResponse
    {
        $results = $this->billingService->generateForPeriod($request->validated()['periode']);

        return redirect()->route('tagihan.generate.form')
            ->with('success', "Tagihan berhasil digenerate: {$results['created']} dibuat, {$results['skipped']} dilewati.")
            ->with('generated', $results);
    }

    /**
     * Apply penalties to overdue bills.
     */
    public function applyDenda(): RedirectResponse
    {
        $count = $this->billingService->applyPenalties();

        return redirect()->route('tagihan.index')
            ->with('success', "Denda berhasil diterapkan ke {$count} tagihan.");
    }
}
