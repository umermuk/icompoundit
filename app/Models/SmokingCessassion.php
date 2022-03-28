<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmokingCessassion extends Model
{
    use HasFactory;

    public function pharmacist(){
        return $this->belongsTo(User::class, 'user_id');
    }
    
    static $defaultNotes = "<ul>
        <li>Patient will consider giving up smoking & will let us know.</li>
        <li>We will follow up with the patient.</li>
        <br>
    </ul>";

    public $default_physical_activity = [
        "low" => "Low",
        "moderate" => "Moderate",
        "high" => "High",
        
    ];

    public $default_diet = [
        'not_healthy' => 'Not Healthy',
        'moderately_healthy' => 'Moderately Healthy',
        'healthy' => 'Healthy',
    ];

    public $default_alcohol = [
        'dont' => 'Don&#x27;t Drink',
        "2" => "&lt;2/Day",
        "4" => "2-6/Day",
        "6" => "&gt;6/Day"
    ];

    public $default_caffiene = [
        'dont' => 'Don&#x27;t Drink',
        "2" => "&lt;2/Day",
        "4" => "3-6/Day",
        "6" => "&gt;6/Day"
    ];

    public $default_female_preg = [
        'yes' => 'Yes',
        "no" => "No",
        "not_sure" => "Not Sure",
    ];

    public $default_breastfeeding = [
        'yes' => 'Yes',
        "no" => "No",
    ];
    
    public $default_smoke_packs = [
        "2" => "&lt;1/2pack/Day",
        "4" => "1/2 to 1pack/Day",
        "6" => "1-2packs/Day",
        "8" => "&gt;2packs/Day"
    ];

    public $default_smoking_long = [
        "2" => "&lt;1Year",
        "4" => "1-5Years",
        "6" => "5-10Years",
        "8" => "&gt;10Years"
    ];

    public $default_soon_walking = [
        "2" => "&lt;5Minutes",
        "4" => "5-30Minutes",
        "6" => "&gt;30Minutes"
    ];

    public $default_exposure_smokers = [
        "home" => "At Home",
        "car" => "In Car",
        "work" => "At Work",
        "socializing" => "When Socializing",
    ];

    public $default_when_smoke = [
        "morning" => "Morning",
        "afternoon" => "Afternoon",
        "evening" => "Evening",
        "thoughtout_day" => "Thoughtout The Day",
    ];

    public $default_with_who = [
        "alone" => "Alone",
        "friends" => "Friends",
        "co_workers" => "Co-Workers",
        "family" => "Family/Spouse",
        "other" => "Other"
    ];

    public $default_triggers_tobacco = [
        "habit" => "Habit",
        "stress" => "Stress",
        "peer_pressure" => "Peer Pressure",
        "boredom" => "Boredom",
        "meal" => "Meals",
        "drinking" => "Drinking",
        "other" => "Other",
    ];

    public $default_day_spend_tobacco = [
        "2" => "&lt;$10/Day(i.e.&lt;3650$/Year)",
        "4" => "10-20$/Day(i.e.3650-7500$/Year)",
        "6" => "&gt;20$/Day(i.e.&gt;7500    $/Year)"
    ];

    public $default_important_quit = [
        "not" => "Not Important",
        "moderately" => "Moderately Important",
        "very" => "Very Important"
    ];

    public $default_times_try_quit = [
        "2" => "&lt;2Attempts",
        "4" => "2-4Attempts",
        "6" => "&gt;4Attempts"
    ];
    
    public $default_longest_attempt = [
        "2" => "&lt;6Months",
        "4" => "6-12Months",
        "6" => "1-2Years",
        "8" => "&gt;2Years"
    ];

    public $default_cousel_on_five_ds = [
        "yes" => "Yes",
        "no" => "No",
    ];

    public $default_treatment_option = [
        "patches" => "Patches",
        "gum" => "Gum",
        "lozenges" => "Lozenges",
        "spray" => "Spray",
        "inhaler" => "Inhaler",
        "vaping" => "Vaping",
        "champix" => "Champix ",
        "zyban" => "Zyban",

    ];
    
}
