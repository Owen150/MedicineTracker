<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'patient_number',
        'patient_name',
        'patient_address',
        'doctor',
        'prescription_date',
        'prescription_cost'
    ];

    public function prescriptionDetails(){
        return $this->belongsTo(PrescriptionDetail::class, 'order_id');
    }
}
