<div id="layoutSidenav_nav">
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="{{route('ad.dashboard')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#userpanel" aria-expanded="false" aria-controls="userpanel">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Tenants
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="userpanel" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{route('ad.addtenant')}}">Add New Tenant</a>
                            <a class="nav-link" href="{{route('ad.viewTntList')}}">View Tenants</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#billpanel" aria-expanded="false" aria-controls="billpanel">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Bill Panel
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="billpanel" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{route('ad.selectUserBill')}}">Create New Bill</a>
                            {{-- <a class="nav-link" href="{{route('ad.viewTntList')}}">View Tenants</a> --}}
                        </nav>
                    </div>
                    <a class="nav-link" href="{{route('ad.selectBill')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Settle Previous Bill
                    </a>
                    
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Admin: {{Auth::user()->name}}
            </div>
        </nav>
    </div>