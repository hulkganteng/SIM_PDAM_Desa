<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tagihan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tagihan';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'pelanggan_id',
        'pencatatan_meter_id',
        'periode',
        'pemakaian',
        'tarif_per_m3',
        'biaya_beban',
        'denda',
        'total',
        'status',
        'jatuh_tempo',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tarif_per_m3' => 'decimal:2',
            'biaya_beban' => 'decimal:2',
            'denda' => 'decimal:2',
            'total' => 'decimal:2',
            'jatuh_tempo' => 'date',
        ];
    }

    // ─── Relationships ────────────────────────────────────────────────

    /**
     * The customer this bill belongs to.
     */
    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }

    /**
     * The meter reading that generated this bill.
     */
    public function pencatatanMeter(): BelongsTo
    {
        return $this->belongsTo(PencatatanMeter::class);
    }

    /**
     * The payment for this bill.
     */
    public function pembayaran(): HasOne
    {
        return $this->hasOne(Pembayaran::class);
    }

    // ─── Scopes ───────────────────────────────────────────────────────

    /**
     * Scope to filter unpaid bills.
     */
    public function scopeBelumBayar($query)
    {
        return $query->where('status', 'belum_bayar');
    }

    /**
     * Scope to filter overdue bills (past due date and unpaid).
     */
    public function scopeOverdue($query)
    {
        return $query->where('status', 'belum_bayar')
                     ->where('jatuh_tempo', '<', now());
    }

    /**
     * Scope to filter bills by period.
     */
    public function scopeByPeriode($query, string $periode)
    {
        return $query->where('periode', $periode);
    }
}
