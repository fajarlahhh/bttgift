
<!-- BEGIN: Side Menu -->
<nav class="side-nav" wire:ignore>
    <a href="" class="intro-x flex items-center pl-5 pt-4">
        <img alt="{{ config('app.name') }}" class="w-6" src="/images/logo.svg">
        <span class="hidden xl:block text-white text-lg ml-3"> Diamond<span class="font-medium"> Glow</span> </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        @foreach (config('menu.'.(auth()->user()->role == 0? 'admin': 'member')) as $menu)
        <li>
            <a href="{{ $menu['link'] }}" class="side-menu  @if (str_contains(Request::url(), $menu['link'])) side-menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="{{ $menu['icon'] }}"></i> </div>
                <div class="side-menu__title"> {{ $menu['title'] }} </div>
            </a>
        </li>
        @endforeach
    </ul>
</nav>
<!-- END: Side Menu -->
