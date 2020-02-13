
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users icon-gradient bg-happy-itmeo">
                        </i>
                    </div>
                    <div>Data Anggota
                    
                        <a href="<?=base_url()?>anggota/create">
                            <button class="mb-2 mr-2 btn-transition btn btn-outline-info"><i class="fas fa-plus"></i> Tambah Anggota
                            </button>
                        </a>
                        <div class="page-title-subheading">
                            <a href="<?=base_url()?>">Home</a> / Anggota
                        </div>
                    </div>
                </div> 
            </div>
        </div>    
        <?php if($this->uri->segment(2) == "stored"){?>

        <div class="alert alert-success" role="alert">
            Anggota berhasil disimpan
        </div>
        <?php }else if($this->uri->segment(2) == "updated"){ ?>
        <div class="alert alert-success" role="alert">
            Anggota berhasil diubah
        </div>
        <?php }else if($this->uri->segment(2) == "deleted"){ ?>
        <div class="alert alert-success" role="alert">
            Anggota berhasil dihapus
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
                                    <th>Nama</th>
                                    <th>NoInduk</th>
                                    <th>Klas</th>
                                    <th>Kelompok</th>
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
    
