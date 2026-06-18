<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGolonganTarifRequest;
use App\Http\Requests\UpdateGolonganTarifRequest;
use App\Models\GolonganTarif;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GolonganTarifController extends Controller
{
    /**
     * Display a listing of all tariff groups.
     */
    public function index(): View
    {
        $golongan = GolonganTarif::all();

        return view('golongan-tarif.index', compact('golongan'));
    }

    /**
     * Show the form for creating a new tariff group.
     */
    public function create(): View
    {
        return view('golongan-tarif.create');
    }

    /**
     * Store a newly created tariff group.
     */
    public function store(StoreGolonganTarifRequest $request): RedirectResponse
    {
        GolonganTarif::create($request->validated());

        return redirect()->route('golongan-tarif.index')
            ->with('success', 'Golongan tarif berhasil ditambahkan.');
    }

    /**
     * Display the specified tariff group (redirects to edit).
     */
    public function show(GolonganTarif $golongan_tarif): RedirectResponse
    {
        return redirect()->route('golongan-tarif.edit', $golongan_tarif);
    }

    /**
     * Show the form for editing the specified tariff group.
     */
    public function edit(GolonganTarif $golongan_tarif): View
    {
        $golonganTarif = $golongan_tarif;

        return view('golongan-tarif.edit', compact('golonganTarif'));
    }

    /**
     * Update the specified tariff group.
     */
    public function update(UpdateGolonganTarifRequest $request, GolonganTarif $golongan_tarif): RedirectResponse
    {
        $golongan_tarif->update($request->validated());

        return redirect()->route('golongan-tarif.index')
            ->with('success', 'Golongan tarif berhasil diperbarui.');
    }

    /**
     * Remove the specified tariff group (prevent if customers linked).
     */
    public function destroy(GolonganTarif $golongan_tarif): RedirectResponse
    {
        if ($golongan_tarif->pelanggans()->exists()) {
            return back()->with('error', 'Golongan tarif tidak dapat dihapus karena masih memiliki pelanggan.');
        }

        $golongan_tarif->delete();

        return redirect()->route('golongan-tarif.index')
            ->with('success', 'Golongan tarif berhasil dihapus.');
    }
}
