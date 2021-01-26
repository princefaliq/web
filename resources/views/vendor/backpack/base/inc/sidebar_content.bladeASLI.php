<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
@can('Master')
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-book-dead"></i> Master</a>
        <ul class="nav-dropdown-items">
            <li class='nav-item'><a class='nav-link' href='{{ backpack_url('data_pegawai') }}'><i class='nav-icon la la-book-medical'></i> Data Pegawai</a></li>
            <li class='nav-item'><a class='nav-link' href='{{ backpack_url('bahan') }}'><i class='nav-icon la la-book-medical'></i> Bahan</a></li>
        </ul>
    </li>
@endcan
@can('Transaksi')
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-cash-register"></i> Transaksi</a>
        <ul class="nav-dropdown-items">
            <li class='nav-item'><a class='nav-link' href='{{ backpack_url('press') }}'><i class='nav-icon la la-sync-alt'></i> Presse</a></li>
            <li class='nav-item'><a class='nav-link' href='{{ backpack_url('repair') }}'><i class='nav-icon la la-gavel'></i> Repair</a></li>
        </ul>
    </li>
@endcan
@can('Laporan')
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-reply"></i> Laporan</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('laporan_press/create') }}'><i class='nav-icon la la-print'></i> Press</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('laporan_repair/create') }}'><i class='nav-icon la la-print'></i> Repair</a></li>
    </ul>
</li>
@endcan
@can('Administrator')
    <!-- Users, Roles, Permissions -->
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
        <ul class="nav-dropdown-items">
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
        </ul>
    </li>
@endcan
