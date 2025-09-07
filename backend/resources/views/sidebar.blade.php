<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="index.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="{{ route('experiences') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Experiences
                </a>
                <a class="nav-link" href="{{ route('skills') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Skills
                </a>
                <a class="nav-link" href="{{ route('portfolio') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Portfolio
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Me
        </div>
    </nav>
</div>