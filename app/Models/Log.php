<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class Log extends Model
{
    use HasFactory;

    protected $table = "log";
    protected $fillable = ["id","id_user","activity"];

    public function getActivitylogOptions():LogOptions
    {
        return LogOptions::defaults()->LogOnly(["id_user", "activity"]);
    }

    public function electricBill() {
        return $this->belongsTo(ElectricBill::class, 'electric_bill_id');
    }

    public function internetBill() {
        return $this->belongsTo(InternetBill::class, 'internet_bill_id');
    }

    public function creditBill() {
        return $this->belongsTo(CreditBill::class, 'credit_bill_id');
    }
}
