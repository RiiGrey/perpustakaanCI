<!doctype html>
<html lang="en">
<!-- HEAD TAG -->

<?=$this->load->view('layouts/head_tag','',TRUE)?>

<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    <div class="app-header header-shadow">
        <div class="app-header__logo">
            <div class="logo-src"></div>
        </div>
    </div>
    <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
        <div class="app-logo"></div>
            <h4 class="mb-0">
            <span class="d-block">Selamat Datang</span>
            <span>Silahkan login menggunakan akun yang sudah dibuat</span></h4>
            <div class="divider row"></div>
        <div>
            <form class="" action="<?=base_url()?>login/validasi" method="post">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="position-relative form-group"><label for="username" class="">Username</label><input name="username" id="username" placeholder="Masukkan Username" type="text" class="form-control"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative form-group"><label for="password" class="">Password</label><input name="password" id="password" placeholder="Masukkan Password" type="password" class="form-control"></div>
                    </div>
                </div>
                <div class="position-relative form-check"><input name="check" id="exampleCheck" type="checkbox" class="form-check-input"><label for="exampleCheck" class="form-check-label">Izinkan saya tetap masuk</label></div>
                <div class="divider row"></div>
                <div class="d-flex align-items-center">
                    <div class="ml-auto">
                        <button class="btn btn-primary btn-lg">Login Aplikasi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- SCRIPTS -->
    <script type="text/javascript" src="<?=site_url()?>assets/scripts/main.js"></script>

</body>
</html>
