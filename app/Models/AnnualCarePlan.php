<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnnualCarePlan extends Model
{
    use HasFactory, SoftDeletes;

    static $defaultNotes = "<ul>
        <li>Patient is compliant taking medications.</li>
        <li>Current medication regimen remain well tolerated.</li>
        <li>No Intervention needed at this time.</li>
        <br>
    </ul>";

    public $defaultAlcohol = [
        "no" => "No",
        "2" => "&lt;2/Day",
        "4" => "2-4/Day",
        "5" => "&gt;5/Day"
    ];

    public $defaultCoffee = [
        "no" => "No",
        "2" => "&lt;2/Day",
        "4" => "2-4/Day",
        "5" => "&gt;5/Day"
    ];

    public $defaultRecreational = [
        "no" => "No",
        "marijuana" => "Yes, Marijuana",
        "other" => "Yes, Other Substances"
    ];

    public $defaultExercise = [
        "low" => "Low",
        "mid" => "Mid",
        "high" => "High"
    ];

    public function pharmacist(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addictions() {
        return $this->belongsToMany(Addiction::class,'annual_care_plan_addictions');
    }

    public function medicalConditions() {
        return $this->belongsToMany(MedicalCondition::class,"annual_care_plan_medical_conditions");
    }
}
