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
                            <div class="grid grid-cols-12 gap-6">
                                <div class="col-span-12 md:col-span-12 xl:col-span-12">
                                    @if (auth()->user()->due_date)
                                    <div class='alert intro-y alert-warning text-1xl gap-6 show mt-2' role='alert'>
                                        Your account is in grace period. Renew your contract <strong><a href='/renewal' class='text-danger'>here</a></strong> before {{ auth()->user()->due_date }}
                                    </div>
                                    @endif
                                    @if (!auth()->user()->google2fa_secret)
                                    <div class='alert intro-y alert-danger-soft text-1xl gap-6 show mt-2' role='alert'>
                                        You need to activate google authenticator <strong><a href='/security' class='text-danger'>here</a></strong>
                                    </div>
                                    @endif
                                    @if (!auth()->user()->wallet)
                                    <div class='alert intro-y alert-warning-soft text-1xl gap-6 show mt-2' role='alert'>
                                        Insert your BTT wallet address <strong><a href='/profile' class='text-danger'>here</a></strong>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-span-12 md:col-span-12 xl:col-span-12">
                                    <div class="intro-x">
                                        <div class="box">
                                            <div class="tns-outer" id="important-notes-ow">
                                                <div id="important-notes-mw" class="tns-ovh">
                                                    <div class="tns-inner" id="important-notes-iw">
                                                        <div class="tiny-slider  tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal" id="important-notes" style="transform: translate3d(-40%, 0px, 0px);">
                                                            @foreach ($information as $row)
                                                            <div class="p-5 tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1" style="height: 150px; overflow-y:auto; max-height: 150px">
                                                                <div class="text-base font-medium truncate">{{ $row->title }}</div>
                                                                <div class="text-gray-500 mt-1">{{ \Carbon\Carbon::parse($row->created_at)->diffForHumans() }}</div>
                                                                <div class="text-gray-600 text-justify mt-1">{!! $row->content !!}</div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
                                    <div class="grid grid-cols-12 gap-6">
                                        <div class="col-span-12 sm:col-span-12 xl:col-span-6 intro-y">
                                            <div class="report-box zoom-in">
                                                <div class="box p-5">
                                                    <div class="flex">
                                                        Remaining Contract
                                                        <div class="ml-auto">
                                                            <i data-feather="dollar-sign" class="report-box__icon text-theme-9"></i>
                                                        </div>
                                                    </div>
                                                    <div class="text-3xl font-bold leading-8 mt-6 text-right">$ {{ number_format($remaining_contract, 2) }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-12 sm:col-span-12 xl:col-span-6 intro-y">
                                            <div class="report-box zoom-in">
                                                <div class="box p-5">
                                                    <div class="flex">
                                                        <a href="/gift">Total Gifts</a>
                                                        <div class="ml-auto">
                                                            <i data-feather="gift" class="report-box__icon text-theme-11"></i>
                                                        </div>
                                                    </div>
                                                    <div class="text-3xl font-bold leading-8 mt-6 text-right">$ {{ number_format($gift->sum('credit') - $gift->sum('debit'), 2) }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="intro-y col-span-12 lg:col-span-6">
                                            <div class="alert alert-dark show intro-y">
                                                <div class="flex items-center">
                                                    <div class="font-medium text-lg"> LEFT TURNOVER</div>
                                                </div>
                                                <hr class="mt-1">
                                                <h3 class="text-white mt-2 font-medium text-right">$ {{ number_format($downline->left_turnover - $downline->invalid_left_turnover->sum('amount')) }}</h3>
                                            </div>
                                        </div>
                                        <div class="intro-y col-span-12 lg:col-span-6">
                                            <div class="alert alert-dark-soft show intro-y">
                                                <div class="flex items-center">
                                                    <div class="font-medium text-lg"> RIGHT TURNOVER</div>
                                                </div>
                                                <hr class="mt-1">
                                                <h3 class="text-white mt-2 font-medium text-right">$ {{ number_format($downline->right_turnover - $downline->invalid_right_turnover->sum('amount')) }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
                                    <div class="col-span-12 md:col-span-12 xl:col-span-4 xxl:col-span-12">
                                        <div class="box p-5">
                                            <div class="intro-x flex items-center h-10">
                                                <h2 class="text-lg font-medium truncate mr-5">
                                                    Achievement
                                                </h2>
                                            </div>
                                            <div class="mt-2">
                                                @foreach ($achievement as $key => $row)
                                                <div class="intro-x">
                                                    <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                                        <div class="ml-4 mr-auto">
                                                            <div class="font-medium">{{ $row->rating->min_turnover }}</div>
                                                            <div class="text-gray-600 text-xs mt-0.5">{{ $row->created_at }}</div>
                                                        </div>
                                                        <div class="text-theme-9">$ {{ number_format($row->rating_reward)." (".number_format($row->btt_amount)." BTT)" }}</div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
