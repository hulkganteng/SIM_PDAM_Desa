<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GolonganTarif extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'golongan_tarif';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'tarif_per_m3',
        'biaya_beban',
        'denda',
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
        ];
    }

    // ─── Relationships ────────────────────────────────────────────────

    /**
     * Customers belonging to this tariff group.
     */
    public function pelanggans(): HasMany
    {
        return $this->hasMany(Pelanggan::class, 'golongan_id');
    }
}
