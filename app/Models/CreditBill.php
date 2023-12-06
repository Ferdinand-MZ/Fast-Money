<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class CreditBill extends Model
{
    use HasFactory, Searchable;

    protected $table = 'credit_bills';

     // Specify the fillable fields to allow mass assignment
     protected $fillable = ['user_id', 'fullname', 'no_telp', 'provider', 'harga'];

     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function logs()
    {
        return $this->hasMany(Log::class, 'electric_bill_id'); // Adjust the foreign key column name if necessary
    }

    public function searchableAs()
    {
        return 'pages.creditBill';
    }
    public function toSearchableArray()
    {
        return [
            'fullname'=> $this->fullname,
            'no_telp'=> $this->no_telp,
            'provider'=> $this->provider,
            'harga'=> $this->harga,
            'created_at'=> $this->created_at,
        ];
    }
}
