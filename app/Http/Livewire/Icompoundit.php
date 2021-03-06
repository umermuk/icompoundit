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
    public $tropical,$bases,$packings,$packings_id,$deliveries;
    public $baseInput,$tropical1Input,$tropical2Input,$tropical3Input,$tropical4Input,$tropical5Input,$basePack,$delivery;
    public $tropical_price1,$tropical_price2,$tropical_price3,$tropical_price4,$tropical_price5,$base_price;
    public $price1 = 0,$price2 = 0,$price3 = 0,$price4 = 0,$price5 = 0,$price6 = 0,$packing_price = 0,$delivery_price = 0,$total_price = 0,$gram_price = 0;

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

    public function calculateTotal(){
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
            'basePack.required' => 'Select Packing.',
            'delivery.required' => 'Select Delivery.',
        ]);
        if($this->price1 == "") $this->price1 = 0;
        if($this->price2 == "") $this->price2 = 0;
        if($this->price3 == "") $this->price3 = 0;
        if($this->price4 == "") $this->price4 = 0;
        if($this->price5 == "") $this->price5 = 0;
        if($this->price6 == "") $this->price6 = 0;
        
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
            $this->total_price = ($this->tropical_price1 * $this->price1) +
            ($this->tropical_price2 * $this->price2) +
            ($this->tropical_price3 * $this->price3) +
            ($this->tropical_price4 * $this->price4) +
            ($this->tropical_price5 * $this->price5) +
            ($this->base_price * $this->price6) + 25 +
            ($this->delivery_price) ;
        }else{
            $this->total_price = 0;
        }

        // if($this->price1 > 100 || $this->price2 > 100 || $this->price3 > 100 || $this->price4 > 100 || $this->price5 || $this->price6 > 100)
        // {
            if($this->price1 > 100){
                if($this->packings_id == 2){
                    $packing_price = Packing::where('id',$this->packings_id)->first();
                    $this->packing_price = $packing_price->price * 2;
                    $this->total_price += $this->packing_price;
                }
                if($this->packings_id == 3){
                    $packing_price = Packing::where('id',$this->packings_id)->first();
                    $this->packing_price = $packing_price->price * 2;
                    $this->total_price += $this->packing_price;
                }
                if($this->packings_id == 1 || $this->packings_id == 4){
                    $packing_price = Packing::where('id',$this->packings_id)->first();
                    $this->packing_price = $packing_price->price;
                    $this->total_price += $this->packing_price;
                }
            }
            elseif($this->price1 > 0){
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
                }
                
            }
        
            if($this->price2 > 100){
                if($this->packings_id == 2){
                    $packing_price = Packing::where('id',$this->packings_id)->first();
                    $this->packing_price = $packing_price->price * 2;
                    $this->total_price += $this->packing_price;
                }
                if($this->packings_id == 3){
                    $packing_price = Packing::where('id',$this->packings_id)->first();
                    $this->packing_price = $packing_price->price * 2;
                    $this->total_price += $this->packing_price;
                }
                if($this->packings_id == 1 || $this->packings_id == 4){
                    $packing_price = Packing::where('id',$this->packings_id)->first();
                    $this->packing_price = $packing_price->price;
                    $this->total_price += $this->packing_price;
                }
            }
            elseif($this->price2 > 0){
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
                }
            }

            if($this->price3 > 100){
                if($this->packings_id == 2){
                    $packing_price = Packing::where('id',$this->packings_id)->first();
                    $this->packing_price = $packing_price->price * 2;
                    $this->total_price += $this->packing_price;
                }
                if($this->packings_id == 3){
                    $packing_price = Packing::where('id',$this->packings_id)->first();
                    $this->packing_price = $packing_price->price * 2;
                    $this->total_price += $this->packing_price;
                }
                if($this->packings_id == 1 || $this->packings_id == 4){
                    $packing_price = Packing::where('id',$this->packings_id)->first();
                    $this->packing_price = $packing_price->price;
                    $this->total_price += $this->packing_price;
                }
            }
            elseif($this->price3 > 0){
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
                }
            }

            if($this->price4 > 100){
                if($this->packings_id == 2){
                    $packing_price = Packing::where('id',$this->packings_id)->first();
                    $this->packing_price = $packing_price->price * 2;
                    $this->total_price += $this->packing_price;
                }
                if($this->packings_id == 3){
                    $packing_price = Packing::where('id',$this->packings_id)->first();
                    $this->packing_price = $packing_price->price * 2;
                    $this->total_price += $this->packing_price;
                }
                if($this->packings_id == 1 || $this->packings_id == 4){
                    $packing_price = Packing::where('id',$this->packings_id)->first();
                    $this->packing_price = $packing_price->price;
                    $this->total_price += $this->packing_price;
                }
            }
            elseif($this->price4 > 0){
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
                }
            }

            if($this->price5 > 100){
                if($this->packings_id == 2){
                    $packing_price = Packing::where('id',$this->packings_id)->first();
                    $this->packing_price = $packing_price->price * 2;
                    $this->total_price += $this->packing_price;
                }
                if($this->packings_id == 3){
                    $packing_price = Packing::where('id',$this->packings_id)->first();
                    $this->packing_price = $packing_price->price * 2;
                    $this->total_price += $this->packing_price;
                }
                if($this->packings_id == 1 || $this->packings_id == 4){
                    $packing_price = Packing::where('id',$this->packings_id)->first();
                    $this->packing_price = $packing_price->price;
                    $this->total_price += $this->packing_price;
                }
            }
            elseif($this->price5 > 0){
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
                }
            }

            if($this->price6 > 100){
                if($this->packings_id == 2){
                    $packing_price = Packing::where('id',$this->packings_id)->first();
                    $this->packing_price = $packing_price->price * 2;
                    $this->total_price += $this->packing_price;
                }
                if($this->packings_id == 3){
                    $packing_price = Packing::where('id',$this->packings_id)->first();
                    $this->packing_price = $packing_price->price * 2;
                    $this->total_price += $this->packing_price;
                }
                if($this->packings_id == 1 || $this->packings_id == 4){
                    $packing_price = Packing::where('id',$this->packings_id)->first();
                    $this->packing_price = $packing_price->price;
                    $this->total_price += $this->packing_price;
                }
            }
            elseif($this->price6 > 0){
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
                }
            }
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
        
        $this->gram_price = ($this->price1) +
        ($this->price2) +
        ($this->price3) +
        ($this->price4) +
        ($this->price5) +
        ($this->price6);
        
    }

    public function updatedTropical1Input($value){
        if($value == "null"){
            $this->tropical_price1 = 0;
            $this->price1 = 0;
            // $this->calculateTotal();
        }else{
            $tropicals_price = TropicalsCompounding::where('id',$value)->first();
            $this->tropical_price1 = $tropicals_price->price;
            // $this->calculateTotal();
        }
    }
    public function updatedTropical2Input($value){
        if($value == "null"){
            $this->tropical_price2 = 0;
            $this->price2 = 0;
            // $this->calculateTotal();
        }else{
            $tropicals_price = TropicalsCompounding::where('id',$value)->first();
            $this->tropical_price2 = $tropicals_price->price;
            // $this->calculateTotal();
        }
    }
    public function updatedTropical3Input($value){
        if($value == "null"){
            $this->tropical_price3 = 0;
            $this->price3 = 0;
            // $this->calculateTotal();
        }else{
            $tropicals_price = TropicalsCompounding::where('id',$value)->first();
            $this->tropical_price3 = $tropicals_price->price;
            // $this->calculateTotal();
        }
    }
    public function updatedTropical4Input($value){
        if($value == "null"){
            $this->tropical_price4 = 0;
            $this->price4 = 0;
            // $this->calculateTotal();
        }else{
            $tropicals_price = TropicalsCompounding::where('id',$value)->first();
            $this->tropical_price4 = $tropicals_price->price;
            // $this->calculateTotal();
        }
    }
    public function updatedTropical5Input($value){
        if($value == "null"){
            $this->tropical_price5 = 0;
            $this->price5 = 0;
            // $this->calculateTotal();
        }else{
            $tropicals_price = TropicalsCompounding::where('id',$value)->first();
            $this->tropical_price5 = $tropicals_price->price;
            // $this->calculateTotal();
        }
    }
    public function updatedBaseInput($value){
        if($value == "null"){
            $this->base_price = 0;
            $this->price6 = 0;
            // $this->calculateTotal();
        }else{
            $bases_price = BasesCompounding::where('id',$value)->first();
            $this->base_price = $bases_price->price;
            // $this->calculateTotal();
        }
    }
    public function updatedBasePack($value){
        if($value == "null"){
            $this->packings_id = null;
            $this->packing_price = 0;
            // $this->calculateTotal();
        }else{
            // $packings_price = Packing::where('id',$value)->first();
            // $this->packing_price = $packings_price->price;
            $this->packings_id = $value;
            // $this->calculateTotal();
        }
    }
    public function updatedDelivery($value){
        if($value == "null"){
            $this->delivery_price = 0;
            // $this->calculateTotal();
        }else{
            $deliveries_price = Delivery::where('id',$value)->first();
            $this->delivery_price = $deliveries_price->price;
            // $this->calculateTotal();
        }
    }
    public function updatedPrice1(){
        // $this->calculateTotal();
        $this->calculateGrams();
    }
    public function updatedPrice2(){
        // $this->calculateTotal();
        $this->calculateGrams();
    }
    public function updatedPrice3(){
        // $this->calculateTotal();
        $this->calculateGrams();
    }
    public function updatedPrice4(){
        // $this->calculateTotal();
        $this->calculateGrams();
    }
    public function updatedPrice5(){
        // $this->calculateTotal();
        $this->calculateGrams();
    }
    public function updatedPrice6(){
        // $this->calculateTotal();
        $this->calculateGrams();
    }

    public function getRules()
    {
        $rules = [];
        if ($this->tropical1Input == null && $this->tropical2Input == null && $this->tropical3Input == null && $this->tropical4Input == null && $this->tropical5Input == null ) {
            $rules += [
                "tropical1Input" => "required",
            ];
        }
        if ($this->tropical1Input) {
            $rules += [
                "price1" => "required|numeric|gt:0",
            ];
        }
        if ($this->tropical2Input) {
            $rules += [
                "price2" => "required|numeric|gt:0",
            ];
        }
        if ($this->tropical3Input) {
            $rules += [
                "price3" => "required|numeric|gt:0",
            ];
        }
        if ($this->tropical4Input) {
            $rules += [
                "price4" => "required|numeric|gt:0",
            ];
        }
        if ($this->tropical5Input) {
            $rules += [
                "price5" => "required|numeric|gt:0",
            ];
        }
        if ($this->baseInput == null) {
            $rules += [
                "baseInput" => "required",
            ];
        }
        if ($this->baseInput) {
            $rules += [
                "price6" => "required|numeric|gt:0",
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
            'basePack.required' => 'Select Packing.',
            'delivery.required' => 'Select Delivery.',
        ]);
        $email = 'hnhtechsolution02@gmail.com';
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
        // return back()->with(['fail' => 'Mail not send']);
        session()->flash('message', 'Placed Order');
        session()->flash('messageType', 'success');
        return redirect()->route('compounding');
        
    }
}

