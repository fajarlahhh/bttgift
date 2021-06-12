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
                                <input id="username" type="text" class="form-control" value="{{ $username }}" placeholder="Username" readonly>
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
                                <input id="contract" type="text" class="form-control text-right" value="$ {{ number_format($contract) }}" placeholder="Contract" readonly>
                                @error('contract')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label for="upline" class="form-label">Upline</label>
                                <input id="upline" type="text" class="form-control" value="{{ $upline }}" placeholder="Upline" readonly>
                            </div>
                            <hr class="mt-5">
                            <div class="mt-3">
                                <label for="wallet" class="form-label">BTT Wallet</label>
                                <input id="wallet" type="text" class="form-control" value="{{ $wallet }}" placeholder="BTT Wallet">
                                @error('wallet')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                            </div>
                            <hr class="mt-5">
                            <div class="mt-3">
                                <label for="username" class="form-label">Google Auth PIN</label>
                                <input id="username" type="text" class="form-control" wire:model.defer="pin" placeholder="Enter Your Google Authenticator PIN" autocomplete="off">
                                @error('pin')
                                <div class="text-theme-6 mt-2">This field is required</div>
                                @enderror
                            </div>
                            <button class="btn btn-primary mt-5">Save</button>
                        </form>
                    </div>
                </div>
                <div class="intro-y col-span-12 lg:col-span-6">
                    <div class="box p-5 bg-theme-12 intro-x">
                        <div class="flex flex-wrap gap-3">
                            <div class="w-full">
                                <div class="text-white text-opacity-70 flex items-center leading-3"> LEFT TURNOVER </div>
                                <div class="text-white relative text-2xl font-medium leading-5 pl-3.5 mt-3.5 text-right">$ {{ number_format($left_turnover) }} </div>
                                <hr class="mt-3">
                                <div class="mt-3">
                                    <label for="left_referral" class="form-label text-white">Referral Link</label>
                                    <div class="input-group">
                                        <input id="crud-form-3" type="text" class="form-control" value="{{ $left_referral }}" aria-describedby="input-group-1">
                                        <a href="javascript:;" id="input-group-1" class="input-group-text" onclick="copyToClipboard('{{ $left_referral }}')">Copy</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box p-5 bg-theme-9 intro-x mt-3">
                        <div class="flex flex-wrap gap-3">
                            <div class="w-full">
                                <div class="text-white text-opacity-70 flex items-center leading-3"> RIGHT TURNOVER </div>
                                <div class="text-white relative text-2xl font-medium leading-5 pl-3.5 mt-3.5 text-right"> $ {{ number_format($right_turnover) }} </div>
                                <hr class="mt-3">
                                <div class="mt-3">
                                    <label for="right_referral" class="form-label text-white">Referral Link</label>
                                    <div class="input-group">
                                        <input id="crud-form-3" type="text" class="form-control" value="{{ $right_referral }}" aria-describedby="input-group-1">
                                        <a href="javascript:;" id="input-group-1" class="input-group-text" onclick="copyToClipboard('{{ $right_referral }}')">Copy</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($error)
                <div class="alert alert-danger show col-span-12 lg:col-span-6" role="alert">
                    {!! $error !!}
                </div>
                @endif
                @if ($success)
                <div class="alert alert-success show col-span-12 lg:col-span-6" role="alert">
                    {!! $success !!}
                </div>
                @endif
            </div>
        </div>
        <!-- END: Content -->
    </div>
    @push('scripts')
    <script>
        function copyToClipboard(text) {
            var input = document.body.appendChild(document.createElement("input"));
            input.value = text;
            input.focus();
            input.select();
            document.execCommand('copy');
            input.parentNode.removeChild(input);
            alert('Referral Copied');
        }
    </script>
    @endpush
</div>
