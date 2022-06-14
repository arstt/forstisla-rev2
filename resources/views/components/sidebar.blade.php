<div>
    <!-- Sidebar outter -->
    <div class="main-sidebar sidebar-style-2">
        <!-- sidebar wrapper -->
        <aside id="sidebar-wrapper">
            <!-- sidebar brand -->
            <div class="sidebar-brand">
                <a href="{{ route('welcome') }}">{{ config('app.name', 'Laravel') }}</a>
            </div>
            <!-- sidebar menu -->
            <ul class="sidebar-menu">
                <!-- menu header -->
                <li class="menu-header">Navigasi</li>
                <!-- menu item -->
                <li class="{{ Route::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-fire"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- menu header -->
                <li class="menu-header">Alat & Analisa</li>
                <!-- menu item -->
                    <li class="{{ Route::is('nasabah.index') ? 'active' : '' }}">
                        <a href="{{ route('nasabah.index') }}">
                            <i class="fas fa-address-book"></i>
                            <span>{{ 'Nasabah' }}</span>
                        </a>
                    </li>

                    <li class="{{ Route::is('alternatives.index') ? 'active' : '' }}">
                        <a href="{{ route('alternatives.index') }}">
                            <i class="fas fa-chart-line"></i>
                            <span>{{ 'Analisa' }}</span>
                        </a>
                    </li>

                    <li class="{{ Route::is('rank') ? 'active' : '' }}">
                        <a href="{{ route('rank') }}">
                            <i class="fas fa-chart-bar"></i>
                            <span>{{ 'Ranking Keputusan' }}</span>
                        </a>
                    </li>


                <!-- menu header -->
                <li class="menu-header">Pengaturan</li>
                <!-- menu item -->

                <li class="{{ Route::is('billing') ? 'active' : '' }}">
                    <a href="{{ route('billing') }}">
                        <i class="fas fa-receipt"></i>
                        <span>{{ 'Langganan' }}</span>
                    </a>
                </li>
                <li class="{{ Route::is('profile') ? 'active' : '' }}">
                    <a href="{{ route('profile') }}">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
            </ul>
        </aside>
    </div>
</div>
