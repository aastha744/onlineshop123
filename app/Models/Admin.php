<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticable
{
    use HasFactory, Notifiable;

    protected $fillable = ['first_name','middle_name', 'last_name', 'email', 'password', 'address', 'phone', 'type', 'status'];

    protected $hidden = ['password'];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";

    }

    public function getIsAdminAttribute()
    {
       return$this->type == 'Admin';
    }

    public function getIsStaffAttribute()
    {
        return$this->type == 'Staff';
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
