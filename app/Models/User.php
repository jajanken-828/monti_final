<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'position',
        'newsletter_opt_in',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'newsletter_opt_in' => 'boolean',
        ];
    }

    public function isHrm(): bool
    {
        return $this->role === 'hrm';
    }

    public function isScm(): bool
    {
        return $this->role === 'scm';
    }

    public function isManager(): bool
    {
        return $this->position === 'manager';
    }

    public function isStaff(): bool
    {
        return $this->position === 'staff';
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getRoleDisplayAttribute(): string
    {
        return $this->isHrm() ? 'HRM' : 'SCM';
    }

    public function getPositionDisplayAttribute(): string
    {
        return $this->isManager() ? 'Manager' : 'Staff';
    }
}
