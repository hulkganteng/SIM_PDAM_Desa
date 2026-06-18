<?php

namespace App\Http\Controllers;

use App\Exports\PelangganExport;
use App\Exports\PembayaranExport;
use App\Exports\TagihanExport;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class LaporanController extends Controller
{
    public function __construct(
        protected ReportService $reportService
    ) {}

    /**
     * Report selection page.
     */
    public function index(): View
    {
        return view('laporan.index');
    }

    /**
     * Get billing report for given period.
     */
    public function tagihan(Request $request): View
    {
        $request->validate([
            'periode' => 'nullable|regex:/^\d{4}-\d{2}$/',
        ]);

        $periode = $request->input('periode', now()->format('Y-m'));
        $tagihan = $this->reportService->getBillingReport($periode);

        return view('laporan.tagihan', compact('tagihan', 'periode'));
    }

    /**
     * Get payment report for date range.
     */
    public function pembayaran(Request $request): View
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());
        $pembayaran = $this->reportService->getPaymentReport($startDate, $endDate);

        return view('laporan.pembayaran', compact('pembayaran', 'startDate', 'endDate'));
    }

    /**
     * Get customer report.
     */
    public function pelanggan(Request $request): View
    {
        $pelanggan = $this->reportService->getCustomerReport();

        return view('laporan.pelanggan', compact('pelanggan'));
    }

    /**
     * Export report as PDF or Excel.
     */
    public function export(string $type, string $format, Request $request): Response
    {
        $periode = $request->input('periode', now()->format('Y-m'));
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        $data = match ($type) {
            'tagihan' => [
                'data' => $this->reportService->getBillingReport($periode),
                'periode' => $periode,
            ],
            'pembayaran' => [
                'data' => $this->reportService->getPaymentReport($startDate, $endDate),
                'startDate' => $startDate,
                'endDate' => $endDate,
            ],
            'pelanggan' => [
                'data' => $this->reportService->getCustomerReport(),
            ],
            default => abort(404),
        };

        return match ($format) {
            'pdf' => $this->reportService->exportPdf("exports.{$type}-pdf", $data),
            'excel' => $this->exportExcel($type, $periode, $startDate, $endDate),
            default => abort(404),
        };
    }

    /**
     * Build and return the Excel export response based on report type.
     */
    private function exportExcel(string $type, string $periode, string $startDate, string $endDate): BinaryFileResponse
    {
        $exportClass = match ($type) {
            'tagihan' => new TagihanExport($periode),
            'pembayaran' => new PembayaranExport($startDate, $endDate),
            'pelanggan' => new PelangganExport,
            default => abort(404),
        };

        return Excel::download($exportClass, "{$type}-export.xlsx");
    }
}
