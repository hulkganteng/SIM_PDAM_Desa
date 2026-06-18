<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidStatusTransitionException;
use App\Http\Requests\UpdatePengaduanRequest;
use App\Models\Pengaduan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PengaduanController extends Controller
{
    /**
     * Valid status transitions for complaint workflow.
     */
    private const STATUS_TRANSITIONS = [
        'baru' => ['diproses'],
        'diproses' => ['selesai'],
        'selesai' => [],
    ];

    /**
     * Display a listing of complaints with status filter.
     */
    public function index(Request $request): View
    {
        $query = Pengaduan::with('pelanggan');

        if ($status = $request->input('status')) {
            $query->byStatus($status);
        }

        $pengaduan = $query->latest('tanggal')->paginate(15)->withQueryString();

        return view('pengaduan.index', compact('pengaduan'));
    }

    /**
     * Display the specified complaint detail.
     */
    public function show(Pengaduan $pengaduan): View
    {
        $pengaduan->load('pelanggan');

        return view('pengaduan.show', compact('pengaduan'));
    }

    /**
     * Update the complaint status with workflow enforcement.
     */
    public function update(UpdatePengaduanRequest $request, Pengaduan $pengaduan): RedirectResponse
    {
        try {
            $data = $request->validated();
            $newStatus = $data['status'];

            if (!$this->isValidTransition($pengaduan->status, $newStatus)) {
                throw new InvalidStatusTransitionException(
                    "Transisi status dari '{$pengaduan->status}' ke '{$newStatus}' tidak diizinkan."
                );
            }

            $pengaduan->update($data);

            return redirect()->route('pengaduan.show', $pengaduan)
                ->with('success', 'Status pengaduan berhasil diperbarui.');
        } catch (InvalidStatusTransitionException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Check if a status transition is valid.
     */
    private function isValidTransition(string $currentStatus, string $newStatus): bool
    {
        $allowed = self::STATUS_TRANSITIONS[$currentStatus] ?? [];

        return in_array($newStatus, $allowed);
    }
}
