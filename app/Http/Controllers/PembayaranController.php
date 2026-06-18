<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidPaymentException;
use App\Http\Requests\StorePembayaranRequest;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Services\PaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PembayaranController extends Controller
{
    public function __construct(
        protected PaymentService $paymentService
    ) {}

    /**
     * Display a listing of payments with date range filter.
     */
    public function index(Request $request): View
    {
        $query = Pembayaran::with(['tagihan.pelanggan', 'kasir']);

        if ($startDate = $request->input('start_date')) {
            $query->whereDate('tanggal', '>=', $startDate);
        }

        if ($endDate = $request->input('end_date')) {
            $query->whereDate('tanggal', '<=', $endDate);
        }

        $pembayaran = $query->latest('tanggal')->paginate(15)->withQueryString();

        return view('pembayaran.index', compact('pembayaran'));
    }

    /**
     * Show the payment form with bill search.
     */
    public function create(Request $request): View
    {
        $tagihanList = collect();

        if ($search = $request->input('search')) {
            $tagihanList = $this->paymentService->searchTagihan($search);
        }

        return view('pembayaran.create', compact('tagihanList'));
    }

    /**
     * Store a newly created payment.
     */
    public function store(StorePembayaranRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $tagihan = Tagihan::findOrFail($data['tagihan_id']);

            $pembayaran = $this->paymentService->processPayment(
                $tagihan,
                $data['metode'],
                auth()->id()
            );

            return redirect()->route('pembayaran.show', $pembayaran)
                ->with('success', 'Pembayaran berhasil diproses.');
        } catch (InvalidPaymentException $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified payment detail.
     */
    public function show(Pembayaran $pembayaran): View
    {
        $pembayaran->load(['tagihan.pelanggan', 'kasir']);

        return view('pembayaran.show', compact('pembayaran'));
    }

    /**
     * Display a print-friendly receipt view.
     */
    public function receipt(Pembayaran $pembayaran): View
    {
        $pembayaran->load(['tagihan.pelanggan', 'kasir']);

        return view('pembayaran.receipt', compact('pembayaran'));
    }
}
