<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use App\Models\GolonganTarif;
use App\Models\Pelanggan;
use App\Models\User;
use App\Services\PelangganService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PelangganController extends Controller
{
    public function __construct(
        protected PelangganService $pelangganService
    ) {}

    /**
     * Display a listing of customers with search and status filter.
     */
    public function index(Request $request): View
    {
        $query = Pelanggan::with('golonganTarif');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('no_sambungan', 'LIKE', "%{$search}%")
                    ->orWhere('nama', 'LIKE', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->byStatus($status);
        }

        $pelanggan = $query->latest()->paginate(15)->withQueryString();
        $golongan = GolonganTarif::all();
        $users = User::with('pelanggan')->where('role', 'pelanggan')->active()->get();

        return view('pelanggan.index', compact('pelanggan', 'golongan', 'users'));
    }

    /**
     * Show the form for creating a new customer.
     */
    public function create(): View
    {
        $golongan = GolonganTarif::all();
        $users = User::where('role', 'pelanggan')->active()->get();

        return view('pelanggan.create', compact('golongan', 'users'));
    }

    /**
     * Store a newly created customer.
     */
    public function store(StorePelangganRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['no_sambungan'] = $this->pelangganService->generateNoSambungan();

        Pelanggan::create($data);

        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    /**
     * Display customer detail with billing and meter history.
     */
    public function show(Pelanggan $pelanggan): View
    {
        $pelanggan->load(['golonganTarif', 'tagihans', 'pencatatanMeters']);

        return view('pelanggan.show', compact('pelanggan'));
    }

    /**
     * Show the form for editing the specified customer.
     */
    public function edit(Pelanggan $pelanggan): View
    {
        $golongan = GolonganTarif::all();
        $users = User::where('role', 'pelanggan')
            ->where(function ($query) use ($pelanggan) {
                $query->whereDoesntHave('pelanggan')
                    ->orWhere('id', $pelanggan->user_id);
            })
            ->active()
            ->get();

        return view('pelanggan.edit', compact('pelanggan', 'golongan', 'users'));
    }

    /**
     * Update the specified customer.
     */
    public function update(UpdatePelangganRequest $request, Pelanggan $pelanggan): RedirectResponse
    {
        $pelanggan->update($request->validated());

        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil diperbarui.');
    }

    /**
     * Disconnect/deactivate the specified customer.
     */
    public function destroy(Pelanggan $pelanggan): RedirectResponse
    {
        if (! $this->pelangganService->canDisconnect($pelanggan)) {
            return back()->with('error', 'Pelanggan tidak dapat diputus karena masih memiliki tagihan belum bayar.');
        }

        $pelanggan->update(['status' => 'diputus']);

        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil diputus.');
    }
}
