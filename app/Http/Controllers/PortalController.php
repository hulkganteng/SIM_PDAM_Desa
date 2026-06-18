<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengaduanRequest;
use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PortalController extends Controller
{
    /**
     * Get the authenticated user's pelanggan record.
     */
    private function getPelanggan(): Pelanggan
    {
        $pelanggan = auth()->user()->pelanggan;

        if (! $pelanggan) {
            abort(403, 'Akun tidak terhubung dengan data pelanggan.');
        }

        return $pelanggan;
    }

    /**
     * Verify that a tagihan belongs to the authenticated user's pelanggan.
     */
    private function verifyOwnership(Tagihan $tagihan, Pelanggan $pelanggan): void
    {
        if ($tagihan->pelanggan_id !== $pelanggan->id) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }
    }

    /**
     * Display customer's own bills.
     */
    public function tagihan(): View
    {
        $pelanggan = $this->getPelanggan();
        $tagihan = $pelanggan->tagihans()->latest()->paginate(15);

        return view('portal.tagihan', compact('tagihan', 'pelanggan'));
    }

    /**
     * Display bill detail (verify ownership).
     */
    public function showTagihan(Tagihan $tagihan): View
    {
        $pelanggan = $this->getPelanggan();
        $this->verifyOwnership($tagihan, $pelanggan);

        $tagihan->load(['pencatatanMeter', 'pembayaran']);

        return view('portal.show-tagihan', compact('tagihan', 'pelanggan'));
    }

    /**
     * Display customer's payment history.
     */
    public function pembayaran(): View
    {
        $pelanggan = $this->getPelanggan();
        $pembayaran = Pembayaran::whereHas('tagihan', function ($query) use ($pelanggan) {
            $query->where('pelanggan_id', $pelanggan->id);
        })
            ->with('tagihan')
            ->latest('tanggal')
            ->paginate(15);

        return view('portal.pembayaran', compact('pembayaran', 'pelanggan'));
    }

    /**
     * Display customer's complaints.
     */
    public function pengaduan(): View
    {
        $pelanggan = $this->getPelanggan();
        $pengaduan = $pelanggan->pengaduans()->latest('tanggal')->paginate(15);

        return view('portal.pengaduan', compact('pengaduan', 'pelanggan'));
    }

    /**
     * Store a new complaint for the customer.
     */
    public function storePengaduan(StorePengaduanRequest $request): RedirectResponse
    {
        $pelanggan = $this->getPelanggan();

        $pelanggan->pengaduans()->create([
            ...$request->validated(),
            'status' => 'baru',
            'tanggal' => now(),
        ]);

        return redirect()->route('portal.pengaduan')
            ->with('success', 'Pengaduan berhasil dikirim.');
    }

    /**
     * Display customer profile.
     */
    public function profil(): View
    {
        $pelanggan = $this->getPelanggan();
        $pelanggan->load('golonganTarif');

        return view('portal.profil', compact('pelanggan'));
    }
}
