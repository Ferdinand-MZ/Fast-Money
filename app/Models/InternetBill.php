<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class InternetBill extends Model
{
    use HasFactory, Searchable;

     // Define the table associated with the model
     protected $table = 'internet_bills';

     // Specify the fillable fields to allow mass assignment
     protected $fillable = ['user_id', 'fullname', 'customer_id', 'nama_penyedia', 'harga'];

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
        return 'pages.internetBill';
    }
    public function toSearchableArray()
    {
        return [
            'fullname'=> $this->fullname,
            'customer_id'=> $this->customer_id,
            'nama_penyedia'=> $this->nama_penyedia,
            'harga'=> $this->harga,
            'created_at'=> $this->created_at,
        ];
    }
}
