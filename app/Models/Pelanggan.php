<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pelanggan';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'no_sambungan',
        'nama',
        'alamat',
        'no_hp',
        'golongan_id',
        'status',
        'user_id',
    ];

    // ─── Relationships ────────────────────────────────────────────────

    /**
     * The tariff group this customer belongs to.
     */
    public function golonganTarif(): BelongsTo
    {
        return $this->belongsTo(GolonganTarif::class, 'golongan_id');
    }

    /**
     * The user account linked to this customer (for portal access).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Meter readings for this customer.
     */
    public function pencatatanMeters(): HasMany
    {
        return $this->hasMany(PencatatanMeter::class);
    }

    /**
     * Bills for this customer.
     */
    public function tagihans(): HasMany
    {
        return $this->hasMany(Tagihan::class);
    }

    /**
     * Complaints submitted by this customer.
     */
    public function pengaduans(): HasMany
    {
        return $this->hasMany(Pengaduan::class);
    }

    // ─── Scopes ───────────────────────────────────────────────────────

    /**
     * Scope to filter only active customers.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Scope to filter customers by status.
     */
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }
}
