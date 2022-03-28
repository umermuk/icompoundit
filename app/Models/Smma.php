<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smma extends Model
{
    use HasFactory;

    public function pharmacist(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addictions() {
        return $this->belongsToMany(Addiction::class,'smma_addictions');
    }

    public function medicalConditions() {
        return $this->belongsToMany(MedicalCondition::class,"smma_medical_conditions");
    }
}
