<!-- Sidebar Start -->
<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <img src="<?= base_url()?>assets/img/logo.png" width="130" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= @$dash_active?>" href="<?= base_url()?>dashboard" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
            <?php if($_SESSION['logged_status']['role'] != 'kasir'){?>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">MASTER</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= @$user_active?>" href="<?= base_url()?>user" aria-expanded="false">
                        <span>
                            <i class="ti ti-user-plus"></i>
                        </span>
                        <span class="hide-menu">Setup User</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= @$agent_active?>" href="<?= base_url()?>agent" aria-expanded="false">
                        <span>
                            <i class="ti ti-address-book"></i>
                        </span>
                        <span class="hide-menu">Setup Agent</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= @$payment_active?>" href="<?= base_url()?>payment" aria-expanded="false">
                        <span>
                            <i class="ti ti-cash"></i>
                        </span>
                        <span class="hide-menu">Setup Payment</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= @$ticket_active?>" href="<?= base_url()?>ticket" aria-expanded="false">
                        <span>
                            <i class="ti ti-ticket"></i>
                        </span>
                        <span class="hide-menu">Setup Ticket</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= @$paket_active?>" href="<?= base_url()?>paket" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-barcode"></i>
                        </span>
                        <span class="hide-menu">Setup Paket</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= @$tpa_active?>" href="<?= base_url()?>ticket/ticket_agent" aria-expanded="false">
                        <span>
                            <i class="ti ti-currency-dollar"></i>
                        </span>
                        <span class="hide-menu">Ticket per Agent</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= @$ppa_active?>" href="<?= base_url()?>paket/paket_agent" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-dollar"></i>
                        </span>
                        <span class="hide-menu">Paket per Agent</span>
                    </a>
                </li>
            <?php }?>

            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">TRANSAKSI</span>
            </li>
            <?php if($_SESSION['logged_status']['role'] != 'marketing'){?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= @$bookticket_active?>" href="<?= base_url()?>booking/list_booking_ticket" aria-expanded="false">
                        <span>
                            <i class="ti ti-book"></i>
                        </span>
                        <span class="hide-menu">Booking Ticket</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= @$bookpaket_active?>" href="<?= base_url()?>booking/list_booking_paket" aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Booking Paket</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= @$departure_today_active?>" href="<?= base_url()?>departure/today" aria-expanded="false">
                        <span>
                            <i class="ti ti-speedboat"></i>
                        </span>
                        <span class="hide-menu">Departure Today</span>
                    </a>
                </li>
            <?php } ?>

            <?php if($_SESSION['logged_status']['role'] != 'kasir'){?>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow <?= @$laporan_active?>" href="javascript:void(0)" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-file-analytics"></i>
                        </span>
                        <span class="hide-menu">Laporan</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item active">
                            <a href="<?= base_url()?>laporan/tiketlist" class="sidebar-link <?= @$dropdown_tiket?>">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Pendapatan Ticket</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?= base_url()?>laporan/paketlist" class="sidebar-link <?= @$dropdown_paket?>">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Pendapatan Paket</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?= base_url()?>laporan/peragentiket" class="sidebar-link <?= @$dropdown_agentiket?>">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Transaksi Tiket per Agen</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?= base_url()?>laporan/peragenpaket" class="sidebar-link <?= @$dropdown_agenpaket?>">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Transaksi Paket per Agen</span>
                            </a>
                        </li>
                        <!-- <li class="sidebar-item">
                            <a href="<?= base_url()?>laporan/komisi_tiket_agen" class="sidebar-link <?= @$dropdown_komisi_agentiket?>">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Rekap Komisi Tiket per Agen</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?= base_url()?>laporan/komisi_paket_agen" class="sidebar-link <?= @$dropdown_komisi_agenpaket?>">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Rekap Komisi Paket per Agen</span>
                            </a>
                        </li> -->
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link has-arrow <?= @$laporan_active?>" aria-expanded="false">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Rekap Komisi Ticket</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level ms-4">
                                <li class="sidebar-item active">
                                    <a href="<?= base_url()?>laporan/tiketlist" class="sidebar-link <?= @$dropdown_tiket?>">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Per Agent Company</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?= base_url()?>laporan/paketlist" class="sidebar-link <?= @$dropdown_paket?>">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Per Agent General</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link has-arrow <?= @$laporan_active?>" aria-expanded="false">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Rekap Komisi Paket</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level ms-4">
                                <li class="sidebar-item active">
                                    <a href="<?= base_url()?>laporan/tiketlist" class="sidebar-link <?= @$dropdown_tiket?>">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Per Agent Company</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?= base_url()?>laporan/paketlist" class="sidebar-link <?= @$dropdown_paket?>">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Per Agent General</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?= base_url()?>laporan/rangkuman_bulanan" class="sidebar-link <?= @$dropdown_rangkuman_bulanan?>">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Rangkuman Bulanan</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
                <li class="sidebar-item mb-5 pb-5">
                    <a class="sidebar-link" href="<?= base_url()?>auth/logout" aria-expanded="false">
                        <span>
                            <i class="ti ti-logout"></i>
                        </span>
                        <span class="hide-menu">
                            Logout
                        </span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!--  Sidebar End -->

<!--  Main wrapper -->
<div class="body-wrapper">
    <!--  Header Start -->
    <header class="app-header" style="background-color: #f9f9f9; box-shadow: 2px 2px 10px rgba(0,0,0,0.1);">
        <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
            </a>
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item dropdown me-3">
                    <span id="clock"></span>
                </li>
                <li class="nav-item dropdown">
                    <?= $_SESSION['logged_status']['role']?>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?= base_url()?>assets/img/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                    </a>
                </li>
            </ul>
        </div>
        </nav>
    </header>
    <!--  Header End -->
