<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ElectricBill extends Model
{
    use HasFactory, Searchable;

     // Define the table associated with the model
     protected $table = 'electric_bills';

     // Specify the fillable fields to allow mass assignment
     protected $fillable = ['user_id', 'fullname', 'meter_number', 'token_listrik', 'harga'];

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
        return 'pages.electricBill';
    }
    public function toSearchableArray()
    {
        return [
            'fullname'=> $this->fullname,
            'meter_number'=> $this->meter_number,
            'token_listrik'=> $this->token_listrik,
            'harga'=> $this->harga,
            'created_at'=> $this->created_at,
        ];
    }
}
