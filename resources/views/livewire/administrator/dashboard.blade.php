<div>
    @include('includes.mobile-menu')
    <div class="flex">
        @include('includes.side-menu')
        <!-- BEGIN: Content -->
        <div class="content">
            @include('includes.top-bar', [
                'menu' => $menu
            ])
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 xxl:col-span-9">
                    <div class="grid grid-cols-12 gap-6">
                        <!-- BEGIN: General Report -->
                        <div class="col-span-12 mt-8">
                            <div class="intro-y flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">
                                    Dashboard
                                </h2>
                                <a href="" class="ml-auto flex items-center text-theme-1 dark:text-theme-10"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload </a>
                            </div>
                            <div class="grid grid-cols-12 gap-6 mt-5">
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-5">
                                            <div class="flex">
                                                Deposit Waiting
                                                <div class="ml-auto">
                                                    <i data-feather="pocket" class="report-box__icon text-theme-6"></i>
                                                </div>
                                            </div>
                                            <div class="text-3xl font-bold leading-8 mt-6 text-right">{{ number_format($deposit) }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-5">
                                            <div class="flex">
                                                Withdrawal Waiting
                                                <div class="ml-auto">
                                                    <i data-feather="command" class="report-box__icon text-theme-9"></i>
                                                </div>
                                            </div>
                                            <div class="text-3xl font-bold leading-8 mt-6 text-right">{{ number_format($withdrawal) }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-5">
                                            <div class="flex">
                                                Achievement Waiting
                                                <div class="ml-auto">
                                                    <i data-feather="check" class="report-box__icon text-theme-9"></i>
                                                </div>
                                            </div>
                                            <div class="text-3xl font-bold leading-8 mt-6 text-right">{{ number_format($achievement) }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-5">
                                            <div class="flex">
                                                Members Total
                                                <div class="ml-auto">
                                                    <i data-feather="users" class="report-box__icon text-theme-6"></i>
                                                </div>
                                            </div>
                                            <div class="text-3xl font-bold leading-8 mt-6 text-right">{{ number_format($user) }}</div>
                                        </div>
                                    </div>
                                </div>
                                @if ($daily == 0)
                                <div class="col-span-12 sm:col-span-6 xl:col-span-12 intro-y">
                                    <div class="alert alert-dark show intro-x ">
                                        <h3>Daily Gift</h3>
                                        <hr class="mt-2">
                                        <div class=" flex flex-col sm:flex-row">
                                            <form wire:submit.prevent="daily">
                                                <input type="number" step="any" class="form-control mt-3" wire:model.defer="daily_gift" placeholder="Insert Daily Gift Here" autocomplete="off"> &nbsp;`
                                                <button class="btn btn-primary mt-3">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 xxl:col-span-3">
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 md:col-span-12 xxl:col-span-12 mt-3 xxl:mt-6">
                            <div class="intro-x flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">
                                    Login History
                                </h2>
                            </div>
                            <hr>
                            <div class="report-timeline mt-2 relative">
                                @foreach (auth()->user()->authentications->where('logout_at', null)->take(5) as $row)
                                <div class="intro-x relative flex items-center mb-3">
                                    <div class="report-timeline__image">
                                        <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                            <img alt="Rubick Tailwind HTML Admin Template" src="/images/profile-11.jpg">
                                        </div>
                                    </div>
                                    <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                                        <div class="flex items-center">
                                            <div class="font-medium">{{ $row->ip_address }}</div>
                                            <div class="text-xs text-gray-500 ml-auto text-right">{{ $row->login_at }}</div>
                                        </div>
                                        <div class="text-gray-600 mt-1"><small>{{ $row->user_agent }}</small></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Content -->
    </div>
</div>
