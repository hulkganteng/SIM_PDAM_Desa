<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PencatatanMeter extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pencatatan_meter';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'pelanggan_id',
        'periode',
        'meter_awal',
        'meter_akhir',
        'pemakaian',
        'petugas_id',
        'foto',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'meter_awal' => 'integer',
            'meter_akhir' => 'integer',
            'pemakaian' => 'integer',
        ];
    }

    // ─── Relationships ────────────────────────────────────────────────

    /**
     * The customer this reading belongs to.
     */
    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }

    /**
     * The officer who recorded this reading.
     */
    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    /**
     * The bill generated from this reading.
     */
    public function tagihan(): HasOne
    {
        return $this->hasOne(Tagihan::class, 'pencatatan_meter_id');
    }

    // ─── Scopes ───────────────────────────────────────────────────────

    /**
     * Scope to filter readings by period.
     */
    public function scopeByPeriode($query, string $periode)
    {
        return $query->where('periode', $periode);
    }
}
