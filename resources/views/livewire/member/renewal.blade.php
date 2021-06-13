<div>
    @include('includes.mobile-menu')
    <div class="flex">
        @include('includes.side-menu')
        <!-- BEGIN: Content -->
        <div class="content">
            @include('includes.top-bar', [
                'menu' => $menu
            ])
            <div class="intro-y flex items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">
                    {{ ucfirst($menu) }}
                </h2>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-5 ">
                <div class="intro-y col-span-12 lg:col-span-6">
                    <div class="intro-y box p-5">
                        @if (auth()->user()->due_date)
                        @if (auth()->user()->renewal_waiting_fund->count() > 0)
                        <div class="intro-y box p-5 text-center overflow-x-auto">
                            <h5 class="text-2xl">Waiting For Fund . . .</h5>
                            <br>
                            <table class="table">
                                <tr>
                                    <td width="50%" class="border border-b-2 dark:border-dark-5 whitespace-nowrap text-right">
                                        Amount {{ $name }}
                                    </td>
                                    <td width="50%" class="border border-b-2 dark:border-dark-5 whitespace-nowrap">
                                        {{ number_format($amount, 5) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border border-b-2 dark:border-dark-5 whitespace-nowrap text-center">
                                        Send To {{ $name }} Address
                                        <br>
                                        <div style="display: flex; justify-content: center;" class="mt-3">
                                            {!! QrCode::size(200)->generate($wallet); !!}
                                        </div><br>
                                        {{ $wallet }}
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
                                            $until = \Carbon\Carbon::parse($time)->addHours(5);
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
                                            <textarea wire:model="information" class="form-control mt-3" cols="30" rows="2" placeholder="Deposit Information">
                                            </textarea>
                                            @error('information')
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
                        @if (auth()->user()->renewal_waiting_process->count() > 0)
                        <div class="alert alert-success show">
                            <h1 class="text-center"><strong>We have received your funds.</strong><br>Account activation process takes at least 2 x 24 hours</h1>
                        </div>
                        @else
                        <form wire:submit.prevent="submit">
                            <div>
                                <label for="contract" class="form-label">Contract</label>
                                <input id="contract" type="text" class="form-control" wire:model="contract" placeholder="Contract" readonly>
                                @error('contract')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="method" class="form-label">Activation Method</label>
                                <select data-placeholder="Contract" wire:model="method" class="form-select w-full">
                                    <option value="" selected>-- Choose Method --</option>
                                    @foreach ($data_payment as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->description }}</option>
                                    @endforeach
                                </select>
                                @error('method')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                            </div>
                            @if ($method)
                            <hr class="mt-3 mb-3">
                            <strong>Please Send {{ $description }} ({{ $name}})</strong>
                            <div class="mt-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input id="amount" type="text" class="form-control" value="{{ $amount }}" placeholder="Amount" readonly>
                                @error('name')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="wallet" class="form-label">To Wallet</label>
                                <input id="wallet" type="text" class="form-control" value="{{ $wallet }}" placeholder="Wallet" readonly>
                                @error('wallet')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                            </div>
                            <button class="btn btn-primary mt-5">Submit</button>
                            @endif
                        </form>
                        @endif
                        @endif
                        @else
                        <div class="alert alert-success show">
                            <h1 class="text-center">You don't need to do this action</h1>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-6">
                    <div class="alert alert-dark show intro-x">
                        <h3>History</h3>
                        <hr class="mt-2">
                        <div style="overflow-y: auto; max-height: 500px; height: 500px">
                            <table class="table">
                                <tbody>
                                    @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $row->created_at }}</td>
                                        <td>{{ $row->requisite }}</td>
                                        <td class="text-right">{{ number_format($row->amount) }} {{ $row->coin_name }}</td>
                                        <td>{{ $row->processed_at? "Success": "" }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <h3 class="mt-2">
                            Total : {{ number_format($data->sum('acceptance')) }} (BTT : {{ number_format($data->sum('accepted_btt')) }})
                        </h3>
                    </div>
                </div>
            </div>
            @if ($error)
            <div class="alert alert-danger show mt-3 mb-2" role="alert">
                {!! $error !!}
            </div>
            @endif
        </div>
        <!-- END: Content -->
    </div>
</div>
