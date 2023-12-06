<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'fullname',
        'email',
        'password',
        'tgl_lahir',
        'no_telp',
        'saldo',
        'role',
        'picture'
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
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function electricBills()
    {
        return $this->hasMany(ElectricBill::class);
    }

    public function internetBills()
    {
        return $this->hasMany(InternetBill::class);
    }

    public function creditBills()
    {
        return $this->hasMany(CreditBill::class);
    }
    public function log()
    {
        return $this->hasMany(log::class, 'id_user');
    }

    public function searchableAs()
    {
        return 'pages.users';
    }
    public function toSearchableArray()
    {
        return [
            'username'=> $this->username,
            'fullname'=> $this->fullname,
        ];
    }
}
