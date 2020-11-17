<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">{{ config('app.name') ?? 'Stisla' }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">{{ substr(config('app.name'), 0, 2) ?? substr('Stisla', 0, 2) }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown{{ request()->is('admin/dashboard') ? ' active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Master Data</li>
            <!-- <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                    <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                </ul>
            </li> -->
            <li class="{{ request()->is('admin/obat') ? ' active' : '' }}"><a class="nav-link" href="{{ route('admin.obat.index') }}"><i class="fas fa-th-large"></i> <span>Data Obat</span></a></li>
            <li><a class="nav-link" href="blank.html"><i class="far fa-user"></i> <span>Data Karyawan</span></a></li>
            <li><a class="nav-link" href="blank.html"><i class="fas fa-box"></i> <span>Data Supplier</span></a></li>
            <!-- <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Bootstrap</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="bootstrap-alert.html">Alert</a></li>
                    <li><a class="nav-link" href="bootstrap-badge.html">Badge</a></li>
                    <li><a class="nav-link" href="bootstrap-breadcrumb.html">Breadcrumb</a></li>
                    <li><a class="nav-link" href="bootstrap-buttons.html">Buttons</a></li>
                    <li><a class="nav-link" href="bootstrap-card.html">Card</a></li>
                    <li><a class="nav-link" href="bootstrap-carousel.html">Carousel</a></li>
                    <li><a class="nav-link" href="bootstrap-collapse.html">Collapse</a></li>
                    <li><a class="nav-link" href="bootstrap-dropdown.html">Dropdown</a></li>
                    <li><a class="nav-link" href="bootstrap-form.html">Form</a></li>
                    <li><a class="nav-link" href="bootstrap-list-group.html">List Group</a></li>
                    <li><a class="nav-link" href="bootstrap-media-object.html">Media Object</a></li>
                    <li><a class="nav-link" href="bootstrap-modal.html">Modal</a></li>
                    <li><a class="nav-link" href="bootstrap-nav.html">Nav</a></li>
                    <li><a class="nav-link" href="bootstrap-navbar.html">Navbar</a></li>
                    <li><a class="nav-link" href="bootstrap-pagination.html">Pagination</a></li>
                    <li><a class="nav-link" href="bootstrap-popover.html">Popover</a></li>
                    <li><a class="nav-link" href="bootstrap-progress.html">Progress</a></li>
                    <li><a class="nav-link" href="bootstrap-table.html">Table</a></li>
                    <li><a class="nav-link" href="bootstrap-tooltip.html">Tooltip</a></li>
                    <li><a class="nav-link" href="bootstrap-typography.html">Typography</a></li>
                </ul>
            </li> -->
            <li class="menu-header">Transaksi</li>
            <li class="{{ request()->is('admin/transaksi') ? ' active' : '' }}"><a class="nav-link" href="{{ route('admin.transaksi.index') }}"><i class="fas fa-money-check-alt"></i> <span>Data Transaksi</span></a></li>
            <li class="menu-header">Laporan</li>
            <li><a class="nav-link" href="blank.html"><i class="fas fa-calendar-week"></i> <span>Data Laporan</span></a></li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>