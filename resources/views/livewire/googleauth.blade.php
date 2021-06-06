<div>
    @inject('member', 'App\Models\Member')
    @include('includes.mobile-menu')
    <div class="flex">
        @include('includes.side-menu')
        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <div class="top-bar">
                <!-- BEGIN: Breadcrumb -->
                <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="">Application</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Profile</a> </div>
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
                    Profile
                </h2>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="intro-y col-span-12 lg:col-span-6">
                    <div class="intro-y box p-5">
                        <form wire:submit.prevent="submit">

                        <img src="{{ $qr }}">
                            <div>
                                <label for="username" class="form-label">Username</label>
                                <input id="username" type="text" class="form-control" wire:model="username" placeholder="Username" readonly>
                                @error('username')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="name" class="form-label">Name</label>
                                <input id="name" type="text" class="form-control" wire:model.defer="name" placeholder="Name">
                                @error('name')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="text" class="form-control" wire:model.defer="email" placeholder="Email">
                                @error('email')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                            </div>
                            <hr class="mt-5">
                            <div class="mt-3">
                                <label for="contract" class="form-label">Contract</label>
                                <input id="contract" type="text" class="form-control text-right" wire:model="contract" placeholder="Contract" readonly>
                                @error('contract')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="upline" class="form-label">Upline</label>
                                <input id="upline" type="text" class="form-control" wire:model="upline" placeholder="Upline" readonly>
                            </div>
                            <hr class="mt-5">
                            <div class="mt-3">
                                <label for="wallet" class="form-label">BTT Wallet</label>
                                <input id="wallet" type="text" class="form-control" wire:model.defer="wallet" placeholder="BTT Wallet">
                                @error('wallet')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                            </div>
                            <button class="btn btn-primary mt-5">Save</button>
                        </form>
                    </div>
                </div>
                <div class="intro-y col-span-12 lg:col-span-6">
                    @php
                        $turnover = $member->select(
                                DB::raw('(select ifnull(sum(contract * extension), 0) from member a where contract is not null and left(a.network, length(concat(member.network, member.id, "ki")))=concat(member.network, member.id, "ki") ) left_turnover'),
                                DB::raw('(select ifnull(sum(contract * extension), 0) from member a where contract is not null and left(a.network, length(concat(member.network, member.id, "ka")))=concat(member.network, member.id, "ka") ) right_turnover'))->where('id', auth()->id())->first();
                    @endphp
                    <div class="box p-5 bg-theme-3 intro-x">
                        <div class="flex flex-wrap gap-3">
                            <div class="w-full">
                                <div class="text-white text-opacity-70 flex items-center leading-3"> LEFT TURNOVER </div>
                                <div class="text-white relative text-2xl font-medium leading-5 pl-3.5 mt-3.5"> <span class="absolute text-lg font-bold top-0 left-0 -mt-1.5">$</span> {{ $turnover['left_turnover'] }} </div>
                                <hr class="mt-3">
                                <div class="mt-3">
                                    <label for="referral_left" class="form-label text-white">Referral Link</label>
                                    <input id="referral_left" type="text" class="form-control" wire:model="referral_left" placeholder="Left Referral" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box p-5 bg-theme-1 intro-x mt-3">
                        <div class="flex flex-wrap gap-3">
                            <div class="w-full">
                                <div class="text-white text-opacity-70 flex items-center leading-3"> RIGHT TURNOVER </div>
                                <div class="text-white relative text-2xl font-medium leading-5 pl-3.5 mt-3.5"> <span class="absolute text-lg font-bold top-0 left-0 -mt-1.5">$</span> {{ $turnover['right_turnover'] }} </div>
                                <hr class="mt-3">
                                <div class="mt-3">
                                    <label for="referral_right" class="form-label text-white">Referral Link</label>
                                    <input id="referral_right" type="text" class="form-control" wire:model="referral_right" placeholder="Right Referral" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Content -->
    </div>
</div>
