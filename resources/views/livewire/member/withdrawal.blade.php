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
                        @if ($exist == true)
                        <div class="alert intro-y alert-warning text-1xl gap-6 show mt-10 mb-2 text-center" role="alert">
                            We have received your withdrawal request at {{ $total_wd->first()->created_at }}.<br>You can withdraw after 2 x 24 hours
                        </div>
                        @else
                        <div class="alert alert-primary show mb-2 mt-3" role="alert">
                            <small>
                                <p>
                                    Remaining Contract : $ {{ number_format($remaining_contract) }}
                                </p>
                                <p>
                                    Min. Withdraw : $ {{ number_format($min_wd)}}
                                </p>
                                <p>
                                    Max. Withdraw : $ {{ number_format($max_wd)}}
                                </p>
                                <p>
                                    Fee : {{ auth()->user()->contract->fee_wd }} %
                                </p>
                            </small>
                        </div>
                        <form wire:submit.prevent="submit">
                            <div>
                                <label for="bonus" class="form-label font-bold">Bonus Available</label>
                                <input id="bonus" type="number" class="form-control font-bold" value="{{ number_format($bonus) }}" placeholder="Bonus Available" readonly>
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
                                <input id="address" type="text" class="form-control" value="{{ $address }}" placeholder="BTT Address" readonly>
                                @error('address')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                            </div>
                            <hr class="mt-3 mb-3">
                            <div>
                                <label for="fee" class="form-label">Fee</label>
                                <input id="fee" step="any" type="number" class="form-control" value="{{ $fee }}" placeholder="Fee" readonly>
                                @error('fee')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="btt" class="form-label">BTT You Get <small class="text-theme-6">(1 BTT = $ {{ number_format($btt_price, 8) }})</small></label>
                                <input id="btt" step="any" type="number" class="form-control" value="{{ $btt }}" placeholder="BTT" readonly>
                                @error('btt')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                            </div>
                            <div class="alert alert-warning show mb-2 mt-3" role="alert">
                                <small>
                                    <p>
                                        Pay attention to your BTT address. We are not responsible for your invalid BTT address
                                    </p>
                                    <p>
                                        The withdrawal process takes 2 x 24 hours
                                    </p>
                                </small>
                            </div>
                            @if ($submit)
                            <button class="btn btn-success mt-3">Submit</button>
                            @endif
                        </form>
                        @endif
                    </div>
                </div>
                <div class="intro-y col-span-12 lg:col-span-6">
                    <div class="intro-y alert alert-dark show">
                        <h3>History</h3>
                        <hr class="mt-2">
                        <div style="overflow-y: auto; max-height: 630px; height: 630px">
                            <table class="table">
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $row->created_at }}</td>
                                        <td>{{ $row->acceptance }}</td>
                                        <td>{{ $row->accepted_btt }}</td>
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
