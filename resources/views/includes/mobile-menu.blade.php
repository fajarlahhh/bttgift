
<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu md:hidden" wire:ignore>
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="{{ config('app.name') }}" class="w-6" src="/images/logo.png">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-29 py-5 hidden">
        @foreach (config('menu.'.(auth()->user()->role == 0? 'admin': 'member')) as $menu)
        <li>
            <a href="{{ $menu['link'] }}" class="menu  @if (str_contains(Request::url(), $menu['link'])) menu--active @endif">
                <div class="menu__icon"> <i data-feather="{{ $menu['icon'] }}"></i> </div>
                <div class="menu__title"> {{ $menu['title'] }} </div>
            </a>
        </li>
        @endforeach
    </ul>
</div>
<!-- END: Mobile Menu -->
