<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengaduan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengaduan';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'pelanggan_id',
        'kategori',
        'deskripsi',
        'status',
        'tanggal',
        'catatan_admin',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal' => 'datetime',
        ];
    }

    // ─── Relationships ────────────────────────────────────────────────

    /**
     * The customer who submitted this complaint.
     */
    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }

    // ─── Scopes ───────────────────────────────────────────────────────

    /**
     * Scope to filter open complaints (baru or diproses).
     */
    public function scopeOpen($query)
    {
        return $query->whereIn('status', ['baru', 'diproses']);
    }

    /**
     * Scope to filter complaints by status.
     */
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }
}
