<?php

namespace App\Http\Livewire;

use App\Models\BasesCompounding;
use App\Models\Delivery;
use App\Models\Packing;
use App\Models\TropicalsCompounding;
use Mail;
use Livewire\Component;

class Icompoundit extends Component
{
    public $tropical,$bases,$packings,$packings_id,$deliveries,$tCompound = 0,$patient_price=0;
    public $baseInput,$baseInput2,$baseInput3, $basePack = "",$delivery="";
    public $tropical1Input = "", $tropical2Input = "", $tropical3Input = "", $tropical4Input = "", $tropical5Input = "";
    public $tropical_price1,$tropical_price2,$tropical_price3,$tropical_price4,$tropical_price5,$base_price,$base_price2,$base_price3;
    public $price1 = 0,$price2 = 0,$price3 = 0,$price4 = 0,$price5 = 0,$price6 = 0,$price7 = 0,$price8 = 0;
    public $packing_price = 0,$delivery_price = 0,$total_price = 0,$gram_price = 0,$ingredientPrice = 0;

    public function mount()
    {
        $this->tropicals = TropicalsCompounding::all();
        $this->bases = BasesCompounding::all();
        $this->packings = Packing::all();
        $this->deliveries = Delivery::all();
    }

    public function render()
    {
        return view('livewire.icompoundit');
    }

    public function priceReset()
    {
        $this->tCompound = 0;
        $this->baseInput= "";
        $this->basePack = "";
        $this->delivery="";
        $this->tropical1Input = "";
        $this->tropical2Input = ""; 
        $this->tropical3Input = ""; 
        $this->tropical4Input = ""; 
        $this->tropical5Input = "";
        $this->price1 = 0;
        $this->price2 = 0;
        $this->price3 = 0;
        $this->price4 = 0;
        $this->price5 = 0;
        $this->price6 = 0;
        $this->packing_price = 0;
        $this->delivery_price = 0;
        $this->total_price = 0;
        $this->gram_price = 0;
        $this->ingredientPrice = 0;
    }

    public function total()
    {
        if($this->price1 == "") $this->price1 = 0;
        if($this->price2 == "") $this->price2 = 0;
        if($this->price3 == "") $this->price3 = 0;
        if($this->price4 == "") $this->price4 = 0;
        if($this->price5 == "") $this->price5 = 0;
        if($this->price6 == "") $this->price6 = 0;
        if($this->tCompound == "") $this->tCompound = 0;

        $this->ingredientPrice = 
            ($this->price1) +
            ($this->price2) +
            ($this->price3) +
            ($this->price4) +
            ($this->price5);
        if($this->price1 > 50 || $this->price2 > 50 || $this->price3 > 50 || $this->price4 > 50 || $this->price5 > 50 || $this->price6 < 50 || $this->ingredientPrice > 50){
            $this->dispatchBrowserEvent('modal');
        }
        
        $rules = $this->getRules();
        if (!empty($rules)) $this->validate($rules,[
            'tropical1Input.required' => 'Please Select Atleast One Ingredient.',
            'baseInput.required' => 'Please Select Base.',
            'price1.required' => 'Add Quantity.',
            'price1.gt' => 'Add Quantity.',
            'price2.required' => 'Add Quantity.',
            'price2.gt' => 'Add Quantity.',
            'price3.required' => 'Add Quantity.',
            'price3.gt' => 'Add Quantity.',
            'price4.required' => 'Add Quantity.',
            'price4.gt' => 'Add Quantity.',
            'price5.required' => 'Add Quantity.',
            'price5.gt' => 'Add Quantity.',
            'price6.required' => 'Add Quantity.',
            'price6.gt' => 'Add Quantity.',
            // 'price7.required' => 'Add Quantity.',
            // 'price7.gt' => 'Add Quantity.',
            // 'price8.required' => 'Add Quantity.',
            // 'price8.gt' => 'Add Quantity.',
            'basePack.required' => 'Select Packing.',
            'delivery.required' => 'Select Delivery.',
            'tCompound.required' => 'Add Quantity.',
            // 'tCompound.gt' => 'Must be Greater than 0.',
        ]);
            // $this->calculateGrams();
            $this->calculateTotal();
    }
    public function calculateTotal(){
        // $rules = $this->getRules();
        // if (!empty($rules)) $this->validate($rules,[
        //     'tropical1Input.required' => 'Please Select Atleast One Ingredient.',
        //     'baseInput.required' => 'Please Select Base.',
        //     'price1.required' => 'Add Quantity.',
        //     'price1.gt' => 'Add Quantity.',
        //     'price2.required' => 'Add Quantity.',
        //     'price2.gt' => 'Add Quantity.',
        //     'price3.required' => 'Add Quantity.',
        //     'price3.gt' => 'Add Quantity.',
        //     'price4.required' => 'Add Quantity.',
        //     'price4.gt' => 'Add Quantity.',
        //     'price5.required' => 'Add Quantity.',
        //     'price5.gt' => 'Add Quantity.',
        //     'price6.required' => 'Add Quantity.',
        //     'price6.gt' => 'Add Quantity.',
        //     'basePack.required' => 'Select Packing.',
        //     'delivery.required' => 'Select Delivery.',
        // ]);
        if($this->price1 == "") $this->price1 = 0;
        if($this->price2 == "") $this->price2 = 0;
        if($this->price3 == "") $this->price3 = 0;
        if($this->price4 == "") $this->price4 = 0;
        if($this->price5 == "") $this->price5 = 0;
        if($this->price6 == "") $this->price6 = 0;
        if($this->tCompound == "") $this->tCompound = 0;
        // if($this->price7 == "") $this->price7 = 0;
        // if($this->price8 == "") $this->price8 = 0;
        
        // if($this->price1!=0) $this->total_price += $this->tropical_price1 * $this->price1 ;
        // if($this->price2!=0) $this->total_price += $this->tropical_price2 * $this->price2 ;
        // if($this->price3!=0) $this->total_price += $this->tropical_price3 * $this->price3 ;
        // if($this->price4!=0) $this->total_price += $this->tropical_price4 * $this->price4 ;
        // if($this->price5!=0) $this->total_price += $this->tropical_price5 * $this->price1 ;
        // if($this->price6==0) $this->total_price += $this->base_price * $this->price6 ;
        
        // if($this->price1==0) $this->total_price += $this->tropical_price1 * 1 ;
        // if($this->price2==0) $this->total_price += $this->tropical_price2 * 1 ;
        // if($this->price3==0) $this->total_price += $this->tropical_price3 * 1 ;
        // if($this->price4==0) $this->total_price += $this->tropical_price4 * 1 ;
        // if($this->price5==0) $this->total_price += $this->tropical_price5 * 1 ;
        // if($this->price6==0) $this->total_price += $this->base_price * 1 ;

        if($this->tropical_price1 != null || $this->tropical_price2 != null || $this->tropical_price3 != null || $this->tropical_price4 != null || $this->tropical_price5 != null || $this->base_price != null){
            if($this->price1 != 0 || $this->price2 != 0 || $this->price3 != 0 || $this->price4 != 0 || $this->price5 != 0 || $this->price6 != 0 || $this->tCompound != 0 ){
                $this->price6 = 100 - $this->price1 - $this->price2 - $this->price3 - $this->price4 - $this->price5;
                if($this->tCompound <= 100 && $this->tCompound != 0){
                    $this->total_price = 
                    ($this->tropical_price1 * $this->price1) +
                    ($this->tropical_price2 * $this->price2) +
                    ($this->tropical_price3 * $this->price3) +
                    ($this->tropical_price4 * $this->price4) +
                    ($this->tropical_price5 * $this->price5) +
                    ($this->base_price * $this->price6) + 25 ;
                    if($this->packings_id == 2){
                        $packing_price = Packing::where('id',$this->packings_id)->first();
                        $this->packing_price = $packing_price->price;
                        $this->total_price += $this->packing_price;
                    }
                    if($this->packings_id == 3){
                        $packing_price = Packing::where('id',$this->packings_id)->first();
                        $this->packing_price = $packing_price->price;
                        $this->total_price += $this->packing_price;
                    }
                    if($this->packings_id == 1 || $this->packings_id == 4){
                        $packing_price = Packing::where('id',$this->packings_id)->first();
                        $this->packing_price = $packing_price->price;
                        $this->total_price += $this->packing_price;
                        // dd($this->total_price);
                    }
                }else{
                    $percent = $this->tCompound - 100;
                    $this->total_price = 
                    ($this->tropical_price1 * $this->price1) +
                    ($this->tropical_price2 * $this->price2) +
                    ($this->tropical_price3 * $this->price3) +
                    ($this->tropical_price4 * $this->price4) +
                    ($this->tropical_price5 * $this->price5) +
                    ($this->base_price * $this->price6) +  (25 * (1 + ($percent / 100) ));
                    // $total = $this->total_price * (1 + ($percent / 100) ); 
                    // $this->total_price = $total;

                    if($this->packings_id == 2){
                        $packing_price = Packing::where('id',$this->packings_id)->first();
                        $this->packing_price = $packing_price->price * ceil(1 + ($percent / 100));
                        $this->total_price += $this->packing_price;
                    }
                    if($this->packings_id == 3){
                        $packing_price = Packing::where('id',$this->packings_id)->first();
                        $this->packing_price = $packing_price->price * ceil(1 + ($percent / 100));
                        $this->total_price += $this->packing_price;
                    }
                    if($this->packings_id == 1 || $this->packings_id == 4){
                        $packing_price = Packing::where('id',$this->packings_id)->first();
                        $this->packing_price = $packing_price->price;
                        $this->total_price += $this->packing_price;
                    }
                }
                // ($this->base_price2 * $this->price7 ) 
                // ($this->base_price3 * $this->price8) 
            }else{
                $this->total_price = 0;
            }
        }else{
            $this->total_price = 0;
        }
        if($this->delivery_price) $this->total_price += $this->delivery_price;
        $this->patient_price = $this->total_price * 1.07 + 12.15;

            // if($this->price1 > 100){
            //     if($this->packings_id == 2){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price * 2;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 3){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price * 2;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 1 || $this->packings_id == 4){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            // }
            // elseif($this->price1 > 0){
            //     if($this->packings_id == 2){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 3){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 1 || $this->packings_id == 4){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //         // dd($this->total_price);
            //     }
                
            // }
        
            // if($this->price2 > 100){
            //     if($this->packings_id == 2){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price * 2;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 3){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price * 2;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 1 || $this->packings_id == 4){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            // }
            // elseif($this->price2 > 0){
            //     if($this->packings_id == 2){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 3){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 1 || $this->packings_id == 4){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            // }

            // if($this->price3 > 100){
            //     if($this->packings_id == 2){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price * 2;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 3){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price * 2;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 1 || $this->packings_id == 4){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            // }
            // elseif($this->price3 > 0){
            //     if($this->packings_id == 2){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 3){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 1 || $this->packings_id == 4){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            // }

            // if($this->price4 > 100){
            //     if($this->packings_id == 2){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price * 2;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 3){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price * 2;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 1 || $this->packings_id == 4){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            // }
            // elseif($this->price4 > 0){
            //     if($this->packings_id == 2){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 3){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 1 || $this->packings_id == 4){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            // }

            // if($this->price5 > 100){
            //     if($this->packings_id == 2){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price * 2;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 3){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price * 2;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 1 || $this->packings_id == 4){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            // }
            // elseif($this->price5 > 0){
            //     if($this->packings_id == 2){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 3){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 1 || $this->packings_id == 4){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            // }

            // if($this->price6 > 100){
            //     if($this->packings_id == 2){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price * 2;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 3){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price * 2;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 1 || $this->packings_id == 4){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            // }
            // elseif($this->price6 > 0){
            //     if($this->packings_id == 2){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 3){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            //     if($this->packings_id == 1 || $this->packings_id == 4){
            //         $packing_price = Packing::where('id',$this->packings_id)->first();
            //         $this->packing_price = $packing_price->price;
            //         $this->total_price += $this->packing_price;
            //     }
            // }
        // }else{
        //     if($this->packings_id == null){
        //         $this->packing_price = 0;
        //     }else{
        //         $packing_price = Packing::where('id',$this->packings_id)->first();
        //         $this->packing_price = $packing_price->price;
        //         $this->total_price += $this->packing_price;
        //     }
        // }
    }
    public function calculateGrams(){
        if($this->price1 == "") $this->price1 = 0;
        if($this->price2 == "") $this->price2 = 0;
        if($this->price3 == "") $this->price3 = 0;
        if($this->price4 == "") $this->price4 = 0;
        if($this->price5 == "") $this->price5 = 0;
        if($this->price6 == "") $this->price6 = 0;
        // if($this->price7 == "") $this->price7 = 0;
        // if($this->price8 == "") $this->price8 = 0;
        $this->price6 = 100 - $this->price1 - $this->price2 - $this->price3 - $this->price4 - $this->price5;
        
        // $this->gram_price = ($this->price1) +
        // ($this->price2) +
        // ($this->price3) +
        // ($this->price4) +
        // ($this->price5) +
        // ($this->price6);
        // ($this->price7) +
        // ($this->price8);
        
    }

    public function updatedTropical1Input($value){
        if(empty($value)){
            $this->tropical_price1 = 0;
            $this->price1 = 0;
            $this->calculateGrams();
            // $this->calculateTotal();

        }else{
            $this->ingredientPrice = 
                ($this->price1) +
                ($this->price2) +
                ($this->price3) +
                ($this->price4) +
                ($this->price5);
            if($this->price1 > 50 || $this->ingredientPrice > 50){
                $this->dispatchBrowserEvent('modal');
            }
            $tropicals_price = TropicalsCompounding::where('id',$value)->first();
            $this->tropical_price1 = $tropicals_price->price;
            $this->calculateGrams();
            // $this->calculateTotal();

        }
    }
    public function updatedTropical2Input($value){
        if(empty($value)){
            $this->tropical_price2 = 0;
            $this->price2 = 0;
            $this->calculateGrams();
            // $this->calculateTotal();

        }else{
            if($this->price1 == "") $this->price1 = 0;
            if($this->price2 == "") $this->price2 = 0;
            if($this->price3 == "") $this->price3 = 0;
            if($this->price4 == "") $this->price4 = 0;
            if($this->price5 == "") $this->price5 = 0;
            if($this->price6 == "") $this->price6 = 0;
            if($this->tCompound == "") $this->tCompound = 0;
            $this->ingredientPrice = 
                ($this->price1) +
                ($this->price2) +
                ($this->price3) +
                ($this->price4) +
                ($this->price5);
            if($this->price2 > 50 || $this->ingredientPrice > 50){
                $this->dispatchBrowserEvent('modal');
            }
            $tropicals_price = TropicalsCompounding::where('id',$value)->first();
            $this->tropical_price2 = $tropicals_price->price;
            $this->calculateGrams();
            // $this->calculateTotal();

        }
    }
    public function updatedTropical3Input($value){
        if(empty($value)){
            $this->tropical_price3 = 0;
            $this->price3 = 0;
            $this->calculateGrams();
            // $this->calculateTotal();

        }else{
            if($this->price1 == "") $this->price1 = 0;
            if($this->price2 == "") $this->price2 = 0;
            if($this->price3 == "") $this->price3 = 0;
            if($this->price4 == "") $this->price4 = 0;
            if($this->price5 == "") $this->price5 = 0;
            if($this->price6 == "") $this->price6 = 0;
            if($this->tCompound == "") $this->tCompound = 0;
            $this->ingredientPrice = 
                ($this->price1) +
                ($this->price2) +
                ($this->price3) +
                ($this->price4) +
                ($this->price5);
            if($this->price3 > 50 || $this->ingredientPrice > 50){
                $this->dispatchBrowserEvent('modal');
            }
            $tropicals_price = TropicalsCompounding::where('id',$value)->first();
            $this->tropical_price3 = $tropicals_price->price;
            $this->calculateGrams();
            // $this->calculateTotal();

        }
    }
    public function updatedTropical4Input($value){
        if(empty($value)){
            $this->tropical_price4 = 0;
            $this->price4 = 0;
            $this->calculateGrams();
            // $this->calculateTotal();

        }else{
                if($this->price1 == "") $this->price1 = 0;
            if($this->price2 == "") $this->price2 = 0;
            if($this->price3 == "") $this->price3 = 0;
            if($this->price4 == "") $this->price4 = 0;
            if($this->price5 == "") $this->price5 = 0;
            if($this->price6 == "") $this->price6 = 0;
            if($this->tCompound == "") $this->tCompound = 0;
            $this->ingredientPrice = 
                ($this->price1) +
                ($this->price2) +
                ($this->price3) +
                ($this->price4) +
                ($this->price5);
            if($this->price4 > 50 || $this->ingredientPrice > 50){
                $this->dispatchBrowserEvent('modal');
            }
            $tropicals_price = TropicalsCompounding::where('id',$value)->first();
            $this->tropical_price4 = $tropicals_price->price;
            $this->calculateGrams();
            // $this->calculateTotal();

        }
    }
    public function updatedTropical5Input($value){
        if(empty($value)){
            $this->tropical_price5 = 0;
            $this->price5 = 0;
            $this->calculateGrams();
            // $this->calculateTotal();

        }else{
            if($this->price1 == "") $this->price1 = 0;
        if($this->price2 == "") $this->price2 = 0;
        if($this->price3 == "") $this->price3 = 0;
        if($this->price4 == "") $this->price4 = 0;
        if($this->price5 == "") $this->price5 = 0;
        if($this->price6 == "") $this->price6 = 0;
        if($this->tCompound == "") $this->tCompound = 0;
            $this->ingredientPrice = 
                ($this->price1) +
                ($this->price2) +
                ($this->price3) +
                ($this->price4) +
                ($this->price5);
            if($this->price5 > 50 || $this->ingredientPrice > 50){
                $this->dispatchBrowserEvent('modal');
            }
            $tropicals_price = TropicalsCompounding::where('id',$value)->first();
            $this->tropical_price5 = $tropicals_price->price;
            $this->calculateGrams();
            // $this->calculateTotal();

        }
    }
    public function updatedBaseInput($value){
        if(empty($value)){
            $this->base_price = 0;
            $this->price6 = 0;
            $this->calculateGrams();
            // $this->calculateTotal();

        }else{
           
            $bases_price = BasesCompounding::where('id',$value)->first();
            $this->base_price = $bases_price->price;
            $this->calculateGrams();
            // $this->calculateTotal();

        }
    }
    // public function updatedBaseInput2($value){
    //     if(empty($value)){
    //         $this->base_price2 = 0;
    //         $this->price7 = 0;
    //         $this->calculateGrams();
    //         $this->calculateTotal();

    //     }else{
    //         $bases_price = BasesCompounding::where('id',$value)->first();
    //         $this->base_price2 = $bases_price->price;
    //         $this->price7 = 100 - $this->price1 - $this->price2 - $this->price3 - $this->price4 - $this->price5 - $this->price6;
    //         $this->calculateGrams();
    //         $this->calculateTotal();

    //     }
    // }
    // public function updatedBaseInput3($value){
    //     if(empty($value)){
    //         $this->base_price3 = 0;
    //         $this->price8 = 0;
    //         $this->calculateGrams();
    //         $this->calculateTotal();

    //     }else{
    //         $bases_price = BasesCompounding::where('id',$value)->first();
    //         $this->base_price3 = $bases_price->price;
    //         $this->price8 = 100 - $this->price1 - $this->price2 - $this->price3 - $this->price4 - $this->price5 - $this->price6 - $this->price7;
    //         $this->calculateGrams();
    //         $this->calculateTotal();

    //     }
    // }
    public function updatedBasePack($value){
        if(empty($value)){
            $this->packings_id = null;
            $this->packing_price = 0;
            $this->calculateGrams();
            // $this->calculateTotal();

        }else{
            // $packings_price = Packing::where('id',$value)->first();
            // $this->packing_price = $packings_price->price;
            $this->packings_id = $value;
            $this->calculateGrams();
            // $this->calculateTotal();

        }
    }
    public function updatedDelivery($value){
        if(empty($value)){
            $this->delivery_price = 0;
            $this->calculateGrams();
            // $this->calculateTotal();

        }else{
            $deliveries_price = Delivery::where('id',$value)->first();
            $this->delivery_price = $deliveries_price->price;
            $this->calculateGrams();
            // $this->calculateTotal();

        }
    }
    public function updatedPrice1(){
        $this->calculateGrams();
        if($this->price1 == "") $this->price1 = 0;
        if($this->price2 == "") $this->price2 = 0;
        if($this->price3 == "") $this->price3 = 0;
        if($this->price4 == "") $this->price4 = 0;
        if($this->price5 == "") $this->price5 = 0;
        if($this->price6 == "") $this->price6 = 0;
        if($this->tCompound == "") $this->tCompound = 0;
        $this->ingredientPrice = 
            ($this->price1) +
            ($this->price2) +
            ($this->price3) +
            ($this->price4) +
            ($this->price5);
        if($this->price1 > 50 || $this->ingredientPrice > 50){
            $this->dispatchBrowserEvent('modal');
        }
        // $this->calculateTotal();
    }
    public function updatedPrice2(){
        $this->calculateGrams();
        if($this->price1 == "") $this->price1 = 0;
        if($this->price2 == "") $this->price2 = 0;
        if($this->price3 == "") $this->price3 = 0;
        if($this->price4 == "") $this->price4 = 0;
        if($this->price5 == "") $this->price5 = 0;
        if($this->price6 == "") $this->price6 = 0;
        if($this->tCompound == "") $this->tCompound = 0;
        $this->ingredientPrice = 
            ($this->price1) +
            ($this->price2) +
            ($this->price3) +
            ($this->price4) +
            ($this->price5);
        if($this->price2 > 50 || $this->ingredientPrice > 50){
            $this->dispatchBrowserEvent('modal');
        }
        // $this->calculateTotal();
    }
    public function updatedPrice3(){
        $this->calculateGrams();
        if($this->price1 == "") $this->price1 = 0;
        if($this->price2 == "") $this->price2 = 0;
        if($this->price3 == "") $this->price3 = 0;
        if($this->price4 == "") $this->price4 = 0;
        if($this->price5 == "") $this->price5 = 0;
        if($this->price6 == "") $this->price6 = 0;
        if($this->tCompound == "") $this->tCompound = 0;
        $this->ingredientPrice = 
            ($this->price1) +
            ($this->price2) +
            ($this->price3) +
            ($this->price4) +
            ($this->price5);
        if($this->price3 > 50 || $this->ingredientPrice > 50){
            $this->dispatchBrowserEvent('modal');
        }
        // $this->calculateTotal();
    }
    public function updatedPrice4(){
        $this->calculateGrams();
        if($this->price1 == "") $this->price1 = 0;
        if($this->price2 == "") $this->price2 = 0;
        if($this->price3 == "") $this->price3 = 0;
        if($this->price4 == "") $this->price4 = 0;
        if($this->price5 == "") $this->price5 = 0;
        if($this->price6 == "") $this->price6 = 0;
        if($this->tCompound == "") $this->tCompound = 0;
        $this->ingredientPrice = 
            ($this->price1) +
            ($this->price2) +
            ($this->price3) +
            ($this->price4) +
            ($this->price5);
        if($this->price4 > 50 || $this->ingredientPrice > 50){
            $this->dispatchBrowserEvent('modal');
        }
        // $this->calculateTotal();
    }
    public function updatedPrice5(){
        $this->calculateGrams();
        if($this->price1 == "") $this->price1 = 0;
        if($this->price2 == "") $this->price2 = 0;
        if($this->price3 == "") $this->price3 = 0;
        if($this->price4 == "") $this->price4 = 0;
        if($this->price5 == "") $this->price5 = 0;
        if($this->price6 == "") $this->price6 = 0;
        if($this->tCompound == "") $this->tCompound = 0;
        $this->ingredientPrice = 
            ($this->price1) +
            ($this->price2) +
            ($this->price3) +
            ($this->price4) +
            ($this->price5);
        if($this->price5 > 50 || $this->ingredientPrice > 50){
            $this->dispatchBrowserEvent('modal');
        }
        // $this->calculateTotal();
    }
    public function updatedPrice6(){
        // $this->calculateTotal();
    } 
    public function updatedTCompound(){
        // $this->calculateTotal();
    }
    // public function updatedPrice7(){
    //     $this->calculateGrams();
    //     $this->calculateTotal();
    // }
    // public function updatedPrice8(){
    //     $this->calculateGrams();
    //     $this->calculateTotal();
    // }

    public function getRules()
    {
        $rules = [];
        if (empty($this->tropical1Input) && empty($this->tropical2Input) && empty($this->tropical3Input) && empty($this->tropical4Input) && empty($this->tropical5Input)) {
            $rules += [
                "tropical1Input" => "required",
            ];
        }
        if ($this->tropical1Input && !empty($this->tropical1Input)) {
            $rules += [
                "price1" => "required|numeric|gt:0",
            ];
        }
        if ($this->tropical2Input && !empty($this->tropical2Input)) {
            $rules += [
                "price2" => "required|numeric|gt:0",
            ];
        }
        if ($this->tropical3Input && !empty($this->tropical3Input)) {
            $rules += [
                "price3" => "required|numeric|gt:0",
            ];
        }
        if ($this->tropical4Input && !empty($this->tropical4Input)) {
            $rules += [
                "price4" => "required|numeric|gt:0",
            ];
        }
        if ($this->tropical5Input && !empty($this->tropical5Input)) {
            $rules += [
                "price5" => "required|numeric|gt:0",
            ];
        }
        if (empty($this->baseInput)) {
            $rules += [
                "baseInput" => "required",
            ];
        }
        if ($this->baseInput && !empty($this->baseInput)) {
            $rules += [
                "price6" => "required|numeric",
            ];
        }
        // if ($this->baseInput2 && !empty($this->baseInput2)) {
        //     $rules += [
        //         "price7" => "required|numeric|gt:0",
        //     ];
        // }
        // if ($this->baseInput3 && !empty($this->baseInput3)) {
        //     $rules += [
        //         "price8" => "required|numeric|gt:0",
        //     ];
        // }
        if ($this->tCompound == 0 || !empty($this->tCompound)) {
            $rules += [
                "tCompound" => "required|numeric",
            ];
        }
        
        if ($this->basePack == null) {
            $rules += [
                "basePack" => "required",
            ];
        }
        if ($this->delivery == null) {
            $rules += [
                "delivery" => "required",
            ];
        }

        return  $rules;
    }
   
    public function getMail()
    {
        if($this->price1 == "") $this->price1 = 0;
        if($this->price2 == "") $this->price2 = 0;
        if($this->price3 == "") $this->price3 = 0;
        if($this->price4 == "") $this->price4 = 0;
        if($this->price5 == "") $this->price5 = 0;
        if($this->price6 == "") $this->price6 = 0;
        if($this->tCompound == "") $this->tCompound = 0;
        $this->ingredientPrice = 
            ($this->price1) +
            ($this->price2) +
            ($this->price3) +
            ($this->price4) +
            ($this->price5);
        if($this->price1 > 50 || $this->price2 > 50 || $this->price3 > 50 || $this->price4 > 50 || $this->price5 > 50 || $this->price6 < 50 || $this->ingredientPrice > 50){
            $this->dispatchBrowserEvent('modal');
        }
        $rules = $this->getRules();
        if (!empty($rules)) $this->validate($rules,[
            'tropical1Input.required' => 'Please Select Atleast One Ingredient.',
            'price1.required' => 'Add Quantity.',
            'price1.gt' => 'Add Quantity.',
            'price2.required' => 'Add Quantity.',
            'price2.gt' => 'Add Quantity.',
            'price3.required' => 'Add Quantity.',
            'price3.gt' => 'Add Quantity.',
            'price4.required' => 'Add Quantity.',
            'price4.gt' => 'Add Quantity.',
            'price5.required' => 'Add Quantity.',
            'price5.gt' => 'Add Quantity.',
            'price6.required' => 'Add Quantity.',
            'price6.gt' => 'Add Quantity.',
            // 'price7.required' => 'Add Quantity.',
            // 'price7.gt' => 'Add Quantity.',
            // 'price8.required' => 'Add Quantity.',
            // 'price8.gt' => 'Add Quantity.',
            'basePack.required' => 'Select Packing.',
            'delivery.required' => 'Select Delivery.',
            'tCompound.required' => 'Add Quantity.',
            // 'tCompound.gt' => 'Must be Greater than 0.',
        ]);
        $email = 'hnhtechsolution02@gmail.com';
        try {
            Mail::send(
                'mail.compounding',
                $data = [
                'total_price' => $this->total_price,
                ],

                function($message) use ($email){
                    $message->from(env('MAIL_USERNAME'));
                    $message->to($email);
                    $message->subject('ICompounding');
                }
            );
            session()->flash('message', 'Placed Order');
            session()->flash('messageType', 'success');
            return redirect()->route('compounding');
            
        } catch (\Throwable $th) {
            session()->flash('message', 'Mail not send');
            session()->flash('messageType', 'fail');
            return redirect()->route('compounding');
        }
    }
}

