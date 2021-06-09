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
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="intro-y col-span-12 lg:col-span-6">
                    <div class="intro-y box p-5">
                        <form wire:submit.prevent="submit">
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
                    <div class="box p-5 bg-theme-6 intro-x">
                        <div class="flex flex-wrap gap-3">
                            <div class="w-full">
                                <div class="text-white text-opacity-70 flex items-center leading-3"> LEFT TURNOVER </div>
                                <div class="text-white relative text-2xl font-medium leading-5 pl-3.5 mt-3.5">$ {{ $left_turnover }} </div>
                                <hr class="mt-3">
                                <div class="mt-3">
                                    <label for="left_referral" class="form-label text-white">Referral Link</label>
                                    <input id="left_referral" type="text" class="form-control" value="{{ $left_referral }}" placeholder="Left Referral" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box p-5 bg-theme-9 intro-x mt-3">
                        <div class="flex flex-wrap gap-3">
                            <div class="w-full">
                                <div class="text-white text-opacity-70 flex items-center leading-3"> RIGHT TURNOVER </div>
                                <div class="text-white relative text-2xl font-medium leading-5 pl-3.5 mt-3.5"> $ {{ $right_turnover }} </div>
                                <hr class="mt-3">
                                <div class="mt-3">
                                    <label for="right_referral" class="form-label text-white">Referral Link</label>
                                    <input id="right_referral" type="text" class="form-control" value="{{ $right_referral }}" placeholder="Right Referral" readonly>
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
