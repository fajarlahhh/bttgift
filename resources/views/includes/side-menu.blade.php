
<!-- BEGIN: Side Menu -->
<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4">
        <img alt="{{ config('app.name') }}" class="w-6" src="/images/logo.png">
        <span class="hidden xl:block text-white text-lg ml-3"> BTT<span class="font-medium">Give</span> </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="/dashboard" class="side-menu  @if ($menu == 'dashboard') side-menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                <div class="side-menu__title"> Dashboard </div>
            </a>
        </li>
        <li>
            <a href="/profile" class="side-menu  @if ($menu == 'profile') side-menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="trello"></i> </div>
                <div class="side-menu__title"> Profile </div>
            </a>
        </li>
        <li>
            <a href="/withdrawal" class="side-menu  @if ($menu == 'withdrawal') side-menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="toggle-right"></i> </div>
                <div class="side-menu__title"> Withdrawal </div>
            </a>
        </li>
        <li>
            <a href="/downline" class="side-menu  @if ($menu == 'downline') side-menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                <div class="side-menu__title"> Downline </div>
            </a>
        </li>
        <li>
            <a href="/reward" class="side-menu  @if ($menu == 'reward') side-menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="gift"></i> </div>
                <div class="side-menu__title"> Reward </div>
            </a>
        </li>
        <li>
            <a href="/extension" class="side-menu  @if ($menu == 'extension') side-menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="framer"></i> </div>
                <div class="side-menu__title"> Extension </div>
            </a>
        </li>
        <li>
            <a href="/transaction" class="side-menu  @if ($menu == 'transaction') side-menu--active @endif">
                <div class="side-menu__icon"> <i data-feather="list"></i> </div>
                <div class="side-menu__title"> Transaction </div>
            </a>
        </li>
    </ul>
</nav>
<!-- END: Side Menu -->
