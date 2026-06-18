<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => 'string',
            'status' => 'string',
        ];
    }

    // ─── Relationships ────────────────────────────────────────────────

    /**
     * Meter readings recorded by this user (as petugas).
     */
    public function pencatatanMeters(): HasMany
    {
        return $this->hasMany(PencatatanMeter::class, 'petugas_id');
    }

    /**
     * Payments processed by this user (as kasir).
     */
    public function pembayarans(): HasMany
    {
        return $this->hasMany(Pembayaran::class, 'kasir_id');
    }

    /**
     * Optional customer record linked to this user.
     */
    public function pelanggan(): HasOne
    {
        return $this->hasOne(Pelanggan::class);
    }

    // ─── Scopes ───────────────────────────────────────────────────────

    /**
     * Scope to filter only active users.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Scope to filter users by role.
     */
    public function scopeByRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    // ─── Helper Methods ───────────────────────────────────────────────

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user is a petugas (field officer).
     */
    public function isPetugas(): bool
    {
        return $this->role === 'petugas';
    }

    /**
     * Check if the user is a kasir (cashier).
     */
    public function isKasir(): bool
    {
        return $this->role === 'kasir';
    }

    /**
     * Check if the user is a pelanggan (customer).
     */
    public function isPelanggan(): bool
    {
        return $this->role === 'pelanggan';
    }
}
