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
                    <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                Google Authenticator
                            </h2>
                        </div>
                        @if (!auth()->user()->google2fa_secret)
                        <div class="p-5 text-center">
                            Scan the barcode below with Google Authenticator, then enter the generated PIN
                            <br>
                            <div style="display: flex; justify-content: center;" class="mt-3">
                                <img src="{{ $qr }}">
                            </div>
                            {{ $secret }}
                            <br>
                        </div>
                        <div class="flex flex-col sm:flex-row items-center pl-5 pt-5 pr-5 border-t border-gray-200 dark:border-dark-5">
                            <input type="text" class="form-control" placeholder="Enter Your Google Authenticator PIN Here" wire:model.defer="pin">
                            &nbsp;
                            <button wire:click="registration()" class="btn btn-success">
                                Submit
                            </button>
                        </div>
                        <p class="text-theme-6 pl-5 pb-5">
                            @error('pin')
                            This field is required
                            @enderror
                        </p>
                        @else
                        <div class="p-5 text-center">
                            Your google authenticator is actived
                        </div>
                        @endif
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
