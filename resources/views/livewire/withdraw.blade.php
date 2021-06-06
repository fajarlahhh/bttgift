<div>
    @include('includes.mobile-menu')
    <div class="flex">
        @include('includes.side-menu')
        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <div class="top-bar">
                <!-- BEGIN: Breadcrumb -->
                <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="">Application</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Withdrawal</a> </div>
                <!-- END: Breadcrumb -->
                <!-- BEGIN: Account Menu -->
                <div class="intro-x dropdown w-8 h-8">
                    <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false">
                        <img alt="Rubick Tailwind HTML Admin Template" src="/images/profile-6.jpg">
                    </div>
                    <div class="dropdown-menu w-56">
                        <div class="dropdown-menu__content box bg-theme-26 dark:bg-dark-6 text-white">
                            <div class="p-4 border-b border-theme-27 dark:border-dark-3">
                                <div class="font-medium">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-theme-28 mt-0.5 dark:text-gray-600">{{ auth()->user()->kode }}</div>
                            </div>
                            {{-- <div class="p-2">
                                <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
                                <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="edit" class="w-4 h-4 mr-2"></i> Add Account </a>
                                <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>
                                <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="help-circle" class="w-4 h-4 mr-2"></i> Help </a>
                            </div> --}}
                            <div class="p-2 border-t border-theme-27 dark:border-dark-3">
                                <a href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Account Menu -->
            </div>
            <!-- END: Top Bar -->
            <div class="intro-y flex items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">
                    Withdrawal
                </h2>
            </div>
            @if ($total_wd->filter(function ($q) {
                return false !== stristr($q->created_at, date('Y-m-d'));
            })->count() > 0)
            <div class="alert intro-y alert-warning text-2xl gap-6 show mt-10 mb-2 text-center" role="alert">
                We have received your withdrawal request today. Please wait for this process for 2 x 24 hours
            </div>
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box p-5">
                    @php
                        $data = $total_wd->filter(function ($q) {
                            return false !== stristr($q->created_at, date('Y-m-d'));
                        })->first();
                    @endphp
                    <h3>Last Withdrawal Information</h3>
                    <hr class="mt-3">
                    <table class="table">
                        <tr>
                            <td> Time</td>
                            <td> : {{ $data->created_at }}</td>
                        </tr>
                        <tr>
                            <td> Amount</td>
                            <td> : $ {{ $data->amount }}</td>
                        </tr>
                        <tr>
                            <td> Fee</td>
                            <td> : $ {{ $data->fee }}</td>
                        </tr>
                        <tr>
                            <td> Acceptance</td>
                            <td> : $ {{ $data->acceptance }}</td>
                        </tr>
                        <tr>
                            <td> BTT</td>
                            <td> : {{ number_format($data->accepted_btt) }}</td>
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
                                <input id="amount" step="any" type="number" class="form-control" wire:model.lazy="amount" placeholder="Amount" autocomplete="off">
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
                    <div class="box p-5 bg-theme-1 intro-x">
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
                                    Max. Withdraw : {{ number_format($max_wd)}}
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
