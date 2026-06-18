<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidMeterReadingException;
use App\Http\Requests\StoreMeterRequest;
use App\Http\Requests\UpdateMeterRequest;
use App\Models\Pelanggan;
use App\Models\PencatatanMeter;
use App\Services\MeterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PencatatanMeterController extends Controller
{
    public function __construct(
        protected MeterService $meterService
    ) {}

    /**
     * Display a listing of meter readings with period filter.
     */
    public function index(Request $request): View
    {
        $query = PencatatanMeter::with(['pelanggan', 'petugas']);

        if ($periode = $request->input('periode')) {
            $query->byPeriode($periode);
        }

        $meters = $query->latest()->paginate(15)->withQueryString();

        return view('meter.index', compact('meters'));
    }

    /**
     * Show the form for creating a new meter reading.
     */
    public function create(Request $request): View
    {
        $pelanggan = Pelanggan::active()->get();
        $meterAwal = null;

        if ($pelangganId = $request->input('pelanggan_id')) {
            $periode = $request->input('periode', now()->format('Y-m'));
            $meterAwal = $this->meterService->getPreviousMeterAkhir((int) $pelangganId, $periode);
        }

        return view('meter.create', compact('pelanggan', 'meterAwal'));
    }

    /**
     * Store a newly created meter reading.
     */
    public function store(StoreMeterRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $data['pemakaian'] = $this->meterService->calculatePemakaian(
                (int) $data['meter_awal'],
                (int) $data['meter_akhir']
            );
            $data['petugas_id'] = auth()->id();

            if ($request->hasFile('foto')) {
                $data['foto'] = $this->meterService->storePhoto(
                    $request->file('foto'),
                    (int) $data['pelanggan_id'],
                    $data['periode']
                );
            }

            PencatatanMeter::create($data);

            return redirect()->route('meter.index')
                ->with('success', 'Pencatatan meter berhasil disimpan.');
        } catch (InvalidMeterReadingException $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified meter reading.
     */
    public function show(PencatatanMeter $meter): View
    {
        $meter->load(['pelanggan', 'petugas']);

        return view('meter.show', compact('meter'));
    }

    /**
     * Show the form for editing the specified meter reading.
     */
    public function edit(PencatatanMeter $meter): View
    {
        $pelanggan = Pelanggan::active()->get();

        return view('meter.edit', compact('meter', 'pelanggan'));
    }

    /**
     * Update the specified meter reading.
     */
    public function update(UpdateMeterRequest $request, PencatatanMeter $meter): RedirectResponse
    {
        try {
            $data = $request->validated();
            $data['pemakaian'] = $this->meterService->calculatePemakaian(
                (int) $data['meter_awal'],
                (int) $data['meter_akhir']
            );

            if ($request->hasFile('foto')) {
                $data['foto'] = $this->meterService->storePhoto(
                    $request->file('foto'),
                    (int) $meter->pelanggan_id,
                    $data['periode'] ?? $meter->periode
                );
            }

            $meter->update($data);

            return redirect()->route('meter.index')
                ->with('success', 'Pencatatan meter berhasil diperbarui.');
        } catch (InvalidMeterReadingException $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified meter reading.
     */
    public function destroy(PencatatanMeter $meter): RedirectResponse
    {
        $meter->delete();

        return redirect()->route('meter.index')
            ->with('success', 'Pencatatan meter berhasil dihapus.');
    }
}
