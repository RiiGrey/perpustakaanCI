
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-notebook icon-gradient bg-happy-itmeo">
                        </i>
                    </div>
                    <div>Data Buku
                    
                        <a href="<?=base_url()?>buku/create">
                            <button class="mb-2 mr-2 btn-transition btn btn-outline-info"><i class="fas fa-plus"></i> Tambah Buku
                            </button>
                        </a>
                        <div class="page-title-subheading">
                            <a href="<?=base_url()?>">Home</a> / Buku
                        </div>
                    </div>
                </div> 
            </div>
        </div>    
        <?php if($this->uri->segment(2) == "stored"){?>

        <div class="alert alert-success" role="alert">
            Buku berhasil disimpan
        </div>
        <?php }else if($this->uri->segment(2) == "updated"){ ?>
        <div class="alert alert-success" role="alert">
            Buku berhasil diubah
        </div>
        <?php }else if($this->uri->segment(2) == "deleted"){ ?>
        <div class="alert alert-success" role="alert">
            Buku berhasil dihapus
        </div>
        <?php } ?>
                       
        <div class="row">
            <div class="col-lg-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <table class="mb-0 table table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
