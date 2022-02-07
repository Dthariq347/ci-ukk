<ul class="navbar-nav bg-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>/login/admin">
        <div class="sidebar-brand-icon" style="padding: 5px; margin-top: 30px; margin-left: 10px;">
            <img class=" img-responsive" style="max-width: 75%; height: auto;" src="<?= base_url() ?>/img/logo.png">
        </div>
        <div class="sidebar-brand-text mx-3"></div>
    </a>
    <br>

    <!-- Divider -->

    <!-- Nav Item - Dashboard -->

    <?php if (in_groups('admin')) : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Mengelola Data</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Siswa:</h6>
                    <a class="collapse-item" href="/admin/createsiswa">Input Data</a>
                    <a class="collapse-item" href="/admin/readsiswa">Hasil Input</a>
                    <hr class="my-0">
                    <h6 class="collapse-header">Data Petugas:</h6>
                    <a class="collapse-item" href="/admin/createpetugas">Input Data</a>
                    <a class="collapse-item" href="/admin/readpetugas">Hasil Input</a>
                    <hr class="my-0">
                    <h6 class="collapse-header">Data Kelas:</h6>
                    <a class="collapse-item" href="/admin/createkelas">Input Data</a>
                    <a class="collapse-item" href="/admin/readkelas">Hasil Input</a>
                    <hr class="my-0">
                    <h6 class="collapse-header">Data SPP:</h6>
                    <a class="collapse-item" href="/admin/createspp">Input Data</a>
                    <a class="collapse-item" href="/admin/readspp">Hasil Input</a>

                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse" aria-expanded="true" aria-controls="collapse">
                <i class="far fa-user-circle"></i>
                <span>Akun Siswa</span>
            </a>
            <div id="collapse" class="collapse" aria-labelledby="heading" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Siswa:</h6>
                    <a class="collapse-item" href="/admin/createakun">Pembuatan Akun</a>
                    <a class="collapse-item" href="/admin/readakun">Hasil Akun</a>

                </div>
            </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="/Generate/index">
                <i class="fas fa-fw fa-print"></i>
                <span>Pembuatan Laporan</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="/Pembayaran/index">
                <i class="fas fa-bookmark"></i>
                <span>Input Transaksi</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="/Pembayaran/readpembayaran">
                <i class="fas fa-history"></i>
                <span>History Pembayaran</span></a>
        </li>

    <?php endif; ?>
    <?php if (in_groups('petugas')) : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('petugas'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="/Pembayaran/index">
                <i class="fas fa-bookmark"></i>
                <span>Input Transaksi</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="/Pembayaran/readpembayaran">
                <i class="fas fa-history"></i>
                <span>History Pembayaran</span></a>
        </li>
    <?php endif; ?>
    </li>
    <?php if (in_groups('siswa')) : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('siswa'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="/Pembayaran/readpembayaran">
                <i class="fas fa-history"></i>
                <span>History Pembayaran</span></a>
        </li>

        </li>
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 400"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>