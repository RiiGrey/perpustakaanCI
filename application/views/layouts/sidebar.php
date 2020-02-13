
<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Beranda</li>
                <li>
                    <a href="<?=base_url()?>">
                        <i class="metismenu-icon pe-7s-home"></i>
                        Beranda
                    </a>
                </li>
                <li class="app-sidebar__heading">Master</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-notebook"></i>
                        Buku
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="<?=base_url()?>buku">
                                <i class="metismenu-icon"></i>
                                Data Buku
                            </a>
                        </li>
                        <li>
                            <a href="elements-buttons-standard.html">
                                <i class="metismenu-icon"></i>
                                Data Kategori Buku
                            </a>
                        </li>
                        <li>
                            <a href="elements-dropdowns.html">
                                <i class="metismenu-icon">
                                </i>Data Katalog Buku
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?=base_url()?>anggota">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Anggota
                    </a>
                </li>
                <li class="app-sidebar__heading">Peminjaman</li>
                <li>
                    <a href="<?=base_url()?>pinjam">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Peminjaman
                    </a>
                </li>
                <li>
                    <a href="<?=base_url()?>kembali">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Pengembalian
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div> 