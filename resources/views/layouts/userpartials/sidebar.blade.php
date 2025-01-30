<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <!-- Dashboard link -->
            <a class="nav-link" href="{{ url('/dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>

            <div class="sb-sidenav-menu-heading">Document Management</div>

            <!-- Profile Edit link -->
            

            <a class="nav-link" href="{{ route('user.documents', $user) }}">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                View Documents
            </a>

            
            
            <div class="sb-sidenav-menu-heading">Addons</div>
            <a class="nav-link" href="/profile">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                Edit Profile
            </a>

            <div class="sb-sidenav-menu-heading">Action</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="nav-link" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-power-off"></i></div>
                    {{ __('Log Out') }}
                </a>
            </form>
            
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ Auth::user()->name }}
    </div>
</nav>
