<div>
    <div class="grid grid-cols-12 gap-6 mt-5 ">
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Change Password
                    </h2>
                </div>
                <div class="p-5">
                    <div>
                        <label for="old_password" class="form-label">Old Password</label>
                        <input id="old_password" type="password" class="form-control" wire:model.defer="old_password" placeholder="Old Password" autocomplete="off">
                        @error('old_password')
                        <div class="text-theme-6 mt-2">This field is required</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <div class="input-group">
                            <input id="crud-form-3" type="{{ $type }}" class="form-control text-gray-700" wire:model.defer="new_password" aria-describedby="input-group-1" placeholder="New Password" autocomplete="off">
                            <a href="javascript:;" id="input-group-1" wire:click="showHide('{{ $show }}')" class="input-group-text">{{ $show }}</a>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row items-center pl-5 pt-5 pr-5 border-t border-gray-200 dark:border-dark-5">
                    @if (auth()->user()->google2fa_secret)
                    <input type="text" class="form-control" placeholder="Enter Your Google Authenticator PIN Here" wire:model.defer="pin">
                    &nbsp;
                    @endif
                    <button wire:click="password()" class="btn btn-primary">
                        Submit
                    </button>
                </div>
                <p class="text-theme-6 pl-5 pb-5">
                    @error('pin')
                    This field is required
                    @enderror
                </p>
            </div>
        </div>
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
                    <input type="text" class="form-control" placeholder="Enter Your Google Authenticator PIN Here" wire:model.defer="pin_google">
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
    @if ($success)
    <div class="alert alert-success show mt-3" role="alert">
        {!! $success !!}
    </div>
    @endif
    @if ($error)
    <div class="alert alert-danger show mt-3" role="alert">
        {!! $error !!}
    </div>
    @endif
</div>
