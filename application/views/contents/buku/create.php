
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-notebook icon-gradient bg-happy-itmeo">
                        </i>
                    </div>
                    <div>  <i class="fas fa-plus" ></i> Tambah Data Buku
                        <div class="page-title-subheading">
                        <a href="<?=base_url()?>">Home</a> / <a href="<?=base_url()?>buku">Buku</a> / Tambah Buku
                        </div>
                        
                    </div>
                </div> 
            </div>
        </div> 
        
        <div class="row">
            <div class="col-lg-12">
                <div class="main-card mb-3 card">
                
                    <div class="card-body">
                        <h5 class="card-title"><?=$card_title?></h5>
                        <?=form_open_multipart('buku/store');?>
                            
                            <?=$this->load->view('contents/buku/form','',TRUE)?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>