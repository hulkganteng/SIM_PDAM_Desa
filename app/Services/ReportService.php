<?php

namespace App\Services;

use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportService
{
    /**
     * Get billing report for a given period.
     *
     * @param string $periode Period in YYYY-MM format
     * @return Collection Tagihan collection with pelanggan relationship
     */
    public function getBillingReport(string $periode): Collection
    {
        return Tagihan::where('periode', $periode)
            ->with('pelanggan')
            ->get();
    }

    /**
     * Get payment report within a date range.
     *
     * @param string $startDate Start date (Y-m-d)
     * @param string $endDate End date (Y-m-d)
     * @return Collection Pembayaran collection with tagihan.pelanggan relationship
     */
    public function getPaymentReport(string $startDate, string $endDate): Collection
    {
        return Pembayaran::whereBetween('tanggal', [$startDate, $endDate])
            ->with('tagihan.pelanggan')
            ->get();
    }

    /**
     * Get customer report with tariff group relationship.
     *
     * @return Collection All pelanggan with golonganTarif relationship
     */
    public function getCustomerReport(): Collection
    {
        return Pelanggan::with('golonganTarif')->get();
    }

    /**
     * Export data as PDF using a Blade view.
     *
     * @param string $viewName Blade view name for the PDF
     * @param array $data Data to pass to the view
     * @return Response PDF download response
     */
    public function exportPdf(string $viewName, array $data): Response
    {
        $pdf = Pdf::loadView($viewName, $data);

        return $pdf->stream("{$viewName}.pdf");
    }

    /**
     * Export data as Excel using an export class.
     *
     * @param string $exportClass Fully qualified export class name
     * @param mixed ...$args Arguments to pass to the export class constructor
     * @return BinaryFileResponse Excel download response
     */
    public function exportExcel(string $exportClass, ...$args): BinaryFileResponse
    {
        $export = new $exportClass(...$args);

        return Excel::download($export, class_basename($exportClass) . '.xlsx');
    }
}
