<li class="header-compare">
    <a href="{{ route('compare') }}">
        <i class="fa fa-cog"></i>
        @if (count(session('compare', [])))
            <span class="compare-counter">{{ count(session('compare', [])) }}</span>
        @endif
    </a>

    <ul class="ht-dropdown">
        <li><a href="login.html">Login</a></li>
        <li><a href="register.html">Register</a></li>
        <li><a href="account.html">Account</a></li>
    </ul>
</li>
