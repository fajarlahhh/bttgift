<div>
    <div class="grid grid-cols-12 gap-6 mt-5 ">
        <div class="intro-y box p-5 col-span-12 lg:col-span-12">
            @if ($waiting == true)
            <div class="intro-y box p-5 text-center overflow-x-auto">
                <h5 class="text-2xl">Waiting For Fund . . .</h5>
                <br>
                <table class="table">
                    <tr>
                        <td width="50%" class="border border-b-2 dark:border-dark-5 whitespace-nowrap text-right">
                            Amount {{ $payment_name }}
                        </td>
                        <td width="50%" class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                            {{ number_format($payment_amount, 5) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="border border-b-2 dark:border-dark-5 whitespace-nowrap text-center">
                            Send To {{ $payment_name }} Address
                            <br>
                            <div style="display: flex; justify-content: center;" class="mt-3">
                                {!! QrCode::size(200)->generate($payment_wallet); !!}
                            </div><br>
                            {{ $payment_wallet }}
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" class="border border-b-2 dark:border-dark-5 whitespace-nowrap text-right">

                        </td>
                        <td width="50%" class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" class="border border-b-2 dark:border-dark-5 whitespace-nowrap text-right">
                            Time Left
                        </td>
                        <td width="50%" class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                            @php
                                $until = \Carbon\Carbon::parse($payment_time)->addHours(5);
                                echo $until->diff(now())->format('%Hh :%Im :%Ss ');
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="border border-b-2 dark:border-dark-5 whitespace-nowrapt text-center" >
                            <form wire:submit.prevent="done">
                                Upload your proof of deposit here  <input type="file" wire:model="file" accept="image/*"><br>
                                @error('file')
                                <div class="text-theme-6 mt-2">Image file is required</div>
                                @enderror
                                <textarea wire:model="payment_information" class="form-control mt-3" cols="30" rows="2" placeholder="Deposit Information">
                                </textarea>
                                @error('payment_information')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                                <input type="submit" class="btn btn-success mt-3" value="Done">
                            </form>
                        </td>
                    </tr>
                </table>
                <br>
                <small>The amount of {{ $name }} to be transferred must match the amount above</small>
            </div>
            @else
            <form wire:submit.prevent="submit">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 lg:col-span-6">
                        <div>
                            <label for="username" class="form-label">Username</label>
                            <input id="username" type="text" class="form-control" autocomplete="off" wire:model.defer="username" placeholder="Username" required>
                            @error('username')
                            <div class="text-theme-6 mt-2">This field is required</div>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" type="text" class="form-control" autocomplete="off" wire:model.defer="name" placeholder="Name" required>
                            @error('name')
                            <div class="text-theme-6 mt-2">This field is required</div>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control" autocomplete="off" wire:model.defer="email" placeholder="Email" required>
                            @error('email')
                            <div class="text-theme-6 mt-2">This field is required</div>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input id="crud-form-3" type="{{ $type }}" class="form-control" wire:model.defer="password" aria-describedby="input-group-1" placeholder="Password" autocomplete="off">
                                <a href="javascript:;" id="input-group-1" wire:click="showHide('{{ $show }}')" class="input-group-text">{{ $show }}</a>
                            </div>
                            @error('password')
                            <div class="text-theme-6 mt-2">This field is required</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-6">
                        <div class="alert alert-primary show">
                            <div>
                                <label for="position" class="form-label">Position</label>
                                <select data-placeholder="Contract" id="position" wire:model.defer="position" class="form-select text-gray-700 border-gray-300" required>
                                    <option value="1" selected>Right Side</option>
                                    <option value="0" selected>Left Side</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="upline" class="form-label">Upline</label>
                                <select data-placeholder="Contract" id="upline" wire:model.defer="upline" class="form-select text-gray-700 border-gray-300" required>
                                    @foreach ($data_upline as $row)
                                    <option value="{{ $row->getKey() }}">{{ $row->username }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="contract" class="form-label">Contract</label>
                                <select data-placeholder="Contract" id="contract" wire:model="contract" class="form-select text-gray-700 border-gray-300" required>
                                    <option value="" selected>-- Choose Contract --</option>
                                    @foreach ($data_contract as $item)
                                    <option value="{{ $item->price }}">$ {{ number_format($item->price) }} = $ {{ number_format($item->price * $item->max_claim/100) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="metpayment_methodhod" class="form-label">Payment Method</label>
                                <select data-placeholder="Contract" id="payment_method" wire:model="payment_method" class="text-gray-700 form-select w-full">
                                    <option value="" selected>-- Choose Method --</option>
                                    @foreach ($data_payment as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->description }}</option>
                                    @endforeach
                                </select>
                                @error('payment_method')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                @if ($payment_method)
                <button class="btn btn-primary mt-5">Submit</button>
                @endif
                @if ($error)
                <div class="alert alert-danger show col-span-12 lg:col-span-6 mt-2" role="alert">
                    {!! $error !!}
                </div>
                @endif
            </form>
            @endif
        </div>
    </div>
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tail.select.js@0.5.21/js/tail.select-full.min.js
    "></script>
    <script>
        tail.select('#upline', {
            search: true
        });
        Livewire.on('reinitialize', () => {
            tail.select('#upline', {
                search: true
            });
        });
    </script>
    @endpush
</div>
