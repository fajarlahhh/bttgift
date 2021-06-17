<div>
    <div class="block xl:grid grid-cols-2 gap-4">
        <!-- BEGIN: Login Info -->
        <div class="hidden xl:flex flex-col min-h-screen">
            <div class="my-auto">
                <img alt="{{ config('app.name') }}" class="-intro-x w-1/2 -mt-16" src="/images/logo.svg">
            </div>
        </div>
        <!-- END: Login Info -->
        <!-- BEGIN: Login Form -->
        <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
            <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                @if ($data)
                <form wire:submit.prevent="submit">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        New Password
                    </h2>
                    <p class="intro-x">New password for <strong>{{ $username }}</strong></p>
                    <div class="intro-x mt-5">
                        <div class="input-group">
                            <input type="{{ $type }}" class="w-full form-control text-gray-700" wire:model.defer="new_password" aria-describedby="input-group-1" placeholder="New Password" autocomplete="off">
                            <a href="javascript:;" id="input-group-1" wire:click="showHide('{{ $show }}')" class="input-group-text">{{ $show }}</a>
                        </div>
                        @error('new_password')
                        <div class="text-theme-6 mt-2">This field is required</div>
                        @enderror
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Submit</button>&nbsp;
                        <a class="btn btn-default py-3 px-4 w-full xl:w-32 xl:mr-3 align-top" href="/login">Sign In</a>
                    </div>
                    @if ($error)
                        {!! $error !!}
                    @endif
                </form>
                @else
                <h2 class="intro-x font-bold text-theme-6 text-2xl xl:text-3xl text-center xl:text-left">
                    Link expired!!!
                </h2>
                @endif
                @include('includes.footer')
            </div>
        </div>
        <!-- END: Login Form -->
    </div>
</div>
