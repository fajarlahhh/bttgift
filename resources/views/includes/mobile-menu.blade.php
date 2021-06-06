
<!-- BEGIN: Mobile Menu -->
<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="{{ config('app.name') }}" class="w-6" src="/images/logo.png">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-29 py-5 hidden">
        <li>
            <a href="/dashboard" class="menu @if ($menu == 'dashboard') menu--active @endif">
                <div class="menu__icon"> <i data-feather="home"></i> </div>
                <div class="menu__title"> Dashboard </div>
            </a>
        </li>
        <li>
            <a href="/profile" class="menu @if ($menu == 'profile') menu--active @endif">
                <div class="menu__icon"> <i data-feather="trello"></i> </div>
                <div class="menu__title"> Profile </div>
            </a>
        </li>
        <li>
            <a href="/withdrawal" class="menu @if ($menu == 'withdrawal') menu--active @endif">
                <div class="menu__icon"> <i data-feather="toggle-right"></i> </div>
                <div class="menu__title"> Withdrawal </div>
            </a>
        </li>
        <li>
            <a href="/downline" class="menu @if ($menu == 'downline') menu--active @endif">
                <div class="menu__icon"> <i data-feather="users"></i> </div>
                <div class="menu__title"> Downline </div>
            </a>
        </li>
        <li>
            <a href="/reward" class="menu @if ($menu == 'reward') menu--active @endif">
                <div class="menu__icon"> <i data-feather="gift"></i> </div>
                <div class="menu__title"> Reward </div>
            </a>
        </li>
        <li>
            <a href="/extension" class="menu @if ($menu == 'extension') menu--active @endif">
                <div class="menu__icon"> <i data-feather="framer"></i> </div>
                <div class="menu__title"> Extension </div>
            </a>
        </li>
        <li>
            <a href="/transaction" class="menu @if ($menu == 'transaction') menu--active @endif">
                <div class="menu__icon"> <i data-feather="list"></i> </div>
                <div class="menu__title"> Transaction </div>
            </a>
        </li>
    </ul>
</div>
<!-- END: Mobile Menu -->
