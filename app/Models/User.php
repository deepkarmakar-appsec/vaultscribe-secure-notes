<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = "users";

    protected $fillable = [
        'name',
        'email',
        'password',
        'otp',
        'otp_expires_at',
        'email_verified_at',
        'is_verified',
        'google2fa_secret',
        'google2fa_enabled',
        'profile_photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'google2fa_secret',     // ← added: decrypt hone ke baad bhi API/JSON mein hide rahega
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'otp_expires_at'    => 'datetime',
            'password'          => 'hashed',
            'google2fa_enabled' => 'boolean',
            'is_verified'       => 'boolean', // ← added: consistent type
        ];
    }

    // Safe encryption for 2FA secret
    protected function google2faSecret(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $value ? decrypt($value) : null,
            set: fn ($value) => $value ? encrypt($value) : null,
        );
    }

    // ─── RELATIONSHIPS ────────────────────────────────────────────
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function activityLogs()               // ← added: logs page ke liye
    {
        return $this->hasMany(ActivityLog::class);
    }

    // ─── HELPERS ─────────────────────────────────────────────────
    public function isAdmin(): bool              // ← added: blade mein $user->isAdmin()
    {
        return (bool) $this->is_admin;
    }

    public function hasTwoFaEnabled(): bool      // ← added: cleaner than $user->google2fa_enabled
    {
        return (bool) $this->google2fa_enabled;
    }
}