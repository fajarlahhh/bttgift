<div>
    <div class="block xl:grid grid-cols-2 gap-4">
        <!-- BEGIN: Login Info -->
        <div class="hidden xl:flex flex-col min-h-screen">
            <a href="/" class="-intro-x flex items-center pt-5">
                <img alt="{{ config('app.name') }}" class="w-10" src="/images/favicon.svg">
                <span class="text-white text-lg ml-3">
                    Diamond <span class="font-medium">Glow</span>
                    <hr class="text-white">
                </span>
            </a>
            <div class="-intro-x grid font-medium grid-cols-12 gap-6 mt-2 text-dark">
                <div class="intro-y col-span-12 lg:col-span-8 box p-5"  style="max-height: 600px; overflow-y: auto;">
                    <div class="text-center"><strong>MARKETING PLAN</strong></div>
                    <hr class="mt-2 mb-2">
                    <strong>Contract :</strong>
                    <p><i data-feather="check"></i> $50 Get 150%</p>
                    <p><i data-feather="check"></i> $100 Get 175%</p>
                    <p><i data-feather="check"></i> $200 Get 200%</p>
                    <p><i data-feather="check"></i> $500 Get 225%</p>
                    <p><i data-feather="check"></i> $1000 Get 250%</p>
                    <p><i data-feather="check"></i> $2000 Get 275%</p>
                    <p><i data-feather="check"></i> $5000 Get 300%</p>
                    <p><i data-feather="check"></i> $10,000 Get 350%</p>
                    <br>
                    <strong>Bonuses :</strong>
                    <p><i data-feather="check"></i> Daily Passive 0.25% - Unlimited</p>
                    <p><i data-feather="check"></i> Referral Active 10%</p>
                    <br>
                    <strong>Pairing :</strong>
                    <p><i data-feather="check"></i> Level 1 = 5%</p>
                    <p><i data-feather="check"></i> Level 2 = 4%</p>
                    <p><i data-feather="check"></i> Level 3 = 3%</p>
                    <p><i data-feather="check"></i> Level 4 - 10 = 2%</p>
                    <br>
                    <strong>Achievement :</strong>
                    <p><i data-feather="check"></i> Min. Turnover $ 10,000 GET $ 200</p>
                    <p><i data-feather="check"></i> Min. Turnover $ 50,000 GET $ 1,000</p>
                    <p><i data-feather="check"></i> Min. Turnover $ 100,000 GET $ 2,000</p>
                    <p><i data-feather="check"></i> Min. Turnover $ 500,000 GET $ 10,000</p>
                    <br>
                    <strong>Withdrawal :</strong>
                    <p><i data-feather="check"></i> Withdrawal Using BTT</p>
                    <p><i data-feather="check"></i> Min. Withdrawal 10 % Every 2 Days</p>
                    <p><i data-feather="check"></i> Max. Withdrawal 50 % Every 2 Days</p>
                    <br>
                    <strong>Renewal :</strong>
                    <p><i data-feather="check"></i> According To The Initial Package 2 Days Grace</p>
                    <p><i data-feather="check"></i> Bonus Reset</p>
                </div>
            </div>
        </div>
        <!-- END: Login Info -->
        <!-- BEGIN: Login Form -->
        <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
            <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                <form wire:submit.prevent="submit">
                    <div class="intro-y mt-2 xl:hidden">
                        <div class="alert alert-dark show">

                            <h3 class="text-2xl text-center">

                            <a href="/" class="-intro-x flex text-center">
                                <img alt="{{ config('app.name') }}" class="w-20" style="margin:auto" src="/images/favicon.svg">
                            </a>
                            Marketing Plan</h3>
                            <hr class="mt-2 mb-2">
                            <strong>Contract :</strong>
                            <p><i data-feather="check"></i> $50 Get 150%</p>
                            <p><i data-feather="check"></i> $100 Get 175%</p>
                            <p><i data-feather="check"></i> $200 Get 200%</p>
                            <p><i data-feather="check"></i> $500 Get 225%</p>
                            <p><i data-feather="check"></i> $1000 Get 250%</p>
                            <p><i data-feather="check"></i> $2000 Get 275%</p>
                            <p><i data-feather="check"></i> $5000 Get 300%</p>
                            <p><i data-feather="check"></i> $10,000 Get 350%</p>
                            <br>
                            <strong>Bonuses :</strong>
                            <p><i data-feather="check"></i> Daily Passive 0.25% - Unlimited</p>
                            <p><i data-feather="check"></i> Referral Active 10%</p>
                            <br>
                            <strong>Pairing :</strong>
                            <p><i data-feather="check"></i> Level 1 = 5%</p>
                            <p><i data-feather="check"></i> Level 2 = 4%</p>
                            <p><i data-feather="check"></i> Level 3 = 3%</p>
                            <p><i data-feather="check"></i> Level 4 - 10 = 2%</p>
                            <br>
                            <strong>Achievement :</strong>
                            <p><i data-feather="check"></i> Min. Turnover $ 10,000 GET $ 200</p>
                            <p><i data-feather="check"></i> Min. Turnover $ 50,000 GET $ 1,000</p>
                            <p><i data-feather="check"></i> Min. Turnover $ 100,000 GET $ 2,000</p>
                            <p><i data-feather="check"></i> Min. Turnover $ 500,000 GET $ 10,000</p>
                            <br>
                            <strong>Withdrawal :</strong>
                            <p><i data-feather="check"></i> Withdrawal Using BTT</p>
                            <p><i data-feather="check"></i> Min. Withdrawal 10 % Every 2 Days</p>
                            <p><i data-feather="check"></i> Max. Withdrawal 50 % Every 2 Days</p>
                            <br>
                            <strong>Renewal :</strong>
                            <p><i data-feather="check"></i> According To The Initial Package 2 Days Grace</p>
                            <p><i data-feather="check"></i> Bonus Reset</p>
                        </div>
                    </div>
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left mt-5">
                        Sign Up Here
                    </h2>
                    <div class="intro-x mt-8">
                        <input type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block" wire:model.defer="username" placeholder="Username" required>
                        <input type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" placeholder="Full Name" wire:model.defer="name" required>
                        <input type="email" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" placeholder="Email" wire:model.defer="email" required>
                        <input type="password" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" wire:model.defer="password" placeholder="Password" required>
                        <select data-placeholder="Contract" wire:model.defer="contract" class="intro-x login__input form-select py-3 px-4 border-gray-300 mt-4" required>
                            <option value="" selected>-- Choose Contract --</option>
                            @foreach ($data_contract as $item)
                            <option value="{{ $item->price }}">$ {{ number_format($item->price) }} = $ {{ number_format($item->price * $item->max_claim/100) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="intro-x flex items-center text-gray-700 dark:text-gray-600 mt-4 text-xs sm:text-sm">
                        <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                        <label class="cursor-pointer select-none" for="remember-me">Remember Me</label>
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Register</button>
                        <button class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top" type="button" wire:click="login">Sign in</button>
                    </div>
                    @if ($message)
                        {!! $message !!}
                    @endif
                </form>
                @if ($error)
                <div class="alert alert-danger show mt-3 mb-2" role="alert">
                    {!! $error !!}
                </div>
                @endif
                @include('includes.footer')
            </div>
        </div>
        <!-- END: Login Form -->
    </div>
</div>
