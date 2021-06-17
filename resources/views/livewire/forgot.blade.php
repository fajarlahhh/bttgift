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
                @if ($success)
                    {!! $success !!}
                @else
                <form wire:submit.prevent="recover">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        Forgot Password
                    </h2>
                    <div class="intro-x mt-8">
                        <input type="email" class="intro-x login__input form-control py-3 px-4 border-gray-300 block" placeholder="Enter Your Registered Email" wire:model.defer="email" required>
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Recover</button>&nbsp;
                        <a class="btn btn-default py-3 px-4 w-full xl:w-32 xl:mr-3 align-top" href="/login">Sign In</a>
                    </div>
                    @if ($error)
                        {!! $error !!}
                    @endif
                </form>
                @endif
                @include('includes.footer')
            </div>
        </div>
        <!-- END: Login Form -->
    </div>
</div>
