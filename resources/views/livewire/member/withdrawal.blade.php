<div>
    <div class="grid grid-cols-12 gap-6 mt-5 ">
        @if (auth()->user()->due_date)
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y box p-5">
                <div class="alert intro-y alert-warning text-1xl gap-6 show" role="alert">
                    Your account is in grace period. Renew your contract <strong><a href="/renewal" class="text-danger">here</a> </strong> before {{ auth()->user()->due_date }}
                </div>
            </div>
        </div>
        @else
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y box p-5">
                @if ($exist == true)
                <div class="alert intro-y alert-warning text-1xl gap-6 show text-center" role="alert">
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
                        <label for="bonus" class="form-label font-bold">Gift Available</label>
                        <input id="bonus" type="text" class="form-control font-bold" value="$ {{ number_format($bonus) }}" placeholder="Bonus Available" readonly>
                        @error('bonus')
                        <div class="text-theme-6 mt-2">This field is required</div>
                        @enderror
                    </div>
                    <hr class="mt-3 mb-3">
                    <div>
                        <label for="amount" class="form-label">Amount</label>
                        <input id="amount" step="any" type="number" class="form-control" wire:model.lazy="amount" placeholder="Amount" autocomplete="off">
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
                        <input id="fee" type="text" class="form-control" value="$ {{ $fee }}" placeholder="Fee" readonly>
                        @error('fee')
                        <div class="text-theme-6 mt-2">This field is required</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="btt" class="form-label">BTT You Get <small class="text-theme-6">(1 BTT = $ {{ number_format($btt_price, 8) }})</small></label>
                        <input id="btt" type="text" class="form-control" value="{{ $btt }}" placeholder="BTT" readonly>
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
                    <hr class="mt-5">
                    <div class="mt-3">
                        <label for="username" class="form-label">Google Auth PIN</label>
                        <input id="username" type="text" class="form-control" wire:model.defer="pin" placeholder="Enter Your Google Authenticator PIN" autocomplete="off">
                        @error('pin')
                        <div class="text-theme-6 mt-2">This field is required</div>
                        @enderror
                    </div>
                    @if ($submit == true)
                    <button class="btn btn-success mt-3">Submit</button>
                    @endif
                </form>
                @if ($error)
                <div class="alert alert-danger show mt-3 mb-2" role="alert">
                    {!! $error !!}
                </div>
                @endif
                @endif
            </div>
        </div>
        @endif
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
                                <td class="text-right">{{ number_format($row->acceptance) }}</td>
                                <td class="text-right">{{ number_format($row->accepted_btt, 5)}}</td>
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
</div>
