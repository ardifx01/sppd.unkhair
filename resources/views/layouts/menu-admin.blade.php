<ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">

    <li class="nav-header">MAIN MENU</li>
    @if (auth()->user()->hasRole(['developper', 'admin-spd', 'admin-st', 'ppk']) &&
            in_array(session('role'), ['developper', 'admin-spd', 'admin-st', 'ppk']))
        <li class="nav-item {{ routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p> Dashboard</p>
            </a>
        </li>
        <li
            class="nav-item {{ routeIs(['admin.departemen.index', 'admin.departemen.unitkhusus', 'admin.pimpinan.index', 'admin.pegawai.index', 'admin.pegawai.import', 'admin.kodesurat.index', 'admin.roles', 'admin.pengguna', 'admin.pengguna.import', 'admin.referensi']) ? 'menu-open' : '' }}">
            <a href="#"
                class="nav-link {{ routeIs(['admin.departemen.index', 'admin.departemen.unitkhusus', 'admin.pimpinan.index', 'admin.pegawai.index', 'admin.pegawai.import', 'admin.kodesurat.index', 'admin.roles', 'admin.pengguna', 'admin.pengguna.import', 'admin.referensi']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-database"></i>
                <p> Data Master <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                @if (in_array(session('role'), ['admin-spd', 'admin-st', 'ppk']))
                    <li class="nav-item">
                        <a href="{{ route('admin.departemen.index') }}"
                            class="nav-link {{ routeIs(['admin.departemen.index', 'admin.departemen.unitkhusus']) ? 'active' : '' }}">
                            <i class="fas fa-angle-double-right nav-icon" aria-hidden="true"
                                style="font-size: 11px;"></i>
                            <p>Data Departemen</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.pimpinan.index') }}"
                            class="nav-link {{ routeIs(['admin.pimpinan.index']) ? 'active' : '' }}">
                            <i class="fas fa-angle-double-right nav-icon" aria-hidden="true"
                                style="font-size: 11px;"></i>
                            <p>Data Pimpinan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.pegawai.index') }}"
                            class="nav-link {{ routeIs(['admin.pegawai.index', 'admin.pegawai.import']) ? 'active' : '' }}">
                            <i class="fas fa-angle-double-right nav-icon" aria-hidden="true"
                                style="font-size: 11px;"></i>
                            <p>Data Pegawai</p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('admin.kodesurat.index') }}"
                        class="nav-link {{ routeIs(['admin.kodesurat.index']) ? 'active' : '' }}">
                        <i class="fas fa-angle-double-right nav-icon" aria-hidden="true" style="font-size: 11px;"></i>
                        <p>Data Kode Surat</p>
                    </a>
                </li>

                @if (session('role') == 'developper')
                    <li class="nav-item">
                        <a href="{{ route('admin.pengguna') }}"
                            class="nav-link {{ routeIs(['admin.pengguna']) ? 'active' : '' }}">
                            <i class="fas fa-angle-double-right nav-icon" aria-hidden="true"
                                style="font-size: 11px;"></i>
                            <p>Data Pengguna</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.roles') }}"
                            class="nav-link {{ routeIs(['admin.roles']) ? 'active' : '' }}">
                            <i class="fas fa-angle-double-right nav-icon" aria-hidden="true"
                                style="font-size: 11px;"></i>
                            <p>Role Pengguna</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.referensi') }}"
                            class="nav-link {{ routeIs(['admin.referensi']) ? 'active' : '' }}">
                            <i class="fas fa-angle-double-right nav-icon" aria-hidden="true"
                                style="font-size: 11px;"></i>
                            <p>Referensi</p>
                        </a>
                    </li>
                @endif
            </ul>
        </li>

        @if (in_array(session('role'), ['admin-spd', 'ppk']))
            <li
                class="nav-item {{ routeIs(['admin.sppd.index', 'admin.sppd.create', 'admin.sppd.edit', 'admin.sppd.review']) ? 'menu-open' : '' }}">
                <a href="#"
                    class="nav-link {{ routeIs(['admin.sppd.index', 'admin.sppd.create', 'admin.sppd.edit', 'admin.sppd.review']) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-clone"></i>
                    <p> Data SPPD <i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.sppd.create') }}"
                            class="nav-link {{ routeIs(['admin.sppd.create', 'admin.sppd.edit']) ? 'active' : '' }}">
                            <i class="fas fa-angle-double-right nav-icon" aria-hidden="true"
                                style="font-size: 11px;"></i>
                            <p>Buat SPPD</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.sppd.index') }}"
                            class="nav-link {{ routeIs(['admin.sppd.index']) ? 'active' : '' }}">
                            <i class="fas fa-angle-double-right nav-icon" aria-hidden="true"
                                style="font-size: 11px;"></i>
                            <p>Daftar SPPD</p>
                        </a>
                    </li>

                    @if (session('role') == 'ppk')
                        <li class="nav-item">
                            <a href="{{ route('admin.sppd.review') }}"
                                class="nav-link {{ routeIs(['admin.sppd.review']) ? 'active' : '' }}">
                                <i class="fas fa-angle-double-right nav-icon" aria-hidden="true"
                                    style="font-size: 11px;"></i>
                                <p>Review Pengajuan SPPD</p>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.sppd.laporan') }}"
                    class="nav-link {{ routeIs(['admin.sppd.laporan']) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-book"></i>
                    <p>Laporan</p>
                </a>
            </li>
        @endif

        @if (in_array(session('role'), ['admin-st']))
            <li class="nav-item">
                <a href="{{ route('admin.std.index') }}"
                    class="nav-link {{ routeIs(['admin.std.index', 'admin.std.create', 'admin.std.create-fromSppd', 'admin.std.create-fromSppd-params', 'admin.std.edit']) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-newspaper-o"></i>
                    <p>Data STD</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.std.laporan') }}"
                    class="nav-link {{ routeIs(['admin.std.laporan']) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-book"></i>
                    <p>Laporan</p>
                </a>
            </li>
        @endif
    @endif

    <livewire:Auth.Logout tampilan="logout1">
</ul>
