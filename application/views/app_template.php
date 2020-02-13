<!doctype html>
<html lang="en">
<!-- HEAD TAG -->
<?=$this->load->view('layouts/head_tag','',TRUE)?>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">

        <!-- HEADER -->
        <?=$this->load->view('layouts/header','',TRUE)?>
        <div class="app-main">  
        
            <!-- SIDEBAR -->
            <?=$this->load->view('layouts/sidebar','',TRUE)?>
            
            <!-- MAIN -->
            <div class="app-main__outer">
                <?=$this->load->view(!empty($content)?$content:'beranda','',TRUE)?>
            
                <div class="app-wrapper-footer">
                    <div class="app-footer">
                        <div class="app-footer__inner">
                            <div class="app-footer-right">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            Perpustakaan SMP
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
    <!-- SCRIPTS -->
    <script type="text/javascript" src="<?=site_url()?>assets/scripts/main.js"></script>
    <script type="text/javascript" src="<?=site_url()?>assets/vendor/jquery/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="<?=site_url()?>assets/vendor/datatables/js/datatables.min.js"></script>

    <?=$this->load->view('layouts/scripts','',TRUE)?>
    <?=!empty($scripts)?$this->load->view($scripts,'',TRUE):''?>

</body>
</html>
