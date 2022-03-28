<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-5 m-4">
        <div class="card">
            @if (Session::has('message'))
                <div class="alert alert-{{ Session::get('messageType') }} alert-dismissal">
                    <strong>{{ Session::get('message') }} </strong>
                    <button type="button" class="close" data-dismiss="alert">×</button>
                </div>
            @endif
            <div class="card-header">
                <h4>Topicals &nbsp;&nbsp; Liquid &nbsp;&nbsp; Caps &nbsp;&nbsp; Supp &nbsp;&nbsp; Sterile</h4>
            </div>
            <div class="card-body bgcolor">
                @error('tropical1Input')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group row">
                    <select wire:model="tropical1Input" class="form-control active col-md-8">
                        <option value="null" selected> Active Ingredient 1</option>
                        @foreach ($tropicals as $tropical)
                            <option value="{{ $tropical->id }}"> {{ $tropical->name }}</option>
                        @endforeach
                    </select>
                    <div class="col-md-3">
                        <input type="number" wire:model="price1" class="form-control" id="" placeholder=""
                            @if ($tropical1Input == 'null' || empty($tropical1Input)) readonly @endif>
                        @error('price1')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <label class="col-md-1 mb-1" style="font-size:28px;">%</label>

                </div>
                <div class="form-group row">
                    <select wire:model="tropical2Input" class="form-control active col-md-8">
                        <option value="null" selected> Active Ingredient 2</option>
                        @foreach ($tropicals as $tropical)
                            <option value="{{ $tropical->id }}"> {{ $tropical->name }}</option>
                        @endforeach
                    </select>
                    <div class="col-md-3">
                        <input type="number" wire:model="price2" class="form-control" id="" placeholder=""
                            @if ($tropical2Input == 'null' || empty($tropical2Input)) readonly @endif>
                        @error('price2')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <label class="col-md-1 mb-1" style="font-size:28px;">%</label>

                </div>
                <div class="form-group row">
                    <select wire:model="tropical3Input" class="form-control active col-md-8">
                        <option value="null" selected> Active Ingredient 3</option>
                        @foreach ($tropicals as $tropical)
                            <option value="{{ $tropical->id }}"> {{ $tropical->name }}</option>
                        @endforeach
                    </select>
                    <div class="col-md-3">
                        <input type="number" wire:model="price3" class="form-control" id="" placeholder=""
                            @if ($tropical3Input == 'null' || empty($tropical3Input)) readonly @endif>
                        @error('price3')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <label class="col-md-1 mb-1" style="font-size:28px;">%</label>

                </div>
                <div class="form-group row">
                    <select wire:model="tropical4Input" class="form-control active col-md-8">
                        <option value="null" selected> Active Ingredient 4</option>
                        @foreach ($tropicals as $tropical)
                            <option value="{{ $tropical->id }}"> {{ $tropical->name }}</option>
                        @endforeach
                    </select>
                    <div class="col-md-3">
                        <input type="number" wire:model="price4" class="form-control" id="" placeholder=""
                            @if ($tropical4Input == 'null' || empty($tropical4Input)) readonly @endif>
                        @error('price4')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <label class="col-md-1 mb-1" style="font-size:28px;">%</label>

                </div>
                <div class="form-group row">
                    <select wire:model="tropical5Input" class="form-control active col-md-8">
                        <option value="null" selected> Active Ingredient 5</option>
                        @foreach ($tropicals as $tropical)
                            <option value="{{ $tropical->id }}"> {{ $tropical->name }}</option>
                        @endforeach
                    </select>
                    <div class="col-md-3">
                        <input type="number" wire:model="price5" class="form-control" id="" placeholder=""
                            @if ($tropical5Input == 'null' || empty($tropical5Input)) readonly @endif>
                        @error('price5')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <label class="col-md-1 mb-1" style="font-size:28px;">%</label>

                </div>

                <div class="form-group row">
                    <select wire:model="baseInput" class="form-control base col-md-8">
                        <option value="null" selected>Choose Base 1</option>
                        @foreach ($bases as $base)
                            <option value="{{ $base->id }}"> {{ $base->name }}</option>
                        @endforeach
                    </select>

                    <div class="col-md-3">
                        <input type="number" wire:model="price6" class="form-control" id="" placeholder=""
                            @if ($baseInput == 'null' || empty($baseInput)) readonly @endif>
                        @error('price6')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <label class="col-md-1 mb-1" style="font-size:28px;">%</label>
                    @error('baseInput')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="form-group row">
                    <select class="form-control  base col-md-8">
                        <option selected>Choose Bases 2</option>
                    </select>

                    <div class="col-md-3">
                        <input type="number"  class="form-control" id="" placeholder="">
                    </div>
                    <label class="col-md-1 mb-1" style="font-size:28px;">%</label>

                </div>
                <div class="form-group row">
                    <select class="form-control base col-md-8">
                        <option selected>Choose Bases 3</option>
                    </select>

                    <div class="col-md-3">
                        <input type="number"  class="form-control" id="" placeholder="">
                    </div>
                    <label class="col-md-1 mb-1" style="font-size:28px;">%</label>

                </div>
                <div class="form-group row ">
                    <input type="text" class="form-control col-md-8" id="" style="margin: 0 0 0px 0; !important;"
                        placeholder=" Total Qauntity of Compounding" readonly>
                    <div class="col-md-3">
                        <input type="number" value={{ $gram_price }} class="form-control" id="" placeholder=""
                            readonly>
                    </div>
                    <label class="col-md-1 mb-1" style="font-size:28px;">%</label>

                </div>

                <div class="form-group row">
                    <select wire:model="basePack" class="form-control col-md-8">
                        <option value="null" selected>Packing</option>
                        @foreach ($packings as $packing)
                            <option value="{{ $packing->id }}">{{ $packing->name }}</option>
                        @endforeach
                    </select>

                    <div class="col-md-4">
                        <input type="number" class="form-control d-none" id="" placeholder=""
                            value="{{ $packing_price }}" readonly>
                    </div>
                    @error('basePack')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group row">
                    <select wire:model="delivery" class="form-control col-md-8">
                        <option value="null" selected>Delivery</option>
                        @foreach ($deliveries as $delivery)
                            <option value="{{ $delivery->id }}">{{ $delivery->name }}</option>
                        @endforeach
                    </select>

                    <div class="col-md-2">
                        <input type="number" class="form-control d-none" id="" placeholder=""
                            value="{{ $delivery_price }}" readonly>
                    </div>
                    @error('delivery')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary">Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 m-4">
        {{-- advertise here --}}
        <div class="card-header">
        </div>
        <div class="card" style="height: 32%;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <img src="{{ asset('../assets\compounding.png') }}" width="80%" class="img-fluid"
                            alt="I Compound It">
                    </div>
                </div>
            </div>
        </div>
        {{-- advertise here --}}
        <div class="card" style="height: 40%;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">

                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-1">
            <div class="card-body bgcolor">
                <div class="form-group row">
                    {{-- <input type="text" class="form-control col-md-12" id="" value = "{{ $total_price }}" placeholder="Calculate Your Price"> --}}
                    <button type="submit" wire:click="calculateTotal()"
                        class="btn btn-primary offset-md-4 col-md-4 offset-md-4">Calculate</button>
                </div>

                <div class="form-group row">
                    <input type="text" class="form-control col-md-6" id="" placeholder="Pharmacy Price"
                        value="{{ $total_price }}" readonly>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="" placeholder="Patient Price" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offset-md-1 col-md-10 offset-md-1">
        <div class="card">
            <div class="card-body bgcolor">
                <div class="form-group col-md-12">
                    <textarea placeholder="Order Notes" class="form-control col-md-12"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" wire:click="getMail()"
                        class="btn btn-primary offset-md-4 col-md-4 offset-md-4">Place
                        Order</button>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-12">
        <p class="d-flex justify-content-center">Question? Please call us At Macleod Trail Compounding Pharmcay
            &nbsp; <span><i class="fas fa-phone-square"></i> &nbsp;403-452-6013</span></p>
    </div>
</div>
