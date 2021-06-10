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
            @if ($exist == true)
            <div class="alert intro-y alert-warning text-1xl gap-6 show mt-10 mb-2 text-center" role="alert">
                We have received your withdrawal request at {{ $total_wd->first()->created_at }}.<br>Please wait for this process for 2 x 24 hours
            </div>
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box p-5">
                    <h3>Last Withdrawal Information</h3>
                    <hr class="mt-3">
                    <table class="table">
                        <tr>
                            <td> Time</td>
                            <td> : </td>
                            <td class="text-right">{{ $total_wd->first()->created_at }}</td>
                        </tr>
                        <tr>
                            <td> Amount</td>
                            <td> : </td>
                            <td class="text-right">$ {{ $total_wd->first()->amount }}</td>
                        </tr>
                        <tr>
                            <td> Fee</td>
                            <td> : </td>
                            <td class="text-right">$ {{ $total_wd->first()->fee }}</td>
                        </tr>
                        <tr>
                            <td> Acceptance</td>
                            <td> : </td>
                            <td class="text-right">$ {{ $total_wd->first()->acceptance }}</td>
                        </tr>
                        <tr>
                            <td> BTT</td>
                            <td> : </td>
                            <td class="text-right">{{ number_format($total_wd->first()->accepted_btt) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            @else
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="intro-y col-span-12 lg:col-span-8">
                    <div class="intro-y box p-5">
                        <form wire:submit.prevent="submit">
                            <div>
                                <label for="bonus" class="form-label font-bold">Bonus Available</label>
                                <input id="bonus" type="number" class="form-control font-bold" wire:model.lazy="bonus" placeholder="Bonus Available" readonly>
                                @error('bonus')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                            </div>
                            <hr class="mt-3 mb-3">
                            <div>
                                <label for="amount" class="form-label">Amount</label>
                                <input id="amount" step="any" type="number" class="form-control" wire:model="amount" placeholder="Amount" autocomplete="off">
                                @error('amount')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="address" class="form-label">BTT Address</label>
                                <input id="address" type="text" class="form-control" wire:model.defer="address" placeholder="BTT Address" readonly>
                                @error('address')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                            </div>
                            <hr class="mt-3 mb-3">
                            <div>
                                <label for="fee" class="form-label">Fee</label>
                                <input id="fee" step="any" type="number" class="form-control" wire:model.defer="fee" placeholder="Fee" readonly>
                                @error('fee')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="btt" class="form-label">BTT You Get <small class="text-theme-6">(1 BTT = $ {{ number_format($btt_price, 8) }})</small></label>
                                <input id="btt" step="any" type="number" class="form-control" wire:model.defer="btt" placeholder="BTT" readonly>
                                @error('btt')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                            </div>
                            @if ($submit)
                            <button class="btn btn-success mt-5">Submit</button>
                            @endif
                        </form>
                    </div>
                </div>
                <div class="intro-y col-span-12 lg:col-span-4">
                    <div class="box p-5 bg-theme-6 intro-x">
                        <div class="flex flex-wrap gap-3">
                            <div class="w-full">
                                <div class="text-white text-2xl text-opacity-70 flex items-center leading-3"> Rules</div>
                                <hr class="mt-3 mb-3">
                                <div class="flex text-white">
                                    Remaining Contract : $ {{ number_format($remaining_contract) }}
                                </div>
                                <div class="flex text-white mt-4">
                                    Min. Withdraw : $ {{ number_format($min_wd)}}
                                </div>
                                <div class="flex text-white mt-4">
                                    Max. Withdraw : $ {{ number_format($max_wd)}}
                                </div>
                                <div class="flex text-white mt-4">
                                    Fee : {{ auth()->user()->contract->fee_wd }} %
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box p-5 bg-theme-11 intro-x mt-3">
                        <div class="flex flex-wrap gap-3">
                            <div class="w-full">
                                <div class="text-white text-2xl text-opacity-70 flex items-center leading-3"> Attention!!</div>
                                <hr class="mt-3 mb-3">
                                <div class="flex text-white">
                                    Pay attention to your BTT address. We are not responsible for your invalid BTT address
                                </div>
                                <div class="flex text-white mt-4">
                                    The withdrawal process takes 2 x 24 hours
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if ($error)
            <div class="alert alert-danger show mt-3 mb-2" role="alert">
                {!! $error !!}
            </div>
            @endif
        </div>
        <!-- END: Content -->
    </div>
</div>
